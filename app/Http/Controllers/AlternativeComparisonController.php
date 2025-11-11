<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\Alternative;
use App\Models\PairwiseComparisonAlternative;
use App\Models\AnpAlternativeWeight;
use App\Models\AnpCriteriaWeight;
use App\Services\ANPCalculationService;
use App\Services\WeightedProductService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AlternativeComparisonController extends Controller
{
    protected ANPCalculationService $anpService;
    protected WeightedProductService $wpService;
    
    public function __construct(ANPCalculationService $anpService, WeightedProductService $wpService)
    {
        $this->anpService = $anpService;
        $this->wpService = $wpService;
    }
    
    /**
     * Store pairwise comparison values for alternatives under a specific criteria by a DM.
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function storeComparisons(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'criteria_id' => 'required|exists:criteria,id',
            'comparisons' => 'required|array',
            'comparisons.*.alternative_id_1' => 'required|exists:alternatives,id',
            'comparisons.*.alternative_id_2' => 'required|exists:alternatives,id|different:comparisons.*.alternative_id_1',
            'comparisons.*.comparison_value' => 'required|numeric|min:0.111|max:9',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
        
        try {
            DB::beginTransaction();
            
            $userId = $request->user_id;
            $criteriaId = $request->criteria_id;
            
            foreach ($request->comparisons as $comparison) {
                PairwiseComparisonAlternative::updateOrCreate(
                    [
                        'user_id' => $userId,
                        'criteria_id' => $criteriaId,
                        'alternative_id_1' => $comparison['alternative_id_1'],
                        'alternative_id_2' => $comparison['alternative_id_2']
                    ],
                    [
                        'comparison_value' => $comparison['comparison_value']
                    ]
                );
                
                // Also store reciprocal value
                PairwiseComparisonAlternative::updateOrCreate(
                    [
                        'user_id' => $userId,
                        'criteria_id' => $criteriaId,
                        'alternative_id_1' => $comparison['alternative_id_2'],
                        'alternative_id_2' => $comparison['alternative_id_1']
                    ],
                    [
                        'comparison_value' => 1 / $comparison['comparison_value']
                    ]
                );
            }
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Alternative comparisons stored successfully'
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to store comparisons',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Calculate local priority weights for alternatives under a specific criteria.
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function calculateLocalWeights(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'criteria_id' => 'required|exists:criteria,id'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
        
        try {
            $userId = $request->user_id;
            $criteriaId = $request->criteria_id;
            
            // Get all alternatives
            $alternatives = Alternative::orderBy('id')->get();
            $alternativeIds = $alternatives->pluck('id')->toArray();
            
            if (count($alternativeIds) < 2) {
                return response()->json([
                    'success' => false,
                    'message' => 'At least 2 alternatives are required'
                ], 400);
            }
            
            // Get pairwise comparisons for this user and criteria
            $comparisons = PairwiseComparisonAlternative::where('user_id', $userId)
                ->where('criteria_id', $criteriaId)
                ->get();
            
            if ($comparisons->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No comparisons found for this user and criteria'
                ], 404);
            }
            
            // Build pairwise matrix
            $pairwiseMatrix = $this->anpService->buildPairwiseMatrix(
                $comparisons,
                $alternativeIds,
                'alternative_id_1',
                'alternative_id_2'
            );
            
            // Normalize matrix
            $normalizedMatrix = $this->anpService->normalizeMatrix($pairwiseMatrix);
            
            // Calculate local weights
            $weights = $this->anpService->calculateWeights($normalizedMatrix);
            
            // Calculate consistency ratio
            $consistencyRatio = $this->anpService->calculateConsistencyRatio($pairwiseMatrix, $weights);
            
            // Prepare response
            $criteria = Criteria::find($criteriaId);
            $weightsData = [];
            
            foreach ($alternativeIds as $index => $alternativeId) {
                $alternative = $alternatives->find($alternativeId);
                $weightsData[] = [
                    'alternative_id' => $alternativeId,
                    'alternative_code' => $alternative->code,
                    'alternative_name' => $alternative->name,
                    'local_weight' => round($weights[$index], 6)
                ];
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Local weights calculated successfully',
                'data' => [
                    'user_id' => $userId,
                    'criteria_id' => $criteriaId,
                    'criteria_name' => $criteria->name,
                    'weights' => $weightsData,
                    'consistency_ratio' => $consistencyRatio,
                    'is_consistent' => $consistencyRatio <= 0.1,
                    'pairwise_matrix' => $pairwiseMatrix,
                    'normalized_matrix' => $normalizedMatrix
                ]
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to calculate local weights',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Calculate final ANP weights for all alternatives by a specific DM.
     * Uses Weighted Product (WP) method to combine local weights with global criteria weights.
     * Formula: S(Ai) = Π (rij ^ wj) where rij = local weight, wj = criteria weight
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function calculateFinalWeights(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
        
        try {
            $userId = $request->user_id;
            
            // Get criteria weights for this user
            $criteriaWeights = AnpCriteriaWeight::where('user_id', $userId)->get();
            
            if ($criteriaWeights->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Criteria weights not found. Please calculate criteria weights first.'
                ], 404);
            }
            
            // Get all criteria and alternatives
            $criteria = Criteria::orderBy('id')->get();
            $alternatives = Alternative::orderBy('id')->get();
            $alternativeIds = $alternatives->pluck('id')->toArray();
            
            // Initialize final weights array with 1 (for multiplication)
            $finalWeights = array_fill_keys($alternativeIds, 1);
            $detailedCalculations = [];
            
            // For each criteria, calculate local weights and apply Weighted Product method
            foreach ($criteria as $criterion) {
                $criteriaWeight = $criteriaWeights->firstWhere('criteria_id', $criterion->id);
                
                if (!$criteriaWeight) {
                    continue;
                }
                
                // Get pairwise comparisons for alternatives under this criteria
                $comparisons = PairwiseComparisonAlternative::where('user_id', $userId)
                    ->where('criteria_id', $criterion->id)
                    ->get();
                
                if ($comparisons->isEmpty()) {
                    return response()->json([
                        'success' => false,
                        'message' => "No alternative comparisons found for criteria: {$criterion->name}"
                    ], 404);
                }
                
                // Build pairwise matrix and calculate local weights
                $pairwiseMatrix = $this->anpService->buildPairwiseMatrix(
                    $comparisons,
                    $alternativeIds,
                    'alternative_id_1',
                    'alternative_id_2'
                );
                
                $normalizedMatrix = $this->anpService->normalizeMatrix($pairwiseMatrix);
                $localWeights = $this->anpService->calculateWeights($normalizedMatrix);
                $consistencyRatio = $this->anpService->calculateConsistencyRatio($pairwiseMatrix, $localWeights);
                
                // Store detailed calculations
                $criterionDetail = [
                    'criteria_id' => $criterion->id,
                    'criteria_name' => $criterion->name,
                    'criteria_weight' => $criteriaWeight->weight,
                    'consistency_ratio' => $consistencyRatio,
                    'local_weights' => []
                ];
                
                // Weighted Product: multiply S(Ai) by (local_weight ^ criteria_weight)
                foreach ($alternativeIds as $index => $alternativeId) {
                    $localWeight = $localWeights[$index];
                    
                    // Use WP Service to calculate power value
                    $powerValue = $this->wpService->calculatePowerValue($localWeight, $criteriaWeight->weight);
                    $finalWeights[$alternativeId] *= $powerValue > 0 ? $powerValue : 1;
                    
                    $alternative = $alternatives->find($alternativeId);
                    $criterionDetail['local_weights'][] = [
                        'alternative_id' => $alternativeId,
                        'alternative_name' => $alternative->name,
                        'local_weight' => round($localWeight, 6),
                        'power_value' => round($powerValue, 6)
                    ];
                }
                
                $detailedCalculations[] = $criterionDetail;
            }
            
            // Store final weights in database
            DB::beginTransaction();
            
            foreach ($alternativeIds as $alternativeId) {
                AnpAlternativeWeight::updateOrCreate(
                    [
                        'user_id' => $userId,
                        'alternative_id' => $alternativeId
                    ],
                    [
                        'weight' => $finalWeights[$alternativeId]
                    ]
                );
            }
            
            DB::commit();
            
            // Prepare final response
            $finalWeightsData = [];
            foreach ($alternativeIds as $alternativeId) {
                $alternative = $alternatives->find($alternativeId);
                $finalWeightsData[] = [
                    'alternative_id' => $alternativeId,
                    'alternative_code' => $alternative->code,
                    'alternative_name' => $alternative->name,
                    'final_weight' => round($finalWeights[$alternativeId], 6)
                ];
            }
            
            // Sort by final weight descending
            usort($finalWeightsData, function($a, $b) {
                return $b['final_weight'] <=> $a['final_weight'];
            });
            
            return response()->json([
                'success' => true,
                'message' => 'Final weights calculated successfully using Weighted Product (WP) method',
                'data' => [
                    'user_id' => $userId,
                    'method' => 'Weighted Product (WP)',
                    'final_weights' => $finalWeightsData,
                    'detailed_calculations' => $detailedCalculations
                ]
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to calculate final weights',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Get final ANP weights for a specific DM.
     * 
     * @param string $userId
     * @return JsonResponse
     */
    public function getFinalWeights(string $userId): JsonResponse
    {
        try {
            $weights = AnpAlternativeWeight::with('alternative')
                ->where('user_id', $userId)
                ->get();
            
            if ($weights->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No weights found for this user'
                ], 404);
            }
            
            $weightsData = $weights->sortByDesc('weight')->map(function ($weight) {
                return [
                    'alternative_id' => $weight->alternative_id,
                    'alternative_code' => $weight->alternative->code,
                    'alternative_name' => $weight->alternative->name,
                    'weight' => $weight->weight
                ];
            })->values();
            
            return response()->json([
                'success' => true,
                'data' => [
                    'user_id' => $userId,
                    'weights' => $weightsData
                ]
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve weights',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Get all alternative comparisons for a specific DM and criteria.
     * 
     * @param int $userId
     * @param int $criteriaId
     * @return JsonResponse
     */
    public function getComparisons(string $userId, string $criteriaId): JsonResponse
    {
        try {
            $comparisons = PairwiseComparisonAlternative::with(['alternative1', 'alternative2', 'criteria'])
                ->where('user_id', $userId)
                ->where('criteria_id', $criteriaId)
                ->where('comparison_value', '>=', 1) // Only get one direction to avoid duplicates
                ->get();
            
            $comparisonsData = $comparisons->map(function ($comparison) {
                return [
                    'alternative_1' => [
                        'id' => $comparison->alternative_id_1,
                        'code' => $comparison->alternative1->code,
                        'name' => $comparison->alternative1->name
                    ],
                    'alternative_2' => [
                        'id' => $comparison->alternative_id_2,
                        'code' => $comparison->alternative2->code,
                        'name' => $comparison->alternative2->name
                    ],
                    'comparison_value' => $comparison->comparison_value
                ];
            });
            
            $criteria = Criteria::find($criteriaId);
            
            return response()->json([
                'success' => true,
                'data' => [
                    'user_id' => $userId,
                    'criteria_id' => $criteriaId,
                    'criteria_name' => $criteria->name,
                    'comparisons' => $comparisonsData
                ]
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve comparisons',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Calculate all weights for a specific DM (criteria + alternatives).
     * This is a convenience method that calculates everything in one call.
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function calculateAllWeights(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
        
        try {
            $userId = $request->user_id;
            
            // First, calculate criteria weights
            $criteriaRequest = new Request(['user_id' => $userId]);
            $criteriaController = new CriteriaComparisonController($this->anpService);
            $criteriaResponse = $criteriaController->calculateWeights($criteriaRequest);
            
            if (!$criteriaResponse->getData()->success) {
                return $criteriaResponse;
            }
            
            // Then, calculate final alternative weights
            $alternativeResponse = $this->calculateFinalWeights($request);
            
            if (!$alternativeResponse->getData()->success) {
                return $alternativeResponse;
            }
            
            return response()->json([
                'success' => true,
                'message' => 'All weights calculated successfully',
                'data' => [
                    'user_id' => $userId,
                    'criteria_weights' => $criteriaResponse->getData()->data->weights,
                    'alternative_weights' => $alternativeResponse->getData()->data->final_weights
                ]
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to calculate all weights',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\PairwiseComparisonCriteria;
use App\Models\AnpCriteriaWeight;
use App\Services\ANPCalculationService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CriteriaComparisonController extends Controller
{
    protected ANPCalculationService $anpService;
    
    public function __construct(ANPCalculationService $anpService)
    {
        $this->anpService = $anpService;
    }
    
    /**
     * Store pairwise comparison values for criteria by a specific DM.
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function storeComparisons(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'comparisons' => 'required|array',
            'comparisons.*.criteria_id_1' => 'required|exists:criteria,id',
            'comparisons.*.criteria_id_2' => 'required|exists:criteria,id|different:comparisons.*.criteria_id_1',
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
            
            foreach ($request->comparisons as $comparison) {
                PairwiseComparisonCriteria::updateOrCreate(
                    [
                        'user_id' => $userId,
                        'criteria_id_1' => $comparison['criteria_id_1'],
                        'criteria_id_2' => $comparison['criteria_id_2']
                    ],
                    [
                        'comparison_value' => $comparison['comparison_value']
                    ]
                );
                
                // Also store reciprocal value
                PairwiseComparisonCriteria::updateOrCreate(
                    [
                        'user_id' => $userId,
                        'criteria_id_1' => $comparison['criteria_id_2'],
                        'criteria_id_2' => $comparison['criteria_id_1']
                    ],
                    [
                        'comparison_value' => 1 / $comparison['comparison_value']
                    ]
                );
            }
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Pairwise comparisons stored successfully'
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
     * Calculate criteria weights for a specific DM using ANP.
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function calculateWeights(Request $request): JsonResponse
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
            
            // Get all criteria
            $criteria = Criteria::orderBy('id')->get();
            $criteriaIds = $criteria->pluck('id')->toArray();
            
            if (count($criteriaIds) < 2) {
                return response()->json([
                    'success' => false,
                    'message' => 'At least 2 criteria are required'
                ], 400);
            }
            
            // Get pairwise comparisons for this user
            $comparisons = PairwiseComparisonCriteria::where('user_id', $userId)->get();
            
            if ($comparisons->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No comparisons found for this user'
                ], 404);
            }
            
            $pairwiseMatrix = $this->anpService->buildPairwiseMatrix(
                $comparisons,
                $criteriaIds,
                'criteria_id_1',
                'criteria_id_2'
            );
            
            $normalizedMatrix = $this->anpService->normalizeMatrix($pairwiseMatrix);
            
            $weights = $this->anpService->calculateWeights($normalizedMatrix);
            
            $consistencyRatio = $this->anpService->calculateConsistencyRatio($pairwiseMatrix, $weights);
            
            DB::beginTransaction();
            
            foreach ($criteriaIds as $index => $criteriaId) {
                AnpCriteriaWeight::updateOrCreate(
                    [
                        'user_id' => $userId,
                        'criteria_id' => $criteriaId
                    ],
                    [
                        'weight' => $weights[$index]
                    ]
                );
            }
            
            DB::commit();
            
            $weightsData = [];
            foreach ($criteriaIds as $index => $criteriaId) {
                $criterion = $criteria->find($criteriaId);
                $weightsData[] = [
                    'criteria_id' => $criteriaId,
                    'criteria_code' => $criterion->code,
                    'criteria_name' => $criterion->name,
                    'weight' => round($weights[$index], 6)
                ];
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Criteria weights calculated successfully',
                'data' => [
                    'user_id' => $userId,
                    'weights' => $weightsData,
                    'consistency_ratio' => $consistencyRatio,
                    'is_consistent' => $consistencyRatio <= 0.1,
                    'pairwise_matrix' => $pairwiseMatrix,
                    'normalized_matrix' => $normalizedMatrix
                ]
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to calculate weights',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Get criteria weights for a specific DM.
     * 
     * @param int $userId
     * @return JsonResponse
     */
    public function getWeights(int $userId): JsonResponse
    {
        try {
            $weights = AnpCriteriaWeight::with('criteria')
                ->where('user_id', $userId)
                ->get();
            
            if ($weights->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No weights found for this user'
                ], 404);
            }
            
            $weightsData = $weights->map(function ($weight) {
                return [
                    'criteria_id' => $weight->criteria_id,
                    'criteria_code' => $weight->criteria->code,
                    'criteria_name' => $weight->criteria->name,
                    'weight' => $weight->weight
                ];
            });
            
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
     * Get all pairwise comparisons for a specific DM.
     * 
     * @param int $userId
     * @return JsonResponse
     */
    public function getComparisons(int $userId): JsonResponse
    {
        try {
            $comparisons = PairwiseComparisonCriteria::with(['criteria1', 'criteria2'])
                ->where('user_id', $userId)
                ->where('comparison_value', '>=', 1) // Only get one direction to avoid duplicates
                ->get();
            
            $comparisonsData = $comparisons->map(function ($comparison) {
                return [
                    'criteria_1' => [
                        'id' => $comparison->criteria_id_1,
                        'code' => $comparison->criteria1->code,
                        'name' => $comparison->criteria1->name
                    ],
                    'criteria_2' => [
                        'id' => $comparison->criteria_id_2,
                        'code' => $comparison->criteria2->code,
                        'name' => $comparison->criteria2->name
                    ],
                    'comparison_value' => $comparison->comparison_value
                ];
            });
            
            return response()->json([
                'success' => true,
                'data' => [
                    'user_id' => $userId,
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
     * Calculate aggregated criteria weights from all DMs using geometric mean.
     * 
     * @return JsonResponse
     */
    public function calculateAggregatedWeights(): JsonResponse
    {
        try {
            // Get all users who have provided comparisons
            $userIds = PairwiseComparisonCriteria::distinct()->pluck('user_id');
            
            if ($userIds->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No comparisons found'
                ], 404);
            }
            
            // Get all criteria
            $criteria = Criteria::orderBy('id')->get();
            $criteriaIds = $criteria->pluck('id')->toArray();
            
            // Build matrices for each user
            $matrices = [];
            foreach ($userIds as $userId) {
                $comparisons = PairwiseComparisonCriteria::where('user_id', $userId)->get();
                $matrices[] = $this->anpService->buildPairwiseMatrix(
                    $comparisons,
                    $criteriaIds,
                    'criteria_id_1',
                    'criteria_id_2'
                );
            }
            
            // Aggregate matrices using geometric mean
            $aggregatedMatrix = $this->anpService->aggregateMatricesGeometricMean($matrices);
            
            // Normalize and calculate weights
            $normalizedMatrix = $this->anpService->normalizeMatrix($aggregatedMatrix);
            $weights = $this->anpService->calculateWeights($normalizedMatrix);
            $consistencyRatio = $this->anpService->calculateConsistencyRatio($aggregatedMatrix, $weights);
            
            // Prepare response
            $weightsData = [];
            foreach ($criteriaIds as $index => $criteriaId) {
                $criterion = $criteria->find($criteriaId);
                $weightsData[] = [
                    'criteria_id' => $criteriaId,
                    'criteria_code' => $criterion->code,
                    'criteria_name' => $criterion->name,
                    'weight' => round($weights[$index], 6)
                ];
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Aggregated criteria weights calculated successfully',
                'data' => [
                    'number_of_dms' => count($userIds),
                    'weights' => $weightsData,
                    'consistency_ratio' => $consistencyRatio,
                    'is_consistent' => $consistencyRatio <= 0.1,
                    'aggregated_matrix' => $aggregatedMatrix,
                    'normalized_matrix' => $normalizedMatrix
                ]
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to calculate aggregated weights',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use App\Models\AnpAlternativeWeight;
use App\Models\DmRanking;
use App\Models\BordaResult;
use App\Models\User;
use App\Services\BordaCalculationService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ConsensusController extends Controller
{
    protected BordaCalculationService $bordaService;
    
    public function __construct(BordaCalculationService $bordaService)
    {
        $this->bordaService = $bordaService;
    }
    
    /**
     * Generate rankings for all DMs based on their ANP alternative weights.
     * Higher weight = better rank (rank 1 is best).
     * 
     * @return JsonResponse
     */
    public function generateRankings(): JsonResponse
    {
        try {
            // Get all users who have ANP alternative weights
            $userIds = AnpAlternativeWeight::distinct()->pluck('user_id');
            
            if ($userIds->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No ANP weights found. Please calculate ANP weights first.'
                ], 404);
            }
            
            DB::beginTransaction();
            
            $rankingsData = [];
            
            foreach ($userIds as $userId) {
                // Get ANP weights for this user
                $weights = AnpAlternativeWeight::where('user_id', $userId)->get();
                
                // Convert weights to rankings
                $rankings = $this->bordaService->weightsToRankings($weights);
                
                // Store rankings in database
                foreach ($rankings as $alternativeId => $rank) {
                    DmRanking::updateOrCreate(
                        [
                            'user_id' => $userId,
                            'alternative_id' => $alternativeId
                        ],
                        [
                            'rank' => $rank
                        ]
                    );
                }
                
                // Prepare response data
                $user = User::find($userId);
                $userRankings = [];
                
                foreach ($rankings as $alternativeId => $rank) {
                    $alternative = Alternative::find($alternativeId);
                    $weight = $weights->firstWhere('alternative_id', $alternativeId);
                    
                    $userRankings[] = [
                        'alternative_id' => $alternativeId,
                        'alternative_code' => $alternative->code,
                        'alternative_name' => $alternative->name,
                        'weight' => $weight->weight,
                        'rank' => $rank
                    ];
                }
                
                // Sort by rank
                usort($userRankings, function($a, $b) {
                    return $a['rank'] <=> $b['rank'];
                });
                
                $rankingsData[] = [
                    'user_id' => $userId,
                    'user_name' => $user->name,
                    'rankings' => $userRankings
                ];
            }
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Rankings generated successfully',
                'data' => [
                    'number_of_dms' => count($userIds),
                    'dm_rankings' => $rankingsData
                ]
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to generate rankings',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Calculate Borda scores and final consensus ranking.
     * 
     * @return JsonResponse
     */
    public function calculateBordaConsensus(): JsonResponse
    {
        try {
            // Get all DM rankings
            $rankings = DmRanking::all();
            
            if ($rankings->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No rankings found. Please generate rankings first.'
                ], 404);
            }
            
            // Get total number of alternatives
            $totalAlternatives = Alternative::count();
            
            // Calculate Borda points
            $bordaPoints = $this->bordaService->calculateBordaPoints($rankings, $totalAlternatives);
            
            // Calculate final rankings
            $finalRankings = $this->bordaService->calculateFinalRankings($bordaPoints);
            
            // Store results in database
            DB::beginTransaction();
            
            foreach ($finalRankings as $alternativeId => $result) {
                BordaResult::updateOrCreate(
                    ['alternative_id' => $alternativeId],
                    [
                        'borda_points' => $result['borda_points'],
                        'final_rank' => $result['final_rank']
                    ]
                );
            }
            
            DB::commit();
            
            // Prepare detailed response
            $alternatives = Alternative::all();
            $resultsData = [];
            
            foreach ($finalRankings as $alternativeId => $result) {
                $alternative = $alternatives->find($alternativeId);
                $resultsData[] = [
                    'alternative_id' => $alternativeId,
                    'alternative_code' => $alternative->code,
                    'alternative_name' => $alternative->name,
                    'borda_points' => $result['borda_points'],
                    'final_rank' => $result['final_rank']
                ];
            }
            
            // Sort by final rank
            usort($resultsData, function($a, $b) {
                return $a['final_rank'] <=> $b['final_rank'];
            });
            
            // Get number of DMs
            $numberOfDMs = DmRanking::distinct()->count('user_id');
            
            return response()->json([
                'success' => true,
                'message' => 'Borda consensus calculated successfully',
                'data' => [
                    'number_of_dms' => $numberOfDMs,
                    'total_alternatives' => $totalAlternatives,
                    'consensus_results' => $resultsData
                ]
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to calculate Borda consensus',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Calculate Borda consensus with tie handling.
     * 
     * @return JsonResponse
     */
    public function calculateBordaConsensusWithTieHandling(): JsonResponse
    {
        try {
            // Get all DM rankings
            $rankings = DmRanking::all();
            
            if ($rankings->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No rankings found. Please generate rankings first.'
                ], 404);
            }
            
            // Get total number of alternatives
            $totalAlternatives = Alternative::count();
            
            // Calculate Borda points
            $bordaPoints = $this->bordaService->calculateBordaPoints($rankings, $totalAlternatives);
            
            // Calculate final rankings with tie handling
            $finalRankings = $this->bordaService->calculateFinalRankingsWithTieHandling($bordaPoints);
            
            // Store results in database
            DB::beginTransaction();
            
            foreach ($finalRankings as $alternativeId => $result) {
                BordaResult::updateOrCreate(
                    ['alternative_id' => $alternativeId],
                    [
                        'borda_points' => $result['borda_points'],
                        'final_rank' => $result['final_rank']
                    ]
                );
            }
            
            DB::commit();
            
            // Prepare detailed response
            $alternatives = Alternative::all();
            $resultsData = [];
            
            foreach ($finalRankings as $alternativeId => $result) {
                $alternative = $alternatives->find($alternativeId);
                $resultsData[] = [
                    'alternative_id' => $alternativeId,
                    'alternative_code' => $alternative->code,
                    'alternative_name' => $alternative->name,
                    'borda_points' => $result['borda_points'],
                    'final_rank' => $result['final_rank']
                ];
            }
            
            // Sort by final rank
            usort($resultsData, function($a, $b) {
                return $a['final_rank'] <=> $b['final_rank'];
            });
            
            // Get number of DMs
            $numberOfDMs = DmRanking::distinct()->count('user_id');
            
            return response()->json([
                'success' => true,
                'message' => 'Borda consensus calculated successfully (with tie handling)',
                'data' => [
                    'number_of_dms' => $numberOfDMs,
                    'total_alternatives' => $totalAlternatives,
                    'consensus_results' => $resultsData
                ]
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to calculate Borda consensus',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Get current consensus results.
     * 
     * @return JsonResponse
     */
    public function getConsensusResults(): JsonResponse
    {
        try {
            $results = BordaResult::with('alternative')
                ->orderBy('final_rank')
                ->get();
            
            if ($results->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No consensus results found. Please calculate consensus first.'
                ], 404);
            }
            
            $resultsData = $results->map(function ($result) {
                return [
                    'alternative_id' => $result->alternative_id,
                    'alternative_code' => $result->alternative->code,
                    'alternative_name' => $result->alternative->name,
                    'borda_points' => $result->borda_points,
                    'final_rank' => $result->final_rank
                ];
            });
            
            return response()->json([
                'success' => true,
                'data' => [
                    'consensus_results' => $resultsData
                ]
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve consensus results',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Get rankings for a specific DM.
     * 
     * @param int $userId
     * @return JsonResponse
     */
    public function getDMRankings(int $userId): JsonResponse
    {
        try {
            $rankings = DmRanking::with('alternative')
                ->where('user_id', $userId)
                ->orderBy('rank')
                ->get();
            
            if ($rankings->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No rankings found for this user'
                ], 404);
            }
            
            $user = User::find($userId);
            
            $rankingsData = $rankings->map(function ($ranking) {
                return [
                    'alternative_id' => $ranking->alternative_id,
                    'alternative_code' => $ranking->alternative->code,
                    'alternative_name' => $ranking->alternative->name,
                    'rank' => $ranking->rank
                ];
            });
            
            return response()->json([
                'success' => true,
                'data' => [
                    'user_id' => $userId,
                    'user_name' => $user->name,
                    'rankings' => $rankingsData
                ]
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve rankings',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Get detailed comparison showing all DM rankings and final consensus.
     * 
     * @return JsonResponse
     */
    public function getDetailedComparison(): JsonResponse
    {
        try {
            // Get all alternatives
            $alternatives = Alternative::orderBy('id')->get();
            
            // Get all DM rankings grouped by user
            $dmRankings = DmRanking::with(['user', 'alternative'])
                ->get()
                ->groupBy('user_id');
            
            // Get final consensus results
            $bordaResults = BordaResult::with('alternative')
                ->orderBy('final_rank')
                ->get();
            
            if ($dmRankings->isEmpty() || $bordaResults->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Incomplete data. Please ensure all rankings and consensus are calculated.'
                ], 404);
            }
            
            // Prepare comparison data
            $comparisonData = [];
            
            foreach ($alternatives as $alternative) {
                $alternativeData = [
                    'alternative_id' => $alternative->id,
                    'alternative_code' => $alternative->code,
                    'alternative_name' => $alternative->name,
                    'dm_rankings' => [],
                    'borda_result' => null
                ];
                
                // Add each DM's ranking
                foreach ($dmRankings as $userId => $rankings) {
                    $ranking = $rankings->firstWhere('alternative_id', $alternative->id);
                    if ($ranking) {
                        $alternativeData['dm_rankings'][] = [
                            'user_id' => $userId,
                            'user_name' => $ranking->user->name,
                            'rank' => $ranking->rank
                        ];
                    }
                }
                
                // Add Borda result
                $bordaResult = $bordaResults->firstWhere('alternative_id', $alternative->id);
                if ($bordaResult) {
                    $alternativeData['borda_result'] = [
                        'borda_points' => $bordaResult->borda_points,
                        'final_rank' => $bordaResult->final_rank
                    ];
                }
                
                $comparisonData[] = $alternativeData;
            }
            
            // Sort by final rank
            usort($comparisonData, function($a, $b) {
                $rankA = $a['borda_result']['final_rank'] ?? PHP_INT_MAX;
                $rankB = $b['borda_result']['final_rank'] ?? PHP_INT_MAX;
                return $rankA <=> $rankB;
            });
            
            return response()->json([
                'success' => true,
                'data' => [
                    'number_of_dms' => count($dmRankings),
                    'total_alternatives' => count($alternatives),
                    'detailed_comparison' => $comparisonData
                ]
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve detailed comparison',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Execute complete consensus process: generate rankings + calculate Borda.
     * 
     * @return JsonResponse
     */
    public function executeCompleteConsensus(): JsonResponse
    {
        try {
            // Step 1: Generate rankings from ANP weights
            $rankingsResponse = $this->generateRankings();
            
            if (!$rankingsResponse->getData()->success) {
                return $rankingsResponse;
            }
            
            // Step 2: Calculate Borda consensus
            $bordaResponse = $this->calculateBordaConsensus();
            
            if (!$bordaResponse->getData()->success) {
                return $bordaResponse;
            }
            
            // Step 3: Get detailed comparison
            $comparisonResponse = $this->getDetailedComparison();
            
            return response()->json([
                'success' => true,
                'message' => 'Complete consensus process executed successfully',
                'data' => [
                    'rankings' => $rankingsResponse->getData()->data,
                    'consensus' => $bordaResponse->getData()->data,
                    'detailed_comparison' => $comparisonResponse->getData()->data->detailed_comparison
                ]
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to execute complete consensus process',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

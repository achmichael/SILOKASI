<?php

namespace App\Services;

use Illuminate\Support\Collection;

class BordaCalculationService
{
    /**
     * Convert rankings to Borda points.
     * Highest rank (1) gets N points, rank 2 gets N-1, etc.
     *
     * @param Collection $rankings - Collection of rankings per DM
     * @param int $totalAlternatives - Total number of alternatives
     * @return array - Array of alternative_id => total_borda_points
     */
    public function calculateBordaPoints(Collection $rankings, int $totalAlternatives): array
    {
        $bordaPoints = [];
        
        foreach ($rankings as $ranking) {
            $alternativeId = $ranking->alternative_id;
            $rank = $ranking->rank;
            
            // Borda points: N - rank + 1
            // Rank 1 = N points, Rank 2 = N-1 points, etc.
            $points = $totalAlternatives - $rank + 1;
            
            if (!isset($bordaPoints[$alternativeId])) {
                $bordaPoints[$alternativeId] = 0;
            }
            
            $bordaPoints[$alternativeId] += $points;
        }
        
        return $bordaPoints;
    }
    
    /**
     * Convert ANP weights to rankings for each DM.
     * Higher weight = better rank (rank 1 is best).
     *
     * @param Collection $weights - ANP alternative weights for a specific DM
     * @return array - Array of alternative_id => rank
     */
    public function weightsToRankings(Collection $weights): array
    {
        // Sort by weight descending
        $sorted = $weights->sortByDesc('weight')->values();
        
        $rankings = [];
        $rank = 1;
        
        foreach ($sorted as $weight) {
            $rankings[$weight->alternative_id] = $rank;
            $rank++;
        }
        
        return $rankings;
    }
    
    /**
     * Calculate final rankings from Borda points.
     * Higher Borda points = better final rank.
     *
     * @param array $bordaPoints - Array of alternative_id => borda_points
     * @return array - Array of alternative_id => final_rank
     */
    public function calculateFinalRankings(array $bordaPoints): array
    {
        // Sort by Borda points descending
        arsort($bordaPoints);
        
        $rankings = [];
        $rank = 1;
        
        foreach ($bordaPoints as $alternativeId => $points) {
            $rankings[$alternativeId] = [
                'borda_points' => $points,
                'final_rank' => $rank
            ];
            $rank++;
        }
        
        return $rankings;
    }
    
    /**
     * Handle tied rankings using average rank method.
     *
     * @param array $bordaPoints - Array of alternative_id => borda_points
     * @return array - Array of alternative_id => final_rank (with tie handling)
     */
    public function calculateFinalRankingsWithTieHandling(array $bordaPoints): array
    {
        // Sort by Borda points descending
        arsort($bordaPoints);
        
        $rankings = [];
        $rank = 1;
        $previousPoints = null;
        $tiedAlternatives = [];
        
        foreach ($bordaPoints as $alternativeId => $points) {
            if ($previousPoints !== null && $points < $previousPoints) {
                // Process any tied alternatives from previous iteration
                if (!empty($tiedAlternatives)) {
                    $avgRank = array_sum(array_column($tiedAlternatives, 'rank')) / count($tiedAlternatives);
                    foreach ($tiedAlternatives as $tied) {
                        $rankings[$tied['id']] = [
                            'borda_points' => $tied['points'],
                            'final_rank' => $avgRank
                        ];
                    }
                    $rank = max(array_column($tiedAlternatives, 'rank')) + 1;
                    $tiedAlternatives = [];
                }
            }
            
            if ($previousPoints === $points) {
                // Tie detected
                if (empty($tiedAlternatives)) {
                    // Add previous alternative to tied list
                    $prevId = array_key_last($rankings);
                    $tiedAlternatives[] = [
                        'id' => $prevId,
                        'points' => $previousPoints,
                        'rank' => $rank - 1
                    ];
                    unset($rankings[$prevId]);
                }
                $tiedAlternatives[] = [
                    'id' => $alternativeId,
                    'points' => $points,
                    'rank' => $rank
                ];
            } else {
                $rankings[$alternativeId] = [
                    'borda_points' => $points,
                    'final_rank' => $rank
                ];
                $rank++;
            }
            
            $previousPoints = $points;
        }
        
        // Handle any remaining ties
        if (!empty($tiedAlternatives)) {
            $avgRank = array_sum(array_column($tiedAlternatives, 'rank')) / count($tiedAlternatives);
            foreach ($tiedAlternatives as $tied) {
                $rankings[$tied['id']] = [
                    'borda_points' => $tied['points'],
                    'final_rank' => $avgRank
                ];
            }
        }
        
        return $rankings;
    }
}

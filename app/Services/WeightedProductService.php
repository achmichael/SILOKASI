<?php

namespace App\Services;

class WeightedProductService
{
    /**
     * Calculate final scores using Weighted Product (WP) method.
     * Formula: S(Ai) = Π (rij ^ wj)
     * where:
     * - S(Ai) = score for alternative i
     * - rij = local weight of alternative i for criteria j
     * - wj = weight of criteria j
     * - Π = product (multiplication)
     *
     * @param array $localWeightsMatrix - 2D array [alternative_index][criteria_index] = local_weight
     * @param array $criteriaWeights - 1D array [criteria_index] = criteria_weight
     * @return array - Array of final scores for each alternative
     */
    public function calculateScores(array $localWeightsMatrix, array $criteriaWeights): array
    {
        $scores = [];
        
        foreach ($localWeightsMatrix as $alternativeIndex => $localWeights) {
            $score = 1; // Start with 1 for multiplication
            
            foreach ($localWeights as $criteriaIndex => $localWeight) {
                $criteriaWeight = $criteriaWeights[$criteriaIndex] ?? 0;
                
                if ($localWeight > 0 && $criteriaWeight > 0) {
                    $score *= pow($localWeight, $criteriaWeight);
                }
            }
            
            $scores[$alternativeIndex] = $score;
        }
        
        return $scores;
    }
    
    /**
     * Calculate preference value (normalized score) for each alternative.
     * Formula: V(Ai) = S(Ai) / Σ S(Ai)
     *
     * @param array $scores - Array of scores from calculateScores()
     * @return array - Array of preference values (0-1, sum = 1)
     */
    public function calculatePreferenceValues(array $scores): array
    {
        $totalScore = array_sum($scores);
        $preferenceValues = [];
        
        if ($totalScore > 0) {
            foreach ($scores as $alternativeIndex => $score) {
                $preferenceValues[$alternativeIndex] = $score / $totalScore;
            }
        } else {
            // If total is 0, distribute equally
            $count = count($scores);
            foreach ($scores as $alternativeIndex => $score) {
                $preferenceValues[$alternativeIndex] = $count > 0 ? 1 / $count : 0;
            }
        }
        
        return $preferenceValues;
    }
    
    /**
     * Rank alternatives based on their scores.
     * Higher score = better rank (rank 1 is best).
     *
     * @param array $scores - Array of scores
     * @return array - Array of alternative_index => rank
     */
    public function rankAlternatives(array $scores): array
    {
        arsort($scores); // Sort descending
        
        $rankings = [];
        $rank = 1;
        
        foreach ($scores as $alternativeIndex => $score) {
            $rankings[$alternativeIndex] = $rank;
            $rank++;
        }
        
        return $rankings;
    }
    
    /**
     * Calculate power value for WP method.
     * Formula: rij ^ wj
     *
     * @param float $localWeight - Local weight value
     * @param float $criteriaWeight - Criteria weight value
     * @return float - Power value
     */
    public function calculatePowerValue(float $localWeight, float $criteriaWeight): float
    {
        if ($localWeight <= 0) {
            return 0.0;
        }
        
        return pow($localWeight, $criteriaWeight);
    }
}

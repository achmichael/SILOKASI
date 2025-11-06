<?php

namespace App\Services;

use Illuminate\Support\Collection;

class ANPCalculationService
{
    /**
     * Normalize a pairwise comparison matrix.
     * Each element is divided by the sum of its column.
     *
     * @param array $matrix - 2D array of pairwise comparisons
     * @return array - Normalized matrix
     */
    public function normalizeMatrix(array $matrix): array
    {
        $size = count($matrix);
        $columnSums = array_fill(0, $size, 0);
        
        // Calculate column sums
        for ($i = 0; $i < $size; $i++) {
            for ($j = 0; $j < $size; $j++) {
                $columnSums[$j] += $matrix[$i][$j];
            }
        }
        
        // Normalize each element
        $normalizedMatrix = [];
        for ($i = 0; $i < $size; $i++) {
            $normalizedMatrix[$i] = [];
            for ($j = 0; $j < $size; $j++) {
                $normalizedMatrix[$i][$j] = $columnSums[$j] > 0 
                    ? $matrix[$i][$j] / $columnSums[$j] 
                    : 0;
            }
        }
        
        return $normalizedMatrix;
    }
    
    /**
     * Calculate weights using eigenvector approximation.
     * Weight for each element = average of its row in normalized matrix.
     *
     * @param array $normalizedMatrix
     * @return array - Array of weights
     */
    public function calculateWeights(array $normalizedMatrix): array
    {
        $size = count($normalizedMatrix);
        $weights = [];
        
        for ($i = 0; $i < $size; $i++) {
            $rowSum = array_sum($normalizedMatrix[$i]);
            $weights[$i] = $rowSum / $size;
        }
        
        return $weights;
    }
    
    /**
     * Calculate Consistency Ratio (CR) for quality check.
     * CR = CI / RI, where CI = (λmax - n) / (n - 1)
     *
     * @param array $matrix - Original pairwise comparison matrix
     * @param array $weights - Calculated weights
     * @return float - Consistency Ratio
     */
    public function calculateConsistencyRatio(array $matrix, array $weights): float
    {
        $size = count($matrix);
        
        // Random Index values for matrices of different sizes
        $randomIndex = [
            1 => 0, 2 => 0, 3 => 0.58, 4 => 0.90, 5 => 1.12,
            6 => 1.24, 7 => 1.32, 8 => 1.41, 9 => 1.45, 10 => 1.49
        ];
        
        if ($size <= 2) {
            return 0; // Perfect consistency for size <= 2
        }
        
        // Calculate λmax (maximum eigenvalue approximation)
        $weightedSum = array_fill(0, $size, 0);
        for ($i = 0; $i < $size; $i++) {
            for ($j = 0; $j < $size; $j++) {
                $weightedSum[$i] += $matrix[$i][$j] * $weights[$j];
            }
        }
        
        $lambdaMax = 0;
        for ($i = 0; $i < $size; $i++) {
            if ($weights[$i] > 0) {
                $lambdaMax += $weightedSum[$i] / $weights[$i];
            }
        }
        $lambdaMax /= $size;
        
        // Calculate Consistency Index
        $ci = ($lambdaMax - $size) / ($size - 1);
        
        // Get Random Index
        $ri = $randomIndex[$size] ?? 1.49;
        
        // Calculate Consistency Ratio
        $cr = $ri > 0 ? $ci / $ri : 0;
        
        return round($cr, 4);
    }
    
    /**
     * Build a pairwise comparison matrix from comparison values.
     * Fills diagonal with 1s and uses reciprocal values.
     *
     * @param Collection $comparisons - Collection of comparison records
     * @param array $itemIds - Array of item IDs (criteria or alternatives)
     * @param string $item1Key - Key for first item ID
     * @param string $item2Key - Key for second item ID
     * @return array - Complete pairwise matrix
     */
    public function buildPairwiseMatrix(
        Collection $comparisons, 
        array $itemIds,
        string $item1Key = 'criteria_id_1',
        string $item2Key = 'criteria_id_2'
    ): array {
        $size = count($itemIds);
        $matrix = array_fill(0, $size, array_fill(0, $size, 1));
        
        // Create index mapping
        $indexMap = array_flip(array_values($itemIds));
        
        foreach ($comparisons as $comparison) {
            $id1 = $comparison->$item1Key;
            $id2 = $comparison->$item2Key;
            $value = $comparison->comparison_value;
            
            if (isset($indexMap[$id1]) && isset($indexMap[$id2])) {
                $i = $indexMap[$id1];
                $j = $indexMap[$id2];
                
                $matrix[$i][$j] = $value;
                $matrix[$j][$i] = $value > 0 ? 1 / $value : 1;
            }
        }
        
        return $matrix;
    }
    
    /**
     * Calculate geometric mean of multiple matrices (for group consensus).
     *
     * @param array $matrices - Array of matrices from different DMs
     * @return array - Aggregated matrix using geometric mean
     */
    public function aggregateMatricesGeometricMean(array $matrices): array
    {
        if (empty($matrices)) {
            return [];
        }
        
        $size = count($matrices[0]);
        $count = count($matrices);
        $aggregated = [];
        
        for ($i = 0; $i < $size; $i++) {
            $aggregated[$i] = [];
            for ($j = 0; $j < $size; $j++) {
                $product = 1;
                foreach ($matrices as $matrix) {
                    $product *= $matrix[$i][$j];
                }
                $aggregated[$i][$j] = pow($product, 1 / $count);
            }
        }
        
        return $aggregated;
    }
}

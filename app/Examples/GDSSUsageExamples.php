<?php

/**
 * GDSS ANP-Borda System - Usage Examples
 * 
 * This file demonstrates how to use the ANP-Borda controllers
 * in various scenarios.
 */

namespace App\Examples;

use Illuminate\Support\Facades\Http;

class GDSSUsageExamples
{
    protected string $baseUrl = 'http://localhost:8000';
    
    /**
     * Example 1: Complete workflow for a single Decision Maker
     */
    public function example1_SingleDMWorkflow()
    {
        $userId = 1;
        
        // Step 1: Store criteria comparisons
        $criteriaComparisons = [
            'user_id' => $userId,
            'comparisons' => [
                // Cost vs Quality: Cost is moderately more important (3)
                ['criteria_id_1' => 1, 'criteria_id_2' => 2, 'comparison_value' => 3],
                // Cost vs Time: Cost is strongly more important (5)
                ['criteria_id_1' => 1, 'criteria_id_2' => 3, 'comparison_value' => 5],
                // Quality vs Time: Quality is moderately more important (3)
                ['criteria_id_1' => 2, 'criteria_id_2' => 3, 'comparison_value' => 3],
            ]
        ];
        
        $response1 = Http::post("{$this->baseUrl}/api/criteria-comparison/comparisons", $criteriaComparisons);
        echo "Criteria comparisons stored: " . $response1->json('success') . "\n";
        
        // Step 2: Calculate criteria weights
        $response2 = Http::post("{$this->baseUrl}/api/criteria-comparison/calculate-weights", [
            'user_id' => $userId
        ]);
        
        $weights = $response2->json('data.weights');
        echo "Criteria weights calculated:\n";
        foreach ($weights as $weight) {
            echo "  - {$weight['criteria_name']}: {$weight['weight']}\n";
        }
        echo "  - Consistency Ratio: {$response2->json('data.consistency_ratio')}\n";
        
        // Step 3: Store alternative comparisons for each criteria
        $criteria = [1, 2, 3]; // Cost, Quality, Time
        
        foreach ($criteria as $criteriaId) {
            $alternativeComparisons = [
                'user_id' => $userId,
                'criteria_id' => $criteriaId,
                'comparisons' => [
                    // Example: Option A vs Option B, Option C
                    ['alternative_id_1' => 1, 'alternative_id_2' => 2, 'comparison_value' => 4],
                    ['alternative_id_1' => 1, 'alternative_id_2' => 3, 'comparison_value' => 2],
                    ['alternative_id_1' => 2, 'alternative_id_2' => 3, 'comparison_value' => 0.5],
                ]
            ];
            
            Http::post("{$this->baseUrl}/api/alternative-comparison/comparisons", $alternativeComparisons);
            echo "Alternative comparisons stored for criteria {$criteriaId}\n";
        }
        
        // Step 4: Calculate final ANP weights
        $response4 = Http::post("{$this->baseUrl}/api/alternative-comparison/calculate-final-weights", [
            'user_id' => $userId
        ]);
        
        $finalWeights = $response4->json('data.final_weights');
        echo "\nFinal ANP weights:\n";
        foreach ($finalWeights as $weight) {
            echo "  - {$weight['alternative_name']}: {$weight['final_weight']}\n";
        }
    }
    
    /**
     * Example 2: Complete GDSS workflow with multiple DMs
     */
    public function example2_MultiDMConsensusWorkflow()
    {
        $decisionMakers = [1, 2, 3]; // Three DMs
        $criteria = [
            1 => 'Cost',
            2 => 'Quality', 
            3 => 'Delivery Time',
            4 => 'Reliability'
        ];
        $alternatives = [
            1 => 'Supplier A',
            2 => 'Supplier B',
            3 => 'Supplier C',
            4 => 'Supplier D'
        ];
        
        echo "=== GDSS ANP-Borda System - Multiple DM Example ===\n\n";
        
        // Phase 1: Each DM provides criteria comparisons
        echo "Phase 1: Criteria Comparisons\n";
        foreach ($decisionMakers as $dmId) {
            // Simulate different preferences for each DM
            $comparisons = $this->generateCriteriaComparisons($dmId, array_keys($criteria));
            
            Http::post("{$this->baseUrl}/api/criteria-comparison/comparisons", [
                'user_id' => $dmId,
                'comparisons' => $comparisons
            ]);
            
            // Calculate weights
            $response = Http::post("{$this->baseUrl}/api/criteria-comparison/calculate-weights", [
                'user_id' => $dmId
            ]);
            
            echo "DM {$dmId} - CR: {$response->json('data.consistency_ratio')}\n";
        }
        
        // Phase 2: Each DM provides alternative comparisons for each criteria
        echo "\nPhase 2: Alternative Comparisons\n";
        foreach ($decisionMakers as $dmId) {
            foreach (array_keys($criteria) as $criteriaId) {
                $comparisons = $this->generateAlternativeComparisons($dmId, $criteriaId, array_keys($alternatives));
                
                Http::post("{$this->baseUrl}/api/alternative-comparison/comparisons", [
                    'user_id' => $dmId,
                    'criteria_id' => $criteriaId,
                    'comparisons' => $comparisons
                ]);
            }
            
            // Calculate final weights for this DM
            $response = Http::post("{$this->baseUrl}/api/alternative-comparison/calculate-final-weights", [
                'user_id' => $dmId
            ]);
            
            echo "DM {$dmId} - Final weights calculated\n";
        }
        
        // Phase 3: Generate consensus
        echo "\nPhase 3: Consensus Building\n";
        $consensusResponse = Http::post("{$this->baseUrl}/api/consensus/execute-complete");
        
        $results = $consensusResponse->json('data.consensus.consensus_results');
        echo "\nFinal Consensus Ranking:\n";
        foreach ($results as $result) {
            echo sprintf(
                "  %d. %s - %d Borda points\n",
                $result['final_rank'],
                $result['alternative_name'],
                $result['borda_points']
            );
        }
    }
    
    /**
     * Example 3: Retrieve and analyze results
     */
    public function example3_AnalyzeResults()
    {
        echo "=== Result Analysis ===\n\n";
        
        // Get detailed comparison
        $response = Http::get("{$this->baseUrl}/api/consensus/detailed-comparison");
        $comparison = $response->json('data.detailed_comparison');
        
        echo "Alternative Rankings by Each DM:\n";
        foreach ($comparison as $alt) {
            echo "\n{$alt['alternative_name']}:\n";
            foreach ($alt['dm_rankings'] as $dmRank) {
                echo "  - {$dmRank['user_name']}: Rank {$dmRank['rank']}\n";
            }
            echo "  → Final Consensus: Rank {$alt['borda_result']['final_rank']} ({$alt['borda_result']['borda_points']} points)\n";
        }
        
        // Get individual DM rankings
        echo "\n\nIndividual DM Analysis:\n";
        for ($dmId = 1; $dmId <= 3; $dmId++) {
            $response = Http::get("{$this->baseUrl}/api/consensus/dm-rankings/{$dmId}");
            $rankings = $response->json('data.rankings');
            
            echo "\n{$response->json('data.user_name')}:\n";
            foreach ($rankings as $rank) {
                echo "  {$rank['rank']}. {$rank['alternative_name']}\n";
            }
        }
    }
    
    /**
     * Example 4: Using aggregated criteria weights
     */
    public function example4_AggregatedWeights()
    {
        echo "=== Aggregated Criteria Weights (Group Consensus) ===\n\n";
        
        // Get aggregated weights using geometric mean
        $response = Http::get("{$this->baseUrl}/api/criteria-comparison/aggregated-weights");
        
        $data = $response->json('data');
        echo "Based on {$data['number_of_dms']} Decision Makers:\n";
        echo "Consistency Ratio: {$data['consistency_ratio']}\n";
        echo "Is Consistent: " . ($data['is_consistent'] ? 'Yes' : 'No') . "\n\n";
        
        echo "Aggregated Criteria Weights:\n";
        foreach ($data['weights'] as $weight) {
            echo sprintf(
                "  - %s: %.4f (%.1f%%)\n",
                $weight['criteria_name'],
                $weight['weight'],
                $weight['weight'] * 100
            );
        }
    }
    
    /**
     * Example 5: Error handling and validation
     */
    public function example5_ErrorHandling()
    {
        echo "=== Error Handling Examples ===\n\n";
        
        // Example 1: Invalid comparison value
        $response = Http::post("{$this->baseUrl}/api/criteria-comparison/comparisons", [
            'user_id' => 1,
            'comparisons' => [
                ['criteria_id_1' => 1, 'criteria_id_2' => 2, 'comparison_value' => 15] // Invalid: > 9
            ]
        ]);
        
        if (!$response->json('success')) {
            echo "Error: Invalid comparison value\n";
            print_r($response->json('errors'));
        }
        
        // Example 2: Calculate weights without comparisons
        $response = Http::post("{$this->baseUrl}/api/criteria-comparison/calculate-weights", [
            'user_id' => 999 // Non-existent user
        ]);
        
        if (!$response->json('success')) {
            echo "\nError: {$response->json('message')}\n";
        }
        
        // Example 3: High consistency ratio warning
        // This would happen with inconsistent comparisons
        echo "\nNote: If CR > 0.1, you should review your comparisons\n";
    }
    
    /**
     * Example 6: Step-by-step ANP calculation (manual)
     */
    public function example6_ManualCalculation()
    {
        echo "=== Manual ANP Calculation Breakdown ===\n\n";
        
        $userId = 1;
        
        // Get the detailed calculation response
        $response = Http::post("{$this->baseUrl}/api/alternative-comparison/calculate-final-weights", [
            'user_id' => $userId
        ]);
        
        $detailedCalcs = $response->json('data.detailed_calculations');
        
        echo "Detailed ANP Calculation:\n\n";
        foreach ($detailedCalcs as $calc) {
            echo "Criteria: {$calc['criteria_name']}\n";
            echo "  Global Weight: {$calc['criteria_weight']}\n";
            echo "  Consistency Ratio: {$calc['consistency_ratio']}\n";
            echo "  Local Weights:\n";
            
            foreach ($calc['local_weights'] as $lw) {
                echo sprintf(
                    "    - %s: %.4f × %.4f = %.4f\n",
                    $lw['alternative_name'],
                    $lw['local_weight'],
                    $calc['criteria_weight'],
                    $lw['weighted_value']
                );
            }
            echo "\n";
        }
        
        $finalWeights = $response->json('data.final_weights');
        echo "Final Weights (Sum across all criteria):\n";
        foreach ($finalWeights as $fw) {
            echo "  - {$fw['alternative_name']}: {$fw['final_weight']}\n";
        }
    }
    
    /**
     * Helper: Generate sample criteria comparisons
     */
    private function generateCriteriaComparisons(int $dmId, array $criteriaIds): array
    {
        // This would normally come from user input
        // Here we simulate different preferences
        $comparisons = [];
        
        for ($i = 0; $i < count($criteriaIds) - 1; $i++) {
            for ($j = $i + 1; $j < count($criteriaIds); $j++) {
                $comparisons[] = [
                    'criteria_id_1' => $criteriaIds[$i],
                    'criteria_id_2' => $criteriaIds[$j],
                    'comparison_value' => rand(1, 5) // Random for demo
                ];
            }
        }
        
        return $comparisons;
    }
    
    /**
     * Helper: Generate sample alternative comparisons
     */
    private function generateAlternativeComparisons(int $dmId, int $criteriaId, array $alternativeIds): array
    {
        $comparisons = [];
        
        for ($i = 0; $i < count($alternativeIds) - 1; $i++) {
            for ($j = $i + 1; $j < count($alternativeIds); $j++) {
                $comparisons[] = [
                    'alternative_id_1' => $alternativeIds[$i],
                    'alternative_id_2' => $alternativeIds[$j],
                    'comparison_value' => rand(1, 5) // Random for demo
                ];
            }
        }
        
        return $comparisons;
    }
    
    /**
     * Example 7: Comparison value guide
     */
    public function example7_ComparisonValueGuide()
    {
        echo "=== Saaty Scale for Pairwise Comparisons ===\n\n";
        
        $scale = [
            1 => 'Equal importance - Two elements contribute equally',
            2 => 'Weak or slight',
            3 => 'Moderate importance - Experience slightly favors one',
            4 => 'Moderate plus',
            5 => 'Strong importance - Experience strongly favors one',
            6 => 'Strong plus',
            7 => 'Very strong importance - Dominance is demonstrated',
            8 => 'Very, very strong',
            9 => 'Extreme importance - Evidence favoring one is highest possible'
        ];
        
        echo "When comparing Element A to Element B:\n\n";
        foreach ($scale as $value => $description) {
            echo "{$value}: {$description}\n";
        }
        
        echo "\nReciprocals (automatically calculated):\n";
        echo "If A is 3 times more important than B, then B is 1/3 compared to A\n\n";
        
        echo "Example Usage:\n";
        echo "Q: How important is Cost compared to Quality?\n";
        echo "A: Cost is strongly more important → Use value 5\n";
        echo "   (System automatically sets Quality vs Cost = 1/5 = 0.2)\n";
    }
    
    /**
     * Example 8: Complete realistic scenario - Supplier Selection
     */
    public function example8_SupplierSelectionScenario()
    {
        echo "=== Realistic Scenario: Supplier Selection ===\n\n";
        echo "Company needs to select a supplier for manufacturing components\n";
        echo "3 Decision Makers: Purchasing Manager, Quality Manager, Operations Manager\n";
        echo "4 Criteria: Cost, Quality, Delivery Time, Service\n";
        echo "5 Suppliers: A, B, C, D, E\n\n";
        
        // This would be a complete implementation following Example 2
        // but with realistic business scenario data
        
        echo "Step 1: Each manager provides criteria importance...\n";
        echo "  - Purchasing Manager: Cost (0.50), Quality (0.25), Delivery (0.15), Service (0.10)\n";
        echo "  - Quality Manager: Quality (0.50), Cost (0.20), Service (0.20), Delivery (0.10)\n";
        echo "  - Operations Manager: Delivery (0.40), Quality (0.30), Cost (0.20), Service (0.10)\n\n";
        
        echo "Step 2: Each manager evaluates suppliers against each criteria...\n";
        echo "  (This generates local priority vectors for each supplier-criteria pair)\n\n";
        
        echo "Step 3: ANP combines criteria weights with local priorities...\n";
        echo "  Supplier A: 0.342\n";
        echo "  Supplier C: 0.289\n";
        echo "  Supplier B: 0.198\n";
        echo "  Supplier E: 0.102\n";
        echo "  Supplier D: 0.069\n\n";
        
        echo "Step 4: Borda method aggregates rankings...\n";
        echo "  Final Ranking:\n";
        echo "  1. Supplier A (42 Borda points) ← RECOMMENDED\n";
        echo "  2. Supplier C (38 Borda points)\n";
        echo "  3. Supplier B (31 Borda points)\n";
        echo "  4. Supplier E (19 Borda points)\n";
        echo "  5. Supplier D (15 Borda points)\n\n";
        
        echo "Decision: Select Supplier A based on group consensus\n";
    }
}

/**
 * Example Test Script
 * 
 * Run this to test all examples:
 * php artisan tinker
 * >>> $examples = new App\Examples\GDSSUsageExamples();
 * >>> $examples->example1_SingleDMWorkflow();
 */

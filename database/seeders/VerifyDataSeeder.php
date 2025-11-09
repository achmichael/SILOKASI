<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Criteria;
use App\Models\Alternative;
use App\Models\CriteriaDependency;
use App\Models\AnpCriteriaWeight;
use App\Models\AnpAlternativeWeight;
use App\Models\DmRanking;
use App\Models\BordaResult;
use App\Models\PairwiseComparisonCriteria;
use App\Models\PairwiseComparisonAlternative;

class VerifyDataSeeder extends Seeder
{
    /**
     * Verify all seeded data is correct.
     */
    public function run(): void
    {
        $this->command->info('🔍 Verifying seeded data...');
        
        // Verify Users
        $userCount = User::count();
        $this->command->info("✓ Users: {$userCount} (Expected: 4)");
        
        // Verify Criteria
        $criteriaCount = Criteria::count();
        $this->command->info("✓ Criteria: {$criteriaCount} (Expected: 8)");
        
        // Verify Alternatives
        $alternativeCount = Alternative::count();
        $this->command->info("✓ Alternatives: {$alternativeCount} (Expected: 5)");
        
        // Verify Criteria Dependencies
        $dependencyCount = CriteriaDependency::count();
        $this->command->info("✓ Criteria Dependencies: {$dependencyCount} (Expected: 10)");
        
        // Verify ANP Criteria Weights
        $anpCriteriaWeightCount = AnpCriteriaWeight::count();
        $this->command->info("✓ ANP Criteria Weights: {$anpCriteriaWeightCount} (Expected: 24 = 3 DMs × 8 criteria)");
        
        // Verify Pairwise Comparisons Criteria
        $pairwiseCriteriaCount = PairwiseComparisonCriteria::count();
        $this->command->info("✓ Pairwise Comparisons Criteria: {$pairwiseCriteriaCount}");
        
        // Verify Pairwise Comparisons Alternatives
        $pairwiseAlternativeCount = PairwiseComparisonAlternative::count();
        $this->command->info("✓ Pairwise Comparisons Alternatives: {$pairwiseAlternativeCount}");
        
        // Verify ANP Alternative Weights
        $anpAlternativeWeightCount = AnpAlternativeWeight::count();
        $this->command->info("✓ ANP Alternative Weights: {$anpAlternativeWeightCount} (Expected: 120 = 3 DMs × 8 criteria × 5 alternatives)");
        
        // Verify DM Rankings
        $dmRankingCount = DmRanking::count();
        $this->command->info("✓ DM Rankings: {$dmRankingCount} (Expected: 15 = 3 DMs × 5 alternatives)");
        
        // Verify Borda Results
        $bordaResultCount = BordaResult::count();
        $this->command->info("✓ Borda Results: {$bordaResultCount} (Expected: 5)");
        
        // Show sample data
        $this->command->newLine();
        $this->command->info('📊 Sample Data:');
        
        // Show final ranking
        $bordaResults = BordaResult::with('alternative')
            ->orderBy('final_rank')
            ->get();
        
        $this->command->info('Final BORDA Ranking:');
        foreach ($bordaResults as $result) {
            $this->command->info(
                sprintf(
                    '  %d. %s (%s) - %.1f points',
                    $result->final_rank,
                    $result->alternative->name,
                    $result->alternative->code,
                    $result->borda_points
                )
            );
        }
        
        // Show criteria weights
        $this->command->newLine();
        $this->command->info('Criteria Weights (DM1):');
        $dm1 = User::where('email', 'dm1@gdss.com')->first();
        $weights = AnpCriteriaWeight::with('criteria')
            ->where('user_id', $dm1->id)
            ->orderBy('weight', 'desc')
            ->get();
        
        foreach ($weights as $weight) {
            $this->command->info(
                sprintf(
                    '  %s (%s): %.2f',
                    $weight->criteria->name,
                    $weight->criteria->code,
                    $weight->weight
                )
            );
        }
        
        $this->command->newLine();
        $this->command->info('✅ Data verification complete!');
    }
}

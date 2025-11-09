<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PairwiseComparisonAlternative;
use App\Models\Alternative;
use App\Models\Criteria;
use App\Models\User;

class PairwiseComparisonsAlternativesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $decisionMakers = User::where('role', 'dm')->get();
        $alternatives = Alternative::all();
        $criteria = Criteria::all();

        // Sample pairwise comparison values for consistency
        // These are example values - in real scenario, these would come from actual DM assessments
        $sampleValues = [
            1 => [1, 3, 5, 2, 4],
            2 => [1/3, 1, 3, 2, 3],
            3 => [1/5, 1/3, 1, 1/2, 2],
            4 => [1/2, 1/2, 2, 1, 3],
            5 => [1/4, 1/3, 1/2, 1/3, 1],
        ];

        foreach ($decisionMakers as $dmIndex => $dm) {
            foreach ($criteria as $criterion) {
                foreach ($alternatives as $i => $alt1) {
                    foreach ($alternatives as $j => $alt2) {
                        if ($i < $j) { // Only store upper triangular matrix
                            // Use sample values with slight variations per DM
                            $baseValue = $sampleValues[$i + 1][$j];
                            $variation = 1 + (($dmIndex % 3) - 1) * 0.1; // Slight variation per DM
                            $value = $baseValue * $variation;
                            
                            PairwiseComparisonAlternative::create([
                                'user_id' => $dm->id,
                                'criteria_id' => $criterion->id,
                                'alternative_id_1' => $alt1->id,
                                'alternative_id_2' => $alt2->id,
                                'comparison_value' => round($value, 2),
                            ]);
                        }
                    }
                }
            }
        }
    }
}

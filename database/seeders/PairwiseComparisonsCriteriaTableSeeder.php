<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PairwiseComparisonCriteria;
use App\Models\Criteria;
use App\Models\User;

class PairwiseComparisonsCriteriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $decisionMakers = User::where('role', 'dm')->get();
        $criteria = Criteria::all();

        // Sample pairwise comparison values for criteria (8x8 matrix upper triangular)
        // These values should be consistent and from actual expert judgment
        $sampleComparisons = [
            ['KT', 'BB', 2.0],
            ['KT', 'LL', 3.0],
            ['KT', 'LPD', 0.5],
            ['KT', 'ST', 1.0],
            ['KT', 'BPT', 0.5],
            ['KT', 'SPL', 2.0],
            ['KT', 'VM', 5.0],
            ['BB', 'LL', 2.0],
            ['BB', 'LPD', 0.33],
            ['BB', 'ST', 1.0],
            ['BB', 'BPT', 0.5],
            ['BB', 'SPL', 1.0],
            ['BB', 'VM', 4.0],
            ['LL', 'LPD', 0.25],
            ['LL', 'ST', 0.5],
            ['LL', 'BPT', 0.25],
            ['LL', 'SPL', 0.5],
            ['LL', 'VM', 2.0],
            ['LPD', 'ST', 3.0],
            ['LPD', 'BPT', 2.0],
            ['LPD', 'SPL', 4.0],
            ['LPD', 'VM', 7.0],
            ['ST', 'BPT', 1.0],
            ['ST', 'SPL', 2.0],
            ['ST', 'VM', 5.0],
            ['BPT', 'SPL', 2.0],
            ['BPT', 'VM', 6.0],
            ['SPL', 'VM', 4.0],
        ];

        foreach ($decisionMakers as $dmIndex => $dm) {
            foreach ($sampleComparisons as $comparison) {
                $criteria1 = Criteria::where('code', $comparison[0])->first();
                $criteria2 = Criteria::where('code', $comparison[1])->first();
                
                if ($criteria1 && $criteria2) {
                    // Add slight variation per DM for realism
                    $variation = 1 + (($dmIndex % 3) - 1) * 0.15;
                    $value = $comparison[2] * $variation;
                    
                    PairwiseComparisonCriteria::create([
                        'user_id' => $dm->id,
                        'criteria_id_1' => $criteria1->id,
                        'criteria_id_2' => $criteria2->id,
                        'comparison_value' => round($value, 2),
                    ]);
                }
            }
        }
    }
}

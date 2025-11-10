<?php
namespace Database\Seeders;

use App\Models\Criteria;
use App\Models\PairwiseComparisonCriteria;
use App\Models\User;
use Illuminate\Database\Seeder;

class PairwiseComparisonsCriteriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $decisionMakers = User::where('role', 'dm')->get();
        $criteria       = Criteria::all();

        // Sample pairwise comparison values for criteria (8x8 matrix upper triangular)
        // These values should be consistent and from actual expert judgment
        $sampleComparisons = [
            ['KT', 'BB', 1],
            ['KT', 'LL', 3],
            ['KT', 'LPD', 3],
            ['KT', 'ST', 3],
            ['KT', 'BPT', 4],
            ['KT', 'SPL', 5],
            ['KT', 'VM', 3],

            ['BB', 'LL', 5],
            ['BB', 'LPD', 7],
            ['BB', 'ST', 2],
            ['BB', 'BPT', 7],
            ['BB', 'SPL', 5],
            ['BB', 'VM', 5],

            ['LL', 'LPD', 2],
            ['LL', 'ST', 3],
            ['LL', 'BPT', 4],
            ['LL', 'SPL', 2],
            ['LL', 'VM', 2],

            ['LPD', 'ST', 1],
            ['LPD', 'BPT', 2],
            ['LPD', 'SPL', 3],
            ['LPD', 'VM', 3],

            ['ST', 'BPT', 4],
            ['ST', 'SPL', 3],
            ['ST', 'VM', 5],

            ['BPT', 'SPL', 2],
            ['BPT', 'VM', 3],

            ['SPL', 'VM', 2],
        ];

        foreach ($decisionMakers as $dmIndex => $dm) {
            foreach ($sampleComparisons as $comparison) {
                $criteria1 = Criteria::where('code', $comparison[0])->first();
                $criteria2 = Criteria::where('code', $comparison[1])->first();

                if ($criteria1 && $criteria2) {
                    // Add slight variation per DM for realism
                    $variation = 1 + (($dmIndex % 3) - 1) * 0.15;
                    $value     = $comparison[2] * $variation;

                    PairwiseComparisonCriteria::create([
                        'user_id'          => $dm->id,
                        'criteria_id_1'    => $criteria1->id,
                        'criteria_id_2'    => $criteria2->id,
                        'comparison_value' => round($value, 2),
                    ]);
                }
            }
        }
    }
}

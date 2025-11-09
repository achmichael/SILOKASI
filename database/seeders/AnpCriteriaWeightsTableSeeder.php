<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AnpCriteriaWeight;
use App\Models\Criteria;
use App\Models\User;

class AnpCriteriaWeightsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $weights = [
            'KT' => 0.06,
            'BB' => 0.05,
            'LL' => 0.02,
            'LPD' => 0.26,
            'ST' => 0.09,
            'BPT' => 0.12,
            'SPL' => 0.05,
            'VM' => 0.01,
        ];

        // Get all decision makers (user_id 2, 3, 4)
        $decisionMakers = User::where('role', 'dm')->get();

        foreach ($decisionMakers as $dm) {
            foreach ($weights as $code => $weight) {
                $criteria = Criteria::where('code', $code)->first();
                
                if ($criteria) {
                    AnpCriteriaWeight::create([
                        'user_id' => $dm->id,
                        'criteria_id' => $criteria->id,
                        'weight' => $weight,
                    ]);
                }
            }
        }
    }
}

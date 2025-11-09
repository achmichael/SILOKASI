<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CriteriaDependency;
use App\Models\Criteria;

class CriteriaDependenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dependencies = [
            ['from' => 'BB', 'to' => 'LPD', 'value' => 3.0],
            ['from' => 'LL', 'to' => 'LPD', 'value' => 2.0],
            ['from' => 'VM', 'to' => 'LPD', 'value' => 3.0],
            ['from' => 'ST', 'to' => 'LPD', 'value' => 4.0],
            ['from' => 'BB', 'to' => 'SPL', 'value' => 2.0],
            ['from' => 'ST', 'to' => 'SPL', 'value' => 3.0],
            ['from' => 'KT', 'to' => 'BPT', 'value' => 3.0],
            ['from' => 'LL', 'to' => 'BPT', 'value' => 4.0],
            ['from' => 'ST', 'to' => 'BPT', 'value' => 2.0],
            ['from' => 'SPL', 'to' => 'ST', 'value' => 2.0],
        ];

        foreach ($dependencies as $dependency) {
            $fromCriteria = Criteria::where('code', $dependency['from'])->first();
            $toCriteria = Criteria::where('code', $dependency['to'])->first();

            if ($fromCriteria && $toCriteria) {
                CriteriaDependency::create([
                    'criteria_id_from' => $fromCriteria->id,
                    'criteria_id_to' => $toCriteria->id,
                    'dependency_value' => $dependency['value'],
                ]);
            }
        }
    }
}

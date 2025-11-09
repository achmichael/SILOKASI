<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BordaResult;
use App\Models\Alternative;

class BordaResultsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $results = [
            ['alternative' => 'A3', 'rank' => 1, 'points' => 8.4],
            ['alternative' => 'A1', 'rank' => 2, 'points' => 7.5],
            ['alternative' => 'A2', 'rank' => 3, 'points' => 3.8],
            ['alternative' => 'A4', 'rank' => 4, 'points' => 3.2],
            ['alternative' => 'A5', 'rank' => 5, 'points' => 3.1],
        ];

        foreach ($results as $result) {
            $alternative = Alternative::where('code', $result['alternative'])->first();
            
            if ($alternative) {
                BordaResult::create([
                    'alternative_id' => $alternative->id,
                    'final_rank' => $result['rank'],
                    'borda_points' => $result['points'],
                ]);
            }
        }
    }
}

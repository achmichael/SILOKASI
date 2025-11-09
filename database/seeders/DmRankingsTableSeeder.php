<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DmRanking;
use App\Models\Alternative;
use App\Models\User;

class DmRankingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Rankings from journal Table 10
        $rankings = [
            'DM1' => [
                'A1' => 1,
                'A2' => 5,
                'A3' => 3,
                'A4' => 2,
                'A5' => 4,
            ],
            'DM2' => [
                'A1' => 2,
                'A2' => 4,
                'A3' => 1,
                'A4' => 3,
                'A5' => 5,
            ],
            'DM3' => [
                'A1' => 2,
                'A2' => 3,
                'A3' => 1,
                'A4' => 4,
                'A5' => 5,
            ],
        ];

        $decisionMakers = User::where('role', 'dm')->get();

        foreach ($decisionMakers as $index => $dm) {
            $dmKey = 'DM' . ($index + 1);
            
            foreach ($rankings[$dmKey] as $altCode => $rank) {
                $alternative = Alternative::where('code', $altCode)->first();
                
                if ($alternative) {
                    DmRanking::create([
                        'user_id' => $dm->id,
                        'alternative_id' => $alternative->id,
                        'rank' => $rank,
                    ]);
                }
            }
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AnpAlternativeWeight;
use App\Models\Alternative;
use App\Models\User;


class AnpAlternativeWeightsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Alternative weights per DM (normalized values)
        $weights = [
            'DM1' => [
                'A1' => 0.22,
                'A2' => 0.19,
                'A3' => 0.25,
                'A4' => 0.18,
                'A5' => 0.16,
            ],
            'DM2' => [
                'A1' => 0.18,
                'A2' => 0.17,
                'A3' => 0.30,
                'A4' => 0.20,
                'A5' => 0.15,
            ],
            'DM3' => [
                'A1' => 0.20,
                'A2' => 0.18,
                'A3' => 0.27,
                'A4' => 0.19,
                'A5' => 0.16,
            ],
        ];

        $decisionMakers = User::where('role', 'dm')->get();

        foreach ($decisionMakers as $index => $dm) {
            $dmKey = 'DM' . ($index + 1);
            
            foreach ($weights[$dmKey] as $altCode => $weight) {
                $alternative = Alternative::where('code', $altCode)->first();
                
                if ($alternative) {
                    AnpAlternativeWeight::create([
                        'user_id' => $dm->id,
                        'alternative_id' => $alternative->id,
                        'weight' => $weight,
                    ]);
                }
            }
        }
    }
}

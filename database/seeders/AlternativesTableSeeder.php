<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alternative;

class AlternativesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $alternatives = [
            [
                'code' => 'A1',
                'name' => 'Gentan',
                'description' => 'Lokasi Gentan',
            ],
            [
                'code' => 'A2',
                'name' => 'Palur Raya',
                'description' => 'Lokasi Palur Raya',
            ],
            [
                'code' => 'A3',
                'name' => 'Bekonang',
                'description' => 'Lokasi Bekonang',
            ],
            [
                'code' => 'A4',
                'name' => 'Makamhaji',
                'description' => 'Lokasi Makamhaji',
            ],
            [
                'code' => 'A5',
                'name' => 'Baturetno',
                'description' => 'Lokasi Baturetno',
            ],
        ];

        foreach ($alternatives as $alternative) {
            Alternative::create($alternative);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Criteria;

class CriteriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $criteria = [
            [
                'code' => 'KT',
                'name' => 'Kondisi Tanah',
                'description' => 'Kelayakan struktur tanah untuk konstruksi',
            ],
            [
                'code' => 'BB',
                'name' => 'Bebas Banjir',
                'description' => 'Risiko banjir di area tersebut',
            ],
            [
                'code' => 'LL',
                'name' => 'Luas Lahan',
                'description' => 'Ukuran area yang tersedia untuk pembangunan',
            ],
            [
                'code' => 'LPD',
                'name' => 'Prospek Pengembangan ke Depan',
                'description' => 'Potensi pengembangan kawasan di masa depan',
            ],
            [
                'code' => 'ST',
                'name' => 'Status Tanah',
                'description' => 'Legalitas kepemilikan atau izin lahan',
            ],
            [
                'code' => 'BPT',
                'name' => 'Biaya Pematangan Tanah',
                'description' => 'Biaya penyiapan lahan agar layak bangun',
            ],
            [
                'code' => 'SPL',
                'name' => 'Kesesuaian dengan Peruntukan Lahan',
                'description' => 'Kesesuaian dengan tata ruang kota',
            ],
            [
                'code' => 'VM',
                'name' => 'Pemandangan Menarik',
                'description' => 'Nilai estetika dan kenyamanan lingkungan',
            ],
        ];

        foreach ($criteria as $criterion) {
            Criteria::create($criterion);
        }
    }
}

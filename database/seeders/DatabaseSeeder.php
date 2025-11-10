<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            CriteriaTableSeeder::class,
            CriteriaDependenciesTableSeeder::class,
            PairwiseComparisonsCriteriaTableSeeder::class,
            AnpCriteriaWeightsTableSeeder::class,
            AlternativesTableSeeder::class,
            PairwiseComparisonsAlternativesTableSeeder::class,
            AnpAlternativeWeightsTableSeeder::class,
            DmRankingsTableSeeder::class,
            BordaResultsTableSeeder::class,
        ]);

        $this->command->info('GDSS ANP-BORDA database seeded successfully!');
    }
}

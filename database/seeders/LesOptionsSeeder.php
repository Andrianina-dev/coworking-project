<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LesOptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insérer des données de test
        DB::table('lesOptions')->insert([
            [
                'nomOption' => 'imprimante',
                'prixOption' => 50.00, // Exemple de prix
            ],
            [
                'nomOption' => 'videoprojecteur',
                'prixOption' => 100.00, // Exemple de prix
            ],
            [
                'nomOption' => 'laptop',
                'prixOption' => 800.00, // Exemple de prix
            ],
            [
                'nomOption' => 'appareil photo',
                'prixOption' => 300.00, // Exemple de prix
            ],
        ]);
    }
}

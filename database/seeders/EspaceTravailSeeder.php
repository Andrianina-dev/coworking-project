<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EspaceTravailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('espaceTravail')->insert([
            'nomEspaceTravail' => 'Espace 1',
            'prixEspaceTravail' => 50.00,
        ]);

        DB::table('espaceTravail')->insert([
            'nomEspaceTravail' => 'Espace 2',
            'prixEspaceTravail' => 75.50,
        ]);

        DB::table('espaceTravail')->insert([
            'nomEspaceTravail' => 'Espace 3',
            'prixEspaceTravail' => 100.00,
        ]);

        // Ajout de l'Espace 4
        DB::table('espaceTravail')->insert([
            'nomEspaceTravail' => 'Espace 4',
            'prixEspaceTravail' => 120.00, // Exemple de prix pour l'Espace 4
        ]);
    }
}

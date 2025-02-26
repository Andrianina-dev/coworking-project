<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JourFeriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insérer des données de test
        DB::table('jourFeries')->insert([
            [
                'mois' => 1,  // Janvier
                'jour' => 1,  // 1er janvier
            ],
            [
                'mois' => 5,  // Mai
                'jour' => 1,  // 1er mai
            ],
            [
                'mois' => 2,  // Février
                'jour' => 14, // 14 février
            ],
            [
                'mois' => 8,  // Août
                'jour' => 15, // 15 août
            ],
            [
                'mois' => 11, // Novembre
                'jour' => 1,  // 1er novembre
            ],
            [
                'mois' => 12, // Décembre
                'jour' => 25, // 25 décembre
            ],
            [
                'mois' => 3,  // Mars
                'jour' => 29, // 29 mars
            ],
            [
                'mois' => 6,  // Juin
                'jour' => 26, // 26 juin
            ],
        ]);
    }
}

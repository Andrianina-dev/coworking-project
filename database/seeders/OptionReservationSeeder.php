<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OptionReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insérer des données de test spécifiques
        DB::table('optionReservation')->insert([
            [
                'refReservation' => 'r001', // Utilisez un ID de réservation existant
                'idlesOptions' => 1, // Option 1
            ],
            [
                'refReservation' => 'r001', // Utilisez un ID de réservation existant
                'idlesOptions' => 3, // Option 2
            ],
            [
                'refReservation' => 'r002', // Utilisez un ID de réservation existant
                'idlesOptions' => null, // Option 3
            ],
            [
                'refReservation' => 'r002', // Utilisez un ID de réservation existant
                'idlesOptions' => 3, // Option 4
            ],
        ]);
    }
}

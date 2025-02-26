<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttentePaiementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insérer des données de test
        DB::table('attentePaiement')->insert([
            [
                'referencePaiement' => 'PAY001',
                'idReservation' => 'r001', // Utilisez un ID de réservation existant
                'datePaiement' => now(), // Date actuelle
            ],
            [
                'referencePaiement' => 'PAY002',
                'idReservation' => 'r002', // Utilisez un ID de réservation existant
                'datePaiement' => now(), // Date actuelle
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insérer des données de test
        DB::table('reservation')->insert([
            [
                // 'idReservation' est généré par le trigger
                'idClient' => 1, // Utilisez un ID client existant (1, 2 ou 3)
                'idEspaceTravail' => 1, // Utilisez un ID espaceTravail existant
                'heureDebut' => 9,
                'heureFin' => 12,
                'duree' => 3,
                'id_status' => 3, // Utilisez un ID statut existant
                'dates' => '2025-10-15',
                'idClientConnectez' => 1, // Utilisez un ID client existant
            ],
            [
                // 'idReservation' est généré par le trigger
                'idClient' => 2, // Utilisez un ID client existant (1, 2 ou 3)
                'idEspaceTravail' => 2, // Utilisez un ID espaceTravail existant
                'heureDebut' => 14,
                'heureFin' => 16,
                'duree' => 2,
                'id_status' => 1, // Utilisez un ID statut existant
                'dates' => '2025-10-16',
                'idClientConnectez' => 2, // Utilisez un ID client existant
            ],
            [
                // 'idReservation' est généré par le trigger
                'idClient' => 1, // Utilisez un ID client existant (1, 2 ou 3)
                'idEspaceTravail' => 3, // Utilisez un ID espaceTravail existant
                'heureDebut' => 10,
                'heureFin' => 13,
                'duree' => 3,
                'id_status' => 2, // Utilisez un ID statut existant
                'dates' => '2025-10-17',
                'idClientConnectez' => 3, // Utilisez un ID client existant
            ],
        ]);
    }
}

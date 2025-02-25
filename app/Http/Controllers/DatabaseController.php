<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DatabaseController extends Controller
{
    /**
     * Efface toutes les données des tables spécifiées.
     */
    public function deletedBaseExceptAdmin()
    {
        try {
            // Désactiver temporairement les clés étrangères
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            // Liste des tables à effacer
            $tablesToTruncate = [
                'clientcoworker',
                'attentepaiement',
                'espacetravail',
                'lesoptions',
                'reservation',
                'optionreservation',
                'reservationcsv'
            ];

            // Vider les tables spécifiées
            foreach ($tablesToTruncate as $table) {
                DB::table($table)->truncate();
            }

            // Réactiver les clés étrangères
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            // Redirection vers la vue "success"
            return view('frontOffice.sucess.baseDeleted');
        } catch (\Exception $e) {
            // Redirection vers la vue "error"
            return view('frontOffice.sucess.baseDeletedError');
        }
    }
}


?>

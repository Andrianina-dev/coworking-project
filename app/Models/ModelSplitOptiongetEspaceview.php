<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ModelSplitOptiongetEspaceview extends Model
{
    // Définir que ce modèle est lié à la vue `splitoptiongetespaceview`
    protected $table = 'splitoptiongetespaceview';

    // Si vous n'avez pas de colonnes `created_at` et `updated_at`, désactiver ces timestamps
    public $timestamps = false;

    /**
     * Fonction pour obtenir toutes les données de la vue
     *
     * @return \Illuminate\Support\Collection
     */

     public static function getDureePersonne($date)
     {
        $query = "SELECT SUM(duree) as totalDuree,dates from splitoptiongetespaceview where dates=? GROUP BY dates";
        return DB::select($query, [$date]);
     }
    public static function getSplitOption()
    {
        $query = "SELECT * FROM splitoptiongetespaceview";
        return DB::select($query);
    }

    /**
     * Fonction pour obtenir les données par numéro de téléphone
     *
     * @param string $numeroPhone
     * @return \Illuminate\Support\Collection
     */
    public static function getByPhoneNumber($numeroPhone)
    {
        $query = "
            SELECT *
            FROM splitoptiongetespaceview
            WHERE `numeroTelephoneClient` = ?
        ";

        return DB::select($query, [$numeroPhone]);
    }

    /**
     * Fonction pour obtenir les données par référence de réservation
     *
     * @param string $refReservation
     * @return \Illuminate\Support\Collection
     */
    public static function getByRefReservation($refReservation)
    {
        $query = "
            SELECT *
            FROM splitoptiongetespaceview
            WHERE `refReservation` = ?
        ";

        return DB::select($query, [$refReservation]);
    }

    /**
     * Fonction pour obtenir le chiffre d'affaires journalier pour une date spécifique
     *
     * @param string $date La date pour laquelle on veut le chiffre d'affaires (format 'YYYY-MM-DD')
     * @return \Illuminate\Support\Collection
     */
    public static function chiffreAffaireJournalier($datedeb,$dateFin)
    {
        $query = "
        SELECT
            dates,
            SUM(totalPrice) AS totalSumPrice
        FROM splitoptiongetespaceview
        WHERE dates BETWEEN ? AND ?
        AND id_status IN (2, 5)
        GROUP BY dates

        ";

        return DB::select($query, [$datedeb,$dateFin]);
    }

    /**
     * Fonction pour obtenir les données filtrées par id_status
     *
     * @param int $idStatus L'ID du statut à filtrer
     * @return \Illuminate\Support\Collection
     */
    public static function filterPayeeNonPayee($idStatus)
{
    $query = "
        SELECT id_status, SUM(totalPrice) AS filtreReservation
        FROM splitoptiongetespaceview
        WHERE id_status = ?
        GROUP BY id_status
    ";

    return DB::select($query, [$idStatus]);
}
public static function getReservationsBetweenDates($startDate, $endDate)
{

        // Exécute la requête SQL brute avec DB::select
        $reservations = DB::select("
            SELECT *
            FROM splitoptiongetespaceview
            WHERE dates >= ?
              AND dates <= ?
        ", [$startDate, $endDate]);

        return $reservations;
}
}

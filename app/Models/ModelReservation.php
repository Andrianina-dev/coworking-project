<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ModelReservation extends Model
{
    use HasFactory;

    protected $table = 'reservation';
    protected $primaryKey = 'idReservation';
    public $incrementing = false;  // Car idReservation est généré par le trigger (non auto-incrémenté)
    public $timestamps = false;    // On désactive les timestamps si tu ne les utilises pas
    protected $keyType = 'string'; // Si idReservation est une chaîne (UUID)

    protected $fillable = [
        'idReservation',
        'idClient',
        'idespaceTravail',
        'heureDebut',
        'heureFin',
        'duree',
        'id_status',
        'dates',
        'idclientConnectez',
    ];

    /**
     * Insérer une réservation et récupérer l'idReservation généré par le trigger.
     *
     * @param int $idClient
     * @param int $idespaceTravail
     * @param string $heureDebut
     * @param string $heureFin
     * @param int $duree
     * @param int $idStatus
     * @param string $dates
     * @param int $idClientConnectez
     * @return string|null
     */
    public static function insererResa($idClient, $idespaceTravail, $heureDebut, $heureFin, $duree, $idStatus, $dates, $idClientConnectez)
    {
        try {
            // Création de la réservation sans préciser 'idReservation'
            self::create([
                'idClient' => $idClient,
                'idespaceTravail' => $idespaceTravail,
                'heureDebut' => $heureDebut,
                'heureFin' => $heureFin,
                'duree' => $duree,
                'id_status' => $idStatus,
                'dates' => $dates,
                'idclientConnectez' => $idClientConnectez,
            ]);

            // Récupérer l'ID généré par le trigger (le plus récent)
            $idReservation = DB::table('reservation')->max('idReservation');

            return $idReservation;

        } catch (\Exception $e) {
            Log::error("Erreur d'insertion de réservation: " . $e->getMessage());
            return null;  // Retourne null en cas d'erreur
        }
    }

    /**
     * Insère une option de réservation liée à une réservation spécifique.
     *
     * @param string $reservationId
     * @param int $optionId
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function insertOptionReservation($reservationId, $optionId)
    {
        // Insertion dans la table optionreservation en utilisant 'idReservation' comme clé étrangère
        return self::create([
            'refReservation' => $reservationId,  // Utilise 'idReservation' comme clé étrangère
            'idlesOptions' => $optionId  // ID de l'option
        ]);
    }


    public static function verifierConflitResa($dates, $heureDebut, $duree, $idespaceTravail)
    {
        try {
            // Calcul de l'heure de fin
            $heureFin = $heureDebut + $duree;
            $result = DB::select(
                'SELECT COUNT(*) as count
                 FROM reservation
                 WHERE dates = ?
                   AND idEspaceTravail = ?
                   AND (
                        (heureDebut < ? AND heureFin > ?) -- La réservation existante englobe la nouvelle
                        OR
                        (heureDebut >= ? AND heureDebut < ?) -- La nouvelle réservation commence dans une existante
                        OR
                        (heureFin > ? AND heureFin <= ?) -- La nouvelle réservation se termine dans une existante
                   )',
                [$dates, $idespaceTravail, $heureFin, $heureDebut, $heureDebut, $heureFin, $heureDebut, $heureFin]
            );

            // Vérification du nombre de conflits
            return !empty($result) && $result[0]->count > 0;
        } catch (\Exception $e) {
            Log::error("Erreur de vérification de conflit de réservation: " . $e->getMessage());
            return false; // Retourne false en cas d'erreur
        }
    }


    public static function annulezResa($idReservation)
{
    // Utiliser DB::delete pour exécuter une requête de suppression brute
    DB::delete('DELETE FROM reservation WHERE idReservation = ?', [$idReservation]);

    return "Réservation annulée avec succès.";
}

/**
 * Récupère toutes les réservations entre deux dates spécifiques en utilisant DB.
 *
 * @param string $startDate La date de début au format 'YYYY-MM-DD'
 * @param string $endDate La date de fin au format 'YYYY-MM-DD'
 * @return array
 */

}

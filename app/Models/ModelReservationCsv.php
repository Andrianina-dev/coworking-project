<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ModelReservationCsv extends Model
{
    protected $table = 'reservationcsv'; // Nom de la table
    protected $primaryKey = 'idReservationCsv'; // Clé primaire
    public $timestamps = false; // Désactive created_at et updated_at si non utilisés

    protected $fillable = [
        'refs',
        'espace',
        'clients',
        'dates',
        'heureDebut',
        'duree',
        'theOptions',
    ];

    /**
     * Fonction pour insérer des données dans la table reservation
     */
    public static function insertIntoReservation()
    {
        // Exécution de la requête pour insérer les données dans la table reservation avec jointures
        DB::statement("
            INSERT INTO reservation(`idReservation`, `idClient`, `idespaceTravail`, `heureDebut`, `heureFin`, `duree`, `dates`)
            SELECT
                r.refs,
                c.idClient,
                e.idEspaceTravail,
                HOUR(r.heureDebut) AS `heureDebut`,  -- Convertir l'heure en entier (ex: 14:00:00 -> 14)
                HOUR(r.heureDebut) + r.duree AS `heureFin`,  -- Additionner la durée en heures
                r.duree,  -- Valeur par défaut de durée
                r.dates
            FROM reservationcsv r
            JOIN clientcoworker c ON c.numeroTelephoneClient = r.clients  -- Vérification par numéro de téléphone
            JOIN espacetravail e ON e.nomEspaceTravail = r.espace;  -- Vérification par nomEspaceTravail
        ");
    }

    /**
     * Fonction pour insérer les numéros de téléphone distincts des clients dans la table clientcoworker.
     */
    public static function insertDistinctClients()
    {
        // Requête pour insérer les numéros distincts des clients dans la table clientcoworker
        DB::statement("
            INSERT INTO clientcoworker (numeroTelephoneClient)
            SELECT DISTINCT(clients)
            FROM reservationcsv
        ");
    }
}
?>

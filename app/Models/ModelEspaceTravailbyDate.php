<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ModelEspaceTravailbyDate extends Model
{
    use HasFactory;

    // Nom de la table (ou vue)
    protected $table = 'getespacetravailbydateview';

    // Pas de clé primaire car c'est une vue
    protected $primaryKey = null;

    // Pas d'incrémentation automatique
    public $incrementing = false;

    // Désactiver les timestamps
    public $timestamps = false;

    /**
     * Récupérer toutes les données de la vue.
     *
     * @return array
     */
    public static function getPaiementAttentEspaceTravail()
    {
        $query = "SELECT * FROM getespacetravailbydateview";
        return DB::select($query);
    }

    /**
     * Récupérer les réservations filtrées par statut.
     *
     * @param string $status
     * @return array
     */

     public static function getEspaceTravailbyClient()
     {
        $query = "SELECT * FROM getespacetravailbydateview";
        return $query;
     }
    public static function getReservationsByStatus($status)
    {
        $query = "SELECT * FROM getespacetravailbydateview WHERE nomStatut = :status";
        return DB::select($query, ['status' => $status]);
    }

    /**
     * Récupérer les réservations pour une date donnée.
     *
     * @param string $date
     * @return array
     */
    public static function getReservationsByDate($date)
    {
        $query = "SELECT idEspaceTravail,
                        nomEspaceTravail,
                        prixEspaceTravail,
                        idReservation,
                        idClient,
                        nomClient,
                        numeroTelephoneClient,
                        id_status,
                        nomStatut,
                        heureDebut,
                        heureFin,
                        codes,
                        idlesOptions,
                        nomOption,
                        prixOption,
                        duree,
                        dates,
                        disponibilite
                  FROM getespacetravailbydateview
                  WHERE dates = ?";
        return DB::select($query, [$date]);
    }

    /**
     * Récupérer les réservations par numéro de téléphone.
     *
     * @param string $numeroTel
     * @return array
     */

     public static function getReservationEspaceTravailNum($numeroTel)
    {
        $query = "SELECT * FROM getespacetravailbydateview WHERE numeroTelephoneCLient = ?";
        return DB::select($query, [$numeroTel]);
    }

    public static function getReservationbyidResa($idResa)
    {
        $query = "SELECT * FROM getespacetravailbydateview WHERE idReservation = ?";
        return DB::select($query, [$idResa]);
    }

    public static function getAllResaPerson($date)
    {
        $query = "SELECT *
                  FROM getEspaceTravailbyDateView
                  WHERE `dates` = :date
                    AND `idClient` != `idclientConnectez`";
        return DB::select($query, ['date' => $date]);
    }

}

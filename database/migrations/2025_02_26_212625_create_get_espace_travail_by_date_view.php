<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        DB::statement("
            CREATE OR REPLACE VIEW getEspaceTravailbyDateView AS
            SELECT
                ebr.`idReservation`,                -- Référence de la réservation
                et.`idEspaceTravail`,                -- ID de l'espace de travail
                et.`nomEspaceTravail`,               -- Nom de l'espace de travail
                et.`prixEspaceTravail`,
                ebr.`idclientConnectez`,           -- Prix de l'espace de travail
                ebr.`idClient`,                      -- ID du client
                ebr.`nomClient`,                     -- Nom du client
                ebr.`numeroTelephoneClient`,         -- Numéro de téléphone du client
                ebr.`id_status`,                     -- ID du statut de la réservation
                ebr.`nomStatut`,                     -- Nom du statut de la réservation
                ebr.`heureDebut`,                    -- Heure de début de la réservation
                ebr.`heureFin`,                      -- Heure de fin de la réservation
                lesOptions.`codes`,                 -- Code de l'option
                lesOptions.`idlesOptions`,          -- ID de l'option
                lesOptions.`nomOption`,             -- Nom de l'option
                lesOptions.`prixOption`,            -- Prix de l'option
                ebr.`duree`,                         -- Durée de la réservation
                ebr.`dates`,                         -- Date de la réservation
                CASE
                    WHEN ebr.`id_status` IS NULL THEN 0 -- Aucune réservation
                    WHEN ebr.`id_status` = 1 THEN 0 -- Réservation avec id_status = 1 (non confirmée)
                    WHEN ebr.`id_status` = 2 THEN 2 -- Réservation avec id_status = 2 (réservée)
                    WHEN ebr.`id_status` = 3 THEN 1 -- Réservation avec id_status = 3 (confirmée)
                    ELSE 0 -- Autres cas par défaut
                END AS `disponibilite`               -- Disponibilité de l'espace
            FROM espaceTravail AS et
            LEFT JOIN espaceTravailbyDate AS ebr ON et.`idEspaceTravail` = ebr.`idespaceTravail`
            LEFT JOIN optionReservation AS optr ON optr.`refReservation` = ebr.`idReservation`
            LEFT JOIN lesOptions ON lesOptions.`idlesOptions` = optr.`idlesOptions`;
        ");
    }

    /**
     * Annule la migration (suppression de la vue).
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS getEspaceTravailbyDateView");
    }
};

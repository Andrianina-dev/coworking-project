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
CREATE or REPLACE VIEW splitOptiongetEspaceview as
SELECT
    optr.`refReservation`,
    ebr.`idClient`,
    ebr.`nomClient`,
    ebr.`idclientConnectez`,
    c.`nomClient` AS nomClientConnecte,
    ebr.`numeroTelephoneClient`,
    ebr.`idespaceTravail`,
    ebr.`nomEspaceTravail`,
    ebr.`prixEspaceTravail`,
    ebr.id_status,
    ebr.`nomStatut`,
    ebr.`heureDebut`,
    ebr.`heureFin`,
    -- Utilisation de COALESCE pour s'assurer que les options sont affichées même si NULL
    COALESCE(GROUP_CONCAT(lesOptions.`nomOption` SEPARATOR ', '), '') AS allOption,
    COALESCE(GROUP_CONCAT(lesOptions.`idlesOptions` SEPARATOR ', '), '') AS idlesOptionsList,
    COALESCE(GROUP_CONCAT(lesOptions.`codes` SEPARATOR ', '), '') AS codeOptions,
    -- Calcul du prix total : (somme des options * durée corrigée) + (prix espace * durée corrigée)
    COALESCE(SUM(lesOptions.`prixOption` *
        CASE
            WHEN ebr.heureDebut > 18 THEN (18 - ebr.heureDebut)
            ELSE ebr.duree
        END
    ), 0)
    + (ebr.`prixEspaceTravail` *
        CASE
            WHEN ebr.heureDebut > 18 THEN (18 - ebr.heureDebut)
            ELSE ebr.duree
        END
    ) AS totalPrice,
    ebr.duree,
    ebr.dates
FROM optionReservation AS optr
JOIN espaceTravailbyDate AS ebr
    ON optr.`refReservation` = ebr.`idReservation`
LEFT JOIN lesOptions
    ON lesOptions.`idlesOptions` = optr.`idlesOptions`
LEFT JOIN clientCoWorker AS c
    ON ebr.`idclientConnectez` = c.`idClient` -- Jointure sur la table des clients pour obtenir le nom
GROUP BY
    optr.`refReservation`,
    ebr.`idClient`,
    ebr.`nomClient`,
    ebr.`idclientConnectez`,
    c.`nomClient`, -- Ajout de cette ligne
    ebr.`numeroTelephoneClient`,
    ebr.`idespaceTravail`,
    ebr.`nomEspaceTravail`,
    ebr.`prixEspaceTravail`,
    ebr.id_status,
    ebr.`nomStatut`,
    ebr.`heureDebut`,
    ebr.`heureFin`, 
    ebr.duree,
    ebr.dates;


        ");
    }

    /**
     * Annule la migration (suppression de la vue).
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS splitOptiongetEspaceview");
    }
};

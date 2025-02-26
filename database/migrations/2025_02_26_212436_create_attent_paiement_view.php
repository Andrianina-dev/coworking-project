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
            CREATE OR REPLACE VIEW attentPaiementView AS
            SELECT
                atp.`idAttentePaiement`,
                atp.`idReservation`,
                etb.`idClient`,
                etb.`nomClient`,
                etb.`idespaceTravail`,
                etb.`nomEspaceTravail`,
                etb.id_status,
                etb.`nomStatut`,
                etb.`heureDebut`,
                etb.`heureFin`,
                etb.duree,
                etb.dates,
                atp.`datePaiement`,
                atp.`referencePaiement`
            FROM attentePaiement AS atp
            JOIN espaceTravailbyDate AS etb
                ON etb.`idReservation` = atp.`idReservation`;
        ");
    }

    /**
     * Annule la migration (suppression de la vue).
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS attentPaiementView");
    }
};

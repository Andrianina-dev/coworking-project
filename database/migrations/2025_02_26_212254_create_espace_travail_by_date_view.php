<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        DB::statement("
        create or replace view espaceTravailbyDate as
    SELECT
        reservation.`idReservation`,
        reservation.`idClient`,
        reservation.`idclientConnectez`,
        clientCoWorker.`nomClient`,
        clientCoWorker.`numeroTelephoneClient`,
        reservation.`idespaceTravail`,
        espaceTravail.`nomEspaceTravail`,
        espaceTravail.`prixEspaceTravail`,
        reservation.id_status,
        statuts.`nomStatut`,
        reservation.`heureDebut`,
        reservation.`heureFin`,
        reservation.duree,
        reservation.dates
    FROM reservation
    JOIN clientCoWorker
        ON clientCoWorker.`idClient` = reservation.`idClient`
    JOIN espaceTravail
        ON espaceTravail.`idEspaceTravail` = reservation.`idespaceTravail`
    JOIN statuts
        ON statuts.idstatut = reservation.id_status;

        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS espaceTravailbyDate");
    }
};

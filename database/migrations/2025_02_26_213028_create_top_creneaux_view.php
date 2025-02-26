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
            CREATE OR REPLACE VIEW topcreneaux AS
    WITH heures_reservations AS (
        SELECT
            r.idReservation,
            n.heure
        FROM
            reservation r
        JOIN
            nombres n
        ON
            n.heure >= r.heureDebut AND n.heure < r.heureFin -- Exclut heureFin
    )
    SELECT
        heure,
        COUNT(*) AS nombreReservations
    FROM
        heures_reservations
    GROUP BY
        heure
    ORDER BY
        nombreReservations DESC
    LIMIT 3;
        ");
    }

    /**
     * Annule la migration (suppression de la vue).
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS topcreneaux");
    }
};

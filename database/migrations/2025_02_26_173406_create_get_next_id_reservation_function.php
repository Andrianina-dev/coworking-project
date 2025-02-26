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
        // Créer la fonction SQL sans DELIMITER
        DB::unprepared('
            CREATE FUNCTION get_next_id_reservation()
            RETURNS VARCHAR(30)
            NOT DETERMINISTIC
            READS SQL DATA
            BEGIN
                DECLARE next_id INT DEFAULT 0;
                DECLARE next_id_reservation VARCHAR(30);

                -- Récupérer la partie numérique maximale après le "r"
                SELECT IFNULL(
                         MAX(CAST(SUBSTRING(idReservation, 2) AS UNSIGNED)), 0
                       )
                  INTO next_id
                  FROM reservation
                 WHERE idReservation LIKE "r%";

                -- Incrémentation
                SET next_id = next_id + 1;

                -- Générer l\'ID avec un format `r0001` jusqu\'à `r9999`
                SET next_id_reservation = CONCAT("r", LPAD(next_id, 3, "0"));

                RETURN next_id_reservation;
            END
        ');
    }
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Supprimer la fonction lors du rollback
        DB::unprepared('DROP FUNCTION IF EXISTS get_next_id_reservation;');
    }
};

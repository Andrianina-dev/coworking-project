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
        // Créer le trigger
        DB::unprepared('
            CREATE TRIGGER trig_reservation_insert
            BEFORE INSERT ON reservation
            FOR EACH ROW
            BEGIN
                SET NEW.idReservation = get_next_id_reservation();
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Supprimer le trigger lors du rollback
        DB::unprepared('DROP TRIGGER IF EXISTS trig_reservation_insert;');
    }
};

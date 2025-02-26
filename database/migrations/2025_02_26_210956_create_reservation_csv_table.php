<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservationCsv', function (Blueprint $table) {
            $table->id('idReservationCsv'); // Clé primaire auto-incrémentée
            $table->string('refs', 30); // Référence de la réservation
            $table->string('espace', 30); // Espace réservé
            $table->string('clients', 30); // Client associé
            $table->date('dates'); // Date de la réservation
            $table->time('heureDebut'); // Heure de début de la réservation
            $table->integer('duree'); // Durée de la réservation (en minutes ou heures)
            $table->string('theOptions', 30)->nullable(); // Options associées (peut être NULL)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservationCsv');
    }
};

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
        Schema::create('optionReservation', function (Blueprint $table) {
            $table->id('idOptionReservation'); // Clé primaire auto-incrémentée
            $table->string('refReservation', 255); // Clé étrangère vers reservation(idReservation)
            $table->unsignedBigInteger('idlesOptions')->nullable(); // Clé étrangère vers lesOptions(idlesOptions), nullable

            // Clés étrangères
            $table->foreign('refReservation')->references('idReservation')->on('reservation')->onDelete('cascade');
            $table->foreign('idlesOptions')->references('idlesOptions')->on('lesOptions')->onDelete('cascade');

            $table->timestamps(); // Colonnes `created_at` et `updated_at`
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('optionReservation');
    }
};

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
        Schema::create('reservation', function (Blueprint $table) {
            $table->string('idReservation', 255)->primary(); // Clé primaire de type VARCHAR
            $table->unsignedBigInteger('idClient'); // Clé étrangère vers clientcoWorker
            $table->unsignedBigInteger('idEspaceTravail'); // Clé étrangère vers espaceTravail
            $table->integer('heureDebut'); // Heure de début
            $table->integer('heureFin'); // Heure de fin
            $table->integer('duree'); // Durée
            $table->unsignedBigInteger('id_status')->default(3); // Clé étrangère vers statuts, valeur par défaut 3
            $table->date('dates'); // Date de la réservation
            $table->unsignedBigInteger('idClientConnectez'); // Clé étrangère vers clientcoWorker

            // Clés étrangères
            $table->foreign('idClient')->references('idClient')->on('clientCoWorker')->onDelete('cascade');
            $table->foreign('idEspaceTravail')->references('idEspaceTravail')->on('espaceTravail')->onDelete('cascade');
            $table->foreign('id_status')->references('idstatut')->on('statuts')->onDelete('cascade');
            $table->foreign('idClientConnectez')->references('idClient')->on('clientCoWorker')->onDelete('cascade');

            $table->timestamps(); // Colonnes `created_at` et `updated_at`
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation');
    }
};

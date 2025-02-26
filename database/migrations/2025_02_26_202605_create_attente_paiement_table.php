<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 
    public function up(): void
    {
        Schema::create('attentePaiement', function (Blueprint $table) {
            $table->id('idAttentePaiement'); // Clé primaire auto-incrémentée
            $table->string('referencePaiement', 30)->unique(); // Référence unique du paiement
            $table->string('idReservation', 255); // Clé étrangère vers reservation(idReservation)
            $table->date('datePaiement')->default(now()); // Date de paiement avec valeur par défaut (date actuelle)

            // Clé étrangère
            $table->foreign('idReservation')->references('idReservation')->on('reservation')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attentePaiement');
    }
};

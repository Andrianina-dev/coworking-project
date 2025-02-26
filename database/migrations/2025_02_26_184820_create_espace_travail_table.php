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
        Schema::create('espaceTravail', function (Blueprint $table) {
            $table->id('idEspaceTravail'); // Clé primaire auto-incrémentée
            $table->string('nomEspaceTravail', 30); // Nom de l'espace de travail
            $table->double('prixEspaceTravail'); // Prix avec double précision
            $table->timestamps(); // Colonnes `created_at` et `updated_at`
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('espaceTravail'); // Supprimer la table en cas de rollback
    }
};

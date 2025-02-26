<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('nombres', function (Blueprint $table) {
            $table->id(); // Colonne "id" auto-incrémentée (clé primaire)
            $table->integer('heure'); // Colonne "heure" de type INT
            $table->timestamps(); // Colonnes "created_at" et "updated_at" (optionnel)
        });
    }

    /**
     * Annule la migration (suppression de la table).
     */
    public function down()
    {
        Schema::dropIfExists('nombres');
    }
};

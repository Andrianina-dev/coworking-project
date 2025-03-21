<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('clientCoWorker', function (Blueprint $table) {
            $table->id('idClient'); // Utilise `id()` pour créer une clé primaire auto-incrémentée
            $table->string('numeroTelephoneClient', 30);
            $table->string('nomClient', 30)->default('UNKNOWN'); // Valeur par défaut 'UNKNOWN'
            $table->timestamps(); // Ajoute les colonnes `created_at` et `updated_at`
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientCoWorker');
    }
};

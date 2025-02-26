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
        Schema::create('jourFeries', function (Blueprint $table) {
            $table->id(); // Clé primaire auto-incrémentée
            $table->integer('mois'); // Mois du jour férié
            $table->integer('jour'); // Jour du jour férié

            // Index unique pour éviter les doublons (mois, jour)
            $table->unique(['mois', 'jour']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jourFeries');
    }
};

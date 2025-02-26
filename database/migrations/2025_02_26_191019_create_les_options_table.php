<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('lesOptions', function (Blueprint $table) {
            $table->id('idlesOptions'); // Clé primaire auto-incrémentée
            $table->string('codes', 30)->nullable(); // Code de l'option (peut être NULL)
            $table->string('nomOption', 30); // Nom de l'option
            $table->double('prixOption'); // Prix de l'option
            $table->timestamps(); // Colonnes `created_at` et `updated_at`
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lesOptions');
    }
};

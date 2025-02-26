<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatutsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Vider la table avant d'insérer les données
        DB::table('statuts')->truncate();

        // Insérer les données
        DB::table('statuts')->insert([
            ['nomStatut' => 'libre'],
            ['nomStatut' => 'occupe'],
            ['nomStatut' => 'reserve non payee'],
            ['nomStatut' => 'en attente'],
            ['nomStatut' => 'fait'],
        ]);
    }
}

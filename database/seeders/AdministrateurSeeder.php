<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdministrateurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('administrateur')->insert([
            'nomAdministrateur' => 'admin',
            'motdepasse' => 'admin',
        ]);
    }
}

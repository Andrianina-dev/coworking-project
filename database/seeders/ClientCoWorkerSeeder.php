<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientCoWorkerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Insérer trois clients
        DB::table('clientCoWorker')->insert([
            [
                'numeroTelephoneClient' => '0325896333',
                'nomClient' => 'Rija',
            ],
            [
                'numeroTelephoneClient' => '0374589770',
                'nomClient' => 'Tojo',
            ],
            [
                'numeroTelephoneClient' => '0337852214',
                'nomClient' => 'Maya',
            ],
        ]);
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class DropTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reservation:drop {table : Le nom de la table à supprimer}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Supprime une table spécifique de la base de données';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Récupérer le nom de la table à supprimer
        $table = $this->argument('table'); // Utilisez 'table' pour récupérer l'argument

        // Vérifier si la table existe
        if (!Schema::hasTable($table)) {
            $this->error("La table `$table` n'existe pas.");
            return;
        }

        // Supprimer la table
        Schema::dropIfExists($table);

        $this->info("La table `$table` a été supprimée avec succès.");
    }
}

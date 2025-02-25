<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ModelAdmin extends Model
{
    // Spécifiez la table associée à ce modèle
    protected $table = 'administrateur';

    // Définir la clé primaire si ce n'est pas l'ID par défaut
    protected $primaryKey = 'idAdministrateur';

    // Indiquer que la clé primaire est un auto-increment
    public $incrementing = true;

    // Les attributs qui sont assignables en masse
    protected $fillable = [
        'nomAdministrateur',
        'motdepasse',
    ];

    // Si la table n'a pas de timestamps (created_at et updated_at)
    public $timestamps = false;

    // Récupère tous les clients BTP
    public static function getAdmin()
    {
        $clientCowork = DB::select('SELECT * from administrateur');
        return $clientCowork;
    }

    public static function getAdminLogin($nomAdmin,$mopAdmin)
    {
        $adminlog = DB::select('SELECT * FROM administrateur WHERE nomAdministrateur = ? and motdepasse = ?', [$nomAdmin,$mopAdmin]);
        return $adminlog;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ModelTopCreneaux extends Model
{
    // Définir le nom de la table associée
    protected $table = 'topcreneaux';

    // Désactiver les timestamps si la table ne contient pas `created_at` et `updated_at`
    public $timestamps = false;

    // Définir les champs autorisés pour l'assignation de masse
    protected $fillable = [
        'heureDebut',
        'nombreReservations',
    ];

    // Fonction pour récupérer les trois créneaux les plus réservés
    public static function getTopTroisCreneaux()
    {
    $requete = "SELECT * FROM topcreneaux";
    return DB::select($requete);
    }
}

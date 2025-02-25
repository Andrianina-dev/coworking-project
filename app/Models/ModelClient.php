<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ModelClient extends Model
{
    // Spécifiez la table associée à ce modèle
    protected $table = 'clientCoworker';

    // Définir la clé primaire si ce n'est pas l'ID par défaut
    protected $primaryKey = 'idClient';

    // Indiquer que la clé primaire est un auto-increment
    public $incrementing = true;

    // Les attributs qui sont assignables en masse
    protected $fillable = [
        'numeroTelephoneClient',
        'nomClient',
    ];

    // Si la table n'a pas de timestamps (created_at et updated_at)
    public $timestamps = false;

    // Récupère tous les clients BTP
    public static function getClients()
    {
        $clientCowork = DB::select('SELECT * from clientcoworker');
        return $clientCowork;
    }

    public static function getNumeroClient($numeroClient)
    {
        $clientCowork = DB::select('SELECT * FROM clientcoworker WHERE numeroTelephoneClient = ?', [$numeroClient]);
        return $clientCowork;
    }
    
}

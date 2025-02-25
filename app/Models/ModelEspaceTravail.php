<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class ModelEspaceTravail extends Model
{
    use HasFactory;

    // Nom de la table dans la base de données
    protected $table = 'espaceTravail';

    // Nom de la clé primaire
    protected $primaryKey = 'idEspaceTravail';



    // Désactiver les timestamps (si la table n'a pas de champs created_at et updated_at)
    public $timestamps = false;

    // Champs modifiables en masse
    protected $fillable = [
        'nomEspaceTravail',
        'prixEspaceTravail',
    ];

    public static function getEspacetravail()
    {
        $listEspaceTravail = DB::select('select * from espacetravail');
        return $listEspaceTravail;
    }
    public static function getEspacetravailbyId($idEspaceTravail)
    {
        $listEspaceTravail = DB::select('select * from espacetravail where idEspaceTravail = ?',[$idEspaceTravail]);
        return $listEspaceTravail;
    }
}

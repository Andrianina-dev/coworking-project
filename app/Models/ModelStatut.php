<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ModelStatut extends Model
{
    use HasFactory;

    // Nom de la table
    protected $table = 'statuts';

    // Clé primaire
    protected $primaryKey = 'idstatut';

    // Désactiver l'incrémentation automatique de la clé primaire si nécessaire (sinon activé par défaut)
    public $incrementing = true;

    // Désactiver les timestamps (created_at et updated_at)
    public $timestamps = false;

    // Les colonnes autorisées pour les insertions et les mises à jour
    protected $fillable = [
        'nomStatut',
    ];

    /**
     * Relation avec les réservations (One-to-Many).
     */
    public function reservations()
    {
        return $this->hasMany(ModelReservation::class, 'id_status', 'idstatut');
    }

    public static function getStatut()
    {
        $statusList = DB::select('select * from status');
        return $statusList;
    }
}

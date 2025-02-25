<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ModelAttentePaiement extends Model
{
    // Définir la table associée au modèle
    protected $table = 'attentepaiement';

    protected $fillable = [
        'referencePaiement',
        'idReservation',
        'datePaiement',
        'etatpaiement'
    ];
    public $timestamps = false;

    /**
     * Insère une nouvelle ligne dans la table attentepaiement.
     *
     * @param string $referencePaiement
     * @param int $idReservation
     * @return bool
     */
    public static function insererAttentePaiement(string $referencePaiement, String $idReservation)
    {
        return DB::insert(
            'INSERT INTO attentepaiement (`referencePaiement`, `idReservation`) VALUES (?, ?)',
            [$referencePaiement, $idReservation]
        );
    }

    public static function getReservationAttentebyEtatPaiement()
    {
        return DB::select(
            "select * from attentepaiement where`etatpaiement`= 0"
        );
    }

    

}
?>

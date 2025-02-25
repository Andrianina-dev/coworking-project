<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ModelAttentePaiementView extends Model
{
    protected $table = 'attentPaiementView';
    public $timestamps = false;

    /**
     * Récupérer les données de la vue attentPaiementView.
     *
     * @return array
     */
    public static function getAttentePaiementData()
    {
        // Exécution de la requête SQL pour récupérer les données
        $result = DB::select('SELECT * FROM attentPaiementView where id_status = 4');

        // Retourner les résultats sous forme de tableau
        return $result;
    }

    public static function mettreAJourEtatPaiement(int $idAttentePaiement)
    {
        return DB::update(
            'UPDATE attentPaiementView SET `id_status` = 2 WHERE `idAttentePaiement` = ?',
            [$idAttentePaiement]
        );
    }

    public static function mettreAttente($referencePaiement)
    {
        return DB::update(
            'UPDATE attentPaiementView SET `id_status` = 4 WHERE `referencePaiement` = ?',
            [$referencePaiement]
        );
    }
}

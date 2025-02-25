<?php

namespace App\Http\Controllers;

use App\Models\ModelSplitOptiongetEspaceview;
use Illuminate\Http\Request;

class ChiffreAffaireController extends Controller
{
    public function voirChiffreAffaire(Request $request)
    {
        // Récupérer les dates depuis la requête
        $datedebut = $request->input('datedebut');
        $datefin = $request->input('dateFin');

        $getChiffreAffaire = ModelSplitOptiongetEspaceview::chiffreAffaireJournalier($datedebut, $datefin);
        if (empty($getChiffreAffaire)) {
            return redirect()->back()->with('error', 'Aucune donnée trouvée pour la date spécifiée.');
        }
        return view('backOffice.admin.chiffreAffaire', [
            'dateChoisie' => $datedebut,
            'datefinchoice' => $datefin,
            'voirChiffreAffaire' => $getChiffreAffaire
        ]);
    }

}

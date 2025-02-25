<?php
namespace App\Http\Controllers;

use App\Models\ModelAttentePaiement;
use App\Models\ModelAttentePaiementView;
use App\Models\ModelSplitOptiongetEspaceview;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    public function voirPaiement(Request $request)
{
    $idReservation = $request->query('idReservation');

    // Mettre l'idReservation en session
    $request->session()->put('idReservation', $idReservation);

    // Récupérer les données associées à la réservation
    $getReservationId = ModelSplitOptiongetEspaceview::getByRefReservation($idReservation);

    return view('frontOffice.paiement.paiement', [
        'listReservationId' => $getReservationId,
    ]);
}
    public function getRefPaiement(Request $request)
    {
        $referencepaiement = $request->input('refPaiement');
        $idReservation = $request->session()->get('idReservation');
        ModelAttentePaiement::insererAttentePaiement($referencepaiement, $idReservation);
        ModelAttentePaiementView::mettreAttente($referencepaiement);
        return view('frontOffice.sucess.valid');
}

    public function getPaiementRefAttente(Request $request)
    {
        $idReservation = $request->session()->get('idReservation');
        $getSplitOption = ModelSplitOptiongetEspaceview::getByRefReservation($idReservation);
        $getPaiementwithReference = ModelAttentePaiementView::getAttentePaiementData();
        return view('backOffice.admin.validation',[
            'listPayementOption' =>$getSplitOption,
            'listAttentePaiementRef' =>$getPaiementwithReference,
        ]);
    }

    public function validationPaiement(Request $request)
    {

        $getPaiementwithReference = ModelAttentePaiementView::getAttentePaiementData();
        $idResa = $request->query('idResa');
        if (!$idResa || !is_numeric($idResa))
        {
            return redirect()->back()->withErrors(['message' => 'ID de réservation invalide.']);
        }

        $result = ModelAttentePaiementView::mettreAJourEtatPaiement((int)$idResa);

        // Vérifier si la mise à jour a été effectuée
        if ($result > 0) {
            return view('backOffice.admin.validation', [
                'idResa' => $idResa,
                'success' => true,
                'message' => 'Paiement validé avec succès.',
                'listAttentePaiementRef' =>$getPaiementwithReference,
            ]);
        }
        return view('backOffice.admin.validation', [
            'idResa' => $idResa,
            'success' => false,
            'message' => 'Aucune mise à jour effectuée. Vérifiez si l\'ID existe.',
            'listAttentePaiementRef' =>$getPaiementwithReference,
        ]);
        }
        public function showPayeeNonPayee(Request $request)
        {
            $id_status = $request->input('idStatuts');
            $getPayeeNonPayee = ModelSplitOptiongetEspaceview::filterPayeeNonPayee($id_status);
            // dd($getPayeeNonPayee);
                    return view('backOffice.admin.filtre',[
                        'idStatus' => $id_status,
                        'filtrePayeeNonPayee' => $getPayeeNonPayee,
                    ]);
        }

}

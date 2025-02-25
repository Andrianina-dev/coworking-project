<?php

namespace App\Http\Controllers;

use App\Models\ModelAttentePaiement;
use App\Models\ModelAttentePaiementView;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class importPaiement extends Controller
{
    public function importCsv(Request $request)
    {
        // Validation du fichier CSV
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt|max:2048'
        ]);

        $file = $request->file('csv_file');

        if (($handle = fopen($file, 'r')) !== false) {
            fgetcsv($handle); // Ignore la première ligne (headers)

            // Créer un tableau pour stocker les idReservation traités
            $idReservationsTraitement = [];

            // Parcours des lignes du CSV
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                // Conversion de la datePaiement (de DD/MM/YYYY vers YYYY-MM-DD)
                try {
                    $datePaiement = Carbon::createFromFormat('d/m/Y', $data[2])->format('Y-m-d');
                } catch (\Exception $e) {
                    // Si la conversion échoue, ignorer cette ligne et loguer l'erreur
                    Log::error("Erreur de format de date: " . $data[2]);
                    continue;
                }

                // Insertion dans la table 'attentepaiement'
                $paiement = ModelAttentePaiement::create([
                    'referencePaiement' => $data[0],  // Reference du paiement
                    'idReservation' => $data[1],       // ID de la réservation
                    'datePaiement' => $datePaiement,   // Date du paiement convertie
                    // 'etatpaiement' est laissé vide, la valeur par défaut sera utilisée
                ]);

                // Ajouter l'idReservation du paiement importé dans le tableau
                $idReservationsTraitement[] = $data[1];

                // Mise à jour de la table 'attentepaiementview' avec id_status = 2 pour les enregistrements du CSV
                ModelAttentePaiementView::where('idReservation', $data[1])
                    ->update(['id_status' => 2]);
            }

            fclose($handle);

            // Mettre à jour les autres enregistrements (non importés) avec id_status = 3
            ModelAttentePaiementView::whereNotIn('idReservation', $idReservationsTraitement)
                ->update(['id_status' => 3]);
        }

        return view('frontOffice.sucess.importOk');
    }
}

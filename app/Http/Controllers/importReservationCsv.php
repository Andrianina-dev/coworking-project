<?php

namespace App\Http\Controllers;

use App\Models\ModelReservationCsv;
use App\Models\ModelOptionReservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ImportReservationCsv extends Controller
{
    public function importCsv(Request $request)
    {
        // Validation du fichier CSV
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt|max:2048'
        ]);

        // Récupération du fichier CSV
        $file = $request->file('csv_file');

        // Tableau temporaire pour stocker les données à insérer dans optionReservation
        $tempOptionReservation = [];

        if (($handle = fopen($file, 'r')) !== false) {
            // Ignorer la première ligne (les en-têtes)
            fgetcsv($handle);

            // Parcours des lignes du CSV
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                try {
                    // Vérifier si le tableau contient le bon nombre de colonnes
                    if (count($data) < 7) {
                        continue; // Passer les lignes invalides
                    }

                    // Convertir la date de format DD/MM/YYYY à YYYY-MM-DD
                    $formattedDate = Carbon::createFromFormat('d/m/Y', trim($data[3]))->format('Y-m-d');

                    // Convertir l'heure de format HH:MM à HH:MM:SS
                    $formattedTime = Carbon::createFromFormat('H:i', trim($data[4]))->format('H:i:s');

                    // Vérifier si la colonne d'options est vide
                    $options = !empty(trim($data[6])) ? explode(", ", $data[6]) : null;

                    if (!is_null($options) && count($options) > 0) {
                        foreach ($options as $option) {
                            $optionLower = strtolower($option);

                            // Vérifier si l'option existe dans la table lesOptions
                            $optionData = DB::table('lesOptions')
                                ->whereRaw('LOWER(codes) = ?', [$optionLower])
                                ->first();

                            // Si l'option existe, récupérer son ID, sinon NULL
                            $idOption = $optionData ? $optionData->idlesOptions : null;

                            // Ajouter la paire refReservation et idOption dans le tableau temporaire
                            $tempOptionReservation[] = [
                                'refReservation' => $data[0],
                                'idOption' => $idOption,
                            ];
                        }
                    } else {
                        // Ajouter une entrée avec NULL pour idOption si aucune option n'est trouvée
                        $tempOptionReservation[] = [
                            'refReservation' => $data[0],
                            'idOption' => null,
                        ];
                    }

                    // Insertion dans la table reservationcsv
                    ModelReservationCsv::create([
                        'refs' => $data[0],
                        'espace' => $data[1],
                        'clients' => $data[2],
                        'dates' => $formattedDate,
                        'heureDebut' => $formattedTime,
                        'duree' => $data[5],
                        'theOptions' => is_null($options) ? null : implode(', ', $options),
                    ]);
                } catch (\Exception $e) {
                    return back()->withErrors(['error' => "Erreur lors de l'import : " . $e->getMessage()]);
                }
            }

            fclose($handle);
        }

        // Insertion des clients distincts dans la table clientcoworker via la fonction du modèle
        ModelReservationCsv::insertDistinctClients();

        // Insertion des réservations dans la table reservation via la fonction du modèle
        ModelReservationCsv::insertIntoReservation();

        // Insertion des options dans la table optionReservation via la fonction du modèle
        ModelOptionReservation::insertAllTempOptions($tempOptionReservation);

        return view('frontOffice.sucess.importOk');
    }
}

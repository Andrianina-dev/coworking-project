<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\ModelReservation;
use App\Models\ModelEspaceTravail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class espacetravailJFetWE extends Controller
{
    public function afficheEspaceTravailFerieWE(Request $request)
    {
        $dateDebut = Carbon::parse($request->input('dateDebut'));
        $dateFin = Carbon::parse($request->input('dateFin'));

        // Récupérer les jours fériés depuis la base de données (mois et jour)
        $joursFeries = DB::table('jourferies')->get()->map(function ($ferie) {
            return sprintf('%02d-%02d', $ferie->mois, $ferie->jour);
        })->toArray();

        $listAfficheEspace = ModelEspaceTravail::all();
        $disponibiliteParEspace = [];

        $dateCourante = $dateDebut->copy();
        while ($dateCourante->lte($dateFin)) {
            $dateString = $dateCourante->toDateString();
            $jourFormat = $dateCourante->format('m-d');

            foreach ($listAfficheEspace as $espace) {
                $nomEspace = $espace->nomEspaceTravail;
                
                if (!isset($disponibiliteParEspace[$nomEspace])) {
                    $disponibiliteParEspace[$nomEspace] = [];
                }

                $statut = 'libre'; // Statut par défaut

                if (in_array($jourFormat, $joursFeries)) {
                    $statut = 'orange';
                } elseif ($dateCourante->isWeekend()) {
                    $statut = 'violet';
                } else {
                    $reservation = ModelReservation::where('idEspaceTravail', $espace->idEspaceTravail)
                        ->where('dates', $dateString)
                        ->first();

                    if ($reservation) {
                        $statut = 'rouge';
                    }
                }

                $disponibiliteParEspace[$nomEspace][$dateString] = $statut;
            }

            $dateCourante->addDay();
        }

        return view('frontOffice.client.espaceTravailJFetWE', compact('disponibiliteParEspace', 'listAfficheEspace'));
    }
}

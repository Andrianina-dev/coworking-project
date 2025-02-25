<?php

namespace App\Http\Controllers;

use App\Models\ModelEspaceTravailbyDate;
use App\Http\Controllers\ReservationController;
use App\Models\ModelReservation;
use App\Models\ModelSplitOptiongetEspaceview;
use App\Service\DateService;
use Illuminate\Http\Request;

class EspaceTravailController extends Controller
{
    protected $reservationController;
    public function __construct(ReservationController $reservationController)
    {
        $this->reservationController = $reservationController;
    }

    public function afficheEspaceTravail(Request $request)
    {
        $date = $request->input('dateEspaceTravail', date('Y-m-d'));
        $getDuree = ModelSplitOptiongetEspaceview::getDureePersonne($date);
        // dd($getDuree);
        // Appliquer l'action (previous/next) si elle est définie
        if ($request->has('dateAction')) {
            $dateAction = $request->input('dateAction');
            $date = DateService::avanceOrPrevDate($dateAction, $date);
        }

        // Récupérer les espaces distincts
        $allEspaces = ModelEspaceTravailbyDate::distinct()->get(['idespaceTravail', 'nomEspaceTravail']);

        // Récupérer les réservations à la date sélectionnée
        $reservationMap = $this->reservationController->mapReservation($date);
        $personMap = $this->reservationController->personneChoisie($date);

        // Appliquer les classes CSS aux réservations
        $classMap = $this->applicateCss($reservationMap, $personMap);

        return view('frontOffice.client.espaceTravail', [
            'reservationMap' => $reservationMap,
            'selectedDate' => $date,
            'listAfficheEspace' => $allEspaces,
            'personChoose' => $personMap,
            'classMap' => $classMap,
            'sommeDuree' => $getDuree,
            'errorMessage' => null,
        ]);
    }


    private function applicateCss($reservationMap, $personMap)
    {
        $statusClasses = [
            1 => 'statut-3', // Libre (vert)
            2 => 'statut-2', // Occupée (rouge)
            3 => 'statut-4', // Réservée, non payée (violet)
        ];
        $classMap = [];

        foreach ($reservationMap as $nomEspace => $heures) {
            foreach ($heures as $hour => $disponibilite) {
                $classMap[$nomEspace][$hour] = isset($personMap[$nomEspace][$hour])
                    ? 'highlight' // Réservé par l'utilisateur connecte
                    : ($statusClasses[$disponibilite] ?? 'statut-1'); // Valeur par défaut
            }
        }

        return $classMap;
    }

}

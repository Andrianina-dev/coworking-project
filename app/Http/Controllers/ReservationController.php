<?php

namespace App\Http\Controllers;

use App\Models\ModelClient;
use App\Models\ModelEspaceTravail;
use App\Models\ModelEspaceTravailbyDate;
use App\Models\ModelOption;
use App\Models\ModelOptionReservation;
use App\Models\ModelReservation;
use App\Models\ModelSplitOptiongetEspaceview;
use App\Models\ModelTopCreneaux;
use App\Http\Controllers\StatutController;
use App\Service\ReservationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReservationController extends Controller
{
    // FONCTION POUR AFFICHER LA PAGE DE RÉSERVATION
    public function faireUneReservation(Request $request)
    {
        $numeroTelephone = $request->session()->get('numeroTel');
        $geOption = ModelOption::getAllOption();
        $getClient = ModelClient::getNumeroClient($numeroTelephone);
        $idConnecte = $getClient[0]->idClient;
        $idespaceTravail = $request->query('idEspaceTravail');
        $getEspaceTravail = ModelEspaceTravail::getEspacetravailbyId($idespaceTravail);
        $getAllClient = ModelClient::getClients();

        return view('frontOffice.reservation.reservation', [
            'clientList' => $getClient,
            'listOption' => $geOption,
            'espaceTravailList' => $getEspaceTravail,
            'allClients' => $getAllClient,
            'clientIdConnecte' => $idConnecte,
        ]);
    }

    // FONCTION POUR AFFICHER LES RÉSERVATIONS DE L'UTILISATEUR
    public function myReservation(Request $request)
    {
        $numeroTelephone = $request->session()->get('numeroTel');
        $theClient = ModelClient::getNumeroClient($numeroTelephone);
        $listEspaceTravail = ModelSplitOptiongetEspaceview::getByPhoneNumber($numeroTelephone);

        $statutController = new StatutController(); // Instancier le contrôleur

        // Appliquer getStatusAndActions à chaque espace de travail
        foreach ($listEspaceTravail as $espace) {
            $statusAndActions = $statutController->getStatusAndActions($espace);
            $espace->statusHtml = $statusAndActions['status'];
            $espace->actionsHtml = $statusAndActions['actions'];
        }

        return view('frontOffice.client.myReservation', [
            'clientcowork' => $theClient,
            'getEspaceTravailbyDate' => $listEspaceTravail,
        ]);
    }
    // FONCTION POUR INSÉRER UNE RÉSERVATION
    protected $reservationService;

    // Injection du service ReservationService
    public function __construct(ReservationService $reservationService)
    {
        $this->reservationService = $reservationService;
    }

    public function insertReservation(Request $request)
    {
        // Validation des données du formulaire
        $validatedData = $request->validate([
            'idClient' => 'required|integer',
            'idespaceTravail' => 'required|integer',
            'dateResa' => 'required|date',
            'heureDebut' => 'required|integer|min:0|max:23',
            'duree' => 'required|integer|min:1',
            'options' => 'array',
            'options.*' => 'integer',
        ]);

        try {
            // Récupération des données de la requête
            $heureDebut = $validatedData['heureDebut'];
            $duree = $validatedData['duree'];
            $dateResa = $validatedData['dateResa'];
            $idEspaceTravail = $validatedData['idespaceTravail'];
            $clientChoisi = $request->input('lesClients');
            $options = $validatedData['options'] ?? [];

            // Appel au service pour créer la réservation
            $result = $this->reservationService->creerReservation(
                $heureDebut,
                $duree,
                $dateResa,
                $idEspaceTravail,
                $validatedData['idClient'],
                $clientChoisi,
                $options
            );

            // Gestion de la réponse en fonction du résultat du service
            if ($result) {
                return view('frontOffice.sucess.succesInsert');
            } else {
                return redirect()->back()->with('error', 'Erreur : réservation échouée.');
            }
        } catch (\Exception $e) {
            // Gestion des erreurs et enregistrement dans les logs
            Log::error("Erreur lors de l'insertion de la réservation: " . $e->getMessage());
            return redirect()->back()->with('error', "Erreur lors de l'insertion.");
        }
    }


    // FONCTION POUR ANNULER UNE RÉSERVATION
    public function annulationResa(Request $request)
    {
        $idResa = $request->query('idReservation');
        ModelReservation::annulezResa($idResa);

        return view('frontOffice.sucess.annulez');
    }
    
    // FONCTION POUR OBTENIR LES TOP 3 CRÉNEAUX
    public function getTopCreneaux()
    {
        $topCreneaux = ModelTopCreneaux::getTopTroisCreneaux();

        return view('backOffice.admin.topCreneaux', [
            'topCreneaux' => $topCreneaux,
        ]);
    }

    // FONCTION POUR OBTENIR LES RÉSERVATIONS PAR JOUR
    public function personneChoisie($date)
    {
        $personChoose = ModelEspaceTravailbyDate::getAllResaPerson($date);
        $personMap = [];

        // Construire la carte des réservations des utilisateurs
        foreach ($personChoose as $reservation) {
            for ($hour = $reservation->heureDebut; $hour <= $reservation->heureFin; $hour++) {
                $personMap[$reservation->nomEspaceTravail][$hour] = 'reserved';
            }
        }

        return $personMap;
    }

    // FONCTION POUR OBTENIR LA CARTE DES RÉSERVATIONS
    public function mapReservation($date)
    {
        // Récupérer tous les espaces distincts
        $allEspaces = ModelEspaceTravailbyDate::distinct()
            ->pluck('nomEspaceTravail');

        // Initialiser le tableau des réservations avec des créneaux disponibles (1 = libre)
        $reservationMap = [];
        foreach ($allEspaces as $nomEspace) {
            $reservationMap[$nomEspace] = array_fill(8, 11, 1); // De 8h à 18h => 1 (libre)
        }

        // Récupérer les réservations du jour
        $reservations = ModelEspaceTravailbyDate::whereDate('dates', $date)
            ->get(['nomEspaceTravail', 'heureDebut', 'heureFin', 'id_status']);

        // Marquer les créneaux réservés
        foreach ($reservations as $reservation) {
            for ($hour = $reservation->heureDebut; $hour <= $reservation->heureFin; $hour++) {
                $reservationMap[$reservation->nomEspaceTravail][$hour] = $reservation->id_status;
            }
        }

        return $reservationMap;
    }
}

?>

<?php
namespace App\Service;

use App\Models\ModelOptionReservation;
use App\Models\ModelReservation;

class ReservationService extends Service
{
    public function creerReservation($heureDebut, $duree, $dateResa, $idEspaceTravail, $idClient, $clientChoisi, $options = [])
{
    $heureFin = $heureDebut + $duree;

    // Vérification si la réservation dépasse 18h
    if ($heureFin > 18) {
        $dureeJour1 = 18 - $heureDebut; // Temps restant avant 18h
        $dureeJour2 = $duree - $dureeJour1 ; // Temps dépassant 18h

        // Vérification jour aujourd'hui
        $conflitJour1 = ModelReservation::verifierConflitResa($dateResa, $heureDebut, $dureeJour1, $idEspaceTravail);

        // Vérification de demasin
        $dateResaDemain = date('Y-m-d', strtotime($dateResa . ' +1 day'));
        $conflitJour2 = ModelReservation::verifierConflitResa($dateResaDemain, 8, $dureeJour2, $idEspaceTravail);
        // annulation des deux si on conflit
        if (($conflitJour1 && !$conflitJour2) || (!$conflitJour1 && $conflitJour2)) {
            session()->flash('error', 'Erreur : un conflit a été détecté pour l\'un des jours (aujourd\'hui ou demain). Aucune réservation n\'a été effectuée.');
            return false;
        }

        if (!$conflitJour1 && !$conflitJour2) {
            // Fonction pour insérer une réservation
            $insertReservation = function ($date, $heureDebut, $heureFin, $duree) use ($clientChoisi, $idEspaceTravail, $idClient, $options) {
                $conflit = ModelReservation::verifierConflitResa($date, $heureDebut, $duree, $idEspaceTravail);
                if (!$conflit) {
                    $reservationId = ModelReservation::insererResa(
                        $clientChoisi,
                        $idEspaceTravail,
                        $heureDebut,
                        $heureFin,
                        $duree,
                        3,
                        $date,
                        $idClient
                    );

                    if ($reservationId) {
                        foreach ($options as $optionId) {
                            ModelOptionReservation::insertOptionReservation($reservationId, $optionId);
                        }
                    }

                    return $reservationId;
                }

                return null;
            };
            // Insertion de la première partie (aujourd'hui)
            $reservationId1 = $insertReservation($dateResa, $heureDebut, 18, $dureeJour1);

            // Insertion de la seconde partie (demain à partir de 8h)
            $reservationId2 = $insertReservation($dateResaDemain, 8, 8 + $dureeJour2, $dureeJour2);

            if ($reservationId1 && $reservationId2) {
                return true;
            } else {
                // Si l'insertion échoue, annuler les deux
                if ($reservationId1) {
                    ModelReservation::annulerResa($reservationId1);
                }
                if ($reservationId2) {
                    ModelReservation::annulerResa($reservationId2);
                }
                session()->flash('error', 'Erreur : une ou les deux parties de la réservation n\'ont pas pu être effectuées en raison d\'un conflit.');
                return false; // Échec de l'insertion
            }
        } else {
            // Si les deux jours ont un conflit
            session()->flash('error', 'Erreur : les deux jours (aujourd\'hui et demain) sont déjà réservés.');
            return false; // Les deux jours sont réservés
        }
    } else {
        // Cas où la réservation ne dépasse pas 18h
        $conflit = ModelReservation::verifierConflitResa($dateResa, $heureDebut, $duree, $idEspaceTravail);
        if (!$conflit) {
            $reservationId = ModelReservation::insererResa(
                $clientChoisi,
                $idEspaceTravail,
                $heureDebut,
                $heureFin,
                $duree,
                3,
                $dateResa,
                $idClient
            );

            if ($reservationId) {
                foreach ($options as $optionId) {
                    ModelOptionReservation::insertOptionReservation($reservationId, $optionId);
                }
                return true;
            }
        }

        session()->flash('error', 'Erreur : la réservation n\'a pas pu être effectuée en raison d\'un conflit.');
        return false;
    }
}

}

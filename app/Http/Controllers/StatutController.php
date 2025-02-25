<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatutController extends Controller
{
    public function getStatusAndActions($espace)
    {
        $status = '';
        $actions = '';

        // Vérifiez si la propriété refReservation existe
        $refReservation = property_exists($espace, 'refReservation') ? $espace->refReservation : null;

        switch ($espace->id_status) {
            case 2:
                $status = '<span class="status-success">Payée</span>';
                break;
            case 3:
                $status = '<span class="status-danger">Non payée</span>';
                if ($refReservation) {
                    $actions = '<a href="' . url('lePaiement') . '?idReservation=' . $refReservation . '" class="btn btn-payer">Payer</a>';
                    $actions .= '<a href="' . url('annulezResa') . '?idReservation=' . $refReservation . '" class="btn btn-annuler">Annuler</a>';
                } else {
                    $actions = '<span class="text-muted">Aucune action requise</span>';
                }
                break;
            case 4:
                $status = '<span class="status-warning">En attente</span>';
                $actions = '<span class="text-muted">Aucune action requise</span>';
                break;
            case 5:
                $status = '<span class="status-warning">Fait</span>';
                $actions = '<span class="text-muted">Aucune action requise</span>';
                break;
            default:
                $status = '<span class="status-muted">Inconnu</span>';
                $actions = '<span class="text-muted">Aucune action requise</span>';
        }

        return ['status' => $status, 'actions' => $actions];
    }
}

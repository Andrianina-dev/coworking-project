<?php
namespace App\Service; // Changer le namespace car ce n'est pas un modèle Eloquent

use Carbon\Carbon;

class DateService extends Service
{
    public static function avanceOrPrevDate(string $dateAction, string $date): string
    {
        if ($dateAction === 'previous') {
            return date('Y-m-d', strtotime($date . ' -1 day'));
        } elseif ($dateAction === 'next') {
            return date('Y-m-d', strtotime($date . ' +1 day'));
        }

        return $date;
    }


    public static function isWeekend($date)
    {
        $carbonDate = Carbon::parse($date);
        return $carbonDate->isWeekend();
    }

    public static function isHoliday($date)
    {
        // Implémentez votre logique pour vérifier les jours fériés ici
        // Exemple (à adapter) :
        $holidays = [
            '2024-01-01', // Jour de l'an
            '2024-05-01', // Fête du travail
            // ... ajoutez d'autres jours fériés
        ];
        return in_array($date, $holidays);
    }

    public static function avanceOrPrevDates($action, $date)
    {
        $carbonDate = Carbon::parse($date);
        if ($action === 'next') {
            return $carbonDate->addDay()->toDateString();
        } elseif ($action === 'prev') {
            return $carbonDate->subDay()->toDateString();
        }
        return $date;
    }
}

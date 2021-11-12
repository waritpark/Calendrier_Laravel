<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventsController extends Controller
{
    /**
     * Récupère les evenements commencant entre 2 dates
     * @param \DateTimeInterface $start
     * @param \DateTimeInterface $end
     * @return array
     */
    public function getEventsBetween (\DateTimeInterface $start,\DateTimeInterface $end): array {
        $req = "SELECT * FROM t_calendrier_events 
        WHERE id_utilisateur = ".$_SESSION['id_utilisateur']." AND start_event 
        BETWEEN '{$start->format('Y-m-d 00:00:00')}' AND '{$end->format('Y-m-d 23:59:59')}' 
        ORDER BY start_event ASC";
        $result = $this->pdo->query($req);
        $resulthrow = $result->fetchAll();
        return $resulthrow;
    }

    /**
     * Récupère les evenements commencant entre 2 dates indexé par jour
     * @param \DateTimeInterface $start
     * @param \DateTimeInterface $end
     * @return array
     */
    public function getEventsBetweenByDay (\DateTimeInterface $start,\DateTimeInterface $end): array {
        $events = $this->getEventsBetween($start, $end);
        $days = [];
        foreach ($events as $event){
            $date = explode(' ',$event['start_event'])[0];
            if (!isset($days[$date])) {
                $days[$date] = [$event];
            } else {
                $days[$date][] = $event;
            }
        }
        return $days;
    }
}

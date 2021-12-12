<?php
use Illuminate\Support\Facades\DB;

// requete pour afficher les events d'une personne (avec l'id) d'une date entre 00:00:00 et 23:59:59
function reqListEvents($id_user, $date) {
    $events = DB::table('events')
    ->where('user_id', "=", $id_user)
    ->whereBetween('start', [$date->format('Y-m-d 00:00:00'),$date->format('Y-m-d 23:59:59')])
    ->get();
    return $events;
}

// recupere les valeurs de la météo du jour actuel
function MeteoEventCurrent()
{
    $meteo1 = file_get_contents('https://api.openweathermap.org/data/2.5/weather?id=2969562&lang=fr&appid=f4d090607714c839e119246f24a205f1');
    $meteo1 = json_decode($meteo1, true);
    return $meteo1;
}

// recupere les valeurs de la météo sur les 5 jours à venir toutes les 3h
function MeteoEventTomorrow()
{
    $meteo2 = file_get_contents('https://api.openweathermap.org/data/2.5/forecast?id=2969562&lang=fr&appid=f4d090607714c839e119246f24a205f1');
    $meteo2 = json_decode($meteo2, true);
    return $meteo2;
}

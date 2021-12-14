<?php

use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

// requete pour afficher les events d'une personne (avec l'id) d'une date entre 00:00:00 et 23:59:59
function reqListEvents($id_user, $date) {
    $events = DB::table('events')
    ->where('user_id', "=", $id_user)
    ->whereBetween('start', [$date->format('Y-m-d 00:00:00'),$date->format('Y-m-d 23:59:59')])
    ->get();
    return $events;
}

// recupere les valeurs de la météo du jour actuel
// function MeteoEventCurrent() {
//     // $meteo = Http::get('https://api.openweathermap.org/data/2.5/weather?id=2969562&units=metric&lang=fr&appid=f4d090607714c839e119246f24a205f1')->json();
//     $meteo = file_get_contents('https://api.openweathermap.org/data/2.5/weather?id=2969562&units=metric&lang=fr&appid=f4d090607714c839e119246f24a205f1');
//     $meteo = json_decode($meteo, true);
//     return $meteo;
// }

// recupere les valeurs de la météo sur les 5 jours à venir toutes les 3h
// function MeteoEventTomorrow() {
//     // $meteoTomorrow = Http::get('https://api.openweathermap.org/data/2.5/forecast?id=2969562&units=metric&lang=fr&appid=f4d090607714c839e119246f24a205f1')->json();
//     $meteoTomorrow = file_get_contents('https://api.openweathermap.org/data/2.5/forecast?id=2969562&units=metric&lang=fr&appid=f4d090607714c839e119246f24a205f1');
//     $meteoTomorrow = json_decode($meteoTomorrow, true);
//     return $meteoTomorrow;
// }


// Tests curl
// function meteoCurl()
// {
//     $executionStartTime = microtime(true) / 1000;

//     // Création des ressources cURL
//     $ch1 = curl_init();
//     $ch2 = curl_init();

//     // Définit l'URL ainsi que d'autres options
//     curl_setopt($ch1, CURLOPT_URL, "http://api.openweathermap.org/data/2.5/weather?id=2969562&units=metric&lang=fr&appid=f4d090607714c839e119246f24a205f1");
//     curl_setopt_array($ch1, [
//         CURLOPT_HEADER => 0,
//         CURLOPT_CAINFO => __DIR__ . DIRECTORY_SEPARATOR . 'cert.cer',
//         CURLOPT_RETURNTRANSFER => true,
//         // CURLOPT_TIMEOUT => 10,
//     ]);
//     curl_setopt($ch2, CURLOPT_URL, "http://api.openweathermap.org/data/2.5/forecast?id=2969562&units=metric&lang=fr&appid=f4d090607714c839e119246f24a205f1");
//     curl_setopt_array($ch2, [
//         CURLOPT_HEADER => 0,
//         CURLOPT_CAINFO => __DIR__ . DIRECTORY_SEPARATOR . 'cert.cer',
//         CURLOPT_RETURNTRANSFER => true,
//         // CURLOPT_TIMEOUT => 10,
//     ]);

//     // Création du gestionnaire cURL multiple
//     $cmi = curl_multi_init();

//     // Ajoute les deux gestionnaires
//     curl_multi_add_handle($cmi,$ch1);
//     curl_multi_add_handle($cmi,$ch2);

//     // Exécute le gestionnaire multiple
//     $running = null;
//     do {
//         curl_multi_exec($cmi, $running);
//     } while ($running);

//     // Ferme les gestionnaires
//     curl_multi_remove_handle($cmi, $ch1);
//     curl_multi_remove_handle($cmi, $ch2);
//     curl_multi_close($cmi);

//     // all of our requests are done, we can now access the results

//     $meteoCurrent = curl_multi_getcontent($ch1);
//     $meteoTomorrow = curl_multi_getcontent($ch2);

//     // Final Output
//     $output['status']['code'] = "200";
//     $output['status']['name'] = "OK";
//     $output['meteoCurrent'] = json_decode($meteoCurrent, true);
//     $output['meteoTomorrow'] = json_decode($meteoTomorrow, true);

//     // permet de voir en combien de milliseconde mes appels d'api mettent à venir
//     $output['status']['returnedIn'] = (microtime(true) - $executionStartTime) / 1000000 . " ms";

//     return $output;
// }
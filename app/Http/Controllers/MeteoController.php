<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MeteoController extends Controller
{
    // https://openweathermap.org/forecast5

    // tests avec file_get_contents
    public function today()
    {
        // probleme de certificat SSL auto signé
        // https://stackoverflow.com/questions/54402673/how-to-fix-ssl-certificate-problem-self-signed-certificate-in-certificate-chai/54403068
        // $meteo = Http::get('https://api.openweathermap.org/data/2.5/weather?id=2969562&lang=fr&appid=f4d090607714c839e119246f24a205f1')
        // ->json();
        $meteo = file_get_contents('https://api.openweathermap.org/data/2.5/weather?id=2969562&units=metric&lang=fr&appid=f4d090607714c839e119246f24a205f1');
        $meteo = json_decode($meteo, true);
        // dd($meteo);
        return view('meteo', ['meteo'=>$meteo]);
    }

    // tests avec file_get_contents
    public function tomorrow()
    {
        $meteo = file_get_contents('https://api.openweathermap.org/data/2.5/forecast?id=2969562&units=metric&lang=fr&appid=f4d090607714c839e119246f24a205f1');
        $meteo = json_decode($meteo, true);
        // dd($meteo);
        return view('meteo', ['meteo'=>$meteo]);
    }


}

@extends('template')

@section('content')

{{-------- API appel avec weather (function today) --------}}

<?php
//---------- afficher la meteo du jour
foreach ($current["weather"] as $weather):

    echo '<h2>Ville : </h2>';
    echo'<p>'.$meteo["name"].'</p>';

    echo '<h2>Temps : </h2>';
    echo '<p>'.$weather["description"].'</p>'; ?>

    {{-- afficher l'image doc: https://openweathermap.org/weather-conditions --}}
    <img src="http://openweathermap.org/img/wn/<?php echo $weather["icon"] ?>@2x.png" alt="meteo">

<?php  endforeach; ?>


@endsection

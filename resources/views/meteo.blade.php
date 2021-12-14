@extends('template')

@section('content')

{{-------- API appel avec weather (function today) --------}}

<?php
//---------- afficher la meteo du jour
// foreach ($meteo["weather"] as $weather):

    // echo '<h2>Ville : </h2>';
    // echo'<p>'.$meteo["name"].'</p>';

    // echo '<h2>Temps : </h2>';
    // echo '<p>'.$weather["description"].'</p>'; ?>

    {{-- afficher l'image doc: https://openweathermap.org/weather-conditions --}}
    {{-- <img src="http://openweathermap.org/img/wn/<?php // echo $weather["icon"] ?>@2x.png" alt="meteo"> --}}

<?php // endforeach; ?>


{{-------- API appel avec forecast (function tomorrow) --------}}

<?php
//---------- affiche l'image de la météo et les degres d'apres demain à 12:00:00
$datePlus2 = date('Y-m-d 12:00:00', strtotime('+2 days'));
$tomorrow2 = date('Y-m-d', strtotime('+2 days'));
foreach ($meteo['list'] as $dateTomorrow2):
    if ($dateTomorrow2['dt_txt'] == $datePlus2): ?>
        <p>hello</p>
        <img class="" src="http://openweathermap.org/img/wn/<?php echo $dateTomorrow2['weather'][0]['icon'] ?>@2x.png" alt="meteo after tomorrow">
        <?php
    endif;
endforeach;

//---------- affiche tous les numéros d'img qui sont au format string
// $datePlus1 = date('Y-m-d 12:00:00', strtotime('tomorrow'));
// foreach ($meteo['list'] as $weather):
//     var_dump($weather['weather'][0]['icon']);
// endforeach;

//---------- afficher la date de demain à 12:00
// $datePlus1 = date('Y-m-d 12:00:00', strtotime('tomorrow'));
// foreach ($meteo['list'] as $date):
//     if ($date['dt_txt'] == $datePlus1) { 
//         echo '<p>'.$date['dt_txt'].'</p>';
//     }
// endforeach;

//---------- afficher la date d'apres demain à 12:00
// $datePlus2 = new DateTime('tomorrow');
// $datePlus2->modify('+1 day');
// echo '<p>'.$datePlus2->format('Y-m-d 12:00:00').'</p>';

//---------- afficher la date d'apres d'apres demain à 12:00
// $datePlus3 = new DateTime('tomorrow');
// $datePlus3->modify('+2 day');
// echo '<p>'.$datePlus3->format('Y-m-d 12:00:00').'</p>';

?>

@endsection

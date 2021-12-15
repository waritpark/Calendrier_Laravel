<?php 
// ------------------------------ fichier temporaire ------------------------------

// -------- les requetes du dashboard pour utiliser l'API meteo --------
// 
// --- dashboard.blade.php ---
// 
// Affiche l'image de la météo de demain à 12:00
// if ($newDate1 == $date):
//     foreach ($meteo['meteoTomorrow']['list'] as $dateTomorrow1):
//         if ($dateTomorrow1['dt_txt'] == $datePlus1): ?>
               <!-- <img class="position-absolute meteo-img top-0 right-0" src="http://openweathermap.org/img/wn/<?php // echo $dateTomorrow1['weather'][0]['icon'] ?>@2x.png" alt="meteo after tomorrow"> -->
               <?php
//         endif;
//     endforeach;
// endif;

// Affiche l'image de la météo d'apres demain à 12:00
// if ($newDate2 == $date):
//     foreach ($meteo['meteoTomorrow']['list'] as $dateTomorrow2):
//         if ($dateTomorrow2['dt_txt'] == $datePlus2): ?>
               <!-- <img class="position-absolute meteo-img top-0 right-0" src="http://openweathermap.org/img/wn/<?php // echo $dateTomorrow2['weather'][0]['icon'] ?>@2x.png" alt="meteo after tomorrow"> -->
               <?php
//         endif;
//     endforeach;
// endif;

// Affiche l'image de la météo d'apres d'apres demain à 12:00
// if ($newDate3 == $date):
//     foreach ($meteo['meteoTomorrow']['list'] as $dateTomorrow3):
//         if ($dateTomorrow3['dt_txt'] == $datePlus3): ?>
            <!-- <img class="position-absolute meteo-img top-0 right-0" src="http://openweathermap.org/img/wn/<?php // echo $dateTomorrow3['weather'][0]['icon'] ?>@2x.png" alt="meteo after tomorrow"> -->
            <?php
//         endif;
//     endforeach;
// endif;



// 
// 
// --- monthController ---
// 
// 

// $datePlus1 = $request->datePlus1;
// $tomorrow1 = $request->tomorrow1;
// $newDate1 = $request->newDate1;
// $datePlus2 = $request->datePlus2;
// $tomorrow2 = $request->tomorrow2;
// $newDate2 = $request->newDate2;
// $datePlus3 = $request->datePlus3;
// $tomorrow3 = $request->tomorrow3;
// $newDate3 = $request->newDate3;

// $datePlus1 = date('Y-m-d 12:00:00', strtotime('+1 day'));
// $tomorrow1 = date('Y-m-d', strtotime('+1 day'));
// $newDate1 = new DateTime($tomorrow1);
// $datePlus2 = date('Y-m-d 12:00:00', strtotime('+2 days'));
// $tomorrow2 = date('Y-m-d', strtotime('+2 days'));
// $newDate2 = new DateTime($tomorrow2);
// $datePlus3 = date('Y-m-d 12:00:00', strtotime('+3 days'));
// $tomorrow3 = date('Y-m-d', strtotime('+3 days'));
// $newDate3 = new DateTime($tomorrow3);


// 'datePlus1'=>$datePlus1, 
// 'tomorrow1'=>$tomorrow1, 
// 'newDate1'=>$newDate1, 
// 'datePlus2'=>$datePlus2, 
// 'tomorrow2'=>$tomorrow2, 
// 'newDate2'=>$newDate2, 
// 'datePlus3'=>$datePlus3, 
// 'tomorrow3'=>$tomorrow3, 
// 'newDate3'=>$newDate3
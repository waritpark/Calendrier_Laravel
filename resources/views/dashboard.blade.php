@extends('template')

@section('content')
<div id="meteo"></div>
    <div class="mb-5 d-flex align-items-center justify-content-center">
        <a class="arrow-rotate180" href="/calendar/dashboard/<?=$month->previousMonth()->month;?>-<?=$month->previousMonth()->year;?>">
            <img src="/images/arrow.png" class="arrow-btn">
        </a>
        <h1 class="mx-5 w-300 d-flex justify-content-center"><?php echo $month->toString(); ?></h1>
        <a class="" href="/calendar/dashboard/<?=$month->nextMonth()->month;?>-<?=$month->nextMonth()->year;?>">
            <img src="/images/arrow.png" class="arrow-btn">
        </a>
    </div>

    <table class="table table-bordered" id="calendar-table">
        <tr>
        <?php foreach($month->days as $s): ?>
            <th class="text-center align-middle border"><?php echo $s; ?></th>
        <?php endforeach; ?>
        </tr>
        <?php for($i = 0; $i < $weeks; $i++) {  ?>
            <tr>
            <?php
            foreach($month->days as $k => $day):
                $date = $start->modify("+" . ($k + $i * 7). "days");
                $isToday = date('Y-m-d') === $date->format('Y-m-d');

                $years = $date->format('Y');
                $months = $date->format('m');
                $days = $date->format('d');

                ?>
                <td class="w-14 align-top position-relative td-month-<?= $month->toStringMonth() ?> <?= $month->withinMonth($date) ? '' : 'bg-second'; ?><?= $isToday ? 'ajout-event-'.$month->toStringMonth().'' : ''; ?>">
                    <a class="position-absolute h-100 w-100 top-0 right-0" href="/calendar/dashboard/day-evenement/<?=$years?>-<?=$months?>-<?=$days?>"></a>
                    
                        {{-- Affiche l'image de la météo du jour actuel --}}
                        <?php if ($isToday == $date): ?>
                            <span id="meteocurrent"></span>
                        <?php endif; ?>

                        {{-- Affiche l'image de la météo de demain à 12:00 --}}
                        <?php if ($newDate1 == $date): ?>
                            <span id="meteoTomorrow1"></span>
                        <?php endif; ?>

                        {{-- Affiche l'image de la météo de demain à 12:00 --}}
                        <?php if ($newDate2 == $date): ?>
                            <span id="meteoTomorrow2"></span>
                        <?php endif; ?>

                        {{-- Affiche l'image de la météo de demain à 12:00 --}}
                        <?php if ($newDate3 == $date): ?>
                            <span id="meteoTomorrow3"></span>
                        <?php endif; ?>

                    <div class="fs-5"><?= $date->format('d');?></div>
                    <?php
                    // requete pour afficher les events dans les jours correspondant en fonction de l'utilisateur
                        $id_user = $request->session()->get('id_user');
                        $events = reqListEvents($id_user, $date);
                    ?>
                    @foreach ($events as $event)
                        <div class="container-calendar-event d-flex align-items-center fs-6">
                            <div><?= (new DateTimeImmutable($event->start))->format('H:i'); ?>&nbsp;-&nbsp;</div>
                            <div><?= $event->name ?></div>
                        </div>
                    @endforeach
                </td>
            <?php endforeach; ?>
            </tr>
        <?php } ?>
    </table>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function domReady(current, tomorrow) {
            if (document.readyState === 'complete') {
                current();
                tomorrow();

            } else {
                document.addEventListener('DOMContentLoaded', current);
                document.addEventListener('DOMContentLoaded', tomorrow);
            }
        }

        domReady(function() {
            $.ajax({
                url : 'http://api.openweathermap.org/data/2.5/weather',
                data : { id : "2969562", units : "metric", lang : "fr", appid : "f4d090607714c839e119246f24a205f1", mode : "json" },
                dataType:'json',
                success : current,
                error : currentErreur
            });

            function current(data) {
                var iconcurrent = data.weather[0].icon;
                document.getElementById("meteocurrent").innerHTML = '<img class="position-absolute meteo-img top-0 right-0" src="http://openweathermap.org/img/wn/'+iconcurrent+'@2x.png" alt="meteo today">'
            }
    
            function currentErreur(jqXHR, textStatus, errorThrown) {
                alert("Erreur " + errorThrown + " : " + textStatus);
            }
        });

        domReady(function() {
            $.ajax({
                url : 'http://api.openweathermap.org/data/2.5/forecast',
                data : { id : "2969562", units : "metric", lang : "fr", appid : "f4d090607714c839e119246f24a205f1", mode : "json" },
                dataType:'json',
                success : tomorrow,
                error : tomorrowErreur
            });

            function tomorrow(data) {
                // Meteo de demain
                var datePlus1 = new Date();
                datePlus1.setDate(datePlus1.getDate() + 1);
                datePlus1.setHours(12);
                datePlus1.setMinutes(0);
                datePlus1.setSeconds(0);
                datePlus1.setMilliseconds(0);
                // getMonth affiche -1 mois car il commence à 0 pour janvier
                formated_datePlus1 = datePlus1.getFullYear() + "-" + (datePlus1.getMonth()+1) + "-" + datePlus1.getDate() +' '+ "12:00:00";
                // console.log(datePlus1);
                // console.log(formated_datePlus1);
                // console.log(data.list[0].dt_txt);
                data.list.forEach(function each(item1) {
                    if (formated_datePlus1 == item1.dt_txt) {
                        // console.log(item);
                        var iconTomorrow1 = item1.weather[0].icon;
                        document.getElementById("meteoTomorrow1").innerHTML = '<img class="position-absolute meteo-img top-0 right-0" src="http://openweathermap.org/img/wn/'+iconTomorrow1+'@2x.png" alt="meteo tomorrow">'
                    }
                });

                // Meteo d'apres demain
                var datePlus2 = new Date();
                datePlus2.setDate(datePlus2.getDate() + 2);
                datePlus2.setHours(12);
                datePlus2.setMinutes(0);
                datePlus2.setSeconds(0);
                datePlus2.setMilliseconds(0);
                formated_datePlus2 = datePlus2.getFullYear() + "-" + (datePlus2.getMonth()+1) + "-" + datePlus2.getDate() +' '+ "12:00:00";
                // console.log(datePlus2);
                // console.log(formated_datePlus2);
                data.list.forEach(function each(item2) {
                    if (formated_datePlus2 == item2.dt_txt) {
                        // console.log(item2);
                        var iconTomorrow2 = item2.weather[0].icon;
                        document.getElementById("meteoTomorrow2").innerHTML = '<img class="position-absolute meteo-img top-0 right-0" src="http://openweathermap.org/img/wn/'+iconTomorrow2+'@2x.png" alt="meteo tomorrow">'
                    }
                });

                // Meteo d'apres demain
                var datePlus3 = new Date();
                datePlus3.setDate(datePlus3.getDate() + 3);
                datePlus3.setHours(12);
                datePlus3.setMinutes(0);
                datePlus3.setSeconds(0);
                datePlus3.setMilliseconds(0);
                formated_datePlus3 = datePlus3.getFullYear() + "-" + (datePlus3.getMonth()+1) + "-" + datePlus3.getDate() +' '+ "12:00:00";
                // console.log(datePlus3);
                // console.log(formated_datePlus3);
                data.list.forEach(function each(item3) {
                    if (formated_datePlus3 == item3.dt_txt) {
                        // console.log(item3);
                        var iconTomorrow3 = item3.weather[0].icon;
                        document.getElementById("meteoTomorrow3").innerHTML = '<img class="position-absolute meteo-img top-0 right-0" src="http://openweathermap.org/img/wn/'+iconTomorrow3+'@2x.png" alt="meteo tomorrow">'
                    }
                });
            }

            function tomorrowErreur(jqXHR, textStatus, errorThrown) {
                alert("Erreur " + errorThrown + " : " + textStatus);
            }
        });



    </script>
@endsection

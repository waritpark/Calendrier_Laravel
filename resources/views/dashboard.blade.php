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
                    <?php
                    
                        // Affiche l'image de la météo du jour actuel
                        if ($isToday == $date): ?>
                            <span id="meteocurrent"></span>
                        <?php
                        endif;


                        
                    ?>

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
                icontomorrow = data.list[2].dt_txt;
                console.log(icontomorrow);
                console.log(data);
                // document.getElementById("icontomorrow").innerHTML = '<img class="position-absolute meteo-img top-0 right-0" src="http://openweathermap.org/img/wn/'+icontomorrow+'@2x.png" alt="meteo today">'
            }
            function tomorrowErreur(jqXHR, textStatus, errorThrown) {
                alert("Erreur " + errorThrown + " : " + textStatus);
            }
        });



    </script>
@endsection

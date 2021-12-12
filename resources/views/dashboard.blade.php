@extends('template')

@section('content')

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
                $date= $start->modify("+" . ($k + $i * 7). "days");
                $isToday = date('Y-m-d') === $date->format('Y-m-d');

                $years = $date->format('Y');
                $months = $date->format('m');
                $days = $date->format('d');

                ?>
                <td class="w-14 align-top position-relative td-month-<?= $month->toStringMonth() ?> <?= $month->withinMonth($date) ? '' : 'bg-second'; ?><?= $isToday ? 'ajout-event-'.$month->toStringMonth().'' : ''; ?>">
                    <a class="position-absolute h-100 w-100 top-0 right-0" href="/calendar/dashboard/day-evenement/<?=$years?>-<?=$months?>-<?=$days?>"></a>
                    <?php
                    // Affiche l'image de la météo du jour actuel
                    $meteo1 = MeteoEventCurrent();
                    foreach ($meteo1["weather"] as $weather):
                        if ($isToday == $date): ?>
                            <img class="position-absolute meteo-img top-0 right-0" src="http://openweathermap.org/img/wn/<?php echo $weather["icon"] ?>@2x.png" alt="meteo today">
                        <?php
                        endif;
                    endforeach;

                    // Affiche l'image de la météo du lendemain à 12:00
                    $meteo2 = MeteoEventTomorrow();
                    $datePlus1 = date('Y-m-d 12:00:00', strtotime('tomorrow'));
                    $tomorrow1 = date('Y-m-d', strtotime('tomorrow')) === $date->format('Y-m-d');
                    // dd($datePlus1);
                    if ($tomorrow1 == $date):
                        foreach ($meteo2['list'] as $dateTomorrow1):
                            if ($dateTomorrow1['dt_txt'] == $datePlus1): ?>
                             <img class="position-absolute meteo-img top-0 right-0" src="http://openweathermap.org/img/wn/<?php echo $dateTomorrow1['weather'][0]['icon'] ?>@2x.png" alt="meteo tomorrow">
                             <?php
                            endif;
                        endforeach;
                    endif;

                    // Affiche l'image de la météo d'apres demain à 12:00
                    $datePlus2 = date('Y-m-d 12:00:00', strtotime('+2 days'));
                    $tomorrow2 = date('Y-m-d', strtotime('+2 days')) === $date->format('y-m-d');
                    // dd($datePlus1, $datePlus2, $tomorrow1, $tomorrow2, $date);
                    if ($tomorrow2 == $date):
                        foreach ($meteo2['list'] as $dateTomorrow2):
                            if ($dateTomorrow2['dt_txt'] == $datePlus2): ?>
                             <img class="position-absolute meteo-img top-0 right-0" src="http://openweathermap.org/img/wn/<?php echo $dateTomorrow2['weather'][0]['icon'] ?>@2x.png" alt="meteo after tomorrow">
                             <?php
                            endif;
                        endforeach;
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
@endsection

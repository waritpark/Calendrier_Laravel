@extends('template')

@section('content')

<?php setlocale (LC_TIME, 'fr.utf8'); ?>
    <div class="col-12">
        <div class="d-flex align-items-center justify-content-between">
            <h2 class="w-max-content m-0"><?= strftime('%A %d %B %Y', strtotime($date1));?></h2>
            <?php

            // Affiche l'image de la météo du jour actuel -> appel de la fonction pour utiliser l'api, 
            // création d'une date en string puis création d'une datetime avec les valeurs de la date en string, 
            // ce qui va permettre de faire la condition suivante : 
            // si la nouvelle date qui correspond à aujourd'hui est égale à celle de la journée selectionné (qui est dans l'url) alors tu m'affiches le résultat
            $meteo = meteoCurl();
            // dd($meteo);
            $today = date('Y-m-d');
            $newDate = new DateTime($today);
            foreach ($meteo["meteoCurrent"]['weather'] as $weather):
                if ($newDate == $date): ?>
                    <div>
                        <span class="font-family-roboto fs-5 me-3">Température : <span class="fw-bolder"><?php echo round($meteo["meteoCurrent"]["main"]["temp"])?>°C</span></span>
                        <img class="meteo-img-event" src="http://openweathermap.org/img/wn/<?php echo $weather["icon"] ?>@2x.png" alt="meteo today">
                    </div>
                <?php
                endif;
            endforeach;

            // Affiche l'image de la météo du lendemain à 12:00
            $datePlus1 = date('Y-m-d 12:00:00', strtotime('+1 day'));
            $tomorrow1 = date('Y-m-d', strtotime('+1 day'));
            $newDate1 = new DateTime($tomorrow1);
            if ($newDate1 == $date):
                foreach ($meteo['meteoTomorrow']['list'] as $dateTomorrow1):
                    if ($dateTomorrow1['dt_txt'] == $datePlus1): ?>
                        <div>
                            <span class="font-family-roboto fs-5 me-3">Température : <span class="fw-bolder"><?php echo round($dateTomorrow1['main']['temp'])?>°C</span></span>
                            <img class="meteo-img-event" src="http://openweathermap.org/img/wn/<?php echo $dateTomorrow1['weather'][0]['icon'] ?>@2x.png" alt="meteo tomorrow">
                        </div>
                        <?php
                    endif;
                endforeach;
            endif;

            // Affiche l'image de la météo d'apres demain à 12:00
            $datePlus2 = date('Y-m-d 12:00:00', strtotime('+2 days'));
            $tomorrow2 = date('Y-m-d', strtotime('+2 days'));
            $newDate2 = new DateTime($tomorrow2);
            if ($newDate2 == $date):
                foreach ($meteo['meteoTomorrow']['list'] as $dateTomorrow2):
                    if ($dateTomorrow2['dt_txt'] == $datePlus2): ?>
                        <div>
                            <span class="font-family-roboto fs-5 me-3">Température : <span class="fw-bolder"><?php echo round($dateTomorrow2['main']['temp'])?>°C</span></span>
                            <img class="meteo-img-event" src="http://openweathermap.org/img/wn/<?php echo $dateTomorrow2['weather'][0]['icon'] ?>@2x.png" alt="meteo after tomorrow">
                        </div>
                        <?php
                    endif;
                endforeach;
            endif;

            // Affiche l'image de la météo d'apres d'apres demain à 12:00
            $datePlus3 = date('Y-m-d 12:00:00', strtotime('+3 days'));
            $tomorrow3 = date('Y-m-d', strtotime('+3 days'));
            $newDate3 = new DateTime($tomorrow3);
            if ($newDate3 == $date):
                foreach ($meteo['meteoTomorrow']['list'] as $dateTomorrow3):
                    if ($dateTomorrow3['dt_txt'] == $datePlus3): ?>
                        <div>
                            <span class="font-family-roboto fs-5 me-3">Température : <span class="fw-bolder"><?php echo round($dateTomorrow3['main']['temp'])?>°C</span></span>
                            <img class="meteo-img-event" src="http://openweathermap.org/img/wn/<?php echo $dateTomorrow3['weather'][0]['icon'] ?>@2x.png" alt="meteo after tomorrow">
                        </div>
                        <?php
                    endif;
                endforeach;
            endif;

            ?>
        </div>
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th class="col-3" scope="col">Heures</th>
                    <th class="col-3" scope="col">Noms</th>
                    <th class="col-3" scope="col">Descriptions</th>
                    <th class="col-3" scope="col">Actions</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                <?php foreach($events as $event): ?>
                    <tr class="align-items-center fs-6">
                        <td><?php echo (new DateTimeImmutable($event->start))->format('H:i'); ?></td>
                        <td><?php echo $event->name; ?></td>
                        <td><?php echo $event->description;?></td>
                        <td>
                            <a class="btn text-black btn-warning bg-gradient p-2" href="{{ route('edit.event.dashboard', $event->id) }}">Modifier</a>
                            <a class="btn text-white btn-danger bg-gradient p-2" href="{{ route('delete.event.dashboard', $event->id) }}">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <button type="button" class="btn btn-success" id="btn-afficher-form" onclick="afficherForm()">Ajouter un événement</button>
    </div>
    <div class="col-12 d-none mt-4" id="container-form-ajout-event">
        <h2>Ajout d'un nouvel événement</h2>
        <form action="{{ route('store.event.dashboard') }}" method="post" class="mt-4 form-ajout-event">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nom</label>
                <input type="text" class="form-control" id="name" name="name">

            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea type="text" class="form-control" name="description" id="description"></textarea>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control" name="date" id="date" value="<?= isset($data['date']) ? $data['date'] : ''; ?>">
            </div>
            <div class="mb-3">
                <label for="start" class="form-label">Début de l'événement</label>
                <input type="time" class="form-control" name="start" id="start">

            </div>
            <div class="mb-3">
                <label for="end" class="form-label">fin de l'événement</label>
                <input type="time" class="form-control" name="end" id="end">

            </div>
            <button type="submit" class="btn btn-primary mb-4">Ajouter</button>
        </form>
    </div>



@endsection
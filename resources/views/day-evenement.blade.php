@extends('template')

@section('content')

<?php setlocale (LC_TIME, 'fr.utf8'); ?>
<div class="height-body container mt-4">
    <div class="col-12">
        <div class="d-flex align-items-center justify-content-between">
            <h2 class="color-green w-max-content m-0 fw-bold"><?= strftime('%A %d %B %Y', strtotime($date1));?></h2>
            <input type="hidden" id="var_date" value="<?php echo $date1; ?>"/>

            {{-- Affiche l'image de la météo du jour actuel -> appel de la fonction pour utiliser l'api, 
            création d'une date en string puis création d'une datetime avec les valeurs de la date en string, 
            ce qui va permettre de faire la condition suivante : 
            si la nouvelle date qui correspond à aujourd'hui est égale à celle de la journée selectionné (qui est dans l'url) alors tu m'affiches le résultat --}}

            {{-- Affiche l'image et la temperature de la météo du jour actuel --}}
            <?php if ($newDate == $date): ?>
            <div class="d-flex align-items-center">
                <span class="font-family-roboto fs-6 me-3">
                    <span class="fw-bolder" id="tempcurrent"></span>
                </span>
                <span id="meteocurrent"></span>
            </div>
            <?php endif; ?>

            {{-- Affiche l'image et la temperature de la météo de demain à 12:00 --}}
            <?php if ($newDate1 == $date): ?>
            <div class="d-flex align-items-center">
                <span class="font-family-roboto fs-6 me-3">
                    <span class="fw-bolder" id="temp1"></span>
                </span>
                <span id="meteoTomorrow1"></span>
            </div>
            <?php endif; ?>

            {{-- Affiche l'image et la temperature de la météo d'apres demain à 12:00 --}}
            <?php if ($newDate2 == $date): ?>
            <div class="d-flex align-items-center">
                <span class="font-family-roboto fs-6 me-3">
                    <span class="fw-bolder" id="temp2"></span>
                </span>
                <span id="meteoTomorrow2"></span>
            </div>
            <?php endif; ?>

            {{-- Affiche l'image et la temperature de la météo d'apres d'apres demain à 12:00 --}}
            <?php if ($newDate3 == $date): ?>
            <div class="d-flex align-items-center">
                <span class="font-family-roboto fs-6 me-3">
                    <span class="fw-bolder" id="temp3"></span>
                </span>
                <span id="meteoTomorrow3"></span>
            </div>
            <?php endif; ?>

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
                            <a class="a-img-day-event btn bg-color-yellow me-2" href="{{ route('edit.event.dashboard', $event->id) }}"><img class="img-day-event" src="{{ asset('images/edit.png') }}" alt="edit"></a>
                            <a class="a-img-day-event btn bg-color-red" href="{{ route('delete.event.dashboard', $event->id) }}"><img class="img-day-event" src="{{ asset('images/trash.png') }}" alt="trash"></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <button type="button" class="box-shadow-submit btn bg-color-white px-4 py-2 w-auto" id="btn-afficher-form" onclick="afficherForm()">Ajouter un événement</button>
    </div>
    <div class="col-12 d-none mt-4" id="container-form-ajout-event">
        <div class="col-5 mx-auto">
            <h2 class="color-green d-flex justify-content-center w-100 m-0 fw-bold mt-5">Ajout d'un nouvel événement</h2>
            <form action="{{ route('store.event.dashboard') }}" method="post" class="mt-4">
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
                    <input type="date" class="form-control" name="date" id="date" value="<?= isset($dataDate['date']) ? $dataDate['date'] : ''; ?>">
                </div>
                <div class="mb-3">
                    <label for="start" class="form-label">Début de l'événement</label>
                    <input type="time" class="form-control" name="start" id="start">

                </div>
                <div class="mb-3">
                    <label for="end" class="form-label">fin de l'événement</label>
                    <input type="time" class="form-control" name="end" id="end">

                </div>
                <button type="submit" class="box-shadow-submit btn bg-color-white px-4 py-2 mb-4 w-auto">Ajouter</button>
            </form>
        </div>
    </div>
</div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('javascript/requestsDayEvent.js') }}"></script>

@endsection
@extends('template')

@section('content')

<?php setlocale (LC_TIME, 'fr.utf8'); ?>
    <div class="col-12">
        <h2 class="w-max-content m-0 mb-4"><?= strftime('%A %d %B %Y', strtotime($date1));?></h2>
        <table class="table table-striped">
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
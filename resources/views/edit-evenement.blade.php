@extends('template')

@section('content')

<?php 

?>

<div class="col-12 mt-4" id="container-form-ajout-event">
    <h2 class="h2">Modifier l'événement : </h2>
    <form action="{{ route('update.dashboard', $event->id) }}" method="POST" class="mt-4 form-ajout-event">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $event->name }}">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea type="text" class="form-control" name="description" id="description">{{ $event->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" name="date" id="date" value="{{ (new DateTime($event->start))->format('Y-m-d') }}">
        </div>
        <div class="mb-3">
            <label for="start" class="form-label">Début de l'événement</label>
            <input type="time" class="form-control" name="start" id="start" value="{{ (new DateTime($event->start))->format('H:i') }}">
            @error('start')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="end" class="form-label">fin de l'événement</label>
            <input type="time" class="form-control" name="end" id="end" value="{{ (new DateTime($event->end))->format('H:i') }}">
            @error('end')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary mb-4">Modifier</button>
    </form>
</div>

@endsection
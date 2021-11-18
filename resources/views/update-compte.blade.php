@extends('template')

@section('content')
<div class="col-6">
    <h2>Modifier les informations</h2>
    <form action="{{ route('update.compte.dashboard') }}" method="post" class="mt-4">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="email" class="form-label">Adresse mail</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= Auth::user()->email ?>">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" class="form-control" name="name" id="name" value="<?= Auth::user()->name  ?>">
        </div>
        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" class="form-control" name="prenom" id="prenom" value="<?= Auth::user()->prenom  ?>">
        </div>
        <div id="pass1">

        </div>

        <div id="pass2">

        </div>

        <div class="d-flex justify-content-between" id="container-btn">
            <div class="btn btn-secondary mb-4 d-none" id="btnCheck" onclick="suppPass()">Annuler</div>
            <div class="btn btn-secondary mb-4" id="btnPass" onclick="afficherPass()">Modifier le mot de passe</div>
            <button type="submit" class="btn btn-primary mb-4">Enregistrer</button>
        </div>
    </form>
</div>

@endsection

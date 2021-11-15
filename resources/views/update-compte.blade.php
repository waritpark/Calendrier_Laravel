@extends('template')

@section('content')

<h2>Modifier les informations</h2>
<form action="" method="post" class="mt-4 form-ajout-event">
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
    <div class="mb-3">
        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" onclick="afficherPass()" class="form-control" name="password" id="password" value="<?= Auth::user()->password  ?>">
    </div>
    <div class="mb-3 d-none" id="pass2">
        <label for="password2" class="form-label">Répétez le nouveau mot de passe</label>
        <input type="password" class="form-control" name="password2" id="password2">
    </div>
    <button type="submit" class="btn btn-primary mb-4">Modifier</button>
</form>

@stop

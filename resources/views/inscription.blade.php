@extends('template')

@section('content')
    <div class="row text-center justify-content-center">
        <div class="col-6">
            <h2>Inscription</h2>
            <form action="{{ route('inscription.post')}}" method="post" class="mt-4">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Adresse mail</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email">
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Nom</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name">
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control @error('prenom') is-invalid @enderror" name="prenom" id="prenom">
                @error('prenom')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" autocomplete="off" class="form-control @error('password') is-invalid @enderror" name="password" id="password">
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="alert alert-secondary" id="passwordStrength">Jauge de fiabilité du mot de passe</div>
            <div class="mb-3">
                <label for="password2" class="form-label">Répétez le mot de passe</label>
                <div class="d-flex">
                    <input type="password" autocomplete="off" class="form-control @error('password2') is-invalid @enderror" name="password2" id="password2">
                    <button type="button" onclick="checkpass()" class="ms-2 btn text-white btn-primary">Vérification</button>
                </div>
                @error('password2')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-2 alert alert-secondary" id="egalpass">Vérifiez si vos mots de passe sont identiques avec le bouton "Vérification".</div>
            <button type="submit" class="btn btn-primary mb-4">Inscription</button>
            </form>
        </div>
    </div>

@endsection
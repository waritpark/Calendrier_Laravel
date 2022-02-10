@extends('template')

@section('content')
<div class="height-body container d-flex flex-column mt-4">
    <div class="row text-center justify-content-center mt-5">
        <div class="col-8 col-xl-6">
            <h2 class="color-green text-uppercase fw-bold">Inscription</h2>
            <form action="{{{  route('inscription.post') }}}" method="post" class="mt-4">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Adresse mail</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email">
                @error('email')
                    <div class="alert alert-danger">{{{  $message  }}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Nom</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name">
                @error('name')
                    <div class="alert alert-danger">{{{  $message  }}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control @error('prenom') is-invalid @enderror" name="prenom" id="prenom">
                @error('prenom')
                    <div class="alert alert-danger">{{{  $message  }}}</div>
                @enderror
            </div>
            <div class="">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" autocomplete="off" onkeyup="logKey()" class="form-control @error('password') is-invalid @enderror" name="password" id="password">
                @error('password')
                    <div class="alert alert-danger">{{{  $message  }}}</div>
                @enderror
            </div>
            <div class="alert alert-secondary" id="passwordStrength">Jauge de fiabilité du mot de passe</div>
            <div class="">
                <label for="password2" class="form-label">Répétez le mot de passe</label>
                <input type="password" onkeyup="checkpass()" autocomplete="off" class="form-control @error('password2') is-invalid @enderror" name="password2" id="password2">
                @error('password2')
                    <div class="alert alert-danger">{{{  $message  }}}</div>
                @enderror
            </div>
            <div class="alert alert-secondary" id="egalpass">Vérification de l'égalité vos mots de passe</div>
            <button type="submit" class="box-shadow-submit btn bg-color-white px-4 py-2 w-auto mt-2 mb-4">Inscription</button>
            </form>
        </div>
    </div>
</div>

@endsection

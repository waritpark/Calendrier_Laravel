@extends('template')

@section('content')
    <div class="row text-center justify-content-center">
        <div class="col-6">
            <h2>Connexion</h2>
            <form action="connexion" method="post" class="mt-4">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Adresse mail</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary w-auto">Connexion</button>
                    <a href="" class="w-auto">Mot de passe oublié ?</a>
                </div>
            </form>
        </div>
    </div>
@stop
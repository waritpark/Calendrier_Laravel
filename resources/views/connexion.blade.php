@extends('template')

@section('content')
<div class="height-body d-flex justify-content-center flex-column container">
    <div class="row text-center justify-content-center">
        <div class="col-7 col-xl-6">
            <h2 class="color-green text-uppercase fw-bold">Connexion</h2>
            <form action="connexion" method="post" class="mt-4">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Adresse mail</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email">
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" autocomplete="off" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-between" id="password-forget">
                    <button type="submit" class="box-shadow-submit btn bg-color-white px-4 py-2 w-auto">Connexion</button>
                    <a href="" class="color-green w-auto">Mot de passe oublié ?</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

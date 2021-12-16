@extends('template')

@section('content')
<div class="height-body container">
    <div class="d-flex justify-content-center align-items-center vh-50 flex-column">
        <img class="logo-accueil mb-5 mt-200px" src="{{ asset('images/logo.png') }}" alt="">
        <h1 class="font-family-exo color-green text-uppercase fw-bold text-center font-size70 mb-3">Porject Calendar</h1>
        <h2 class="h6 fw-light font-family-roboto w-100 d-flex justify-content-center">Projet réalisé durant l'alternance d'Onlineformapro</h2>
    </div>
</div>
@endsection
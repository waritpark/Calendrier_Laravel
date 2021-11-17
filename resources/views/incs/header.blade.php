<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/calendar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Calendrier</title>
</head>
<body>
    <header class="container-fluid py-3 bg-light">
        @auth
        <nav class="position-relative">
            <ul class="nav flex-row align-items-center">
                <a class="text-sm-center nav-link text-dark" href="{{ route('accueil.dashboard') }}"><h1 class="h3 font-family-exo text-uppercase"><li>Calendar Project</li></h1></a>
                <a class="text-sm-center nav-link text-dark" href="{{ route('accueil.dashboard') }}"><li>Mon calendrier</li></a>
                <a class="text-sm-center nav-link text-dark" href="{{ route('new.event.dashboard') }}"><li>Nouvel événement</li></a>
                <a class="text-sm-center nav-link text-dark" href="{{ route('compte.dashboard') }}"><li>Mon compte</li></a>
                @if(Auth::user()->role_user===1)
                    <a class="text-sm-center nav-link text-dark" href="{{ route('stats.dashboard') }}"><li>Statistiques</li></a>
                @endif
                <a class="position-absolute right-70 text-sm-center nav-link text-dark" href="{{ route('deconnexion') }}"><li>Déconnexion</li></a>
            </ul>
        </nav>
        @endauth
        @if(Auth::user()=="")
        <nav class="position-relative">
            <ul class="nav flex-row align-items-center">
                <a class="text-sm-center nav-link text-dark" href="{{ route('accueil') }}"><h1 class="h3 font-family-exo text-uppercase"><li>Calendar Project</li></h1></a>
                <a class="text-sm-center nav-link text-dark" href="{{ route('accueil') }}"><li>Accueil</li></a>
                <a class="text-sm-center nav-link text-dark" href="{{ route('connexion') }}"><li>Connexion</li></a>
                <a class="text-sm-center nav-link text-dark" href="{{ route('inscription') }}"><li>Inscription</li></a>
            </ul>
        </nav>
        @endif
    </header>
    <div class="height-body container mt-4">


        
        
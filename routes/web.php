<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MonthController;
use App\Http\Controllers\CompteController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\IdentificationController;

// route de base
Route::get('/', function () {
    return view('accueil');
})->name('accueil');

// routes de la page connexion et du traitement de la connexion
Route::get('/connexion', [IdentificationController::class, 'connexion'])->name('connexion');
Route::post('/connexion', [IdentificationController::class, 'connexionPost'])->name('connexion.post');

// routes de la page d'inscription et du traitement de l'inscription
Route::get('/inscription', [IdentificationController::class, 'inscription'])->name('inscription');
Route::post('/inscription', [IdentificationController::class, 'inscriptionPost'])->name('inscription.post');

// route de la déconnexion
Route::get('/deconnexion', function () {
    //session()->forget();
    session()->flush();
    return redirect()->route('accueil');
});

//////////----- ROUTES DASHBOARD -----////////////

// route de la page standard du dashboard
Route::get('/dashboard', [MonthController::class, 'index'])->middleware('auth')->name('accueil.dashboard');

// route des pages de chaque mois
Route::get('/dashboard{month}{year}', [MonthController::class, 'viewMonth'])->middleware('auth');

// route pour afficher le formulaire de creation d'event
Route::get('/create-evenement', [EventsController::class, 'create'])->middleware('auth')->name('create.dashboard');

// route pour le traitement du formulaire de creation d'event
Route::post('/store-evenement', [EventsController::class, 'store'])->middleware('auth')->name('store.dashboard');

// route pour afficher les events d'un jour
Route::get('/day-evenement', [EventsController::class, 'viewDay'])->middleware('auth')->name('day.dashboard');

// route pour afficher le compte
Route::get('/compte', [CompteController::class, 'viewCompte'])->middleware('auth')->name('compte.dashboard');


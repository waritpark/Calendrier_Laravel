<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MonthController;
use App\Http\Controllers\CompteController;
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

// route pour afficher une journée
Route::get('/day-evenement{day}', [MonthController::class, 'viewDay'])->middleware('auth');

// route pour afficher le compte
Route::get('/compte', [CompteController::class, 'viewCompte'])->middleware('auth')->name('compte.dashboard');


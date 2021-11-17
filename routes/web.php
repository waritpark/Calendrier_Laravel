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

//////////----- ROUTES IDENTIFICATION -----////////////

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
})->name('deconnexion');

//////////----- ROUTES DASHBOARD -----////////////

// route de la page standard du dashboard
Route::get('/dashboard', [MonthController::class, 'index'])->middleware('auth')->name('accueil.dashboard');

// route des pages de chaque mois
Route::get('dashboard/{month}-{year}', [MonthController::class, 'index'])->middleware('auth');

// route pour afficher le formulaire de creation d'event
Route::get('dashboard/new-evenement', [EventsController::class, 'newEvent'])->middleware('auth')->name('new.event.dashboard');

// route pour le traitement du formulaire de creation d'event
Route::post('dashboard/store-evenement', [EventsController::class, 'store'])->middleware('auth')->name('store.dashboard');

// route pour afficher les events d'un jour
Route::get('dashboard/day-evenement/{years}-{months}-{days}', [EventsController::class, 'viewDay'])->middleware('auth')->name('day.dashboard');

// route pour afficher l'edition un event 
Route::get('dashboard/edit-evenement/{id}', [EventsController::class, 'edit'])->middleware('auth')->name('edit.dashboard');

// route pour update un event 
Route::put('dashboard/edit-evenement/{id}/update', [EventsController::class, 'update'])->middleware('auth')->name('update.dashboard');

// route pour supprimer un event
Route::get('dashboard/delete-evenement/{id}', [EventsController::class, 'destroy'])->middleware('auth')->name('delete.dashboard');

// route pour afficher le compte
Route::get('dashboard/compte', [CompteController::class, 'viewCompte'])->middleware('auth')->name('compte.dashboard');

// route pour afficher les stats du site
Route::get('dashboard/stats', [IdentificationController::class, 'stats'])->middleware('auth')->name('stats.dashboard');

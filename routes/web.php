<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MonthController;
use App\Http\Controllers\MeteoController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\IdentificationController;

// routes de base
Route::get('/', function () {
    return view('accueil');
})->name('accueil');

Route::get('/calendar', function () {
    return view('accueil');
});

//////////----- ROUTES TESTS -----////////////

// route pour tester l'api meteo d'aujourd'hui
Route::get('calendar/dashboard/meteocurrent', [MeteoController::class, 'today'])->name('meteo.current');

// route pour tester l'api meteo des prochains jours
Route::get('calendar/dashboard/meteo', [MeteoController::class, 'tomorrow'])->name('meteo.tomorrow');


//////////----- ROUTES IDENTIFICATION -----////////////

// routes de la page connexion et du traitement de la connexion
Route::get('calendar/connexion', [IdentificationController::class, 'connexion'])->name('connexion');
Route::post('calendar/connexion', [IdentificationController::class, 'connexionPost'])->name('connexion.post');

// routes de la page d'inscription et du traitement de l'inscription
Route::get('calendar/inscription', [IdentificationController::class, 'inscription'])->name('inscription');
Route::post('calendar/inscription', [IdentificationController::class, 'inscriptionPost'])->name('inscription.post');

// route de la déconnexion
Route::get('calendar/deconnexion', function () {
    //session()->forget();
    session()->flush();
    return redirect()->route('accueil');
})->name('deconnexion');

//////////----- ROUTES DASHBOARD -----////////////

// route de la page standard du dashboard
Route::get('calendar/dashboard', [MonthController::class, 'index'])->middleware('auth')->name('accueil.dashboard');

// route des pages de chaque mois
Route::get('calendar/dashboard/{month}-{year}', [MonthController::class, 'index'])->middleware('auth');

// route pour afficher le formulaire de creation d'event
Route::get('calendar/dashboard/new/evenement', [EventsController::class, 'newEvent'])->middleware('auth')->name('new.event.dashboard');

// route pour le traitement du formulaire de creation d'event
Route::post('calendar/dashboard/store-evenement', [EventsController::class, 'store'])->middleware('auth')->name('store.event.dashboard');

// route pour afficher les events d'un jour
Route::get('calendar/dashboard/day-evenement/{years}-{months}-{days}', [EventsController::class, 'viewDay'])->middleware('auth')->name('day.event.dashboard');

// route pour afficher l'edition un event
Route::get('calendar/dashboard/update-evenement/{id}', [EventsController::class, 'edit'])->middleware('auth')->name('edit.event.dashboard');

// route pour update un event
Route::put('calendar/dashboard/update-evenement/{id}/update', [EventsController::class, 'update'])->middleware('auth')->name('update.event.dashboard');

// route pour supprimer un event
Route::get('calendar/dashboard/delete-evenement/{id}', [EventsController::class, 'destroy'])->middleware('auth')->name('delete.event.dashboard');

// route pour afficher le compte
Route::get('calendar/dashboard/compte', [IdentificationController::class, 'viewCompte'])->middleware('auth')->name('compte.user.dashboard');

// route pour update le compte de l'utilisateur
Route::put('calendar/dashboard/update/compte', [IdentificationController::class, 'updateCompte'])->middleware('auth')->name('update.compte.dashboard');

// route pour afficher les users du site
Route::get('calendar/dashboard/stats', [IdentificationController::class, 'stats'])->middleware('auth')->name('stats.users.dashboard');

// route pour afficher le formulaire de modification d'un utilisateur
Route::get('calendar/dashboard/edit/user/{id}', [IdentificationController::class, 'edit'])->middleware('auth')->name('edit.user.dashboard');

// route pour update un utilisateur
Route::put('calendar/dashboard/update/user/{id}', [IdentificationController::class, 'update'])->middleware('auth')->name('update.user.dashboard');

// route pour supprimer un utilisateur
Route::get('calendar/dashboard/destroy/user/{id}', [IdentificationController::class, 'destroyUser'])->middleware('auth')->name('destroy.user.dashboard');

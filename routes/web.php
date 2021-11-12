<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MonthController;
use App\Http\Controllers\IdentificationController;

Route::get('/', function () {
    return view('accueil');
})->name('accueil');

Route::get('/connexion', [IdentificationController::class, 'connexion'])->name('connexion');
Route::post('/connexion', [IdentificationController::class, 'connexionPost'])->name('connexion.post');


Route::get('/inscription', [IdentificationController::class, 'inscription'])->name('inscription');
Route::post('/inscription', [IdentificationController::class, 'inscriptionPost'])->name('inscription.post');

Route::get('/deconnexion', function () {
    //session()->forget();
    session()->flush();
    return redirect()->route('accueil');
});

Route::get('/dashboard', [MonthController::class, 'index'])->middleware('auth')->name('accueil.dashboard');
Route::get('/dashboard{month}{year}', [MonthController::class, 'viewMonth'])->middleware('auth');
Route::get('/day-evenement{day}', [MonthController::class, 'viewDay'])->middleware('auth');

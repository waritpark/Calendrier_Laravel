<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
|php artisan route:cache 
|php artisan cache:clear
|php artisan view:clear
|php artisan config:cache
|php artisan optimize
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [UserController::class, 'login']);
    Route::get('events', [UserController::class, 'eventByDay']);
    Route::post('logout', [UserController::class, 'logout']);
});

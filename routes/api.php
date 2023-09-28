<?php

use App\Http\Controllers\Api\CardController;
use App\Http\Controllers\Api\GameController;
use App\Http\Controllers\Api\MatchHistoryController;
use App\Http\Controllers\Api\RegistrationController;
use App\Http\Controllers\Api\RoundController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register', [RegistrationController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    // Trasy dotyczące gier
    Route::resource('/game', GameController::class);
    // Trasa dołączenia do gry
    Route::post('/joinGame/{game}', [GameController::class,'joinGame']);
    // Trasy dotyczące kart
    Route::resource('/card', CardController::class);
    Route::post('/chooseCard/{round}/{card}', [RoundController::class,'choseCard']);
    Route::get('/matchHistory', [MatchHistoryController::class,'matchHistory']);
});

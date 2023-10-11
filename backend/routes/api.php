<?php

use App\Http\Controllers\Api\{AuthController,
    CardController,
    DuelController,
    MatchHistoryController,
    RegistrationController,
    RoundController,
    UserController};
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

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('register', [RegistrationController::class, 'register']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware(['auth:sanctum'])->group(function () {
    // Trasy dotyczące gier
    Route::resource('duels', DuelController::class);
    // Trasa dołączenia do gry
    Route::get('/duels/active', [DuelController::class, 'show']);
    Route::post('/inviteToDuel/{duel}/{playerId}',[DuelController::class,'inviteDuel']);
    // Trasy dotyczące kart
    Route::resource('cards', CardController::class);
    Route::post('getNewCard', [CardController::class,'getNewCard']);
    Route::post('/chooseCard/{round}/{card}', [RoundController::class,'choseCard']);
    Route::get('/matchHistory', [MatchHistoryController::class,'matchHistory']);


    //User has just selected a card
    Route::post('duels/action', [DuelController::class, 'doRound']);

    //USER DATA
    Route::get('user-data', [UserController::class,'store']);
});

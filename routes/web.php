<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WordleController;
use App\Http\Controllers\ScoreboardController;
use App\Http\Controllers\UserRegistrationController;

// index
Route::get('/', function () {
    return view('index');
})->name('index');

// wordle game
Route::get('/wordle/{player}', [WordleController::class, 'index' ])
->name('wordle');
Route::redirect('/wordle', '/');

// scoreboard
Route::get('/scoreboard/{player}', [ScoreboardController::class, 'index' ])
->name('scoreboard');

// api
Route::group([
    'prefix' => '/api',
    'as' => 'api.',
], function () {
    Route::post('/user-registration', [UserRegistrationController::class, 'create']);
    Route::post('/score', [ScoreboardController::class, 'store']);
});

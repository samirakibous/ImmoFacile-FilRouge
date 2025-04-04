<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\cityController;
use Illuminate\Support\Facades\Route;
// require base_path('routes/api.php');
Require __DIR__.'/api.php';

Route::get('/', function () {
    return view('welcome');
});
Route::get('/signup', function () {
    return view('signup');
})->name('register');
Route::get('/login', function () {
    return view('login');
})->name('login');;
Route::get('/home', function () {
    return view('home');
})->name('home');
Route::get('/city/{cityName}/images', [cityController::class, 'showCityImages']);
Route::get('login/google', [AuthController::class, 'redirectToGoogle']);
Route::get('login/google/callback', [AuthController::class, 'handleGoogleCallback']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
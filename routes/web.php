<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\cityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
}); // Inscription
Route::post('/signup', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth');

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
// Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/article', function () {
    return view('article');
})->name('article');


Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/index', [AdminController::class, 'index'])->name('index');
    Route::get('/demandes', [AdminController::class, 'demandes'])->name('demandes');
    Route::put('/demandes/{id}', [AdminController::class, 'accepter'])->name('update');
    Route::delete('/demandes/{id}', [AdminController::class, 'refuser'])->name('destroy');

    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::post('users', [AdminController::class, 'create'])->name('users.create');

    Route::get('/users/{id}', [AdminController::class, 'show'])->name('users.show');
    Route::get('users/{id}/edit', [AdminController::class, 'edit'])->name('users.edit');
    Route::put('users/{id}', [AdminController::class, 'update'])->name('users.update');
    Route::delete('users/{id}', [AdminController::class, 'destroy'])->name('users.destroy');
});

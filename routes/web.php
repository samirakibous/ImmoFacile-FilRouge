<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\cityController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Profiler\Profile;

// Route::get('/', function () {
//     return view('welcome');
// }); // Inscription

// Route::get('/user', function (Request $request) { return $request->user();})->middleware('auth');

Route::get('/signup', function () {return view('signup');})->name('signup');
Route::post('/signup', [AuthController::class, 'register'])->name('signup');

Route::get('/login', function () {return view('login');})->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');



Route::get('/', function () {
    return view('home');
})->name('home');


Route::get('/city/{cityName}/images', [cityController::class, 'showCityImages']);
Route::get('login/google', [AuthController::class, 'redirectToGoogle']);
Route::get('login/google/callback', [AuthController::class, 'handleGoogleCallback']);
// Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/article', function () {
    return view('article');
})->name('article');


Route::get('/reactivate', [ProfileController::class, 'reactivate'])->name('profile.reactivate');


Route::middleware(['auth'])->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.update.photo');
    
    Route::get('/favoris', [ProfileController::class, 'favoris'])->name('profile.favoris');
    Route::get('/compte',[ProfileController::class, 'compte'])->name('profile.compte');
    Route::post('/compte', [ProfileController::class, 'update'])->name('account.update');
    Route::put('/account/password', [ProfileController::class, 'updatePassword'])->name('password.update');
    Route::post('desactivate' ,[ProfileController::class, 'desactivate'])->name('account.deactivate');




});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/index', [AdminController::class, 'index'])->name('index');
    Route::get('/demandes', [AdminController::class, 'demandes'])->name('demandes');
    Route::put('/demandes/{id}', [AdminController::class, 'accepter'])->name('demandes.update');
    Route::delete('/demandes/{id}', [AdminController::class, 'refuser'])->name('demandes.destroy');

    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::post('users', [AdminController::class, 'create'])->name('users.create');

    Route::get('/users/{id}', [AdminController::class, 'show'])->name('users.show');
    Route::get('users/{id}/edit', [AdminController::class, 'edit'])->name('users.edit');
    Route::put('users/{id}', [AdminController::class, 'update'])->name('users.update');
    Route::post('/users', [AdminController::class, 'store'])->name('users.store');
    Route::delete('users/{id}', [AdminController::class, 'destroy'])->name('users.destroy');
});

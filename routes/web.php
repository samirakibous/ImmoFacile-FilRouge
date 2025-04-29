<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\cityController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileAgentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Profiler\Profile;

// Route::get('/', function () {
//     return view('welcome');
// }); // Inscription

// Route::get('/user', function (Request $request) { return $request->user();})->middleware('auth');
// Route::post('/AddAnnonce', [PropertyController::class, 'store'])->name('properties.store');
Route::get('/signup', function () {
    return view('signup');
})->name('signup');
Route::post('/signup', [AuthController::class, 'register'])->name('signup');

Route::get('/login', function () {
    return view('login');
})->name('login');
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
    Route::get('/compte', [ProfileController::class, 'compte'])->name('profile.compte');
    Route::post('/compte', [ProfileController::class, 'update'])->name('account.update');
    Route::put('/account/password', [ProfileController::class, 'updatePassword'])->name('password.update');
    Route::post('desactivate', [ProfileController::class, 'desactivate'])->name('account.deactivate');
    Route::post('/delete', [ProfileController::class, 'delete'])->name('account.delete');

    Route::get('/agentsList', [HomeController::class, 'agentsList'])->name('agentsList');

    Route::get('ProfileAgent/{id}', [ProfileAgentController::class, 'showAgent'])->name('profile.agent');
});

Route::middleware(['auth', 'role:agent'])->prefix('agent')->group(function () {
    Route::get('/AddAnnonce', [ProfileAgentController::class, 'index'])->name('agent.AddAnnonce');
    Route::get('/stepper-form', [ProfileAgentController::class, 'index'])->name('agent.stepper.index');
    // Route::post('/stepper-form/step1', [ProfileAgentController::class, 'processStep1'])->name('stepper.step1');
    // Route::post('/stepper-form/step2', [ProfileAgentController::class, 'processStep2'])->name('stepper.step2');
    // Route::post('/stepper-form/step3', [ProfileAgentController::class, 'processStep3'])->name('stepper.step3');
    // Route::post('/stepper-form/step4', [ProfileAgentController::class, 'processStep4'])->name('stepper.step4');
    // Route::post('/stepper-form/step5', [ProfileAgentController::class, 'processStep5'])->name('stepper.step5');
    Route::post('/stepper-form/finish', [ProfileAgentController::class, 'finish'])->name('agent.stepper.finish');

    Route::post('/add-annonce', [PropertyController::class, 'store'])->name('properties.store');
    

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

    Route::get('/categories', [CategoryController::class, 'show'])->name('categories');
    Route::post('/categories/create', [CategoryController::class, 'store'])->name('categories.store');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');

    Route::get('/equipements', [CategoryController::class, 'show'])->name('equipements');
    Route::post('/equipements/create', [CategoryController::class, 'store'])->name('equipements.store');
    Route::delete('/equipements/{id}', [CategoryController::class, 'destroy'])->name('equipements.destroy');
    Route::put('/equipements/{id}', [CategoryController::class, 'update'])->name('equipements.update');
    
});

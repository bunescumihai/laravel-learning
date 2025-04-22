<?php

use App\Enums\RoleEnum;
use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

//Route::post('/clients/{client}/annonces/maison', [AnnonceController::class, 'storeMaison'])->name('annonces.store-maison');
//Route::post('/clients/{client}/annonces/terrain', [AnnonceController::class, 'storeTerrain'])->name('annonces.store-terrain');
//Route::get('/clients/{client}/annonces/maison', [AnnonceController::class, 'createMaison'])->name('annonces.create-maison');
//Route::get('/clients/{client}/annonces/terrain', [AnnonceController::class, 'createTerrain'])->name('annonces.create-terrain');

Route::prefix('/clients/{client}/annonces')->middleware(['auth', 'role:admin|manager'])->group(function () {
    Route::post('/maison', [AnnonceController::class, 'storeMaison'])->name('clients.annonces.store-maison');
    Route::post('/terrain', [AnnonceController::class, 'storeTerrain'])->name('clients.annonces.store-terrain');
    Route::get('/maison', [AnnonceController::class, 'createMaison'])->name('clients.annonces.create-maison');
    Route::get('/terrain', [AnnonceController::class, 'createTerrain'])->name('clients.annonces.create-terrain');
});

Route::resource('clients', ClientController::class)
    ->middleware(['auth', 'role:admin|manager'])
    ->except(['create']);

Route::put('annonces/{annonce}/terrain', [AnnonceController::class, 'updateTerrain'])->name('annonces.update-terrain');
Route::put('annonces/{annonce}/maison', [AnnonceController::class, 'updateMaison'])->name('annonces.update-maison');

Route::resource('annonces', AnnonceController::class)->except(['create', 'update']);

Route::resource('users', UserController::class)->middleware(['auth', 'role:admin']);

Route::get('/auth', AuthController::class)->name('login');
Route::post('/auth', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

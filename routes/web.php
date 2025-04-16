<?php

use App\Enums\RoleEnum;
use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::post('/annonces/create-maison/{client}', [AnnonceController::class, 'storeMaison'])->name('annonces.store-maison');
Route::post('/annonces/create-terrain/{client}', [AnnonceController::class, 'storeTerrain'])->name('annonces.store-terrain');

Route::get('/annonces/create-maison/{client}', [AnnonceController::class, 'createMaison'])->name('annonces.create-maison');
Route::get('/annonces/create-terrain/{client}', [AnnonceController::class, 'createTerrain'])->name('annonces.create-terrain');

Route::resource('annonces', AnnonceController::class)->except('create');
Route::resource('users', UserController::class)->middleware(['auth', 'role:admin']);
Route::resource('clients', ClientController::class)
    ->middleware(['auth', 'role:admin|manager'])
    ->except(['create']);



Route::get('/auth', AuthController::class)->name('auth');
Route::post('/auth', [AuthController::class, 'login'])->name('auth.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

<?php

use App\Enums\RoleEnum;
use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::resource('client', ClientController::class);

Route::resource('annonce', AnnonceController::class);

Route::get('/auth', AuthController::class)->name('auth');
Route::post('/auth', [AuthController::class, 'login'])->name('auth');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/users', [UserController::class, 'list'])->name('user.list');
    Route::get('/user', [UserController::class, 'createView'])->name('user.createView');
    Route::post('/user', [UserController::class, 'create'])->name('user.create');
    Route::get('/user/edit/{id}', [UserController::class, 'editView'])->name('user.editView');
    Route::put('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::delete('/user/{id}', [UserController::class, 'delete'])->name('user.delete');
});

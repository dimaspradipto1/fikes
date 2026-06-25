<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'login')->name('login');
    Route::get('/login', 'login');
    Route::post('/login', 'authenticate')->name('authenticate');
    Route::post('/logout', 'logout')->name('logout');
});

/*
|--------------------------------------------------------------------------
| Protected Routes (harus login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'checkrole'])->group(function () {

    Route::get('/dashboard', function () {
        return view('layouts.dashboard.index');
    })->name('dashboard');

    // Resource User (index, create, store, show, edit, update, destroy)
    Route::resource('user', UserController::class);

    // Resource Kontak (index, create, store, edit, update, destroy)
    Route::resource('kontak', KontakController::class)->except(['show']);

    // Update Password — route tambahan di luar resource
    Route::get('user/{user}/update-password', [UserController::class, 'updatePasswordForm'])
        ->name('user.updatePasswordForm');
    Route::put('user/{user}/update-password', [UserController::class, 'updatePassword'])
        ->name('user.updatePassword');
});

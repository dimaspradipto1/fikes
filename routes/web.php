<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\SambutanDekanController;
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

    Route::resource('user', UserController::class);
    Route::resource('kontak', KontakController::class)->except(['show']);

    Route::resource('sambutan-dekan', SambutanDekanController::class)->except(['show']);

    Route::post('sambutan-dekan/upload-image', [SambutanDekanController::class, 'uploadImage'])
        ->name('sambutan-dekan.uploadImage');


    Route::get('user/{user}/update-password', [UserController::class, 'updatePasswordForm'])
        ->name('user.updatePasswordForm');
    Route::put('user/{user}/update-password', [UserController::class, 'updatePassword'])
        ->name('user.updatePassword');
});

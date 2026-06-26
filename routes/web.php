<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\ProfilPimpinanController;
use App\Http\Controllers\SambutanDekanController;
use App\Http\Controllers\SejarahIbnuSinaController;
use App\Http\Controllers\StrukturController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisiMisiController;
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

    Route::resource('visi-misi', VisiMisiController::class)->except(['show']);

    Route::resource('sejarah-ibnu-sina', SejarahIbnuSinaController::class)->except(['show']);

    Route::post('sejarah-ibnu-sina/upload-image', [SejarahIbnuSinaController::class, 'uploadImage'])
        ->name('sejarah-ibnu-sina.uploadImage');

    Route::resource('struktur', StrukturController::class)->except(['show']);

    Route::resource('profil-pimpinan', ProfilPimpinanController::class)->except(['show']);


    Route::get('user/{user}/update-password', [UserController::class, 'updatePasswordForm'])
        ->name('user.updatePasswordForm');
    Route::put('user/{user}/update-password', [UserController::class, 'updatePassword'])
        ->name('user.updatePassword');
});

<?php

use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});





Route::middleware(['auth'])->group(function () {

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/guru/dashboard', function () {
        return view('guru.dashboard');
    })->name('guru.dashboard');

    Route::get('/operator/dashboard', function () {
        return view('operator.dashboard');
    })->name('operator.dashboard');

    Route::get('/kepala-sekolah/dashboard', function () {
        return view('kepala-sekolah.dashboard');
    })->name('kepala.dashboard');
});



Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    Route::resource('users', UserController::class);
});

Route::get('/admin/users/{user}', [UserController::class, 'show'])
    ->name('admin.users.show');

Route::prefix('admin')->name('admin.')->group(function () {

    // DATA GURU (dari users table)
    Route::get('/guru', [UserController::class, 'guruIndex'])->name('guru.index');
});


Route::prefix('admin')->name('admin.')->group(function () {

    // DATA GURU
    Route::get('/guru', [UserController::class, 'guruIndex'])->name('guru.index');

    // VIEW DETAIL GURU (INI YANG HILANG)
    Route::get('/guru/{user}', [UserController::class, 'guruShow'])->name('guru.show');
});

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/guru', [GuruController::class, 'index'])->name('guru.index');
    Route::get('/guru/{user}', [GuruController::class, 'show'])->name('guru.show');
});


Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/guru', [GuruController::class, 'index'])->name('guru.index');

    Route::get('/guru/{user}', [GuruController::class, 'show'])->name('guru.show');
});

Route::prefix('admin/guru')->name('admin.guru.')->group(function () {
    Route::get('/', [GuruController::class, 'index'])->name('index');
    Route::get('/{guru}', [GuruController::class, 'show'])->name('show');
});


require __DIR__ . '/auth.php';

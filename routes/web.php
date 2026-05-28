<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\MataPelajaranController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\JadwalController;
use App\Http\Controllers\Admin\AbsensiController as AdminAbsensiController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PengaturanController;

use App\Http\Controllers\Guru\DashboardController as GuruDashboardController;
use App\Http\Controllers\Guru\AbsensiController as GuruAbsensiController;
use App\Http\Controllers\Guru\LaporanController;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route(
            Auth::user()->role === 'admin'
                ? 'admin.dashboard'
                : 'guru.dashboard'
        );
    }

    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| PROFILE (FIX ROLE SEPARATION)
|--------------------------------------------------------------------------
*/

/**
 * ❌ HAPUS /profile global yang tanpa role
 * ✔ DIGANTI ROLE BASED
 */

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

Route::middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/guru/profile', [ProfileController::class, 'editGuru'])
        ->name('guru.profile.edit');

    Route::patch('/guru/profile', [ProfileController::class, 'updateGuru'])
        ->name('guru.profile.update');
});

/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('users', UserController::class);
        Route::resource('kelas', KelasController::class);
        Route::resource('mapel', MataPelajaranController::class);
        Route::resource('jadwal', JadwalController::class);

        Route::get('/guru', [GuruController::class, 'index'])->name('guru.index');
        Route::get('/guru/{user}', [GuruController::class, 'show'])->name('guru.show');

        Route::get('/absensi', [AdminAbsensiController::class, 'index'])->name('absensi.index');
        Route::get('/absensi/{absensi}', [AdminAbsensiController::class, 'show'])->name('absensi.show');
        Route::get('/absensi-export', [AdminAbsensiController::class, 'export'])->name('absensi.export');
        Route::delete('/absensi/{absensi}', [AdminAbsensiController::class, 'destroy'])->name('absensi.destroy');

        Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan.index');
        Route::post('/pengaturan', [PengaturanController::class, 'update'])->name('pengaturan.update');
    });

/*
|--------------------------------------------------------------------------
| GURU AREA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:guru'])
    ->prefix('guru')
    ->name('guru.')
    ->group(function () {

        Route::get('/dashboard', [GuruDashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/jadwal', fn() => view('guru.jadwal'))
            ->name('jadwal');

        Route::get('/absensi', [GuruAbsensiController::class, 'index'])
            ->name('absensi');

        Route::post('/absensi/masuk', [GuruAbsensiController::class, 'masuk'])
            ->name('absensi.masuk');

        Route::post('/absensi/pulang', [GuruAbsensiController::class, 'pulang'])
            ->name('absensi.pulang');

        Route::get('/laporan', [LaporanController::class, 'index'])
            ->name('laporan');
    });

require __DIR__ . '/auth.php';

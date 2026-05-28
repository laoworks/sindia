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

use App\Http\Controllers\Operator\DashboardController as OperatorDashboardController;
use App\Http\Controllers\Operator\AbsensiController as OperatorAbsensiController;
use App\Http\Controllers\Operator\AbsensiExportController;
use App\Http\Controllers\Operator\JadwalController as OperatorJadwalController;
use App\Http\Controllers\Operator\GuruController as OperatorGuruController;
use App\Http\Controllers\Operator\KelasController as OperatorKelasController;
use App\Models\Absensi;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\User;

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
                : (
                    Auth::user()->role === 'operator'
                    ? 'operator.dashboard'
                    : 'guru.dashboard'
                )
        );
    }

    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| PROFILE (FIXED ROLE BASED)
|--------------------------------------------------------------------------
*/

// ADMIN PROFILE
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// GURU PROFILE
Route::middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/guru/profile', [ProfileController::class, 'editGuru'])->name('guru.profile.edit');
    Route::patch('/guru/profile', [ProfileController::class, 'updateGuru'])->name('guru.profile.update');
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

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

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

        Route::get('/dashboard', [GuruDashboardController::class, 'index'])->name('dashboard');

        Route::get('/jadwal', fn() => view('guru.jadwal'))->name('jadwal');

        Route::get('/absensi', [GuruAbsensiController::class, 'index'])->name('absensi');
        Route::post('/absensi/masuk', [GuruAbsensiController::class, 'masuk'])->name('absensi.masuk');
        Route::post('/absensi/pulang', [GuruAbsensiController::class, 'pulang'])->name('absensi.pulang');

        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
    });

/*
|--------------------------------------------------------------------------
| OPERATOR AREA (CLEAN & FIXED)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:operator'])
    ->prefix('operator')
    ->name('operator.')
    ->group(function () {

        // DASHBOARD
        Route::get('/dashboard', [OperatorDashboardController::class, 'index'])
            ->name('dashboard');

        // =========================
        // ABSENSI
        // =========================
        Route::get('/absensi', [OperatorAbsensiController::class, 'index'])
            ->name('absensi.index');

        Route::get('/absensi/{absensi}', [OperatorAbsensiController::class, 'show'])
            ->name('absensi.show');

        Route::delete('/absensi/{absensi}', [OperatorAbsensiController::class, 'destroy'])
            ->name('absensi.destroy');

        // EXPORT
        Route::get('/absensi/export/excel', [AbsensiExportController::class, 'excel'])
            ->name('absensi.export.excel');

        Route::get('/absensi/export/pdf', [AbsensiExportController::class, 'pdf'])
            ->name('absensi.export.pdf');

        // =========================
        // JADWAL (FULL CRUD FIXED)
        // =========================
        Route::get('/jadwal', [OperatorJadwalController::class, 'index'])
            ->name('jadwal.index');

        Route::get('/jadwal/create', [OperatorJadwalController::class, 'create'])
            ->name('jadwal.create');

        Route::post('/jadwal', [OperatorJadwalController::class, 'store'])
            ->name('jadwal.store');

        Route::get('/jadwal/{jadwal}/edit', [OperatorJadwalController::class, 'edit'])
            ->name('jadwal.edit');

        Route::put('/jadwal/{jadwal}', [OperatorJadwalController::class, 'update'])
            ->name('jadwal.update');

        Route::delete('/jadwal/{jadwal}', [OperatorJadwalController::class, 'destroy'])
            ->name('jadwal.destroy');
    });


Route::middleware(['auth', 'role:operator'])
    ->prefix('operator')
    ->name('operator.')
    ->group(function () {

        Route::get('/guru', [OperatorGuruController::class, 'index'])
            ->name('guru.index');

        Route::get('/guru/create', [OperatorGuruController::class, 'create'])
            ->name('guru.create');

        Route::post('/guru', [OperatorGuruController::class, 'store'])
            ->name('guru.store');

        Route::get('/guru/{id}/edit', [OperatorGuruController::class, 'edit'])
            ->name('guru.edit');

        Route::put('/guru/{id}', [OperatorGuruController::class, 'update'])
            ->name('guru.update');

        Route::delete('/guru/{id}', [OperatorGuruController::class, 'destroy'])
            ->name('guru.destroy');
    });


Route::middleware(['auth', 'role:operator'])
    ->prefix('operator')
    ->name('operator.')
    ->group(function () {

        Route::resource('kelas', OperatorKelasController::class);
    });




Route::middleware(['auth', 'role:operator'])
    ->prefix('operator')
    ->name('operator.')
    ->group(function () {

        Route::get('/mapel', [\App\Http\Controllers\Operator\MapelController::class, 'index'])
            ->name('mapel.index');

        Route::get('/mapel/create', [\App\Http\Controllers\Operator\MapelController::class, 'create'])
            ->name('mapel.create');

        Route::post('/mapel', [\App\Http\Controllers\Operator\MapelController::class, 'store'])
            ->name('mapel.store');

        Route::get('/mapel/{mapel}/edit', [\App\Http\Controllers\Operator\MapelController::class, 'edit'])
            ->name('mapel.edit');

        Route::put('/mapel/{mapel}', [\App\Http\Controllers\Operator\MapelController::class, 'update'])
            ->name('mapel.update');

        Route::delete('/mapel/{mapel}', [\App\Http\Controllers\Operator\MapelController::class, 'destroy'])
            ->name('mapel.destroy');
    });



Route::middleware(['auth', 'role:operator'])
    ->prefix('operator')
    ->name('operator.')
    ->group(function () {

        Route::get('/profile', [\App\Http\Controllers\Operator\ProfileController::class, 'edit'])
            ->name('profile.edit');

        Route::put('/profile', [\App\Http\Controllers\Operator\ProfileController::class, 'update'])
            ->name('profile.update');
    });





require __DIR__ . '/auth.php';

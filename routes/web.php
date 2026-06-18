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
use App\Http\Controllers\Operator\MapelController as OperatorMapelController;
use App\Http\Controllers\Operator\ProfileController as OperatorProfileController;
use App\Http\Controllers\KepalaSekolah\AbsensiController as KepalaAbsensiController;
use App\Http\Controllers\KepalaSekolah\DashboardController as KepalaDashboardController;
use App\Models\Absensi;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\User;

$dashboardRouteByRole = [
    'admin' => 'admin.dashboard',
    'guru' => 'guru.dashboard',
    'operator' => 'operator.dashboard',
    'kepala_sekolah' => 'kepala.dashboard',
];

$redirectToDashboard = function () use ($dashboardRouteByRole) {
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $routeName = $dashboardRouteByRole[Auth::user()->role] ?? 'login';

    return redirect()->route($routeName);
};

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/', function () use ($redirectToDashboard) {
    if (Auth::check()) {
        return $redirectToDashboard();
    }

    return view('welcome');
})->name('home');

Route::get('/dashboard', $redirectToDashboard)
    ->middleware('auth')
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| PROFILE - GLOBAL ACCESS FOR ALL AUTHENTICATED USERS
|--------------------------------------------------------------------------
*/

// PROFILE untuk semua user yang sudah login (tanpa batasan role)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// GURU PROFILE (opsional, jika ada tampilan berbeda untuk guru)
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
| KEPALA SEKOLAH AREA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:kepala_sekolah'])
    ->prefix('kepala')
    ->name('kepala.')
    ->group(function () {
        Route::get('/dashboard', [KepalaDashboardController::class, 'index'])->name('dashboard');
        Route::get('/absensi', [KepalaAbsensiController::class, 'index'])->name('absensi.index');
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
        Route::get('/dashboard', [OperatorDashboardController::class, 'index'])->name('dashboard');

        Route::get('/absensi', [OperatorAbsensiController::class, 'index'])->name('absensi.index');
        Route::get('/absensi/{absensi}', [OperatorAbsensiController::class, 'show'])->name('absensi.show');
        Route::delete('/absensi/{absensi}', [OperatorAbsensiController::class, 'destroy'])->name('absensi.destroy');
        Route::get('/absensi/export/excel', [AbsensiExportController::class, 'excel'])->name('absensi.export.excel');
        Route::get('/absensi/export/pdf', [AbsensiExportController::class, 'pdf'])->name('absensi.export.pdf');

        Route::get('/jadwal', [OperatorJadwalController::class, 'index'])->name('jadwal.index');
        Route::get('/jadwal/create', [OperatorJadwalController::class, 'create'])->name('jadwal.create');
        Route::post('/jadwal', [OperatorJadwalController::class, 'store'])->name('jadwal.store');
        Route::get('/jadwal/{jadwal}/edit', [OperatorJadwalController::class, 'edit'])->name('jadwal.edit');
        Route::put('/jadwal/{jadwal}', [OperatorJadwalController::class, 'update'])->name('jadwal.update');
        Route::delete('/jadwal/{jadwal}', [OperatorJadwalController::class, 'destroy'])->name('jadwal.destroy');

        Route::get('/guru', [OperatorGuruController::class, 'index'])->name('guru.index');
        Route::get('/guru/create', [OperatorGuruController::class, 'create'])->name('guru.create');
        Route::post('/guru', [OperatorGuruController::class, 'store'])->name('guru.store');
        Route::get('/guru/{id}/edit', [OperatorGuruController::class, 'edit'])->name('guru.edit');
        Route::put('/guru/{id}', [OperatorGuruController::class, 'update'])->name('guru.update');
        Route::delete('/guru/{id}', [OperatorGuruController::class, 'destroy'])->name('guru.destroy');

        Route::resource('kelas', OperatorKelasController::class)->except(['show']);

        Route::get('/mapel', [OperatorMapelController::class, 'index'])->name('mapel.index');
        Route::get('/mapel/create', [OperatorMapelController::class, 'create'])->name('mapel.create');
        Route::post('/mapel', [OperatorMapelController::class, 'store'])->name('mapel.store');
        Route::get('/mapel/{mapel}/edit', [OperatorMapelController::class, 'edit'])->name('mapel.edit');
        Route::put('/mapel/{mapel}', [OperatorMapelController::class, 'update'])->name('mapel.update');
        Route::delete('/mapel/{mapel}', [OperatorMapelController::class, 'destroy'])->name('mapel.destroy');

        Route::get('/profile', [OperatorProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [OperatorProfileController::class, 'update'])->name('profile.update');
    });



Route::get('/cek-waktu', function () {
    return [
        'server_time' => date('Y-m-d H:i:s'),
        'php_timezone' => date_default_timezone_get(),
        'carbon_now' => Carbon\Carbon::now()->toDateTimeString(),
        'carbon_wita' => Carbon\Carbon::now('Asia/Makassar')->toDateTimeString(),
        'config_timezone' => config('app.timezone'),
        'windows_time' => exec('echo %time%'),
    ];
});

require __DIR__ . '/auth.php';

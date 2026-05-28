<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Jadwal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AbsensiController extends Controller
{
    public function index()
    {
        $today = Carbon::now('Asia/Makassar')->toDateString();

        $absensi = Absensi::where('user_id', Auth::id())
            ->whereDate('tanggal', $today)
            ->first();

        return view('guru.absensi', compact('absensi'));
    }

    /*
    |--------------------------------------------------------------------------
    | ABSEN MASUK
    |--------------------------------------------------------------------------
    */

    public function masuk(Request $request)
    {
        $userId = Auth::id();

        // =========================
        // WAKTU SEKARANG
        // =========================
        $now = Carbon::now('Asia/Makassar');

        // =========================
        // ABSENSI HARI INI
        // =========================
        $absensi = Absensi::firstOrCreate([
            'user_id' => $userId,
            'tanggal' => $now->toDateString(),
        ]);

        // =========================
        // CEK SUDAH ABSEN
        // =========================
        if ($absensi->waktu_masuk) {
            return back()->with('error', 'Anda sudah melakukan absen masuk');
        }

        // =========================
        // HARI INDONESIA
        // =========================
        $hariIndonesia = [
            'Monday'    => 'Senin',
            'Tuesday'   => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday'  => 'Kamis',
            'Friday'    => 'Jumat',
            'Saturday'  => 'Sabtu',
            'Sunday'    => 'Minggu',
        ];

        $hariIni = $hariIndonesia[$now->format('l')];

        // =========================
        // AMBIL JADWAL HARI INI
        // =========================
        $jadwal = Jadwal::where('guru_id', $userId)
            ->where('hari', $hariIni)
            ->orderBy('jam_mulai', 'asc')
            ->first();

        // =========================
        // CEK JADWAL
        // =========================
        if (!$jadwal) {
            return back()->with('error', 'Tidak ada jadwal mengajar hari ini');
        }

        // =========================
        // JAM MASUK JADWAL
        // =========================
        $jamMasuk = Carbon::parse(
            $now->toDateString() . ' ' . $jadwal->jam_mulai,
            'Asia/Makassar'
        );

        // =========================
        // TOLERANSI TERLAMBAT
        // =========================
        $batasTerlambat = $jamMasuk->copy()->addMinutes(10);

        // =========================
        // STATUS ABSEN
        // =========================
        $status = $now->greaterThan($batasTerlambat)
            ? 'terlambat'
            : 'tepat_waktu';

        // =========================
        // DEBUG LOG
        // =========================
        Log::info([
            'guru_id'          => $userId,
            'now'              => $now->format('Y-m-d H:i:s'),
            'hari'             => $hariIni,
            'jam_jadwal'       => $jamMasuk->format('Y-m-d H:i:s'),
            'batas_terlambat'  => $batasTerlambat->format('Y-m-d H:i:s'),
            'status'           => $status,
        ]);

        // =========================
        // FOTO
        // =========================
        $fotoPath = null;

        if ($request->foto) {

            $image = str_replace('data:image/png;base64,', '', $request->foto);
            $image = str_replace(' ', '+', $image);

            $filename = 'absensi/masuk_' . time() . '.png';

            Storage::disk('public')->put(
                $filename,
                base64_decode($image)
            );

            $fotoPath = $filename;
        }

        // =========================
        // SIMPAN ABSENSI
        // =========================
        $absensi->update([
            'waktu_masuk'  => $now->format('H:i:s'),
            'status_masuk' => $status,
            'foto_masuk'   => $fotoPath,
            'ip_address'   => $request->ip(),
            'user_agent'   => $request->userAgent(),
        ]);

        return back()->with('success', 'Absen masuk berhasil');
    }

    /*
    |--------------------------------------------------------------------------
    | ABSEN PULANG
    |--------------------------------------------------------------------------
    */

    public function pulang(Request $request)
    {
        $userId = Auth::id();

        $now = Carbon::now('Asia/Makassar');

        // =========================
        // ABSENSI HARI INI
        // =========================
        $absensi = Absensi::where('user_id', $userId)
            ->whereDate('tanggal', $now->toDateString())
            ->first();

        // =========================
        // BELUM ABSEN MASUK
        // =========================
        if (!$absensi) {
            return back()->with('error', 'Silakan absen masuk terlebih dahulu');
        }

        // =========================
        // SUDAH ABSEN PULANG
        // =========================
        if ($absensi->waktu_pulang) {
            return back()->with('error', 'Anda sudah melakukan absen pulang');
        }

        // =========================
        // HARI INDONESIA
        // =========================
        $hariIndonesia = [
            'Monday'    => 'Senin',
            'Tuesday'   => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday'  => 'Kamis',
            'Friday'    => 'Jumat',
            'Saturday'  => 'Sabtu',
            'Sunday'    => 'Minggu',
        ];

        $hariIni = $hariIndonesia[$now->format('l')];

        // =========================
        // JADWAL TERAKHIR HARI INI
        // =========================
        $jadwal = Jadwal::where('guru_id', $userId)
            ->where('hari', $hariIni)
            ->orderBy('jam_selesai', 'desc')
            ->first();

        if (!$jadwal) {
            return back()->with('error', 'Jadwal tidak ditemukan');
        }

        // =========================
        // BATAS PULANG
        // =========================
        $jamPulang = Carbon::parse(
            $now->toDateString() . ' ' . $jadwal->jam_selesai,
            'Asia/Makassar'
        );

        // toleransi pulang lebih awal 10 menit
        $batasPulang = $jamPulang->copy()->subMinutes(10);

        // =========================
        // STATUS PULANG
        // =========================
        $status = $now->lessThan($batasPulang)
            ? 'lebih_awal'
            : 'tepat_waktu';

        // =========================
        // FOTO
        // =========================
        $fotoPath = null;

        if ($request->foto) {

            $image = str_replace('data:image/png;base64,', '', $request->foto);
            $image = str_replace(' ', '+', $image);

            $filename = 'absensi/pulang_' . time() . '.png';

            Storage::disk('public')->put(
                $filename,
                base64_decode($image)
            );

            $fotoPath = $filename;
        }

        // =========================
        // UPDATE ABSENSI
        // =========================
        $absensi->update([
            'waktu_pulang'  => $now->format('H:i:s'),
            'status_pulang' => $status,
            'foto_pulang'   => $fotoPath,
        ]);

        return back()->with('success', 'Absen pulang berhasil');
    }
}

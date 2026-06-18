<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Jadwal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class AbsensiController extends Controller
{
    // ============================================
    // PAKSA ZONA WAKTU KE WIT (UTC+9)
    // ============================================
    public function __construct()
    {
        // PAKSA WIT DI KONSTRUKTOR
        date_default_timezone_set('Asia/Jayapura');
    }

    private function now()
    {
        return Carbon::now('Asia/Jayapura'); // WIT (UTC+9)
    }

    public function index()
    {
        $now = $this->now();
        $today = $now->toDateString();
        $userId = Auth::id();

        Log::info('INDEX ABSENSI (WIT):', [
            'waktu' => $now->toDateTimeString(),
            'timezone' => $now->timezoneName,
            'php_timezone' => date_default_timezone_get(),
        ]);

        $absensi = Absensi::with(['jadwal.mapel', 'jadwal.kelas'])
            ->where('user_id', $userId)
            ->whereDate('tanggal', $today)
            ->first();

        $hariMap = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
        ];

        $hariIni = $hariMap[$now->format('l')];

        $jadwals = Jadwal::with(['mapel', 'kelas'])
            ->where('guru_id', $userId)
            ->where('hari', $hariIni)
            ->orderBy('jam_mulai')
            ->get();

        return view('guru.absensi', compact('absensi', 'jadwals'));
    }

    public function masuk(Request $request)
    {
        // PAKSA WIT (UTC+9)
        $now = Carbon::now('Asia/Jayapura');

        Log::info('🚀 ABSEN MASUK (WIT):', [
            'waktu_sekarang' => $now->toDateTimeString(),
            'timezone' => $now->timezoneName,
            'format_H_i_s' => $now->format('H:i:s'),
        ]);

        try {
            $userId = Auth::id();

            $request->validate([
                'foto' => 'required|string',
            ]);

            // ============================================
            // CARI JADWAL AKTIF - PAKAI WIT
            // ============================================
            $hariMap = [
                0 => 'Minggu',
                1 => 'Senin',
                2 => 'Selasa',
                3 => 'Rabu',
                4 => 'Kamis',
                5 => 'Jumat',
                6 => 'Sabtu',
            ];
            $hariIni = $hariMap[$now->dayOfWeek];

            $jadwals = Jadwal::where('guru_id', $userId)
                ->where('hari', $hariIni)
                ->get();

            if ($jadwals->isEmpty()) {
                return back()->with('error', 'Tidak ada jadwal hari ini.');
            }

            // Cari jadwal aktif (60 menit sebelum sampai selesai)
            $toleransiAwal = 60;
            $jadwalAktif = null;

            foreach ($jadwals as $j) {
                $mulai = Carbon::createFromFormat(
                    'Y-m-d H:i:s',
                    $now->format('Y-m-d') . ' ' . $j->jam_mulai,
                    'Asia/Jayapura'
                );

                $selesai = Carbon::createFromFormat(
                    'Y-m-d H:i:s',
                    $now->format('Y-m-d') . ' ' . $j->jam_selesai,
                    'Asia/Jayapura'
                );

                $batasAwal = $mulai->copy()->subMinutes($toleransiAwal);

                Log::info('CEK JADWAL (WIT):', [
                    'id' => $j->id,
                    'jam_mulai' => $j->jam_mulai,
                    'batas_awal' => $batasAwal->format('H:i:s'),
                    'now' => $now->format('H:i:s'),
                    'bisa' => $now->between($batasAwal, $selesai) ? 'YES' : 'NO'
                ]);

                if ($now->between($batasAwal, $selesai)) {
                    $jadwalAktif = $j;
                    break;
                }
            }

            if (!$jadwalAktif) {
                return back()->with('error', 'Tidak ada jadwal yang sedang berlangsung.');
            }

            // ============================================
            // CEK ABSENSI SEBELUMNYA
            // ============================================
            $absensi = Absensi::where('user_id', $userId)
                ->where('jadwal_id', $jadwalAktif->id)
                ->whereDate('tanggal', $now->toDateString())
                ->first();

            if ($absensi && $absensi->waktu_masuk) {
                return back()->with('error', 'Anda sudah absen masuk.');
            }

            // ============================================
            // HITUNG STATUS - PAKAI WIT
            // ============================================
            $jamMulai = Carbon::createFromFormat(
                'Y-m-d H:i:s',
                $now->format('Y-m-d') . ' ' . $jadwalAktif->jam_mulai,
                'Asia/Jayapura'
            );

            $batasTelat = $jamMulai->copy()->addMinutes(10);
            $status = $now->gt($batasTelat) ? 'terlambat' : 'tepat_waktu';

            // ============================================
            // PROSES FOTO
            // ============================================
            $fotoPath = null;
            if ($request->foto) {
                $image = preg_replace('/^data:image\/\w+;base64,/', '', $request->foto);
                $image = str_replace(' ', '+', $image);

                $filename = 'absensi/masuk_' . $userId . '_' . time() . '.png';
                Storage::disk('public')->put($filename, base64_decode($image));
                $fotoPath = $filename;
            }

            // ============================================
            // SIMPAN - PAKAI WAKTU WIT
            // ============================================
            $waktuMasuk = $now->format('H:i:s');

            if (!$absensi) {
                $absensi = Absensi::create([
                    'user_id' => $userId,
                    'jadwal_id' => $jadwalAktif->id,
                    'tanggal' => $now->toDateString(),
                    'waktu_masuk' => $waktuMasuk,
                    'status_masuk' => $status,
                    'foto_masuk' => $fotoPath,
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                ]);
            } else {
                $absensi->update([
                    'waktu_masuk' => $waktuMasuk,
                    'status_masuk' => $status,
                    'foto_masuk' => $fotoPath,
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                ]);
            }

            Log::info('✅ ABSEN MASUK BERHASIL (WIT):', [
                'absensi_id' => $absensi->id,
                'waktu_masuk' => $waktuMasuk,
                'waktu_asli' => $now->toDateTimeString(),
            ]);

            return back()->with('success', '✅ Absen masuk berhasil! (Jam: ' . $waktuMasuk . ' WIT)');
        } catch (\Exception $e) {
            Log::error('❌ ERROR:', ['message' => $e->getMessage()]);
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function pulang(Request $request)
    {
        // PAKSA WIT (UTC+9)
        $now = Carbon::now('Asia/Jayapura');

        Log::info('🚀 ABSEN PULANG (WIT):', [
            'waktu_sekarang' => $now->toDateTimeString(),
            'timezone' => $now->timezoneName,
        ]);

        try {
            $userId = Auth::id();

            $request->validate([
                'foto' => 'required|string',
            ]);

            $absensi = Absensi::where('user_id', $userId)
                ->whereDate('tanggal', $now->toDateString())
                ->first();

            if (!$absensi) {
                return back()->with('error', 'Silakan absen masuk terlebih dahulu.');
            }

            if ($absensi->waktu_pulang) {
                return back()->with('error', 'Anda sudah absen pulang.');
            }

            $jadwal = Jadwal::find($absensi->jadwal_id);
            if (!$jadwal) {
                return back()->with('error', 'Jadwal tidak ditemukan.');
            }

            // Validasi waktu pulang - PAKAI WIT
            $jamSelesai = Carbon::createFromFormat(
                'Y-m-d H:i:s',
                $now->format('Y-m-d') . ' ' . $jadwal->jam_selesai,
                'Asia/Jayapura'
            );

            $batasAwal = $jamSelesai->copy()->subMinutes(30);
            $batasAkhir = $jamSelesai->copy()->addMinutes(60);

            Log::info('VALIDASI PULANG (WIT):', [
                'jam_selesai' => $jamSelesai->format('H:i:s'),
                'batas_awal' => $batasAwal->format('H:i:s'),
                'batas_akhir' => $batasAkhir->format('H:i:s'),
                'waktu_sekarang' => $now->format('H:i:s'),
            ]);

            if ($now->lt($batasAwal)) {
                $menit = $batasAwal->diffInMinutes($now);
                return back()->with('error', "Maaf, Anda belum bisa absen pulang. Tunggu {$menit} menit lagi.");
            }

            if ($now->gt($batasAkhir)) {
                return back()->with('error', 'Maaf, batas waktu absen pulang sudah lewat.');
            }

            $batasTepatWaktu = $jamSelesai->copy()->subMinutes(10);
            $status = $now->lt($batasTepatWaktu) ? 'lebih_awal' : 'tepat_waktu';

            // Proses foto
            $fotoPath = null;
            if ($request->foto) {
                $image = preg_replace('/^data:image\/\w+;base64,/', '', $request->foto);
                $image = str_replace(' ', '+', $image);

                $filename = 'absensi/pulang_' . $userId . '_' . time() . '.png';
                Storage::disk('public')->put($filename, base64_decode($image));
                $fotoPath = $filename;
            }

            $waktuPulang = $now->format('H:i:s');

            $absensi->update([
                'waktu_pulang' => $waktuPulang,
                'status_pulang' => $status,
                'foto_pulang' => $fotoPath,
            ]);

            Log::info('✅ ABSEN PULANG BERHASIL (WIT):', [
                'absensi_id' => $absensi->id,
                'waktu_pulang' => $waktuPulang,
            ]);

            return back()->with('success', '✅ Absen pulang berhasil! (Jam: ' . $waktuPulang . ' WIT)');
        } catch (\Exception $e) {
            Log::error('❌ ERROR:', ['message' => $e->getMessage()]);
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}

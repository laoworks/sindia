@extends('layouts.admin')

@section('content')
    @php
        $user = auth()->user();
    @endphp

    <div class="space-y-8">

        <!-- HEADER -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-semibold text-gray-800">Dashboard</h1>
                <p class="mt-1 text-base text-gray-400">Selamat datang, {{ $user->name }}</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.users.create') }}"
                   class="px-5 py-2.5 text-sm font-medium text-gray-600 transition border border-gray-200 rounded-lg hover:bg-gray-50">
                    + User
                </a>
                <a href="{{ route('admin.jadwal.create') }}"
                   class="px-5 py-2.5 text-sm font-medium text-gray-600 transition border border-gray-200 rounded-lg hover:bg-gray-50">
                    + Jadwal
                </a>
            </div>
        </div>

        <!-- STATISTIK UTAMA (Card View) -->
        <div class="grid grid-cols-2 gap-5 lg:grid-cols-4">
            <div class="p-6 bg-white border border-gray-200 rounded-lg">
                <div class="text-base text-gray-500">Total Guru</div>
                <div class="flex items-end justify-between mt-2">
                    <span class="text-3xl font-semibold text-gray-800">{{ $totalGuru }}</span>
                    <span class="px-3 py-1 text-sm rounded text-emerald-600 bg-emerald-50">{{ $totalGuruAktif }} aktif</span>
                </div>
            </div>

            <div class="p-6 bg-white border border-gray-200 rounded-lg">
                <div class="text-base text-gray-500">Mata Pelajaran</div>
                <div class="flex items-end justify-between mt-2">
                    <span class="text-3xl font-semibold text-gray-800">{{ $totalMapel }}</span>
                    <span class="text-sm text-gray-400">{{ $totalKelas }} kelas</span>
                </div>
            </div>

            <div class="p-6 bg-white border border-gray-200 rounded-lg">
                <div class="text-base text-gray-500">Total Jadwal</div>
                <div class="flex items-end justify-between mt-2">
                    <span class="text-3xl font-semibold text-gray-800">{{ $totalJadwal }}</span>
                    <span class="text-sm text-gray-400">{{ $totalOperator }} operator</span>
                </div>
            </div>

            <div class="p-6 bg-white border border-gray-200 rounded-lg">
                <div class="text-base text-gray-500">Absensi Hari Ini</div>
                <div class="flex items-end justify-between mt-2">
                    <span class="text-3xl font-semibold text-gray-800">{{ $absensiHariIni }}</span>
                    <span class="text-sm text-blue-500">{{ $persentaseKehadiran }}% hadir</span>
                </div>
            </div>
        </div>

        <!-- GRAFIK TREN -->
        <div class="p-6 bg-white border border-gray-200 rounded-lg">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <span class="text-lg font-medium text-gray-700">Tren Kehadiran</span>
                    <span class="ml-2 text-sm text-gray-400">7 hari terakhir</span>
                </div>
                <a href="{{ route('admin.absensi.index') }}" class="text-sm text-gray-400 transition hover:text-gray-600">
                    Lihat semua →
                </a>
            </div>

            <div class="space-y-4">
                @forelse($ringkasanAbsensi as $item)
                    @php
                        $persen = $totalGuruAktif > 0 ? min(100, round(($item['total'] / $totalGuruAktif) * 100)) : 0;
                    @endphp
                    <div>
                        <div class="flex justify-between text-base">
                            <span class="text-gray-700">{{ $item['tanggal']->translatedFormat('D, d M') }}</span>
                            <span class="text-sm text-gray-400">{{ $item['total'] }} hadir · {{ $item['terlambat'] }} terlambat</span>
                        </div>
                        <div class="w-full h-3 mt-1.5 overflow-hidden bg-gray-100 rounded-full">
                            <div class="h-full rounded-full" style="width: {{ $persen }}%; background: oklch(45.7% 0.24 277.023);"></div>
                        </div>
                    </div>
                @empty
                    <div class="py-8 text-base text-center text-gray-300 border border-gray-200 border-dashed rounded">
                        Belum ada data absensi 7 hari terakhir
                    </div>
                @endforelse
            </div>
        </div>

        <!-- TABEL DATA (Analitik) -->
        <div class="overflow-hidden bg-white border border-gray-200 rounded-lg">
            <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100">
                <div>
                    <span class="text-lg font-medium text-gray-700">Data Ringkasan</span>
                    <span class="ml-2 text-sm text-gray-400">Statistik hari ini</span>
                </div>
                <span class="text-sm text-gray-400">{{ now()->translatedFormat('d M Y, H:i') }}</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-100 bg-gray-50">
                            <th class="px-6 py-4 text-sm font-medium tracking-wider text-left text-gray-500 uppercase">Kategori</th>
                            <th class="px-6 py-4 text-sm font-medium tracking-wider text-right text-gray-500 uppercase">Nilai</th>
                            <th class="px-6 py-4 text-sm font-medium tracking-wider text-right text-gray-500 uppercase">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        <tr>
                            <td class="px-6 py-4 text-base text-gray-700">Total Guru</td>
                            <td class="px-6 py-4 text-base font-medium text-right text-gray-800">{{ $totalGuru }}</td>
                            <td class="px-6 py-4 text-right">
                                <span class="px-3 py-1 text-sm rounded text-emerald-600 bg-emerald-50">{{ $totalGuruAktif }} aktif</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 text-base text-gray-700">Absensi Hari Ini</td>
                            <td class="px-6 py-4 text-base font-medium text-right text-gray-800">{{ $absensiHariIni }}</td>
                            <td class="px-6 py-4 text-right">
                                <span class="text-sm {{ $persentaseKehadiran >= 80 ? 'text-emerald-600 bg-emerald-50' : 'text-amber-600 bg-amber-50' }} px-3 py-1 rounded">
                                    {{ $persentaseKehadiran }}% hadir
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 text-base text-gray-700">Terlambat</td>
                            <td class="px-6 py-4 text-base font-medium text-right text-gray-800">{{ $terlambatHariIni }}</td>
                            <td class="px-6 py-4 text-right">
                                <span class="px-3 py-1 text-sm text-red-500 rounded bg-red-50">
                                    {{ $terlambatHariIni > 0 ? 'Perlu perhatian' : 'Baik' }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 text-base text-gray-700">Belum Absen</td>
                            <td class="px-6 py-4 text-base font-medium text-right text-gray-800">{{ $belumAbsenHariIni }}</td>
                            <td class="px-6 py-4 text-right">
                                <span class="px-3 py-1 text-sm rounded text-amber-500 bg-amber-50">
                                    {{ $belumAbsenHariIni > 0 ? 'Belum semua' : 'Lengkap' }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 text-base text-gray-700">Total Jadwal</td>
                            <td class="px-6 py-4 text-base font-medium text-right text-gray-800">{{ $totalJadwal }}</td>
                            <td class="px-6 py-4 text-right">
                                <span class="px-3 py-1 text-sm text-gray-500 bg-gray-100 rounded">{{ $jadwalHariIni->count() }} hari ini</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 text-base text-gray-700">Mata Pelajaran</td>
                            <td class="px-6 py-4 text-base font-medium text-right text-gray-800">{{ $totalMapel }}</td>
                            <td class="px-6 py-4 text-right">
                                <span class="px-3 py-1 text-sm text-gray-500 bg-gray-100 rounded">{{ $totalKelas }} kelas</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- JADWAL & ABSENSI -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">

            <div class="p-6 bg-white border border-gray-200 rounded-lg">
                <div class="flex items-center justify-between mb-5">
                    <span class="text-lg font-medium text-gray-700">Jadwal Hari Ini</span>
                    <a href="{{ route('admin.jadwal.index') }}" class="text-sm text-gray-400 transition hover:text-gray-600">Kelola →</a>
                </div>
                @forelse($jadwalHariIni as $jadwal)
                    <div class="py-4 border-b border-gray-50 last:border-0">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-base text-gray-800">{{ $jadwal->mapel->nama_mapel ?? '-' }}</div>
                                <div class="text-sm text-gray-400 mt-0.5">{{ $jadwal->guru->name ?? '-' }} · {{ $jadwal->kelas->nama_kelas ?? '-' }}</div>
                            </div>
                            <div class="px-4 py-1.5 text-sm text-gray-500 rounded-lg bg-gray-50">
                                {{ $jadwal->jam_mulai }}–{{ $jadwal->jam_selesai }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="py-8 text-base text-center text-gray-300 border border-gray-200 border-dashed rounded">
                        Tidak ada jadwal
                    </div>
                @endforelse
            </div>

            <div class="p-6 bg-white border border-gray-200 rounded-lg">
                <div class="flex items-center justify-between mb-5">
                    <span class="text-lg font-medium text-gray-700">Absensi Terbaru</span>
                    <a href="{{ route('admin.absensi.index') }}" class="text-sm text-gray-400 transition hover:text-gray-600">Lihat semua →</a>
                </div>
                @forelse($absensiTerbaru as $item)
                    <div class="py-4 border-b border-gray-50 last:border-0">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-base text-gray-800">{{ $item->user->name ?? '-' }}</div>
                                <div class="text-sm text-gray-400 mt-0.5">
                                    {{ optional($item->tanggal)->translatedFormat('d M Y') }} · {{ optional($item->waktu_masuk)->format('H:i') ?? '-' }}
                                </div>
                            </div>
                            <div class="text-sm px-4 py-1.5 rounded-lg {{ $item->status_masuk === 'terlambat' ? 'text-red-500 bg-red-50' : 'text-emerald-600 bg-emerald-50' }}">
                                {{ $item->status_masuk === 'terlambat' ? 'Terlambat' : 'Tepat' }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="py-8 text-base text-center text-gray-300 border border-gray-200 border-dashed rounded">
                        Belum ada aktivitas
                    </div>
                @endforelse
            </div>

        </div>

    </div>
@endsection

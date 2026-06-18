@extends('layouts.admin')

@section('content')
    @php
        $user = auth()->user();
    @endphp

    <div class="space-y-6">
        <div class="flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Dashboard Admin</h1>
                <p class="mt-2 text-gray-500">
                    Selamat datang, {{ $user->name }}. Pantau operasional sekolah dari satu halaman.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-3 sm:grid-cols-3">
                <a href="{{ route('admin.users.create') }}"
                    class="px-4 py-3 text-sm font-semibold text-gray-700 transition border border-gray-200 hover:bg-gray-50">
                    Tambah User
                </a>
                <a href="{{ route('admin.jadwal.create') }}"
                    class="px-4 py-3 text-sm font-semibold text-gray-700 transition border border-gray-200 hover:bg-gray-50">
                    Buat Jadwal
                </a>
                <a href="{{ route('admin.pengaturan.index') }}"
                    class="px-4 py-3 text-sm font-semibold text-purple-700 transition border border-purple-200 bg-purple-50 hover:bg-purple-100">
                    Atur Sistem
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <div class="p-6 bg-white border border-gray-100 shadow-sm">
                <p class="text-sm text-gray-500">Total Guru</p>
                <h2 class="mt-2 text-3xl font-bold text-gray-900">{{ $totalGuru }}</h2>
                <p class="mt-2 text-sm text-green-600">{{ $totalGuruAktif }} guru aktif</p>
            </div>

            <div class="p-6 bg-white border border-gray-100 shadow-sm">
                <p class="text-sm text-gray-500">Mata Pelajaran</p>
                <h2 class="mt-2 text-3xl font-bold text-gray-900">{{ $totalMapel }}</h2>
                <p class="mt-2 text-sm text-gray-500">{{ $totalKelas }} kelas terdaftar</p>
            </div>

            <div class="p-6 bg-white border border-gray-100 shadow-sm">
                <p class="text-sm text-gray-500">Jadwal Mengajar</p>
                <h2 class="mt-2 text-3xl font-bold text-gray-900">{{ $totalJadwal }}</h2>
                <p class="mt-2 text-sm text-gray-500">{{ $totalOperator }} operator mengelola data</p>
            </div>

            <div class="p-6 bg-white border border-gray-100 shadow-sm">
                <p class="text-sm text-gray-500">Absensi Hari Ini</p>
                <h2 class="mt-2 text-3xl font-bold text-gray-900">{{ $absensiHariIni }}</h2>
                <p class="mt-2 text-sm text-blue-600">{{ $persentaseKehadiran }}% dari guru aktif</p>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">
            <div class="p-6 bg-white border border-gray-100 shadow-sm xl:col-span-2">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-bold text-gray-900">Tren Absensi 7 Hari</h2>
                        <p class="text-sm text-gray-500">Perbandingan kehadiran dan keterlambatan guru.</p>
                    </div>
                    <a href="{{ route('admin.absensi.index') }}" class="text-sm font-semibold text-purple-700">
                        Lihat Semua
                    </a>
                </div>

                <div class="mt-5 space-y-4">
                    @forelse($ringkasanAbsensi as $item)
                        @php
                            $percentage =
                                $totalGuruAktif > 0 ? min(100, round(($item['total'] / $totalGuruAktif) * 100)) : 0;
                        @endphp
                        <div>
                            <div class="flex items-center justify-between mb-2 text-sm">
                                <span
                                    class="font-medium text-gray-700">{{ $item['tanggal']->translatedFormat('l, d M') }}</span>
                                <span class="text-gray-500">
                                    {{ $item['total'] }} hadir, {{ $item['terlambat'] }} terlambat
                                </span>
                            </div>
                            <div class="h-3 overflow-hidden bg-gray-100">
                                <div class="h-full bg-purple-600" style="width: {{ $percentage }}%;"></div>
                            </div>
                            <div class="flex gap-2 mt-2 text-xs">
                                <span class="px-3 py-1 font-medium text-green-700 bg-green-100">
                                    Tepat waktu: {{ $item['tepat_waktu'] }}
                                </span>
                                <span class="px-3 py-1 font-medium text-red-700 bg-red-100">
                                    Terlambat: {{ $item['terlambat'] }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="p-8 text-sm text-center text-gray-500 border border-gray-200 border-dashed">
                            Belum ada data absensi dalam 7 hari terakhir.
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="p-6 bg-white border border-gray-100 shadow-sm">
                <h2 class="text-lg font-bold text-gray-900">Status Hari Ini</h2>
                <div class="mt-5 space-y-4">
                    <div class="p-4 bg-red-50">
                        <p class="text-sm text-red-600">Guru Terlambat</p>
                        <p class="mt-2 text-3xl font-bold text-red-700">{{ $terlambatHariIni }}</p>
                    </div>

                    <div class="p-4 bg-amber-50">
                        <p class="text-sm text-amber-600">Belum Absen</p>
                        <p class="mt-2 text-3xl font-bold text-amber-700">{{ $belumAbsenHariIni }}</p>
                    </div>

                    <div class="{{ $statusPengaturan ? 'bg-green-50' : 'bg-yellow-50' }} p-4">
                        <p class="text-sm {{ $statusPengaturan ? 'text-green-600' : 'text-yellow-700' }}">Kesiapan
                            Pengaturan</p>
                        <p class="mt-2 text-xl font-bold {{ $statusPengaturan ? 'text-green-700' : 'text-yellow-800' }}">
                            {{ $pengaturanTerisi }}/4 pengaturan utama terisi
                        </p>
                        <p class="mt-2 text-sm text-gray-500">
                            Jam masuk dan pulang digunakan untuk validasi absensi guru.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">
            <div class="p-6 bg-white border border-gray-100 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-bold text-gray-900">Jadwal Hari Ini</h2>
                        <p class="text-sm text-gray-500">Jadwal mengajar yang perlu dipantau hari ini.</p>
                    </div>
                    <a href="{{ route('admin.jadwal.index') }}" class="text-sm font-semibold text-purple-700">
                        Kelola Jadwal
                    </a>
                </div>

                <div class="mt-5 space-y-3">
                    @forelse($jadwalHariIni as $jadwal)
                        <div class="p-4 border border-gray-100">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $jadwal->mapel->nama_mapel ?? '-' }}</p>
                                    <p class="mt-1 text-sm text-gray-500">
                                        {{ $jadwal->guru->name ?? '-' }} • {{ $jadwal->kelas->nama_kelas ?? '-' }}
                                    </p>
                                </div>
                                <span class="px-3 py-1 text-xs font-semibold text-purple-700 bg-purple-50">
                                    {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="p-8 text-sm text-center text-gray-500 border border-gray-200 border-dashed">
                            Belum ada jadwal untuk hari ini.
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="p-6 bg-white border border-gray-100 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-bold text-gray-900">Absensi Terbaru</h2>
                        <p class="text-sm text-gray-500">Aktivitas absensi guru yang baru masuk.</p>
                    </div>
                    <a href="{{ route('admin.absensi.index') }}" class="text-sm font-semibold text-purple-700">
                        Laporan Absensi
                    </a>
                </div>

                <div class="mt-5 space-y-3">
                    @forelse($absensiTerbaru as $item)
                        <div class="p-4 border border-gray-100">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $item->user->name ?? '-' }}</p>
                                    <p class="mt-1 text-sm text-gray-500">
                                        {{ optional($item->tanggal)->translatedFormat('d F Y') }} •
                                        {{ optional($item->waktu_masuk)->format('H:i') ?? '-' }}
                                    </p>
                                </div>
                                <span
                                    class="px-3 py-1 text-xs font-semibold {{ $item->status_masuk === 'terlambat' ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                                    {{ $item->status_masuk === 'terlambat' ? 'Terlambat' : 'Tepat Waktu' }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="p-8 text-sm text-center text-gray-500 border border-gray-200 border-dashed">
                            Belum ada aktivitas absensi terbaru.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

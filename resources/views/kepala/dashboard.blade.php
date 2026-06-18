@extends('layouts.kepala-sekolah')

@section('content')
<div class="space-y-6">
 <div class="flex flex-col gap-2">
 <h1 class="text-3xl font-bold text-gray-900">Dashboard Kepala Sekolah</h1>
 <p class="text-sm text-gray-500">
 Ringkasan pemantauan guru, jadwal, dan absensi terbaru.
 </p>
 </div>

 <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-5">
 <div class="bg-white p-5 shadow-sm">
 <p class="text-sm text-gray-500">Total Guru</p>
 <p class="mt-2 text-3xl font-bold text-purple-700">{{ $totalGuru }}</p>
 </div>

 <div class="bg-white p-5 shadow-sm">
 <p class="text-sm text-gray-500">Guru Aktif</p>
 <p class="mt-2 text-3xl font-bold text-green-600">{{ $guruAktif }}</p>
 </div>

 <div class="bg-white p-5 shadow-sm">
 <p class="text-sm text-gray-500">Absensi Hari Ini</p>
 <p class="mt-2 text-3xl font-bold text-blue-600">{{ $absensiHariIni }}</p>
 </div>

 <div class="bg-white p-5 shadow-sm">
 <p class="text-sm text-gray-500">Terlambat Hari Ini</p>
 <p class="mt-2 text-3xl font-bold text-red-500">{{ $terlambatHariIni }}</p>
 </div>

 <div class="bg-white p-5 shadow-sm">
 <p class="text-sm text-gray-500">Jadwal Hari Ini</p>
 <p class="mt-2 text-3xl font-bold text-amber-500">{{ $jadwalHariIni }}</p>
 </div>
 </div>

 <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">
 <div class="bg-white p-6 shadow-sm">
 <h2 class="text-lg font-semibold text-gray-900">Ringkasan 7 Hari</h2>
 <div class="mt-4 space-y-3">
 @foreach($ringkasanMingguan as $item)
 <div class="border border-gray-100 p-4">
 <div class="flex items-center justify-between">
 <span class="font-medium text-gray-700">{{ $item['label'] }}</span>
 <span class="text-sm text-gray-500">{{ $item['hadir'] }} absensi</span>
 </div>
 <div class="mt-2 h-2 overflow-hidden bg-gray-100">
 <div
 class="h-full bg-purple-600"
 style="width: {{ $item['hadir']> 0 ? min(100, 100 - (($item['terlambat'] / $item['hadir']) * 100)) : 0 }}%;"></div>
 </div>
 <p class="mt-2 text-xs text-gray-500">
 {{ $item['terlambat'] }} guru terlambat
 </p>
 </div>
 @endforeach
 </div>
 </div>

 <div class="bg-white p-6 shadow-sm">
 <h2 class="text-lg font-semibold text-gray-900">Absensi Terbaru</h2>
 <div class="mt-4 space-y-3">
 @forelse($laporanTerbaru as $item)
 <div class="flex items-start justify-between border border-gray-100 p-4">
 <div>
 <p class="font-semibold text-gray-800">{{ $item->user->name ?? '-' }}</p>
 <p class="text-sm text-gray-500">
 {{ $item->tanggal?->translatedFormat('d F Y') ?? '-' }}
 </p>
 </div>
 <span class="px-3 py-1 text-xs font-semibold {{ $item->status_masuk === 'terlambat' ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
 {{ $item->status_masuk === 'terlambat' ? 'Terlambat' : 'Tepat Waktu' }}
 </span>
 </div>
 @empty
 <div class="border border-dashed border-gray-200 p-8 text-center text-sm text-gray-500">
 Belum ada data absensi untuk ditampilkan.
 </div>
 @endforelse
 </div>
 </div>
 </div>
</div>
@endsection

@extends('layouts.kepala-sekolah')

@section('content')
<div class="space-y-6">
 <div class="flex flex-col gap-2 lg:flex-row lg:items-end lg:justify-between">
 <div>
 <h1 class="text-3xl font-bold text-slate-900">Laporan Absensi Guru</h1>
 <p class="mt-2 text-sm text-slate-500">
 Pantau kehadiran guru berdasarkan periode, nama guru, dan status masuk.
 </p>
 </div>
 </div>

 <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
 <div class="bg-white p-5 shadow-sm ring-1 ring-slate-100">
 <p class="text-sm text-slate-500">Total Data</p>
 <p class="mt-2 text-3xl font-bold text-slate-900">{{ $totalData }}</p>
 </div>

 <div class="bg-white p-5 shadow-sm ring-1 ring-slate-100">
 <p class="text-sm text-slate-500">Tepat Waktu</p>
 <p class="mt-2 text-3xl font-bold text-green-600">{{ $tepatWaktu }}</p>
 </div>

 <div class="bg-white p-5 shadow-sm ring-1 ring-slate-100">
 <p class="text-sm text-slate-500">Terlambat</p>
 <p class="mt-2 text-3xl font-bold text-red-500">{{ $terlambat }}</p>
 </div>

 <div class="bg-white p-5 shadow-sm ring-1 ring-slate-100">
 <p class="text-sm text-slate-500">Belum Pulang</p>
 <p class="mt-2 text-3xl font-bold text-amber-500">{{ $belumPulang }}</p>
 </div>
 </div>

 <form method="GET" action="{{ route('kepala.absensi.index') }}" class="grid grid-cols-1 gap-4 bg-white p-5 shadow-sm ring-1 ring-slate-100 lg:grid-cols-5">
 <div>
 <label class="mb-2 block text-sm font-medium text-slate-700">Dari</label>
 <input type="date" name="dari" value="{{ request('dari') }}" class="w-full border-slate-200 text-sm focus:border-purple-500 focus:ring-purple-500">
 </div>

 <div>
 <label class="mb-2 block text-sm font-medium text-slate-700">Sampai</label>
 <input type="date" name="sampai" value="{{ request('sampai') }}" class="w-full border-slate-200 text-sm focus:border-purple-500 focus:ring-purple-500">
 </div>

 <div>
 <label class="mb-2 block text-sm font-medium text-slate-700">Guru</label>
 <select name="user_id" class="w-full border-slate-200 text-sm focus:border-purple-500 focus:ring-purple-500">
 <option value="">Semua Guru</option>
 @foreach($users as $user)
 <option value="{{ $user->id }}" @selected((string) request('user_id') === (string) $user->id)>
 {{ $user->name }}
 </option>
 @endforeach
 </select>
 </div>

 <div>
 <label class="mb-2 block text-sm font-medium text-slate-700">Status Masuk</label>
 <select name="status_masuk" class="w-full border-slate-200 text-sm focus:border-purple-500 focus:ring-purple-500">
 <option value="">Semua Status</option>
 <option value="tepat_waktu" @selected(request('status_masuk') === 'tepat_waktu')>Tepat Waktu</option>
 <option value="terlambat" @selected(request('status_masuk') === 'terlambat')>Terlambat</option>
 </select>
 </div>

 <div class="flex items-end gap-3">
 <button type="submit" class="inline-flex w-full items-center justify-center bg-purple-700 px-4 py-3 text-sm font-semibold text-white transition hover:bg-purple-800">
 Filter
 </button>
 <a href="{{ route('kepala.absensi.index') }}" class="inline-flex w-full items-center justify-center border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">
 Reset
 </a>
 </div>
 </form>

 <div class="overflow-hidden bg-white shadow-sm ring-1 ring-slate-100">
 <div class="overflow-x-auto">
 <table class="min-w-full">
 <thead class="bg-slate-50">
 <tr>
 <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Tanggal</th>
 <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Guru</th>
 <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Masuk</th>
 <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Pulang</th>
 <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Status</th>
 </tr>
 </thead>
 <tbody class="divide-y divide-slate-100">
 @forelse($absensi as $item)
 <tr class="hover:bg-slate-50/70">
 <td class="px-6 py-4 text-sm text-slate-600">
 {{ optional($item->tanggal)->translatedFormat('d F Y') ?? '-' }}
 </td>
 <td class="px-6 py-4">
 <div class="font-semibold text-slate-900">{{ $item->user->name ?? '-' }}</div>
 <div class="text-xs text-slate-500">{{ $item->user->nip ?? '-' }}</div>
 </td>
 <td class="px-6 py-4 text-sm text-slate-600">
 {{ optional($item->waktu_masuk)->format('H:i') ?? '-' }}
 </td>
 <td class="px-6 py-4 text-sm text-slate-600">
 {{ optional($item->waktu_pulang)->format('H:i') ?? '-' }}
 </td>
 <td class="px-6 py-4">
 <span class="inline-flex px-3 py-1 text-xs font-semibold {{ $item->status_masuk === 'terlambat' ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
 {{ $item->status_masuk === 'terlambat' ? 'Terlambat' : 'Tepat Waktu' }}
 </span>
 </td>
 </tr>
 @empty
 <tr>
 <td colspan="5" class="px-6 py-14 text-center text-sm text-slate-500">
 Belum ada data absensi yang sesuai filter.
 </td>
 </tr>
 @endforelse
 </tbody>
 </table>
 </div>
 </div>

 <div>
 {{ $absensi->links() }}
 </div>
</div>
@endsection

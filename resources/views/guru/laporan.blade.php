@extends('layouts.guru')

@section('content')
    <div class="space-y-6">

        <!-- HEADER -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    Laporan Absensi
                </h1>

                <p class="text-gray-500 mt-1">
                    Riwayat absensi dan kehadiran guru
                </p>
            </div>

            <a href="{{ route('guru.dashboard') }}"
                class="inline-flex items-center justify-center px-5 py-3 border border-gray-200 text-sm font-medium text-gray-600 hover:bg-gray-50 transition">
                Kembali
            </a>

        </div>

        <!-- CARD -->
        <div class="bg-white border border-gray-100 shadow-sm overflow-hidden">

            <div class="px-6 py-5 border-b border-gray-100">

                <h2 class="font-semibold text-gray-800">
                    Data Absensi
                </h2>

            </div>

            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead class="bg-gray-50">

                        <tr>

                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                                Tanggal
                            </th>

                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                                Masuk
                            </th>

                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                                Pulang
                            </th>

                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                                Status Masuk
                            </th>

                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                                Status Pulang
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-100">

                        @forelse($laporan as $item)
                            <tr class="hover:bg-gray-50 transition">

                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ $item->waktu_masuk ?? '-' }}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ $item->waktu_pulang ?? '-' }}
                                </td>

                                <td class="px-6 py-4">

                                    @if ($item->status_masuk == 'tepat_waktu')
                                        <span class="px-3 py-1 text-xs font-medium bg-green-100 text-green-700">
                                            Tepat Waktu
                                        </span>
                                    @elseif($item->status_masuk == 'terlambat')
                                        <span class="px-3 py-1 text-xs font-medium bg-red-100 text-red-700">
                                            Terlambat
                                        </span>
                                    @else
                                        <span class="text-gray-400 text-sm">
                                            -
                                        </span>
                                    @endif

                                </td>

                                <td class="px-6 py-4">

                                    @if ($item->status_pulang == 'tepat_waktu')
                                        <span class="px-3 py-1 text-xs font-medium bg-green-100 text-green-700">
                                            Tepat Waktu
                                        </span>
                                    @elseif($item->status_pulang == 'lebih_awal')
                                        <span class="px-3 py-1 text-xs font-medium bg-yellow-100 text-yellow-700">
                                            Lebih Awal
                                        </span>
                                    @else
                                        <span class="text-gray-400 text-sm">
                                            -
                                        </span>
                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5" class="px-6 py-10 text-center text-gray-500">

                                    Belum ada data absensi

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>
@endsection

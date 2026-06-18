@extends('layouts.guru')

@section('content')
    <div class="space-y-6">

        <!-- HEADER -->
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    Laporan Absensi
                </h1>

                <p class="mt-1 text-gray-500">
                    Riwayat absensi dan kehadiran guru
                </p>
            </div>

            <a href="{{ route('guru.dashboard') }}"
                class="inline-flex items-center justify-center px-5 py-3 text-sm font-medium text-gray-600 transition border border-gray-200 hover:bg-gray-50">
                Kembali
            </a>

        </div>

        <!-- CARD -->
        <div class="overflow-hidden bg-white border border-gray-100 shadow-sm">

            <div class="px-6 py-5 border-b border-gray-100">

                <h2 class="font-semibold text-gray-800">
                    Data Absensi
                </h2>

            </div>

            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead class="bg-gray-50">

                        <tr>
                            <th class="px-6 py-4 text-sm font-semibold text-left text-gray-600">
                                Tanggal
                            </th>

                            <th class="px-6 py-4 text-sm font-semibold text-left text-gray-600">
                                Masuk
                            </th>

                            <th class="px-6 py-4 text-sm font-semibold text-left text-gray-600">
                                Foto Masuk
                            </th>

                            <th class="px-6 py-4 text-sm font-semibold text-left text-gray-600">
                                Pulang
                            </th>

                            <th class="px-6 py-4 text-sm font-semibold text-left text-gray-600">
                                Foto Pulang
                            </th>

                            <th class="px-6 py-4 text-sm font-semibold text-left text-gray-600">
                                Status Masuk
                            </th>

                            <th class="px-6 py-4 text-sm font-semibold text-left text-gray-600">
                                Status Pulang
                            </th>
                        </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-100">

                        @forelse($laporan as $item)
                            <tr class="transition hover:bg-gray-50">

                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ $item->waktu_masuk ? \Carbon\Carbon::parse($item->waktu_masuk)->format('H:i:s') : '-' }}
                                </td>

                                <!-- FOTO MASUK -->
                                <td class="px-6 py-4">
                                    @if ($item->foto_masuk)
                                        <img src="{{ asset('storage/' . $item->foto_masuk) }}"
                                            class="object-cover transition border border-gray-200 rounded-lg cursor-pointer w-14 h-14 hover:opacity-80"
                                            onclick="openModal('{{ asset('storage/' . $item->foto_masuk) }}')"
                                            title="Klik untuk perbesar">
                                    @else
                                        <span class="text-sm text-gray-400">-</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ $item->waktu_pulang ? \Carbon\Carbon::parse($item->waktu_pulang)->format('H:i:s') : '-' }}
                                </td>

                                <!-- FOTO PULANG -->
                                <td class="px-6 py-4">
                                    @if ($item->foto_pulang)
                                        <img src="{{ asset('storage/' . $item->foto_pulang) }}"
                                            class="object-cover transition border border-gray-200 rounded-lg cursor-pointer w-14 h-14 hover:opacity-80"
                                            onclick="openModal('{{ asset('storage/' . $item->foto_pulang) }}')"
                                            title="Klik untuk perbesar">
                                    @else
                                        <span class="text-sm text-gray-400">-</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4">

                                    @if ($item->status_masuk == 'tepat_waktu')
                                        <span class="px-3 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full">
                                            Tepat Waktu
                                        </span>
                                    @elseif($item->status_masuk == 'terlambat')
                                        <span class="px-3 py-1 text-xs font-medium text-red-700 bg-red-100 rounded-full">
                                            Terlambat
                                        </span>
                                    @else
                                        <span class="text-sm text-gray-400">
                                            -
                                        </span>
                                    @endif

                                </td>

                                <td class="px-6 py-4">

                                    @if ($item->status_pulang == 'tepat_waktu')
                                        <span class="px-3 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full">
                                            Tepat Waktu
                                        </span>
                                    @elseif($item->status_pulang == 'lebih_awal')
                                        <span class="px-3 py-1 text-xs font-medium text-yellow-700 bg-yellow-100 rounded-full">
                                            Lebih Awal
                                        </span>
                                    @else
                                        <span class="text-sm text-gray-400">
                                            -
                                        </span>
                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="px-6 py-10 text-center text-gray-500">

                                    Belum ada data absensi

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <!-- ============================================ -->
    <!-- MODAL UNTUK PERBESAR GAMBAR -->
    <!-- ============================================ -->
    <div id="imageModal" class="fixed inset-0 z-50 flex items-center justify-center hidden p-4 bg-black bg-opacity-75"
        onclick="closeModal()">
        <div class="relative w-full max-w-4xl" onclick="event.stopPropagation()">
            <img id="modalImage" src="" alt="Foto Absensi"
                class="w-full h-auto max-h-[90vh] object-contain rounded-lg shadow-2xl">
            <button onclick="closeModal()"
                class="absolute right-0 text-3xl text-white transition -top-12 hover:text-gray-300">
                ✕
            </button>
        </div>
    </div>

    <style>
        #imageModal {
            animation: fadeIn 0.2s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        #modalImage {
            animation: zoomIn 0.3s ease-out;
        }

        @keyframes zoomIn {
            from {
                transform: scale(0.8);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>

    <script>
        function openModal(imageSrc) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            modalImage.src = imageSrc;
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Tutup modal dengan tombol ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });
    </script>
@endsection

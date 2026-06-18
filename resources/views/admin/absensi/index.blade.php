@extends('layouts.admin')

@section('content')
    <div class="px-4 mx-auto max-w-7xl sm:px-6">

        <!-- FLASH MESSAGE -->
        @if (session('success'))
            <div class="p-4 mb-4 text-green-700 bg-green-100 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- HEADER -->
        <div class="flex flex-col gap-4 mb-6 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h1 class="text-2xl font-bold sm:text-3xl" style="color: oklch(45.7% 0.24 277.023)">
                    Laporan Absensi
                </h1>
                <p class="mt-1 text-sm text-gray-500">
                    Rekap kehadiran guru
                </p>
            </div>

            <div>
                <a href="{{ route('admin.absensi.export', request()->all()) }}"
                    class="inline-flex items-center px-4 sm:px-5 py-2.5 sm:py-3 font-semibold text-white text-sm sm:text-base transition bg-green-600 hover:bg-green-700 rounded-lg">
                    Export Excel
                </a>
            </div>

        </div>

        <!-- FILTER -->
        <form method="GET" action="{{ route('admin.absensi.index') }}" class="grid grid-cols-1 gap-3 mb-6 sm:grid-cols-2 lg:grid-cols-4">

            <div>
                <label class="text-xs font-medium text-gray-500">Dari Tanggal</label>
                <input type="date" name="dari" value="{{ request('dari') }}"
                    class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
            </div>

            <div>
                <label class="text-xs font-medium text-gray-500">Sampai Tanggal</label>
                <input type="date" name="sampai" value="{{ request('sampai') }}"
                    class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
            </div>

            <div>
                <label class="text-xs font-medium text-gray-500">Pilih Guru</label>
                <select name="user_id" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    <option value="">Semua Guru</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-end gap-2">
                <button type="submit" class="flex-1 px-5 py-2.5 font-semibold text-white rounded-lg transition hover:opacity-90"
                    style="background: oklch(45.7% 0.24 277.023)">
                    Filter
                </button>

                <a href="{{ route('admin.absensi.index') }}"
                    class="flex-1 px-5 py-2.5 font-semibold text-center text-gray-600 transition border border-gray-300 rounded-lg hover:bg-gray-50">
                    Reset
                </a>
            </div>

        </form>

        <!-- ============================================ -->
        <!-- TABEL - DESKTOP -->
        <!-- ============================================ -->
        <div class="hidden overflow-hidden bg-white border border-gray-100 shadow-sm md:block rounded-xl">

            <div class="overflow-x-auto">
                <table class="min-w-full">

                    <thead style="background: oklch(97% 0.01 286)">
                        <tr>
                            <th class="px-4 py-4 text-xs font-semibold text-left text-gray-500 uppercase">Tanggal</th>
                            <th class="px-4 py-4 text-xs font-semibold text-left text-gray-500 uppercase">Guru</th>
                            <th class="px-4 py-4 text-xs font-semibold text-left text-gray-500 uppercase">Masuk</th>
                            <th class="px-4 py-4 text-xs font-semibold text-left text-gray-500 uppercase">Foto</th>
                            <th class="px-4 py-4 text-xs font-semibold text-left text-gray-500 uppercase">Pulang</th>
                            <th class="px-4 py-4 text-xs font-semibold text-left text-gray-500 uppercase">Foto</th>
                            <th class="px-4 py-4 text-xs font-semibold text-left text-gray-500 uppercase">Status</th>
                            <th class="px-4 py-4 text-xs font-semibold text-center text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">

                        @forelse($absensi as $item)
                            <tr class="transition hover:bg-gray-50">

                                <td class="px-4 py-4 text-sm text-gray-700 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d') }}
                                </td>

                                <td class="px-4 py-4 font-semibold text-gray-900 whitespace-nowrap">
                                    {{ $item->user->name ?? '-' }}
                                </td>

                                <td class="px-4 py-4 text-sm text-gray-600 whitespace-nowrap">
                                    {{ $item->waktu_masuk ? \Carbon\Carbon::parse($item->waktu_masuk)->format('H:i:s') : '-' }}
                                </td>

                                <!-- FOTO MASUK -->
                                <td class="px-4 py-4">
                                    @if ($item->foto_masuk)
                                        <img src="{{ asset('storage/' . $item->foto_masuk) }}"
                                            class="object-cover w-10 h-10 transition border border-gray-200 rounded-lg cursor-pointer hover:opacity-80"
                                            onclick="openModal('{{ asset('storage/' . $item->foto_masuk) }}')"
                                            title="Klik untuk perbesar">
                                    @else
                                        <span class="text-xs text-gray-400">-</span>
                                    @endif
                                </td>

                                <td class="px-4 py-4 text-sm text-gray-600 whitespace-nowrap">
                                    {{ $item->waktu_pulang ? \Carbon\Carbon::parse($item->waktu_pulang)->format('H:i:s') : '-' }}
                                </td>

                                <!-- FOTO PULANG -->
                                <td class="px-4 py-4">
                                    @if ($item->foto_pulang)
                                        <img src="{{ asset('storage/' . $item->foto_pulang) }}"
                                            class="object-cover w-10 h-10 transition border border-gray-200 rounded-lg cursor-pointer hover:opacity-80"
                                            onclick="openModal('{{ asset('storage/' . $item->foto_pulang) }}')"
                                            title="Klik untuk perbesar">
                                    @else
                                        <span class="text-xs text-gray-400">-</span>
                                    @endif
                                </td>

                                <td class="px-4 py-4">
                                    @if ($item->status_masuk == 'terlambat')
                                        <span class="px-2.5 py-1 text-xs font-medium text-red-700 bg-red-100 rounded-full">
                                            Terlambat
                                        </span>
                                    @elseif ($item->status_masuk == 'tepat_waktu')
                                        <span class="px-2.5 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full">
                                            Tepat Waktu
                                        </span>
                                    @else
                                        <span class="px-2.5 py-1 text-xs font-medium text-gray-500 bg-gray-100 rounded-full">
                                            -
                                        </span>
                                    @endif
                                </td>

                                <!-- ACTION -->
                                <td class="px-4 py-4">
                                    <div class="flex justify-center gap-1.5">
                                        <a href="{{ route('admin.absensi.show', $item->id) }}"
                                            class="px-3 py-1.5 text-xs text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition whitespace-nowrap">
                                            Detail
                                        </a>

                                        <button type="button" onclick="confirmDelete({{ $item->id }})"
                                            class="px-3 py-1.5 text-xs text-white bg-red-600 rounded-lg hover:bg-red-700 transition whitespace-nowrap">
                                            Hapus
                                        </button>

                                        <form id="delete-form-{{ $item->id }}"
                                            action="{{ route('admin.absensi.destroy', $item->id) }}" method="POST" class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>

                            </tr>

                        @empty
                            <tr>
                                <td colspan="8" class="py-12 text-center text-gray-500">
                                    Data absensi belum tersedia
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>
            </div>

        </div>

        <!-- ============================================ -->
        <!-- CARD VIEW - MOBILE -->
        <!-- ============================================ -->
        <div class="space-y-4 md:hidden">

            @forelse($absensi as $item)
                <div class="p-4 bg-white border border-gray-100 shadow-sm rounded-xl">

                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d') }}</p>
                            <p class="text-base font-bold text-gray-900">{{ $item->user->name ?? '-' }}</p>
                        </div>
                        <div>
                            @if ($item->status_masuk == 'terlambat')
                                <span class="px-2.5 py-1 text-xs font-medium text-red-700 bg-red-100 rounded-full">
                                    Terlambat
                                </span>
                            @elseif ($item->status_masuk == 'tepat_waktu')
                                <span class="px-2.5 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full">
                                    Tepat Waktu
                                </span>
                            @else
                                <span class="px-2.5 py-1 text-xs font-medium text-gray-500 bg-gray-100 rounded-full">
                                    -
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-2 mt-3 text-sm">
                        <div>
                            <p class="text-xs text-gray-400">Masuk</p>
                            <p class="font-medium text-gray-700">{{ $item->waktu_masuk ? \Carbon\Carbon::parse($item->waktu_masuk)->format('H:i:s') : '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Pulang</p>
                            <p class="font-medium text-gray-700">{{ $item->waktu_pulang ? \Carbon\Carbon::parse($item->waktu_pulang)->format('H:i:s') : '-' }}</p>
                        </div>
                    </div>

                    <div class="flex gap-3 mt-2">
                        @if ($item->foto_masuk)
                            <div class="text-center">
                                <p class="text-xs text-gray-400">Foto Masuk</p>
                                <img src="{{ asset('storage/' . $item->foto_masuk) }}"
                                    class="object-cover w-16 h-16 mt-1 transition border border-gray-200 rounded-lg cursor-pointer hover:opacity-80"
                                    onclick="openModal('{{ asset('storage/' . $item->foto_masuk) }}')">
                            </div>
                        @endif
                        @if ($item->foto_pulang)
                            <div class="text-center">
                                <p class="text-xs text-gray-400">Foto Pulang</p>
                                <img src="{{ asset('storage/' . $item->foto_pulang) }}"
                                    class="object-cover w-16 h-16 mt-1 transition border border-gray-200 rounded-lg cursor-pointer hover:opacity-80"
                                    onclick="openModal('{{ asset('storage/' . $item->foto_pulang) }}')">
                            </div>
                        @endif
                    </div>

                    <div class="flex items-center gap-2 pt-3 mt-4 border-t border-gray-100">
                        <a href="{{ route('admin.absensi.show', $item->id) }}"
                            class="flex-1 px-3 py-2 text-xs text-center text-white transition bg-blue-600 rounded-lg hover:bg-blue-700">
                            Detail
                        </a>
                        <button type="button" onclick="confirmDelete({{ $item->id }})"
                            class="flex-1 px-3 py-2 text-xs text-center text-white transition bg-red-600 rounded-lg hover:bg-red-700">
                            Hapus
                        </button>
                    </div>

                </div>

            @empty
                <div class="p-8 text-center text-gray-500 bg-white border border-gray-100 rounded-xl">
                    Data absensi belum tersedia
                </div>
            @endforelse

        </div>

        <!-- PAGINATION -->
        <div class="mt-6">
            {{ $absensi->links() }}
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
            from { opacity: 0; }
            to { opacity: 1; }
        }

        #modalImage {
            animation: zoomIn 0.3s ease-out;
        }

        @keyframes zoomIn {
            from { transform: scale(0.8); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }
    </style>

    <!-- SWEETALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin hapus data ini?',
                text: "Data absensi akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }

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

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });
    </script>
@endsection

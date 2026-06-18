@extends('layouts.admin')

@section('content')
    <div class="mx-auto max-w-7xl">

        <!-- FLASH MESSAGE -->
        @if (session('success'))
            <div class="p-4 mb-4 text-green-700 bg-green-100">
                {{ session('success') }}
            </div>
        @endif

        <!-- HEADER -->
        <div class="flex flex-col gap-4 mb-6 lg:flex-row lg:items-center lg:justify-between">

            <div>
                <h1 class="text-3xl font-bold" style="color: oklch(45.7% 0.24 277.023)">
                    Laporan Absensi
                </h1>
                <p class="mt-2 text-sm text-gray-500">
                    Rekap kehadiran guru
                </p>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('admin.absensi.export', request()->all()) }}"
                    class="px-5 py-3 font-semibold text-white transition bg-green-600 hover:bg-green-700">
                    Export Excel
                </a>
            </div>

        </div>

        <!-- FILTER -->
        <form method="GET" action="{{ route('admin.absensi.index') }}" class="grid grid-cols-1 gap-4 mb-6 md:grid-cols-4">

            <input type="date" name="dari" value="{{ request('dari') }}" class="px-4 py-3 border border-gray-200">

            <input type="date" name="sampai" value="{{ request('sampai') }}" class="px-4 py-3 border border-gray-200">

            <select name="user_id" class="px-4 py-3 border border-gray-200">

                <option value="">Semua Guru</option>

                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach

            </select>

            <div class="flex gap-2">
                <button type="submit" class="flex-1 px-5 py-3 font-semibold text-white"
                    style="background: oklch(45.7% 0.24 277.023)">
                    Filter
                </button>

                <a href="{{ route('admin.absensi.index') }}"
                    class="flex-1 px-5 py-3 font-semibold text-center text-gray-600 transition border border-gray-300 hover:bg-gray-50">
                    Reset
                </a>
            </div>

        </form>

        <!-- TABLE -->
        <div class="overflow-hidden bg-white border border-gray-100 shadow-sm">

            <table class="min-w-full">

                <thead style="background: oklch(97% 0.01 286)">
                    <tr>
                        <th class="px-6 py-5 text-left">Tanggal</th>
                        <th class="px-6 py-5 text-left">Guru</th>
                        <th class="px-6 py-5 text-left">Masuk</th>
                        <th class="px-6 py-5 text-left">Foto Masuk</th>
                        <th class="px-6 py-5 text-left">Pulang</th>
                        <th class="px-6 py-5 text-left">Foto Pulang</th>
                        <th class="px-6 py-5 text-left">Status</th>
                        <th class="px-6 py-5 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">

                    @forelse($absensi as $item)
                        <tr class="transition hover:bg-gray-50">

                            {{-- ============================================ --}}
                            {{-- PERBAIKI TANGGAL - TANPA 00:00:00 --}}
                            {{-- ============================================ --}}
                            <td class="px-6 py-5 text-sm text-gray-700">
                                {{ \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d') }}
                            </td>

                            <td class="px-6 py-5 font-semibold text-gray-900">
                                {{ $item->user->name ?? '-' }}
                            </td>

                            {{-- WAKTU MASUK --}}
                            <td class="px-6 py-5 text-gray-600">
                                {{ $item->waktu_masuk ? \Carbon\Carbon::parse($item->waktu_masuk)->format('H:i:s') : '-' }}
                            </td>

                            <!-- FOTO MASUK -->
                            <td class="px-6 py-5">
                                @if ($item->foto_masuk)
                                    <img src="{{ asset('storage/' . $item->foto_masuk) }}"
                                        class="object-cover w-12 h-12 border cursor-pointer"
                                        onclick="window.open(this.src)">
                                @else
                                    <span class="text-xs text-gray-400">-</span>
                                @endif
                            </td>

                            {{-- WAKTU PULANG --}}
                            <td class="px-6 py-5 text-gray-600">
                                {{ $item->waktu_pulang ? \Carbon\Carbon::parse($item->waktu_pulang)->format('H:i:s') : '-' }}
                            </td>

                            <!-- FOTO PULANG -->
                            <td class="px-6 py-5">
                                @if ($item->foto_pulang)
                                    <img src="{{ asset('storage/' . $item->foto_pulang) }}"
                                        class="object-cover w-12 h-12 border cursor-pointer"
                                        onclick="window.open(this.src)">
                                @else
                                    <span class="text-xs text-gray-400">-</span>
                                @endif
                            </td>

                            <td class="px-6 py-5">

                                @if ($item->status_masuk == 'terlambat')
                                    <span class="px-3 py-1 text-xs text-red-700 bg-red-100">
                                        Terlambat
                                    </span>
                                @elseif ($item->status_masuk == 'tepat_waktu')
                                    <span class="px-3 py-1 text-xs text-green-700 bg-green-100">
                                        Tepat Waktu
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-xs text-gray-500 bg-gray-100">
                                        -
                                    </span>
                                @endif

                            </td>

                            <!-- ACTION -->
                            <td class="flex justify-center gap-2 px-6 py-5 text-center">

                                <a href="{{ route('admin.absensi.show', $item->id) }}"
                                    class="px-4 py-2 text-xs text-white bg-blue-500 hover:bg-blue-600">
                                    Detail
                                </a>

                                <form id="delete-form-{{ $item->id }}"
                                    action="{{ route('admin.absensi.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="button" onclick="confirmDelete({{ $item->id }})"
                                        class="px-4 py-2 text-xs text-white bg-red-500 hover:bg-red-600">
                                        Hapus
                                    </button>
                                </form>

                            </td>

                        </tr>

                    @empty
                        <tr>
                            <td colspan="8" class="py-10 text-center text-gray-500">
                                Data absensi belum tersedia
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-6">
            {{ $absensi->links() }}
        </div>

    </div>

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
            })
        }
    </script>
@endsection

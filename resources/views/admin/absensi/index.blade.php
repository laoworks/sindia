@extends('layouts.admin')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- FLASH MESSAGE -->
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    <!-- HEADER -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">

        <div>
            <h1 class="text-3xl font-bold" style="color: oklch(45.7% 0.24 277.023)">
                Laporan Absensi
            </h1>
            <p class="text-sm text-gray-500 mt-2">
                Rekap kehadiran guru
            </p>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('admin.absensi.export', request()->all()) }}"
               class="px-5 py-3 rounded-2xl text-white font-semibold bg-green-600 hover:bg-green-700 transition">
                Export Excel
            </a>
        </div>

    </div>

    <!-- FILTER -->
    <form method="GET"
          action="{{ route('admin.absensi.index') }}"
          class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">

        <input type="date" name="dari" value="{{ request('dari') }}"
               class="px-4 py-3 rounded-2xl border border-gray-200">

        <input type="date" name="sampai" value="{{ request('sampai') }}"
               class="px-4 py-3 rounded-2xl border border-gray-200">

        <select name="user_id"
                class="px-4 py-3 rounded-2xl border border-gray-200">

            <option value="">Semua Guru</option>

            @foreach($users as $user)
                <option value="{{ $user->id }}"
                    {{ request('user_id') == $user->id ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
            @endforeach

        </select>

        <div class="flex gap-2">
            <button type="submit"
                    class="flex-1 px-5 py-3 rounded-2xl text-white font-semibold"
                    style="background: oklch(45.7% 0.24 277.023)">
                Filter
            </button>

            <a href="{{ route('admin.absensi.index') }}"
               class="flex-1 px-5 py-3 rounded-2xl text-center font-semibold border border-gray-300 text-gray-600 hover:bg-gray-50 transition">
                Reset
            </a>
        </div>

    </form>

    <!-- TABLE -->
    <div class="bg-white rounded-3xl border border-gray-100 overflow-hidden shadow-sm">

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

                    <tr class="hover:bg-gray-50 transition">

                        <td class="px-6 py-5 text-sm text-gray-700">
                            {{ $item->tanggal }}
                        </td>

                        <td class="px-6 py-5 font-semibold text-gray-900">
                            {{ $item->user->name ?? '-' }}
                        </td>

                        <td class="px-6 py-5 text-gray-600">
                            {{ $item->waktu_masuk ?? '-' }}
                        </td>

                        <!-- FOTO MASUK -->
                        <td class="px-6 py-5">
                            @if($item->foto_masuk)
                                <img src="{{ asset('storage/' . $item->foto_masuk) }}"
                                     class="w-12 h-12 rounded-xl object-cover border cursor-pointer"
                                     onclick="window.open(this.src)">
                            @else
                                <span class="text-gray-400 text-xs">-</span>
                            @endif
                        </td>

                        <td class="px-6 py-5 text-gray-600">
                            {{ $item->waktu_pulang ?? '-' }}
                        </td>

                        <!-- FOTO PULANG -->
                        <td class="px-6 py-5">
                            @if($item->foto_pulang)
                                <img src="{{ asset('storage/' . $item->foto_pulang) }}"
                                     class="w-12 h-12 rounded-xl object-cover border cursor-pointer"
                                     onclick="window.open(this.src)">
                            @else
                                <span class="text-gray-400 text-xs">-</span>
                            @endif
                        </td>

                        <td class="px-6 py-5">

                            @if($item->status_masuk == 'terlambat')
                                <span class="px-3 py-1 text-xs rounded-xl bg-red-100 text-red-700">
                                    Terlambat
                                </span>
                            @else
                                <span class="px-3 py-1 text-xs rounded-xl bg-green-100 text-green-700">
                                    Tepat Waktu
                                </span>
                            @endif

                        </td>

                        <!-- ACTION -->
                        <td class="px-6 py-5 text-center flex justify-center gap-2">

                            <a href="{{ route('admin.absensi.show', $item->id) }}"
                               class="px-4 py-2 bg-blue-500 text-white rounded-xl text-xs">
                                Detail
                            </a>

                            <form id="delete-form-{{ $item->id }}"
                                  action="{{ route('admin.absensi.destroy', $item->id) }}"
                                  method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="button"
                                        onclick="confirmDelete({{ $item->id }})"
                                        class="px-4 py-2 bg-red-500 text-white rounded-xl text-xs">
                                    Hapus
                                </button>
                            </form>

                        </td>

                    </tr>

                @empty
                    <tr>
                        <td colspan="8" class="text-center py-10 text-gray-500">
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

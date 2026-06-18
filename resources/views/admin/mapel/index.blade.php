@extends('layouts.admin')

@section('content')
    <div class="px-4 mx-auto max-w-7xl sm:px-6">

        <!-- HEADER -->
        <div class="flex flex-col gap-4 mb-6 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h1 class="text-2xl font-bold sm:text-3xl" style="color: oklch(45.7% 0.24 277.023)">
                    Mata Pelajaran
                </h1>
                <p class="mt-1 text-sm text-gray-500">
                    Kelola data mata pelajaran
                </p>
            </div>

            <div>
                <a href="{{ route('admin.mapel.create') }}"
                    class="inline-flex items-center justify-center w-full sm:w-auto px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:opacity-90 transition rounded-lg"
                    style="background: oklch(45.7% 0.24 277.023)">
                    + Tambah Mapel
                </a>
            </div>

        </div>

        <!-- ============================================ -->
        <!-- TABEL - DESKTOP -->
        <!-- ============================================ -->
        <div class="overflow-hidden bg-white border border-gray-100 shadow-sm rounded-xl">

            <div class="overflow-x-auto">
                <table class="min-w-full">

                    <thead style="background: oklch(97% 0.01 286)">
                        <tr>
                            <th class="px-6 py-4 text-xs font-semibold text-left text-gray-500 uppercase">No</th>
                            <th class="px-6 py-4 text-xs font-semibold text-left text-gray-500 uppercase">Nama Mapel</th>
                            <th class="px-6 py-4 text-xs font-semibold text-left text-gray-500 uppercase">KKM</th>
                            <th class="px-6 py-4 text-xs font-semibold text-center text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-100">

                        @forelse($mapel as $item)
                            <tr class="transition hover:bg-gray-50">

                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $mapel->firstItem() + $loop->index }}
                                </td>

                                <td class="px-6 py-4 font-semibold text-gray-900">
                                    {{ $item->nama_mapel }}
                                </td>

                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 text-xs font-semibold text-blue-700 bg-blue-100 rounded-full">
                                        {{ $item->kkm }}
                                    </span>
                                </td>

                                <!-- ============================================ -->
                                <!-- TOMBOL AKSI - DIPERBESAR -->
                                <!-- ============================================ -->
                                <td class="px-6 py-4">
                                    <div class="flex justify-center gap-2">

                                        <a href="{{ route('admin.mapel.show', $item->id) }}"
                                            class="px-4 py-2 text-sm font-medium text-white transition bg-blue-500 rounded-lg hover:bg-blue-600">
                                            View
                                        </a>

                                        <a href="{{ route('admin.mapel.edit', $item->id) }}"
                                            class="px-4 py-2 text-sm font-medium text-white transition bg-yellow-500 rounded-lg hover:bg-yellow-600">
                                            Edit
                                        </a>

                                        <button type="button"
                                            onclick="deleteMapel({{ $item->id }}, @js($item->nama_mapel))"
                                            class="px-4 py-2 text-sm font-medium text-white transition bg-red-500 rounded-lg hover:bg-red-600">
                                            Delete
                                        </button>

                                        <form id="delete-form-{{ $item->id }}"
                                            action="{{ route('admin.mapel.destroy', $item->id) }}" method="POST"
                                            class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                    </div>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="4" class="py-12 text-center text-gray-500">
                                    <div class="mb-2 text-4xl">📭</div>
                                    <p>Data mata pelajaran belum tersedia</p>
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

            @forelse($mapel as $item)
                <div class="p-4 bg-white border border-gray-100 shadow-sm rounded-xl">

                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs text-gray-400">#{{ $mapel->firstItem() + $loop->index }}</p>
                            <p class="text-base font-bold text-gray-900">{{ $item->nama_mapel }}</p>
                        </div>
                        <div>
                            <span class="px-3 py-1 text-xs font-semibold text-blue-700 bg-blue-100 rounded-full">
                                KKM: {{ $item->kkm }}
                            </span>
                        </div>
                    </div>

                    <!-- TOMBOL MOBILE - DIPERBESAR -->
                    <div class="flex items-center gap-2 pt-3 mt-4 border-t border-gray-100">
                        <a href="{{ route('admin.mapel.show', $item->id) }}"
                            class="flex-1 px-4 py-2.5 text-sm font-medium text-center text-white transition bg-blue-500 rounded-lg hover:bg-blue-600">
                            View
                        </a>

                        <a href="{{ route('admin.mapel.edit', $item->id) }}"
                            class="flex-1 px-4 py-2.5 text-sm font-medium text-center text-white transition bg-yellow-500 rounded-lg hover:bg-yellow-600">
                            Edit
                        </a>

                        <button type="button"
                            onclick="deleteMapel({{ $item->id }}, @js($item->nama_mapel))"
                            class="flex-1 px-4 py-2.5 text-sm font-medium text-center text-white transition bg-red-500 rounded-lg hover:bg-red-600">
                            Delete
                        </button>
                    </div>

                </div>

            @empty

                <div class="p-8 text-center text-gray-500 bg-white border border-gray-100 rounded-xl">
                    <div class="mb-2 text-4xl">📭</div>
                    <p>Data mata pelajaran belum tersedia</p>
                </div>

            @endforelse

        </div>

        <!-- PAGINATION -->
        <div class="mt-6">
            {{ $mapel->links() }}
        </div>

    </div>

    {{-- SWEETALERT SUCCESS --}}
    @if (session('message'))
        <script>
            Swal.fire({
                icon: @json(session('icon') ?? 'success'),
                title: @json(session('title') ?? 'Berhasil'),
                text: @json(session('message')),
                confirmButtonColor: '#6d28d9',
            });
        </script>
    @endif

    {{-- SWEETALERT DELETE --}}
    <script>
        function deleteMapel(id, name) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: 'Data mapel "' + name + '" akan dihapus!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
@endsection

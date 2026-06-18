@extends('layouts.operator')

@section('content')
    <div class="max-w-7xl mx-auto space-y-6">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Data Mata Pelajaran</h1>
                <p class="mt-2 text-sm text-gray-500">
                    Kelola mata pelajaran dan nilai KKM yang menjadi acuan pembelajaran.
                </p>
            </div>

            <a href="{{ route('operator.mapel.create') }}"
                class="inline-flex items-center justify-center px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:opacity-90"
                style="background: oklch(45.7% 0.24 277.023)">
                Tambah Mapel
            </a>
        </div>

        <!-- SUCCESS -->
        @if (session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: @json(session('success')),
                        timer: 2000,
                        showConfirmButton: false
                    });
                });
            </script>
        @endif

        <div class="overflow-hidden border border-gray-100 bg-white shadow-sm">
            <div class="border-b border-gray-100 px-6 py-4">
                <h2 class="text-base font-semibold text-gray-900">Daftar Mata Pelajaran</h2>
                <p class="mt-1 text-sm text-gray-500">Total data pada halaman ini: {{ $mapel->count() }}</p>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Nama
                                Mapel</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">KKM
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($mapel as $m)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <p class="font-semibold text-gray-900">{{ $m->nama_mapel }}</p>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <span class="inline-flex bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700">
                                        KKM {{ $m->kkm }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-2">
                                        <a href="{{ route('operator.mapel.edit', $m->id) }}"
                                            class="inline-flex items-center bg-amber-500 px-3 py-2 text-xs font-semibold text-white hover:bg-amber-600">
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('operator.mapel.destroy', $m->id) }}"
                                            class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                class="delete-btn inline-flex items-center bg-red-600 px-3 py-2 text-xs font-semibold text-white hover:bg-red-700">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-10 text-center text-sm text-gray-500">
                                    Tidak ada data mapel
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white px-4 py-3 shadow-sm">
            {{ $mapel->links() }}
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('click', function(e) {

            const btn = e.target.closest('.delete-btn');
            if (!btn) return;

            const form = btn.closest('.delete-form');

            Swal.fire({
                title: "Hapus Mata Pelajaran?",
                text: "Data tidak bisa dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#dc2626",
                cancelButtonColor: "#6b7280",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {

                if (result.isConfirmed) {

                    Swal.fire({
                        title: "Menghapus...",
                        allowOutsideClick: false,
                        didOpen: () => Swal.showLoading()
                    });

                    form.submit();
                }

            });

        });
    </script>
@endpush

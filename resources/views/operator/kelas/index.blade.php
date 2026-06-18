@extends('layouts.operator')

@section('content')
    <div class="max-w-7xl mx-auto space-y-6">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Data Kelas</h1>
                <p class="mt-2 text-sm text-gray-500">
                    Kelola daftar kelas dan jurusan yang dipakai pada jadwal pembelajaran.
                </p>
            </div>

            <a href="{{ route('operator.kelas.create') }}"
                class="inline-flex items-center justify-center px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:opacity-90"
                style="background: oklch(45.7% 0.24 277.023)">
                Tambah Kelas
            </a>
        </div>

        <!-- SUCCESS ALERT -->
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
                <h2 class="text-base font-semibold text-gray-900">Daftar Kelas</h2>
                <p class="mt-1 text-sm text-gray-500">Total data pada halaman ini: {{ $kelas->count() }}</p>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Nama
                                Kelas</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                                Jurusan</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($kelas as $k)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <p class="font-semibold text-gray-900">{{ $k->nama_kelas }}</p>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $k->jurusan }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-2">
                                        <a href="{{ route('operator.kelas.edit', $k->id) }}"
                                            class="inline-flex items-center bg-amber-500 px-3 py-2 text-xs font-semibold text-white hover:bg-amber-600">
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('operator.kelas.destroy', $k->id) }}"
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
                                    Tidak ada data kelas
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white px-4 py-3 shadow-sm">
            {{ $kelas->links() }}
        </div>
    </div>
@endsection

@push('scripts')
    <!-- DELETE SWEETALERT FIX 100% WORK -->
    <script>
        document.addEventListener('click', function(e) {

            const btn = e.target.closest('.delete-btn');
            if (!btn) return;

            e.preventDefault();

            const form = btn.closest('.delete-form');
            if (!form) return;

            Swal.fire({
                title: "Yakin hapus data?",
                text: "Data tidak bisa dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#dc2626",
                cancelButtonColor: "#6b7280",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal",
                reverseButtons: true
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

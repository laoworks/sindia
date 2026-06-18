@extends('layouts.operator')

@section('content')
    <div class="max-w-7xl mx-auto space-y-6">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Data Jadwal</h1>
                <p class="mt-2 text-sm text-gray-500">
                    Kelola jadwal mengajar guru berdasarkan kelas, mata pelajaran, dan hari aktif.
                </p>
            </div>

            <a href="{{ route('operator.jadwal.create') }}"
                class="inline-flex items-center justify-center px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:opacity-90"
                style="background: oklch(45.7% 0.24 277.023)">
                Tambah Jadwal
            </a>
        </div>

        <div class="border border-gray-100 bg-white p-5 shadow-sm">
            <form method="GET" class="flex flex-col gap-3 md:flex-row md:items-center">
                <select name="hari" class="border border-gray-200 px-4 py-3 text-sm text-gray-700">
                    <option value="">Semua Hari</option>
                    @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $h)
                        <option value="{{ $h }}" {{ request('hari') == $h ? 'selected' : '' }}>
                            {{ $h }}
                        </option>
                    @endforeach
                </select>

                <button class="bg-indigo-600 px-4 py-3 text-sm font-semibold text-white hover:bg-indigo-700">
                    Filter
                </button>

                <a href="{{ route('operator.jadwal.index') }}"
                    class="inline-flex items-center justify-center border border-gray-200 px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50">
                    Reset
                </a>
            </form>
        </div>

        @if (session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: @json(session('success')),
                        timer: 1800,
                        showConfirmButton: false
                    });
                });
            </script>
        @endif

        <div class="overflow-hidden border border-gray-100 bg-white shadow-sm">
            <div class="border-b border-gray-100 px-6 py-4">
                <h2 class="text-base font-semibold text-gray-900">Daftar Jadwal</h2>
                <p class="mt-1 text-sm text-gray-500">Total data pada halaman ini: {{ $jadwal->count() }}</p>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Guru
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                                Kelas</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                                Mapel</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Hari
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Jam
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($jadwal as $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ $item->guru->name ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $item->kelas->nama_kelas ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $item->mapel->nama_mapel ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <span class="inline-flex bg-gray-100 px-3 py-1 text-xs font-medium text-gray-700">
                                        {{ $item->hari }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $item->jam_mulai }} - {{ $item->jam_selesai }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-2">
                                        <a href="{{ route('operator.jadwal.edit', $item->id) }}"
                                            class="inline-flex items-center bg-amber-500 px-3 py-2 text-xs font-semibold text-white hover:bg-amber-600">
                                            Edit
                                        </a>
                                        <form action="{{ route('operator.jadwal.destroy', $item->id) }}" method="POST"
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
                                <td colspan="6" class="px-6 py-10 text-center text-sm text-gray-500">
                                    Tidak ada data
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white px-4 py-3 shadow-sm">
            {{ $jadwal->links() }}
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('click', function(e) {
                const btn = e.target.closest('.delete-btn');
                if (!btn) return;

                const form = btn.closest('.delete-form');
                if (!form) return;

                Swal.fire({
                    title: 'Hapus Jadwal?',
                    text: 'Data tidak bisa dikembalikan!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        </script>
    @endpush
@endsection

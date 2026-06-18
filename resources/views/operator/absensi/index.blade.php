@extends('layouts.operator')

@section('content')
    <div class="max-w-7xl mx-auto space-y-6">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Kelola Absensi</h1>
                <p class="mt-2 text-sm text-gray-500">
                    Pantau data kehadiran guru, lakukan filter, dan ekspor laporan sesuai kebutuhan.
                </p>
            </div>

            <div class="flex flex-wrap gap-2">
                <a href="{{ route('operator.absensi.export.excel', request()->query()) }}"
                    class="inline-flex items-center justify-center bg-green-600 px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-green-700">
                    Export Excel
                </a>

                <a href="{{ route('operator.absensi.export.pdf', request()->query()) }}"
                    class="inline-flex items-center justify-center bg-red-600 px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-red-700">
                    Export PDF
                </a>
            </div>
        </div>

        <div class="border border-gray-100 bg-white p-5 shadow-sm">
            <form method="GET" class="flex flex-col gap-3 md:flex-row md:items-center">
                <input type="date" name="tanggal" value="{{ request('tanggal') }}"
                    class="border border-gray-200 px-4 py-3 text-sm text-gray-700">

                <select name="user_id" class="border border-gray-200 px-4 py-3 text-sm text-gray-700">
                    <option value="">Semua Guru</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" @selected((string) request('user_id') === (string) $user->id)>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>

                <button class="bg-indigo-600 px-4 py-3 text-sm font-semibold text-white hover:bg-indigo-700">
                    Filter
                </button>

                <a href="{{ route('operator.absensi.index') }}"
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
                <h2 class="text-base font-semibold text-gray-900">Daftar Absensi</h2>
                <p class="mt-1 text-sm text-gray-500">Total data pada halaman ini: {{ $absensi->count() }}</p>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                Tanggal
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                Guru
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                Masuk
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                Pulang
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                Status
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($absensi as $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                    {{ $item->user->name ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ optional($item->waktu_masuk)->format('H:i') ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ optional($item->waktu_pulang)->format('H:i') ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold 
 {{ $item->status_masuk === 'terlambat' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                        {{ $item->status_masuk === 'tepat_waktu' ? 'Tepat Waktu' : ($item->status_masuk === 'terlambat' ? 'Terlambat' : '-') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm font-medium">
                                    <div class="flex flex-wrap gap-2">
                                        <a href="{{ route('operator.absensi.show', $item->id) }}"
                                            class="inline-flex items-center bg-blue-600 px-3 py-2 text-xs font-semibold text-white hover:bg-blue-700 transition shadow-sm">
                                            View
                                        </a>
                                        <form action="{{ route('operator.absensi.destroy', $item->id) }}" method="POST"
                                            class="inline-block delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                class="delete-btn inline-flex items-center bg-red-600 px-3 py-2 text-xs font-semibold text-white hover:bg-red-700 transition shadow-sm">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                                    Tidak ada data absensi
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white px-4 py-3 shadow-sm">
            {{ $absensi->links() }}
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('click', function(e) {
                const button = e.target.closest('.delete-btn');
                if (!button) return;

                const form = button.closest('.delete-form');
                if (!form) return;

                Swal.fire({
                    title: 'Yakin hapus data ini?',
                    text: 'Data tidak bisa dikembalikan!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, hapus!',
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

@extends('layouts.operator')

@section('content')

<!-- SWEETALERT -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="max-w-7xl mx-auto bg-white p-6 md:p-8 rounded-lg shadow-md">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">

        <h1 class="text-3xl font-bold text-gray-900">
            Kelola Absensi
        </h1>

        <div class="flex gap-2">

            <a href="{{ route('operator.absensi.export.excel') }}"
               class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-md transition shadow-sm">
                Export Excel
            </a>

            <a href="{{ route('operator.absensi.export.pdf') }}"
               class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-md transition shadow-sm">
                Export PDF
            </a>

        </div>

    </div>

    <!-- FILTER -->
    <form method="GET" class="mb-6 flex gap-3">

        <input type="date"
               name="tanggal"
               value="{{ request('tanggal') }}"
               class="border border-gray-300 rounded-md px-3 py-2 text-sm">

        <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm">
            Filter
        </button>

    </form>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- TABLE -->
    <div class="overflow-x-auto">

        <table class="min-w-full bg-white border border-gray-200 shadow-sm rounded-lg overflow-hidden">

            <thead class="bg-gray-50 border-b border-gray-200">

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

            <tbody class="divide-y divide-gray-200">

                @forelse($absensi as $item)

                <tr class="hover:bg-gray-50 transition">

                    <td class="px-6 py-4 text-sm text-gray-700">
                        {{ $item->tanggal }}
                    </td>

                    <td class="px-6 py-4 text-sm font-medium text-gray-900">
                        {{ $item->user->name ?? '-' }}
                    </td>

                    <td class="px-6 py-4 text-sm text-gray-700">
                        {{ $item->waktu_masuk ?? '-' }}
                    </td>

                    <td class="px-6 py-4 text-sm text-gray-700">
                        {{ $item->waktu_pulang ?? '-' }}
                    </td>

                    <td class="px-6 py-4 text-sm">

                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                            {{ $item->status_masuk === 'terlambat'
                                ? 'bg-red-100 text-red-800'
                                : 'bg-green-100 text-green-800' }}">

                            {{ ucfirst($item->status_masuk ?? '-') }}

                        </span>

                    </td>

                    <!-- ACTION -->
                    <td class="px-6 py-4 text-sm font-medium space-x-2">

                        <!-- VIEW -->
                        <a href="{{ route('operator.absensi.show', $item->id) }}"
                           class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white text-xs rounded-md hover:bg-blue-700 transition shadow-sm">
                            View
                        </a>

                        <!-- DELETE -->
                        <form action="{{ route('operator.absensi.destroy', $item->id) }}"
                              method="POST"
                              class="inline-block delete-form">

                            @csrf
                            @method('DELETE')

                            <button type="button"
                                    class="delete-btn inline-flex items-center px-3 py-1.5 bg-red-600 text-white text-xs rounded-md hover:bg-red-700 transition shadow-sm">

                                Delete

                            </button>

                        </form>

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

    <!-- PAGINATION -->
    <div class="mt-6">
        {{ $absensi->links() }}
    </div>

</div>

<!-- SWEETALERT SCRIPT -->
<script>
document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', function () {

        let form = this.closest('.delete-form');

        Swal.fire({
            title: "Yakin hapus data ini?",
            text: "Data tidak bisa dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc2626",
            cancelButtonColor: "#6b7280",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });

    });
});
</script>

@endsection

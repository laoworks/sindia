@extends('layouts.admin')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- HEADER -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5 mb-8">

        <!-- TITLE -->
        <div>

            <h1
                class="text-3xl font-bold"
                style="color: oklch(45.7% 0.24 277.023)"
            >
                Data Jadwal
            </h1>

            <p class="text-sm text-gray-500 mt-2">
                Kelola jadwal mengajar guru
            </p>

        </div>

        <!-- ACTION -->
        <div class="flex flex-col sm:flex-row gap-3">

            <!-- SEARCH -->
            <form method="GET" class="w-full sm:w-auto">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari guru / kelas / mapel"
                    class="w-full sm:w-72 px-4 py-3 rounded-2xl border border-gray-200 focus:outline-none focus:ring-2 focus:border-transparent transition duration-200"
                    style="--tw-ring-color: oklch(87% 0.065 274.039)"
                >

            </form>

            <!-- BUTTON -->
            <a
                href="{{ route('admin.jadwal.create') }}"
                class="inline-flex items-center justify-center px-5 py-3 rounded-2xl text-sm font-semibold text-white shadow-sm hover:opacity-90 transition duration-200"
                style="background: oklch(45.7% 0.24 277.023)"
            >

                Tambah Jadwal

            </a>

        </div>

    </div>

    <!-- TABLE CARD -->
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">

        <div class="overflow-x-auto">

            <table class="min-w-full">

                <!-- TABLE HEAD -->
                <thead
                    class="border-b border-gray-100"
                    style="background: oklch(97% 0.01 286)"
                >

                    <tr>

                        <th class="px-6 py-5 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            No
                        </th>

                        <th class="px-6 py-5 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Guru
                        </th>

                        <th class="px-6 py-5 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Kelas
                        </th>

                        <th class="px-6 py-5 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Mata Pelajaran
                        </th>

                        <th class="px-6 py-5 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Hari
                        </th>

                        <th class="px-6 py-5 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Jam
                        </th>

                        <th class="px-6 py-5 text-center text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <!-- TABLE BODY -->
                <tbody class="divide-y divide-gray-100 bg-white">

                    @forelse($jadwal as $item)

                        <tr class="hover:bg-gray-50/70 transition duration-200">

                            <!-- NO -->
                            <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-500">

                                {{ $jadwal->firstItem() + $loop->index }}

                            </td>

                            <!-- GURU -->
                            <td class="px-6 py-5 whitespace-nowrap">

                                <div class="font-semibold text-gray-900">

                                    {{ $item->guru?->name ?? '-' }}

                                </div>

                            </td>

                            <!-- KELAS -->
                            <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-600">

                                {{ $item->kelas?->nama_kelas ?? '-' }}

                            </td>

                            <!-- MAPEL -->
                            <td class="px-6 py-5 whitespace-nowrap">

                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-xl text-xs font-semibold"
                                    style="
                                        background: oklch(87% 0.065 274.039);
                                        color: oklch(45.7% 0.24 277.023);
                                    "
                                >

                                    {{ $item->mapel?->nama_mapel ?? '-' }}

                                </span>

                            </td>

                            <!-- HARI -->
                            <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-600">

                                {{ $item->hari }}

                            </td>

                            <!-- JAM -->
                            <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-600">

                                {{ $item->jam_mulai }} - {{ $item->jam_selesai }}

                            </td>

                            <!-- AKSI -->
                            <td class="px-6 py-5">

                                <div class="flex items-center justify-center gap-2">

                                    <!-- VIEW -->
                                    <a
                                        href="{{ route('admin.jadwal.show', $item->id) }}"
                                        class="inline-flex items-center px-4 py-2 rounded-xl text-xs font-semibold text-white bg-blue-500 hover:bg-blue-600 transition duration-200"
                                    >

                                        View

                                    </a>

                                    <!-- EDIT -->
                                    <a
                                        href="{{ route('admin.jadwal.edit', $item->id) }}"
                                        class="inline-flex items-center px-4 py-2 rounded-xl text-xs font-semibold text-white bg-yellow-500 hover:bg-yellow-600 transition duration-200"
                                    >

                                        Edit

                                    </a>

                                    <!-- DELETE -->
                                    <form
                                        id="delete-form-{{ $item->id }}"
                                        action="{{ route('admin.jadwal.destroy', $item->id) }}"
                                        method="POST"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="button"
                                            onclick="confirmDelete({{ $item->id }})"
                                            class="inline-flex items-center px-4 py-2 rounded-xl text-xs font-semibold text-white bg-red-500 hover:bg-red-600 transition duration-200"
                                        >

                                            Delete

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <!-- EMPTY -->
                        <tr>

                            <td colspan="7" class="px-6 py-16 text-center">

                                <div class="flex flex-col items-center justify-center">

                                    <div
                                        class="w-16 h-16 rounded-2xl flex items-center justify-center mb-4"
                                        style="background: oklch(95% 0.02 280)"
                                    >

                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="w-8 h-8"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            style="color: oklch(45.7% 0.24 277.023)"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.5"
                                                d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v10a2 2 0 002 2z"
                                            />
                                        </svg>

                                    </div>

                                    <h3 class="text-sm font-semibold text-gray-700">
                                        Data kosong
                                    </h3>

                                    <p class="text-sm text-gray-500 mt-1">
                                        Belum ada jadwal mengajar tersedia.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    <!-- PAGINATION -->
    <div class="mt-6">

        {{ $jadwal->links() }}

    </div>

</div>

@endsection


@push('scripts')

@if(session('message'))

<script>

    Swal.fire({
        icon: @json(session('icon') ?? 'success'),
        title: @json(session('title') ?? 'Berhasil'),
        text: @json(session('message')),
        confirmButtonColor: '#6d28d9',
    });

</script>

@endif


<script>

function confirmDelete(id)
{
    Swal.fire({

        title: 'Yakin ingin menghapus?',
        text: 'Data jadwal akan dihapus permanen.',
        icon: 'warning',

        showCancelButton: true,

        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#9ca3af',

        confirmButtonText: 'Ya, hapus',
        cancelButtonText: 'Batal',

        reverseButtons: true

    }).then((result) => {

        if (result.isConfirmed) {

            document.getElementById('delete-form-' + id).submit();

        }

    });
}

</script>

@endpush

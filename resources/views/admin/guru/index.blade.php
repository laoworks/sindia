@extends('layouts.admin')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- HEADER -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">

        <div>
            <h1 class="text-3xl font-bold" style="color: oklch(45.7% 0.24 277.023)">
                Data Guru
            </h1>

            <p class="text-gray-500 text-sm mt-2">
                Data guru diambil dari user dengan role guru
            </p>
        </div>

    </div>

    <!-- SEARCH -->
    <div class="mb-6">
        <input
            type="text"
            id="search"
            placeholder="Cari nama, email, NIP..."
            class="w-full lg:w-1/3 px-4 py-3 rounded-2xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-purple-500"
        >
    </div>

    <!-- TABLE -->
    <div class="bg-white border rounded-3xl overflow-hidden">

        <table class="min-w-full">

            <thead style="background: oklch(97% 0.01 286)">
                <tr>
                    <th class="px-6 py-5 text-left">No</th>
                    <th class="px-6 py-5 text-left">Nama</th>
                    <th class="px-6 py-5 text-left">Email</th>
                    <th class="px-6 py-5 text-left">NIP</th>
                    <th class="px-6 py-5 text-left">Status</th>
                    <th class="px-6 py-5 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody id="guru-table">

                @forelse($gurus as $guru)

                <tr class="border-t hover:bg-gray-50/60 transition">

                    <td class="px-6 py-5">
                        {{ $gurus->firstItem() + $loop->index }}
                    </td>

                    <td class="px-6 py-5 font-semibold">
                        {{ $guru->name }}
                    </td>

                    <td class="px-6 py-5">
                        {{ $guru->email }}
                    </td>

                    <td class="px-6 py-5">
                        {{ $guru->nip ?? '-' }}
                    </td>

                    <!-- STATUS BADGE -->
                    <td class="px-6 py-5">

                        @if($guru->is_active)
                            <span class="px-3 py-1 rounded-xl text-xs font-semibold bg-green-100 text-green-700">
                                Aktif
                            </span>
                        @else
                            <span class="px-3 py-1 rounded-xl text-xs font-semibold bg-red-100 text-red-700">
                                Nonaktif
                            </span>
                        @endif

                    </td>

                    <td class="px-6 py-5 text-center">

                        <a href="{{ route('admin.guru.show', $guru->id) }}"
                           class="px-4 py-2 rounded-xl text-xs font-semibold text-white bg-purple-600 hover:bg-purple-700">
                            View
                        </a>

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="6" class="text-center py-10 text-gray-500">
                        Tidak ada data guru
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <!-- PAGINATION -->
    <div class="mt-6">
        {{ $gurus->links() }}
    </div>

</div>

@endsection

@push('scripts')

<script>

let timeout;

document.getElementById('search').addEventListener('keyup', function () {

    clearTimeout(timeout);

    let keyword = this.value;

    timeout = setTimeout(() => {

        fetch(`{{ route('admin.guru.index') }}?search=${keyword}`)
            .then(res => res.text())
            .then(html => {

                let parser = new DOMParser();
                let doc = parser.parseFromString(html, 'text/html');

                document.querySelector('#guru-table').innerHTML =
                    doc.querySelector('#guru-table').innerHTML;

            });

    }, 300);

});

</script>

@endpush

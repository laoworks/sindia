@extends('layouts.admin')

@section('content')
    <div class="mx-auto max-w-7xl">

        <!-- HEADER -->
        <div class="flex flex-col gap-4 mb-6 lg:flex-row lg:items-center lg:justify-between">

            <div>
                <h1 class="text-3xl font-bold" style="color: oklch(45.7% 0.24 277.023)">
                    Data Guru
                </h1>

                <p class="mt-2 text-sm text-gray-500">
                    Data guru diambil dari user dengan role guru
                </p>
            </div>

        </div>

        <!-- SEARCH -->
        <div class="mb-6">
            <input type="text" id="search" value="{{ request('search') }}" placeholder="Cari nama, email, NIP..."
                class="w-full px-4 py-3 border border-gray-200 lg:w-1/3 focus:outline-none focus:ring-2 focus:ring-purple-500">
        </div>

        <!-- TABLE -->
        <div class="overflow-hidden bg-white border">

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
                    @include('admin.guru.partials.table', ['gurus' => $gurus])
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

        document.getElementById('search').addEventListener('keyup', function() {

            clearTimeout(timeout);

            let keyword = this.value;

            timeout = setTimeout(() => {

                fetch(`{{ route('admin.guru.index') }}?search=${encodeURIComponent(keyword)}`)
                    .then(res => res.text())
                    .then(html => {
                        document.querySelector('#guru-table').innerHTML = html;
                    });

            }, 300);

        });
    </script>
@endpush

@extends('layouts.admin')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="bg-white p-8 rounded-3xl border">

        <h2 class="text-2xl font-bold mb-6"
            style="color: oklch(45.7% 0.24 277.023)">
            Edit Mata Pelajaran
        </h2>

        <form action="{{ route('admin.mapel.update', $mapel->id) }}" method="POST">

            @csrf
            @method('PUT')

            <!-- Nama Mapel -->
            <div class="mb-5">
                <label class="text-sm font-semibold text-gray-600">Nama Mapel</label>
                <input type="text" name="nama_mapel"
                       value="{{ $mapel->nama_mapel }}"
                       class="w-full mt-2 px-4 py-3 rounded-2xl border border-gray-200"
                       required>
            </div>

            <!-- KKM -->
            <div class="mb-5">
                <label class="text-sm font-semibold text-gray-600">KKM</label>
                <input type="number" name="kkm"
                       value="{{ $mapel->kkm }}"
                       class="w-full mt-2 px-4 py-3 rounded-2xl border border-gray-200"
                       min="0" max="100"
                       required>
            </div>

            <!-- BUTTON -->
            <div class="flex justify-end gap-3">

                <a href="{{ route('admin.mapel.index') }}"
                   class="px-5 py-3 rounded-2xl bg-gray-200 text-gray-700">
                    Batal
                </a>

                <button type="submit"
                        class="px-5 py-3 rounded-2xl text-white font-semibold"
                        style="background: oklch(45.7% 0.24 277.023)">
                    Update
                </button>

            </div>

        </form>

    </div>

</div>

@endsection

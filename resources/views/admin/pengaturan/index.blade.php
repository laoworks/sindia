@extends('layouts.admin')

@section('content')
    <div class="max-w-4xl mx-auto">

        <h1 class="text-3xl font-bold mb-6">Pengaturan Sistem</h1>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.pengaturan.update') }}">
            @csrf

            <div class="space-y-4">

                <div>
                    <label>Jam Masuk Mulai</label>
                    <input type="time" name="jam_masuk_mulai" value="{{ $settings['jam_masuk_mulai'] ?? '' }}"
                        class="w-full border p-3">
                </div>

                <div>
                    <label>Jam Masuk Akhir</label>
                    <input type="time" name="jam_masuk_akhir" value="{{ $settings['jam_masuk_akhir'] ?? '' }}"
                        class="w-full border p-3">
                </div>

                <div>
                    <label>Jam Pulang Mulai</label>
                    <input type="time" name="jam_pulang_mulai" value="{{ $settings['jam_pulang_mulai'] ?? '' }}"
                        class="w-full border p-3">
                </div>

                <div>
                    <label>Jam Pulang Akhir</label>
                    <input type="time" name="jam_pulang_akhir" value="{{ $settings['jam_pulang_akhir'] ?? '' }}"
                        class="w-full border p-3">
                </div>

                <button class="bg-purple-600 text-white px-6 py-3">
                    Simpan Pengaturan
                </button>

            </div>
        </form>

    </div>
@endsection

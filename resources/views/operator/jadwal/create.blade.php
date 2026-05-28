@extends('layouts.operator')

@section('content')

<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow">

    <h1 class="text-2xl font-bold mb-6">Tambah Jadwal</h1>

    <form method="POST" action="{{ route('operator.jadwal.store') }}">

        @csrf

        <select name="guru_id" class="w-full border p-2 mb-3">
            @foreach($guru as $g)
                <option value="{{ $g->id }}">{{ $g->name }}</option>
            @endforeach
        </select>

        <select name="kelas_id" class="w-full border p-2 mb-3">
            @foreach($kelas as $k)
                <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
            @endforeach
        </select>

        <select name="mapel_id" class="w-full border p-2 mb-3">
            @foreach($mapel as $m)
                <option value="{{ $m->id }}">{{ $m->nama_mapel }}</option>
            @endforeach
        </select>

        <select name="hari" class="w-full border p-2 mb-3">
            <option>Senin</option>
            <option>Selasa</option>
            <option>Rabu</option>
            <option>Kamis</option>
            <option>Jumat</option>
            <option>Sabtu</option>
        </select>

        <input type="time" name="jam_mulai" class="w-full border p-2 mb-3">

        <input type="time" name="jam_selesai" class="w-full border p-2 mb-3">

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Simpan
        </button>

    </form>

</div>

@endsection

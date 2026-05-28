@extends('layouts.operator')

@section('content')

<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">

    <h1 class="text-2xl font-bold mb-6">Tambah Mata Pelajaran</h1>

    <form action="{{ route('operator.mapel.store') }}" method="POST">

        @csrf

        <input type="text"
               name="nama_mapel"
               placeholder="Nama Mapel"
               class="w-full border p-2 mb-3 rounded">

        <input type="number"
               name="kkm"
               placeholder="KKM"
               class="w-full border p-2 mb-3 rounded">

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Simpan
        </button>

    </form>

</div>

@endsection

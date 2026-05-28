@extends('layouts.operator')

@section('content')

<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">

    <h1 class="text-2xl font-bold mb-6">Edit Mata Pelajaran</h1>

    <form action="{{ route('operator.mapel.update', $mapel->id) }}" method="POST">

        @csrf
        @method('PUT')

        <input type="text"
               name="nama_mapel"
               value="{{ $mapel->nama_mapel }}"
               class="w-full border p-2 mb-3 rounded">

        <input type="number"
               name="kkm"
               value="{{ $mapel->kkm }}"
               class="w-full border p-2 mb-3 rounded">

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Update
        </button>

    </form>

</div>

@endsection

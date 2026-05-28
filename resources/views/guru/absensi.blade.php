@extends('layouts.guru')

@section('content')

<div class="space-y-6">

    <h1 class="text-3xl font-bold">Absensi Guru (Selfie)</h1>
    <p class="text-gray-500">Wajib selfie saat absen</p>

    @if($absensi && $absensi->waktu_masuk && $absensi->waktu_pulang)
        <div class="p-4 bg-green-100 text-green-700 rounded-xl">
            Anda sudah melakukan semua absensi hari ini
        </div>
    @endif

    <!-- CAMERA -->
    <div class="bg-white p-6 rounded-2xl shadow space-y-4">

        <video id="video" autoplay class="w-full rounded-xl border"></video>
        <canvas id="canvas" class="hidden"></canvas>

        <button onclick="startCamera()"
                class="px-4 py-2 bg-gray-800 text-white rounded-xl">
            Aktifkan Kamera
        </button>

    </div>

    <!-- BUTTON ABSEN -->
    <div class="flex gap-3">

        {{-- MASUK --}}
        <form method="POST" action="{{ route('guru.absensi.masuk') }}" onsubmit="return capturePhoto(this)">
            @csrf
            <input type="hidden" name="foto" id="foto_masuk">

            <button
                @if($absensi && $absensi->waktu_masuk) disabled @endif
                class="px-5 py-3 bg-green-600 text-white rounded-xl disabled:opacity-50">
                Absen Masuk
            </button>
        </form>

        {{-- PULANG --}}
        <form method="POST" action="{{ route('guru.absensi.pulang') }}" onsubmit="return capturePhoto(this)">
            @csrf
            <input type="hidden" name="foto" id="foto_pulang">

            <button
                @if(!$absensi || $absensi->waktu_pulang) disabled @endif
                class="px-5 py-3 bg-blue-600 text-white rounded-xl disabled:opacity-50">
                Absen Pulang
            </button>
        </form>

    </div>

</div>

{{-- SWEETALERT --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
let video = document.getElementById('video');
let canvas = document.getElementById('canvas');
let stream;

function startCamera() {
    navigator.mediaDevices.getUserMedia({ video: true })
        .then(s => {
            stream = s;
            video.srcObject = stream;
        })
        .catch(err => {
            Swal.fire('Error', 'Kamera tidak bisa diakses', 'error');
        });
}

function capturePhoto(form) {

    if (!stream) {
        Swal.fire('Peringatan', 'Aktifkan kamera dulu', 'warning');
        return false;
    }

    let ctx = canvas.getContext('2d');
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;

    ctx.drawImage(video, 0, 0);

    let dataURL = canvas.toDataURL('image/png');

    if (form.querySelector('#foto_masuk')) {
        form.querySelector('#foto_masuk').value = dataURL;
    }

    if (form.querySelector('#foto_pulang')) {
        form.querySelector('#foto_pulang').value = dataURL;
    }

    return true;
}
</script>

{{-- FLASH MESSAGE SWEETALERT --}}
@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil',
    text: "{{ session('success') }}"
});
</script>
@endif

@if(session('error'))
<script>
Swal.fire({
    icon: 'error',
    title: 'Gagal',
    text: "{{ session('error') }}"
});
</script>
@endif

@endsection

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaturan', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->enum('tipe', [
                'text',
                'number',
                'time',
                'boolean',
                'json'
            ])->default('text');
            $table->text('description')->nullable();
            $table->string('group')->default('general')->index();
            $table->timestamps();

            $table->index('key');
        });

        $defaultSettings = [
            [
                'key' => 'jam_masuk_mulai',
                'value' => '06:00',
                'tipe' => 'time',
                'description' => 'Jam mulai absen masuk (boleh melakukan absensi)',
                'group' => 'waktu'
            ],
            [
                'key' => 'jam_masuk_akhir',
                'value' => '08:00',
                'tipe' => 'time',
                'description' => 'Jam terakhir absen masuk (setelah ini tidak bisa absen)',
                'group' => 'waktu'
            ],
            [
                'key' => 'jam_pulang_mulai',
                'value' => '14:00',
                'tipe' => 'time',
                'description' => 'Jam mulai absen pulang (boleh melakukan absensi)',
                'group' => 'waktu'
            ],
            [
                'key' => 'jam_pulang_akhir',
                'value' => '17:00',
                'tipe' => 'time',
                'description' => 'Jam terakhir absen pulang (setelah ini tidak bisa absen)',
                'group' => 'waktu'
            ],
            [
                'key' => 'batas_tepat_waktu_masuk',
                'value' => '07:00',
                'tipe' => 'time',
                'description' => 'Batas waktu masuk dianggap tepat waktu (sebelum jam ini)',
                'group' => 'batas_waktu'
            ],
            [
                'key' => 'batas_tepat_waktu_pulang',
                'value' => '15:00',
                'tipe' => 'time',
                'description' => 'Batas waktu pulang dianggap tepat waktu (setelah jam ini)',
                'group' => 'batas_waktu'
            ],
            [
                'key' => 'toleransi_keterlambatan',
                'value' => '15',
                'tipe' => 'number',
                'description' => 'Toleransi keterlambatan dalam menit (masih dianggap tepat waktu)',
                'group' => 'toleransi'
            ],
            [
                'key' => 'toleransi_pulang_awal',
                'value' => '15',
                'tipe' => 'number',
                'description' => 'Toleransi pulang lebih awal dalam menit (masih dianggap tepat waktu)',
                'group' => 'toleransi'
            ],
            [
                'key' => 'wajib_foto_masuk',
                'value' => 'true',
                'tipe' => 'boolean',
                'description' => 'Wajib mengambil foto saat absen masuk',
                'group' => 'kamera'
            ],
            [
                'key' => 'wajib_foto_pulang',
                'value' => 'true',
                'tipe' => 'boolean',
                'description' => 'Wajib mengambil foto saat absen pulang',
                'group' => 'kamera'
            ],
            [
                'key' => 'kualitas_foto',
                'value' => '70',
                'tipe' => 'number',
                'description' => 'Kualitas foto yang disimpan (1-100)',
                'group' => 'kamera'
            ],
            [
                'key' => 'nama_sekolah',
                'value' => 'SMA Negeri 1 Contoh',
                'tipe' => 'text',
                'description' => 'Nama sekolah untuk ditampilkan di laporan',
                'group' => 'umum'
            ],
            [
                'key' => 'alamat_sekolah',
                'value' => 'Jl. Pendidikan No. 123, Kota Contoh',
                'tipe' => 'text',
                'description' => 'Alamat sekolah untuk ditampilkan di laporan',
                'group' => 'umum'
            ],
        ];

        DB::table('pengaturan')->insert($defaultSettings);
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaturan');
    }
};

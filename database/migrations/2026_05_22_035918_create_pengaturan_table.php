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
            $table->string('tipe')->default('text');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Insert default settings
        DB::table('pengaturan')->insert([
            ['key' => 'jam_masuk_mulai', 'value' => '06:00', 'tipe' => 'time', 'description' => 'Jam mulai absen masuk'],
            ['key' => 'jam_masuk_akhir', 'value' => '09:00', 'tipe' => 'time', 'description' => 'Jam terakhir absen masuk'],
            ['key' => 'jam_pulang_mulai', 'value' => '13:00', 'tipe' => 'time', 'description' => 'Jam mulai absen pulang'],
            ['key' => 'jam_pulang_akhir', 'value' => '16:00', 'tipe' => 'time', 'description' => 'Jam terakhir absen pulang'],
            ['key' => 'batas_tepat_waktu_masuk', 'value' => '07:00', 'tipe' => 'time', 'description' => 'Batas tepat waktu absen masuk'],
            ['key' => 'batas_tepat_waktu_pulang', 'value' => '14:00', 'tipe' => 'time', 'description' => 'Batas tepat waktu absen pulang'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaturan');
    }
};

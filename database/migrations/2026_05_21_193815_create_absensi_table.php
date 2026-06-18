<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('jadwal_id')
                ->constrained('jadwal')
                ->cascadeOnDelete();

            $table->date('tanggal');

            $table->time('waktu_masuk')->nullable();
            $table->time('waktu_pulang')->nullable();

            $table->string('foto_masuk')->nullable();
            $table->string('foto_pulang')->nullable();

            $table->enum('status_masuk', [
                'tepat_waktu',
                'terlambat'
            ])->nullable();

            $table->enum('status_pulang', [
                'tepat_waktu',
                'lebih_awal'
            ])->nullable();

            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();

            $table->timestamps();

            $table->index('tanggal');
            $table->index(['user_id', 'tanggal']);
            $table->index(['jadwal_id', 'tanggal']);
            $table->index('status_masuk');
            $table->index('status_pulang');

            $table->unique(['user_id', 'jadwal_id', 'tanggal'], 'unique_absensi_harian');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};

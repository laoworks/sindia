<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mata_pelajaran', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mapel');
            $table->integer('kkm')->default(75);
            $table->timestamps();

            $table->index('nama_mapel');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mata_pelajaran');
    }
};

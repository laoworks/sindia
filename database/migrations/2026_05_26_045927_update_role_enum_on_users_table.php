<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            // Update enum role
            $table->enum('role', [
                'admin',
                'guru',
                'kepala_sekolah',
                'operator',
                'waka_kurikulum'
            ])->default('guru')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            // Rollback ke enum lama
            $table->enum('role', [
                'admin',
                'guru'
            ])->default('guru')->change();
        });
    }
};

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
        Schema::create('ambil_nilai', function (Blueprint $table) {
            $table->id();
            $table->integer("siswa_id");
            $table->integer("guru_id");
            $table->integer("kelompok_penilaian_id");
            $table->integer("hafalan_id");
            $table->integer("tahun_ajaran_id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ambil_nilai');
    }
};

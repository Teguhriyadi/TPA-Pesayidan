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
        Schema::create('kelompok_penilaian', function (Blueprint $table) {
            $table->id();
            $table->string("kelompok");
            $table->string("slug");
            $table->enum("kategori", ["Pelajaran", "Ujian"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelompok_penilaian');
    }
};

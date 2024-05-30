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
        Schema::create('kelas_pelajaran', function (Blueprint $table) {
            $table->id();
            $table->integer("tahun_ajaran_id");
            $table->integer("pelajaran_id");
            $table->integer("kelas_id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas_pelajaran');
    }
};

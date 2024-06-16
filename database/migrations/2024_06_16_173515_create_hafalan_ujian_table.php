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
        Schema::create('hafalan_ujian', function (Blueprint $table) {
            $table->id();
            $table->integer("kelompokPenilaianId");
            $table->integer("materiId");
            $table->dateTime("tanggal");
            $table->integer("siswaId");
            $table->integer("guruId");
            $table->enum("penilaian", ["Sangat Baik", "Baik", "Cukup", "Kurang", "Sangat Kurang"]);
            $table->text("keterangan")->nullable();
            $table->integer("tahunAjaranId");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hafalan_ujian');
    }
};

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
        Schema::create('hafalan', function (Blueprint $table) {
            $table->id();
            $table->integer("materiId")->nullable();
            $table->integer("jilidSurat")->nullable();
            $table->integer("halAyat")->nullable();
            $table->dateTime("tanggal");
            $table->integer("siswaId");
            $table->integer("guruId");
            $table->string("penilaian");
            $table->integer("tahunAjaranId");
            $table->enum("kategori", ["HAFALAN", "UJIAN"]);
            $table->text("keterangan")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hafalan_harian');
    }
};

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
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string("nama", 150);
            $table->enum("jenisKelamin", ["L", "P"]);
            $table->string("tempatLahir", 100);
            $table->date("tanggalLahir");
            $table->text("alamat");
            $table->string("foto")->nullable();
            $table->integer("pendaftarId");
            $table->integer("kelasId")->nullable();
            $table->integer("waliId")->nullable();
            $table->string("nomorHpAktif")->nullable();
            $table->enum("aktif", [1, 0])->default(1);
            $table->dateTime("tanggalDaftar");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};

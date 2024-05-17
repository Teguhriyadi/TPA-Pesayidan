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
        Schema::create('profil_madrasah', function (Blueprint $table) {
            $table->id();
            $table->string("nama_mdta", 100);
            $table->string("no_statistik", 100);
            $table->text("alamat");
            $table->string("kecamatan", 100);
            $table->string("kabupaten_kota", 100);
            $table->string("provinsi", 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_madrasah');
    }
};

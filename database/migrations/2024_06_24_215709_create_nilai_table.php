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
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();
            $table->integer("guru_id");
            $table->integer("jadwal_id");
            $table->integer("siswa_id");
            $table->decimal("nilai", 10, 1);
            $table->integer("pertemuan");
            $table->integer("tahun_ajaran_id");
            $table->dateTime("tanggal");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai');
    }
};

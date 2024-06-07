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
        Schema::create('siswa_jenjang', function (Blueprint $table) {
            $table->id();
            $table->integer("siswaId");
            $table->integer("kelasId");
            $table->integer("tahunAjaranId");
            $table->enum("status", ["1", "0"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa_jenjang');
    }
};

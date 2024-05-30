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
        Schema::create('pelajaran', function (Blueprint $table) {
            $table->id();
            $table->string("kode", 50)->unique();
            $table->string("nama", 100);
            $table->enum("kategori", ["Pelajaran", "Hafalan"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelajaran');
    }
};

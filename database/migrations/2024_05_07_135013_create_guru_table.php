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
        Schema::create('guru', function (Blueprint $table) {
            $table->id();
            $table->integer("userId");
            $table->string("nip", 100);
            $table->enum("jenisKelamin", ["L", "P"]);
            $table->string("tempatLahir", 100)->nullable();
            $table->date("tanggalLahir")->nullable();
            $table->text("alamat");
            $table->integer("validasiId");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guru');
    }
};

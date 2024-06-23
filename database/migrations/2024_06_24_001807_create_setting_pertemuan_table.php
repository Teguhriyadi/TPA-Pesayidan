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
        Schema::create('setting_pertemuan', function (Blueprint $table) {
            $table->id();
            $table->integer("tahunAjaranId");
            $table->tinyInteger("jumlah");
            $table->enum("status", [1, 0]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setting_pertemuan');
    }
};

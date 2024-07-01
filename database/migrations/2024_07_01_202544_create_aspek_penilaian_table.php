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
        Schema::create('aspek_penilaian', function (Blueprint $table) {
            $table->id();
            $table->integer("rapot_id");
            $table->string("sikap", 10);
            $table->string("kerajinan", 10);
            $table->string("kebersihan", 10);
            $table->string("kerapihan", 10);
            $table->string("eskul", 10);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aspek_penilaian');
    }
};

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
        Schema::create('rapot_detail', function (Blueprint $table) {
            $table->id();
            $table->integer("rapot_id");
            $table->integer("kelompok_rapot_id");
            $table->string("nilai");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rapot_detail');
    }
};

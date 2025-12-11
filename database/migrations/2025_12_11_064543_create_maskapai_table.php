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
        Schema::create('maskapai', function (Blueprint $table) {
            $table->integer('maskapai_id', true);
            $table->string('kode_maskapai', 10)->nullable();
            $table->string('nama_maskapai', 100)->nullable();
            $table->string('logo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maskapai');
    }
};

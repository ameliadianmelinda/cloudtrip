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
        Schema::create('bandara', function (Blueprint $table) {
            $table->integer('bandara_id', true);
            $table->string('kode_bandara', 10)->nullable();
            $table->string('nama_bandara', 100)->nullable();
            $table->string('kota', 100)->nullable();
            $table->string('negara', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bandara');
    }
};

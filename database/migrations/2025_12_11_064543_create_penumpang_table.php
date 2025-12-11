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
        Schema::create('penumpang', function (Blueprint $table) {
            $table->integer('penumpang_id', true);
            $table->string('nama_penumpang', 100)->nullable();
            $table->string('nik', 20)->nullable();
            $table->integer('umur')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penumpang');
    }
};

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
        Schema::create('jadwal_penerbangan', function (Blueprint $table) {
            $table->integer('jadwal_id', true);
            $table->integer('pesawat_id')->nullable()->index('pesawat_id');
            $table->integer('bandara_asal')->nullable()->index('bandara_asal');
            $table->integer('bandara_tujuan')->nullable()->index('bandara_tujuan');
            $table->date('tanggal_berangkat')->nullable();
            $table->time('waktu_berangkat')->nullable();
            $table->time('waktu_tiba')->nullable();
            $table->decimal('harga', 12)->nullable();
            $table->enum('status', ['available', 'cancel', 'delay'])->nullable()->default('available');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_penerbangan');
    }
};

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
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->integer('pemesanan_id', true);
            $table->string('kode_pemesanan', 30)->nullable();
            $table->unsignedBigInteger('user_id')->nullable()->index('user_id');
            $table->integer('jadwal_id')->nullable()->index('jadwal_id');
            $table->dateTime('tanggal_pesan')->nullable()->useCurrent();
            $table->decimal('total_harga', 12)->nullable();
            $table->enum('status', ['pending', 'paid', 'cancel'])->nullable()->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan');
    }
};

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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->integer('pembayaran_id', true);
            $table->integer('pemesanan_id')->nullable()->index('pemesanan_id');
            $table->enum('metode', ['transfer', 'qris', 'va'])->nullable();
            $table->decimal('jumlah', 12)->nullable();
            $table->enum('status', ['pending', 'success', 'failed'])->nullable()->default('pending');
            $table->dateTime('tanggal_bayar')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};

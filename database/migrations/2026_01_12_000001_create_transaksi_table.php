<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->integer('pemesanan_id')->index();
            $table->integer('pembayaran_id')->index();
            $table->decimal('jumlah', 15, 2);
            $table->string('metode');
            $table->string('status');
            $table->timestamp('tanggal_transaksi')->useCurrent();
            $table->timestamps();

            $table->foreign('pemesanan_id')->references('pemesanan_id')->on('pemesanan')->onDelete('cascade');
            $table->foreign('pembayaran_id')->references('pembayaran_id')->on('pembayaran')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};

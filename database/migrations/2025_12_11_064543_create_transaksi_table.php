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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pemesanan_id')->unsigned();
            $table->bigInteger('pembayaran_id')->unsigned();
            $table->decimal('jumlah', 15, 2);
            $table->string('metode', 255);
            $table->string('status', 255);
            $table->timestamp('tanggal_transaksi')->useCurrent();
            $table->timestamps();

            $table->foreign('pemesanan_id')->references('pemesanan_id')->on('pemesanan')->onDelete('cascade');
            $table->foreign('pembayaran_id')->references('pembayaran_id')->on('pembayaran')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};

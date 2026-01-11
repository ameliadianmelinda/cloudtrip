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
        // Safely add all foreign keys
        try {
            Schema::table('pemesanan', function (Blueprint $table) {
                $table->foreign(['user_id'], 'pemesanan_ibfk_1')->references(['id'])->on('users')->onUpdate('no action')->onDelete('no action');
                $table->foreign(['jadwal_id'], 'pemesanan_ibfk_2')->references(['jadwal_id'])->on('jadwal_penerbangan')->onUpdate('no action')->onDelete('no action');
            });
        } catch (\Exception $e) {}

        try {
            Schema::table('pembayaran', function (Blueprint $table) {
                $table->foreign(['pemesanan_id'], 'pembayaran_ibfk_1')->references(['pemesanan_id'])->on('pemesanan')->onUpdate('no action')->onDelete('no action');
            });
        } catch (\Exception $e) {}

        try {
            Schema::table('detail_pemesanan', function (Blueprint $table) {
                $table->foreign(['pemesanan_id'], 'detail_pemesanan_ibfk_1')->references(['pemesanan_id'])->on('pemesanan')->onUpdate('no action')->onDelete('no action');
                $table->foreign(['penumpang_id'], 'detail_pemesanan_ibfk_2')->references(['penumpang_id'])->on('penumpang')->onUpdate('no action')->onDelete('no action');
            });
        } catch (\Exception $e) {}

        try {
            Schema::table('pesawat', function (Blueprint $table) {
                $table->foreign(['maskapai_id'], 'pesawat_ibfk_1')->references(['maskapai_id'])->on('maskapai')->onUpdate('no action')->onDelete('no action');
            });
        } catch (\Exception $e) {}

        try {
            Schema::table('jadwal_penerbangan', function (Blueprint $table) {
                $table->foreign(['pesawat_id'], 'jadwal_penerbangan_ibfk_1')->references(['pesawat_id'])->on('pesawat')->onUpdate('no action')->onDelete('no action');
                $table->foreign(['bandara_asal'], 'jadwal_penerbangan_ibfk_2')->references(['bandara_id'])->on('bandara')->onUpdate('no action')->onDelete('no action');
                $table->foreign(['bandara_tujuan'], 'jadwal_penerbangan_ibfk_3')->references(['bandara_id'])->on('bandara')->onUpdate('no action')->onDelete('no action');
                $table->foreign(['maskapai_id'], 'jadwal_penerbangan_ibfk_4')->references(['maskapai_id'])->on('maskapai')->onUpdate('no action')->onDelete('no action');
            });
        } catch (\Exception $e) {}
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        try {
            Schema::table('pemesanan', function (Blueprint $table) {
                $table->dropForeignIfExists('pemesanan_ibfk_1');
                $table->dropForeignIfExists('pemesanan_ibfk_2');
            });
        } catch (\Exception $e) {}

        try {
            Schema::table('pembayaran', function (Blueprint $table) {
                $table->dropForeignIfExists('pembayaran_ibfk_1');
            });
        } catch (\Exception $e) {}

        try {
            Schema::table('detail_pemesanan', function (Blueprint $table) {
                $table->dropForeignIfExists('detail_pemesanan_ibfk_1');
                $table->dropForeignIfExists('detail_pemesanan_ibfk_2');
            });
        } catch (\Exception $e) {}

        try {
            Schema::table('pesawat', function (Blueprint $table) {
                $table->dropForeignIfExists('pesawat_ibfk_1');
            });
        } catch (\Exception $e) {}

        try {
            Schema::table('jadwal_penerbangan', function (Blueprint $table) {
                $table->dropForeignIfExists('jadwal_penerbangan_ibfk_1');
                $table->dropForeignIfExists('jadwal_penerbangan_ibfk_2');
                $table->dropForeignIfExists('jadwal_penerbangan_ibfk_3');
                $table->dropForeignIfExists('jadwal_penerbangan_ibfk_4');
            });
        } catch (\Exception $e) {}
    }
};

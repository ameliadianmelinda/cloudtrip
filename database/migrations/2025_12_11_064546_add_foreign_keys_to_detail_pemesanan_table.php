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
        Schema::table('detail_pemesanan', function (Blueprint $table) {
            $table->foreign(['pemesanan_id'], 'detail_pemesanan_ibfk_1')->references(['pemesanan_id'])->on('pemesanan')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['penumpang_id'], 'detail_pemesanan_ibfk_2')->references(['penumpang_id'])->on('penumpang')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_pemesanan', function (Blueprint $table) {
            $table->dropForeign('detail_pemesanan_ibfk_1');
            $table->dropForeign('detail_pemesanan_ibfk_2');
        });
    }
};

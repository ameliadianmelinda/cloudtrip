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
        try {
            Schema::table('pemesanan', function (Blueprint $table) {
                $table->foreign(['user_id'], 'pemesanan_ibfk_1')->references(['id'])->on('users')->onUpdate('no action')->onDelete('no action');
                $table->foreign(['jadwal_id'], 'pemesanan_ibfk_2')->references(['jadwal_id'])->on('jadwal_penerbangan')->onUpdate('no action')->onDelete('no action');
            });
        } catch (\Exception $e) {
            // Skip if already added
        }
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
        } catch (\Exception $e) {
            // Skip if already dropped
        }
    }
};

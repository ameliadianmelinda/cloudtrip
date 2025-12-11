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
        Schema::table('jadwal_penerbangan', function (Blueprint $table) {
            $table->foreign(['pesawat_id'], 'jadwal_penerbangan_ibfk_1')->references(['pesawat_id'])->on('pesawat')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['bandara_asal'], 'jadwal_penerbangan_ibfk_2')->references(['bandara_id'])->on('bandara')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['bandara_tujuan'], 'jadwal_penerbangan_ibfk_3')->references(['bandara_id'])->on('bandara')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwal_penerbangan', function (Blueprint $table) {
            $table->dropForeign('jadwal_penerbangan_ibfk_1');
            $table->dropForeign('jadwal_penerbangan_ibfk_2');
            $table->dropForeign('jadwal_penerbangan_ibfk_3');
        });
    }
};

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
        Schema::table('pesawat', function (Blueprint $table) {
            $table->foreign(['maskapai_id'], 'pesawat_ibfk_1')->references(['maskapai_id'])->on('maskapai')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pesawat', function (Blueprint $table) {
            $table->dropForeign('pesawat_ibfk_1');
        });
    }
};

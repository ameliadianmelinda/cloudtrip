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
        Schema::create('pesawat', function (Blueprint $table) {
            $table->integer('pesawat_id', true);
            $table->integer('maskapai_id')->nullable()->index('maskapai_id');
            $table->string('kode_pesawat', 20)->nullable();
            $table->string('tipe_pesawat', 100)->nullable();
            $table->integer('kapasitas')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesawat');
    }
};

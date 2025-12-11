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
        Schema::create('customer_detail', function (Blueprint $table) {
            $table->integer('cust_id', true);
            $table->integer('user_id')->nullable()->index('user_id');
            $table->string('nik', 20)->nullable();
            $table->string('alamat', 150)->nullable();
            $table->string('no_hp', 20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_detail');
    }
};

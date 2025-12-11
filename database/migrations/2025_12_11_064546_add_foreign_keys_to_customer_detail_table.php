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
        Schema::table('customer_detail', function (Blueprint $table) {
            $table->foreign(['user_id'], 'customer_detail_ibfk_1')->references(['user_id'])->on('users')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_detail', function (Blueprint $table) {
            $table->dropForeign('customer_detail_ibfk_1');
        });
    }
};

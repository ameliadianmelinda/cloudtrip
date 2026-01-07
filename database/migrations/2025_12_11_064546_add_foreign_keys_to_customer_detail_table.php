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
            Schema::table('customer_detail', function (Blueprint $table) {
                $table->foreign(['user_id'], 'customer_detail_ibfk_1')->references(['id'])->on('users')->onUpdate('no action')->onDelete('no action');
            });
        } catch (\Exception $e) {
            // Skip if foreign key already exists or table issue
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        try {
            Schema::table('customer_detail', function (Blueprint $table) {
                $table->dropForeignIfExists('customer_detail_ibfk_1');
            });
        } catch (\Exception $e) {
            // Ignore drop errors
        }
    }
};

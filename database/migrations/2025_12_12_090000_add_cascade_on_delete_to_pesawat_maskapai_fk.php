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
            // drop existing foreign if any, then add cascade
            try {
                $table->dropForeign('pesawat_ibfk_1');
            } catch (\Exception $e) {
                try {
                    $table->dropForeign(['maskapai_id']);
                } catch (\Exception $e) {
                    // ignore if constraint does not exist
                }
            }

            $table->foreign('maskapai_id')
                ->references('maskapai_id')
                ->on('maskapai')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pesawat', function (Blueprint $table) {
            try {
                $table->dropForeign('pesawat_ibfk_1');
            } catch (\Exception $e) {
                try {
                    $table->dropForeign(['maskapai_id']);
                } catch (\Exception $e) {
                }
            }

            $table->foreign('maskapai_id')
                ->references('maskapai_id')
                ->on('maskapai');
        });
    }
};

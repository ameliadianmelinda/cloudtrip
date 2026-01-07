<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS batalkanPemesanan");
        DB::unprepared("CREATE DEFINER=`root`@`localhost` PROCEDURE `batalkanPemesanan`(IN `p_id` INT)
BEGIN
    UPDATE pemesanan SET status='cancel' WHERE pemesanan_id = p_id;
    DELETE FROM detail_pemesanan WHERE pemesanan_id = p_id;
END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS batalkanPemesanan");
    }
};

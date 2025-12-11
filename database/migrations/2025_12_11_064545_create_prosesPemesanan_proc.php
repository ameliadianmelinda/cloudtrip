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
        DB::unprepared("CREATE DEFINER=`root`@`localhost` PROCEDURE `prosesPemesanan`(IN `u_id` INT, IN `j_id` INT, IN `jml` INT)
BEGIN
    DECLARE total DECIMAL(12,2);
    SET total = hitungTotalHarga(j_id, jml);
    INSERT INTO pemesanan (kode_pemesanan, user_id, jadwal_id, total_harga, status)
    VALUES (generateKodePemesanan(), u_id, j_id, total, 'pending');
END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS prosesPemesanan");
    }
};

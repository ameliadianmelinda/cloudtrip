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
        DB::statement("CREATE VIEW `view_pemesanan_customer` AS select `p`.`pemesanan_id` AS `pemesanan_id`,`p`.`kode_pemesanan` AS `kode_pemesanan`,`u`.`name` AS `customer`,`jp`.`tanggal_berangkat` AS `tanggal_berangkat`,`p`.`total_harga` AS `total_harga`,`p`.`status` AS `status` from ((`cloudtrip`.`pemesanan` `p` join `cloudtrip`.`users` `u` on((`p`.`user_id` = `u`.`id`))) join `cloudtrip`.`jadwal_penerbangan` `jp` on((`p`.`jadwal_id` = `jp`.`jadwal_id`)))");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS `view_pemesanan_customer`");
    }
};

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
        DB::statement("CREATE VIEW `view_jadwal_lengkap` AS select `jp`.`jadwal_id` AS `jadwal_id`,`mk`.`nama_maskapai` AS `nama_maskapai`,`ps`.`kode_pesawat` AS `kode_pesawat`,`b1`.`nama_bandara` AS `asal`,`b2`.`nama_bandara` AS `tujuan`,`jp`.`tanggal_berangkat` AS `tanggal_berangkat`,`jp`.`waktu_berangkat` AS `waktu_berangkat`,`jp`.`waktu_tiba` AS `waktu_tiba`,`jp`.`harga` AS `harga`,`jp`.`status` AS `status` from ((((`cloudtrip`.`jadwal_penerbangan` `jp` join `cloudtrip`.`pesawat` `ps` on((`jp`.`pesawat_id` = `ps`.`pesawat_id`))) join `cloudtrip`.`maskapai` `mk` on((`ps`.`maskapai_id` = `mk`.`maskapai_id`))) join `cloudtrip`.`bandara` `b1` on((`jp`.`bandara_asal` = `b1`.`bandara_id`))) join `cloudtrip`.`bandara` `b2` on((`jp`.`bandara_tujuan` = `b2`.`bandara_id`)))");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS `view_jadwal_lengkap`");
    }
};

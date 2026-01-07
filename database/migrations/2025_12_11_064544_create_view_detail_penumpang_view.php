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
        DB::statement("CREATE OR REPLACE VIEW `view_detail_penumpang` AS select `d`.`detail_id` AS `detail_id`,`p`.`kode_pemesanan` AS `kode_pemesanan`,`pn`.`nama_penumpang` AS `nama_penumpang`,`pn`.`nik` AS `nik` from ((`cloudtrip`.`detail_pemesanan` `d` join `cloudtrip`.`pemesanan` `p` on((`d`.`pemesanan_id` = `p`.`pemesanan_id`))) join `cloudtrip`.`penumpang` `pn` on((`d`.`penumpang_id` = `pn`.`penumpang_id`)))");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS `view_detail_penumpang`");
    }
};

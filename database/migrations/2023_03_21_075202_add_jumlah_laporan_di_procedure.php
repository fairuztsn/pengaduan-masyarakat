<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::unprepared(<<<SQL
        DROP FUNCTION `jumlahLaporanDi`; CREATE DEFINER=`root`@`localhost` FUNCTION `jumlahLaporanDi`(`bulan` INT(11), `tahun` INT(11)) RETURNS VARCHAR(100) CHARSET utf8mb4 NOT DETERMINISTIC CONTAINS SQL SQL SECURITY DEFINER BEGIN DECLARE jumlah INT; IF(bulan > 0 AND bulan < 13) THEN IF(bulan < 10) THEN SELECT count(id) INTO jumlah FROM laporan WHERE laporan.created_at BETWEEN CONCAT(tahun, "-0", bulan, "-01") AND LAST_DAY(CONCAT(tahun, "-0", bulan, "-01")) AND laporan.deleted_at IS NULL; ELSE SELECT count(id) INTO jumlah FROM laporan WHERE laporan.created_at BETWEEN CONCAT(tahun, "-", bulan, "-01") AND LAST_DAY(CONCAT(tahun, "-", bulan, "-01")) AND laporan.deleted_at IS NULL; END IF; RETURN CONCAT(jumlah); ELSE RETURN "Invalid month"; END IF; END 
        SQL);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};

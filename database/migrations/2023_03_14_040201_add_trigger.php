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
        CREATE TRIGGER `delete_tanggapan` BEFORE DELETE ON `tanggapan` FOR EACH ROW DELETE FROM tanggapan WHERE tanggapan.id_laporan=OLD.id 
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

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
        CREATE PROCEDURE `UserWhereId`(IN `id` INT) NOT DETERMINISTIC CONTAINS SQL SQL SECURITY DEFINER SELECT * FROM users WHERE users.id=id LIMIT 1 
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

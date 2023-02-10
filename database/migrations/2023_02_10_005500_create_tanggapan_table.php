<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('tanggapan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_pengaduan");
            $table->date("tanggal_tanggapan");
            $table->text("tanggapan");
            $table->unsignedBigInteger("id_petugas");
            $table->timestamps();

            $table->foreign('id_pengaduan')->references('id')->on('pengaduan')->onDelete('cascade');
            $table->foreign('id_petugas')->references('id')->on('petugas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tanggapan');
    }
};

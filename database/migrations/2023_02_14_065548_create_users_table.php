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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->char("nik", $length=16)->unique();
            $table->string("email")->unique();
            $table->string('nama');
            $table->string('username')->unique();
            $table->string('password');
            $table->unsignedBigInteger("role_id")->default(1);

            $table->timestamp("updated_at")->nullable();
            $table->timestamp("created_at")->nullable();

            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};

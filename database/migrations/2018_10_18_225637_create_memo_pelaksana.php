<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemoPelaksana extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memo_pelaksana', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_memo')->unsigned();
            $table->foreign('id_memo')->on('memo')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('id_karyawan')->unsigned();
            $table->foreign('id_karyawan')->on('karyawan')->references('id')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('memo_pelaksana');
    }
}

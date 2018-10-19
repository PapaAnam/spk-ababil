<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memo', function (Blueprint $table) {
            $table->increments('id');
            $table->text('pesan');
            $table->date('tanggal');
            $table->date('deadline');
            $table->integer('id_klien')->unsigned();
            $table->foreign('id_klien')->on('klien')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('id_proyek')->unsigned();
            $table->foreign('id_proyek')->on('proyek')->references('id')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('memo');
    }
}

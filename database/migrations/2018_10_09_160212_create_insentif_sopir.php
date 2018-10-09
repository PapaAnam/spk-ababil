<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsentifSopir extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insentif_sopir', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama',50);
            $table->double('insentif');
            $table->double('lembur');
            $table->integer('id_karyawan')->unsigned();
            $table->foreign('id_karyawan')->on('karyawan')->references('id')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insentif_sopir');
    }
}

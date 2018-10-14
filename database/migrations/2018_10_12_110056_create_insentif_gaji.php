<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsentifGaji extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insentif_gaji', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jumlah_insentif');
            $table->double('jumlah_lembur');
            $table->double('rate_insentif');
            $table->double('rate_lembur');
            $table->double('insentif_diterima');
            $table->double('lembur_diterima');
            $table->integer('id_insentif')->unsigned();
            $table->foreign('id_insentif')->on('insentif_sopir')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('id_gaji')->unsigned();
            $table->foreign('id_gaji')->on('gaji')->references('id')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insentif_gaji');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFotoLaporanProgress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foto_laporan_progress', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url');
            $table->integer('id_laporan')->unsigned()->nullable();
            $table->foreign('id_laporan')->on('progress_kerja_harian')->references('id')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foto_laporan_progress');
    }
}

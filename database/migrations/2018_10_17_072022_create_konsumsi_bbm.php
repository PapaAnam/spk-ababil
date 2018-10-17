<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKonsumsiBbm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konsumsi_bbm', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tanggal_masuk')->nullable();
            $table->date('tanggal_keluar')->nullable();
            $table->double('qty_masuk')->default(0);
            $table->double('qty_keluar')->default(0);
            $table->text('keterangan_masuk')->nullable();
            $table->text('keterangan_keluar')->nullable();
            $table->integer('id_vendor')->unsigned()->nullable();
            $table->foreign('id_vendor')->on('vendor')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('id_karyawan')->unsigned()->nullable();
            $table->foreign('id_karyawan')->on('karyawan')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('id_armada')->unsigned()->nullable();
            $table->foreign('id_armada')->on('armada')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('id_proyek')->unsigned()->nullable();
            $table->foreign('id_proyek')->on('proyek')->references('id')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('konsumsi_bbm');
    }
}

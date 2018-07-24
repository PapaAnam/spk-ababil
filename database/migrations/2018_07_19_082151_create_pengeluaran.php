<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengeluaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengeluaran', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no');
            $table->date('tanggal');
            $table->integer('id_vendor')->unsigned();
            $table->foreign('id_vendor')->on('vendor')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('id_karyawan')->unsigned();
            $table->foreign('id_karyawan')->on('karyawan')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->double('nominal');
            $table->integer('id_proyek')->unsigned();
            $table->foreign('id_proyek')->on('proyek')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('id_kategori')->unsigned()->nullable();
            $table->foreign('id_kategori')->on('kategori_pengeluaran')->references('id')->onUpdate('set null')->onDelete('set null');
            $table->integer('id_sub_kategori')->unsigned()->nullable();
            $table->foreign('id_sub_kategori')->on('kategori_pengeluaran')->references('id')->onUpdate('set null')->onDelete('set null');
            $table->text('deskripsi')->nullable();
            $table->string('ref');
            $table->string('kwitansi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengeluaran');
    }
}

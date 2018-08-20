<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BuatTabelPengeluaranPenggajian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengeluaran_penggajian', function (Blueprint $table) {
            $table->integer('id_penggajian')->unsigned();
            $table->foreign('id_penggajian')->references('id')->on('penggajian')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('id_pengeluaran')->unsigned();
            $table->foreign('id_pengeluaran')->references('id')->on('pengeluaran')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengeluaran_penggajian');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGajiPengeluaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gaji_pengeluaran', function (Blueprint $table) {
            $table->increments('id');
            $table->double('jumlah');
            $table->text('deskripsi')->nullable();
            $table->integer('id_gaji')->unsigned();
            $table->foreign('id_gaji')->references('id')->on('gaji')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gaji_pengeluaran');
    }
}

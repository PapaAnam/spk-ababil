<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimeSheetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_sheet', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tanggal');
            $table->integer('id_karyawan')->unisgned();
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->double('ritase')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('time_sheet');
    }
}

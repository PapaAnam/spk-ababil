<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOvertimeGaji extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('overtime_gaji', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jumlah_overtime');
            $table->double('rate_overtime');
            $table->double('overtime_diterima');
            $table->integer('id_overtime')->unsigned();
            $table->foreign('id_overtime')->on('overtime_operator')->references('id')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('overtime_gaji');
    }
}

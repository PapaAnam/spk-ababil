<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProyek extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyek', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->integer('klien')->unsigned()->nullable();
            $table->foreign('klien')->references('id')->on('klien')->onDelete('set null')->onUpdate('set null');
            $table->text('deskripsi');
            $table->double('qty');
            $table->integer('satuan')->unsigned()->nullable();
            $table->foreign('satuan')->references('id')->on('satuan')->onDelete('set null')->onUpdate('set null');
            $table->integer('pelaksana')->unsigned()->nullable();
            $table->foreign('pelaksana')->references('id')->on('karyawan')->onDelete('set null')->onUpdate('set null');
            $table->date('start_date');
            $table->date('end_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proyek');
    }
}

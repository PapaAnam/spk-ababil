<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTugas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tugas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('proyek')->unsigned()->nullable();
            $table->foreign('proyek')->references('id')->on('proyek')->onDelete('set null')->onUpdate('set null');
            $table->text('deksripsi');
            $table->double('qty');
            $table->integer('satuan')->unsigned()->nullable();
            $table->foreign('satuan')->references('id')->on('satuan')->onDelete('set null')->onUpdate('set null');
            $table->integer('pelaksana')->unsigned()->nullable();
            $table->foreign('pelaksana')->references('id')->on('karyawan')->onDelete('set null')->onUpdate('set null');
            $table->integer('pelaksana2')->unsigned()->nullable();
            $table->foreign('pelaksana2')->references('id')->on('karyawan')->onDelete('set null')->onUpdate('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tugas');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PelaksanaTugas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelaksana_tugas', function (Blueprint $table) {
            $table->integer('id_tugas')->unsigned()->nullable();
            $table->foreign('id_tugas')->references('id')->on('tugas')->onDelete('set null')->onUpdate('set null');
            $table->integer('id_pelaksana')->unsigned()->nullable();
            $table->foreign('id_pelaksana')->references('id')->on('karyawan')->onDelete('set null')->onUpdate('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pelaksana_tugas');
    }
}

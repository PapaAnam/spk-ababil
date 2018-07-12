<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PelaksanaDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelaksana_detail', function (Blueprint $table) {
            $table->integer('id_proyek')->unsigned()->nullable();
            $table->foreign('id_proyek')->references('id')->on('proyek')->onDelete('set null')->onUpdate('set null');
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
        Schema::dropIfExists('pelaksana_detail');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProgressKerjaHarian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progress_kerja_harian', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tanggal');
            $table->integer('id_proyek')->unsigned();
            $table->foreign('id_proyek')->references('id')->on('proyek')->onDelete('cascade')->onUpdate('cascade');
            $table->text('deskripsi')->nullable();
            $table->double('ritase');
            $table->string('cuaca');
            $table->text('kendala')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('progress_kerja_harian');
    }
}

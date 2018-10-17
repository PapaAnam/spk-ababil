<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJamAlat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jam_alat', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('tanggal');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->double('istirahat')->default(0);
            $table->text('pekerjaan')->nullable();
            $table->integer('id_armada')->unsigned();
            $table->foreign('id_armada')->on('armada')->references('id')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jam_alat');
    }
}

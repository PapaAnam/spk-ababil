<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArmada extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('armada', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_unit',50);
            $table->string('plat_no',50);
            $table->string('merk',50);
            // $table->string('model',50);
            // $table->string('seri',50);
            // $table->string('tahun',4);
            // $table->string('warna',50);
            $table->string('km_per_jam',50);
            $table->date('mulai');
            $table->date('selesai');
            $table->integer('id_vendor')->unsigned();
            $table->foreign('id_vendor')->on('vendor')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('id_kategori')->unsigned();
            $table->foreign('id_kategori')->on('kategori_armada')->references('id')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('armada');
    }
}

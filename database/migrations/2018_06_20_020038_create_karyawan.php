<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKaryawan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('nik');
            $table->text('alamat');
            $table->string('no_hp');
            $table->string('no_darurat')->nullable();
            $table->string('jabatan');
            $table->string('armada');
            $table->double('gaji_pokok');
            $table->double('rate_per_jam');
            $table->double('um_harian');
            $table->double('rate_lembur');
            $table->double('insentif');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('karyawan');
    }
}

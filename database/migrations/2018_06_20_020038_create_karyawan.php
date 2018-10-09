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
            $table->double('gaji_pokok')->default(0);
            $table->double('rate_per_jam')->default(0);
            $table->double('um_harian')->default(0);
            $table->double('rate_lembur')->default(0);
            $table->double('insentif')->default(0);
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

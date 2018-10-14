<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGajiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gaji', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tanggal_dari');
            $table->date('tanggal_sampai');
            $table->integer('id_karyawan')->unsigned();
            $table->string('jabatan');
            $table->string('armada');
            $table->string('plat_no');
            $table->double('total_jam_kerja');
            $table->double('gaji_pokok');
            $table->double('rate_per_jam');
            $table->double('um_harian');
            $table->tinyInteger('jumlah_hari_timesheet');
            $table->double('rate_insentif')->default(0);
            $table->double('jumlah_insentif')->default(0);
            $table->double('rate_lembur')->default(0);
            $table->double('jumlah_lembur')->default(0);
            $table->timestamp('tanggal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gaji');
    }
}

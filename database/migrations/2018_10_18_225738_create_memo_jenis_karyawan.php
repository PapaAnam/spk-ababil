<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemoJenisKaryawan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memo_jenis_karyawan', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('jenis_karyawan',[
                'Sopir', 'Operator', 'Office',
            ]);
            $table->integer('id_memo')->unsigned();
            $table->foreign('id_memo')->on('memo')->references('id')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('memo_jenis_karyawan');
    }
}

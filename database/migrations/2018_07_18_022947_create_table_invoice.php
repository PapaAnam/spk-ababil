<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableInvoice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tanggal');
            $table->string('no_invoice')->nullable();
            $table->integer('id_proyek')->unsigned();
            $table->foreign('id_proyek')->references('id')->on('proyek')->onDelete('cascade')->onUpdate('cascade');
            $table->text('deskripsi')->nullable();
            $table->double('total_tagihan');
            $table->double('terbayar');
            $table->double('tertagih');
            $table->integer('id_rekening')->unsigned()->nullable();
            $table->foreign('id_rekening')->references('id')->on('rekening')->onDelete('set null')->onUpdate('set null');
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice');
    }
}

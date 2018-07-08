<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePicDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pic_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('tipe', ['bapak', 'ibu']);
            $table->string('nama');
            $table->string('no_hp', 30);
            $table->integer('klien')->unisgned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pic_detail');
    }
}

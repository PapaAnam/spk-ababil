<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsentifTimesheet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insentif_timesheet', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('qty');
            $table->double('qty_lembur');
            $table->integer('id_insentif')->unsigned();
            $table->foreign('id_insentif')->on('insentif_sopir')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('id_timesheet')->unsigned();
            $table->foreign('id_timesheet')->on('time_sheet')->references('id')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insentif_timesheet');
    }
}

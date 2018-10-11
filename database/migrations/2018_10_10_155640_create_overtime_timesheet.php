<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOvertimeTimesheet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('overtime_timesheet', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('qty');
            $table->integer('id_overtime')->unsigned();
            $table->foreign('id_overtime')->on('overtime_operator')->references('id')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('overtime_timesheet');
    }
}

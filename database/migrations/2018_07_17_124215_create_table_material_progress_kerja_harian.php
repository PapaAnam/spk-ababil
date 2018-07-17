<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMaterialProgressKerjaHarian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_progress_kerja_harian', function (Blueprint $table) {
            $table->integer('id_progress')->unsigned();
            $table->foreign('id_progress')->references('id')->on('progress_kerja_harian')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('qty');
            $table->string('tipe');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('material_progress_kerja_harian');
    }
}

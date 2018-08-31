<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdTugasToProgresKerjaHarian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('progress_kerja_harian', function (Blueprint $table) {
            $table->integer('id_tugas')->unsigned()->nullable();
            $table->foreign('id_tugas')->on('tugas')->references('id')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('progress_kerja_harian', function (Blueprint $table) {
            $table->dropForeign(['id_tugas']);
        });
        Schema::table('progress_kerja_harian', function (Blueprint $table) {
            $table->dropColumn('id_tugas');
        });
    }
}

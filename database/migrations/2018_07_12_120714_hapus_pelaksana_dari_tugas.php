<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HapusPelaksanaDariTugas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tugas', function (Blueprint $table) {
            $table->dropForeign(['pelaksana']);
            $table->dropForeign(['pelaksana2']);
            $table->dropForeign(['proyek']);
        });
        Schema::table('tugas', function (Blueprint $table) {
            $table->dropColumn(['pelaksana']);
            $table->dropColumn(['pelaksana2']);
            $table->dropColumn(['proyek']);
        });
        Schema::table('tugas', function (Blueprint $table) {
            $table->integer('id_proyek')->unsigned()->nullable();
            $table->foreign('id_proyek')->references('id')->on('proyek')->onDelete('set null')->onUpdate('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tugas', function (Blueprint $table) {
            $table->dropForeign(['proyek']);
        });
        Schema::table('tugas', function (Blueprint $table) {
            $table->dropColumn(['proyek']);
        });
        Schema::table('tugas', function (Blueprint $table) {
            $table->integer('pelaksana')->unsigned()->nullable();
            $table->foreign('pelaksana')->references('id')->on('karyawan')->onDelete('set null')->onUpdate('set null');
            $table->integer('pelaksana2')->unsigned()->nullable();
            $table->foreign('pelaksana2')->references('id')->on('karyawan')->onDelete('set null')->onUpdate('set null');
            $table->integer('proyek')->unsigned()->nullable();
            $table->foreign('proyek')->references('id')->on('proyek')->onDelete('set null')->onUpdate('set null');
        });
    }
}

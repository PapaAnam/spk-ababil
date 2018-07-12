<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HapusPelaksanaDariProyek extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('proyek', function (Blueprint $table) {
            $table->dropForeign(['pelaksana']);
        });
        Schema::table('proyek', function (Blueprint $table) {
            $table->dropColumn('pelaksana');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('proyek', function (Blueprint $table) {
            $table->integer('pelaksana')->unsigned()->nullable();
            $table->foreign('pelaksana')->references('id')->on('karyawan')->onDelete('set null')->onUpdate('set null');
        });
    }
}

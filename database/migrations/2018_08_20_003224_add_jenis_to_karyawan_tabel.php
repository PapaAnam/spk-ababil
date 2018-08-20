<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddJenisToKaryawanTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('karyawan', function (Blueprint $table) {
            $table->dropColumn('rate_per_jam');
            $table->dropColumn('insentif');
        });
        Schema::table('karyawan', function (Blueprint $table) {
            $table->double('rate_per_jam')->default(0);
            $table->double('insentif')->default(0);
            $table->enum('jenis', ['Office','Sopir','Operator'])->default('Office');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('karyawan', function (Blueprint $table) {
            $table->dropColumn('jenis');
        });
    }
}

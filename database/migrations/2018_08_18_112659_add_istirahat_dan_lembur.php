<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIstirahatDanLembur extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('time_sheet', function (Blueprint $table) {
            $table->double('istirahat')->default(0);
            $table->double('lembur')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('time_sheet', function (Blueprint $table) {
            $table->dropColumn('istirahat');
            $table->dropColumn('lembur');
        });
    }
}

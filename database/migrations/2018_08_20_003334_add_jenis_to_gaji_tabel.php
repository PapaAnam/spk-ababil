<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddJenisToGajiTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gaji', function (Blueprint $table) {
            $table->dropColumn('rate_per_jam');
            $table->dropColumn('rate_insentif');
        });
        Schema::table('gaji', function (Blueprint $table) {
            $table->double('rate_per_jam')->default(0);
            $table->double('rate_insentif')->default(0);
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
        Schema::table('gaji', function (Blueprint $table) {
            $table->dropColumn('jenis');
        });
    }
}

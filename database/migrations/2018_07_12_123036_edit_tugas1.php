<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditTugas1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tugas', function (Blueprint $table) {
            $table->dropColumn('deksripsi');
        });
        Schema::table('tugas', function (Blueprint $table) {
            $table->text('deskripsi');
            $table->date('start_date');
            $table->date('end_date');
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
            $table->dropColumn('deskripsi');
            $table->dropColumn('start_date');
            $table->dropColumn('end_date');
        });
        Schema::table('tugas', function (Blueprint $table) {
            $table->string('deksripsi');
        });
    }
}

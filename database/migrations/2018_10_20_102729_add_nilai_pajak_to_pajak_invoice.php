<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNilaiPajakToPajakInvoice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pajak_invoice', function (Blueprint $table) {
            $table->double('nilai_pajak')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pajak_invoice', function (Blueprint $table) {
            $table->dropColumn('nilai_pajak');
        });
    }
}

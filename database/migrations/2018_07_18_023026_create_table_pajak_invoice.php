<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePajakInvoice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pajak_invoice', function (Blueprint $table) {
            $table->integer('id_invoice')->unsigned();
            $table->foreign('id_invoice')->references('id')->on('invoice')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama');
            $table->double('pajak');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pajak_invoice');
    }
}

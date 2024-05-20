<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pur_invoice_details', function (Blueprint $table) {
            $table->increments('pur_invoice_detail_id');
            $table->integer('pur_invoice_id')->unsigned();
            $table->string('pro_taxes',255)->nullable();
            $table->integer('product_id')->unsigned();
            $table->integer('unit_price')->unsigned();
            $table->integer('quantity');
            $table->integer('discount')->unsigned()->default(0);
            $table->integer('sub_total')->unsigned();
            $table->foreign('pur_invoice_id')
            ->references('pur_invoice_id')
            ->on('pur_invoices')
            ->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pur_invoice_details');
    }
};

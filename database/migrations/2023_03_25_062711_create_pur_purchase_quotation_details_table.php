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
        Schema::create('pur_purchase_quotation_details', function (Blueprint $table) {
            $table->increments('pur_quotation_detail_id');
            $table->integer('pur_quotation_id')->unsigned();
            $table->string('pro_taxes',255)->nullable();
            $table->integer('product_id')->unsigned();
            $table->integer('unit_price')->unsigned();
            $table->integer('quantity');
            $table->integer('discount')->unsigned()->default(0);
            $table->integer('sub_total')->unsigned();
            $table->foreign('pur_quotation_id')
            ->references('pur_quotation_id')
            ->on('pur_purchase_quotations')
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
        Schema::dropIfExists('pur_purchase_quotation_details');
    }
};

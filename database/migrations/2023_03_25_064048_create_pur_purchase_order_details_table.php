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
        Schema::create('pur_purchase_order_details', function (Blueprint $table) {
            $table->increments('pur_order_detail_id');
            $table->integer('pur_order_id')->unsigned();
            $table->string('pro_taxes',255)->nullable();
            $table->integer('product_id')->unsigned();
            $table->integer('unit_price')->unsigned();
            $table->integer('quantity');
            $table->integer('discount')->unsigned()->default(0);
            $table->integer('sub_total')->unsigned();
            $table->timestamps();
            $table->foreign('pur_order_id')->references('pur_order_id')->on('pur_purchase_orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pur_purchase_order_details');
    }
};

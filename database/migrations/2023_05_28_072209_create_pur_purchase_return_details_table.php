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
        Schema::create('pur_purchase_return_details', function (Blueprint $table) {
            $table->increments('pur_purchase_return_detail_id');
            $table->integer('pur_purchase_return_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('quantity')->unsigned();
            $table->foreign('pur_purchase_return_id')
            ->references('pur_purchase_return_id')
            ->on('pur_purchase_returns')
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
        Schema::dropIfExists('pur_purchase_return_details');
    }
};

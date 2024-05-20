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
        Schema::create('ims_stock_request_details', function (Blueprint $table) {
            $table->increments('ims_stock_request_detail_id');
            $table->integer('ims_stock_request_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('quantity');
            $table->foreign('ims_stock_request_id')
                ->references('ims_stock_request_id')->on('ims_stock_requests')
                ->onDelete('cascade');
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
        Schema::dropIfExists('ims_stock_request_details');
    }
};

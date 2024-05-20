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
        Schema::create('pur_product_quotation_request_details', function (Blueprint $table) {
            $table->increments('pro_quotation_req_detail_id');
            $table->integer('pro_quotation_req_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('quantity');
            
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
        Schema::dropIfExists('pur_product_quotation_request_details');
    }
};

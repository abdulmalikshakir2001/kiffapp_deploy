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
        Schema::create('pur_product_quotation_requests', function (Blueprint $table) {
            $table->increments('pro_quotation_req_id');
            $table->integer('company_id')->unsigned();
            $table->integer('created_by')->unsigned();
            $table->string('ref_num',255);
            $table->string('pro_quotation_req_code',255); // from this we create barcode
            $table->string('qr_code',255); // from this we create barcode
            $table->text('barcode');
            $table->date('creation_date');
            $table->time('creation_time');
            $table->integer('total_price')->unsigned()->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('pur_product_quotation_requests');
    }
};

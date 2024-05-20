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
        Schema::create('ims_stock_requests', function (Blueprint $table) {
            $table->increments('ims_stock_request_id');
            $table->integer('company_id')->unsigned();
            $table->integer('created_by')->unsigned();
            $table->integer('employee_id')->unsigned(); // request by employee
            $table->integer('stock_request_from')->unsigned(); // warehouse id 
            $table->integer('stock_request_to')->unsigned(); // warehouse id 
            

            $table->string('ref_num',255);
            $table->string('barcode',255); // from this we create barcode
            $table->string('qr_code',255); // from this we create barcode
            $table->text('barcode_string');
            $table->text('qr_code_string');
            $table->text('description')->nullable();
            $table->enum('status',['pending','processing','approved']);
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
        Schema::dropIfExists('ims_stock_requests');
    }
};

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
        Schema::create('pur_purchase_returns', function (Blueprint $table) {
            $table->increments('pur_purchase_return_id');
            $table->integer('company_id')->unsigned();
            $table->integer('supplier_id')->unsigned();
            $table->integer('pur_order_id')->unsigned();
            $table->date('delivery_date');
            $table->string('ref_num',255);
            $table->string('barcode',255);
            $table->text('barcode_string');
            $table->string('qr_code',255);
            $table->text('qr_code_string');
            $table->date('creation_date');
            $table->time('creation_time');
            $table->text('description')->nullable();
            $table->enum('status',['pending','delivered','cancelled']);
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
        Schema::dropIfExists('pur_purchase_returns');
    }
};

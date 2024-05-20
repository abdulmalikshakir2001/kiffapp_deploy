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
        Schema::create('sal_orders', function (Blueprint $table) {
            $table->increments('sal_order_id');
            $table->integer('company_id')->unsigned();
            $table->integer('sal_quotation_id')->unsigned();
            $table->integer('supplier_id')->unsigned();
            $table->string('taxes',255)->nullable();
            $table->date('order_date');
            $table->time('order_time');
            $table->string('ref_num',255);
            $table->string('order_code',255); // from this we create barcode
            $table->text('barcode');
            $table->string('qr_code',255);
            $table->text('qr_code_string');
            // $table->integer('tax_id')->unsigned();
            $table->text('description')->nullable();
            $table->integer('total_price')->unsigned()->nullable();
            $table->enum('status',['open','shipped','cancelled']);
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
        Schema::dropIfExists('sal_orders');
    }
};

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
        Schema::create('pur_invoices', function (Blueprint $table) {
            $table->increments('pur_invoice_id');
            $table->integer('company_id')->unsigned();
            $table->integer('supplier_id')->unsigned();
            $table->integer('pur_order_id')->unsigned();
            $table->date('delivery_date');
            $table->string('ref_num',255);
            $table->string('pur_invoice_code',255); // from this we create barcode
            $table->text('barcode');
            $table->string('qr_code',255);
            $table->text('qr_code_string');
            $table->date('creation_date');
            $table->time('creation_time');
            $table->string('taxes',255)->nullable();
            $table->text('description')->nullable();
            $table->integer('total_price')->unsigned()->nullable();
            $table->enum('invoice_status',['pending','approved','rejected']);
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
        Schema::dropIfExists('pur_invoices');
    }
};

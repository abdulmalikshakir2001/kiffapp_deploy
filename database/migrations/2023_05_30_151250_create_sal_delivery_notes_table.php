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
        Schema::create('sal_delivery_notes', function (Blueprint $table) {
            $table->increments('sal_delivery_note_id');
            $table->integer('company_id')->unsigned();
            $table->integer('supplier_id')->unsigned();
            $table->integer('sal_order_id')->unsigned();
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
        Schema::dropIfExists('sal_delivery_notes');
    }
};

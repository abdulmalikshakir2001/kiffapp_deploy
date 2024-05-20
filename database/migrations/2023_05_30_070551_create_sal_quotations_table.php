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
        Schema::create('sal_quotations', function (Blueprint $table) {
            $table->increments('sal_quotation_id');
            $table->integer('company_id')->unsigned();
            $table->integer('supplier_id')->unsigned();
            $table->date('delivery_date');
            $table->string('ref_num',255);
            $table->string('sal_quotation_code',255); // from this we create barcode
            $table->text('barcode');
            $table->string('qr_code',255);
            $table->text('qr_code_string');
            $table->date('creation_date');
            $table->time('creation_time');
            $table->string('taxes',255)->nullable();
            $table->text('description')->nullable();
            $table->integer('total_price')->unsigned()->nullable();

            $table->enum('quotation_status',['pending','approved','rejected']);
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
        Schema::dropIfExists('sal_quotations');
    }
};

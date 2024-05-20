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
        Schema::create('sal_quotation_details', function (Blueprint $table) {
            $table->increments('sal_quotation_detail_id');
            $table->integer('sal_quotation_id')->unsigned();
            $table->string('pro_taxes',255)->nullable();
            $table->integer('product_id')->unsigned();
            $table->integer('unit_price')->unsigned();
            $table->integer('quantity');
            $table->integer('discount')->unsigned()->default(0);
            $table->integer('sub_total')->unsigned();
            $table->foreign('sal_quotation_id')
            ->references('sal_quotation_id')
            ->on('sal_quotations')
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
        Schema::dropIfExists('sal_quotation_details');
    }
};

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
        Schema::create('pur_warehouse_stocks', function (Blueprint $table) {
            $table->increments('warehouse_stock_id');
            $table->integer('company_id')->unsigned();
            $table->integer('warehouse_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('stock_qty')->unsigned()->default(0);
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
        Schema::dropIfExists('pur_warehouse_stocks');
    }
};

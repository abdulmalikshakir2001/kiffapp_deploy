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
        Schema::create('ims_damage_stock_details', function (Blueprint $table) {
            $table->increments('ims_damage_stock_detail_id');
            $table->integer('ims_damage_stock_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('quantity');
            $table->foreign('ims_damage_stock_id')
                ->references('ims_damage_stock_id')->on('ims_damage_stocks')
                ->onDelete('cascade');
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
        Schema::dropIfExists('ims_damage_stock_details');
    }
};

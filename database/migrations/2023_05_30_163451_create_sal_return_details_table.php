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
        Schema::create('sal_return_details', function (Blueprint $table) {
            $table->increments('sal_return_detail_id');
            $table->integer('sal_return_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('quantity')->unsigned();
            $table->foreign('sal_return_id')
            ->references('sal_return_id')
            ->on('sal_returns')
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
        Schema::dropIfExists('sal_return_details');
    }
};

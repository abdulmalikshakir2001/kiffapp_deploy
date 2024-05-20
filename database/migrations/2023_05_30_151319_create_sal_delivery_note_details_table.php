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
        Schema::create('sal_delivery_note_details', function (Blueprint $table) {
            $table->increments('sal_delivery_note_detail_id');
            $table->integer('sal_delivery_note_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('quantity')->unsigned();
            $table->foreign('sal_delivery_note_id')
            ->references('sal_delivery_note_id')
            ->on('sal_delivery_notes')
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
        Schema::dropIfExists('sal_delivery_note_details');
    }
};

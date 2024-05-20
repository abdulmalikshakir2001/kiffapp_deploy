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
        Schema::create('pur_delivery_note_details', function (Blueprint $table) {
            $table->increments('pur_delivery_note_detail_id');
            $table->integer('pur_delivery_note_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('quantity')->unsigned();
            $table->foreign('pur_delivery_note_id')
            ->references('pur_delivery_note_id')
            ->on('pur_delivery_notes')
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
        Schema::dropIfExists('pur_delivery_note_details');
    }
};

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
        Schema::create('sal_cash_register_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cash_register_id')->unsigned();
            $table->decimal('amount',22,4)->default(0.0000);
            $table->string('pay_method',255)->nullable();
            $table->enum('type',['debit','credit']);
            $table->enum('transaction_type',['initial','sell','transfer','refund']);
            $table->integer('transaction_id')->unsigned();
            $table->timestamps();
            $table->foreign('cash_register_id')->references('id')->on('sal_cash_registers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sal_cash_register_transactions');
    }
};

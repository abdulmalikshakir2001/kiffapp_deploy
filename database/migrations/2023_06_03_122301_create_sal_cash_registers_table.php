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
        Schema::create('sal_cash_registers', function (Blueprint $table) {
            $table->increments('id');  
            $table->integer('company_id')->unsigned();  
            $table->integer('user_id')->unsigned();  
            $table->integer('location_id')->unsigned()->nullable();  
            $table->enum('status',['close','open'])->default('open');  
            $table->dateTime('closed_at')->nullable();  
            $table->decimal('closing_amount',22,4)->default(0.0000);  
            $table->integer('total_card_slips')->unsigned()->default(0);  
            $table->integer('total_cheques')->unsigned()->default(0);  
            $table->text('closing_note')->nullable();
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
        Schema::dropIfExists('sal_cash_registers');
    }
};

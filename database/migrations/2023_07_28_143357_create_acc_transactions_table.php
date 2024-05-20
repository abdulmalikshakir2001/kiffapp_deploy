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
        Schema::create('acc_transactions', function (Blueprint $table) {
            $table->increments('acc_transaction_id');
            $table->integer('company_id')->unsigned();
            $table->integer('fiscal_period_id')->unsigned();
            $table->integer('cost_center_id')->unsigned();
            $table->integer('control_code_id')->unsigned();
            $table->integer('currency_id')->unsigned();
            $table->integer('tax_id')->unsigned()->nullable();
            $table->date('date');
            $table->enum('status',['posted','unposted'])->default('unposted');
            $table->text('description')->nullable();
            $table->decimal('exchange_rate',8,2)->nullable();
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
        Schema::dropIfExists('acc_transactions');
    }
};

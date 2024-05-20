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
        Schema::create('acc_account_balances', function (Blueprint $table) {
            $table->increments('acc_account_balance_id');
            $table->integer('company_id')->unsigned();
            $table->integer('account_id')->unsigned();
            $table->decimal('balance',8,2)->default(0.00)->nullable();


            $table->foreign('company_id')
            ->references('company_id')->on('companies')
            ->onDelete('cascade');
            $table->foreign('account_id')
            ->references('acc_account_id')->on('acc_accounts')
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
        Schema::dropIfExists('acc_account_balances');
    }
};

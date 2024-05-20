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
        Schema::create('acc_journal_entries', function (Blueprint $table) {
            $table->increments('acc_journal_entry_id');
            $table->integer('company_id')->unsigned();
            $table->integer('transaction_id')->unsigned();
            $table->integer('account_id')->unsigned();
            $table->decimal('debit',8,2)->default(0.00);
            $table->decimal('credit',8,2)->default(0.00);
            $table->decimal('foreign_currency_amount',10,2)->default(0.00);
            $table->foreign('company_id')
            ->references('company_id')->on('companies')
            ->onDelete('cascade');
            $table->foreign('transaction_id')
            ->references('acc_transaction_id')->on('acc_transactions')
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
        Schema::dropIfExists('acc_journal_entries');
    }
};

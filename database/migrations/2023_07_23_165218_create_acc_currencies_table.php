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
        Schema::create('acc_currencies', function (Blueprint $table) {
            $table->increments('acc_currency_id');
            $table->integer('company_id')->unsigned();
            $table->string('name',255);
            $table->string('currency_code',255);
            $table->boolean('is_default')->unsigned()->default(0);
            $table->decimal('exchange_rate', 10, 2);
            


            $table->foreign('company_id')
            ->references('company_id')->on('companies')
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
        Schema::dropIfExists('acc_currencies');
    }
};

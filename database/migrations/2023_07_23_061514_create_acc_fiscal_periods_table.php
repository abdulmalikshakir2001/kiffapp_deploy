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
        Schema::create('acc_fiscal_periods', function (Blueprint $table) {
            $table->increments('acc_fiscal_period_id');
            $table->integer('company_id')->unsigned();
            
            $table->string('name',255);
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status',['on','off']);

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
        Schema::dropIfExists('acc_fiscal_periods');
    }
};

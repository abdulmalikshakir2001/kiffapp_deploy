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
        Schema::create('hrm_payrolls', function (Blueprint $table) {
            $table->id('payroll_id');
            $table->integer('user_id')->unsigned();
            $table->integer('company_id')->unsigned();
            $table->date('salary_month');
            $table->unsignedSmallInteger('attendences');
            $table->unsignedSmallInteger('absenties');
            $table->float('basic_salary');
            $table->string('overtime_hours',25)->nullable();
            $table->float('overtime_amount');
            $table->float('allownces');
            $table->float('deductions');
            $table->float('net_payable');
            $table->enum('payment_status',['paid','unpaid'])->default('unpaid');
            $table->timestamps();
            $table->foreign('company_id')->references('company_id')->on('companies')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hrm_payrolls');
    }
};

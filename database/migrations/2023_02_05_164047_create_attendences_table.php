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
        Schema::create('attendences', function (Blueprint $table) {
                //    late  early_leave overtime
            $table->id('attendence_id');
            $table->integer('user_id')->unsigned();
            $table->integer('company_id')->unsigned();
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->time('late');
            $table->time('early_leave');
            // $table->time('over_time');
            $table->timestamps();
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('company_id')->references('company_id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendences');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('work_shifts', function (Blueprint $table) {
            $table->id('work_shift_id');
            $table->integer('company_id')->unsigned();
            $table->string('shift_name',255);
            $table->time('compromize_time')->nullable();
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamps();

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
        Schema::dropIfExists('work_shifts');
    }
};

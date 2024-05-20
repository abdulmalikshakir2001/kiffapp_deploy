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
        Schema::create('hrm_week_days', function (Blueprint $table) {
            $table->id('week_day_id');
            $table->integer('company_id')->unsigned();
            $table->tinyInteger('monday')->unsigned()->default(1);
            $table->tinyInteger('tuesday')->unsigned()->default(1);
            $table->tinyInteger('wednesday')->unsigned()->default(1);
            $table->tinyInteger('thursday')->unsigned()->default(1);
            $table->tinyInteger('friday')->unsigned()->default(1);
            $table->tinyInteger('saturday')->unsigned()->default(1);
            $table->tinyInteger('sunday')->unsigned()->default(0);
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
        Schema::dropIfExists('hrm_week_days');
    }
};

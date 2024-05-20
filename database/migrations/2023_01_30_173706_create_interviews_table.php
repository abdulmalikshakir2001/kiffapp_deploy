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
        Schema::create('interviews', function (Blueprint $table) {
            $table->id('interview_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('job_vacancy_id');
            $table->unsignedBigInteger('company_id');
            $table->timestamp('interview_date');
            $table->tinyInteger('status')->default(0);
            // $table

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
        Schema::dropIfExists('interviews');
    }
};

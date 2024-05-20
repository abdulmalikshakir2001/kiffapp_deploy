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
        Schema::create('job_vacancies', function (Blueprint $table) {
            $table->id('job_vacancy_id');
            $table->integer('vacancy_code')->unsigned();
            $table->string('vacancy_name',255);
            $table->smallInteger('no_of_vacancy')->unsigned();
            $table->longText('description')->nullable();
            $table->enum('vacancy_status',['draft','publish']);
            $table->integer('company_id')->unsigned();
            $table->date('publish_date')->nullable();
            $table->date('end_date')->nullable();
            // foriegn key constrins
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
        Schema::dropIfExists('job_vacancies');
    }
};

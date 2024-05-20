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
        Schema::create('applied_candidates', function (Blueprint $table) {
            $table->id('applied_candidate_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('job_vacancy_id');
            $table->integer('company_id')->unsigned();
            // foreign key 
            
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
        Schema::dropIfExists('applied_candidates');
    }
};

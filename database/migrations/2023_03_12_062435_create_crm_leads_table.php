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
        Schema::create('crm_leads', function (Blueprint $table) {
            $table->increments('lead_id');
            $table->integer('company_id')->unsigned();
            $table->text('subject')->nullable();
            $table->integer('contact_id')->unsigned();
            $table->integer('employee_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('created_by')->unsigned();
            $table->enum('priority',['lowest','low','normal','high','highest']);
            $table->string('lead_reffered_by',255)->nullable();
            $table->string('remarks',255)->nullable();
            $table->text('internal_notes')->nullable();
            $table->text('external_info')->nullable();
            $table->date('creation_date');
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
        Schema::dropIfExists('crm_leads');
    }
};

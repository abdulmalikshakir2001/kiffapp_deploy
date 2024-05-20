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
        Schema::create('crm_schedule_phone_calls', function (Blueprint $table) {
            $table->increments('schedule_phone_call_id');
            $table->integer('company_id')->unsigned();
            $table->integer('contact_id')->unsigned();
            $table->integer('lead_id')->unsigned();
            $table->integer('oppertunity_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->date('date')->nullable();
            $table->string('duration',255)->nullable();
            $table->enum('priority',['lowest','low','normal','high','highest']);
            $table->string('responsible',255)->nullable();
            $table->text('call_summary')->nullable();
            $table->string('remarks',255)->nullable();
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
        Schema::dropIfExists('crm_schedule_phone_calls');
    }
};

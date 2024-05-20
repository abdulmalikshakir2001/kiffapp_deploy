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
        Schema::create('pro_taxes', function (Blueprint $table) {
            $table->increments('tax_id');
            $table->integer('company_id')->unsigned();
            $table->string('tax_name',255);
            $table->tinyInteger('percentage')->unsigned();
            $table->text('description')->nullable();
            $table->string('rules',255)->nullable();
            $table->boolean('active')->default(0)->nullable();
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
        Schema::dropIfExists('pro_taxes');
    }
};

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
        Schema::create('pro_attribute_values', function (Blueprint $table) {
            $table->increments('attribute_value_id');
            $table->integer('company_id')->unsigned();
            $table->integer('attribute_id')->unsigned();
            $table->string('name',255);
            $table->text('description')->nullable();
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
        Schema::dropIfExists('pro_attribute_values');
    }
};

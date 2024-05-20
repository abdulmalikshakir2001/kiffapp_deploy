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
        Schema::create('pro_warrenties', function (Blueprint $table) {
            $table->increments('warrenty_id');
            $table->integer('company_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->enum('warrenty_name',['limited','lifetime']);
            $table->integer('duration');
            $table->enum('duration_time',['day','month','year']);
            $table->text('description')->nullable();
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
        Schema::dropIfExists('pro_warrenties');
    }
};

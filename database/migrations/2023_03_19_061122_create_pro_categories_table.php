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
        Schema::create('pro_categories', function (Blueprint $table) {
            $table->increments('category_id');
            $table->integer('company_id')->unsigned();
            $table->string('category_name',255);
            $table->text('description')->nullable();
            $table->integer('parent')->unsigned()->default(0);
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
        Schema::dropIfExists('pro_categories');
    }
};

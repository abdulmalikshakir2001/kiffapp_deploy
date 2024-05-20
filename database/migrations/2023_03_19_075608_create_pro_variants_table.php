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
        Schema::create('pro_variants', function (Blueprint $table) {
            $table->id('variant_id');
            $table->integer('company_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->string('color',50);
            $table->string('size',50);
            $table->string('pro_variant_image',255);
            $table->decimal('price');



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
        Schema::dropIfExists('pro_variants');
    }
};

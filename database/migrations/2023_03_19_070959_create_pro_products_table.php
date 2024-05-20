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
        Schema::create('pro_products', function (Blueprint $table) {
            $table->increments('product_id');
            $table->integer('company_id')->unsigned();
            $table->string('product_name',255);
            $table->integer('product_sku')->unsigned();
            $table->text('product_description')->nullable();
            $table->integer('product_sale_price')->unsigned();
            $table->integer('product_purchase_price')->unsigned();
            $table->string('product_taxes',255)->nullable();
            $table->string('product_categories',255)->nullable();
            $table->tinyText('product_unit')->nullable();
            $table->enum('type',['service','product']);
            $table->enum('product_barcode_type', ['C128', 'C39', 'EAN13', 'EAN8', 'UPCA', 'UPCE'])->default('C128');
            $table->string('product_code',255);
            $table->text('product_barcode');

            $table->boolean('sell_online')->default(0);
            $table->boolean('is_varient')->default(0);
            
            $table->integer('parent_product_id')->unsigned()->default(0);
            $table->json('attributes')->nullable();
            $table->tinyText('product_image')->nullable();
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
        Schema::dropIfExists('pro_products');
    }
};

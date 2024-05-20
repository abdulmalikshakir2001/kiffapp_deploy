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
        Schema::create('ims_damage_stocks', function (Blueprint $table) {
            $table->increments('ims_damage_stock_id');
            $table->integer('company_id')->unsigned();
            $table->integer('warehouse_id')->unsigned();
            
            
            
            

            $table->string('ref_num',255);
            $table->string('barcode',255); // from this we create barcode
            $table->string('qr_code',255); // from this we create barcode
            $table->text('barcode_string');
            $table->text('qr_code_string');
            $table->text('description')->nullable();
            $table->enum('status',['pending','approved']);
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
        Schema::dropIfExists('ims_damage_stocks');
    }
};

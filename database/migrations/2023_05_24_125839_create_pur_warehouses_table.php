<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pur_warehouses', function (Blueprint $table) {
            $table->increments('warehouse_id');
            $table->integer('company_id')->unsigned();
            $table->string('warehouse_name',255);
            $table->string('contact_number',50);
            $table->text('address')->nullable();
            $table->string('city',255);
            $table->string('country',255);
            $table->timestamps();
      
            
        });

        DB::table('pur_warehouses')->insert([
            'company_id' => '1',
            'warehouse_name' => 'main warehouse',
            'contact_number' => 'dummy',
            'address' => 'dummy',
            'city' => 'dummy',
            'country' => 'dummy',
            'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),
            

        ]);

      
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pur_warehouses');
    }
};

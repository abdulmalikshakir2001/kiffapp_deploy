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
        Schema::create('acc_cost_centers', function (Blueprint $table) {
            $table->increments('acc_cost_center_id');
            $table->integer('company_id')->unsigned();
            $table->string('name',255);
            $table->text('description')->nullable();


            $table->foreign('company_id')
            ->references('company_id')->on('companies')
            ->onDelete('cascade');
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
        Schema::dropIfExists('acc_cost_centers');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('app_settings', function (Blueprint $table) {
            $table->id('app_setting_id');
            $table->string('app_name',255);
            $table->string('app_logo',255)->nullable();
            $table->string('app_dark_logo',255)->nullable();
            $table->string('fav_icon',255)->nullable();
            $table->timestamps();
        });
        DB::table('app_settings')->insert(['app_name'=>'Zaratica ERP','app_setting_id'=>1,'app_logo'=>'app_logo.jpg']);
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_settings');
    }
};

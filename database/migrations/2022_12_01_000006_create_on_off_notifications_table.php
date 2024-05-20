<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('on_off_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('notification_name',255);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
        DB::table('on_off_notifications')->insert(['notification_name'=>'Create User']);
        DB::table('on_off_notifications')->insert(['notification_name'=>'Logged in']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('on_off_notifications');
    }
    
    
};

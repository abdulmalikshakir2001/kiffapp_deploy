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
        Schema::create('leave_types', function (Blueprint $table) {
            $table->id('leave_type_id');
            $table->string('leave_type',255);
            $table->enum('is_paid',['paid','unpaid']);
            $table->timestamps();
        });
        DB::table('leave_types')->insert([
            'leave_type'=>'Yearly Leave',
            'is_paid'=>'paid'

        ]);
        DB::table('leave_types')->insert([
            'leave_type'=>'Sick Leave',
            'is_paid'=>'paid'

        ]);
        DB::table('leave_types')->insert([
            'leave_type'=>'Urgent Leave',
            'is_paid'=>'paid'

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leave_types');
    }
};

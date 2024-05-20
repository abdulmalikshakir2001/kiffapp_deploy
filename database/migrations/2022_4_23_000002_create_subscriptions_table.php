<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     * The Table is for static data purpose and shall be used by the developers only.
     * To add the module name to load in group permissions. The boolean fields are only
     * to help in creating the user form for group permissions assignment.
     * @return void
     */
    public function up()
    {

        Schema::create('subscriptions', function (Blueprint $table) {
            $table->increments('subscription_id');
            $table->integer('company_id')->unsigned()->default('1');
            $table->integer ('package_id')->unsigned()->default('1');
            $table->date('start_date');
            $table->date('end_date');
            $table->date('trial_ends_date');
            $table->float('price')->default('0.00');
            $table->enum ('status', ['Pending','Declined','Approved'])->default('Pending');
            $table->boolean('is_paid_offline')->default(0);
            $table->boolean('is_active')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });

        // Insert Default System Forms in the Permissions Table


            /** Default App Packages */
        DB::table('subscriptions')->insert([


            'company_id' => 1,
            'package_id' => 1,
            'start_date' => date('Y-m-d'),
            'end_date' =>date('Y-m-d', strtotime('+90 days')),
            'trial_ends_date' => date('Y-m-d'),
            'price' => 0.00,
            'status' => 'Approved',
            'is_paid_offline' => 1,
            'is_active' => 1,
            'created_at' => now()


        ]);


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
}

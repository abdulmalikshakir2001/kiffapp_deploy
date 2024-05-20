<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class CreateSubscriptionPackagesTable extends Migration
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

        Schema::create('subscription_packages', function (Blueprint $table) {
            $table->increments('package_id');
            $table->string  ('package_name');
            $table->string  ('package_description');
            $table->float ('price')->default('0');
            $table->integer ('duration')->unsigned()->default('1');
            $table->enum    ('duration_type', ['Days', 'Months', 'Years'])->default('Days');
            $table->integer ('trail_period_in_days')->unsigned()->default('14');
            $table->integer ('sort_order')->unsigned()->default('0');


            $table->integer('allowed_users')->default('1');
            $table->integer('allowed_products')->default('0');
            $table->integer('allowed_customers')->default('0');
            $table->integer('allowed_suppliers')->default('0');
            $table->integer('allowed_purchaseorders')->default('0');
            $table->integer('allowed_salesinvoices')->default('0');
            $table->integer('allowed_accounts')->default('0');


            $table->boolean('module_hrm')->default(0);
            $table->boolean('module_crm')->default(0);
            $table->boolean('module_products')->default(0);
            $table->boolean('module_purchase')->default(0);
            $table->boolean('module_inventroy')->default(0);
            $table->boolean('module_sales')->default(0);
            $table->boolean('module_accounts')->default(0);

            $table->boolean('is_active')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });

        // Insert Default System Forms in the Permissions Table


            /** Default App Packages */
        DB::table('subscription_packages')->insert([
            'package_name' => 'Basic Free',
            'package_description' => 'Baisc Features',
            'price' => 0.00,
            'duration' => 1,
            'duration_type' => 'Days',
            'trail_period_in_days' => 14,
            'sort_order' => 1,


            'allowed_users' => 5,
            'allowed_products' => -1,
            'allowed_customers' => -1,
            'allowed_suppliers' => -1,
            'allowed_purchaseorders' => -1,
            'allowed_salesinvoices' => -1,
            'allowed_accounts' => -1,

            'module_hrm' => 1,
            'module_crm' => 1,
            'module_products' => 1,
            'module_purchase' => 1,
            'module_inventroy' => 1,
            'module_sales' => 1,
            'module_accounts' => 1,

            'is_active' => 1


        ]);


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscription_packages');
    }
}

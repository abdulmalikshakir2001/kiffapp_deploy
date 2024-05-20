<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('company_id');
            $table->string('company_name');
            $table->string('registration_number')->nullable();
            $table->text('address')->nullable();
            $table->string('city', 50)->nullable();
            $table->string('state', 50)->nullable();
            $table->string('landmark', 50)->nullable();
            $table->string('zip_code')->nullable();
            $table->integer('country_id')->unsigned();
            $table->string('logo')->nullable();
            $table->string('tax1_name', 10)->nullable();
            $table->string('tax1_number', 100)->nullable();
            $table->string('tax2_name', 10)->nullable();
            $table->string('tax2_number', 100)->nullable();
            $table->string('phone_number', 50)->nullable();
            $table->string('contact_number', 50)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('sku_prefix')->nullable();
            $table->string('time_zone')->default('Asia/Karachi');
            $table->string('date_format')->default('d/m/Y');
            $table->enum('time_format', [12, 24])->default(12);
            $table->tinyInteger('fy_start_month')->default(1);
            $table->float('default_profit_percent', 5, 2)->default(0);
            $table->decimal('default_sales_discount_percent', 5, 2)->nullable();
            $table->decimal('default_sales_tax_percent', 5, 2)->nullable();
            $table->enum('default_barcode_type', ['C128', 'C39', 'EAN13', 'EAN8', 'UPCA', 'UPCE'])->default('C128');
            $table->text('pos_settings')->nullable();
            $table->text('email_settings')->nullable();
            $table->text('sms_settings')->nullable();
            $table->text('common_settings')->nullable();
            $table->string('website')->nullable();
            $table->enum('currency_symbol_placement', ['before', 'after'])->default('before');
            $table->enum('stock_accounting_method', ['fifo', 'lifo'])->default('fifo');
            $table->boolean('enable_purchase')->default(true);
            $table->boolean('enable_product_expiry')->default(0);
            $table->boolean('enable_price_tax')->default(true);
            $table->boolean('enable_category')->default(true);
            $table->boolean('enable_sub_category')->default(true);
            $table->boolean('enable_brand')->default(true);
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });

        /** Default Company for App Global Settings */
        DB::table('companies')->insert([
            'company_name' => 'Zaratica ERP Inc.',
            'registration_number' => '000000',
            'address' => 'Office No.1, Smart Electronics Plaza',
            'city' => 'Sakhakot',
            'state' => 'KP',
            'landmark' => 'Near MCB Bank',
            'zip_code' => '23080',
            'country_id' => 1,
            'logo' => '',
            'tax1_name' => 'GST',
            'tax1_number' => '000000',
            'tax2_name' => 'VAT',
            'tax2_number' => '000000',
            'phone_number' => '+923319195103',
            'contact_number' => '+923005940474',
            'email' => 'zorkif@outlook.com',
            'sku_prefix' => '',
            'time_zone' => 'Asia/Karachi',
            'date_format' => 'd/m/Y',
            'time_format' => '12',
            'fy_start_month' => 1,
            'default_profit_percent' => '25.00',
            'default_sales_discount_percent' => '0.00',
            'default_sales_tax_percent' => '17',
            'default_barcode_type' => 'C128',
            'pos_settings' => '',
            'email_settings' => '',
            'sms_settings' => '',
            'common_settings' => '',
            'website' => '',
            'currency_symbol_placement' => 'before',
            'stock_accounting_method' => 'fifo',
            'enable_product_expiry' => 0,
            'enable_brand' => 1,
            'enable_category' => 1,
            'enable_sub_category' => 1,
            'enable_price_tax' => 1,
            'enable_purchase' => 1,
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
        Schema::dropIfExists('companies');
    }
}

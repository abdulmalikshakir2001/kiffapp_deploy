<?php

namespace App\Models\Companies;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Companie extends Model
{
    use HasFactory, HasFactory, Notifiable;
    protected  $table = "companies";
    protected  $primaryKey = "company_id";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company_name',
        'registration_number',
        'address',
        'city',
        'state',
        'logo',
        'landmark',
        'zip_code',
        'country_id',
        'tax1_name',
        'tax1_number',
        'tax2_name',
        'tax2_number',
        'phone_number',
        'contact_number',
        'email',
        'sku_prefix',
        'time_zone',
        'date_format',
        'time_format',
        'fy_start_month',
        'default_profit_percent',
        'default_sales_discount_percent',
        'default_sales_tax_percent',
        'default_barcode_type',
        'pos_settings',
        'email_settings',
        'sms_settings',
        'common_settings',
        'website',
        'webfront_public_code',
        'currency_symbol_placement',
        'stock_accounting_method',
        'enable_purchase',
        'enable_product_expiry',
        'enable_price_tax',
        'enable_category',
        'enable_sub_category',
        'enable_brand',
        'is_active'
    ];

    
}

<?php

namespace App\Models\purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurPurchaseQuotationDetail extends Model
{
    use HasFactory;
    protected $table="pur_purchase_quotation_details";
    protected $primaryKey="pur_quotation_detail_id";
    protected $fillable=[
'pur_quotation_id',
'taxes',
'product_id',
'unit_price',
'quantity',
'discount',
'sub_total',
    ];
}

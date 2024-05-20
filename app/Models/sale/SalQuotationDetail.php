<?php

namespace App\Models\sale;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalQuotationDetail extends Model
{
    use HasFactory;
    protected $table="sal_quotation_details";
    protected $primaryKey="sal_quotation_detail_id";
    protected $fillable=[
'sal_quotation_id',
'taxes',
'product_id',
'unit_price',
'quantity',
'discount',
'sub_total',
    ];
}

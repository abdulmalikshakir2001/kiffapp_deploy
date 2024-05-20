<?php

namespace App\Models\sale;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalOrderDetail extends Model
{
    use HasFactory;
    protected $table="sal_order_details";
    protected $primaryKey="sal_order_detail_id";
    protected $fillable=[
'sal_order_id',
'pro_taxes',
'product_id',
'unit_price',
'quantity',
'discount',
'sub_total',
    ];
}

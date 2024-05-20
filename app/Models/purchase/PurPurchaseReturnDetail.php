<?php

namespace App\Models\purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurPurchaseReturnDetail extends Model
{
    use HasFactory;
    protected $table="pur_purchase_return_details";
    protected $primaryKey="pur_purchase_return_detail_id";
    protected $fillable=[
'pur_purchase_return_id',
'product_id',
'quantity',
    ];
}

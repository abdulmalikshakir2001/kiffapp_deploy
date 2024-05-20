<?php

namespace App\Models\purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\product\ProProduct;


class PurPurchaseOrderDetail extends Model
{
    use HasFactory;

    protected $table="pur_purchase_order_details";
    protected $primaryKey="pur_order_detail_id";
    protected $fillable=[
'pur_order_id',
'pro_taxes',
'product_id',
'unit_price',
'quantity',
'discount',
'sub_total',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(ProProduct::class,'product_id','product_id');
    }



}

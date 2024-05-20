<?php

namespace App\Models\sale;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use  App\Models\product\ProProduct;

class SalInvoiceDetail extends Model
{
    use HasFactory;
    protected $table="sal_invoice_details";
    protected $primaryKey="sal_invoice_detail_id";
    protected $fillable=[
'sal_invoice_id',
'pro_taxes',
'product_id',
'unit_price',
'quantity',
'discount',
'sub_total',
    ];

    public function product(): HasOne
    {
        return $this->hasOne(ProProduct::class,'product_id','product_id');
    }
}

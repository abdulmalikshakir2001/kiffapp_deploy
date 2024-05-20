<?php

namespace App\Models\purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurInvoiceDetail extends Model
{
    use HasFactory;
    protected $table="pur_invoice_details";
    protected $primaryKey="pur_invoice_detail_id";
    protected $fillable=[
'pur_invoice_id',
'taxes',
'product_id',
'unit_price',
'quantity',
'discount',
'sub_total',
    ];
}

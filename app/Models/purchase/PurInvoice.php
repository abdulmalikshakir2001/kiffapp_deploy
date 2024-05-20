<?php

namespace App\Models\purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\purchase\PurInvoiceDetail;
use App\Models\product\ProProduct;


class PurInvoice extends Model
{
    use HasFactory;
    protected $table="pur_invoices";
    protected $primaryKey="pur_invoice_id";
    protected $fillable=[
'company_id',
'supplier_id',
'pur_order_id',
'delivery_date',
'ref_num',
'pur_invoice_code',
'barcode',
'qr_code',
'qr_code_string',
'creation_date',
'creation_time',
'taxes',
'description',
'total_price',
'invoice_status',
    ];


    public function details():HasMany
    {
        return $this->hasMany(PurInvoiceDetail::class,'pur_invoice_id','pur_invoice_id');
    }
    public function products(){
    return $this->belongsToMany(ProProduct::class,'pur_invoice_details','pur_invoice_id','product_id')->withPivot('pur_invoice_detail_id','unit_price','quantity','discount','sub_total','pro_taxes','created_at','updated_at');
    }
}

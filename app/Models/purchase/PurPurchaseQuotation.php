<?php

namespace App\Models\purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\purchase\PurPurchaseQuotationDetail;
use App\Models\product\ProProduct;


class PurPurchaseQuotation extends Model
{
    use HasFactory;
    protected $table="pur_purchase_quotations";
    protected $primaryKey="pur_quotation_id";
    protected $fillable=[
'company_id',
'supplier_id',
'pro_quotation_req_id',
'delivery_date',
'ref_num',
'pur_quotation_code',
'barcode',
'qr_code',
'qr_code_string',
'creation_date',
'creation_time',
'taxes',
'description',
'total_price',
'quotation_status',
    ];


    public function details():HasMany
    {
        return $this->hasMany(PurPurchaseQuotationDetail::class,'pur_quotation_id','pur_quotation_id');
    }
    public function products(){
    return $this->belongsToMany(ProProduct::class,'pur_purchase_quotation_details','pur_quotation_id','product_id')->withPivot('pur_quotation_detail_id','unit_price','quantity','discount','sub_total','pro_taxes','created_at','updated_at');
    }
}

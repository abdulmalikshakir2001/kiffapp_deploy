<?php

namespace App\Models\sale;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\sale\SalQuotationDetail;
use App\Models\product\ProProduct;

class SalQuotation extends Model
{
    use HasFactory;
    protected $table="sal_quotations";
    protected $primaryKey="sal_quotation_id";
    protected $fillable=[
'company_id',
'supplier_id',
'pro_quotation_req_id',
'delivery_date',
'ref_num',
'sal_quotation_code',
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
        return $this->hasMany(SalQuotationDetail::class,'sal_quotation_id','sal_quotation_id');
    }
    public function products(){
    return $this->belongsToMany(ProProduct::class,'sal_quotation_details','sal_quotation_id','product_id')->withPivot('sal_quotation_detail_id','unit_price','quantity','discount','sub_total','pro_taxes','created_at','updated_at');
    }
}

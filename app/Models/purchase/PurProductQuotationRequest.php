<?php

namespace App\Models\purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\purchase\PurProductQuotationRequestDetail;
use App\Models\product\ProProduct;

class PurProductQuotationRequest extends Model
{
    use HasFactory;
    protected $table="pur_product_quotation_requests";
    protected $primaryKey="pro_quotation_req_id";
    protected $fillable=[
'company_id',
'created_by',
'ref_num',
'pro_quotation_req_code',
'barcode',
'creation_date',
'creation_time',
'description',
    ];


    public function details():HasMany
    {
        return $this->hasMany(PurProductQuotationRequestDetail::class,'pro_quotation_req_id','pro_quotation_req_id');
    }
    public function products(){
    return $this->belongsToMany(ProProduct::class,'pur_product_quotation_request_details','pro_quotation_req_id','product_id')->withPivot('pro_quotation_req_detail_id','quantity','created_at','updated_at');
    }
}

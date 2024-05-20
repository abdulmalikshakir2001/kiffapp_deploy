<?php

namespace App\Models\purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\purchase\PurProductQuotationRequest;
use App\Models\product\ProProduct;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurProductQuotationRequestDetail extends Model
{
    use HasFactory;

    protected $table="pur_product_quotation_request_details";
    protected $primaryKey="pro_quotation_req_detail_id";
    protected $fillable=[
'pro_quotation_req_id',

'taxes',
'product_id',
'unit_price',
'quantity',
'discount',
'sub_total',
    ];
    public function requests()
    {
      return  $this->belongsTo(PurProductQuotationRequest::class,'pro_quotation_req_id','pro_quotation_req_id');
    }
    public function products(){
        return $this->belongsTo(ProProduct::class,'product_id','product_id');
    }

}

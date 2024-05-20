<?php

namespace App\Models\product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\purchase\PurProductQuotationRequestDetail;
use App\Models\purchase\PurProductQuotationRequest;
use App\Models\purchase\PurPurchaseQuotation;

class ProProduct extends Model
{
    use HasFactory;
    protected $table="pro_products";
    protected $primaryKey="product_id";
    protected $fillable=[
        
'company_id',
'product_name',
'product_sku',
'product_description',
'product_sale_price',
'product_purchase_price',
'product_taxes',
'product_categories',
'product_unit',
'type',
'product_barcode_type',
'product_code',
'product_barcode',
'sell_online',
'is_varient',
'parent_product_id',
'attributes',
'product_image',
    ];
    public function details(){
        return $this->hasMany(PurProductQuotationRequestDetail::class,'product_id','product_id');
    }
    public function requests(){
        return $this->belongsToMany(PurProductQuotationRequest::class,'pur_product_quotation_request_details','product_id','pro_quotation_req_id');
        }
    public function purchaseQuotation(){
        return $this->belongsToMany(PurPurchaseQuotation::class,'pur_purchase_quotation_details','product_id','pur_quotation_id');
        }
}

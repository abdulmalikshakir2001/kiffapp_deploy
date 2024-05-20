<?php

namespace App\Models\purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\purchase\PurPurchaseReturnDetail;
use App\Models\product\ProProduct;

class PurPurchaseReturn extends Model
{
    use HasFactory;
    protected $table="pur_purchase_returns";
    protected $primaryKey="pur_purchase_return_id";
    protected $fillable=[
'company_id',
'supplier_id',
'pur_order_id',
'delivery_date',
'ref_num',
'barcode',
'barcode_string',
'qr_code',
'qr_code_string',
'creation_date',
'creation_time',
'description',
'status',
    ];


    public function details():HasMany
    {
        return $this->hasMany(PurPurchaseReturnDetail::class,'pur_purchase_return_id','pur_purchase_return_id');
    }
    public function products(){
    return $this->belongsToMany(ProProduct::class,'pur_purchase_return_details','pur_purchase_return_id','product_id')->withPivot('pur_purchase_return_detail_id','quantity','created_at','updated_at');
    }
}

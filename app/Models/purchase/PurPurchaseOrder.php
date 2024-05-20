<?php

namespace App\Models\purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\purchase\PurPurchaseOrderDetail;
use App\Models\product\ProProduct;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;



class PurPurchaseOrder extends Model
{
    use HasFactory;
    protected $table="pur_purchase_orders";
    protected $primaryKey="pur_order_id";
    protected $fillable=[
'company_id',
'pur_quotation_id',
'supplier_id',
'taxes',
'order_date',
'order_time',
'ref_num',
'order_code',
'barcode',
'description',
'total_price',
'status',
    ];


    public function details():HasMany
    {
        return $this->hasMany(PurPurchaseOrderDetail::class,'pur_order_id','pur_order_id');
    }
    public function products(){
    return $this->belongsToMany(ProProduct::class,'pur_purchase_order_details','pur_order_id','product_id')->withPivot('pur_order_detail_id','unit_price','quantity','discount','sub_total','pro_taxes','created_at','updated_at');
    }

    public function productsHasThrough(): HasOneThrough
    {
        return $this->hasOneThrough(ProProduct::class, PurPurchaseOrderDetail::class,'pur_order_id','pur_order_detail_id','pur_order_id','pur_order_detail_id');
    }

    
}

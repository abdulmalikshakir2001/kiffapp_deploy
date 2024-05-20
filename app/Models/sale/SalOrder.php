<?php

namespace App\Models\sale;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\sale\SalOrderDetail;
use App\Models\product\ProProduct;

class SalOrder extends Model
{
    use HasFactory;
    protected $table="sal_orders";
    protected $primaryKey="sal_order_id";
    protected $fillable=[
'company_id',
'sal_quotation_id',
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
        return $this->hasMany(SalOrderDetail::class,'sal_order_id','sal_order_id');
    }
    public function products(){
    return $this->belongsToMany(ProProduct::class,'sal_order_details','sal_order_id','product_id')->withPivot('sal_order_detail_id','unit_price','quantity','discount','sub_total','pro_taxes','created_at','updated_at');
    }
}

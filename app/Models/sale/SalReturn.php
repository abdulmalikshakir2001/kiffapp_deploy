<?php

namespace App\Models\sale;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\sale\SalReturnDetail;
use App\Models\product\ProProduct;

class SalReturn extends Model
{
    use HasFactory;
    protected $table="sal_returns";
    protected $primaryKey="sal_return_id";
    protected $fillable=[
'company_id',
'supplier_id',
'sal_order_id',
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
        return $this->hasMany(SalReturnDetail::class,'sal_return_id','sal_return_id');
    }
    public function products(){
    return $this->belongsToMany(ProProduct::class,'sal_return_details','sal_return_id','product_id')->withPivot('sal_return_detail_id','quantity','created_at','updated_at');
    }
}

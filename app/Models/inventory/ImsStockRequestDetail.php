<?php

namespace App\Models\inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\inventory\ImsStockRequest;
use App\Models\product\ProProduct;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImsStockRequestDetail extends Model
{
    use HasFactory;

    protected $table="ims_stock_request_details";
    protected $primaryKey="ims_stock_request_detail_id";
    protected $fillable=[
'ims_stock_request_id',
'product_id',
'quantity',


    ];
    public function requests()
    {
      return  $this->belongsTo(ImsStockRequest::class,'ims_stock_request_id','ims_stock_request_id');
    }
    public function products(){
        return $this->belongsTo(ProProduct::class,'product_id','product_id');
    }

}

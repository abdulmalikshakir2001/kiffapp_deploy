<?php

namespace App\Models\inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\inventory\ImsDamageStock;
use App\Models\product\ProProduct;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImsDamageStockDetail extends Model
{
    use HasFactory;

    protected $table="ims_damage_stock_details";
    protected $primaryKey="ims_damage_stock_detail_id";
    protected $fillable=[
'ims_damage_stock_id',
'product_id',
'quantity',


    ];
    public function requests()
    {
      return  $this->belongsTo(ImsDamageStock::class,'ims_damage_stock_id','ims_damage_stock_id');
    }
    public function products(){
        return $this->belongsTo(ProProduct::class,'product_id','product_id');
    }

}

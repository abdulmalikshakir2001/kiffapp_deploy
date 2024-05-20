<?php

namespace App\Models\purchase;

use App\Models\product\ProProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurWarehouseStock extends Model
{
    use HasFactory;
    protected $table="pur_warehouse_stocks";
    protected $primaryKey="warehouse_stock_id";
    protected $fillable=[
        
'warehouse_id',
'company_id',
'product_id',
'stock_qty',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(ProProduct::class,'product_id','product_id');
    }

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(PurWarehouse::class,'warehouse_id','warehouse_id');
    }



}

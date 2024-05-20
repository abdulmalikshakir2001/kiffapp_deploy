<?php

namespace App\Models\purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\product\ProProduct;


class PurWarehouse extends Model
{
    use HasFactory;
    protected $table="pur_warehouses";
    protected $primaryKey="warehouse_id";
    protected $fillable=[
        
'warehouse_id',
'company_id',
'warehouse_name',
'address',
'city',
'country',
'contact_number',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(ProProduct::class,'pur_warehouse_stocks','warehouse_id','product_id')->withPivot('warehouse_stock_id','company_id','warehouse_id','product_id','stock_qty','created_at','updated_at');
    }

    

}

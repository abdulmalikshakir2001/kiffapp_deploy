<?php

namespace App\Models\inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\inventory\ImsDamageStockDetail;
use App\Models\product\ProProduct;
use App\Models\purchase\PurWarehouse;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImsDamageStock extends Model
{
    use HasFactory;
    protected $table="ims_damage_stocks";
    protected $primaryKey="ims_damage_stock_id";
    protected $fillable=[
        'ims_damage_stock_id',
        'company_id',
        'warehouse_id',
        
        
        'ref_num',
        'barcode',
        'qr_code',
        'barcode_string',
        'qr_code_string',
        'description',
        'status',
    ];


    public function details():HasMany
    {
        return $this->hasMany(ImsDamageStockDetail::class,'ims_damage_stock_id','ims_damage_stock_id');
    }
    public function products(){
    return $this->belongsToMany(ProProduct::class,'ims_damage_stock_details','ims_damage_stock_id','product_id')->withPivot('ims_damage_stock_detail_id','quantity','created_at','updated_at');
    }


    public function stockRequestBy(): BelongsTo
    {
        return $this->belongsTo(User::class,'employee_id','user_id');
    }
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class,'created_by','user_id');
    }
    public function stockRequestFrom(): BelongsTo
    {
        return $this->belongsTo(PurWarehouse::class,'stock_request_from','warehouse_id');
    }
    public function stockRequestTo(): BelongsTo
    {
        return $this->belongsTo(PurWarehouse::class,'stock_request_to','warehouse_id');
    }
}

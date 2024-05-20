<?php

namespace App\Models\inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\inventory\ImsStockTransferDetail;
use App\Models\product\ProProduct;
use App\Models\purchase\PurWarehouse;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImsStockTransfer extends Model
{
    use HasFactory;
    protected $table="ims_stock_transfers";
    protected $primaryKey="ims_stock_transfer_id";
    protected $fillable=[
        'ims_stock_transfer_id',
        'ims_stock_request_id',
        'company_id',
        'created_by',
        'employee_id',
        'transfer_from',
        'transfer_to',
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
        return $this->hasMany(ImsStockTransferDetail::class,'ims_stock_transfer_id','ims_stock_transfer_id');
    }
    public function products(){
    return $this->belongsToMany(ProProduct::class,'ims_stock_transfer_details','ims_stock_transfer_id','product_id')->withPivot('ims_stock_transfer_detail_id','quantity','created_at','updated_at');
    }


    public function stockTransferBy(): BelongsTo
    {
        return $this->belongsTo(User::class,'employee_id','user_id');
    }
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class,'created_by','user_id');
    }
    public function transferFrom(): BelongsTo
    {
        return $this->belongsTo(PurWarehouse::class,'transfer_from','warehouse_id');
    }
    public function transferTo(): BelongsTo
    {
        return $this->belongsTo(PurWarehouse::class,'transfer_to','warehouse_id');
    }
}

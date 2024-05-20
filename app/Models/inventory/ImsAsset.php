<?php

namespace App\Models\inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use  App\Models\purchase\PurWarehouse;

class ImsAsset extends Model
{
    use HasFactory;
    protected $table="ims_assets";
    protected $primaryKey="ims_asset_id";
    protected $fillable=[
        'company_id',
        'warehouse_id',
        'name',
        'qty',
        'barcode',
        'qr_code',
        'barcode_string',
        'qr_code_string',
        'description'
    ];


    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(PurWarehouse::class,'warehouse_id','warehouse_id');
    }







}

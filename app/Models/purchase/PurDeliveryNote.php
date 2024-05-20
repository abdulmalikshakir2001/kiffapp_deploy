<?php

namespace App\Models\purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\purchase\PurDeliveryNoteDetail;
use App\Models\product\ProProduct;

class PurDeliveryNote extends Model
{
    use HasFactory;
    protected $table="pur_delivery_notes";
    protected $primaryKey="pur_delivery_note_id";
    protected $fillable=[
'company_id',
'supplier_id',
'pur_order_id',
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
        return $this->hasMany(PurDeliveryNoteDetail::class,'pur_delivery_note_id','pur_delivery_note_id');
    }
    public function products(){
    return $this->belongsToMany(ProProduct::class,'pur_delivery_note_details','pur_delivery_note_id','product_id')->withPivot('pur_delivery_note_detail_id','quantity','created_at','updated_at');
    }
}

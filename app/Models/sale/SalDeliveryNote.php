<?php

namespace App\Models\sale;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\sale\SalDeliveryNoteDetail;
use App\Models\product\ProProduct;

class SalDeliveryNote extends Model
{
    use HasFactory;
    protected $table="sal_delivery_notes";
    protected $primaryKey="sal_delivery_note_id";
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
        return $this->hasMany(SalDeliveryNoteDetail::class,'sal_delivery_note_id','sal_delivery_note_id');
    }
    public function products(){
    return $this->belongsToMany(ProProduct::class,'sal_delivery_note_details','sal_delivery_note_id','product_id')->withPivot('sal_delivery_note_detail_id','quantity','created_at','updated_at');
    }
}

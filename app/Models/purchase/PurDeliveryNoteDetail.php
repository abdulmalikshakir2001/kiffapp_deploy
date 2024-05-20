<?php

namespace App\Models\purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurDeliveryNoteDetail extends Model
{
    use HasFactory;

    protected $table="pur_delivery_note_details";
    protected $primaryKey="pur_delivery_note_detail_id";
    protected $fillable=[
'pur_delivery_note_id',
'product_id',
'quantity',
    ];
}

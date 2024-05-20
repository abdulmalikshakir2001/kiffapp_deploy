<?php

namespace App\Models\sale;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalReturnDetail extends Model
{
    use HasFactory;
    protected $table="sal_return_details";
    protected $primaryKey="sal_return_detail_id";
    protected $fillable=[
'sal_return_id',
'product_id',
'quantity',
    ];
}

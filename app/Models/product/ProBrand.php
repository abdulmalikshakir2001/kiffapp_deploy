<?php

namespace App\Models\product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProBrand extends Model
{
    use HasFactory;
    protected $table="pro_brands";
    protected $primaryKey="brand_id";
    protected $fillable=[
        
'company_id',
'brand_name',
'description',
'active',
    ];
}

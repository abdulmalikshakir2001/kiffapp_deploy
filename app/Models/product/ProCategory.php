<?php

namespace App\Models\product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProCategory extends Model
{
    use HasFactory;
    protected $table="pro_categories";
    protected $primaryKey="category_id";
    protected $fillable=[
        
'company_id',
'category_name',
'description',
'parent',
'active',
    ];
}

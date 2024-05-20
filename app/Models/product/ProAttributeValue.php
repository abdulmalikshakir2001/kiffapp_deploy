<?php

namespace App\Models\product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProAttributeValue extends Model
{
    use HasFactory;
    protected $table="pro_attribute_values";
    protected $primaryKey="attribute_value_id";
    protected $fillable=[
        
'company_id',
'attribute_id',
'name',
'description',
'active'
];
}

<?php

namespace App\Models\product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProAttribute extends Model
{
    use HasFactory;
    protected $table="pro_attributes";
    protected $primaryKey="attribute_id";
    protected $fillable=[
        
'company_id',
'name',
'description',
'active'
];
}

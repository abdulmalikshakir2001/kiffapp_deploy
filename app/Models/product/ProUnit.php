<?php

namespace App\Models\product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProUnit extends Model
{
    use HasFactory;

    protected $table="pro_units";
    protected $primaryKey="unit_id";
    protected $fillable=[
        
'company_id',
'unit_name',
'description',
'active',
    ];
}

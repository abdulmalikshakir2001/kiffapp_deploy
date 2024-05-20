<?php

namespace App\Models\product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProTax extends Model
{
    use HasFactory;

    protected $table="pro_taxes";
    protected $primaryKey="tax_id";
    protected $fillable=[
        
'company_id',
'tax_name',
'percentage',
'rules',
'description',
'active',
    ];
}

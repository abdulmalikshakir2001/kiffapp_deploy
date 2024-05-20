<?php

namespace App\Models\product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProWarrenty extends Model
{
    use HasFactory;
    protected $table="pro_warrenties";
    protected $primaryKey="warrenty_id";
    protected $fillable=[
        
'company_id',
'product_id',
'warrenty_name',
'duration',
'duration_time',
'description',
    ];
}

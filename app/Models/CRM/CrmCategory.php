<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrmCategory extends Model
{
    use HasFactory;
    protected $table="crm_categories";
    protected $primaryKey="category_id";
    protected $fillable=[
        
'company_id',
'category_name',
    ];
}

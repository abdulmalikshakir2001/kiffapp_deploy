<?php

namespace App\Models\account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccCostCenter extends Model
{
    use HasFactory;
    protected $table="acc_cost_centers";
    protected $primaryKey="acc_cost_center_id";
    protected $fillable=[
        'company_id',
        'name',
        'description',
    ];
}

<?php

namespace App\Models\account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccControlCode extends Model
{
    use HasFactory;
    protected $table="acc_control_codes";
    protected $primaryKey="acc_control_code_id";
    protected $fillable=[
        'company_id',
        'control_code',
        'description',
    ];
}

<?php

namespace App\Models\HRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkShift extends Model
{
    use HasFactory;
    protected $table="work_shifts";
    protected $primaryKey="work_shift_id";
    protected $fillable=[
        
'company_id',
'shift_name',
'compromize_time',
'start_time',
'end_time',
    ];
}

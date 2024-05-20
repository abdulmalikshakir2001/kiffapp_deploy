<?php

namespace App\Models\HRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicHoliday extends Model
{
    use HasFactory;
    protected $table="public_holidays";
    protected $primaryKey="public_holiday_id";
    protected $fillable=[
        
'company_id',
'holiday_name',
'start_date',
'end_date',
    ];
}

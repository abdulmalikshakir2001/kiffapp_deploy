<?php

namespace App\Models\HRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLeave extends Model
{
    use HasFactory;

    protected $table="employee_leaves";
    protected $primaryKey="employee_leave_id";
    protected $fillable=[
        
'user_id',
'leave_type_id',
'company_id',
'start_date',
'end_date',
'is_paid',
'approval_status'

    ];
}

<?php

namespace App\Models\HRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmPayroll extends Model
{
    use HasFactory;
    protected $table="hrm_payrolls";
    protected $primaryKey="payroll_id";
    protected $fillable=[
'company_id',
'user_id',
'salary_month',
'attendences',
'absenties',
'absenties',
'basic_salary',
'overtime_hours',
'overtime_amount',
'allownces',
'deductions',
'net_payable',
'payment_status',
    ];

    public function users(){
        return $this->hasMany('App\Models\Users\User','user_id','user_id');
    }
}

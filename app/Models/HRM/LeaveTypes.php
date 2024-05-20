<?php

namespace App\Models\HRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveTypes extends Model
{
    use HasFactory;
    protected $table='leave_types';
    protected $primaryKey='leave_type_id';

    protected $fillabe=[
        'leave_type_id',
        'leave_type',
        'is_paid'

    ];
    public function user_id_emp_leave(){
        return $this->belongsToMany('App\Models\Users\User','employee_leaves','leave_type_id','user_id');
    }
}

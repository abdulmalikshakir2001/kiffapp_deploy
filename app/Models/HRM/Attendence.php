<?php

namespace App\Models\HRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendence extends Model
{
    //   late  early_leave overtime
    use HasFactory;
    protected $table="attendences";
    protected $primaryKey="attendence_id";
    protected $fillable=[
'company_id',
'user_id',
'date',
'start_time',
'end_time'
    ];

    public function users(){
        return $this->hasMany('App\Models\Users\User','user_id','user_id');
    }
}

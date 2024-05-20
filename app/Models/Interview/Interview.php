<?php

namespace App\Models\Interview;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    use HasFactory;
    protected $table='interviews';
    protected $primaryKey='interview_id';
    protected $fillable=[
        'user_id',
        'job_vacancy_id',
        'interview_date',
        'company_id',
        
    ];
    
}

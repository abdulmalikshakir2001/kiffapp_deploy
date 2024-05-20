<?php

namespace App\Models\JobVacancy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobVacancy extends Model
{
    use HasFactory;
    protected $table="job_vacancies";
    protected $primaryKey="job_vacancy_id";
    protected $fillable=[
        'vacancy_code',
        'vacancy_name',
        'no_of_vacancy',
        'description',
        'vacancy_status',
        'company_id',
        'publish_date',
        'end_date',
    ];
    public $timestamps = false;

    public function users(){
        // return $this->belongsToMany('App\Models\Users\User');
        return $this->belongsToMany('App\Models\Users\User','applied_candidates','job_vacancy_id','user_id');
    }
    public function users_interview(){
        // return $this->belongsToMany('App\Models\Users\User');
        return $this->belongsToMany('App\Models\Users\User','interviews','job_vacancy_id','user_id');
    }
}

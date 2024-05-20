<?php

namespace App\Models\JobVacancy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppliedCandidate extends Model
{
    use HasFactory;
    protected $table="applied_candidates";
    protected $primaryKey="applied_candidate_id";
    protected $fillable=[
        'user_id',
        'job_vacancy_id',
        'company_id',
        'employee_cv'
    ];
}

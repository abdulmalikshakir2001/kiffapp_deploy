<?php

namespace App\Models\Users;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use App\Models\purchase\PurPurchaseQuotationDetail;
use App\Models\purchase\PurPurchaseQuotation;
use App\Support\Address;
use Illuminate\Database\Eloquent\Casts\Attribute;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected  $table = "users";
    protected  $primaryKey = "user_id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'first_name',
        'middle_names',
        'last_name',
        'mobile_number',
        'dob',
        'gender',
        'blood_group',
        'marital_status',
        'address',
        'zip_code',
        'city',
        'state',
        'landmark',
        'country_id',
        'profile_logo',
        'phone_number',
        'employee_no',
        'employee_cv',
        'tax_number',
        'credit_limit',
        'bank_details',
        'custom_field_1',
        'custom_field_2',
        'custom_field_3',
        'custom_field_4',
        'custom_field_5',
        'custom_field_6',
        'custom_field_7',
        'custom_field_8',
        'custom_field_9',
        'custom_field_10',
        'fb_link',
        'twitter_link',
        'social_media_1',
        'social_media_2',
        'social_media_3',
        'social_media_4',
        'position_id',
        'department_id',
        'company_id',
        'work_shift_id',
        'warehouse_id',
        'basic_salary',
        'food_allownce',
        'medical_allownce',
        'transport_allownce',
        'other_allownces',

        'user_type',
        'ui_language',
        
        'is_active',
        'allow_login',
    ];

    
    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function job_vacancies(){
        return $this->belongsToMany('App\Models\JobVacancy\JobVacancy','applied_candidates','user_id','job_vacancy_id');
    }
    public function job_vacancies_interview(){
        return $this->belongsToMany('App\Models\JobVacancy\JobVacancy','interviews','user_id','job_vacancy_id');
    }
    public function leave_type_id_emp_leave(){
        return $this->belongsToMany('App\Models\HRM\LeaveTypes','employee_leaves','user_id','leave_type_id');
    }


      public function purchaseQuotation(): HasOneThrough
    {
        return $this->hasOneThrough(PurPurchaseQuotationDetail::class, PurPurchaseQuotation::class,'supplier_id','pur_quotation_id','user_id','pur_quotation_id');
    }

    // protected function username(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn (string $value) => 'changed',
    //     );
    // }


    
    
    



}

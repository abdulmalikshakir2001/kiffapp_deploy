<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrmSchedulePhoneCall extends Model
{
    use HasFactory;
    protected $table="crm_schedule_phone_calls";
    protected $primaryKey="schedule_phone_call_id";
    protected $fillable=[
'company_id',
'contact_id',
'category_id',
'lead_id',
'priority',
'date',
'oppertunity_id',
'duration',
'priority',
'responsible',
'call_summary',
'remarks'

    ];
}

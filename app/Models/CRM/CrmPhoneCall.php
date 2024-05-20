<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrmPhoneCall extends Model
{
    use HasFactory;
    protected $table="crm_phone_calls";
    protected $primaryKey="phone_call_id";
    protected $fillable=[
'phone_call_id',
'company_id',
'contact_id',
'lead_id',
'date',
'duration',
'call_summary',
'remarks'
    ];
    
}

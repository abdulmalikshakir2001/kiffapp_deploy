<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrmLead extends Model
{
    use HasFactory;
    protected $table="crm_leads";
    protected $primaryKey="lead_id";
    protected $fillable=[
        
'company_id',
'subject',
'contact_id',
'employee_id',
'category_id',
'created_by',
'priority',
'lead_reffered_by',
'remarks',
'internal_notes',
'external_info',
'creation_date'
    ];
}

<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrmOppertunity extends Model
{
    use HasFactory;
    protected $table="crm_oppertunities";
    protected $primaryKey="oppertunity_id";
    protected $fillable=[
        
'company_id',
'subject',
'contact_id',
'employee_id',
'category_id',
'lead_id',
'expected_revenue',
'priority',
'lead_reffered_by',
'next_action_remarks',
'next_action_date',
'next_action_closing_date',
'internal_notes',
    ];
}

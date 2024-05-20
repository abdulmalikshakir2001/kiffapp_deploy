<?php

namespace App\Models\account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccFiscalPeriod extends Model
{
    use HasFactory;
    protected $table="acc_fiscal_periods";
    protected $primaryKey="acc_fiscal_period_id";
    protected $fillable=[
        'company_id',
        'name',
        'start_date',
        'end_date',
        'status'

    ];
}

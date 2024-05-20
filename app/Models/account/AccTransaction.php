<?php

namespace App\Models\account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AccTransaction extends Model
{
    use HasFactory;
    protected $table="acc_transactions";
    protected $primaryKey="acc_transaction_id";
    protected $fillable=[
'company_id',
'fiscal_period_id',
'cost_center_id',
'control_code_id',
'currency_id',
'tax_id',
'date',
'status',
'description',
'exchange_rate',
        
    ];


    public function costCenter(): BelongsTo
    {
        return $this->belongsTo(AccCostCenter::class,'cost_center_id','acc_cost_center_id');
    }
    public function fiscalPeriod(): BelongsTo
    {
        return $this->belongsTo(AccFiscalPeriod::class,'fiscal_period_id','acc_fiscal_period_id');
    }
    public function controlCode(): BelongsTo
    {
        return $this->belongsTo(AccControlCode::class,'control_code_id','acc_control_code_id');
    }
    public function currency(): BelongsTo
    {
        return $this->belongsTo(AccCurrency::class,'currency_id','acc_currency_id');
    }



    public function journalEntries(): HasMany
    {
        return $this->hasMany(AccJournalEntries::class,'transaction_id','acc_transaction_id');
    }








    
}

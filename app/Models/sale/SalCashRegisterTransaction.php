<?php

namespace App\Models\sale;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\sale\SalInvoice;

class SalCashRegisterTransaction extends Model
{
    use HasFactory;
    protected $table = "sal_cash_register_transactions";
    protected $primaryKey = "id";
    protected $fillable = [
        'cash_register_id',
        'amount',
        'pay_method',
        'type',
        'transaction_type',
        'transaction_id',
    ];

    public function invoice(): HasOne
    {
        return $this->hasOne(SalInvoice::class,'sal_invoice_id','transaction_id');
    }
}

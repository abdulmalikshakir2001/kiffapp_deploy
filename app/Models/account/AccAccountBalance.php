<?php

namespace App\Models\account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\account\AccAccount;

class AccAccountBalance extends Model
{
    use HasFactory;
    protected $table="acc_account_balances";
    protected $primaryKey="acc_account_balance_id";
    protected $fillable=[
        'company_id',
        'account_id',
        'balance',
    ];
    public function account(): BelongsTo
    {
        return $this->belongsTo(AccAccount::class,'account_id','acc_account_id');
    }

}

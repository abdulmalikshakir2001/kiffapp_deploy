<?php

namespace App\Models\account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\account\AccFamily;
use App\Models\account\AccAccountBalance;
use Illuminate\Database\Eloquent\Relations\HasOne;


class AccAccount extends Model
{
    use HasFactory;

    protected $table="acc_accounts";
    protected $primaryKey="acc_account_id";
    protected $fillable=[
        'company_id',
        'name',
        'code',
        'type',
        'opening_balance',

        'remarks',
    ];

    public function accountType(): BelongsTo
    {
        return $this->belongsTo(AccFamily::class,'type','family_code');
    }

    public function balance(): HasOne
    {
        return $this->hasOne(AccAccountBalance::class,'account_id','acc_account_id');
    }
    
}

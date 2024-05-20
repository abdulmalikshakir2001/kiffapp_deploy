<?php

namespace App\Models\account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccCurrency extends Model
{
    use HasFactory;
    protected $table="acc_currencies";
    protected $primaryKey="acc_currency_id";
    protected $fillable=[
        'company_id',
        'currency_code',
        'name',
        'is_default',
        'exchange_rate',
    ];
}

<?php

namespace App\Models\account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccTransactionCategory extends Model
{
    use HasFactory;
    protected $table="acc_transaction_categories";
    protected $primaryKey="acc_transaction_category_id";
    protected $fillable=[
        'company_id',
        'name',
        'description',
    ];
}

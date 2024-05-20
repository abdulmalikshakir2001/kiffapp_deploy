<?php

namespace App\Models\account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccJournalEntries extends Model
{
    use HasFactory;
    protected $table="acc_journal_entries";
    protected $primaryKey="acc_journal_entry_id";
    protected $fillable=[
        'company_id',
        'transaction_id',
        'account_id',
        'debit',
        'credit',
        'foreign_currency_amount'
        
    ];




    
}

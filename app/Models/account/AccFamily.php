<?php

namespace App\Models\account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccFamily extends Model
{
    use HasFactory;
    protected $table="acc_families";
    protected $primaryKey="acc_family_id";
    protected $fillable=[
        'family_code',
        'family_name',

    ];
}

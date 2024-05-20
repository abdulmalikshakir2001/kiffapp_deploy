<?php

namespace App\Models\AppSettings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppSetting extends Model
{
    use HasFactory;

    protected $table="app_settings";
    protected $fillable=[
        'app_logo'

    ];
}
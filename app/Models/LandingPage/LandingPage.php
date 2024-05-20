<?php

namespace App\Models\LandingPage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandingPage extends Model
{
    use HasFactory;
    protected  $table = "landing_pages";
    protected  $primaryKey = "id";
    protected $fillable=[
        'header',
        'main_content',
        'footer',
        'unique_url',
        'unique_url_code',
        'company_id',
        'product_template'
    ];

}

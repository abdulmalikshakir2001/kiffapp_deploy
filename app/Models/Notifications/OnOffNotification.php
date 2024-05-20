<?php

namespace App\Models\Notifications;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnOffNotification extends Model
{
    use HasFactory;
    protected  $table = "on_off_notifications";
    protected  $primaryKey = "id";
    protected $fillable=[
        'notification_name',
        'status'

    ];

}

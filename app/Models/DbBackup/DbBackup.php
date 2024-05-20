<?php

namespace App\Models\DbBackup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DbBackup extends Model
{
    use HasFactory;
    protected  $table = "db_backups";
    protected  $primaryKey = "db_backup_id";
    protected $fillable=[
        'db_backup_files'
    ];




}

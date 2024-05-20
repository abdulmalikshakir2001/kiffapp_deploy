<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersGroups extends Model
{
    use HasFactory;
    protected  $table = "users_groups";
    protected  $primaryKey = "group_id";
}

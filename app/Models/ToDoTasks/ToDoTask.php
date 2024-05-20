<?php

namespace App\Models\ToDoTasks;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToDoTask extends Model
{
    use HasFactory;
    protected  $table = "to_do_tasks";
    protected  $primaryKey = "to_do_task_id";
    protected $fillable=[
        'task_name',
        'task_description',
        'user_id'
    ];


}

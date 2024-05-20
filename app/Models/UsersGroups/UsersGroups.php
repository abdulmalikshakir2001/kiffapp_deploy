<?php

namespace App\Models\UsersGroups;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UsersGroups extends Model
{
    use HasFactory;
    // insert companies positions
    public function insertUsersGroups($users_groups_data){
        $users_groups_inserted= DB::insert('insert into users_groups (group_name,company_id) values(?,?)',
        [
            $users_groups_data['group_name'],
            // $users_groups_data['permissions'],
            $users_groups_data['company_id'],
        ]
    );
        if($users_groups_inserted){
            return true;
        }
        else{
            return false;
        }
    }
    // delete companies positions
    public function deleteUsersGroups($users_groups_data){
        $users_groups_deleted= DB::table('users_groups')->where('group_id',$users_groups_data['delete_users_groups_id'])->delete();
        if($users_groups_deleted){
            return true;
        }
        else{
            return false;
        }
    }
       // update users groups 
       public function updateUsersGroups($users_groups_data){
        $users_groups_updated= DB::update('update  users_groups set group_name=?,company_id=? where group_id=?',
        [
            $users_groups_data['group_name'],
            // $users_groups_data['permissions'],
            $users_groups_data['company_id'],
            $users_groups_data['group_id']
        ]
    );
        if($users_groups_updated){
            return true;
        }
        else{
            return false;
        }
    }
    
}

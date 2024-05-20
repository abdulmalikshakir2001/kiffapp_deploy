<?php

namespace App\Models\UsersPermissions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UsersPermissions extends Model
{
    use HasFactory;
    // insert companies positions
    public function insertUsersPermissions($users_permissions_data){
        $users_permissions_inserted= DB::insert('insert into users_permissions (app_module_name,permission_name) values(?,?)',[$users_permissions_data['app_module_name'],$users_permissions_data['permission_name']]);
        if($users_permissions_inserted){
            return true;
        }
        else{
            return false;
        }
    }
    // delete companies positions
    public function deleteUsersPermissions($users_permissions_data){
        $users_permissions_deleted= DB::table('users_permissions')->where('permission_id',$users_permissions_data['delete_users_permissions_id'])->delete();
        if($users_permissions_deleted){
            return true;
        }
        else{
            return false;
        }
    }
       // insert companies positions
       public function updateUsersPermissions($users_permissions_data){
        $users_permissions_updated= DB::update('update  users_permissions set app_module_name=?,permission_name=? where permission_id=?',[$users_permissions_data['app_module_name'],$users_permissions_data['permission_name'],$users_permissions_data['permission_id']]);
        if($users_permissions_updated){
            return true;
        }
        else{
            return false;
        }
    }
    // getting permission for auth user by user_id throurh users_groups

    public function getPermissionsForAuthUser($user_id){
        $query= DB::table('users_groups_assigned')->where('user_id',$user_id)->get()->first();
        if($query!=null){
        $groups_arr= explode(',', $query->groups);
        $all_per_for_users=[];
        foreach($groups_arr as $group){
            $all_groups_per=   DB::table('users_groups')->where('group_name',$group)->get();
            foreach($all_groups_per as $group){
                $all_per_for_users[]=explode( ',',$group->permissions);
            }
        }
       $users_permissions= call_user_func_array('array_merge', $all_per_for_users);
       foreach($users_permissions as $key=>$value){
           if(is_null($value) || $value==''){
               unset($users_permissions[$key]);
               
            }
        }
        return array_unique($users_permissions);
    }
    }
    
}
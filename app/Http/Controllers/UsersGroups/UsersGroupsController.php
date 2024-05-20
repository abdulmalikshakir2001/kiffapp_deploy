<?php

namespace App\Http\Controllers\UsersGroups;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UsersGroups\UsersGroups;
use App\View\Components\Input;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Support\Facades\DB;

class UsersGroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function users_groups_edit_per(Request $request){
        $group_permission_for_edit= DB::table('users_groups')->where('group_id',$request->group_id)->get()->first();
        return response()->json($group_permission_for_edit);

    }
    public function index(Request $request)
    {
        
        //
        $data['title']='Users Groups';
        $data['navbar_headings']='Users Groups';
        $users_permissions= DB::table('users_permissions')->get();
        // $users_groups_permissions= DB::table('users_groups')->select('permission')->get();
        $data['users_permissions']=$users_permissions;
        // if(session()->has('company')){

        // }else{

        // }
        return view('users_groups/view_users_groups',$data);
    }
    public function getData(Request $request)
    
    {
        if(session()->get('user_id')==1){
            $users_groups =  DB::table('users_groups')->whereNotIn('group_id',[1,2])->get();

        }
        else{
            $users_groups =  DB::table('users_groups')->where('company_id',session()->get('company_id'))->orWhere('company_id',1)->whereNotIn('group_id',[1,2])->get();
        }
                $allData = DataTables::of($users_groups)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $dis=$row->group_name == "AppAdministrators" || $row->group_name == "BusinessAdministrator"  ? "d-none" :"";
                        // hide defalut group edit,del,permision button from users
                        if(session()->get('user_id')==1){
                        $show_hide= session()->get('user_id') == '1'  ? 'show' :'d-none';
                        }
                        else{
                            $show_hide= session()->get('user_id') != '1'  && $row->group_name!="everyone"   ? 'show' :'d-none';

                        }
                        $btn =
                            '<button type="button" class="text-secondary '.$show_hide.'  users_groups_delete_btn bg-white"  style="border:none;" data-delete_users_groups_id="' . $row->group_id . '"  data-bs-toggle="modal" data-bs-target="#delete_confirm_users_groups" ><i class="fas fa-trash-alt fs-6 text-danger"></i>
                </button><button class="text-secondary users_groups_edit_btn '.$show_hide.' bg-white" data-bs-toggle="" data-bs-target="" style="border: none;" data-update_users_groups_id="' . $row->group_id . '" >
                        <a href="#"> <i class="fas fa-edit fs-6 text-success ">
                        </i>
                        </a>
                    </button>
                    <button  class="btn btn-sm bg-primary users_groups_permissions '.$show_hide.' mb-0 '.$dis.'" data-bs-toggle="modal" data-bs-target="#users_groups_permissions" style="border: none;" data-groups_id_for_per="' . $row->group_id . '" data-group_name_for_permission="'.$row->group_name.'">
                        <a href="javacript:void"> <span class="text-white">Permissions</span>
                        </a>
                    </button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
                return $allData;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $data['title']='Users Groups';
        $data['navbar_headings']='Users Groups';
        $data['all_companies']= DB::table('companies')->get();
        // if($request->session()->has('company_id')) {
        //     $data['companies']= DB::table('companies')->where('company_id',$request->session()->get('company_id'))->get()->first();
        // }
        return view('users_groups/create_users_groups',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'group_name' => 'required',
        ]);
        // $request['company_id']=session()->get('company_id');
        
        $users_groups_tbl= new UsersGroups();
          $users_groups_tbl->insertUsersGroups($request->all());
        if($users_groups_tbl){
            return response()->json(true);
        }
        else{
            return response()->json(false);
        }

        
    }


    

    


    public function deleteUsersGroups(Request $request){
        $users_groups_tbl= new UsersGroups();
         $users_groups_deleted=$users_groups_tbl->deleteUsersgroups($request->all());
         if($users_groups_deleted){
            return response()->json(true);
         }
         else{
            return response()->json(false);

         }
        
        


    }
    public function updateUsersGroupsForm(Request $request){
        $group_id= $request->update_users_groups_id;
    $single_users_groups_query=  DB::table('users_groups')
    ->select('*')
    ->where('group_id','=',$group_id)
    ->get();
    $data['single_users_groups']=$single_users_groups_query->first();
        $data['title']='Update  Users Groups';
        $data['navbar_headings']='Update Users Groups';
        $data['all_companies']= DB::table('companies')->get();
        return view('users_groups/update_users_groups',$data);
    }
    public function updateUsersGroups(Request $request){
        $request->validate([
            'group_name' => 'required',
        ]);
        // $request['company_id']=session()->get('company_id');
        $users_groups_tbl= new UsersGroups();
         $users_groups_updated=  $users_groups_tbl->updateUsersGroups($request->all());
        if($users_groups_updated){
            return response()->json(true);
        }
        else{
            return response()->json(false);
        }


    }

    // assignPermissionsToGroup
    public function assignPermissionsToGroup(Request $request){
        // return response()->json($request->all());
        $permissions_key_exist=array_key_exists('permissions',$request->all());
        $permission_string=NULL;
if($permissions_key_exist){

    $permission_string= implode(",", $request->permissions);
}
else{
    $permission_string=NULL;

}

        $request['permissions']=$permission_string;
        unset($request['_token']);
        $per_updated_for_group= DB::table('users_groups')->where('group_id',$request->group_id)->update($request->all());
        return response()->json($per_updated_for_group);
    }
    


}

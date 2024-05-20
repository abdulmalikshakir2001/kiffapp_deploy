<?php

namespace App\Http\Controllers\UsersPermissions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UsersPermissions\UsersPermissions;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Support\Facades\DB;

class UsersPermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title']='All Users Permissions';
        $data['navbar_headings']='All Users Permissions';
        return view('users_permissions/view_users_permissions',$data);
    }
    public function getData(Request $request)
    
    {
        $users_permissions =  DB::table('users_permissions')->get();
                $allData = DataTables::of($users_permissions)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn =
                            '<button type="button" class="text-secondary users_permissions_delete_btn bg-white"  style="border:none;" data-delete_users_permissions_id="' . $row->permission_id . '"  data-bs-toggle="modal" data-bs-target="#delete_confirm_users_permissions"><i class="fas fa-trash-alt fs-6 text-danger"></i>
                </button><button class="text-secondary users_permissions_edit_btn bg-white" data-bs-toggle="" data-bs-target="" style="border: none;" data-update_users_permissions_id="' . $row->permission_id . '">
                        <a href="#"> <i class="fas fa-edit fs-6 text-success ">
                        </i>
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
    public function create()
    {
        //
        $data['title']='Users Permissions';
        $data['navbar_headings']='Users Permissions';
        return view('users_permissions/create_users_permissions',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'app_module_name' => 'required',
        ]);
        $users_permissions_tbl= new UsersPermissions();
          $users_permissions_tbl->insertUsersPermissions($request->all());
        if($users_permissions_tbl){
            return response()->json(true);
        }
        else{
            return response()->json(false);
        }

        
    }


    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)

    {

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function deleteUsersPermissions(Request $request){
        $users_permissions_tbl= new UsersPermissions();
         $users_permissions_deleted=$users_permissions_tbl->deleteUsersPermissions($request->all());
         if($users_permissions_deleted){
            return response()->json(true);
         }
         else{
            return response()->json(false);

         }
        
        


    }
    public function updateUsersPermissionsForm(Request $request){
        $users_permissions_id= $request->update_users_permissions_id;
    $single_users_permissions_query=  DB::table('users_permissions')
    ->select('*')
    ->where('permission_id','=',$users_permissions_id)
    ->get();
    $data['single_users_permissions']=$single_users_permissions_query->first();
        $data['title']='Update  Users Permissions';
        $data['navbar_headings']='Update Users Permissions';
        return view('users_permissions/update_users_permissions',$data);
    }
    public function updateUsersPermissions(Request $request){
        $request->validate([
            'app_module_name' => 'required',
        ]);
        $users_permissions_tbl= new UsersPermissions();
         $users_permissions_updated=  $users_permissions_tbl->UpdateusersPermissions($request->all());
        if($users_permissions_updated){
            return response()->json(true);
        }
        else{
            return response()->json(false);
        }


    }

    public function per(){
        $per_tbl= new UsersPermissions();
        $user_two_per= $per_tbl->getPermissionsForAuthUser('2');
        return formatArray($user_two_per);
        // foreach($user_two_per as $group){
        //     echo $group;
        // }

        

    }

}

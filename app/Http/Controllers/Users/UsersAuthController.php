<?php

namespace App\Http\Controllers\Users;
use App\Http\Controllers\Controller;
use App\Models\UsersPermissions\UsersPermissions;

use Illuminate\Http\Request;
// login start 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Users\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Notifications\NewRegisterUser;
use App\Notifications\LoggedIn;
use Illuminate\Support\Facades\Notification;
use App\Models\DefaultAssignToUser;
// use Session;
// login end

class UsersAuthController extends Controller
{
    

    public function register()
    {
        //
        // formatArray(Config::get('languages')) ;
        // formatArray(Config::get('languages')[App::getLocale()]['display']) ;
        return view('dashboard.users.login.register');
    }

    public function login()
    {
        //
        return view('dashboard.users.login.login');
    }



    public function logout(Request $request)
    {
        //Destroy Login Session
        session()->forget('user_id');
        session()->forget('user_type');
        session()->flush();
        Auth::logout();
        return redirect('login');
    }

    // public function register()
    // {
    //     if (!Auth::check() || Auth::user()->id !== 1)
    //     return redirect('/');
    //     return view('auth.register');
    // }

    public function authenticate(Request $request)
    {
         $request->validate([
            
            'username' => 'required|max:255',
            'password' => 'required',
        ]);
        
        $credentials=$request->only('username','password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            //Set Authenticated User Details in Session
             
            session()->put('user_id', Auth::getUser()->user_id);
            session()->put('user_fullname', Auth::getUser()->first_name.' '. Auth::getUser()->last_name);
            session()->put('company_id',Auth::getUser()->company_id);
            session()->put('user_type', Auth::getUser()->user_type);
            session()->put('IsAppAdmin', true);
            if( Auth::getUser()->allow_login==1 && Auth::getUser()->is_active==1 ){
                
                $permissions_tbl= new UsersPermissions();
                $users_permissions_all=$permissions_tbl->getPermissionsForAuthUser(Auth::getUser()->user_id);
                session()->put('users_permissions_all',$users_permissions_all);
                return json_encode('allow_active_is_1');
            }
             else{
                return json_encode('allow_active_is_not_1');
             }
        }else{
            return json_encode(false) ;
        }
    }// ./authenticate()
    public function registerUser(Request $request){
        $default_assign_to_user= new DefaultAssignToUser();


        $request->validate([
            'username'=>'required|unique:users',
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required|email|unique:users',
            'contact'=>'required|max:15',
            'password'=>'required|confirmed'
        ]);
        // $user= new User();
        // $data=$request->all();


        $user_created= DB::table('users')->insertGetId([
            'username' =>$request->post('username'),
            'first_name' =>$request->post('first_name'),
            'last_name' =>$request->post('last_name'),
            'email' =>$request->post('email'),
            'mobile_number'=>$request->post('contact'),
            'password'=>Hash::make($request->post('password')),
            'is_active'=>'1',
            'allow_login'=>'1',
            'user_type'=>'Owner'

        ]);
        // send notification for registere in the system start 
        $register=[
            'message'=>"Your account and company created at zaratica.erp as : {$request->post('username')}",
            'user_id'=> $user_created

        ];
        $logged_in=[
            'message'=>"Your logged in as : {$request->post('username')}",
            'user_id'=> $user_created

        ];


        $notify_user= User::where('user_id',$user_created)->get()->first();
        // allow notificatin if the status is 1
         $notif_name_create_user= DB::table('on_off_notifications')->where('notification_name','Create User')->get()->first();
         if($notif_name_create_user->status=='1'){
             Notification::send($notify_user,new NewRegisterUser($register));
            }
         $notif_name_logged_in= DB::table('on_off_notifications')->where('notification_name','Logged in')->get()->first();
         if($notif_name_logged_in->status=='1'){
        Notification::send($notify_user,new LoggedIn($logged_in));
         }


        // send notification for registere in the system end

        
        // session()->flash('status','Account created successfully');
        Session::flash('status','Account created successfully');
        if($user_created){
            
            // send notification for registere in the system end 
            // putting values in id , name column for messenger start 
            DB::table('users')->where('user_id',$user_created)->update(['id'=>$user_created,'name'=>$request->post('username')]);
            $default_assign_to_user->assgin_default_groups_to_user($user_created);
            
            $company_for_user=[
                'company_name' =>$request->post('username'),
                'country_id'=>'1',
            ];
            $last_company_created= DB::table('companies')->insertGetId($company_for_user);
            $default_assign_to_user->create_landing_page($last_company_created);
            $default_assign_to_user->assign_subscription_to_user($last_company_created);
            $default_assign_to_user->assign_work_shifts_to_company($last_company_created);
            $default_assign_to_user->assignDefaultWarehouseAndStock($last_company_created);
            $default_assign_to_user->assignWalkInCustomer($last_company_created);
            User::where('user_id',$user_created)->update(['company_id'=>$last_company_created]);
            return response()->json(true);
        }
        else{
            return response()->json(false);


        }
    }
    // check exist user name 
    public function isExistUserName(Request $request){
     $exist_user=  User::where('username',$request->username)->first();
    //  echo json_encode($exist_user);
     if($exist_user){
        echo 'false';
     }
     else{
        echo 'true';
     }
    }
    // check user name for update 
    public function isExistUserNameForUpdate(Request $request){
     $exist_user=  User::where('user_id','!=',$request->user_id)->where('username',$request->username)->get()->count();
       //  echo json_encode($exist_user);
        if($exist_user >=1){
           echo 'false';
        }
        else{
           echo 'true';
        }
       }
    // check user name for update 
    public function isExistEmailForUpdate(Request $request){
     $exist_user=  User::where('user_id','!=',$request->user_id)->where('email',$request->email)->get()->count();
       //  echo json_encode($exist_user);
        if($exist_user >=1){
           echo 'false';
        }
        else{
           echo 'true';
        }
       }

    // check exist email
    public function isExistEmail(Request $request){
        $exist_email=  User::where('email',$request->email)->first();
       //  echo json_encode($exist_user);
        if($exist_email){
           echo 'false';
        }
        else{
           echo 'true';
        }
       }
    //    delete user via ajax start 
    public function deleteUser(Request $request){
        // return response()->json($request->delete_user_id);
        $deleted_user= User::where('user_id',$request->delete_user_id)->delete();
        return response()->json($deleted_user);


    }


    //    delete user via ajax delete  
    // register job candidate start 
    public function register_job_cand(Request $request){

        $request->validate([
            'username' => 'required|max:255|unique:users',
            'password' => 'required|confirmed',
            'email'=>'required|unique:users',
            'phone_number'=>'required'
        ]);
        $password=$request->password;
        $request['password']=Hash::make($request->password);
        $request['is_active']='1';
        $request['allow_login']='1';
        $request['user_type']='JobCandidate';
        $job_candidate_register= User::create($request->all());
        if($job_candidate_register){
            $request['password']=$password;

            $res_from_auth= $this->authenticate($request) ;
            if($res_from_auth){
                session()->flash('status','Please upload Your Resume in pdf or docx format');
                return response()->json('allow_active_is_1');
            }
        }
        else{

        }

    }

    // register job candidate end 
    
    

}// ./class UsersAuthController

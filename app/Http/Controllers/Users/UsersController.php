<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Users\UsersAuthController;

use App\Http\Controllers\Controller;
use App\Models\Users\User;
use App\Models\Users\Users;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\URL;

class UsersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $data['title'] = 'All Users';
        $data['navbar_headings'] = 'All Users';
        if (session()->get('user_id') == 1) {
            $data['users_groups'] = DB::table('users_groups')->whereNotIn('group_id', [1, 2])->get();
        } else {
            $data['users_groups'] = DB::table('users_groups')->where(
                'company_id',
                '=',
                session()->get('company_id')
            )->orWhere('company_id', 1)->whereNotIn('group_id', [1, 2])->get();
        }

        return view('dashboard/users/view_user', $data);
    }
    public function getData(Request $request)
    {
        if (session()->has('user_id')) {
            if (session()->get('company_id') == 1) {
                $users = DB::table('users')->select('users.user_type', 'users.user_id', 'users.username', 'users.email', 'users.phone_number', 'users.gender', 'companies.company_name')->join('companies', 'users.company_id', '=', 'companies.company_id')->get();
            } else {
                $users = DB::table('users')
                    ->select('users.user_type', 'users.user_id', 'users.username', 'users.email', 'users.phone_number', 'users.gender', 'companies.company_name')->join('companies', function ($join) {
                        $join->on('users.company_id', '=', 'companies.company_id')->where('companies.company_id', '=', session()->get('company_id'));
                    })
                    ->get();
            }
        }

        $allData = DataTables::of($users)

            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $hide = $row->user_id == "1" ? "d-none" : "";
                // $hide_group= $row->user_type=="" ?"d-none":"";
                $btn =
                    '<button  type="button"  class="text-secondary  user_delete_btn bg-white ' . $hide . '"  style="border:none;" data-delete_user_id="' . $row->user_id . '"  data-user_type="' . $row->user_type . '"  data-bs-toggle="modal" data-bs-target="#delete_confirm" ><i class="fas fa-trash-alt fs-6 text-danger"></i>
                </button>
                <button class="text-secondary user_edit_btn bg-white" data-bs-toggle="" data-bs-target="" style="border: none;" data-update_user_id="' . $row->user_id . '" data-user_type="' . $row->user_type . '"  >
                        <a href="#"> <i class="fas fa-edit fs-6 text-success">
                        </i>
                        </a>
                    </button>
                    <button class="badge-info text-secondary  sidenav_zero_index border_5_font_12 user_view_details_butt" data-bs-toggle="" data-bs-target="" style="border: none;" data-user_id="' . $row->user_id . '" data-user_type="' . $row->user_type . '"  >
                        <a href="#" class="text-white"> <i class="fas fa-eye ">
                        </i>
                        View
                        </a>
                    </button>

                    <button class=" bg-primary border_5_font_12 users_groups_assign mb-0 ' . $hide . '" data-bs-toggle="modal" data-bs-target="#users_groups_assign" style="border: none;" data-user_id_for_groups="' . $row->user_id . '" data-user_name_for_groups="' . $row->username . '">
                        <a href="javacript:void(0)"> <i class="fas fa-user-friends text-white"></i> <span class="text-white">Groups</span>
                        </a>
                    </button>
                    ';
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
        $data['title'] = 'Add User';
        $data['navbar_headings'] = 'Add User';
        $data['countries'] = DB::table('countries')->get();
        $data['positions'] = DB::table('companies_positions')->get();
        $data['companies_departments'] = DB::table('companies_departments')->get();

        if (session()->get('user_id') == "1") {

            $data['companies'] = DB::table('companies')->get();
        } else {


            $data['companies'] = DB::table('companies')->where('company_id', session()->get('company_id'))->get();
        }


        return view('dashboard/users/create_user', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        unset($request['_token']);
        $request->validate([
            'username' => 'required|unique:users',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required|max:15',
            'password' => 'required',
            'user_type' => 'required'
        ]);
        // $credentials=$request->all();
        $req = $request->only(['username', 'email', 'first_name', 'middle_names', 'last_name', 'password', 'gender', 'blood_group', 'marital_status', 'address', 'zip_code', 'city', 'state', 'landmark', 'phone_number', 'mobile_number', 'custom_field_1', 'custom_field_2', 'custom_field_3', 'custom_field_4', 'custom_field_5', 'custom_field_6', 'custom_field_7', 'custom_field_8', 'custom_field_9', 'fb_link', 'twitter_link', 'social_media_1', 'social_media_2', 'social_media_3', 'social_media_4', 'ui_language', 'dob', 'country_id', 'user_type', 'credit_limit', 'bank_details', 'tax_number']);

        $req['password'] = Hash::make($request->password);
        $req['company_id'] = session()->get('company_id');
        $req['is_active'] = $request->is_active == "on" ? '1' : '0';
        $req['allow_login'] = $request->allow_login == "on" ? '1' : '0';

        // these fileds for messanger chat start 
        // these fileds for messanger chat end 
        $user_created = User::insertGetId($req);
        if ($user_created) {
            if ($request->hasFile('profile_logo')) {
                $profileLogo = $request->file('profile_logo');
                // $profileLogoName = $profileLogo->getClientOriginalName();
                $profileLogoName = 'userId' . $user_created . '.' . $profileLogo->getClientOriginalExtension();
                if (!file_exists(public_path('app'))) {
                    File::makeDirectory(public_path('app'));
                }
                if (!file_exists(public_path('app/public'))) {
                    File::makeDirectory(public_path('app/public'));
                }
                $request->profile_logo->move(public_path('app/public/profile_logo'), $profileLogoName);
                // User::where('user_id', session()->get('user_id'))->update(['profile_logo' => $profileLogoName]);
                DB::table('users')->where('user_id', $user_created)->update(['profile_logo' => $profileLogoName]);
            }
            // putting values in id , name column for messenger start 
            DB::table('users')->where('user_id', $user_created)->update(['id' => $user_created, 'name' => $request->post('username')]);
            // putting values in id , name column for messenger end 
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Users\Users  $users
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Users\Users  $users
     * @return \Illuminate\Http\Response
     */
    // public function fetchSingleUser(Request $request){
    //     // return response()->json($request->single_user_id);
    //     return  response()->json( User::find($request->single_user_id));

    // }

    public function userUpdateForm(Request $request)
    {
        // we can also applied condition based on user count
        $id = $request->update_user_id;
        $single_user_query =  DB::table('users')
            ->select('*')
            ->where('user_id', '=', $id)
            // ->toSql();
            ->get();
        $single_user = $single_user_query->first();
        // return formatArray($single_user->position_name);
        $companies_positions_tbl =  DB::table('companies_positions')->select('*')->get()->all();
        $companies_departments_tbl =  DB::table('companies_departments')->select('*')->get()->all();
        $companies =  DB::table('companies')->select('*')->get()->all();
        $title = "Update user";
        $navbar_headings = 'Update user';
        $countries = DB::table('countries')->get();
        return view('dashboard/users/update_user', compact('title', 'navbar_headings', 'single_user', 'companies_positions_tbl', 'companies_departments_tbl', 'countries', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Users\Users  $users
     * @return \Illuminate\Http\Response
     */

    // public funtion update user 
    public function updateUser(Request $request)
    {

        unset($request['_token']);

        $request->validate([
            'username' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required|max:15',
            'profile_logo' => 'mimes:jpg,png'
        ]);
        if ($request->hasFile('profile_logo')) {
            $profileLogo = $request->file('profile_logo');
            // $profileLogoName = $profileLogo->getClientOriginalName();
            $profileLogoName = 'userId' . $request->user_id . '.' . $profileLogo->getClientOriginalExtension();
            if (!file_exists(public_path('app'))) {
                File::makeDirectory(public_path('app'));
            }
            if (!file_exists(public_path('app/public'))) {
                File::makeDirectory(public_path('app/public'));
            }
            $request->profile_logo->move(public_path('app/public/profile_logo'), $profileLogoName);
            // User::where('user_id', session()->get('user_id'))->update(['profile_logo' => $profileLogoName]);
            DB::table('users')->where('user_id', $request->user_id)->update(['profile_logo' => $profileLogoName]);
        }

        $exists = DB::table('users')->where('user_id', '!=', $request->user_id)->where('username', $request->username)->orWhere('email', $request->email)->where('user_id', '!=', $request->user_id)->get()->count();
        if ($exists == 0) {
            $req = $request->only(['username', 'email', 'first_name', 'middle_names', 'last_name', 'gender', 'blood_group', 'marital_status', 'address', 'zip_code', 'city', 'state', 'landmark', 'phone_number', 'mobile_number', 'custom_field_1', 'custom_field_2', 'custom_field_3', 'custom_field_4', 'custom_field_5', 'custom_field_6', 'custom_field_7', 'custom_field_8', 'custom_field_9', 'fb_link', 'twitter_link', 'social_media_1', 'social_media_2', 'social_media_3', 'social_media_4', 'ui_language', 'dob', 'country_id', 'user_type', 'credit_limit', 'bank_details', 'tax_number']);
            $req['is_active'] = $request->is_active == "on" ? '1' : '0';
            $req['allow_login'] = $request->allow_login == "on" ? '1' : '0';
            $req['id'] = $request->user_id;
            $req['name'] = $request->username;
            $userUpdated = User::where('user_id', $request->user_id)->update($req);
            if ($userUpdated) {
                return response()->json(['message' => 'user updated successfully', 'status' => 1]);
            } else {
                return response()->json('false');
            }
        }
        // ------------------------------------------------------------------------------
        // $req['is_active'] = $request->is_active == "on" ? '1' : '0';
        // $req['allow_login'] = $request->allow_login == "on" ? '1' : '0';
        // $req['id'] = $request->user_id;
        // $req['name'] = $request->username;
        // User::where('user_id', $request->user_id)->update($request->all());
        // return response()->json(['message' => 'user updated successfully', 'status' => 1]);
        // -----------------------------------------------------------------------------











        //   return response()->json($user_obj);


        // return response()->json($request->all());



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Users\Users  $users
     * @return \Illuminate\Http\Response
     */


    // public function user_exists(Users $users, $id)
    // {
    //     //
    //     $Users = Users::find($id);
    //     //$Users= Users::findOrFail($id);
    //     if (!empty($users->username))
    //         return true;
    //     else
    //         return false;
    // }
    public function assignGroupsToUser(Request $request)
    {
        $groups_key_exist = array_key_exists('groups', $request->all());
        $groups_string = NULL;
        if ($groups_key_exist) {
            $groups_string = implode(",", $request->groups);
        } else {
            $groups_string = NULL;
        }
        $request['groups'] = $groups_string;
        unset($request['_token']);
        if (DB::table('users_groups_assigned')->where('user_id', $request->user_id)->exists()) {
            $groups_updated_for_user = DB::table('users_groups_assigned')->where('user_id', $request->user_id)->update($request->all());
        } else {
            $groups_updated_for_user = DB::table('users_groups_assigned')->where('user_id', $request->user_id)->insert($request->all());
        }
        // return response()->json($groups_updated_for_user);
    }
    public function usersEditGroups(Request $request)
    {
        $groups_for_user_edit = DB::table('users_groups_assigned')->where('user_id', $request->user_id_for_groups)->get()->first();
        return response()->json($groups_for_user_edit);
    }
    public function changePassword(Request $request)
    {
        $data['title'] = 'Change Password';
        $data['navbar_headings'] = 'Change Password';
        return view('dashboard/users/login/forgot-password', $data);
    }
    public function checkPassword(Request $request)
    {
        $user_password = User::where('user_id', session()->get('user_id'))->get()->first();
        if (Hash::check($request->old_password, $user_password->password)) {
            echo 'true';
        } else {
            echo 'false';
        };
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'

        ]);
        $pass_updated = User::where('user_id', session()->get('user_id'))->update(['password' => Hash::make($request->new_password)]);
        if ($pass_updated) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    // single user
    public function profile(Request $request)
    {
        $data['title'] = 'Profile';
        $data['navbar_headings'] = 'Profile';
        $user = User::where('user_id', session()->get('user_id'))->get()->first();
        $data['user'] = $user;
        return view('dashboard/users/profile', $data);
    }
    public function update_profile_form(Request $request)
    {
        $data['title'] = 'Update Profile';
        $data['navbar_headings'] = 'Update Profile';
        $user = User::where('user_id', session()->get('user_id'))->get()->first();
        $data['user'] = $user;
        return view('dashboard/users/update_user_profile', $data);
    }

    public function update_user_profile(Request $request)
    {
        unset($request['_token']);
        $user_profile_updated = User::where('user_id', session()->get('user_id'))->update($request->all());
        if ($user_profile_updated) {
            echo true;
        } else {
            echo false;
        }
    }

    public function check_user_count(Request $request)
    {
        $company_users = DB::table('users')->where('company_id', session()->get('company_id'))->get();
        $com_users_count = count($company_users);
        $com_subscriptions = DB::table('subscriptions')->where('company_id', session()->get('company_id'))->get()->first();
        return response()->json(['package_id' => $com_subscriptions->package_id, 'users_count' => $com_users_count]);
    }
    // job candidate profile start 
    public function job_candite_profile_form(Request $request)
    {
        $data['title'] = 'Apply For Job';
        $data['navbar_headings'] = 'Apply For Job';
        $user = User::where('user_id', session()->get('user_id'))->get()->first();
        $data['user'] = $user;
        return view('dashboard/users/job_candidate_profile', $data);
    }
    // job candidate profile end 


    public function update_job_candidate_profile(Request $request)
    {
        $request->validate([
            'employee_cv' => 'mimes:pdf,docx'

        ]);
        if (!file_exists(public_path('app'))) {
            File::makeDirectory(public_path('app'));
        }
        if (!file_exists(public_path('app/public'))) {
            File::makeDirectory(public_path('app/public'));
        }
        unset($request['_token']);
        if ($request->employee_cv != null) {

            $file_name = time() . '-' . $request->employee_cv->getClientOriginalName();
            $file_moved = $request->employee_cv->move(public_path('app/public/job_candidate_cvs'), $file_name);
            $user_profile_updated = User::where('user_id', session()->get('user_id'))->update(
                [
                    'username' => $request->username,
                    'first_name' => $request->first_name,
                    'middle_names' => $request->middle_names,
                    'last_name' => $request->last_name,
                    'mobile_number' => $request->mobile_number,
                    'phone_number' => $request->phone_number,
                    'address' => $request->address,
                    'zip_code' => $request->zip_code,
                    'city' => $request->city,
                    'state' => $request->state,
                    'landmark' => $request->landmark,
                    'gender' => $request->gender,
                    'ui_language' => $request->ui_language,
                    'employee_cv' => $file_name,
                ]
            );
        } else {
            $user_profile_updated = User::where('user_id', session()->get('user_id'))->update($request->only([
                'username',
                'first_name',
                'middle_names',
                'last_name',
                'phone_number',
                'address',
                'zip_code',
                'city',
                'state',
                'landmark',
                'gender',
                'ui_language',
            ]));
        }



        //    $request->employee_cv->getClientOriginalName() ;

        if ($user_profile_updated) {
            // echo true;
            return response()->json($request->all());
        } else {
            echo false;
        }
    }
    // update user profile start 
    public  function  updateUserProfile(Request $request)
    {
        unset($request['_token']);
        $request->validate([
            'username' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required|max:15',
            'profile_logo' => 'mimes:jpg,png'
        ]);
        if ($request->hasFile('profile_logo')) {
            $profileLogo = $request->file('profile_logo');
            // $profileLogoName = $profileLogo->getClientOriginalName();
            $profileLogoName = 'userId' . session()->get('user_id') . '.' . $profileLogo->getClientOriginalExtension();

            if (!file_exists(public_path('app'))) {
                File::makeDirectory(public_path('app'));
            }
            if (!file_exists(public_path('app/public'))) {
                File::makeDirectory(public_path('app/public'));
            }
            $request->profile_logo->move(public_path('app/public/profile_logo'), $profileLogoName);
            // User::where('user_id', session()->get('user_id'))->update(['profile_logo' => $profileLogoName]);
            DB::table('users')->where('user_id', session()->get('user_id'))->update(['profile_logo' => $profileLogoName]);
        }

        $exists = DB::table('users')->where('user_id', '!=', session()->get('user_id'))->where('username', $request->username)->orWhere('email', $request->email)->where('user_id', '!=', session()->get('user_id'))->get()->count();
        if ($exists == 0) {
            $req = $request->only(['username', 'email', 'first_name', 'middle_names', 'last_name', 'gender', 'blood_group', 'marital_status', 'address', 'zip_code', 'city', 'state', 'landmark', 'phone_number', 'mobile_number', 'custom_field_1', 'custom_field_2', 'custom_field_3', 'custom_field_4', 'custom_field_5', 'custom_field_6', 'custom_field_7', 'custom_field_8', 'custom_field_9', 'fb_link', 'twitter_link', 'social_media_1', 'social_media_2', 'social_media_3', 'social_media_4', 'ui_language']);
            $userProfileUpdated = User::where('user_id', session()->get('user_id'))->update($req);
            if ($userProfileUpdated) {
                return response()->json('true');
            } else {
                return response()->json('false');
            }
        }
    }

    // update user profile end 

    public function fetchSingleUser(Request $request)
    {
        $user = DB::table('users')->where('user_id', $request->user_id)->get()->first();
        return response()->json($user);
    }
}

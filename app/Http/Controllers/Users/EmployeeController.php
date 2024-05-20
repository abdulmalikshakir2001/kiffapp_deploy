<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobVacancy\JobVacancy;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\Users\User;
use App\Models\JobVacancy\AppliedCandidate;
use Illuminate\Support\Facades\Hash;
// use PDF;
use Barryvdh\DomPDF\Facade\Pdf;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title'] = 'All Employee';
        $data['navbar_headings'] = 'All Employee';
        return view('hrm/view_employee', $data);
    }
    public function get_data_employee(Request $request)

    {
        $users =  DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type', 'Employee')->get();
        $allData = DataTables::of($users)

            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn =
                    '<button  type="button"  class="text-secondary  user_delete_btn bg-white "  style="border:none;" data-delete_user_id="' . $row->user_id . '"  data-user_type="' . $row->user_type . '"  data-bs-toggle="modal" data-bs-target="#delete_confirm" ><i class="fas fa-trash-alt fs-6 text-danger"></i>
            </button>
            <button class="text-secondary user_edit_btn bg-white" data-bs-toggle="" data-bs-target="" style="border: none;" data-update_user_id="' . $row->user_id . '" data-user_type="' . $row->user_type . '"  >
                    <a href="#"> <i class="fas fa-edit fs-6 text-success">
                    </i>
                    </a>

                </button>
                <button class="badge-info text-secondary  sidenav_zero_index border_5_font_12 emp_view_details_butt" data-bs-toggle="" data-bs-target="" style="border: none;" data-user_id="' . $row->user_id . '" data-user_type="' . $row->user_type . '"  >
                        <a href="' . route('employeeDetails', $row->user_id) . '" class="text-white"> <i class="fas fa-eye ">
                        </i>
                        View
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
        //
        $data['title'] = 'Add Employee';
        $data['navbar_headings'] = 'Employee';
        $data['countries'] = DB::table('countries')->get();
        $data['work_shifts'] = DB::table('work_shifts')->where('company_id', session()->get('company_id'))->get();
        $data['warehouses'] = DB::table('pur_warehouses')->where('company_id', session()->get('company_id'))->get();

        return view('hrm/create_employee', $data);
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
            'user_type' => 'required',
            'work_shift_id' => 'required',
            'employee_no' => 'required'
        ]);
        // $credentials=$request->all();
        $req = $request->only(['username', 'email', 'first_name', 'middle_names', 'last_name', 'password', 'gender', 'blood_group', 'marital_status', 'address', 'zip_code', 'city', 'state', 'landmark', 'phone_number', 'mobile_number', 'custom_field_1', 'custom_field_2', 'custom_field_3', 'custom_field_4', 'custom_field_5', 'custom_field_6', 'custom_field_7', 'custom_field_8', 'custom_field_9', 'fb_link', 'twitter_link', 'social_media_1', 'social_media_2', 'social_media_3', 'social_media_4', 'ui_language', 'dob', 'country_id', 'user_type', 'credit_limit', 'bank_details', 'tax_number', 'employee_no', 'basic_salary', 'food_allownce', 'medical_allownce', 'transport_allownce', 'other_allownces', 'work_shift_id']);

        $req['password'] = Hash::make($request->password);
        $req['company_id'] = session()->get('company_id');
        $req['is_active'] = $request->is_active == "on" ? '1' : '0';
        $req['allow_login'] = $request->allow_login == "on" ? '1' : '0';
        if($request->warehouse_id == null){
            $req['warehouse_id'] = '0';


        }
        else{
            $req['warehouse_id'] = $request->warehouse_id;

        }


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


    public function isExistEmployeeNo(Request $request)
    {
        // check exist user name 
        $exist_user =  User::where('employee_no', $request->employee_no)->first();
        //  echo json_encode($exist_user);
        if ($exist_user) {
            echo 'false';
        } else {
            echo 'true';
        }
        // check user name for update 
    }


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
        $work_shifts = DB::table('work_shifts')->where('company_id', session()->get('company_id'))->get();
        $warehouses = DB::table('pur_warehouses')->where('company_id', session()->get('company_id'))->get();
        $title = "Update Employees";
        $navbar_headings = 'Update Employee';
        $countries = DB::table('countries')->get();
        return view('hrm/update_employee', compact('title', 'navbar_headings', 'single_user', 'companies_positions_tbl', 'companies_departments_tbl', 'countries', 'companies', 'work_shifts','warehouses'));
    }

    public function updateUser(Request $request)
    {

        unset($request['_token']);

        $request->validate([
            'username' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required|max:15',
            'user_type' => 'required',
            'work_shift_id' => 'required',
            'employee_no' => 'required',
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
            $req = $request->only(['username', 'email', 'first_name', 'middle_names', 'last_name', 'password', 'gender', 'blood_group', 'marital_status', 'address', 'zip_code', 'city', 'state', 'landmark', 'phone_number', 'mobile_number', 'custom_field_1', 'custom_field_2', 'custom_field_3', 'custom_field_4', 'custom_field_5', 'custom_field_6', 'custom_field_7', 'custom_field_8', 'custom_field_9', 'fb_link', 'twitter_link', 'social_media_1', 'social_media_2', 'social_media_3', 'social_media_4', 'ui_language', 'dob', 'country_id', 'user_type', 'credit_limit', 'bank_details', 'tax_number', 'employee_no', 'basic_salary', 'food_allownce', 'medical_allownce', 'transport_allownce', 'other_allownces', 'work_shift_id']);
            $req['is_active'] = $request->is_active == "on" ? '1' : '0';
            $req['allow_login'] = $request->allow_login == "on" ? '1' : '0';
            if($request->warehouse_id == null){
                $req['warehouse_id'] = '0';
    
    
            }
            else{
                $req['warehouse_id'] = $request->warehouse_id;
    
            }
            $req['id'] = $request->user_id;
            $req['name'] = $request->username;
            $userUpdated = User::where('user_id', $request->user_id)->update($req);
            if ($userUpdated) {
                return response()->json(['message' => 'user updated successfully', 'status' => 1]);
            } else {
                return response()->json('false');
            }
        }
    }
    public function isExistEmployeeForUpdate(Request $request)
    {
        $exist_user =  User::where('user_id', '!=', $request->user_id)->where('employee_no', $request->employee_no)->where('company_id', session()->get('company_id'))->get()->count();
        //  echo json_encode($exist_user);
        if ($exist_user >= 1) {
            echo 'false';
        } else {
            echo 'true';
        }
    }


    public function employeeDetails(int $id)
    {
        // we can also applied condition based on user count
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
        $work_shifts = DB::table('work_shifts')->where('company_id', session()->get('company_id'))->get();
        $title = "Employee Details";
        $navbar_headings = 'Employee Details';
        $countries = DB::table('countries')->get();
        return view('hrm/hrm_employee_details', compact('title', 'navbar_headings', 'single_user', 'companies_positions_tbl', 'companies_departments_tbl', 'countries', 'companies', 'work_shifts'));
    }

    public function returnUrl(Request $request)
    {
        $url = url('printEmployeeDetails' . '/' . $request->user_id);
        return response()->json($url);
    }


    public function printEmployeeDetails(Request $request)

    {
        $single_user_query =  DB::table('users')
            ->select('*')
            ->where('user_id', '=', $request->user_id)
            // ->toSql();
            ->get();
        $data['single_user'] = $single_user_query->first();
        $data['companies_positions_tbl'] =  DB::table('companies_positions')->select('*')->get()->all();
        $data['companies_departments_tbl'] =  DB::table('companies_departments')->select('*')->get()->all();
        $data['companies'] =  DB::table('companies')->select('*')->get()->all();
        $data['work_shifts'] = DB::table('work_shifts')->where('company_id', session()->get('company_id'))->get();

        $data['countries'] = DB::table('countries')->get();
        // for hrm view payroll start
        $pdf = Pdf::loadView('hrm/hrm_employee_details_print', $data);
         return $pdf->stream();

        //  return response()->json( $pdf->output());
        // return response($pdf->output(), 200, [
        //     'Content-Type' => 'application/pdf',
        //     'Content-Disposition' => 'inline; filename="file.pdf"',
        // ]);

        // $payroll_url = url('return_pdf' . '/' . $request->payroll_id);
        //  return  response()->json(base64_encode($pdf->output()))->header( 'Content-Type' , 'application/pdf');
        //  ->header('Access-Control-Allow-Origin','http://127.0.0.1:8000/printEmployeeDetails'.'/'.$request->user_id);

    }
}

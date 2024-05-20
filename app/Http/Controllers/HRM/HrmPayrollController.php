<?php

namespace App\Http\Controllers\HRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HRM\HrmPayroll;
use App\Models\Users\User;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class HrmPayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $data['title'] = 'Manage Payroll';
        $data['navbar_headings'] = 'Manage Payroll';
        $data['users'] = DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type', 'Employee')->get();
        $data['work_shifts'] = DB::table('work_shifts')->where('company_id', session()->get('company_id'))->get();



        return view('hrm/view_hrm_payroll', $data);
    }
    public function getData(Request $request)
    {
        // start 
        $hrm_payroll_table =  HrmPayroll::with('users')->where('company_id', session()->get('company_id'))->get();
        // end
        // $attendences =  DB::table('attendences')->where('company_id',session()->get('company_id'))->get();
        $allData = DataTables::of($hrm_payroll_table)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn =
                    '<button type="button" class="text-secondary attendence_delete_btn bg-white"  style="border:none;" data-delete_attendence_id="' . $row->payroll_id . '"  data-bs-toggle="modal" data-bs-target="#delete_confirm_attendence"><i class="fas fa-trash-alt fs-6 text-danger"></i>
            </button><button class="text-secondary sidenav_zero_index attendence_edit_btn  bg-white" data-bs-toggle="modal" data-bs-target="#update_attendence" style="border: none;" data-update_attendence_id="' . $row->payroll_id . '">
                    <a href="#"> <i class="fas fa-edit fs-6 text-success ">
                    </i>
                    </a>
                    </button>
                    
                <i class="fas fa-print payroll_print_export cursor-pointer" data-payroll_id="'.$row->payroll_id .'"></i>
                <a href="'.route('download_payroll').'/'.$row->payroll_id.'" data-payroll_id="'.$row->payroll_id.'" class="" data-mdb-ripple-color="dark" > <i class="fas fa-download ms-2" style="color:#0dcaf0;"></i></a>
                    <a href="#" class="ms-2 view_payroll_iframe"  data-payroll_id="' . $row->payroll_id . '"  
                    data-update_attendence_id="' . $row->payroll_id . '"
                    >
                <i class="fas fa-eye attendence_edit_btn"        style="color:red;"></i>
                
                </a>
                ';
                return $btn;
            })->addColumn('username', function ($row) {

                $checked_emp_attendence = '<span class="ps-2">' . $row->users->first()->username . '</span>';
                return $checked_emp_attendence;
            })
            ->rawColumns(['action', 'username'])
            ->make(true);
        return $allData;
    }
    // get employee name
    public function get_employee_names_attendence(Request $request)
    {
        // return  response()->json($request->work_shift_id);


        $user_table =  DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type', 'Employee')->get();

        // end
        // $attendences =  DB::table('attendences')->where('company_id',session()->get('company_id'))->get();
        $allData = DataTables::of($user_table)
            ->addColumn('username', function ($row) {
                $checked_emp_attendence = '<input type="checkbox" class="employee_attendence_checkbox" name="' . $row->username . '" id="' . $row->username . '" data-checkbox_user_id="' . $row->user_id . '">';
                $checked_emp_attendence .= '<span class="ps-2">' . $row->username . '</span>';
                return $checked_emp_attendence;
            })
            ->rawColumns(['username'])
            ->make(true);
        return $allData;
    }
    public function get_employee_names_shift_attendence(Request $request)
    {
        // return  response()->json($request->work_shift_id);

        $user_table =  DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type', 'Employee')->where('work_shift_id', $request->work_shift_id)->get();
        // return response()->json($request->all());
        // end
        // $attendences =  DB::table('attendences')->where('company_id',session()->get('company_id'))->get();
        $allData = DataTables::of($user_table)
            ->addColumn('username', function ($row) {
                $checked_emp_attendence = '<input type="checkbox" class="employee_attendence_checkbox" name="' . $row->username . '" id="' . $row->username . '" data-checkbox_user_id="' . $row->user_id . '">';
                $checked_emp_attendence .= '<span class="ps-2">' . $row->username . '</span>';
                return $checked_emp_attendence;
            })
            ->rawColumns(['username'])
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
        $data['title'] = 'Manage Attendence';
        $data['navbar_headings'] = 'Manage Attendence';
        return view('hrm/create_attendence', $data);
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
        $request['company_id'] = session()->get('company_id');
        $user_ids = explode(',', $request->user_id_checkbox);
        if (array_key_exists('dates_arr', $request->all())  &&  $request->dates_arr != null) {
            // return response()->json('exist');
            $dates_arr =   explode(',', $request->dates_arr);
            // return response()->json(count($dates_arr));
            $attendence_counter = 0;
            $absenties = 0;
            $salary_month = $request->month_input;
            $exist_payroll=0;
            foreach ($user_ids as $user_id) {
                // fetch salary start 
                $user = DB::table('users')->where('user_id', $user_id)->get()->first();
                // fetch salary end 
                // fetch salary start 
                $user_attendence = DB::table('attendences')->where('user_id', $user_id)->get()->first();
                // fetch salary end 
                $attendence_counter = 0;  // field for insertion
                $absenties = 0; // field for insertion


                // $overtime_hours =  Carbon::createFromFormat('H:i:s', '00:00:00');
                $hours = 0;
                $min = 0;
                // late
                $late_hours = 0;
                $late_min = 0;

                // late 
                // late
                $early_hours = 0;
                $early_min = 0;

                // late 
                for ($i = 0; $i < count($dates_arr); $i++) {
                    $attendence_exist = DB::table('attendences')->where('user_id', $user_id)->where('date', $dates_arr[$i])->get();
                    if (count($attendence_exist) > 0) {
                        $attendence_overtime = DB::table('attendences')->where('user_id', $user_id)->where('date', $dates_arr[$i])->get()->first();

                        // overtime hourse 
                        $add_time = Carbon::createFromFormat('H:i:s', $attendence_overtime->over_time);
                        $min += $add_time->format('i');
                        $hours += $add_time->format('H');
                        if ($min > 59) {
                            $hours++;
                            $min = $min - 60;
                        }
                        // overtime hourse 

                        // late hours  start 
                        $late = Carbon::createFromFormat('H:i:s', $attendence_overtime->late);
                        $late_min += $late->format('i');
                        $late_hours += $late->format('H');
                        if ($late_min > 59) {
                            $late_hours++;
                            $late_min = $late_min - 60;
                        }

                        // late hours  start 
                        // early leave  start 
                        $early = Carbon::createFromFormat('H:i:s', $attendence_overtime->early_leave);
                        $early_min += $early->format('i');
                        $early_hours += $early->format('H');
                        if ($early_min > 59) {
                            $early_hours++;
                            $early_min = $early_min - 60;
                        }

                        // early leave start 
                        $attendence_counter++;
                    } else {
                        $absenties++;
                    }
                }
                // field for insertion
                $presence_hours = $attendence_counter * 8;
                $days_in_month = Carbon::create($salary_month)->daysInMonth;
                $salary_month = $request->month_input; // field for insertion
                $user_salary =  $user->basic_salary; // field for insertion
                $per_min_amount = ((($user_salary / $days_in_month) / 8) / 60);
                $allownces = $user->food_allownce + $user->medical_allownce + $user->transport_allownce + $user->other_allownces; // field for insertion
                $over_time_hours = $hours . ':' . $min; // field for insertion
                $over_time_amount = (($user_salary / $days_in_month) / 8) * ($hours + ($min / 60)); // field for insertion
                $deductions_min = (($late_hours + ($late_min / 60)) * 60) + (($early_hours + ($early_min / 60)) * 60);
                $deductions = $deductions_min * $per_min_amount; // field for insertion
                $date = Carbon::parse($salary_month);
                $salary_month_new = $date->format('Y:m:d');
                // insert payroll start 
                $payroll=DB::table('hrm_payrolls')->where('salary_month',$salary_month_new)->where('user_id',$user_id)->get();
                if(count($payroll)>0){
                    $exist_payroll++;
                    continue;

            // return response()->json('true') ;
                }
                else{

                DB::table('hrm_payrolls')->insert([
                    'user_id' => $user_id,
                    'company_id' => session()->get('company_id'),
                    'salary_month' => $salary_month_new,
                    'attendences' => $attendence_counter,
                    'absenties' => $absenties,
                    'basic_salary' => $user_salary,
                    'overtime_hours' => $over_time_hours,
                    'overtime_amount' => $over_time_amount,
                    'allownces' => $allownces,
                    'deductions' => $deductions,
                    'net_payable' => ($user_salary + $over_time_amount+$allownces) - $deductions,
                ]);
            }
                // insert payroll end 


                // field for insertion
                // return response()->json($deductions_min);
                // return response()->json($hours+($min/60));
            }
            // return response()->json(['attendence'=>$attendence_counter,'absenties'=>$absenties]);
            return response()->json(['status'=>'true','exist_payroll'=>$exist_payroll]) ;
        }
    }
    // update

    public function fetch_attendence(Request $request)
    {
        $update_attendence_id = $request->update_attendence_id;
        $single_attendence_query =  DB::table('hrm_payrolls')
            ->select('*')
            ->where('payroll_id', '=', $update_attendence_id)
            ->get();
        $leave = $single_attendence_query->first();
        return response()->json($leave);
    }

    public function update_attendence(Request $request)
    {
        unset($request['_token']);

        $request['company_id'] = session()->get('company_id');
        $request['payment_status']=$request->payment_status=="on"?'paid':'unpaid';

        $attendence_updated = HrmPayroll::where('payroll_id', $request->payroll_id)->update($request->all());
        if ($attendence_updated) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
    // delete
    public function delete_attendence(Request $request)
    {
        $delete_attendence_id = $request->delete_attendence_id;
        $attendence_deleted = HrmPayroll::where('payroll_id', $delete_attendence_id)->delete();

        if ($attendence_deleted) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
}

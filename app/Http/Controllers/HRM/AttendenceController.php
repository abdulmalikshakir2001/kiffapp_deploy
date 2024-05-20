<?php

namespace App\Http\Controllers\HRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HRM\Attendence;
use App\Models\Users\User;
use DateInterval;
use DateTime;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class AttendenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title'] = 'Manage Attendence';
        $data['navbar_headings'] = 'Manage Attendence';
        $data['users'] = DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type', 'Employee')->get();
        $data['work_shifts'] = DB::table('work_shifts')->where('company_id', session()->get('company_id'))->get();
        return view('hrm/view_attendence', $data);
    }
    public function getData(Request $request)
    {
        // start 
        $attendence_table =   Attendence::with('users')->where('company_id', session()->get('company_id'))->get();


        // end
        // $attendences =  DB::table('attendences')->where('company_id',session()->get('company_id'))->get();
        $allData = DataTables::of($attendence_table)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn =
                    '<button type="button" class="text-secondary attendence_delete_btn bg-white"  style="border:none;" data-delete_attendence_id="' . $row->attendence_id . '"  data-bs-toggle="modal" data-bs-target="#delete_confirm_attendence"><i class="fas fa-trash-alt fs-6 text-danger"></i>
            </button><button class="text-secondary sidenav_zero_index attendence_edit_btn  bg-white" data-bs-toggle="modal" data-bs-target="#update_attendence" style="border: none;" data-update_attendence_id="' . $row->attendence_id . '">
                    <a href="#"> <i class="fas fa-edit fs-6 text-success ">
                    </i>
                    </a>
                </button>';
                return $btn;
            })->addColumn('username',function($row){
             
                $checked_emp_attendence= '<span class="ps-2">'. $row->users->first()->username.'</span>';
                return $checked_emp_attendence;
                
            })
            ->rawColumns(['action','username'])
            ->make(true);
        return $allData;
    }
    // get employee name
    public function get_employee_names_attendence(Request $request)
    {
        // return  response()->json($request->work_shift_id);

        
            $user_table =  DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type','Employee')->get();

        // end
        // $attendences =  DB::table('attendences')->where('company_id',session()->get('company_id'))->get();
        $allData = DataTables::of($user_table)
            ->addColumn('username',function($row){
                $checked_emp_attendence= '<input type="checkbox" class="employee_attendence_checkbox" name="'.$row->username.'" id="'.$row->username.'" data-checkbox_user_id="'.$row->user_id.'">';
                $checked_emp_attendence.= '<span class="ps-2">'. $row->username.'</span>';
                return $checked_emp_attendence;
                
            })
            ->rawColumns(['username'])
            ->make(true);
        return $allData;
    }
    public function get_employee_names_shift_attendence(Request $request)
    {
        // return  response()->json($request->work_shift_id);

            $user_table =  DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type','Employee')->where('work_shift_id',$request->work_shift_id)->get();
            // return response()->json($request->all());
        // end
        // $attendences =  DB::table('attendences')->where('company_id',session()->get('company_id'))->get();
        $allData = DataTables::of($user_table)
            ->addColumn('username',function($row){
                $checked_emp_attendence= '<input type="checkbox" class="employee_attendence_checkbox" name="'.$row->username.'" id="'.$row->username.'" data-checkbox_user_id="'.$row->user_id.'">';
                $checked_emp_attendence.= '<span class="ps-2">'. $row->username.'</span>';
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
        $request->validate([
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $request['company_id'] = session()->get('company_id');
        // return response()->json($request->all());
        // return response()->json($request->user_id_checkbox);
        $user_ids= explode(',',$request->user_id_checkbox);
        // late time start 
// time diff late
$shift_time = new DateTime($request->shift_start_time_input);
$startTime = new DateTime($request->start_time);
$formatted_time= $startTime->format('H:i:s');
$start_time = new DateTime($formatted_time);
// if in is > out, assume out is on the next day
if ($shift_time > $start_time) $start_time->add(new DateInterval('P1D'));
$diff = $start_time->diff($shift_time);
$late_time=  $diff->format('%H:%i');
// time diff late



// early + overtime start
$early_leave="00:00:00";
$overtime_hours="00:00:00";
$user_end_time= new DateTime($request->end_time);
$user_end_time_formatted= $user_end_time->format("H:i:s");
$start_time_shift=new DateTime($request->shift_start_time_input);
    $end_time=new DateTime($user_end_time_formatted); // if use end time smaller than shift start time means its on nextday.
    if($end_time<$start_time_shift){  // first calculate shift start time and end time of user not shift
        $end_time->modify('+1 day');
    }
    // $end_time_string= $end_time->format('H:i:s');
    $interval= $end_time->diff($start_time_shift); // 10hours interval and if the interval less than 8 hours than thier is no overitme
    // return $interval->format('%H:%i');
    if($interval->h<8){
        $overtime_interval=clone $interval;
          $overtime_interval->h =8-$overtime_interval->h;
        //   return $overtime_interval->h;
          $overtime=$overtime_interval->h*3600+$overtime_interval->i*60+$overtime_interval->s;
          $early_leave= gmdate('H:i:s',$overtime);
        //   echo 'early_leave'.$early_leave;

    }else{
        // substract shift hours from interval
        $overtime_interval=clone $interval;
          $overtime_interval->h -=8;
        //   return $overtime_interval->h;
        $overtime=$overtime_interval->h*3600+$overtime_interval->i*60+$overtime_interval->s;
        $overtime_hours= gmdate('H:i:s',$overtime);
        // echo 'overtime'. $overtime;
    }
// early + overtime end
    


        if(array_key_exists('dates_arr',$request->all())  &&  $request->dates_arr != null){
            // return response()->json('exist');

     $dates_arr=   explode(',',$request->dates_arr);
            // return response()->json(count($dates_arr));

            foreach($user_ids as $user_id){

            

            for($i = 0; $i < count($dates_arr); $i++){

                $attendence_exist= DB::table('attendences')->where('user_id',$user_id)->where('date',$dates_arr[$i])->get();
                if(count($attendence_exist) > 0){
                    continue;
                }

                $month_att_inserted= DB::table('attendences')->insert([
                    'user_id'=>$user_id,
                    'company_id'=>session()->get('company_id'),
                    'start_time'=>$request->start_time,
                    'end_time'=>$request->end_time,
                    'date'=>$dates_arr[$i],
                    'late'=>$late_time,
                    'early_leave'=>$early_leave,
                    'over_time'=>$overtime_hours
                ]);
            }
        }
            return response()->json('true');

        }

        // return response()->json($request->all());
        $attendence_exist= DB::table('attendences')->where('user_id',$request->user_id)->where('date',$request->date)->get();
        if(count($attendence_exist) > 0){
            return response()->json('attendence_exist');
        }




        // $attendence_added = Attendence::create($request->all());

        foreach($user_ids as $user_id){
            $attendence_exist= DB::table('attendences')->where('user_id',$user_id)->where('date',$request->date)->get();
        if(count($attendence_exist) > 0){
            // return response()->json('attendence_exist');
            continue;
            // echo response()->json('attendence_exist');
        }


             DB::table('attendences')->insert([
                'user_id'=>$user_id,
                'company_id'=>session()->get('company_id'),
                'start_time'=>$request->start_time,
                'end_time'=>$request->end_time,
                'date'=>$request->date,
                'late'=>$late_time,
                'early_leave'=>$early_leave,
                'over_time'=>$overtime_hours
             ]);
        }
            return response()->json('true');




        // if ($attendence_added) {
        //     return response()->json('true');
        // } else {
        //     return response()->json('false');
        // }
    }

    // update

    public function fetch_attendence(Request $request)
    {
        $update_attendence_id = $request->update_attendence_id;
        $single_attendence_query =  DB::table('attendences')
            ->select('*')
            ->where('attendence_id', '=', $update_attendence_id)
            ->get();
        $leave = $single_attendence_query->first();
        return response()->json($leave);
    }

    public function update_attendence(Request $request)
    {
        unset($request['_token']);
        $request->validate([
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);
        $request['company_id'] = session()->get('company_id');

        $attendence_updated = Attendence::where('attendence_id', $request->attendence_id)->update($request->all());
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
        $attendence_deleted = Attendence::where('attendence_id', $delete_attendence_id)->delete();

        if ($attendence_deleted) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
}

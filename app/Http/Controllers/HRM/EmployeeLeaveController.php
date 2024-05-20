<?php

namespace App\Http\Controllers\HRM;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HRM\EmployeeLeave;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\Users\User;
use App\Models\HRM\LeaveType;

class EmployeeLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title']='Manage Employee Leaves';
        $data['navbar_headings']='Manage Employee Leaves';
        $data['employees'] = DB::table('users')->where('company_id',session()->get('company_id'))->where('user_type','Employee')->get();
        $data['leave_types'] = DB::table('leave_types')->get();

        return view('hrm/view_employee_leave',$data);
    }
    public function getData(Request $request)
    {
        // start 
$applied_candidates =  DB::table('employee_leaves')->where('company_id', session()->get('company_id'))->get();
$user_id_for_job = [];
foreach ($applied_candidates as $value) {
    array_push($user_id_for_job, $value->user_id);
}
$user_unique =     array_unique($user_id_for_job);


$user_jobs = [];
$i=0;
foreach ($user_unique as $user_id) {
    $user_three_job_vac = User::find($user_id)->leave_type_id_emp_leave;
    foreach ($user_three_job_vac as $vacancies) {
        $user_name = DB::table('users')->where('user_id', $vacancies->pivot->user_id)->get()->first();
        $vacancies['username'] = $user_name->username;
        $vacancies['user_id'] = $user_name->user_id;
        $vacancies['leave_type_id'] = $vacancies->pivot->leave_type_id;
        $vacancies['start_date'] = $applied_candidates[$i]->start_date;
        $vacancies['end_date'] = $applied_candidates[$i]->end_date;
        $vacancies['approval_status'] = $applied_candidates[$i]->approval_status;
        $vacancies['employee_leave_id'] = $applied_candidates[$i]->employee_leave_id;
        $vacancies['is_paid'] = $applied_candidates[$i]->is_paid;
        $user_jobs[] = $vacancies;
        $i++;
    }
}

// end


        // $employee_leaves =  DB::table('employee_leaves')->where('company_id',session()->get('company_id'))->get();
                $allData = DataTables::of($user_jobs)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn =
                            '<button type="button" class="text-secondary employee_leave_delete_btn bg-white"  style="border:none;" data-delete_employee_leave_id="' . $row->employee_leave_id . '"  data-bs-toggle="modal" data-bs-target="#delete_confirm_employee_leave"><i class="fas fa-trash-alt fs-6 text-danger"></i>
                </button><button class="text-secondary sidenav_zero_index employee_leave_edit_btn  bg-white" data-bs-toggle="modal" data-bs-target="#update_employee_leave" style="border: none;" data-update_employee_leave_id="' . $row->employee_leave_id . '">
                        <a href="#"> <i class="fas fa-edit fs-6 text-success ">
                        </i>
                        </a>
                    </button>';
                        return $btn;
                    })->
                    addColumn('approval_status',function($row){
                        if($row->approval_status=='pending'){
                            $btn= '<span class="badge badge-pill badge-info">Pending</span>';
                            $btn.='<button type="button" class="btn btn-success approve_leave btn-sm mb-0 ms-2" data-employee_leave_id=' . $row->employee_leave_id . ' >Approve</button>';
                            $btn.='<button type="button" class="btn btn-primary reject_leave  btn-sm mb-0 ms-2" data-employee_leave_id=' . $row->employee_leave_id . '>Reject</button>'
                            ;
                            return $btn;
                        }
                        else if($row->approval_status=='approved'){
                            $btn= '<span class="badge badge-pill badge-success">Approved</span>';
                            
                            $btn.='<button type="button" class="btn btn-primary reject_leave  btn-sm mb-0 ms-2" data-employee_leave_id=' . $row->employee_leave_id . '>Reject</button>'
                            ;
                            return $btn;

                        }
                        else if($row->approval_status=='rejected'){
                            $btn= '<span class="badge badge-pill badge-warning">Rejected</span>';
                            
                            $btn.='<button type="button" class="btn btn-success approve_leave btn-sm mb-0 ms-2" data-employee_leave_id=' . $row->employee_leave_id . ' >Approve</button>';
                            ;
                            return $btn;

                        }

                    })->addColumn('is_paid',function($row){
                        if($row->is_paid=='paid'){
                            return '<span class="badge badge-pill badge-success">Paid</span>';

                        }
                        else{
                            return '<span class="badge badge-pill badge-warning"> unpaid</span>';


                        }
                    })
                    
                    ->rawColumns(['action','approval_status','is_paid'])
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
        $data['title']='Manage Employee Leave';
        $data['navbar_headings']='Manage Employee Leave';
        return view('hrm/create_employee_leave',$data);
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
            'leave_type_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        $request['is_paid']=$request->is_paid=="on" ? "paid":"unpaid";
        $request['company_id']=session()->get('company_id');

        $employee_leave_added= EmployeeLeave::create($request->all());
        if($employee_leave_added){
            return response()->json(true);
        }
        else{
            return response()->json(false);
        }

        
    }

// update

    public function fetch_employee_leave(Request $request)
    {
        $update_employee_leave_id = $request->update_employee_leave_id;
        $single_employee_leave_query =  DB::table('employee_leaves')
            ->select('*')
            ->where('employee_leave_id', '=', $update_employee_leave_id)
            ->get();
        $leave = $single_employee_leave_query->first();
        return response()->json($leave);
    }

    public function update_employee_leave(Request $request){
        unset($request['_token']);
        $request->validate([
            'leave_type_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        $request['is_paid']=$request->is_paid=="on" ? "paid":"unpaid";
        $request['company_id']=session()->get('company_id');

        $employee_leave_updated= EmployeeLeave::where('employee_leave_id',$request->employee_leave_id)->update ($request->all());
        if($employee_leave_updated){
            return response()->json(true);
        }
        else{
            return response()->json(false);
        }



    }
    // delete
    public function delete_employee_leave(Request $request)
    {
        $delete_employee_leave_id = $request->delete_employee_leave_id;
        $employee_leave_deleted = EmployeeLeave::where('employee_leave_id', $delete_employee_leave_id)->delete();

        if ($employee_leave_deleted) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    // 
    public function approve_employee_leave(Request $request){
        // return response()->json($request->employee_leave_id);
        $leave_approved= EmployeeLeave::where('employee_leave_id',$request->employee_leave_id)->update(['approval_status'=>'approved']);
        if($leave_approved){
            
        return response()->json('true');

        }
        else{
            return response()->json('true');

        }

    }
    public function reject_employee_leave(Request $request){
        // return response()->json($request->employee_leave_id);
        $leave_approved= EmployeeLeave::where('employee_leave_id',$request->employee_leave_id)->update(['approval_status'=>'rejected']);
        if($leave_approved){
            
        return response()->json('true');

        }
        else{
            return response()->json('true');

        }

    }
    

    


}

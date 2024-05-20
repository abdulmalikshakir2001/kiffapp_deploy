<?php

namespace App\Http\Controllers\HRM;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HRM\WorkShift;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class WorkShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title']='Manage Work Shift';
        $data['navbar_headings']='Manage Work Shift';
        return view('hrm/view_work_shift',$data);
    }
    public function getData(Request $request)
    {
        // start 
$work_shift_table =  DB::table('work_shifts')->where('company_id', session()->get('company_id'))->get();


// end
        // $work_shifts =  DB::table('work_shifts')->where('company_id',session()->get('company_id'))->get();
        $allData = DataTables::of($work_shift_table)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
            $btn =
            '<button type="button" class="text-secondary work_shift_delete_btn bg-white"  style="border:none;" data-delete_work_shift_id="' . $row->work_shift_id . '"  data-bs-toggle="modal" data-bs-target="#delete_confirm_work_shift"><i class="fas fa-trash-alt fs-6 text-danger"></i>
            </button><button class="text-secondary sidenav_zero_index work_shift_edit_btn  bg-white" data-bs-toggle="modal" data-bs-target="#update_work_shift" style="border: none;" data-update_work_shift_id="' . $row->work_shift_id . '">
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
        $data['title']='Manage Work Shift';
        $data['navbar_headings']='Manage Work Shift';
        return view('hrm/create_work_shift',$data);
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
            'shift_name'=>'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);
        $request['company_id']=session()->get('company_id');
        $work_shift_added= WorkShift::create($request->all());
        if($work_shift_added){
            return response()->json(true);
        }
        else{
            return response()->json(false);
        }

        
    }

// update

    public function fetch_work_shift(Request $request)
    {
        $update_work_shift_id = $request->update_work_shift_id;
        $single_work_shift_query =  DB::table('work_shifts')
            ->select('*')
            ->where('work_shift_id', '=', $update_work_shift_id)
            ->get();
        $leave = $single_work_shift_query->first();
        return response()->json($leave);
    }

    public function update_work_shift(Request $request){
        unset($request['_token']);
        $request->validate([
            'shift_name'=>'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);
        $request['company_id']=session()->get('company_id');

        $work_shift_updated= WorkShift::where('work_shift_id',$request->work_shift_id)->update ($request->all());
        if($work_shift_updated){
            return response()->json(true);
        }
        else{
            return response()->json(false);
        }



    }
    // delete
    public function delete_work_shift(Request $request)
    {
        $delete_work_shift_id = $request->delete_work_shift_id;
        $work_shift_deleted = WorkShift::where('work_shift_id', $delete_work_shift_id)->delete();

        if ($work_shift_deleted) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

}

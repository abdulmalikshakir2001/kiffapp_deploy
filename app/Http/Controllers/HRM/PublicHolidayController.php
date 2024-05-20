<?php

namespace App\Http\Controllers\HRM;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HRM\PublicHoliday;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class PublicHolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title']='Manage Public Holiday';
        $data['navbar_headings']='Manage Public Holiday';
        return view('hrm/view_public_holiday',$data);
    }
    public function getData(Request $request)
    {
        // start 
$public_holiday_table =  DB::table('public_holidays')->where('company_id', session()->get('company_id'))->get();


// end
        // $public_holidays =  DB::table('public_holidays')->where('company_id',session()->get('company_id'))->get();
        $allData = DataTables::of($public_holiday_table)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
            $btn =
            '<button type="button" class="text-secondary public_holiday_delete_btn bg-white"  style="border:none;" data-delete_public_holiday_id="' . $row->public_holiday_id . '"  data-bs-toggle="modal" data-bs-target="#delete_confirm_public_holiday"><i class="fas fa-trash-alt fs-6 text-danger"></i>
            </button><button class="text-secondary sidenav_zero_index public_holiday_edit_btn  bg-white" data-bs-toggle="modal" data-bs-target="#update_public_holiday" style="border: none;" data-update_public_holiday_id="' . $row->public_holiday_id . '">
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
        $data['title']='Manage Public Holiday';
        $data['navbar_headings']='Manage Public Holiday';
        return view('hrm/create_public_holiday',$data);
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
            'holiday_name'=>'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        $request['company_id']=session()->get('company_id');
        $public_holiday_added= PublicHoliday::create($request->all());
        if($public_holiday_added){
            return response()->json(true);
        }
        else{
            return response()->json(false);
        }

        
    }

// update

    public function fetch_public_holiday(Request $request)
    {
        $update_public_holiday_id = $request->update_public_holiday_id;
        $single_public_holiday_query =  DB::table('public_holidays')
            ->select('*')
            ->where('public_holiday_id', '=', $update_public_holiday_id)
            ->get();
        $leave = $single_public_holiday_query->first();
        return response()->json($leave);
    }

    public function update_public_holiday(Request $request){
        unset($request['_token']);
        $request->validate([
            'holiday_name'=>'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        $request['company_id']=session()->get('company_id');

        $public_holiday_updated= PublicHoliday::where('public_holiday_id',$request->public_holiday_id)->update ($request->all());
        if($public_holiday_updated){
            return response()->json(true);
        }
        else{
            return response()->json(false);
        }



    }
    // delete
    public function delete_public_holiday(Request $request)
    {
        $delete_public_holiday_id = $request->delete_public_holiday_id;
        $public_holiday_deleted = PublicHoliday::where('public_holiday_id', $delete_public_holiday_id)->delete();

        if ($public_holiday_deleted) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

}

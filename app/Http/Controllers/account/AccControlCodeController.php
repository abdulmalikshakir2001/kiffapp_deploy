<?php

namespace App\Http\Controllers\account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\account\AccControlCode;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use DNS1D;
use DNS2D;

class AccControlCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title'] = 'Manage Control Code ';
        $data['navbar_headings'] = 'Manage Control Code ';
        $data['warehouses'] = DB::table('pur_warehouses')->where('company_id','=',session('company_id'))->get();
        return view('account/accControlCodeView', $data);
    }
    public function getData(Request $request)
    {
        $accControlCodeTable =  AccControlCode::where('company_id', session()->get('company_id'))->get();
        $allData = DataTables::of($accControlCodeTable)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn =
                    '<button type="button" class="text-secondary accControlCodeDeleteBtn bg-white"  style="border:none;" data-acc_control_code_id="' . $row->acc_control_code_id . '"  data-bs-toggle="" data-bs-target=""><i class="fas fa-trash-alt fs-6 text-danger"></i>
            </button><button class="text-secondary sidenav_zero_index accControlCodeEditBtn  bg-white" data-bs-toggle="modal" data-bs-target="#accControlCodeUpdateModal" style="border: none;" data-acc_control_code_id="' . $row->acc_control_code_id . '">
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
        $data['title'] = 'Manage Control Code ';
        $data['navbar_headings'] = 'Manage Control Code ';
        return view('account/accControlCodeCreate', $data);
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
            'control_code' => 'required',
            
            
        ]);
        $request['company_id'] = session()->get('company_id');
        

        $accControlCodeAdded = AccControlCode::create($request->all());
        if ($accControlCodeAdded) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    // update

    public function accControlCodeFetch(Request $request)
    {
        $accControlCodeId = $request->accControlCodeId;
        $accControlCodeSingle =  DB::table('acc_control_codes')
            ->select('*')
            ->where('acc_control_code_id', '=', $accControlCodeId)
            ->get();
        $asset = $accControlCodeSingle->first();
        return response()->json($asset);
    }

    public function update(Request $request)
    {
        unset($request['_token']);
        $request->validate([
            'control_code' => 'required',
            
        ]);
        $request['company_id'] = session()->get('company_id');
        
        


        $accControlCodeUpdated = AccControlCode::where('acc_control_code_id', $request->acc_control_code_id)->update($request->all());
        if ($accControlCodeUpdated) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
    // delete
    public function delete(Request $request)
    {
        $accControlCodeId = $request->accControlCodeId;
        $accControlCodeDeleted = AccControlCode::where('acc_control_code_id', $accControlCodeId)->delete();

        if ($accControlCodeDeleted) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
}

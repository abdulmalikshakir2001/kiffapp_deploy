<?php

namespace App\Http\Controllers\account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\account\AccFiscalPeriod;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use DNS1D;
use DNS2D;

class AccFiscalPeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title'] = 'Manage Fiscal Period';
        $data['navbar_headings'] = 'Manage Fiscal Period';
        $data['warehouses'] = DB::table('pur_warehouses')->where('company_id','=',session('company_id'))->get();
        return view('account/accFiscalPeriodView', $data);
    }
    public function getData(Request $request)
    {
        
        $accFiscalPeriodTable =  AccFiscalPeriod::where('company_id', session()->get('company_id'))->get();


        
        
        $allData = DataTables::of($accFiscalPeriodTable)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn =
                    '<button type="button" class="text-secondary accFiscalPeriodDeleteBtn bg-white"  style="border:none;" data-acc_fiscal_period_id="' . $row->acc_fiscal_period_id . '"  data-bs-toggle="" data-bs-target=""><i class="fas fa-trash-alt fs-6 text-danger"></i>
            </button><button class="text-secondary sidenav_zero_index accFiscalPeriodEditBtn  bg-white" data-bs-toggle="modal" data-bs-target="#accFiscalPeriodUpdateModal" style="border: none;" data-acc_fiscal_period_id="' . $row->acc_fiscal_period_id .'">
                    <a href="#"> <i class="fas fa-edit fs-6 text-success ">
                    </i>
                    </a>
                </button>';
                return $btn;
            })->addColumn('status',function($row){
                if($row->status == 'on'){
                    $statusButton = '<div class="form-check form-switch">
                    <input class="form-check-input status_add" type="checkbox" id="status_add" name="status_add" checked ="" data-status="off" data-id='.$row->acc_fiscal_period_id.' 
                    data-bs-toggle="modal" data-bs-target="#status_change_modal"
                    >
                  </div>';
                  return $statusButton;

                }
                else{
                    $statusButton = '<div class="form-check form-switch">
                    <input class="form-check-input status_add" type="checkbox" id="status_add" name="status_add"
                    data-status="on" data-id='.$row->acc_fiscal_period_id.' 
                    data-bs-toggle="modal" data-bs-target="#status_change_modal">
                  </div>';
                  return $statusButton;

                }

            })
            ->rawColumns(['action','status'])
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
        $data['title'] = 'Manage Fiscal Period';
        $data['navbar_headings'] = 'Manage Fiscal Period';
        return view('account/accFiscalPeriodCreate', $data);
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
        // return response()->json($request->all());
        $request->validate([
            'name' => 'required',
            'start_date'=>'required',
            'end_date'=>'required',
            
        ]);
        $request['company_id'] = session()->get('company_id');
        $request['status'] = $request->status_add =='on' ?'on':'off';
        unset($request['status_add']);
        

        $accFiscalPeriodAdded = AccFiscalPeriod::create($request->all());
        if ($accFiscalPeriodAdded) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    // update

    public function accFiscalPeriodFetch(Request $request)
    {
        $accFiscalPeriodId = $request->accFiscalPeriodId;
        $accFiscalPeriodSingle =  DB::table('acc_fiscal_periods')
            ->select('*')
            ->where('acc_fiscal_period_id', '=', $accFiscalPeriodId)
            ->get();
        $asset = $accFiscalPeriodSingle->first();
        return response()->json($asset);
    }

    public function update(Request $request)
    {
        unset($request['_token']);
        $request->validate([
            'name' => 'required',
            'start_date'=>'required',
            'end_date'=>'required',
        ]);
        $request['company_id'] = session()->get('company_id');
        
        


        $accFiscalPeriodUpdated = AccFiscalPeriod::where('acc_fiscal_period_id', $request->acc_fiscal_period_id)->update($request->all());
        if ($accFiscalPeriodUpdated) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
    // delete
    public function delete(Request $request)
    {
        $accFiscalPeriodId = $request->accFiscalPeriodId;
        $accFiscalPeriodDeleted = AccFiscalPeriod::where('acc_fiscal_period_id', $accFiscalPeriodId)->delete();

        if ($accFiscalPeriodDeleted) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
    public function statusChange(Request $request)
    {
        // return response()->json($request->status);
        
        $accFiscalPeriodUpdated = AccFiscalPeriod::where('acc_fiscal_period_id', $request->status_change_id)->update([
            'status' =>$request->status
        ]);

        if ($accFiscalPeriodUpdated) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
}

<?php

namespace App\Http\Controllers\account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\account\AccTransaction;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use DNS1D;
use DNS2D;

class AccAuthorizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title'] = 'Authorization';
        $data['navbar_headings'] = 'Authorization';
        return view('account/acc_authorization', $data);
    }
    public function getData(Request $request)
    {
        
        $accCostCenterTable =  AccTransaction::where('company_id', session()->get('company_id'))->get();


        
        
        $allData = DataTables::of($accCostCenterTable)
            ->addIndexColumn()
            ->addColumn('status', function ($row) {
                if($row->status == 'posted'){
                    return ' <span class="badge bg-gradient-success">approved</span>';

                }
                else{
                    return  '<a href="'.route('acc_transaction_post_view',['acc_transaction_id'=> $row->acc_transaction_id]).'"> <span class="badge bg-gradient-info">post</span> </a>';


                }
                
            })->addColumn('fiscal_period_id',function($row){
                return $row->fiscalPeriod->name;
            })
            ->addColumn('cost_center_id',function($row){
                return $row->costCenter->name;
            })
            ->addColumn('control_code_id',function($row){
                return $row->controlCode->control_code;
            })
            ->rawColumns(['status','cost_center_id','fiscal_period_id','control_code_id','currency_id'])
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
        $data['title'] = 'Manage Transaction Category';
        $data['navbar_headings'] = 'Manage Transaction Category';
        return view('account/accCostCenterCreate', $data);
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
            'name' => 'required',
            
            
        ]);
        $request['company_id'] = session()->get('company_id');
        

        $accCostCenterAdded = AccCostCenter::create($request->all());
        if ($accCostCenterAdded) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    // update

    public function accCostCenterFetch(Request $request)
    {
        $accCostCenterId = $request->accCostCenterId;
        $accCostCenterSingle =  DB::table('acc_cost_centers')
            ->select('*')
            ->where('acc_cost_center_id', '=', $accCostCenterId)
            ->get();
        $asset = $accCostCenterSingle->first();
        return response()->json($asset);
    }

    public function update(Request $request)
    {
        unset($request['_token']);
        $request->validate([
            'name' => 'required',
            
        ]);
        $request['company_id'] = session()->get('company_id');
        
        


        $accCostCenterUpdated = AccCostCenter::where('acc_cost_center_id', $request->acc_cost_center_id)->update($request->all());
        if ($accCostCenterUpdated) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
    // delete
    public function delete(Request $request)
    {
        $accCostCenterId = $request->accCostCenterId;
        $accCostCenterDeleted = AccCostCenter::where('acc_cost_center_id', $accCostCenterId)->delete();

        if ($accCostCenterDeleted) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
}

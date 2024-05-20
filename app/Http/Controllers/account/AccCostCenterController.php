<?php

namespace App\Http\Controllers\account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\account\AccCostCenter;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use DNS1D;
use DNS2D;

class AccCostCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title'] = 'Manage Transaction Category';
        $data['navbar_headings'] = 'Manage Transaction Category';
        $data['warehouses'] = DB::table('pur_warehouses')->where('company_id','=',session('company_id'))->get();
        return view('account/accCostCenterView', $data);
    }
    public function getData(Request $request)
    {
        
        $accCostCenterTable =  AccCostCenter::where('company_id', session()->get('company_id'))->get();


        
        
        $allData = DataTables::of($accCostCenterTable)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn =
                    '<button type="button" class="text-secondary accCostCenterDeleteBtn bg-white"  style="border:none;" data-acc_cost_center_id="' . $row->acc_cost_center_id . '"  data-bs-toggle="" data-bs-target=""><i class="fas fa-trash-alt fs-6 text-danger"></i>
            </button><button class="text-secondary sidenav_zero_index accCostCenterEditBtn  bg-white" data-bs-toggle="modal" data-bs-target="#accCostCenterUpdateModal" style="border: none;" data-acc_cost_center_id="' . $row->acc_cost_center_id . '">
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

<?php

namespace App\Http\Controllers\purchase;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\purchase\PurWarehouse;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class PurWarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title']='Manage Warehouse';
        $data['navbar_headings']='Manage Warehouse';
        $data['countries']=DB::table('countries')->get();
        return view('purchase/pur_warehouse_view',$data);
    }
    public function getData(Request $request)
    {
        // start 
$purWarehouseTable =  DB::table('pur_warehouses')->where('company_id',session()->get('company_id'))->get();


// end
        // $proBrands =  DB::table('proBrands')->where('company_id',session()->get('company_id'))->get();
        $allData = DataTables::of($purWarehouseTable)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
            $btn =
            '<button type="button" class="text-secondary pur_warehouse_delete_btn bg-white"  style="border:none;" data-pur_warehouse_id="' . $row->warehouse_id . '"  data-bs-toggle="modal" data-bs-target="#pur_warehouse_delete_confirm"><i class="fas fa-trash-alt fs-6 text-danger"></i>
            </button><button class="text-secondary sidenav_zero_index pur_warehouse_edit_btn  bg-white" data-bs-toggle="modal" data-bs-target="#pur_warehouse_update_modal" style="border: none;" data-pur_warehouse_id="' . $row->warehouse_id . '">
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
    // public function create()
    // {
    //     //
    //     $data['title']='Manage Warehouse';
    //     $data['navbar_headings']='Manage Warehouse';
    //     return view('purchase/pur_warehouse_create',$data);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        unset($request['_token']);
        $request['country']=$request->country_add;
        unset($request['country_add']);
        $request->validate([
            'warehouse_name'=>'required',
            'contact_number'=>'required',
            'city'=>'required',
            'country'=>'required',
        ]);
        $request['company_id']=session()->get('company_id');
        

        
        $purWarehouseAdded= PurWarehouse::create($request->all());
        if($purWarehouseAdded){
            return response()->json(true);
        }
        else{
            return response()->json(false);
        }

        
    }

// update

    public function purWarehouseFetch(Request $request)
    {
        $purWarehouseId = $request->purWarehouseId;
        $purWarehouseSingle =  DB::table('pur_warehouses')
            ->select('*')
            ->where('warehouse_id', '=', $purWarehouseId)
            ->get();
        $firstWarehouse = $purWarehouseSingle->first();
        return response()->json($firstWarehouse);
    }

    public function update(Request $request){
        unset($request['_token']);
        $request->validate([
            'warehouse_name'=>'required',
            'contact_number'=>'required',
            'city'=>'required',
            'country'=>'required',
        ]);
        $request['company_id']=session()->get('company_id');
        $purWarehouseUpdated= PurWarehouse::where('warehouse_id',$request->warehouse_id)->update ($request->all());
        if($purWarehouseUpdated){
            return response()->json(true);
        }
        else{
            return response()->json(false);
        }



    }
    // delete
    public function delete(Request $request)
    {
        $purWarehouseId = $request->purWarehouseId;
        $purWarehouseDeleted = PurWarehouse::where('warehouse_id', $purWarehouseId)->delete();

        if ($purWarehouseDeleted) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

}

<?php

namespace App\Http\Controllers\purchase;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\purchase\PurWarehouseStock;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class PurWarehouseStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title']='Warehouse Stock';
        $data['navbar_headings']='Warehouse Stock';
        $data['warehouses']=DB::table('pur_warehouses')->where('company_id',session()->get('company_id'))->get();
        $data['products']=DB::table('pro_products')->where('company_id',session()->get('company_id'))->get();
        return view('purchase/pur_warehouse_stock_view',$data);
    }
    public function getData(Request $request)
    {
        // start 

        $warehouseStockTable=  DB::table('pur_warehouse_stocks')->where('company_id',session()->get('company_id'))->get();
    $warehouseStockObj =  [];
    foreach($warehouseStockTable as $warehouseStock){
        $product =  DB::table('pro_products')->select('product_id','product_name')->where('product_id',$warehouseStock->product_id)->get()->first();
        $warehouse =  DB::table('pur_warehouses')->select('warehouse_name','address','city','country')->where('warehouse_id',$warehouseStock->warehouse_id)->get()->first();
        // print_r($warehouseStockTable[]);
        // formatArray( array_merge((array) $warehouseStock,(array) $product,(array) $warehouse));
         $singleWarehouseObj = array_merge((array) $warehouseStock,(array) $product,(array) $warehouse);
         array_push( $warehouseStockObj,(object) $singleWarehouseObj);



    }
    
    $warehouseStockObj2= collect( $warehouseStockObj);
    
// $purWarehouseStockTable =  DB::table('pur_warehouse_stocks')->where('company_id',session()->get('company_id'))->get();


// end
        // $proBrands =  DB::table('proBrands')->where('company_id',session()->get('company_id'))->get();
        $allData = DataTables::of($warehouseStockObj2)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
            $btn =
            '<button type="button" class="text-secondary pur_warehouse_stock_delete_btn bg-white"  style="border:none;" data-pur_warehouse_stock_id="' . $row->warehouse_stock_id . '"  data-bs-toggle="modal" data-bs-target="#pur_warehouse_stock_delete_confirm"><i class="fas fa-trash-alt fs-6 text-danger"></i>
            </button><button class="text-secondary sidenav_zero_index pur_warehouse_stock_edit_btn  bg-white" data-bs-toggle="modal" data-bs-target="#pur_warehouse_stock_update_modal" style="border: none;" data-pur_warehouse_stock_id="' . $row->warehouse_stock_id . '">
                    <a href="#"> <i class="fas fa-edit fs-6 text-success ">
                    </i>
                    </a>
                </button>';
            return $btn;
        })->addColumn('address',function($row){
            return $row->address ." ".$row->city.','.$row->country ;

        })
        ->rawColumns(['action','address'])
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
    //     return view('purchase/pur_warehouse_stock_create',$data);
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
        $request->validate([
            'warehouse_id'=>'required',
            'product_id'=>'required',
            'stock_qty'=>'required',
        ]);
        // $request['company_id']=session()->get('company_id');
        $request['company_id']=session()->get('company_id');
        // return response()->json($request->all());
        

        
        $purWarehouseStockAdded= PurWarehouseStock::create($request->all());
        if($purWarehouseStockAdded){
            return response()->json(true);
        }
        else{
            return response()->json(false);
        }

        
    }

// update

    public function purWarehouseStockFetch(Request $request)
    {
        $purWarehouseStockId = $request->purWarehouseStockId;
        $purWarehouseStockSingle =  DB::table('pur_warehouse_stocks')
            ->select('*')
            ->where('warehouse_stock_id', '=', $purWarehouseStockId)
            ->get();
        $firstWarehouse = $purWarehouseStockSingle->first();
        return response()->json($firstWarehouse);
    }

    public function update(Request $request){
        unset($request['_token']);
        // return response()->json($request->all());
            $request->validate([
                'warehouse_id_update'=>'required',
                'product_id_update'=>'required',
                'stock_qty'=>'required',
            ]);
        $request['company_id']=session()->get('company_id');
        $request['warehouse_id']=$request->warehouse_id_update;
        $request['product_id']=$request->product_id_update;
        unset($request['product_id_update']);
        unset($request['warehouse_id_update']);
        $purWarehouseStockUpdated= PurWarehouseStock::where('warehouse_stock_id',$request->warehouse_stock_id)->update ($request->all());
        if($purWarehouseStockUpdated){
            return response()->json(true);
        }
        else{
            return response()->json(false);
        }



    }
    // delete
    public function delete(Request $request)
    {
        $purWarehouseStockId = $request->purWarehouseStockId;
        $purWarehouseStockDeleted = PurWarehouseStock::where('warehouse_stock_id', $purWarehouseStockId)->delete();

        if ($purWarehouseStockDeleted) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

}

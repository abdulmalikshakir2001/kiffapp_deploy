<?php

namespace App\Http\Controllers\inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\product\ProProduct;
use App\Models\purchase\PurWarehouse;
use App\Models\purchase\PurWarehouseStock;
use Yajra\DataTables\Facades\DataTables;

class InventoryReportsController extends Controller
{
    //
    public function productReportView(Request $request)
    {
        $data['title'] = 'Product Reports';
        $data['navbar_headings'] = 'Product Reports';
        return view('inventory/reports/product_report_view', $data);
    }

    


    public function productReport(Request $request){
        if($request->search_product != null){
            $product = ProProduct::where('company_id', session()->get('company_id'))->where('product_name','=',$request->search_product)->orWhere('product_sku','=',$request->search_product)->get()->first();

            $stock =  PurWarehouseStock::where('product_id','=',$product->product_id)->get() ;
            // $request['stock'] = $stock->pluck('stock_qty')->sum();

            $stockCount  =  $stock->count();
            if($stockCount>0){

            $allData = DataTables::of($stock)
                ->addIndexColumn()
                ->addColumn('product_sku',function($row){
                    return $row->product->product_sku;

                })
                ->addColumn('product_name',function($row){
                    return $row->product->product_name;

                })
                ->addColumn('product_sale_price',function($row){
                    return $row->product->product_sale_price;

                })
                ->addColumn('product_purchase_price',function($row){
                    return $row->product->product_purchase_price;

                })
                ->addColumn('product_description',function($row){
                    return $row->product->product_description;

                })
                ->addColumn('product_taxes',function($row){
                    return $row->product->product_taxes;

                })
                ->addColumn('product_unit',function($row){
                    return $row->product->product_unit;

                })
                ->addColumn('warehouse_name',function($row){
                    return $row->warehouse->warehouse_name;

                })
                
                ->rawColumns(['product_name','warehouse_name','product_sale_price','product_purchase_price','product_description','product_taxes','product_unit'])
                ->with(['stock'=>$stock->pluck('stock_qty')->sum()])->toJson();
                return $allData;
                
                

            }
            else{
                return  response()->json([]) ;

            }
            

        }
        return  response()->json([]) ;
        


        // $ims_damage_stocks_table = ProProduct::where('company_id', session()->get('company_id'))->get();
        // $allData = DataTables::of($ims_damage_stocks_table)
        //     ->addIndexColumn()
        //     ->rawColumns([])
        //     ->make(true);
        // return $allData;


    }


    public function warehouseReportView(Request $request)
    {
        $data['title'] = 'Warehouse Reports';
        $data['navbar_headings'] = 'Warehouse Reports';
        return view('inventory/reports/warehouse_report_view', $data);
    }

    public function warehouseReport(Request $request){
         if( $request->search_warehouse != null){
            $warehouse = PurWarehouse::where('company_id','=',session('company_id'))->where('warehouse_name','=',$request->search_warehouse)->get()->first();

            $warehouseStock =  PurWarehouseStock::where('company_id','=',session('company_id'))->where('warehouse_id','=',$warehouse->warehouse_id)->get();

            



            $allData = DataTables::of($warehouseStock)
                ->addIndexColumn()
                ->addColumn('product_sku',function($row){
                    return $row->product->product_sku;

                })
                ->addColumn('product_name',function($row){
                    return $row->product->product_name;

                })
                ->addColumn('product_sale_price',function($row){
                    return $row->product->product_sale_price;

                })
                ->addColumn('product_purchase_price',function($row){
                    return $row->product->product_purchase_price;

                })
                ->addColumn('warehouse_name',function($row){
                    return $row->warehouse->warehouse_name;

                })
                ->addColumn('product_description',function($row){
                    return $row->product->product_description;

                })
                ->addColumn('product_taxes',function($row){
                    return $row->product->product_taxes;

                })
                ->addColumn('product_unit',function($row){
                    return $row->product->product_unit;


                })->with(['stock'=>$warehouseStock->pluck('stock_qty')->sum()])->toJson();
                
                
                

                return $allData; 
                

            

         }
         return [];


    }


    
}

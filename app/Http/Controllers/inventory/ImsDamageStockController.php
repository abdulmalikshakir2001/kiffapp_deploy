<?php

namespace App\Http\Controllers\inventory;

use App\Http\Controllers\Controller;
use App\Models\Users\User;
use App\Models\inventory\ImsDamageStock;
use App\Models\inventory\ImsDamageStockDetail;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
// use PDF;
use DNS1D;
use DNS2D;
// use DOMPDF;
use Barryvdh\DomPDF\Facade\Pdf;

class ImsDamageStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['title'] = 'All Damage Stock';
        $data['navbar_headings'] = 'All Damage Stock';
        return view('inventory/ims_damage_stock_view', $data);
    }
    public function getData(Request $request)

    {
        $ims_damage_stocks_table = ImsDamageStock::where('company_id', session()->get('company_id'))->get();
        
        $allData = DataTables::of($ims_damage_stocks_table)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn =
                    '<button  type="button"  class="text-secondary  ims_damage_stock_delete_btn bg-white "  style="border:none;" data-ims_damage_stock_id="' . $row->ims_damage_stock_id . '" data-bs-toggle="modal" data-bs-target="#" ><i class="fas fa-trash-alt fs-6 text-danger"></i>
            </button>
            <button class="text-secondary  ims_damage_stock_edit_btn bg-white"  style="border: none;" data-ims_damage_stock_id="' . $row->ims_damage_stock_id . '" >
                    <a href="#"> <i class="fas fa-edit fs-6 text-success">
                    </i>
                    </a>
                </button>



                <button class="badge-info text-secondary  sidenav_zero_index border_5_font_12 ims_damage_stock_detail_button"  style="border: none;" data-ims_damage_stock_id="' . $row->ims_damage_stock_id . '" >
                        <a href="' . route('ims_damage_stock_detail', $row->ims_damage_stock_id) . '" class="text-white"> <i class="fas fa-eye ">
                        </i>
                        View
                        </a>
                    </button>
                ';
                return $btn;
            })->addColumn('status', function ($row) {

                switch ($row->status) {
                    case 'pending':
                        $btn =  '
                <input type="checkbox"  data-toggle="switchbutton" checked data-onlabel="pending" data-offlabel="Process" data-onstyle="success" data-offstyle="danger" id="open_close_switch" class="open_close_switch  data-bs-toggle="modal" data-bs-target="#status_change_modal" letter_spacing"   data-status="processing" data-width="100" data-height="25" 
                data-id=' . $row->ims_damage_stock_id . '
                >
               ';
                        return $btn;
                    case 'processing':
                        $btn =  '
                <input type="checkbox"  data-toggle="switchbutton" checked data-onlabel="process" data-offlabel="Approved" data-onstyle="info" data-offstyle="danger" id="open_close_switch" class="open_close_switch letter_spacing"  data-bs-toggle="modal" data-bs-target="#status_change_modal"  data-status="approved" data-width="100" data-height="25" 
                data-id=' . $row->ims_damage_stock_id . '
                >
               ';
                        return $btn;
                    default:
                        return '<span class="badge bg-dark">Approved</span>';
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
        $data['title'] = ' Damage Stock';
        $data['navbar_headings'] = 'Damage Stock';
        $data['taxes'] = DB::table('pro_taxes')->where('company_id', session()->get('company_id'))->get();
        
        
        

        $data['products'] = DB::table('pro_products')->where('company_id', session()->get('company_id'))->get();
        return view('inventory/ims_damage_stock_create', $data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return response()->json(1);
        unset($request['_token']);
        $request->validate([
            'ref_num' => 'required',

            

        ]);




        $req = $request->only([
            'ref_num',
            'description'

        ]);
        $req['company_id'] = session()->get('company_id');
        $req['status'] = 'pending';
          $user =  DB::table('users')->where('company_id','=',session('company_id'))->where('user_id','=',session('user_id'))->get()->first();
          $req['warehouse_id'] = $user->warehouse_id;






        


        $currentDateTime = Carbon::now()->format('Y-m-d H:i:s');

        $randNumber = rand(1345689359, 1098354890);
        $qrCodeRandNumber = rand(1345689359, 9999994899);
        $req['barcode'] = $randNumber;
        $req['barcode_string'] = json_encode(DNS1D::getBarcodeHTML($randNumber, 'C128'));
        $req['qr_code'] = $qrCodeRandNumber;
        $req['qr_code_string'] = json_encode(DNS2D::getBarcodeHTML(".$qrCodeRandNumber.", 'QRCODE', 5, 5));
        $req['created_at'] = $currentDateTime;
        $req['updated_at'] = $currentDateTime;
        $lastInsertionId = ImsDamageStock::insertGetId($req);
        if ($lastInsertionId) {

            $productIdsArray = explode(',', $request->product_ids_array);

            $productQuantityArray = explode(',', $request->product_quantity_array);


            $i = 0;
            foreach ($productIdsArray as $productId) {

                DB::table('ims_damage_stock_details')->insert([
                    'ims_damage_stock_id' => $lastInsertionId,
                    'product_id' => $productId,
                    'quantity' => $productQuantityArray[$i],
                    'created_at' => $currentDateTime,
                    'updated_at' => $currentDateTime
                ]);
                $i++;
            }
            return response()->json('true');
        }
    }

    public function delete(Request $request)
    {
        $ims_damage_stock_id = $request->imsDamageStockId;

        $StockRequestDeleted = ImsDamageStock::where('ims_damage_stock_id', $ims_damage_stock_id)->delete();
        if ($StockRequestDeleted) {
            return response()->json('true');
        } else {
            return response()->json('false');
        }
    }

    public function updateForm(Request $request)
    {
        $data['title'] = ' Damage Stock';
        $data['navbar_headings'] = '  Damage Stock';
        $data['warehouses'] =  DB::table('pur_warehouses')->where('company_id', '=', session('company_id'))->get();
        $data['taxes'] = DB::table('pro_taxes')->where('company_id', session()->get('company_id'))->get();
        $data['employees'] = DB::table('users')->where('company_id', session()->get('company_id'))->get();

        $data['products'] = DB::table('pro_products')->where('company_id', session()->get('company_id'))->get();
        $data['ims_damage_stock'] = ImsDamageStock::with('details')->find($request->imsDamageStockId);
        // $data['ims_damage_stock']= DB::table('ims_damage_stocks')->where('ims_damage_stock_id',$request->imsDamageStockId)->get()->first();
        return view('inventory/ims_damage_stock_update', $data);
    }
    public function update(Request $request)
    {
        unset($request['_token']);
        $request->validate([
            'ref_num' => 'required',
        ]);




        $req = $request->only([
            'ref_num',

            'description',


        ]);
        $req['company_id'] = session()->get('company_id');
        



        $updatedAt = Carbon::now()->format('Y-m-d H:i:s');

        // $randNumber= rand(1345689359, 1098354890);
        // $req['ims_damage_stock_code'] = $randNumber;
        // $req['barcode'] = json_encode(DNS1D::getBarcodeHTML($randNumber, 'C128'));
        $lastInsertionId = ImsDamageStock::where('ims_damage_stock_id', $request->ims_damage_stock_id)->update($req);
        if ($lastInsertionId) {

            $productIdsArray = explode(',', $request->product_ids_array);

            $productQuantityArray = explode(',', $request->product_quantity_array);

            $detailIdArray = explode(',', $request->detail_id_array);

            $i = 0;
            foreach ($productIdsArray as $productId) {

                DB::table('ims_damage_stock_details')->where('ims_damage_stock_detail_id', $detailIdArray[$i])->update([
                    'product_id' => $productId,
                    'quantity' => $productQuantityArray[$i],
                    'updated_at' => $updatedAt,
                ]);
                $i++;
            }
            return response()->json('true');
        }
    }

    public function Details(Request $request)
    {
        $data['title'] = 'Damage StockDetails';
        $data['navbar_headings'] = 'Damage StockDetails';
        $data['warehouses'] =  DB::table('pur_warehouses')->where('company_id', '=', session('company_id'))->get();
        $data['taxes'] = DB::table('pro_taxes')->where('company_id', session()->get('company_id'))->get();
        $data['employees'] = DB::table('users')->where('company_id', session()->get('company_id'))->get();

        $data['products'] = DB::table('pro_products')->where('company_id', session()->get('company_id'))->get();
        $data['ims_damage_stock'] = ImsDamageStock::with('details')->find($request->ims_damage_stock_id);
        // $data['ims_damage_stock']= DB::table('ims_damage_stocks')->where('ims_damage_stock_id',$request->imsDamageStockId)->get()->first();
        return view('inventory/ims_damage_stock_detail', $data);
    }




    public function imsDamageStockUrl(Request $request)
    {
        $url = url('ims_damage_stock_details_print' . '/' . $request->id);
        return response()->json($url);
    }


    public function imsDamageStockDetailsPrint(Request $request)
    {
        $data['title'] = 'Damage StockDetails';
        $data['navbar_headings'] = 'Damage StockDetails';
        $data['warehouses'] =  DB::table('pur_warehouses')->where('company_id', '=', session('company_id'))->get();
        $data['taxes'] = DB::table('pro_taxes')->where('company_id', session()->get('company_id'))->get();
        $data['employees'] = DB::table('users')->where('company_id', session()->get('company_id'))->get();

        $data['products'] = DB::table('pro_products')->where('company_id', session()->get('company_id'))->get();
        $result = ImsDamageStock::with('products')->find($request->id);
        $data['company'] = DB::table('companies')->where('company_id', session()->get('company_id'))->get()->first();
        $data['ims_damage_stock'] = $result->toArray();
        $data['result'] = $result;
        // for hrm view payroll start
        $pdf = Pdf::loadView('inventory.ims_damage_stock_detail_print', $data);
        return  $pdf->stream() ;
        ;

        //  return response()->json( $pdf->output());
        // return response($pdf->output(), 200, [
        //     'Content-Type' => 'application/pdf',
        //     'Content-Disposition' => 'inline; filename="file.pdf"',
        // ]);
    }
    // fetch taxes 
    public function updateImsDamageStockStatus(Request $request)
    {
        

        // return response()->json($request->status);
        if ($request->status == 'approved') {
            $user =  DB::table('users')->where('user_id','=',session('user_id'))->get()->first();


            $damageStock =  ImsDamageStock::find($request->id);
            $productIdsArray =  $damageStock->details->pluck('product_id')->toArray();
            $productqtyArray =  $damageStock->details->pluck('quantity')->toArray();

            $i = 0;
            foreach ($productIdsArray as $productId) {
                updateStockByWarehouse($user->warehouse_id, $productId, $productqtyArray[$i]);

                $i++;
            }
        }
        $statusUpdated =  DB::table('ims_damage_stocks')->where('ims_damage_stock_id', '=', $request->id)->update([
            'status' => $request->status

        ]);
        // return response()->json($statusUpdated);
        if ($statusUpdated) {




            return response()->json(true);
        }
    }
}

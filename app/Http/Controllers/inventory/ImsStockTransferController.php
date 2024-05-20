<?php

namespace App\Http\Controllers\inventory;

use App\Http\Controllers\Controller;
use App\Models\Users\User;
// use App\Models\inventory\ImsStockRequest;
use App\Models\inventory\ImsStockRequest;
use App\Models\inventory\ImsStockRequestDetail;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
// use PDF;
use DNS1D;
use DNS2D;
use Barryvdh\DomPDF\Facade\Pdf;


class ImsStockTransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['title'] = 'Transfer Notes';
        $data['navbar_headings'] = 'Transfer Notes';
        return view('inventory/ims_stock_transfer_view', $data);
    }
    public function getData(Request $request)

    {
        $ims_stock_requests_table = ImsStockRequest::where('company_id', session()->get('company_id'))->where('status','=','processing')->get();
        // $crmLead =  DB::table('crm_leads')->where('company_id', session()->get('company_id'))->get();
        $allData = DataTables::of($ims_stock_requests_table)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn =
                    '<button  type="button"  class="text-secondary  ims_stock_request_delete_btn bg-white "  style="border:none;" data-ims_stock_request_id="' . $row->ims_stock_request_id . '" ><i class="fas fa-trash-alt fs-6 text-danger"></i>
            </button>
            <button class="text-secondary  ims_stock_transfer_edit_btn bg-white"  style="border: none;" data-ims_stock_request_id="' . $row->ims_stock_request_id . '" >
                    <a href="#"> <i class="fas fa-edit fs-6 text-success">
                    </i>
                    </a>

                </button>
                <button class="badge-info text-secondary  sidenav_zero_index border_5_font_12 ims_stock_request_detail_button"  style="border: none;" data-ims_stock_request_id="' . $row->ims_stock_request_id . '" >
                        <a href="' . route('ims_stock_transfer_detail', $row->ims_stock_request_id) . '" class="text-white"> <i class="fas fa-eye ">
                        </i>
                        View
                        </a>
                    </button>
                ';
                return $btn;
            })
            ->addColumn('employee_id',function($row){
                return $row->stockRequestBy->username;

            })
            ->addColumn('stock_request_from',function($row){
                return $row->stockRequestFrom->warehouse_name;

            })
            ->addColumn('stock_request_to',function($row){
                return $row->stockRequestTo->warehouse_name;

            })
            ->addColumn('status',function($row){
                return '<span class="badge bg-dark">Processing</span>';

            })

            ->rawColumns(['action','employee_id','stock_request_from','stock_request_to','status'])
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
        $data['title'] = ' Stock Request';
        $data['navbar_headings'] = 'Stock Request';
        $data['warehouses'] =  DB::table('pur_warehouses')->where('company_id', '=', session('company_id'))->get();
        $data['stockRequests'] =  DB::table('ims_stock_requests')->where('company_id', '=', session('company_id'))->get();
        $data['taxes'] = DB::table('pro_taxes')->where('company_id', session()->get('company_id'))->get();
        $data['employees'] = DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type', '=', 'Employee')->get();

        $data['products'] = DB::table('pro_products')->where('company_id', session()->get('company_id'))->get();
        return view('inventory/ims_stock_transfer_create', $data);
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
            'ref_num' => 'required',
            'status' => 'required',
            'transfer_from' => 'required',
            'transfer_to' => 'required',
            'employee_id' => 'required',
            'ims_stock_request_id' => 'required'
        ]);




        $req = $request->only([
            'ref_num',
            'status',
            'transfer_from',
            'transfer_to',
            'employee_id',
            'description',
            'ims_stock_request_id'

        ]);
        $req['company_id'] = session()->get('company_id');
        $req['created_by'] = session()->get('user_id');


        $currentDateTime = Carbon::now()->format('Y-m-d H:i:s');

        $randNumber = rand(1345689359, 1098354890);
        $qrCodeRandNumber = rand(1345689359, 9999994899);
        $req['barcode'] = $randNumber;
        $req['barcode_string'] = json_encode(DNS1D::getBarcodeHTML($randNumber, 'C128'));
        $req['qr_code'] = $qrCodeRandNumber;
        $req['qr_code_string'] = json_encode(DNS2D::getBarcodeHTML(".$qrCodeRandNumber.", 'QRCODE', 5, 5));
        $req['created_at'] = $currentDateTime;
        $req['updated_at'] = $currentDateTime;
        $lastInsertionId = ImsStockRequest::insertGetId($req);
        if ($lastInsertionId) {

            $productIdsArray = explode(',', $request->product_ids_array);
            
            $productQuantityArray = explode(',', $request->product_quantity_array);
            
            
            $i = 0;
            foreach ($productIdsArray as $productId) {
            
                DB::table('ims_stock_request_details')->insert([
                    'ims_stock_request_id' => $lastInsertionId,
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
        $ims_stock_request_id = $request->imsStockRequestId;

        $StockRequestDeleted = ImsStockRequest::where('ims_stock_request_id', $ims_stock_request_id)->delete();
        if ($StockRequestDeleted) {
            return response()->json('true');
        } else {
            return response()->json('false');
        }
    }

    public function updateForm(Request $request)
    {
        $data['title'] = ' Stock Transfer';
        $data['navbar_headings'] = '  Stock Transfer';
        $data['warehouses'] =  DB::table('pur_warehouses')->where('company_id', '=', session('company_id'))->get();
        $data['taxes'] = DB::table('pro_taxes')->where('company_id', session()->get('company_id'))->get();
        $data['employees'] = DB::table('users')->where('company_id', session()->get('company_id'))->get();

        $data['products'] = DB::table('pro_products')->where('company_id', session()->get('company_id'))->get();
        $data['ims_stock_request'] = ImsStockRequest::with('details')->find($request->imsStockRequestId);
        return view('inventory/ims_stock_transfer_update', $data);
    }
    public function update(Request $request)
    {
        unset($request['_token']);
        $request->validate([
            'ref_num' => 'required',
            'status'=>'required',
            'stock_request_from' => 'required',
            'stock_request_to' => 'required',


        ]);




        $req = $request->only([
            'ref_num',
            'stock_request_from',
            'stock_request_to',
            'description',
            'status'

        ]);
        $req['company_id'] = session()->get('company_id');
        $req['created_by'] = session()->get('user_id');
        $req['employee_id'] = session()->get('user_id');
        


        $updatedAt = Carbon::now()->format('Y-m-d H:i:s');

        // $randNumber= rand(1345689359, 1098354890);
        // $req['ims_stock_request_code'] = $randNumber;
        // $req['barcode'] = json_encode(DNS1D::getBarcodeHTML($randNumber, 'C128'));
        $lastInsertionId = ImsStockRequest::where('ims_stock_request_id', $request->ims_stock_request_id)->update($req);
        if ($lastInsertionId) {

            $productIdsArray = explode(',', $request->product_ids_array);
            
            $productQuantityArray = explode(',', $request->product_quantity_array);
            
            $detailIdArray = explode(',', $request->detail_id_array);
            
            $i = 0;
            foreach ($productIdsArray as $productId) {
            
                DB::table('ims_stock_request_details')->where('ims_stock_request_detail_id', $detailIdArray[$i])->update([
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
        $data['title'] = 'Stock Request Details';
        $data['navbar_headings'] = 'Stock Request Details';
        $data['warehouses'] =  DB::table('pur_warehouses')->where('company_id', '=', session('company_id'))->get();
        $data['taxes'] = DB::table('pro_taxes')->where('company_id', session()->get('company_id'))->get();
        $data['employees'] = DB::table('users')->where('company_id', session()->get('company_id'))->get();

        $data['products'] = DB::table('pro_products')->where('company_id', session()->get('company_id'))->get();
        $data['ims_stock_request'] = ImsStockRequest::with('details')->find($request->ims_stock_request_id);
        return view('inventory/ims_stock_transfer_detail', $data);
    }




    public function imsStockTransferUrl(Request $request)
    {
        $url = url('ims_stock_transfer_details_print' . '/' . $request->id);
        return response()->json($url);
    }


    public function imsStockTransferDetailsPrint(Request $request)
    {
        $data['title'] = 'Stock Transfer Details';
        $data['navbar_headings'] = 'Stock Transfer Details';
        $data['warehouses'] =  DB::table('pur_warehouses')->where('company_id', '=', session('company_id'))->get();
        $data['taxes'] = DB::table('pro_taxes')->where('company_id', session()->get('company_id'))->get();
        $data['employees'] = DB::table('users')->where('company_id', session()->get('company_id'))->get();

        $data['products'] = DB::table('pro_products')->where('company_id', session()->get('company_id'))->get();
        $result = ImsStockRequest::with('products')->find($request->id);
        $data['company'] = DB::table('companies')->where('company_id', session()->get('company_id'))->get()->first();
        $data['ims_stock_request'] = $result->toArray();
        $data['result'] = $result;
        $pdf =Pdf::loadView('inventory/ims_stock_transfer_detail_print', $data);
        return $pdf->stream();

        //  return response()->json( $pdf->output());
        // return response($pdf->output(), 200, [
        //     'Content-Type' => 'application/pdf',
        //     'Content-Disposition' => 'inline; filename="file.pdf"',
        // ]);
    }

    // fetch taxes 
    
}

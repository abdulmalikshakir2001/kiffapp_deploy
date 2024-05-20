<?php

namespace App\Http\Controllers\purchase;

use App\Http\Controllers\Controller;
use App\Models\Users\User;
use App\Models\purchase\PurPurchaseReturn;
use App\Models\purchase\PurPurchaseReturnDetail;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
// use PDF;
use Barryvdh\DomPDF\Facade\Pdf;
use DNS1D;
use DNS2D;


class PurPurchaseReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['title'] = 'Purchase Return';
        $data['navbar_headings'] = 'Purchase Return';
        return view('purchase/pur_purchase_return_view', $data);
    }
    public function getData(Request $request)

    {
        $pur_purchase_return_table = DB::table('pur_purchase_returns')->where('company_id', session()->get('company_id'))->get();
        // $crmLead =  DB::table('crm_leads')->where('company_id', session()->get('company_id'))->get();
        $allData = DataTables::of($pur_purchase_return_table)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn =
                    '<button  type="button"  class="text-secondary  pur_purchase_return_delete_btn bg-white "  style="border:none;" data-pur_purchase_return_id="' . $row->pur_purchase_return_id . '"data-bs-toggle="modal" data-bs-target="#delete_confirm_modal" ><i class="fas fa-trash-alt fs-6 text-danger"></i>
            </button>
            <button class="text-secondary  pur_purchase_return_edit_btn bg-white"  style="border: none;" data-pur_purchase_return_id="' . $row->pur_purchase_return_id . '" >
                    <a href="#"> <i class="fas fa-edit fs-6 text-success">
                    </i>
                    </a>

                </button>
                <button class="badge-info text-secondary  sidenav_zero_index border_5_font_12 pur_purchase_return_detail_button"  style="border: none;" data-pur_purchase_return_id="' . $row->pur_purchase_return_id . '" >
                        <a href="' . route('pur_purchase_return_detail', $row->pur_purchase_return_id) . '" class="text-white"> <i class="fas fa-eye ">
                        </i>
                        View
                        </a>
                    </button>
                ';
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
        $data['title'] = 'Purchase Returns';
        $data['navbar_headings'] = 'Purchase Returns';
        
        $data['products'] = DB::table('pro_products')->where('company_id', session()->get('company_id'))->get();
        $data['suppliers'] = DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type', 'Supplier')->get();
        $data['purPurchaseOrders'] = DB::table('pur_purchase_orders')->where('company_id', session()->get('company_id'))->get();

        return view('purchase/pur_purchase_return_create', $data);
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
        // return response()->json($request->total_amount);
        $request->validate([
            'ref_num' => 'required',
            'supplier_id' => 'required',
            'pur_order_id' => 'required',
            'delivery_date' => 'required',
            'creation_date' => 'required',
            'creation_time' => 'required',
            'status' => 'required',


        ]);




        $req = $request->only([
            'supplier_id',
            'pur_order_id',
            'delivery_date',
            'ref_num',
            'creation_date',
            'creation_time',
            'description',
            'status'

        ]);
        $req['company_id'] = session()->get('company_id');
        $currentDateTime = Carbon::now()->format('Y-m-d H:i:s');

        $randNumber = rand(1345689359, 1098354890);
        $req['barcode'] = $randNumber;
        $req['barcode_string'] = json_encode(DNS1D::getBarcodeHTML($randNumber, 'C128'));
        $qrCodeRandNumber = rand(1345689359, 9999994899);
        $req['qr_code'] = $qrCodeRandNumber;
        $req['qr_code_string'] = json_encode(DNS2D::getBarcodeHTML(".$qrCodeRandNumber.", 'QRCODE', 5, 5));
        $req['created_at'] = $currentDateTime;
        $req['updated_at'] = $currentDateTime;
        $lastInsertionId = PurPurchaseReturn::insertGetId($req); // insert invoice data 
        if ($lastInsertionId) {

            $productIdsArray = explode(',', $request->product_ids_array);
            $productQuantityArray = explode(',', $request->product_quantity_array);
            $i = 0;
            foreach ($productIdsArray as $productId) {
                DB::table('pur_purchase_return_details')->insert([
                    'pur_purchase_return_id' => $lastInsertionId,
                    'product_id' => $productId,
                    'quantity' => $productQuantityArray[$i],
                    'created_at' => $currentDateTime,
                    'updated_at' => $currentDateTime
                ]);
                // updating stock quantity in main warehouse start 
                stockQtyDecrementOfMainWarehouse($productId,$productQuantityArray[$i]);

                

                // updating stock quantity in main warehouse end


                $i++;
            }
            return response()->json('true');
        }
    }

    public function delete(Request $request)
    {
        $purPurchaseReturnId = $request->purPurchaseReturnId;

        $purPurchaseReturnDeleted = PurPurchaseReturn::where('pur_purchase_return_id', $purPurchaseReturnId)->delete();
        if ($purPurchaseReturnDeleted) {
            return response()->json('true');
        } else {
            return response()->json('false');
        }
    }

    public function updateForm(Request $request)
    {
        $data['title'] = 'Purchase Return';
        $data['navbar_headings'] = 'Purchase Return';
        
        $data['products'] = DB::table('pro_products')->where('company_id', session()->get('company_id'))->get();
        $data['purPurchaseReturn'] = PurPurchaseReturn::with('details')->find($request->purPurchaseReturnId);
        
        $data['suppliers'] = DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type', 'Supplier')->get();
        $data['purPurchaseOrders'] = DB::table('pur_purchase_orders')->where('company_id', session()->get('company_id'))->get();
        // dd($data['purPurchaseReturn']);
        // $data['pro_invoice_req']= DB::table('pur_product_invoice_requests')->where('pro_invoice_req_id',$request->proQuotationReqId)->get()->first();
        return view('purchase/pur_purchase_return_update', $data);
    }
    public function update(Request $request)
    {
        unset($request['_token']);
        // return response()->json($request->all());
        $request->validate([
            'ref_num' => 'required',
            'supplier_id' => 'required',
            'pur_order_id' => 'required',
            'delivery_date' => 'required',

            'creation_date' => 'required',
            'creation_time' => 'required',
            'status' => 'required',


        ]);




        $req = $request->only([
            'supplier_id',
            'pur_order_id',
            'delivery_date',
            'ref_num',
            'creation_date',
            'creation_time',
            'description',
            'status'

        ]);
        $req['company_id'] = session()->get('company_id');


        $updatedAt = Carbon::now()->format('Y-m-d H:i:s');

        // $randNumber= rand(1345689359, 1098354890);
        // $req['pro_invoice_req_code'] = $randNumber;
        // $req['barcode'] = json_encode(DNS1D::getBarcodeHTML($randNumber, 'C128'));
        $lastInsertionId = PurPurchaseReturn::where('pur_purchase_return_id', $request->pur_purchase_return_id)->update($req);
        if ($lastInsertionId) {

            $productIdsArray = explode(',', $request->product_ids_array);
            $productQuantityArray = explode(',', $request->product_quantity_array);
            $detailIdArray = explode(',', $request->detail_id_array);
            // return response()->json($request->product_taxes_array);
            $i = 0;
            foreach ($productIdsArray as $productId) {

                DB::table('pur_purchase_return_details')->where('pur_purchase_return_detail_id', $detailIdArray[$i])->update([
                    'product_id' => $productId,
                    'quantity' => $productQuantityArray[$i],
                    'updated_at' => $updatedAt,
                ]);
                $i++;
            }
            return response()->json('true');
        }
    }

    public function details(Request $request)
    {
        $data['title'] = 'Purchase Return ';
        $data['navbar_headings'] = 'Purchase Return ';
        
        $data['products'] = DB::table('pro_products')->where('company_id', session()->get('company_id'))->get();
        $data['purPurchaseReturn'] = PurPurchaseReturn::with('details')->find($request->purPurchaseReturnId);
        
        $data['suppliers'] = DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type', 'Supplier')->get();
        $data['purPurchaseOrders'] = DB::table('pur_purchase_orders')->where('company_id', session()->get('company_id'))->get();
        
        return view('purchase/pur_purchase_return_detail', $data);
    }




    public function purPurchaseReturnUrl(Request $request)
    {
        $url = url('pur_purchase_return_detail_print' . '/' . $request->id);
        return response()->json($url);
    }
    public function purPurchaseReturnDetailPrint(Request $request)

    {
     


        $result = PurPurchaseReturn::with('products')->find($request->id);
        $data['company'] = DB::table('companies')->where('company_id', session()->get('company_id'))->get()->first();
        $data['purPurchaseReturn'] = $result->toArray();
        $data['supplier'] = DB::table('users')->where('user_id', $data['purPurchaseReturn']['supplier_id'])->get()->first();


        
        // for hrm view payroll start
        $pdf = Pdf::loadView('purchase/pur_purchase_return_detail_print', $data);
        return $pdf->stream();
        //  return response()->json( $pdf->output());
        // return response($pdf->output(), 200, [
        //     'Content-Type' => 'application/pdf',
        //     'Content-Disposition' => 'inline; filename="file.pdf"',
        // ]);
    }
}

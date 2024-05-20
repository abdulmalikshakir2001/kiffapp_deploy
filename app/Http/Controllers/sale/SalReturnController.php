<?php

namespace App\Http\Controllers\sale;

use App\Http\Controllers\Controller;
use App\Models\Users\User;
use App\Models\sale\SalReturn;
use App\Models\sale\SalReturnDetail;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
// use PDF;
use Barryvdh\DomPDF\Facade\Pdf;
use DNS1D;
use DNS2D;


class SalReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['title'] = 'Sale Return';
        $data['navbar_headings'] = 'Sale Return';
        return view('sale/sal_return_view', $data);
    }
    public function getData(Request $request)

    {
        $sal_return_table = DB::table('sal_returns')->where('company_id', session()->get('company_id'))->get();
        // $crmLead =  DB::table('crm_leads')->where('company_id', session()->get('company_id'))->get();
        $allData = DataTables::of($sal_return_table)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn =
                    '<button  type="button"  class="text-secondary  sal_return_delete_btn bg-white "  style="border:none;" data-sal_return_id="' . $row->sal_return_id . '"data-bs-toggle="modal" data-bs-target="#delete_confirm_modal" ><i class="fas fa-trash-alt fs-6 text-danger"></i>
            </button>
            <button class="text-secondary  sal_return_edit_btn bg-white"  style="border: none;" data-sal_return_id="' . $row->sal_return_id . '" >
                    <a href="#"> <i class="fas fa-edit fs-6 text-success">
                    </i>
                    </a>

                </button>
                <button class="badge-info text-secondary  sidenav_zero_index border_5_font_12 sal_return_detail_button"  style="border: none;" data-sal_return_id="' . $row->sal_return_id . '" >
                        <a href="' . route('sal_return_detail', $row->sal_return_id) . '" class="text-white"> <i class="fas fa-eye ">
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
        $data['title'] = 'Sale Returns';
        $data['navbar_headings'] = 'Sale Returns';
        
        $data['products'] = DB::table('pro_products')->where('company_id', session()->get('company_id'))->get();
        $data['suppliers'] = DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type', 'Customer')->get();
        $data['salOrders'] = DB::table('sal_orders')->where('company_id', session()->get('company_id'))->get();

        return view('sale/sal_return_create', $data);
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
            'sal_order_id' => 'required',
            'delivery_date' => 'required',
            'creation_date' => 'required',
            'creation_time' => 'required',
            'status' => 'required',


        ]);




        $req = $request->only([
            'supplier_id',
            'sal_order_id',
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
        $lastInsertionId = SalReturn::insertGetId($req); // insert invoice data 
        if ($lastInsertionId) {

            $productIdsArray = explode(',', $request->product_ids_array);
            $productQuantityArray = explode(',', $request->product_quantity_array);
            $i = 0;
            foreach ($productIdsArray as $productId) {
                DB::table('sal_return_details')->insert([
                    'sal_return_id' => $lastInsertionId,
                    'product_id' => $productId,
                    'quantity' => $productQuantityArray[$i],
                    'created_at' => $currentDateTime,
                    'updated_at' => $currentDateTime
                ]);
                // updating stock quantity in main warehouse start 
                stockQtyIncrementOfMainWarehouse($productId,$productQuantityArray[$i]);

                

                // updating stock quantity in main warehouse end


                $i++;
            }
            return response()->json('true');
        }
    }

    public function delete(Request $request)
    {
        $salReturnId = $request->salReturnId;

        $salReturnDeleted = SalReturn::where('sal_return_id', $salReturnId)->delete();
        if ($salReturnDeleted) {
            return response()->json('true');
        } else {
            return response()->json('false');
        }
    }

    public function updateForm(Request $request)
    {
        $data['title'] = 'Sale Return';
        $data['navbar_headings'] = 'Sale Return';
        
        $data['products'] = DB::table('pro_products')->where('company_id', session()->get('company_id'))->get();
        $data['salReturn'] = SalReturn::with('details')->find($request->salReturnId);
        
        $data['suppliers'] = DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type', 'Customer')->get();
        $data['salOrders'] = DB::table('sal_orders')->where('company_id', session()->get('company_id'))->get();
        // dd($data['salReturn']);
        // $data['pro_invoice_req']= DB::table('sal_product_invoice_requests')->where('pro_invoice_req_id',$request->proQuotationReqId)->get()->first();
        return view('sale/sal_return_update', $data);
    }
    public function update(Request $request)
    {
        unset($request['_token']);
        // return response()->json($request->all());
        $request->validate([
            'ref_num' => 'required',
            'supplier_id' => 'required',
            'sal_order_id' => 'required',
            'delivery_date' => 'required',

            'creation_date' => 'required',
            'creation_time' => 'required',
            'status' => 'required',


        ]);




        $req = $request->only([
            'supplier_id',
            'sal_order_id',
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
        $lastInsertionId = SalReturn::where('sal_return_id', $request->sal_return_id)->update($req);
        if ($lastInsertionId) {

            $productIdsArray = explode(',', $request->product_ids_array);
            $productQuantityArray = explode(',', $request->product_quantity_array);
            $detailIdArray = explode(',', $request->detail_id_array);
            // return response()->json($request->product_taxes_array);
            $i = 0;
            foreach ($productIdsArray as $productId) {

                DB::table('sal_return_details')->where('sal_return_detail_id', $detailIdArray[$i])->update([
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
        $data['title'] = 'Sale Return ';
        $data['navbar_headings'] = 'Sale Return ';
        
        $data['products'] = DB::table('pro_products')->where('company_id', session()->get('company_id'))->get();
        $data['salReturn'] = SalReturn::with('details')->find($request->salReturnId);
        
        $data['suppliers'] = DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type', 'Customer')->get();
        $data['salOrders'] = DB::table('sal_orders')->where('company_id', session()->get('company_id'))->get();
        
        return view('sale/sal_return_detail', $data);
    }




    public function salReturnUrl(Request $request)
    {
        $url = url('sal_return_detail_print' . '/' . $request->id);
        return response()->json($url);
    }
    public function salReturnDetailPrint(Request $request)

    {
     


        $result = SalReturn::with('products')->find($request->id);
        $data['company'] = DB::table('companies')->where('company_id', session()->get('company_id'))->get()->first();
        $data['salReturn'] = $result->toArray();
        $data['supplier'] = DB::table('users')->where('user_id', $data['salReturn']['supplier_id'])->get()->first();


        
        // for hrm view payroll start
        $pdf = Pdf::loadView('sale/sal_return_detail_print', $data);
        return $pdf->stream();
        //  return response()->json( $pdf->output());
        // return response($pdf->output(), 200, [
        //     'Content-Type' => 'application/pdf',
        //     'Content-Disposition' => 'inline; filename="file.pdf"',
        // ]);
    }
}

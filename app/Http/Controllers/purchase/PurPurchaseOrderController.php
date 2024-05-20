<?php

namespace App\Http\Controllers\purchase;

use App\Http\Controllers\Controller;
use App\Models\Users\User;
use App\Models\purchase\PurPurchaseOrder;
use App\Models\purchase\PurPurchaseOrderDetail;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
// use PDF;
use Barryvdh\DomPDF\Facade\Pdf;
use DNS1D;
use DNS2D;


class PurPurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['title'] = 'Order';
        $data['navbar_headings'] = 'Order';
        return view('purchase/pur_purchase_order_view', $data);
    }
    public function getData(Request $request)

    {
        $pur_purchase_order_table = DB::table('pur_purchase_orders')->where('company_id', session()->get('company_id'))->get();
        // $crmLead =  DB::table('crm_leads')->where('company_id', session()->get('company_id'))->get();
        $allData = DataTables::of($pur_purchase_order_table)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn =
                    '<button  type="button"  class="text-secondary  pur_purchase_order_delete_btn bg-white "  style="border:none;" data-pur_purchase_order_id="' . $row->pur_order_id . '"data-bs-toggle="modal" data-bs-target="#delete_confirm_modal" ><i class="fas fa-trash-alt fs-6 text-danger"></i>
            </button>
            <button class="text-secondary  pur_purchase_order_edit_btn bg-white"  style="border: none;" data-pur_purchase_order_id="' . $row->pur_order_id . '" >
                    <a href="#"> <i class="fas fa-edit fs-6 text-success">
                    </i>
                    </a>

                </button>
                <button class="badge-info text-secondary  sidenav_zero_index border_5_font_12 pur_purchase_order_detail_button"  style="border: none;" data-pur_purchase_order_id="' . $row->pur_order_id . '" >
                        <a href="' . route('pur_purchase_order_detail', $row->pur_order_id) . '" class="text-white"> <i class="fas fa-eye ">
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
        $data['title'] = 'Create Order';
        $data['navbar_headings'] = 'Create  Order';
        $data['taxes'] = DB::table('pro_taxes')->where('company_id', session()->get('company_id'))->get();
        $data['products'] = DB::table('pro_products')->where('company_id', session()->get('company_id'))->get();
        $data['suppliers'] = DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type', 'Supplier')->get();

        $data['purPurchaseQuotations'] = DB::table('pur_purchase_quotations')->where('company_id', session()->get('company_id'))->get();

        return view('purchase/pur_purchase_order_create', $data);
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
            'supplier_id' => 'required',
            'pur_quotation_id' => 'required',
            'order_date' => 'required',
            'order_time' => 'required',
            'status' => 'required',

        ]);




        $req = $request->only([





            'pur_quotation_id',
            'supplier_id',
            'taxes',
            'order_date',
            'order_time',
            'ref_num',
            'order_code',
            'barcode',
            'description',
            'total_price',
            'status',

        ]);
        $req['company_id'] = session()->get('company_id');
        $req['total_price'] = $request->total_amount;

        if ($request->taxes_main != 'null') {

            $req['taxes'] = $request->taxes_main;
        } else {
            $req['taxes'] = 'NULL';
        }
        $currentDateTime = Carbon::now()->format('Y-m-d H:i:s');

        $randNumber = rand(1345689359, 1098354890);
        $req['order_code'] = $randNumber;
        $req['barcode'] = json_encode(DNS1D::getBarcodeHTML($randNumber, 'C128'));

        $qrCodeRandNumber = rand(1345689359, 9999994899);
        $req['qr_code'] = $qrCodeRandNumber;
        $req['qr_code_string'] = json_encode(DNS2D::getBarcodeHTML(".$qrCodeRandNumber.", 'QRCODE', 5, 5));
        $req['created_at'] = $currentDateTime;
        $req['updated_at'] = $currentDateTime;
        $lastInsertionId = PurPurchaseOrder::insertGetId($req);
        if ($lastInsertionId) {

            $productIdsArray = explode(',', $request->product_ids_array);
            $productDiscountArray = explode(',', $request->product_discount_array);
            $productQuantityArray = explode(',', $request->product_quantity_array);
            $productUnitPriceArray = explode(',', $request->product_unit_price_array);
            $subTotalArray = explode(',', $request->sub_total_array);
            $keys = array_keys(get_object_vars(json_decode($request->product_taxes_array)));
            $i = 0;
            foreach ($productIdsArray as $productId) {
                $key_name = $keys[$i];

                DB::table('pur_purchase_order_details')->insert([
                    'pur_order_id' => $lastInsertionId,
                    'product_id' => $productId,
                    'unit_price' => $productUnitPriceArray[$i],
                    'quantity' => $productQuantityArray[$i],
                    'discount' => $productDiscountArray[$i],
                    'pro_taxes' => json_decode($request->product_taxes_array)->$key_name,
                    'sub_total' => $subTotalArray[$i],
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
        $purPurchaseOrderId = $request->purPurchaseOrderId;

        $purPurchaseOrderDeleted = PurPurchaseOrder::where('pur_order_id', $purPurchaseOrderId)->delete();
        if ($purPurchaseOrderDeleted) {
            return response()->json('true');
        } else {
            return response()->json('false');
        }
    }

    public function updateForm(Request $request)
    {
        $data['title'] = 'Update Order';
        $data['navbar_headings'] = 'Update  Order';
        $data['taxes'] = DB::table('pro_taxes')->where('company_id', session()->get('company_id'))->get();
        $data['products'] = DB::table('pro_products')->where('company_id', session()->get('company_id'))->get();
        $data['purPurchaseOrder'] = PurPurchaseOrder::with('details')->find($request->purPurchaseOrderId);

        // getting taxes names and values start 
        // dd($data['purPurchaseQuotation']->taxes);
        $data['taxesNamesAndPercentage'] = [];
        foreach ($data['purPurchaseOrder']->details as $detail) {
            $taxesInfoArray = taxesInfo(taxesNames: $detail['pro_taxes']);
            if (count($taxesInfoArray) == 0) {
                // echo "";
                array_push($data['taxesNamesAndPercentage'], "");
            } else {
                // print_r($taxesInfoArray['taxesNamesAndPercentage']);
                array_push($data['taxesNamesAndPercentage'], $taxesInfoArray['taxesNamesAndPercentage']);
            }
        }
        // getting taxes names and values end 

        $data['suppliers'] = DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type', 'Supplier')->get();

        $data['purPurchaseQuotations'] = DB::table('pur_purchase_quotations')->where('company_id', session()->get('company_id'))->get();

        return view('purchase/pur_purchase_order_update', $data);
    }
    public function update(Request $request)
    {
        unset($request['_token']);
        $request->validate([
            'ref_num' => 'required',
            'supplier_id' => 'required',
            'pur_quotation_id' => 'required',
            'order_date' => 'required',
            'order_time' => 'required',

            'status' => 'required',



        ]);




        $req = $request->only([
            'pro_quotation_req_id',
            'pur_quotation_id',
            'supplier_id',
            'taxes',
            'order_date',
            'order_time',
            'ref_num',
            'order_code',
            'barcode',
            'description',
            'total_price',
            'status',

        ]);
        $req['company_id'] = session()->get('company_id');
        $req['total_price'] = $request->total_amount;


        if ($request->taxes_main != 'null') {

            $req['taxes'] = $request->taxes_main;
        } else {
            $req['taxes'] = 'NULL';
        }
        $updatedAt = Carbon::now()->format('Y-m-d H:i:s');

        // $randNumber= rand(1345689359, 1098354890);
        // $req['pro_quotation_req_code'] = $randNumber;
        // $req['barcode'] = json_encode(DNS1D::getBarcodeHTML($randNumber, 'C128'));
        $lastInsertionId = PurPurchaseOrder::where('pur_order_id', $request->pur_purchase_order_id)->update($req);
        if ($lastInsertionId) {

            $productIdsArray = explode(',', $request->product_ids_array);
            $productDiscountArray = explode(',', $request->product_discount_array);
            $productQuantityArray = explode(',', $request->product_quantity_array);
            $productUnitPriceArray = explode(',', $request->product_unit_price_array);
            $detailIdArray = explode(',', $request->detail_id_array);
            $subTotalArray = explode(',', $request->sub_total_array);
            $keys = array_keys(get_object_vars(json_decode($request->product_taxes_array)));
            $i = 0;
            foreach ($productIdsArray as $productId) {
                $key_name = $keys[$i];
                DB::table('pur_purchase_order_details')->where('pur_order_detail_id', $detailIdArray[$i])->update([
                    'product_id' => $productId,
                    'unit_price' => $productUnitPriceArray[$i],
                    'quantity' => $productQuantityArray[$i],
                    'discount' => $productDiscountArray[$i],
                    'pro_taxes' => json_decode($request->product_taxes_array)->$key_name,
                    'sub_total' => $subTotalArray[$i],
                    'updated_at' => $updatedAt,
                ]);
                $i++;
            }
            return response()->json('true');
        }
    }

    public function details(Request $request)
    {
        $data['title'] = ' Order Details';
        $data['navbar_headings'] = 'Order  Details';
        $data['taxes'] = DB::table('pro_taxes')->where('company_id', session()->get('company_id'))->get();
        $data['products'] = DB::table('pro_products')->where('company_id', session()->get('company_id'))->get();
        $data['purPurchaseOrder'] = PurPurchaseOrder::with('details')->find($request->purPurchaseOrderId);
        $data['suppliers'] = DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type', 'Supplier')->get();

        $data['purPurchaseQuotations'] = DB::table('pur_purchase_quotations')->where('company_id', session()->get('company_id'))->get();

        return view('purchase/pur_purchase_order_detail', $data);
    }




    public function purPurchaseOrderUrl(Request $request)
    {
        $url = url('pur_purchase_order_detail_print' . '/' . $request->id);
        return response()->json($url);
    }
    public function purPurchaseOrderDetailPrint(Request $request)

    {

        // start 
        $data['title'] = 'Purchase Quotation Details';
        $data['navbar_headings'] = 'Purchase Quotation Details';
        $result = PurPurchaseOrder::with('products')->find($request->id);
        $data['company'] = DB::table('companies')->where('company_id', session()->get('company_id'))->get()->first();
        $data['purPurchaseOrder'] = $result->toArray();
        $data['supplier'] = DB::table('users')->where('user_id', $data['purPurchaseOrder']['supplier_id'])->get()->first();
        // taxes start ----------------------------------------------------------------------------------
        $taxesArray = [];  //taxes names
        $taxesPercentage = [];
        $totalTaxPerPro = [];
        $totalTax = 0;
        $totalAmount = 0;
        $quotationTaxes = 0;
        $i = 0;
        foreach ($data['purPurchaseOrder']['products'] as $product) {
            $totalAmount += $product['pivot']['sub_total'];


            $taxesArray[] = $product['pivot']['pro_taxes'];

            $taxesExplode = explode(',', $product['pivot']['pro_taxes']);
            $productTaxesArray = [];


            $total = 0;
            foreach ($taxesExplode as $tax) {
                if ($tax != 'NULL') {
                    $taxSingle = DB::table('pro_taxes')->where('tax_name', $tax)->get()->first();
                    $productTaxesArray[] = $taxSingle->percentage;
                    $total += $taxSingle->percentage;
                    $totalTax += $taxSingle->percentage;
                }
            }
            $totalTaxPerPro[] = $total;
            $total = 0;

            $taxesPercentage['pro_taxes_' . $i] = implode(',', $productTaxesArray);


            $i++;
        }

        if ($data['purPurchaseOrder']['taxes'] != NULL) {
            // invoice taxes start 
            $invoiceTaxesArray =  explode(',', $data['purPurchaseOrder']['taxes']);
            foreach ($invoiceTaxesArray as $invoiceTax) {
                $taxSingle = DB::table('pro_taxes')->where('tax_name', $invoiceTax)->get()->first();
                $quotationTaxes +=  $taxSingle->percentage;
            }

            // invoice taxes end 

        }

        $data['taxesArray'] = $taxesArray;
        $data['taxesPercentage'] = $taxesPercentage;
        $data['totalTaxPerPro'] = $totalTaxPerPro;
        $data['totalTax'] = $totalTax;
        $data['totalAmount'] = $totalAmount;
        $data['quotationTaxes'] = $quotationTaxes;
        // taxes  end---------------------------------------------------------------
        // for hrm view payroll start
        $pdf = Pdf::loadView('purchase/pur_purchase_order_detail_print', $data);
        $totalAmount = 0;
        $quotationTaxes = 0;
        return $pdf->stream();

        //  return response()->json( $pdf->output());
        // return response($pdf->output(), 200, [
        //     'Content-Type' => 'application/pdf',
        //     'Content-Disposition' => 'inline; filename="file.pdf"',
        // ]);
        // end 
    }
}

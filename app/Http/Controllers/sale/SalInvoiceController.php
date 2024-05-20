<?php

namespace App\Http\Controllers\sale;

use App\Http\Controllers\Controller;
use App\Models\Users\User;
use App\Models\sale\SalInvoice;
use App\Models\sale\SalInvoiceDetail;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
// use PDF;
use Barryvdh\DomPDF\Facade\Pdf;
use DNS1D;
use DNS2D;


class SalInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['title'] = 'Sale Invoice';
        $data['navbar_headings'] = 'Sale Invoice';
        return view('sale/sal_invoice_view', $data);
    }
    public function getData(Request $request)

    {
        $sal_invoice_table = DB::table('sal_invoices')->where('company_id', session()->get('company_id'))->get();
        // $crmLead =  DB::table('crm_leads')->where('company_id', session()->get('company_id'))->get();
        $allData = DataTables::of($sal_invoice_table)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn =
                    '<button  type="button"  class="text-secondary  sal_invoice_delete_btn bg-white "  style="border:none;" data-sal_invoice_id="' . $row->sal_invoice_id . '"data-bs-toggle="modal" data-bs-target="#delete_confirm_modal" ><i class="fas fa-trash-alt fs-6 text-danger"></i>
            </button>
            <button class="text-secondary  sal_invoice_edit_btn bg-white"  style="border: none;" data-sal_invoice_id="' . $row->sal_invoice_id . '" >
                    <a href="#"> <i class="fas fa-edit fs-6 text-success">
                    </i>
                    </a>

                </button>
                <button class="badge-info text-secondary  sidenav_zero_index border_5_font_12 sal_invoice_detail_button"  style="border: none;" data-sal_invoice_id="' . $row->sal_invoice_id . '" >
                        <a href="' . route('sal_invoice_detail', $row->sal_invoice_id) . '" class="text-white"> <i class="fas fa-eye ">
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
        $data['title'] = 'Sale Invoice';
        $data['navbar_headings'] = 'Sale Invoice';
        $data['taxes'] = DB::table('pro_taxes')->where('company_id', session()->get('company_id'))->get();
        $data['products'] = DB::table('pro_products')->where('company_id', session()->get('company_id'))->get();
        $data['suppliers'] = DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type', 'Customer')->get();
        $data['salOrders'] = DB::table('sal_orders')->where('company_id', session()->get('company_id'))->get();

        return view('sale/sal_invoice_create', $data);
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
            'invoice_status' => 'required',


        ]);




        $req = $request->only([
            'supplier_id',
            'sal_order_id',
            'delivery_date',
            'ref_num',
            'creation_date',
            'creation_time',
            'taxes',
            'description',
            'invoice_status'

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
        $req['sal_invoice_code'] = $randNumber;
        $req['barcode'] = json_encode(DNS1D::getBarcodeHTML($randNumber, 'C128'));
        $qrCodeRandNumber = rand(1345689359, 9999994899);
        $req['qr_code'] = $qrCodeRandNumber;
        $req['qr_code_string'] = json_encode(DNS2D::getBarcodeHTML(".$qrCodeRandNumber.", 'QRCODE', 5, 5));
        $req['created_at'] = $currentDateTime;
        $req['updated_at'] = $currentDateTime;
        $lastInsertionId = SalInvoice::insertGetId($req); // insert invoice data 
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


                DB::table('sal_invoice_details')->insert([
                    'sal_invoice_id' => $lastInsertionId,
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
        $salInvoiceId = $request->salInvoiceId;

        $salInvoiceDeleted = SalInvoice::where('sal_invoice_id', $salInvoiceId)->delete();
        if ($salInvoiceDeleted) {
            return response()->json('true');
        } else {
            return response()->json('false');
        }
    }

    public function updateForm(Request $request)
    {
        $data['title'] = 'Update Invoice';
        $data['navbar_headings'] = 'Update  Invoice';
        $data['taxes'] = DB::table('pro_taxes')->where('company_id', session()->get('company_id'))->get();
        $data['products'] = DB::table('pro_products')->where('company_id', session()->get('company_id'))->get();
        $data['salInvoice'] = SalInvoice::with('details')->find($request->salInvoiceId);
        // getting taxes names and values start 
        // dd($data['salInvoice']->taxes);
        $data['taxesNamesAndPercentage'] = [];
        foreach ($data['salInvoice']->details as $detail) {
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
        $data['suppliers'] = DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type', 'Customer')->get();
        $data['salOrders'] = DB::table('sal_orders')->where('company_id', session()->get('company_id'))->get();
        // dd($data['salInvoice']);
        // $data['pro_invoice_req']= DB::table('sal_product_invoice_requests')->where('pro_invoice_req_id',$request->proQuotationReqId)->get()->first();
        return view('sale/sal_invoice_update', $data);
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
            'invoice_status' => 'required',


        ]);




        $req = $request->only([
            'supplier_id',
            'sal_order_id',
            'delivery_date',
            'ref_num',
            'creation_date',
            'creation_time',
            'taxes',
            'description',
            'invoice_status'

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
        // $req['pro_invoice_req_code'] = $randNumber;
        // $req['barcode'] = json_encode(DNS1D::getBarcodeHTML($randNumber, 'C128'));
        $lastInsertionId = SalInvoice::where('sal_invoice_id', $request->sal_invoice_id)->update($req);
        if ($lastInsertionId) {

            $productIdsArray = explode(',', $request->product_ids_array);
            $productDiscountArray = explode(',', $request->product_discount_array);
            $productQuantityArray = explode(',', $request->product_quantity_array);
            $productUnitPriceArray = explode(',', $request->product_unit_price_array);
            $subTotalArray = explode(',', $request->sub_total_array);
            $detailIdArray = explode(',', $request->detail_id_array);
            $keys = array_keys(get_object_vars(json_decode($request->product_taxes_array)));
            // return response()->json($request->product_taxes_array);
            $i = 0;
            foreach ($productIdsArray as $productId) {
                $key_name = $keys[$i];

                DB::table('sal_invoice_details')->where('sal_invoice_detail_id', $detailIdArray[$i])->update([
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
        $data['title'] = 'Invoice Details';
        $data['navbar_headings'] = 'Invoice Details';
        $data['taxes'] = DB::table('pro_taxes')->where('company_id', session()->get('company_id'))->get();
        $data['products'] = DB::table('pro_products')->where('company_id', session()->get('company_id'))->get();
        $data['salInvoice'] = SalInvoice::with('details')->find($request->salInvoiceId);
        // getting taxes names and values start 
        // dd($data['salInvoice']->taxes);
        $data['taxesNamesAndPercentage'] = [];
        foreach ($data['salInvoice']->details as $detail) {
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
        $data['suppliers'] = DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type', 'Customer')->get();
        $data['salOrders'] = DB::table('sal_orders')->where('company_id', session()->get('company_id'))->get();
        return view('sale/sal_invoice_detail', $data);
    }




    public function salInvoiceUrl(Request $request)
    {
        $url = url('sal_invoice_detail_print' . '/' . $request->id);
        return response()->json($url);
    }
    public function salInvoiceDetailPrint(Request $request)

    {
        $data['title'] = 'Sale Invoice Details';
        $data['navbar_headings'] = 'Sale Invoice Details';


        $result = SalInvoice::with('products')->find($request->id);
        $data['company'] = DB::table('companies')->where('company_id', session()->get('company_id'))->get()->first();
        $data['salInvoice'] = $result->toArray();
        $data['supplier'] = DB::table('users')->where('user_id', $data['salInvoice']['supplier_id'])->get()->first();


        // taxes start ----------------------------------------------------------------------------------
        $taxesArray = [];  //taxes names
        $taxesPercentage = [];
        $totalTaxPerPro = [];
        $totalTax = 0;
        $totalAmount = 0;
        $invoiceTaxes = 0;
        $i = 0;

        foreach ($data['salInvoice']['products'] as $product) {
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

        if ($data['salInvoice']['taxes'] != NULL) {
            // invoice taxes start 
            $invoiceTaxesArray =  explode(',', $data['salInvoice']['taxes']);
            foreach ($invoiceTaxesArray as $invoiceTax) {
                $taxSingle = DB::table('pro_taxes')->where('tax_name', $invoiceTax)->get()->first();
                $invoiceTaxes +=  $taxSingle->percentage;
            }

            // invoice taxes end 

        }



        $data['taxesArray'] = $taxesArray;
        $data['taxesPercentage'] = $taxesPercentage;
        $data['totalTaxPerPro'] = $totalTaxPerPro;
        $data['totalTax'] = $totalTax;
        $data['totalAmount'] = $totalAmount;
        $data['invoiceTaxes'] = $invoiceTaxes;
        // taxes  end---------------------------------------------------------------
        // for hrm view payroll start
        $pdf = Pdf::loadView('sale/sal_invoice_detail_print', $data);
        $totalAmount = 0;
        $invoiceTaxes = 0;
        return $pdf->stream();

        //  return response()->json( $pdf->output());
        // return response($pdf->output(), 200, [
        //     'Content-Type' => 'application/pdf',
        //     'Content-Disposition' => 'inline; filename="file.pdf"',
        // ]);
    }
}

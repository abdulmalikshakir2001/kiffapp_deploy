<?php

namespace App\Http\Controllers\purchase;

use App\Http\Controllers\Controller;
use App\Models\Users\User;
use App\Models\purchase\PurPurchaseQuotation;
use App\Models\purchase\PurPurchaseQuotationDetail;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
// use PDF;
use Barryvdh\DomPDF\Facade\Pdf;
use DNS1D;
use DNS2D;


class PurPurchaseQuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['title'] = 'Purchase Quotation';
        $data['navbar_headings'] = 'Purchase Quotation';
        return view('purchase/pur_purchase_quotation_view', $data);
    }
    public function getData(Request $request)

    {
        $pur_purchase_quotation_table = DB::table('pur_purchase_quotations')->where('company_id', session()->get('company_id'))->get();
        // $crmLead =  DB::table('crm_leads')->where('company_id', session()->get('company_id'))->get();
        $allData = DataTables::of($pur_purchase_quotation_table)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $orderExist = DB::table('pur_purchase_orders')->where('pur_quotation_id',$row->pur_quotation_id)->where('company_id',session()->get('company_id'))->get()->count();



                $btn =
                    '<button  type="button"  class="text-secondary  pur_purchase_quotation_delete_btn bg-white "  style="border:none;" data-pur_purchase_quotation_id="' . $row->pur_quotation_id . '"data-bs-toggle="modal" data-bs-target="#delete_confirm_modal" ><i class="fas fa-trash-alt fs-6 text-danger"></i>
            </button>
            <button class="text-secondary  pur_purchase_quotation_edit_btn bg-white"  style="border: none;" data-pur_purchase_quotation_id="' . $row->pur_quotation_id . '" >
                    <a href="#"> <i class="fas fa-edit fs-6 text-success">
                    </i>
                    </a>

                </button>
                <button class="badge-info text-secondary  sidenav_zero_index border_5_font_12 pur_purchase_quotation_detail_button"  style="border: none;" data-pur_purchase_quotation_id="' . $row->pur_quotation_id . '" >
                        <a href="' . route('pur_purchase_quotation_detail', $row->pur_quotation_id) . '" class="text-white"> <i class="fas fa-eye ">
                        </i>
                        View
                        </a>
                    </button>
                ';
                if($orderExist==0){

                    $btn.= '<button class="badge-info text-secondary  text-white   sidenav_zero_index border_5_font_12 pur_purchase_quotation_accept_button"  style="border: none;" data-pur_purchase_quotation_id="' . $row->pur_quotation_id . '" >
                    Accept 
                        </button>';

                }
                else{
                    $btn.='<button class="badge-success text-secondary  text-white fw-bold   sidenav_zero_index border_5_font_12 pur_purchase_quotation_accept_button"  style="border: none;" data-pur_purchase_quotation_id="' . $row->pur_quotation_id . '"  disabled>
                    Accepted as order
                        </button>';

                }



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
        $data['title'] = 'Purchase Quotation';
        $data['navbar_headings'] = 'Purchase Quotation';
        $data['taxes'] = DB::table('pro_taxes')->where('company_id', session()->get('company_id'))->get();
        $data['products'] = DB::table('pro_products')->where('company_id', session()->get('company_id'))->get();
        $data['suppliers'] = DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type', 'Supplier')->get();
        $data['proQuotationRequests'] = DB::table('pur_product_quotation_requests')->where('company_id', session()->get('company_id'))->get();

        return view('purchase/pur_purchase_quotation_create', $data);
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
            'pro_quotation_req_id' => 'required',
            'delivery_date' => 'required',
            'creation_date' => 'required',
            'creation_time' => 'required',
            'quotation_status' => 'required',


        ]);




        $req = $request->only([
            'supplier_id',
            'pro_quotation_req_id',
            'delivery_date',
            'ref_num',
            'creation_date',
            'creation_time',
            'taxes',
            'description',
            'quotation_status'

        ]);
        $req['company_id'] = session()->get('company_id');
        $req['total_price']=$request->total_amount;
        if ($request->taxes_main != 'null') {

            $req['taxes'] = $request->taxes_main;
        } else {
            $req['taxes'] = 'NULL';
        }
        $currentDateTime = Carbon::now()->format('Y-m-d H:i:s');

        $randNumber = rand(1345689359, 1098354890);
        $req['pur_quotation_code'] = $randNumber;
        $req['barcode'] = json_encode(DNS1D::getBarcodeHTML($randNumber, 'C128'));
        $qrCodeRandNumber = rand(1345689359, 9999994899);
        $req['qr_code'] = $qrCodeRandNumber;
        $req['qr_code_string'] = json_encode(DNS2D::getBarcodeHTML(".$qrCodeRandNumber.", 'QRCODE', 5, 5));
        $req['created_at'] = $currentDateTime;
        $req['updated_at'] = $currentDateTime;
        $lastInsertionId = PurPurchaseQuotation::insertGetId($req); // insert quotation data 
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
                
                DB::table('pur_purchase_quotation_details')->insert([
                    'pur_quotation_id' => $lastInsertionId,
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
        $purPurchaseQuotationId = $request->purPurchaseQuotationId;

        $purPurchaseQuotationDeleted = PurPurchaseQuotation::where('pur_quotation_id', $purPurchaseQuotationId)->delete();
        if ($purPurchaseQuotationDeleted) {
            return response()->json('true');
        } else {
            return response()->json('false');
        }
    }

    public function updateForm(Request $request)
    {
        $data['title'] = 'Update PQ';
        $data['navbar_headings'] = 'Update  PQ';
        $data['taxes'] = DB::table('pro_taxes')->where('company_id', session()->get('company_id'))->get();
        $data['products'] = DB::table('pro_products')->where('company_id', session()->get('company_id'))->get();
        $data['purPurchaseQuotation'] = PurPurchaseQuotation::with('details')->find($request->purPurchaseQuotationId);
        // getting taxes names and values start 
        // dd($data['purPurchaseQuotation']->taxes);
        $data['taxesNamesAndPercentage']=[];
        foreach($data['purPurchaseQuotation']->details as $detail){
            $taxesInfoArray= taxesInfo(taxesNames:$detail['pro_taxes']);
            if(count($taxesInfoArray)==0){
                // echo "";
                array_push($data['taxesNamesAndPercentage'],"");
            }
            else{
                // print_r($taxesInfoArray['taxesNamesAndPercentage']);
                array_push($data['taxesNamesAndPercentage'],$taxesInfoArray['taxesNamesAndPercentage']);
            }
        }
        // getting taxes names and values end 
        $data['suppliers'] = DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type', 'Supplier')->get();
        $data['proQuotationRequests'] = DB::table('pur_product_quotation_requests')->where('company_id', session()->get
        ('company_id'))->get();
        // dd($data['purPurchaseQuotation']);
        // $data['pro_quotation_req']= DB::table('pur_product_quotation_requests')->where('pro_quotation_req_id',$request->proQuotationReqId)->get()->first();
        return view('purchase/pur_purchase_quotation_update', $data);
    }
    public function update(Request $request)
    {
        unset($request['_token']);
        $request->validate([
            'ref_num' => 'required',
            'supplier_id' => 'required',
            'pro_quotation_req_id' => 'required',
            'delivery_date' => 'required',

            'creation_date' => 'required',
            'creation_time' => 'required',
            'quotation_status' => 'required',


        ]);




        $req = $request->only([
            'supplier_id',
            'pro_quotation_req_id',
            'delivery_date',
            'ref_num',
            'creation_date',
            'creation_time',
            'taxes',
            'description',
            'quotation_status'

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
        $lastInsertionId = PurPurchaseQuotation::where('pur_quotation_id', $request->pur_purchase_quotation_id)->update($req);
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
                







                DB::table('pur_purchase_quotation_details')->where('pur_quotation_detail_id', $detailIdArray[$i])->update([
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
        $data['title'] = 'Update PQ';
        $data['navbar_headings'] = 'Update  PQ';
        $data['taxes'] = DB::table('pro_taxes')->where('company_id', session()->get('company_id'))->get();
        $data['products'] = DB::table('pro_products')->where('company_id', session()->get('company_id'))->get();
        $data['purPurchaseQuotation'] = PurPurchaseQuotation::with('details')->find($request->purPurchaseQuotationId);
        $data['suppliers'] = DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type', 'Supplier')->get();
        $data['proQuotationRequests'] = DB::table('pur_product_quotation_requests')->where('company_id', session()->get('company_id'))->get();
        // $data['pro_quotation_req']= DB::table('pur_product_quotation_requests')->where('pro_quotation_req_id',$request->proQuotationReqId)->get()->first();
        return view('purchase/pur_purchase_quotation_detail', $data);
    }




    public function purPurchaseQuotationUrl(Request $request)
    {
        $url = url('pur_purchase_quotation_detail_print' . '/' . $request->id);
        return response()->json($url);
    }
    public function purPurchaseQuotationDetailPrint(Request $request)

    {
        $data['title'] = 'Purchase Quotation Details';
        $data['navbar_headings'] = 'Purchase Quotation Details';


        $result = PurPurchaseQuotation::with('products')->find($request->id);
        $data['company'] = DB::table('companies')->where('company_id', session()->get('company_id'))->get()->first();
        $data['purPurchaseQuotation'] = $result->toArray();
        $data['supplier'] = DB::table('users')->where('user_id', $data['purPurchaseQuotation']['supplier_id'])->get()->first();


        // taxes start ----------------------------------------------------------------------------------
        $taxesArray = [];  //taxes names
        $taxesPercentage = [];
        $totalTaxPerPro = [];
        $totalTax = 0;
        $totalAmount = 0 ; 
        $quotationTaxes = 0 ;
        $i = 0;
        
            foreach ($data['purPurchaseQuotation']['products'] as $product) {
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
            if ($data['purPurchaseQuotation']['taxes'] != NULL) {
                // quotation taxes start 
            $quotationTaxesArray =  explode(',',$data['purPurchaseQuotation']['taxes']) ;
            foreach($quotationTaxesArray as $quotationTax){
                $taxSingle = DB::table('pro_taxes')->where('tax_name', $quotationTax)->get()->first();
                $quotationTaxes+=  $taxSingle->percentage ;



            }

            // quotation taxes end 
        }
        

        $data['taxesArray'] = $taxesArray;
        $data['taxesPercentage'] = $taxesPercentage;
        $data['totalTaxPerPro'] = $totalTaxPerPro;
        $data['totalTax'] = $totalTax;
        $data['totalAmount'] = $totalAmount;
        $data['quotationTaxes'] = $quotationTaxes;
        // taxes  end---------------------------------------------------------------
        // for hrm view payroll start
        $pdf = Pdf::loadView('purchase/pur_purchase_quotation_detail_print', $data);
        $totalAmount = 0 ;
        $quotationTaxes = 0 ;
        return $pdf->stream();

        //  return response()->json( $pdf->output());
        // return response($pdf->output(), 200, [
        //     'Content-Type' => 'application/pdf',
        //     'Content-Disposition' => 'inline; filename="file.pdf"',
        // ]);
    }
    // quoation to order 
    public function quotationToOrder(Request $request){
        // return response()->json($request->purchaseQuotationId);
        $orderExist = DB::table('pur_purchase_orders')->where('pur_quotation_id',$request->purchaseQuotationId)->where('company_id',session()->get('company_id'))->get()->count();
        // return response()->json($orderExist);

        if($orderExist == 0 ){
        $purPurchaseQuotation =   PurPurchaseQuotation::with('products')->find($request->purchaseQuotationId)->toArray();
        // return response()->json($purPurchaseQuotation);
        // return response()->json($purPurchaseQuotation['pur_quotation_id']);
        $quotationLastInsertId =  DB::table('pur_purchase_orders')->insertGetId([
            'pur_quotation_id'=>$purPurchaseQuotation['pur_quotation_id'],
            'company_id' =>$purPurchaseQuotation['company_id'],
            'supplier_id'=>$purPurchaseQuotation['supplier_id'],
            'taxes'=>$purPurchaseQuotation['taxes'],
            'order_date' =>Carbon::now()->format('Y-m-d'),
            'order_time'=>Carbon::now()->format('H:i:s'),
            'ref_num'=>$purPurchaseQuotation['ref_num'],
            'order_code' =>$purPurchaseQuotation['pur_quotation_code'],
            'barcode'=>$purPurchaseQuotation['barcode'],
            'qr_code'=>$purPurchaseQuotation['qr_code'],
            'qr_code_string'=>$purPurchaseQuotation['qr_code_string'],
            'description' =>$purPurchaseQuotation['description'],
            'total_price'=>$purPurchaseQuotation['total_price'],
            'status'=>'open',
            'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')


        ]);
        if($quotationLastInsertId){
            // return response()->json($purPurchaseQuotation['products']);
            foreach($purPurchaseQuotation['products'] as $product){
                // array_push($arr,$product['pivot']['unit_price']);
                DB::table('pur_purchase_order_details')->insert([
                    'pur_order_id'=>$quotationLastInsertId,
                    'pro_taxes'=>$product['pivot']['pro_taxes'],
                    'product_id'=>$product['pivot']['product_id'],
                    'unit_price'=>$product['pivot']['unit_price'],
                    'quantity'=>$product['pivot']['quantity'],
                    'discount'=>$product['pivot']['discount'],
                    'sub_total'=>$product['pivot']['sub_total'],
                    'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')



                ]);
            }
            return response()->json('true');




        }

    }else{
        return  response()->json('exist');


    }
        

    }
}

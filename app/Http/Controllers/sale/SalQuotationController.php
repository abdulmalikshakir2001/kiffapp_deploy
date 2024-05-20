<?php

namespace App\Http\Controllers\sale;

use App\Http\Controllers\Controller;
use App\Models\Users\User;
use App\Models\sale\SalQuotation;
use App\Models\sale\SalQuotationDetail;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
// use PDF;
use Barryvdh\DomPDF\Facade\Pdf;
use DNS1D;
use DNS2D;


class SalQuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['title'] = 'Sale Quotation';
        $data['navbar_headings'] = 'Sale Quotation';
        return view('sale/sal_quotation_view', $data);
    }
    public function getData(Request $request)

    {
        $sal_quotation_table = DB::table('sal_quotations')->where('company_id', session()->get('company_id'))->get();
        // $crmLead =  DB::table('crm_leads')->where('company_id', session()->get('company_id'))->get();
        $allData = DataTables::of($sal_quotation_table)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                



                $btn =
                    '<button  type="button"  class="text-secondary  sal_quotation_delete_btn bg-white "  style="border:none;" data-sal_quotation_id="' . $row->sal_quotation_id . '"data-bs-toggle="modal" data-bs-target="#delete_confirm_modal" ><i class="fas fa-trash-alt fs-6 text-danger"></i>
            </button>
            <button class="text-secondary  sal_quotation_edit_btn bg-white"  style="border: none;" data-sal_quotation_id="' . $row->sal_quotation_id . '" >
                    <a href="#"> <i class="fas fa-edit fs-6 text-success">
                    </i>
                    </a>

                </button>
                <button class="badge-info text-secondary  sidenav_zero_index border_5_font_12 sal_quotation_detail_button"  style="border: none;" data-sal_quotation_id="' . $row->sal_quotation_id . '" >
                        <a href="' . route('sal_quotation_detail', $row->sal_quotation_id) . '" class="text-white"> <i class="fas fa-eye ">
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
        $data['title'] = 'Sale Quotation';
        $data['navbar_headings'] = 'Sale Quotation';
        $data['taxes'] = DB::table('pro_taxes')->where('company_id', session()->get('company_id'))->get();
        $data['products'] = DB::table('pro_products')->where('company_id', session()->get('company_id'))->get();
        $data['suppliers'] = DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type', 'Customer')->get();
        $data['proQuotationRequests'] = DB::table('pur_product_quotation_requests')->where('company_id', session()->get('company_id'))->get();

        return view('sale/sal_quotation_create', $data);
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
            
            'delivery_date' => 'required',
            'creation_date' => 'required',
            'creation_time' => 'required',
            'quotation_status' => 'required',


        ]);




        $req = $request->only([
            'supplier_id',
            
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
        $req['sal_quotation_code'] = $randNumber;
        $req['barcode'] = json_encode(DNS1D::getBarcodeHTML($randNumber, 'C128'));
        $qrCodeRandNumber = rand(1345689359, 9999994899);
        $req['qr_code'] = $qrCodeRandNumber;
        $req['qr_code_string'] = json_encode(DNS2D::getBarcodeHTML(".$qrCodeRandNumber.", 'QRCODE', 5, 5));
        $req['created_at'] = $currentDateTime;
        $req['updated_at'] = $currentDateTime;
        $lastInsertionId = SalQuotation::insertGetId($req); // insert quotation data 
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
                
                DB::table('sal_quotation_details')->insert([
                    'sal_quotation_id' => $lastInsertionId,
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
        $salQuotationId = $request->salQuotationId;

        $salQuotationDeleted = SalQuotation::where('sal_quotation_id', $salQuotationId)->delete();
        if ($salQuotationDeleted) {
            return response()->json('true');
        } else {
            return response()->json('false');
        }
    }

    public function updateForm(Request $request)
    {
        $data['title'] = 'Update SQ';
        $data['navbar_headings'] = 'Update  SQ';
        $data['taxes'] = DB::table('pro_taxes')->where('company_id', session()->get('company_id'))->get();
        $data['products'] = DB::table('pro_products')->where('company_id', session()->get('company_id'))->get();
        $data['salQuotation'] = SalQuotation::with('details')->find($request->salQuotationId);
        // getting taxes names and values start 
        // dd($data['salQuotation']->taxes);
        $data['taxesNamesAndPercentage']=[];
        foreach($data['salQuotation']->details as $detail){
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
        $data['suppliers'] = DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type', 'Customer')->get();
        $data['proQuotationRequests'] = DB::table('pur_product_quotation_requests')->where('company_id', session()->get
        ('company_id'))->get();
        // dd($data['salQuotation']);
        // $data['pro_quotation_req']= DB::table('pur_product_quotation_requests')->where('pro_quotation_req_id',$request->proQuotationReqId)->get()->first();
        return view('sale/sal_quotation_update', $data);
    }
    public function update(Request $request)
    {
        unset($request['_token']);
        $request->validate([
            'ref_num' => 'required',
            'supplier_id' => 'required',
            
            'delivery_date' => 'required',

            'creation_date' => 'required',
            'creation_time' => 'required',
            'quotation_status' => 'required',


        ]);




        $req = $request->only([
            'supplier_id',
            
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
        $lastInsertionId = SalQuotation::where('sal_quotation_id', $request->sal_quotation_id)->update($req);
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
                







                DB::table('sal_quotation_details')->where('sal_quotation_detail_id', $detailIdArray[$i])->update([
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
        $data['title'] = ' SQ Detail';
        $data['navbar_headings'] = '  SQ Detail';
        $data['taxes'] = DB::table('pro_taxes')->where('company_id', session()->get('company_id'))->get();
        $data['products'] = DB::table('pro_products')->where('company_id', session()->get('company_id'))->get();
        $data['salQuotation'] = SalQuotation::with('details')->find($request->salQuotationId);
        $data['suppliers'] = DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type', 'Customer')->get();
        $data['proQuotationRequests'] = DB::table('pur_product_quotation_requests')->where('company_id', session()->get('company_id'))->get();
        
        return view('sale/sal_quotation_detail', $data);
    }




    public function salQuotationUrl(Request $request)
    {
        $url = url('sal_quotation_detail_print' . '/' . $request->id);
        return response()->json($url);
    }
    public function salQuotationDetailPrint(Request $request)

    {
        $data['title'] = 'Sale Quotation Details';
        $data['navbar_headings'] = 'Sale Quotation Details';


        $result = SalQuotation::with('products')->find($request->id);
        $data['company'] = DB::table('companies')->where('company_id', session()->get('company_id'))->get()->first();
        $data['salQuotation'] = $result->toArray();
        $data['supplier'] = DB::table('users')->where('user_id', $data['salQuotation']['supplier_id'])->get()->first();


        // taxes start ----------------------------------------------------------------------------------
        $taxesArray = [];  //taxes names
        $taxesPercentage = [];
        $totalTaxPerPro = [];
        $totalTax = 0;
        $totalAmount = 0 ; 
        $quotationTaxes = 0 ;
        $i = 0;
        
            foreach ($data['salQuotation']['products'] as $product) {
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
            if ($data['salQuotation']['taxes'] != NULL) {
                // quotation taxes start 
            $quotationTaxesArray =  explode(',',$data['salQuotation']['taxes']) ;
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
        $pdf = Pdf::loadView('sale/sal_quotation_detail_print', $data)->setPaper('a4')->setOption('margin-bottom', 20);
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
        // return response()->json($request->saleQuotationId);
        $orderExist = DB::table('sal_orders')->where('sal_quotation_id',$request->saleQuotationId)->where('company_id',session()->get('company_id'))->get()->count();
        // return response()->json($orderExist);

        if($orderExist == 0 ){
        $salQuotation =   SalQuotation::with('products')->find($request->saleQuotationId)->toArray();
        // return response()->json($salQuotation);
        // return response()->json($salQuotation['sal_quotation_id']);
        $quotationLastInsertId =  DB::table('sal_orders')->insertGetId([
            'sal_quotation_id'=>$salQuotation['sal_quotation_id'],
            'company_id' =>$salQuotation['company_id'],
            'supplier_id'=>$salQuotation['supplier_id'],
            'taxes'=>$salQuotation['taxes'],
            'order_date' =>Carbon::now()->format('Y-m-d'),
            'order_time'=>Carbon::now()->format('H:i:s'),
            'ref_num'=>$salQuotation['ref_num'],
            'order_code' =>$salQuotation['sal_quotation_code'],
            'barcode'=>$salQuotation['barcode'],
            'qr_code'=>$salQuotation['qr_code'],
            'qr_code_string'=>$salQuotation['qr_code_string'],
            'description' =>$salQuotation['description'],
            'total_price'=>$salQuotation['total_price'],
            'status'=>'open',
            'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')


        ]);
        if($quotationLastInsertId){
            // return response()->json($salQuotation['products']);
            foreach($salQuotation['products'] as $product){
                // array_push($arr,$product['pivot']['unit_price']);
                DB::table('sal_order_details')->insert([
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

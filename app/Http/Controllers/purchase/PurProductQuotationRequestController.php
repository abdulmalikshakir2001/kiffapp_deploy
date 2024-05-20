<?php

namespace App\Http\Controllers\purchase;

use App\Http\Controllers\Controller;
use App\Models\Users\User;
use App\Models\purchase\PurProductQuotationRequest;
use App\Models\purchase\PurProductQuotationRequestDetail;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
// use PDF;
use Barryvdh\DomPDF\Facade\Pdf;
use DNS1D;
use DNS2D;


class PurProductQuotationRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['title'] = 'All PQR';
        $data['navbar_headings'] = 'All PQR';
        return view('purchase/pur_pro_quotation_req_view', $data);
    }
    public function getData(Request $request)

    {
        $pur_product_quotation_requests_table= DB::table('pur_product_quotation_requests')->where('company_id',session()->get('company_id'))->get();
        // $crmLead =  DB::table('crm_leads')->where('company_id', session()->get('company_id'))->get();
        $allData = DataTables::of($pur_product_quotation_requests_table)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn =
                    '<button  type="button"  class="text-secondary  pro_quotation_req_delete_btn bg-white "  style="border:none;" data-pro_quotation_req_id="' . $row->pro_quotation_req_id . '"data-bs-toggle="modal" data-bs-target="#delete_confirm_modal" ><i class="fas fa-trash-alt fs-6 text-danger"></i>
            </button>
            <button class="text-secondary  pro_quotation_req_edit_btn bg-white"  style="border: none;" data-pro_quotation_req_id="' . $row->pro_quotation_req_id . '" >
                    <a href="#"> <i class="fas fa-edit fs-6 text-success">
                    </i>
                    </a>

                </button>
                <button class="badge-info text-secondary  sidenav_zero_index border_5_font_12 pro_quotation_req_detail_button"  style="border: none;" data-pro_quotation_req_id="' . $row->pro_quotation_req_id . '" >
                        <a href="' . route('pro_quotation_req_detail', $row->pro_quotation_req_id) . '" class="text-white"> <i class="fas fa-eye ">
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
        $data['title'] = 'Create PQR';
        $data['navbar_headings'] = 'Create  PQR';
        $data['taxes'] = DB::table('pro_taxes')->where('company_id', session()->get('company_id'))->get();
        $data['products'] = DB::table('pro_products')->where('company_id', session()->get('company_id'))->get();
        return view('purchase/pur_pro_quotation_req_create', $data);
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
            'creation_date' => 'required',
            'creation_time' => 'required',

            
        ]);
        
        


        $req=$request->only([
            'ref_num',
'creation_date',
'creation_time',
'description'

        ]);
        $req['company_id'] = session()->get('company_id');
        $req['created_by'] = session()->get('user_id');

        
        $currentDateTime=Carbon::now()->format('Y-m-d H:i:s');

        $randNumber= rand(1345689359, 1098354890);
        $qrCodeRandNumber= rand(1345689359, 9999994899);
        $req['pro_quotation_req_code'] = $randNumber;
        $req['barcode'] = json_encode(DNS1D::getBarcodeHTML($randNumber, 'C128'));
        $req['qr_code'] = $qrCodeRandNumber;
        $req['qr_code_string'] = json_encode(DNS2D::getBarcodeHTML(".$qrCodeRandNumber.", 'QRCODE',5,5));
        $req['created_at']=$currentDateTime;
        $req['updated_at']=$currentDateTime;
        $lastInsertionId = PurProductQuotationRequest::insertGetId($req);
        if($lastInsertionId){

            $productIdsArray= explode(',',$request->product_ids_array);
            $productDiscountArray= explode(',',$request->product_discount_array);
            $productQuantityArray= explode(',',$request->product_quantity_array);
            $productUnitPriceArray= explode(',',$request->product_unit_price_array);
            $keys = array_keys(get_object_vars(json_decode($request->product_taxes_array)));
            $i=0;
            foreach($productIdsArray as $productId){
                $key_name= $keys[$i];
                DB::table('pur_product_quotation_request_details')->insert([
                    'pro_quotation_req_id'=>$lastInsertionId,
                    'product_id'=>$productId,
                    'quantity'=>$productQuantityArray[$i],
                    'created_at'=>$currentDateTime,
                    'updated_at'=>$currentDateTime
                ]);
                $i++;
            }
            return response()->json('true');

        }
        
    }

    public function delete(Request $request)
    {
        $pro_quotation_req_id = $request->proQuotationReqId;

        $ProductQuotationRequestDeleted = PurProductQuotationRequest::where('pro_quotation_req_id', $pro_quotation_req_id)->delete();
        if ($ProductQuotationRequestDeleted) {
            return response()->json('true');
        } else {
            return response()->json('false');
        }
    }

    public function updateForm(Request $request)
    {
        $data['title'] = 'Update PQR';
        $data['navbar_headings'] = 'Update  PQR';
        $data['taxes'] = DB::table('pro_taxes')->where('company_id', session()->get('company_id'))->get();
        $data['products'] = DB::table('pro_products')->where('company_id', session()->get('company_id'))->get();
        $data['pro_quotation_req']= PurProductQuotationRequest::with('details')->find($request->proQuotationReqId);
        // $data['pro_quotation_req']= DB::table('pur_product_quotation_requests')->where('pro_quotation_req_id',$request->proQuotationReqId)->get()->first();
        return view('purchase/pur_pro_quotation_req_update', $data);
    }
    public function update(Request $request)
    {
        unset($request['_token']);
        $request->validate([
            'ref_num' => 'required',
            'creation_date' => 'required',
            'creation_time' => 'required',

            
        ]);
        
        


        $req=$request->only([
            'ref_num',
'creation_date',
'creation_time',
'description'

        ]);
        $req['company_id'] = session()->get('company_id');
        $req['created_by'] = session()->get('user_id');

        
        $updatedAt=Carbon::now()->format('Y-m-d H:i:s');

        // $randNumber= rand(1345689359, 1098354890);
        // $req['pro_quotation_req_code'] = $randNumber;
        // $req['barcode'] = json_encode(DNS1D::getBarcodeHTML($randNumber, 'C128'));
        $lastInsertionId = PurProductQuotationRequest::where('pro_quotation_req_id',$request->pro_quotation_req_id)->update($req);
        if($lastInsertionId){

            $productIdsArray= explode(',',$request->product_ids_array);
            $productDiscountArray= explode(',',$request->product_discount_array);
            $productQuantityArray= explode(',',$request->product_quantity_array);
            $productUnitPriceArray= explode(',',$request->product_unit_price_array);
            $detailIdArray= explode(',',$request->detail_id_array);
            $keys = array_keys(get_object_vars(json_decode($request->product_taxes_array)));
            $i=0;
            foreach($productIdsArray as $productId){
                $key_name= $keys[$i];
                DB::table('pur_product_quotation_request_details')->where('pro_quotation_req_detail_id',$detailIdArray[$i])->update([
                    'product_id'=>$productId,
                    'quantity'=>$productQuantityArray[$i],
                    'updated_at'=>$updatedAt,
                ]);
                $i++;
            }
            return response()->json('true');

        }
    }

    public function Details(Request $request)
    {
        $data['title'] = 'PQR Details';
        $data['navbar_headings'] = 'PQR Details';
        $data['taxes'] = DB::table('pro_taxes')->where('company_id', session()->get('company_id'))->get();
        $data['products'] = DB::table('pro_products')->where('company_id', session()->get('company_id'))->get();
        $data['pro_quotation_req']= PurProductQuotationRequest::with('details')->find($request->pro_quotation_req_id);
        // $data['pro_quotation_req']= DB::table('pur_product_quotation_requests')->where('pro_quotation_req_id',$request->proQuotationReqId)->get()->first();
        return view('purchase/pur_pro_quotation_req_detail', $data);
    }




    public function proQuotationReqUrl(Request $request)
    {
        $url = url('pro_quotation_req_details_print' . '/' . $request->id);
        return response()->json($url);
    }


    public function proQuotationReqDetailsPrint(Request $request)
    {
        $data['title'] = 'PQR Details';
        $data['navbar_headings'] = 'PQR Details';
        $data['taxes'] = DB::table('pro_taxes')->where('company_id', session()->get('company_id'))->get();
        $data['products'] = DB::table('pro_products')->where('company_id', session()->get('company_id'))->get();
        // $data['pro_quotation_req']= PurProductQuotationRequest::with('details')->find($request->id);
        $result= PurProductQuotationRequest::with('products')->find($request->id);
        $data['company']=DB::table('companies')->where('company_id',session()->get('company_id'))->get()->first();
        $data['pro_quotation_req']=$result->toArray();
        // for hrm view payroll start
        $pdf = Pdf::loadView('purchase/pur_pro_quotation_req_detail_print', $data);
        return $pdf->stream();

        //  return response()->json( $pdf->output());
        // return response($pdf->output(), 200, [
        //     'Content-Type' => 'application/pdf',
        //     'Content-Disposition' => 'inline; filename="file.pdf"',
        // ]);
    }

    // fetch taxes 
    public function productTaxes (Request $request){
        // return response()->json($request->productId);
        $product= DB::table('pro_products')->where('product_id',$request->productId)->get()->first();
        // return response()->json($product->product_taxes);
        $taxesNameValue=[]; // this  array contain two arrays one contain name and other contain values.
        if($product->product_taxes!=NULL){
        $productTaxesArray= explode(',',$product->product_taxes);
        
        $taxesInPercent=[];
        foreach($productTaxesArray as $productTaxName){
            $tax= DB::table('pro_taxes')->where('tax_name',$productTaxName)->get()->first();
            $taxesInPercent[]=$tax->percentage;

        }
        $taxesNameValue[]=$productTaxesArray;
        $taxesNameValue[]=$taxesInPercent;
    }
        return response()->json($taxesNameValue);






        


    }
    public function productTaxesSelectField(Request $request){
        // return response()->json('true');
        // return $request->proTaxesNames;
        //  return response()->json($request->proTaxesNames);

        $taxesNameValue=[]; // this  array contain two arrays one contain name and other contain values.


        if(count($request->proTaxesNames)>0){
        // return response()->json($request->proTaxesNames);
        $taxesInPercent=[];
        foreach($request->proTaxesNames as $productTaxName){
            $tax= DB::table('pro_taxes')->where('tax_name',$productTaxName)->get()->first();
            $taxesInPercent[]=$tax->percentage;

        }
        $taxesNameValue[]=$request->proTaxesNames;
        $taxesNameValue[]=$taxesInPercent;


        }
        return response()->json($taxesNameValue);
        


    }



}

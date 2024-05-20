<?php

namespace App\Http\Controllers\purchase;

use App\Http\Controllers\Controller;
use App\Models\Users\User;
use App\Models\purchase\PurProductQuotationRequestDetail;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
// use PDF;
use Barryvdh\DomPDF\Facade\Pdf;


class PurProductQuotationRequestDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['title'] = 'All PQR Details';
        $data['navbar_headings'] = 'All PQR Details';
        return view('purchase/pur_product_quotation_request_detail_view', $data);
    }
    public function getData(Request $request)

    {
        $pur_product_quotation_request_detail_table= DB::table('pur_product_quotation_request_details')->where('company_id',session()->get('company_id'))->get();


        // $crmLead =  DB::table('crm_leads')->where('company_id', session()->get('company_id'))->get();
        $allData = DataTables::of($pur_product_quotation_request_detail_table)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn =
                    '<button  type="button"  class="text-secondary  pur_product_quotation_request_detail_delete_btn bg-white "  style="border:none;" data-pur_product_quotation_request_detail_id="' . $row->pro_quotation_req_detail_id . '"data-bs-toggle="modal" data-bs-target="#delete_confirm_modal" ><i class="fas fa-trash-alt fs-6 text-danger"></i>
            </button>
            <button class="text-secondary  pur_product_quotation_request_detail_edit_btn bg-white"  style="border: none;" data-pur_product_quotation_request_detail_id="' . $row->pro_quotation_req_detail_id . '" >
                    <a href="#"> <i class="fas fa-edit fs-6 text-success">
                    </i>
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
        $data['title'] = 'Create PQR Detail';
        $data['navbar_headings'] = 'Create  PQR Detail';
        $data['taxes'] = DB::table('pro_taxes')->where('company_id', session()->get('company_id'))->get();
        return view('purchase/pur_product_quotation_request_detail_create', $data);
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
            'pro_quotation_req_id' => 'required',
            'product_id' => 'required',
            'unit_price' => 'required',
            'quantity' => 'required',
            'discount' => 'required',
            'taxes' => 'required',
            'sub_total' => 'required',
        ]);
        $request['company_id'] = session()->get('company_id');
        $request['taxes'] = implode(',',$request->taxes);
        $proQuotationRequestDetailAdded = PurProductQuotationRequestDetail::insert($request->all());
        if ($proQuotationRequestDetailAdded) {
            return response()->json('true');
        } else {
            return response()->json('false');
        }
    }

    public function delete(Request $request)
    {
        $pro_quotation_req_detail_id = $request->proQuotationReqId;

        $ProductQuotationRequestDeleted = PurProductQuotationRequestDetail::where('pro_quotation_req_detail_id', $pro_quotation_req_detail_id)->delete();
        if ($ProductQuotationRequestDeleted) {
            return response()->json('true');
        } else {
            return response()->json('false');
        }
    }

    public function updateForm(Request $request)
    {
        $data['title'] = 'Create PQR';
        $data['navbar_headings'] = 'Create  PQR';
        $data['taxes'] = DB::table('pro_taxes')->where('company_id', session()->get('company_id'))->get();
        $data['pro_quotation_req_detail']= DB::table('pur_product_quotation_requests')->where('pro_quotation_req_detail_id',$request->proQuotationReqId)->get()->first();
        return view('purchase/pur_pro_quotation_req_detail_update', $data);
    }
    public function update(Request $request)
    {
        unset($request['_token']);
        $request->validate([
            'ref_num' => 'required',
            'creation_date' => 'required',
            'creation_time' => 'required',
        ]);
        $request['company_id'] = session()->get('company_id');
        $request['created_by'] = session()->get('user_id');
        $request['taxes'] = implode(',',$request->taxes);

        $proQuotationRequestDetailUpdated = PurProductQuotationRequestDetail::where('pro_quotation_req_detail_id',$request->pro_quotation_req_detail_id)->update($request->all());
        if ($proQuotationRequestDetailUpdated) {
            return response()->json('true');
        } else {
            return response()->json('false');
        }
    }

    public function Details(Request $request)
    {
        $data['lead'] = CrmLead::where('lead_id', $request->crmLeadId)->get()->first();
        $data['title'] = 'Lead Details';
        $data['navbar_headings'] = 'Lead Details';
        $data['contacts'] = DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type', 'ContactOnly')->get();
        $data['employees'] = DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type', 'Employee')->get();
        $data['categories'] = DB::table('crm_categories')->where('company_id', session()->get('company_id'))->get();
        return view('crm/crmLeadDetails', $data);
    }




    public function crmLeadUrl(Request $request)
    {
        $url = url('leadDetailsPrint' . '/' . $request->crmLeadId);
        return response()->json($url);
    }


    public function crmLeadDetailsPrint(Request $request)

    {
        $data['lead'] = CrmLead::where('lead_id', $request->crmLeadId)->get()->first();
        $data['title'] = 'Update Lead';
        $data['navbar_headings'] = 'Update  Lead';
        $data['contacts'] = DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type', 'ContactOnly')->get();
        $data['employees'] = DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type', 'Employee')->get();
        $data['categories'] = DB::table('crm_categories')->where('company_id', session()->get('company_id'))->get();
        // for hrm view payroll start
        $pdf = Pdf::loadView('crm/crmLeadDetailsPrint', $data);
        return $pdf->stream();

        //  return response()->json( $pdf->output());
        // return response($pdf->output(), 200, [
        //     'Content-Type' => 'application/pdf',
        //     'Content-Disposition' => 'inline; filename="file.pdf"',
        // ]);
    }
}

<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\Users\User;
use App\Models\CRM\CrmPhoneCall;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
// use PDF;
use Barryvdh\DomPDF\Facade\Pdf;

class CrmPhoneCallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['title'] = 'All Phone Call';
        $data['navbar_headings'] = 'All Phone Call';
        return view('crm/crmPhoneCallView', $data);
    }
    public function getData(Request $request)

    {
        // $crmPhoneCall =  DB::table('crm_phone_calls')->where('company_id', session()->get('company_id'))->get();
        $crmPhoneCall= DB::table('crm_phone_calls')->select('crm_phone_calls.*','users.username')->join('users',function($join){
            $join->on('crm_phone_calls.contact_id','=','users.user_id');
        })
        
         ->where('crm_phone_calls.company_id',session()->get('company_id'))->get();
        $allData = DataTables::of($crmPhoneCall)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn =
                    '<button  type="button"  class="text-secondary  crmPhoneCallDeleteBtn bg-white "  style="border:none;" data-crm_phone_call_id="' . $row->phone_call_id . '"data-bs-toggle="modal" data-bs-target="#deleteConfirmModal" ><i class="fas fa-trash-alt fs-6 text-danger"></i>
            </button>
            <button class="text-secondary crmPhoneCallEditBtn bg-white"  style="border: none;" data-crm_phone_call_id="' . $row->phone_call_id . '" >
                    <a href="#"> <i class="fas fa-edit fs-6 text-success">
                    </i>
                    </a>

                </button>
                <button class="badge-info text-secondary  sidenav_zero_index border_5_font_12 crmPhoneCallDetailsButton"  style="border: none;" data-crm_phone_call_id="' . $row->phone_call_id . '" >
                        <a href="' . route('phoneCallDetails', $row->phone_call_id) . '" class="text-white"> <i class="fas fa-eye ">
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
        $data['title'] = 'Create Phone Call';
        $data['navbar_headings'] = 'Create  Phone Call';
        $data['contacts'] = DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type', 'ContactOnly')->get();
        $data['leads'] = DB::table('crm_leads')->join('crm_categories','crm_leads.category_id','=','crm_categories.category_id')->where('crm_leads.company_id', session()->get('company_id'))->get();
        return view('crm/crmPhoneCallCreate', $data);
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
            'contact_id' => 'required',
            'lead_id'=>'required'
            
        ]);
        $request['company_id'] = session()->get('company_id');

        $crmPhoneCallAdded = CrmPhoneCall::insert($request->all());
        if ($crmPhoneCallAdded) {
            return response()->json('true');
        } else {
            return response()->json('false');
        }
    }

    public function delete(Request $request)
    {
        $crmPhoneCallId = $request->crmPhoneCallId;

        $crmPhoneCallDeleted = CrmPhoneCall::where('phone_call_id', $crmPhoneCallId)->delete();
        if ($crmPhoneCallDeleted) {
            return response()->json('true');
        } else {
            return response()->json('false');
        }
    }
    public function updateForm(Request $request)
    {
        $data['title'] = 'Update Phone Call';
        $data['navbar_headings'] = 'Update  Phone Call';

        $data['crmPhoneCall'] = CrmPhoneCall::where('phone_call_id', $request->crmPhoneCallId)->get()->first();
        $data['contacts'] = DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type', 'ContactOnly')->get();
        $data['leads'] = DB::table('crm_leads')->join('crm_categories','crm_leads.category_id','=','crm_categories.category_id')->where('crm_leads.company_id', session()->get('company_id'))->get();
        return view('crm/crmPhoneCallUpdate', $data);
    }
    public function update(Request $request)
    {
        unset($request['_token']);
        $request->validate([
            'contact_id' => 'required',
            'lead_id'=>'required'
        ]);
        $request['company_id'] = session()->get('company_id');

        $crmPhoneCallUpdated = CrmPhoneCall::where('phone_call_id', $request->phone_call_id)->update($request->all());
        if ($crmPhoneCallUpdated) {
            return response()->json('true');
        } else {
            return response()->json('false');
        }
    }

    public function Details(Request $request)
    {
        $data['title'] = 'Update Phone Call';
        $data['navbar_headings'] = 'Update  Phone Call';
        $data['crmPhoneCall'] = CrmPhoneCall::where('phone_call_id', $request->crmPhoneCallId)->get()->first();
        $data['contacts'] = DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type', 'ContactOnly')->get();
        $data['leads'] = DB::table('crm_leads')->join('crm_categories','crm_leads.category_id','=','crm_categories.category_id')->where('crm_leads.company_id', session()->get('company_id'))->get();
        return view('crm/crmPhoneCallDetails', $data);
    }




    public function crmPhoneCallUrl(Request $request)
    {
        $url = url('phoneCallDetailsPrint' . '/' . $request->crmPhoneCallId);
        return response()->json($url);
    }
    public function crmPhoneCallDetailsPrint(Request $request)

    {
        $data['title'] = ' Phone Call Details';
        $data['navbar_headings'] = '  Phone Call Details';
        $data['crmPhoneCall'] = CrmPhoneCall::where('phone_call_id', $request->crmPhoneCallId)->get()->first();
        $data['contacts'] = DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type', 'ContactOnly')->get();
        $data['leads'] = DB::table('crm_leads')->join('crm_categories','crm_leads.category_id','=','crm_categories.category_id')->where('crm_leads.company_id', session()->get('company_id'))->get();
        // for hrm view payroll start
        $pdf = Pdf::loadView('crm/crmPhoneCallDetailsPrint', $data)->setPaper('a4')->setOption('margin-bottom', 20);
        return  $pdf->stream();
        // return response($pdf->output(), 200, [
        //     'Content-Type' => 'application/pdf',
        //     'Content-Disposition' => 'inline; filename="file.pdf"',
        // ]);
    }
}

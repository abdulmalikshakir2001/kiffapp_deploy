<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\Users\User;
use App\Models\CRM\CrmSchedulePhoneCall;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
// use PDF;
use Barryvdh\DomPDF\Facade\Pdf;

class CrmSchedulePhoneCallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['title'] = 'All Schedule Phone Call';
        $data['navbar_headings'] = 'All Schedule Phone Call';
        return view('crm/crmSchedulePhoneCallView', $data);
    }
    public function getData(Request $request)

    {
        // $crmSchedulePhoneCall =  DB::table('crm_schedule_phone_calls')->where('company_id', session()->get('company_id'))->get();
        $crmSchedulePhoneCall= DB::table('crm_schedule_phone_calls')->select('crm_schedule_phone_calls.*','users.username')->join('users',function($join){
            $join->on('crm_schedule_phone_calls.contact_id','=','users.user_id');
        })
        
         ->where('crm_schedule_phone_calls.company_id',session()->get('company_id'))->get();
        $allData = DataTables::of($crmSchedulePhoneCall)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn =
                    '<button  type="button"  class="text-secondary  crmSchedulePhoneCallDeleteBtn bg-white "  style="border:none;" data-crm_schedule_phone_call_id="' . $row->schedule_phone_call_id . '"data-bs-toggle="modal" data-bs-target="#deleteConfirmModal" ><i class="fas fa-trash-alt fs-6 text-danger"></i>
            </button>
            <button class="text-secondary crmSchedulePhoneCallEditBtn bg-white"  style="border: none;" data-crm_schedule_phone_call_id="' . $row->schedule_phone_call_id . '" >
                    <a href="#"> <i class="fas fa-edit fs-6 text-success">
                    </i>
                    </a>

                </button>
                <button class="badge-info text-secondary  sidenav_zero_index border_5_font_12 crmSchedulePhoneCallDetailsButton"  style="border: none;" data-crm_schedule_phone_call_id="' . $row->schedule_phone_call_id . '" >
                        <a href="' . route('schedulePhoneCallDetails', $row->schedule_phone_call_id) . '" class="text-white"> <i class="fas fa-eye ">
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
        $data['title'] = 'Create Schedule Phone Call';
        $data['navbar_headings'] = 'Create  Schedule Phone Call';
        $data['contacts'] = DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type', 'ContactOnly')->get();
        $data['categories'] = DB::table('crm_categories')->where('company_id', session()->get('company_id'))->get();
        $data['leads'] = DB::table('crm_leads')->join('crm_categories','crm_leads.category_id','=','crm_categories.category_id')->where('crm_leads.company_id', session()->get('company_id'))->get();
        $data['oppertunities'] =  DB::table('crm_oppertunities')->join('crm_categories','crm_oppertunities.category_id','=','crm_categories.category_id')->where('crm_oppertunities.company_id', session()->get('company_id'))->get();
        return view('crm/crmSchedulePhoneCallCreate', $data);
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
            'category_id' => 'required',
            'priority' => 'required',
            'lead_id'=>'required',
            'oppertunity_id'=>'required',
        ]);
        $request['company_id'] = session()->get('company_id');

        $crmSchedulePhoneCallAdded = CrmSchedulePhoneCall::insert($request->all());
        if ($crmSchedulePhoneCallAdded) {
            return response()->json('true');
        } else {
            return response()->json('false');
        }
    }

    public function delete(Request $request)
    {
        $crmSchedulePhoneCallId = $request->crmSchedulePhoneCallId;

        $crmSchedulePhoneCallDeleted = CrmSchedulePhoneCall::where('schedule_phone_call_id', $crmSchedulePhoneCallId)->delete();
        if ($crmSchedulePhoneCallDeleted) {
            return response()->json('true');
        } else {
            return response()->json('false');
        }
    }
    public function updateForm(Request $request)
    {
        $data['title'] = 'Update Schedule Phone Call';
        $data['navbar_headings'] = 'Update  Schedule Phone Call';

        $data['contacts'] = DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type', 'ContactOnly')->get();
        $data['categories'] = DB::table('crm_categories')->where('company_id', session()->get('company_id'))->get();
        $data['leads'] = DB::table('crm_leads')->join('crm_categories','crm_leads.category_id','=','crm_categories.category_id')->where('crm_leads.company_id', session()->get('company_id'))->get();
        $data['oppertunities'] =  DB::table('crm_oppertunities')->join('crm_categories','crm_oppertunities.category_id','=','crm_categories.category_id')->where('crm_oppertunities.company_id', session()->get('company_id'))->get();
        $data['schedulePhoneCalls'] = DB::table('crm_schedule_phone_calls')->where('company_id', session()->get('company_id'))->get()->first();
        return view('crm/crmSchedulePhoneCallUpdate', $data);
    }
    public function update(Request $request)
    {
        unset($request['_token']);
        $request->validate([
            'contact_id' => 'required',
            'category_id' => 'required',
            'priority' => 'required',
            'lead_id'=>'required',
            'oppertunity_id'=>'required',
        ]);
        $request['company_id'] = session()->get('company_id');

        $crmSchedulePhoneCallUpdated = CrmSchedulePhoneCall::where('schedule_phone_call_id', $request->schedule_phone_call_id)->update($request->all());
        if ($crmSchedulePhoneCallUpdated) {
            return response()->json('true');
        } else {
            return response()->json('false');
        }
    }

    public function Details(Request $request)
    {
        $data['title'] = ' Schedule Phone Call Details';
        $data['navbar_headings'] = '  Schedule Phone Call Details';

        $data['contacts'] = DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type', 'ContactOnly')->get();
        $data['categories'] = DB::table('crm_categories')->where('company_id', session()->get('company_id'))->get();
        $data['leads'] = DB::table('crm_leads')->join('crm_categories','crm_leads.category_id','=','crm_categories.category_id')->where('crm_leads.company_id', session()->get('company_id'))->get();
        $data['oppertunities'] =  DB::table('crm_oppertunities')->join('crm_categories','crm_oppertunities.category_id','=','crm_categories.category_id')->where('crm_oppertunities.company_id', session()->get('company_id'))->get();
        $data['schedulePhoneCalls'] = DB::table('crm_schedule_phone_calls')->where('company_id', session()->get('company_id'))->get()->first();
        return view('crm/crmSchedulePhoneCallDetails', $data);
    }




    public function crmSchedulePhoneCallUrl(Request $request)
    {
        $url = url('schedulePhoneCallDetailsPrint' . '/' . $request->crmSchedulePhoneCallId);
        return response()->json($url);
    }


    public function crmSchedulePhoneCallDetailsPrint(Request $request)

    {
        $data['title'] = ' Schedule Phone Call Details';
        $data['navbar_headings'] = '  Schedule Phone Call Details';

        $data['contacts'] = DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type', 'ContactOnly')->get();
        $data['categories'] = DB::table('crm_categories')->where('company_id', session()->get('company_id'))->get();
        $data['leads'] = DB::table('crm_leads')->join('crm_categories','crm_leads.category_id','=','crm_categories.category_id')->where('crm_leads.company_id', session()->get('company_id'))->get();
        $data['oppertunities'] =  DB::table('crm_oppertunities')->join('crm_categories','crm_oppertunities.category_id','=','crm_categories.category_id')->where('crm_oppertunities.company_id', session()->get('company_id'))->get();
        $data['schedulePhoneCalls'] = DB::table('crm_schedule_phone_calls')->where('company_id', session()->get('company_id'))->get()->first();
        // for hrm view payroll start
        $pdf = Pdf::loadView('crm/crmSchedulePhoneCallDetailsPrint', $data);
        return $pdf->stream();
        // return response($pdf->output(), 200, [
        //     'Content-Type' => 'application/pdf',
        //     'Content-Disposition' => 'inline; filename="file.pdf"',
        // ]);
    }
}

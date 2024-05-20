<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\Users\User;
use App\Models\CRM\CrmLead;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
// use PDF;
use Barryvdh\DomPDF\Facade\Pdf;

class CrmLeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['title'] = 'All Lead';
        $data['navbar_headings'] = 'All Lead';
        return view('crm/crmLeadView', $data);
    }
    public function getData(Request $request)

    {
        $crmLead= DB::table('crm_leads')->select('crm_leads.*','users.username','salesPerson.username as salesPerson','crm_categories.category_name')->join('users',function($join){
            $join->on('crm_leads.contact_id','=','users.user_id');
        })->join('crm_categories','crm_leads.category_id','=','crm_categories.category_id')
        ->join('users as salesPerson','crm_leads.employee_id','=','salesPerson.user_id')
         ->where('crm_leads.company_id',session()->get('company_id'))->get();


        // $crmLead =  DB::table('crm_leads')->where('company_id', session()->get('company_id'))->get();
        $allData = DataTables::of($crmLead)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn =
                    '<button  type="button"  class="text-secondary  crmLeadDeleteBtn bg-white "  style="border:none;" data-crm_lead_id="' . $row->lead_id . '"data-bs-toggle="modal" data-bs-target="#deleteConfirmModal" ><i class="fas fa-trash-alt fs-6 text-danger"></i>
            </button>
            <button class="text-secondary crmLeadEditBtn bg-white"  style="border: none;" data-crm_lead_id="' . $row->lead_id . '" >
                    <a href="#"> <i class="fas fa-edit fs-6 text-success">
                    </i>
                    </a>

                </button>
                <button class="badge-info text-secondary  sidenav_zero_index border_5_font_12 crmLeadDetailsButton"  style="border: none;" data-crm_lead_id="' . $row->lead_id . '" >
                        <a href="' . route('leadDetails', $row->lead_id) . '" class="text-white"> <i class="fas fa-eye ">
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
        $data['title'] = 'Create Lead';
        $data['navbar_headings'] = 'Create  Lead';
        $data['contacts'] = DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type', 'ContactOnly')->get();
        $data['employees'] = DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type', 'Employee')->get();
        $data['categories'] = DB::table('crm_categories')->where('company_id', session()->get('company_id'))->get();
        return view('crm/crmLeadCreate', $data);
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
            'subject' => 'required',
            'contact_id' => 'required',
            'employee_id' => 'required',
            'category_id' => 'required',
            'priority' => 'required',
            'creation_date' => 'required',
        ]);
        $request['company_id'] = session()->get('company_id');
        $request['created_by'] = session()->get('user_id');

        $crmLeadAdded = CrmLead::insert($request->all());
        if ($crmLeadAdded) {
            return response()->json('true');
        } else {
            return response()->json('false');
        }
    }

    public function delete(Request $request)
    {
        $crmLeadId = $request->crmLeadId;

        $crmLeadDeleted = CrmLead::where('lead_id', $crmLeadId)->delete();
        if ($crmLeadDeleted) {
            return response()->json('true');
        } else {
            return response()->json('false');
        }
    }

    public function updateForm(Request $request)
    {
        $data['lead'] = CrmLead::where('lead_id', $request->crmLeadId)->get()->first();
        $data['title'] = 'Update Lead';
        $data['navbar_headings'] = 'Update  Lead';
        $data['contacts'] = DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type', 'ContactOnly')->get();
        $data['employees'] = DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type', 'Employee')->get();
        $data['categories'] = DB::table('crm_categories')->where('company_id', session()->get('company_id'))->get();
        return view('crm/crmLeadUpdate', $data);
    }
    public function update(Request $request)
    {
        unset($request['_token']);
        $request->validate([
            'subject' => 'required',
            'contact_id' => 'required',
            'employee_id' => 'required',
            'category_id' => 'required',
            'priority' => 'required',
            'creation_date' => 'required',
        ]);
        $request['company_id'] = session()->get('company_id');
        $request['created_by'] = session()->get('user_id');

        $crmLeadUpdated = CrmLead::where('lead_id', $request->lead_id)->update($request->all());
        if ($crmLeadUpdated) {
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

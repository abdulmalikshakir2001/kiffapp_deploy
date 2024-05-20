<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\Users\User;
use App\Models\CRM\CrmOppertunity;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
// use PDF;
use Barryvdh\DomPDF\Facade\Pdf;

class CrmOppertunityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['title'] = 'All Oppertunity';
        $data['navbar_headings'] = 'All Oppertunity';
        return view('crm/crmOppertunityView', $data);
    }
    public function getData(Request $request)

    {
        // $crmOppertunity =  DB::table('crm_oppertunities')->where('company_id', session()->get('company_id'))->get();
        $crmOppertunity= DB::table('crm_oppertunities')->select('crm_oppertunities.*','users.username','salesPerson.username as salesPerson','crm_categories.category_name')->join('users',function($join){
            $join->on('crm_oppertunities.contact_id','=','users.user_id');
        })->join('crm_categories','crm_oppertunities.category_id','=','crm_categories.category_id')
        ->join('users as salesPerson','crm_oppertunities.employee_id','=','salesPerson.user_id')
         ->where('crm_oppertunities.company_id',session()->get('company_id'))->get();
        $allData = DataTables::of($crmOppertunity)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn =
                    '<button  type="button"  class="text-secondary  crmOppertunityDeleteBtn bg-white "  style="border:none;" data-crm_oppertunity_id="' . $row->oppertunity_id . '"data-bs-toggle="modal" data-bs-target="#deleteConfirmModal" ><i class="fas fa-trash-alt fs-6 text-danger"></i>
            </button>
            <button class="text-secondary crmOppertunityEditBtn bg-white"  style="border: none;" data-crm_oppertunity_id="' . $row->oppertunity_id . '" >
                    <a href="#"> <i class="fas fa-edit fs-6 text-success">
                    </i>
                    </a>

                </button>
                <button class="badge-info text-secondary  sidenav_zero_index border_5_font_12 crmOppertunityDetailsButton"  style="border: none;" data-crm_oppertunity_id="' . $row->oppertunity_id . '" >
                        <a href="' . route('oppertunityDetails', $row->oppertunity_id) . '" class="text-white"> <i class="fas fa-eye ">
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
        $data['title'] = 'Create Oppertunity';
        $data['navbar_headings'] = 'Create  Oppertunity';
        $data['contacts'] = DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type', 'ContactOnly')->get();
        $data['employees'] = DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type', 'Employee')->get();
        $data['categories'] = DB::table('crm_categories')->where('company_id', session()->get('company_id'))->get();
        $data['leads'] = DB::table('crm_leads')->join('crm_categories','crm_leads.category_id','=','crm_categories.category_id')->where('crm_leads.company_id', session()->get('company_id'))->get();
        return view('crm/crmOppertunityCreate', $data);
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
            'lead_id'=>'required'
            
        ]);
        $request['company_id'] = session()->get('company_id');

        $crmOppertunityAdded = CrmOppertunity::insert($request->all());
        if ($crmOppertunityAdded) {
            return response()->json('true');
        } else {
            return response()->json('false');
        }
    }

    public function delete(Request $request)
    {
        $crmOppertunityId = $request->crmOppertunityId;

        $crmOppertunityDeleted = CrmOppertunity::where('oppertunity_id', $crmOppertunityId)->delete();
        if ($crmOppertunityDeleted) {
            return response()->json('true');
        } else {
            return response()->json('false');
        }
    }
    public function updateForm(Request $request)
    {
        $data['title'] = 'Update Oppertunity';
        $data['navbar_headings'] = 'Update  Oppertunity';

        $data['crmOppertunity'] = CrmOppertunity::where('oppertunity_id', $request->crmOppertunityId)->get()->first();
        $data['contacts'] = DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type', 'ContactOnly')->get();
        $data['employees'] = DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type', 'Employee')->get();
        $data['categories'] = DB::table('crm_categories')->where('company_id', session()->get('company_id'))->get();
        $data['leads'] = DB::table('crm_leads')->join('crm_categories','crm_leads.category_id','=','crm_categories.category_id')->where('crm_leads.company_id', session()->get('company_id'))->get();
        return view('crm/crmOppertunityUpdate', $data);
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
            'lead_id'=>'required'
        ]);
        $request['company_id'] = session()->get('company_id');

        $crmOppertunityUpdated = CrmOppertunity::where('oppertunity_id', $request->oppertunity_id)->update($request->all());
        if ($crmOppertunityUpdated) {
            return response()->json('true');
        } else {
            return response()->json('false');
        }
    }

    public function Details(Request $request)
    {
        $data['title'] = 'Oppertunity Details';
        $data['navbar_headings'] = 'Oppertunity Details';
        $data['crmOppertunity'] = CrmOppertunity::where('oppertunity_id', $request->crmOppertunityId)->get()->first();
        $data['contacts'] = DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type', 'ContactOnly')->get();
        $data['employees'] = DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type', 'Employee')->get();
        $data['categories'] = DB::table('crm_categories')->where('company_id', session()->get('company_id'))->get();
        $data['leads'] = DB::table('crm_leads')->join('crm_categories','crm_leads.category_id','=','crm_categories.category_id')->where('crm_leads.company_id', session()->get('company_id'))->get();
        return view('crm/crmOppertunityDetails', $data);
    }




    public function crmOppertunityUrl(Request $request)
    {
        $url = url('oppertunityDetailsPrint' . '/' . $request->crmOppertunityId);
        return response()->json($url);
    }


    public function crmOppertunityDetailsPrint(Request $request)

    {
        $data['title'] = 'Oppertunity Details';
        $data['navbar_headings'] = 'Oppertunity Details';
        $data['crmOppertunity'] = CrmOppertunity::where('oppertunity_id', $request->crmOppertunityId)->get()->first();
        $data['contacts'] = DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type', 'ContactOnly')->get();
        $data['employees'] = DB::table('users')->where('company_id', session()->get('company_id'))->where('user_type', 'Employee')->get();
        $data['categories'] = DB::table('crm_categories')->where('company_id', session()->get('company_id'))->get();
        $data['leads'] = DB::table('crm_leads')->join('crm_categories','crm_leads.category_id','=','crm_categories.category_id')->where('crm_leads.company_id', session()->get('company_id'))->get();
        // for hrm view payroll start
        $pdf = Pdf::loadView('crm/crmOppertunityDetailsPrint', $data);
        return $pdf->stream();
        // return response($pdf->output(), 200, [
        //     'Content-Type' => 'application/pdf',
        //     'Content-Disposition' => 'inline; filename="file.pdf"',
        // ]);
    }
}

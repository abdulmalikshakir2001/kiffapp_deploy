<?php

namespace App\Http\Controllers\account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\account\AccJournalEntry;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use DNS1D;
use DNS2D;

class AccJournalEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
{
    $this->middleware('checkDefaultLanguage')->only(['create']);
}



    public function index()
    {
        //
        $data['title'] = 'Journal Entry';
        $data['navbar_headings'] = 'Journal Entry';
        $data['warehouses'] = DB::table('pur_warehouses')->where('company_id','=',session('company_id'))->get();
        return view('account/accJournalEntryView', $data);
    }
    public function getData(Request $request)
    {
        
        $accJournalEntryTable =  AccJournalEntry::where('company_id', session()->get('company_id'))->get();


        
        
        $allData = DataTables::of($accJournalEntryTable)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn =
                    '<button type="button" class="text-secondary accJournalEntryDeleteBtn bg-white"  style="border:none;" data-acc_journal_entry_id="' . $row->acc_journal_entry_id . '"  data-bs-toggle="" data-bs-target=""><i class="fas fa-trash-alt fs-6 text-danger"></i>
            </button><button class="text-secondary sidenav_zero_index accJournalEntryEditBtn  bg-white" data-bs-toggle="modal" data-bs-target="#accJournalEntryUpdateModal" style="border: none;" data-acc_journal_entry_id="' . $row->acc_journal_entry_id . '">
                    <a href="#"> <i class="fas fa-edit fs-6 text-success ">
                    </i>
                    </a>
                </button>';
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
    public function create(Request $request)
    {
        //
        $data['title'] = 'Journal Entry';
        $data['navbar_headings'] = 'Journal Entry';
        $data['fiscalPeriods'] = DB::table('acc_fiscal_periods')->where('company_id',session('company_id'))->where('status','=','on')->get();
        $data['costCenters'] = DB::table('acc_cost_centers')->where('company_id',session('company_id'))->get();
        $data['controlCodes'] = DB::table('acc_control_codes')->where('company_id',session('company_id'))->get();
        $data['currencies'] = DB::table('acc_currencies')->where('company_id',session('company_id'))->get();
        $data['accounts'] = DB::table('acc_accounts')->where('company_id',session('company_id'))->get();
        
       $defaultCurrencyObj  = DB::table('acc_currencies')->where('company_id',session('company_id'))->where('is_default','=','1')->get();
    
        $data['defaultCurrency'] = $defaultCurrencyObj->first() ;

    

       

        return view('account/acc_journal_entry_create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return response()->json(1);
        unset($request['_token']);
        $request->validate([
            'name' => 'required',
            
            
        ]);
        $request['company_id'] = session()->get('company_id');
        

        $accJournalEntryAdded = AccJournalEntry::create($request->all());
        if ($accJournalEntryAdded) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    // update

    public function accJournalEntryFetch(Request $request)
    {
        $accJournalEntryId = $request->accJournalEntryId;
        $accJournalEntrySingle =  DB::table('acc_journal_entrys')
            ->select('*')
            ->where('acc_journal_entry_id', '=', $accJournalEntryId)
            ->get();
        $asset = $accJournalEntrySingle->first();
        return response()->json($asset);
    }

    public function update(Request $request)
    {
        unset($request['_token']);
        $request->validate([
            'name' => 'required',
            
        ]);
        $request['company_id'] = session()->get('company_id');
        
        


        $accJournalEntryUpdated = AccJournalEntry::where('acc_journal_entry_id', $request->acc_journal_entry_id)->update($request->all());
        if ($accJournalEntryUpdated) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
    // delete
    public function delete(Request $request)
    {
        $accJournalEntryId = $request->accJournalEntryId;
        $accJournalEntryDeleted = AccJournalEntry::where('acc_journal_entry_id', $accJournalEntryId)->delete();

        if ($accJournalEntryDeleted) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
}

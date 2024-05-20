<?php

namespace App\Http\Controllers\account;

use App\Http\Controllers\Controller;
use App\Models\account\AccAccountBalance;
use Illuminate\Http\Request;
use App\Models\account\AccAccount;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;


class AccAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title'] = 'Manage Account';
        $data['navbar_headings'] = 'Manage Account';
        $data['accFamilies'] = DB::table('acc_families')->get();
        $data['accFamiliesCodeArray'] = $data['accFamilies']->pluck('family_code');

        $data['accounts'] = DB::table('acc_accounts')->get();
        $data['arr'] = [1,2,3];
        return view('account/accAccountView', $data);
    }
    public function getData(Request $request)
    {
        
        $accAccountTable =  AccAccount::where('company_id', session()->get('company_id'))->get();


        
        
        $allData = DataTables::of($accAccountTable)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn =
                    '<button type="button" class="text-secondary accAccountDeleteBtn bg-white"  style="border:none;" data-acc_account_id="' . $row->acc_account_id . '"  data-bs-toggle="" data-bs-target=""><i class="fas fa-trash-alt fs-6 text-danger"></i>
            </button><button class="text-secondary sidenav_zero_index accAccountEditBtn  bg-white" data-bs-toggle="modal" data-bs-target="#accAccountUpdateModal" style="border: none;" data-acc_account_id="' . $row->acc_account_id . '">
                    <a href="#"> <i class="fas fa-edit fs-6 text-success ">
                    </i>
                    </a>
                </button>';
                return $btn;
            })->addColumn('type',function($row){
                return $row->accountType->family_name;


            })
            ->rawColumns(['action','type'])
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
        //
        $data['title'] = 'Manage Account';
        $data['navbar_headings'] = 'Manage Account';
        return view('account/accAccountCreate', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return response()->json($request->all());
        unset($request['_token']);
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'type' => 'required',
            // 'parent' => 'required',
        ]);
        $request['company_id'] = session()->get('company_id');
        $accAccountAdded = AccAccount::create($request->all());
        if ($accAccountAdded) {
            AccAccountBalance:: create([
                'company_id' =>session('company_id'),
                'account_id' =>$accAccountAdded->acc_account_id,
                'balance' =>$request->opening_balance,

            ]);

            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    // update

    public function accAccountFetch(Request $request)
    {
        $accAccountId = $request->accAccountId;
        $accAccountSingle =  DB::table('acc_accounts')
            ->select('*')
            ->where('acc_account_id', '=', $accAccountId)
            ->get();
        $asset = $accAccountSingle->first();
        return response()->json($asset);
    }

    public function update(Request $request)
    {
        unset($request['_token']);
        $request->validate([
            'name_update' => 'required',
            'code_update' => 'required',
            'type_update' => 'required',
            
        ]);
        $request['company_id'] = session()->get('company_id');
        $request['name'] = $request->name_update;
        $request['code'] = $request->code_update;
        $request['type'] = $request->type_update;
        $request['remarks'] = $request->remarks_update;

        unset($request['name_update']);
        unset($request['code_update']);
        unset($request['type_update']);
        unset($request['remarks_update']);
        unset($request['parent_update']);

        
        


        $accAccountUpdated = AccAccount::where('acc_account_id', $request->acc_account_id)->update($request->all());
        if ($accAccountUpdated) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
    // delete
    public function delete(Request $request)
    {
        $accAccountId = $request->accAccountId;
        $accAccountDeleted = AccAccount::where('acc_account_id', $accAccountId)->delete();

        if ($accAccountDeleted) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
    public function checkHeadAccount(Request $request){
        // return response()->json($request->familyCode);
         $accounts =  DB::table('acc_accounts')->where('code','LIKE',$request->familyCode."%")->get();
         

         
        // return response()->json($accounts);
        $accountCount =  $accounts->count();
        if($accountCount == 0){
            return response()->json($request->familyCode."-1");

        }
        else{
            // return response()->json($accounts->last()) ;

             $lastFamilyCode =  explode("-",$accounts->last()->code);
             $headAccount =  intval(end($lastFamilyCode));
             $headAccountInc =  $headAccount+1;
             return response()->json($request->familyCode."-".$headAccountInc);
        }
    }
    public function checkChildAccount(Request $request){
        // return response()->json($request->accountCode);
         $accounts =  DB::table('acc_accounts')->where('code','LIKE',$request->accountCode."-%")->get();
        // return response()->json($accounts);
        $accountCount =  $accounts->count();
        // return response()->json($accountCount);

        if($accountCount == 0){
            return response()->json($request->accountCode."-1");

        }
        else{
            // return response()->json($accounts->last()) ;

             $lastChildCode =  explode("-",$accounts->last()->code);
             $childAccount =  intval(end($lastChildCode));
             $childAccountInc =  $childAccount+1;
             return response()->json($request->accountCode."-".$childAccountInc);
        }

         
    }
}

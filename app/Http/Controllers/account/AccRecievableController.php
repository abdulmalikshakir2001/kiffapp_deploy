<?php

namespace App\Http\Controllers\account;

use App\Http\Controllers\Controller;
use App\Models\account\AccAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccRecievableController extends Controller
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
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['title'] = 'Account Payable';
        $data['navbar_headings'] = 'Account Payable';
        $data['fiscalPeriods'] = DB::table('acc_fiscal_periods')->where('company_id',session('company_id'))->where('status','=','on')->get();
        $data['costCenters'] = DB::table('acc_cost_centers')->where('company_id',session('company_id'))->get();
        $data['controlCodes'] = DB::table('acc_control_codes')->where('company_id',session('company_id'))->get();
        $data['currencies'] = DB::table('acc_currencies')->where('company_id',session('company_id'))->get();
        $data['accounts'] = DB::table('acc_accounts')->where('company_id',session('company_id'))->get();
        
        $defaultCurrencyObj  = DB::table('acc_currencies')->where('company_id',session('company_id'))->where('is_default','=','1')->get();
    
        $data['defaultCurrency'] = $defaultCurrencyObj->first() ;

        return view('account/acc_recievable_create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function accFetch(Request $request)
    {
        // return response()->json($request->accPayableName);
        $payableAccountInfoArray = collect( [] );


        $payableAccountObj =  AccAccount::where('name','=',$request->accPayableName)->get();
        $payableAccount = $payableAccountObj->first();
        if($payableAccountObj->count() == 0 ){
        return response()->json($payableAccountInfoArray);



        }
        else{
            $payableAccountInfoArray->push([$payableAccount->name,$payableAccount->code,$payableAccount->balance->balance,$payableAccount->acc_account_id]) ;
            return response()->json($payableAccountInfoArray);

        }

        



        


        




    
    }
}

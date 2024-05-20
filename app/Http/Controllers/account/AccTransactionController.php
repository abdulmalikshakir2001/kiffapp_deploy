<?php

namespace App\Http\Controllers\account;

use App\Http\Controllers\Controller;
use App\Models\account\AccAccountBalance;
use App\Models\account\AccJournalEntries;
use Illuminate\Http\Request;
use App\Models\account\AccTransaction;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use DNS1D;
use DNS2D;

class AccTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title'] = 'Manage Transaction Category';
        $data['navbar_headings'] = 'Manage Transaction Category';
        $data['warehouses'] = DB::table('pur_warehouses')->where('company_id', '=', session('company_id'))->get();
        return view('account/accTransactionCategoryView', $data);
    }
    public function getData(Request $request)
    {

        $accTransactionCategoryTable =  AccTransactionCategory::where('company_id', session()->get('company_id'))->get();




        $allData = DataTables::of($accTransactionCategoryTable)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn =
                    '<button type="button" class="text-secondary accTransactionCategoryDeleteBtn bg-white"  style="border:none;" data-acc_transaction_category_id="' . $row->acc_transaction_category_id . '"  data-bs-toggle="" data-bs-target=""><i class="fas fa-trash-alt fs-6 text-danger"></i>
            </button><button class="text-secondary sidenav_zero_index accTransactionCategoryEditBtn  bg-white" data-bs-toggle="modal" data-bs-target="#accTransactionCategoryUpdateModal" style="border: none;" data-acc_transaction_category_id="' . $row->acc_transaction_category_id . '">
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
    public function create()
    {
        //
        $data['title'] = 'Manage Transaction Category';
        $data['navbar_headings'] = 'Manage Transaction Category';
        return view('account/accTransactionCategoryCreate', $data);
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
        // return response()->json($request->foreignCurrencyRateArrayInput);
        $request->validate([
            'date' => 'required',
            'acc_fiscal_period_id' => 'required',
            'acc_cost_center_id' => 'required',
            'acc_control_code_id' => 'required',
            'acc_currency_id' => 'required',
        ]);
        $request['company_id'] = session()->get('company_id');
        if ($request->total_debit_hidden == $request->total_credit_hidden) {
            $accTransactionAdded = AccTransaction::create([
                'company_id' => session('company_id'),
                'date' => $request->date,
                'description' => $request->description,
                'fiscal_period_id' =>  $request->acc_fiscal_period_id,
                'cost_center_id' =>  $request->acc_cost_center_id,
                'control_code_id' =>  $request->acc_control_code_id,
                'currency_id' =>  $request->acc_currency_id,
                'exchange_rate' => $request->currency_exchange_rate_hidden
            ]);
            if ($accTransactionAdded) {
                $accountIdsArray = explode(',', $request->account_id_array);

                // return response()->json($request->foreignCurrencyRateArrayInput);

                $debitArray = explode(',', $request->exchange_rate_debit_array);
                $creditArray = explode(',', $request->exchange_rate_credit_array);
                $accountTypeArray = explode(',', $request->account_type_array_hidden);
                $foreignCurrencyRateArray = explode(',', $request->foreignCurrencyRateArrayInput);
                $drCrInc = 0;
                foreach ($accountIdsArray as $accountId) {

                    AccJournalEntries::create([
                        'company_id' => session('company_id'),
                        'transaction_id' => $accTransactionAdded->acc_transaction_id,
                        'account_id' => $accountId,
                        'debit' => $debitArray[$drCrInc],
                        'credit' => $creditArray[$drCrInc],
                        'foreign_currency_amount' => $foreignCurrencyRateArray[$drCrInc]
                        // 'debit' => 0.00,
                        // 'credit' => 0.00,
                    ]);
                    
                    $drCrInc++;
                }

                return response()->json(true);
            } else {
                return response()->json(false);
            }
        }
    }

    // update

    public function accTransactionCategoryFetch(Request $request)
    {
        $accTransactionCategoryId = $request->accTransactionCategoryId;
        $accTransactionCategorySingle =  DB::table('acc_transaction_categories')
            ->select('*')
            ->where('acc_transaction_category_id', '=', $accTransactionCategoryId)
            ->get();
        $asset = $accTransactionCategorySingle->first();
        return response()->json($asset);
    }

    public function update(Request $request)
    {
        unset($request['_token']);
        $request->validate([
            'name' => 'required',

        ]);
        $request['company_id'] = session()->get('company_id');




        $accTransactionCategoryUpdated = AccTransactionCategory::where('acc_transaction_category_id', $request->acc_transaction_category_id)->update($request->all());
        if ($accTransactionCategoryUpdated) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
    // delete
    public function postView(Request $request)
    {
        $data['title'] = 'Post Transaction';
        $data['navbar_headings'] = 'Post Transaction';
        $data['fiscalPeriods'] = DB::table('acc_fiscal_periods')->where('company_id',session('company_id'))->where('status','=','on')->get();
        $data['costCenters'] = DB::table('acc_cost_centers')->where('company_id',session('company_id'))->get();
        $data['controlCodes'] = DB::table('acc_control_codes')->where('company_id',session('company_id'))->get();
        $data['currencies'] = DB::table('acc_currencies')->where('company_id',session('company_id'))->get();
        $data['accounts'] = DB::table('acc_accounts')->where('company_id',session('company_id'))->get();
        
       $defaultCurrencyObj  = DB::table('acc_currencies')->where('company_id',session('company_id'))->where('is_default','=','1')->get();
    
        $data['defaultCurrency'] = $defaultCurrencyObj->first() ;


        // ----------------
        $data['acc_transaction_id'] = $request->get('acc_transaction_id');
        $data['transaction'] =  AccTransaction::where('acc_transaction_id','=',$request->get('acc_transaction_id'))->get()->first();
        $data['journalEntries'] =  $data['transaction']->journalEntries;
        $data['totalDebit'] =  $data['transaction']->journalEntries->sum('debit') ; 
        // ------------
        return view('account/post_transaction_view', $data);

        

        // return $request->get('acc_transaction_id');
        // return $transaction->journalEntries;
    
    }


    public function postTransactionStore (Request $request){
        unset($request['_token']);
        $request['company_id'] = session()->get('company_id');
        if ($request->total_debit_hidden == $request->total_credit_hidden) {
            // $accTransactionAdded = AccTransaction::create([
            //     'company_id' => session('company_id'),
            //     'date' => $request->date,
            //     'description' => $request->description,
            //     'fiscal_period_id' =>  $request->acc_fiscal_period_id,
            //     'cost_center_id' =>  $request->acc_cost_center_id,
            //     'control_code_id' =>  $request->acc_control_code_id,
            //     'currency_id' =>  $request->acc_currency_id,
            //     'exchange_rate' => $request->currency_exchange_rate_hidden
            // ]);
            $accTransactionUpdated =  AccTransaction::where('acc_transaction_id','=',$request->acc_transaction_id)->update([
                'status' =>'posted'
            ]);
            if ($accTransactionUpdated) {
                $accountIdsArray = explode(',', $request->account_id_array);
                $debitArray = explode(',', $request->exchange_rate_debit_array);
                $creditArray = explode(',', $request->exchange_rate_credit_array);
                $accountTypeArray = explode(',', $request->account_type_array_hidden);
                $foreignCurrencyRateArray = explode(',', $request->foreignCurrencyRateArrayInput);
                $drCrInc = 0;
                foreach ($accountIdsArray as $accountId) {

                    // update balance start ---------------------------------
                    $accountBalance =  AccAccountBalance::where('account_id', '=', $accountId)->get();
                    if ($accountBalance->count() == 0) {
                    } else {
                        // switch case start 

                        switch ($accountTypeArray[$drCrInc]) {
                            case 1:
                                updateAccountBalance($accountId,'+',$debitArray[$drCrInc],'-',$creditArray[$drCrInc]);
                                
                                break;
                            case 2:
                                updateAccountBalance($accountId,'+',$debitArray[$drCrInc],'-',$creditArray[$drCrInc]);
                                break;
                            case 3:
                                updateAccountBalance($accountId,'+',$debitArray[$drCrInc],'-',$creditArray[$drCrInc]);
                                break;
                            case 4:
                                updateAccountBalance($accountId,'-',$debitArray[$drCrInc],'+',$creditArray[$drCrInc]);
                                break;
                            case 5:
                                updateAccountBalance($accountId,'-',$debitArray[$drCrInc],'+',$creditArray[$drCrInc]);
                                break;
                            case 6:
                                updateAccountBalance($accountId,'-',$debitArray[$drCrInc],'+',$creditArray[$drCrInc]);
                                break;
                            default:
                                echo "Your favorite color is neither red, blue, nor green!";
                        }

                        // switch case end 
                    }
                    //  --------------------------------- update balance end
                    $drCrInc++;
                }

                return response()->json(true);
            } else {
                return response()->json(false);
            }
        }


        

    }



}

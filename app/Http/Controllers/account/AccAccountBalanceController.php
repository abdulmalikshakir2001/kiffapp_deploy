<?php

namespace App\Http\Controllers\account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\account\AccAccountBalance;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use DNS1D;
use DNS2D;

class AccAccountBalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title'] = 'Manage Balance';
        $data['navbar_headings'] = 'Manage Balance';
        $data['accounts'] = DB::table('acc_accounts')->where('company_id','=',session('company_id'))->get();
        return view('account/accAccountBalanceView', $data);
    }
    public function getData(Request $request)
    {
        $accAccountBalanceTable =  AccAccountBalance::where('company_id', session()->get('company_id'))->get();
        $allData = DataTables::of($accAccountBalanceTable)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn =
                    '<button type="button" class="text-secondary accAccountBalanceDeleteBtn bg-white"  style="border:none;" data-acc_account_balance_id="' . $row->acc_account_balance_id . '"  data-bs-toggle="" data-bs-target=""><i class="fas fa-trash-alt fs-6 text-danger"></i>
            </button><button class="text-secondary sidenav_zero_index accAccountBalanceEditBtn  bg-white" data-bs-toggle="modal" data-bs-target="#accAccountBalanceUpdateModal" style="border: none;" data-acc_account_balance_id="' . $row->acc_account_balance_id . '">
                    <a href="#"> <i class="fas fa-edit fs-6 text-success ">
                    </i>
                    </a>
                </button>';
                return $btn;
            })->addColumn('account_name',function($row){

                return  $row->account->name;
            })
            ->rawColumns(['action','account_name'])
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
        $data['title'] = 'Manage Balance';
        $data['navbar_headings'] = 'Manage Balance';
        return view('account/accAccountBalanceCreate', $data);
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
            'account_id' => 'required',
            'balance' => 'required',
            
            
        ]);
        $request['company_id'] = session()->get('company_id');

        $accountCheck =  AccAccountBalance::where('account_id','=',$request->account_id)->get();
        




        if($accountCheck->count() == 0){
            $accAccountBalanceAdded = AccAccountBalance::create($request->all());
        if ($accAccountBalanceAdded) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }

        }
        else{
            return response()->json('account exist');

        }
        

        
    }

    // update

    public function accAccountBalanceFetch(Request $request)
    {
        $accAccountBalanceId = $request->accAccountBalanceId;
        $accAccountBalanceSingle =  DB::table('acc_account_balances')
            ->select('*')
            ->where('acc_account_balance_id', '=', $accAccountBalanceId)
            ->get();
        $asset = $accAccountBalanceSingle->first();
        return response()->json($asset);
    }

    public function update(Request $request)
    {
        unset($request['_token']);
        $request->validate([
            'account_id_update' => 'required',
            'balance_update' => 'required',
            
        ]);
        $request['company_id'] = session()->get('company_id');
        $request['account_id'] = $request->account_id_update;
        $request['balance'] = $request->balance_update;

        unset($request['account_id_update']);
        unset($request['balance_update']);
        
        


        $accAccountBalanceUpdated = AccAccountBalance::where('acc_account_balance_id', $request->acc_account_balance_id)->update($request->all());
        if ($accAccountBalanceUpdated) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
    // delete
    public function delete(Request $request)
    {
        // return response()->json($request->all());
        $accAccountBalanceId = $request->accAccountBalanceId;
        $accAccountBalanceDeleted = AccAccountBalance::where('acc_account_balance_id', $accAccountBalanceId)->delete();

        if ($accAccountBalanceDeleted) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
}

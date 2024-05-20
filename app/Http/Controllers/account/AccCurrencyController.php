<?php

namespace App\Http\Controllers\account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\account\AccCurrency;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use DNS1D;
use DNS2D;
use Carbon\Carbon;

class AccCurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title'] = 'Manage Currency';
        $data['navbar_headings'] = 'Manage Currency';
        $data['warehouses'] = DB::table('pur_warehouses')->where('company_id','=',session('company_id'))->get();
        return view('account/accCurrencyView', $data);
    }
    public function getData(Request $request)
    {
        
        $accCurrencyTable =  AccCurrency::where('company_id', session()->get('company_id'))->orderBy('is_default','desc')->get();


        
        
        $allData = DataTables::of($accCurrencyTable)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn =
                    '<button type="button" class="text-secondary accCurrencyDeleteBtn bg-white"  style="border:none;" data-acc_currency_id="' . $row->acc_currency_id . '"  data-bs-toggle="" data-bs-target=""><i class="fas fa-trash-alt fs-6 text-danger"></i>
            </button><button class="text-secondary sidenav_zero_index accCurrencyEditBtn  bg-white" data-bs-toggle="modal" data-bs-target="#accCurrencyUpdateModal" style="border: none;" data-acc_currency_id="' . $row->acc_currency_id . '">
                    <a href="#"> <i class="fas fa-edit fs-6 text-success ">
                    </i>
                    </a>
                </button>';
                return $btn;
            })->addColumn('is_default',function($row){
                if($row->is_default == 1){
                    return '<span class="badge bg-gradient-info">Yes</span>';

                }



            })
            ->rawColumns(['action','is_default'])
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
        $data['title'] = 'Manage Currency';
        $data['navbar_headings'] = 'Manage Currency';
        return view('account/accCurrencyCreate', $data);
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
        // return response()->json($request->all());
        $request->validate([
            'name' => 'required',
            
            
        ]);
        $request['company_id'] = session()->get('company_id');
        if($request->is_default == "on"){
            $request['exchange_rate'] = '1';



            DB::table('acc_currencies')->update([
                'is_default'=>0,
                'updated_at'=>Carbon::now()->toDateTimeString()

            ]);
        }
        



        $request['is_default'] = $request->is_default =="on" ? 1 : 0 ;

        

        

        $accCurrencyAdded = AccCurrency::create($request->all());
        if ($accCurrencyAdded) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    // update

    public function accCurrencyFetch(Request $request)
    {
        $accCurrencyId = $request->accCurrencyId;
        $accCurrencySingle =  DB::table('acc_currencies')
            ->select('*')
            ->where('acc_currency_id', '=', $accCurrencyId)
            ->get();
        $asset = $accCurrencySingle->first();
        return response()->json($asset);
    }

    public function update(Request $request)
    {
        unset($request['_token']);
        $request->validate([
            'name' => 'required',
            
        ]);
        $request['company_id'] = session()->get('company_id');
        if($request->is_default == "on"){
            $request['exchange_rate'] = '1';
            DB::table('acc_currencies')->update([
                'is_default'=>0,
                'updated_at'=>Carbon::now()->toDateTimeString()

            ]);
        }

        $request['is_default'] = $request->is_default =="on" ? 1 : 0 ;

        
        


        $accCurrencyUpdated = AccCurrency::where('acc_currency_id', $request->acc_currency_id)->update($request->all());
        if ($accCurrencyUpdated) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
    // delete
    public function delete(Request $request)
    {
        $accCurrencyId = $request->accCurrencyId;
        $accCurrencyDeleted = AccCurrency::where('acc_currency_id', $accCurrencyId)->delete();

        if ($accCurrencyDeleted) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
    public function fetchTransactionCurrency(Request $request)
    {
        $transactionCurrency = $request->transaction_currency;
        $transactionCurrencyFetched = AccCurrency::where('company_id','=', session('company_id'))->where('name','=',$transactionCurrency)->get()->first();
        return response()->json($transactionCurrencyFetched);
    }
}

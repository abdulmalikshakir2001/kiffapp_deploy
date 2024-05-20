<?php

namespace App\Http\Controllers\account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\account\AccTransactionCategory;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use DNS1D;
use DNS2D;

class AccTransactionCategoryController extends Controller
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
        $data['warehouses'] = DB::table('pur_warehouses')->where('company_id','=',session('company_id'))->get();
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
        unset($request['_token']);
        $request->validate([
            'name' => 'required',
            
            
        ]);
        $request['company_id'] = session()->get('company_id');
        

        $accTransactionCategoryAdded = AccTransactionCategory::create($request->all());
        if ($accTransactionCategoryAdded) {
            return response()->json(true);
        } else {
            return response()->json(false);
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
    public function delete(Request $request)
    {
        $accTransactionCategoryId = $request->accTransactionCategoryId;
        $accTransactionCategoryDeleted = AccTransactionCategory::where('acc_transaction_category_id', $accTransactionCategoryId)->delete();

        if ($accTransactionCategoryDeleted) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
}

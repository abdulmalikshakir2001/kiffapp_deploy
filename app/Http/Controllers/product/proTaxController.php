<?php

namespace App\Http\Controllers\product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product\ProTax;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class ProTaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title']='Manage Product Tax';
        $data['navbar_headings']='Manage Product Tax';
        return view('product/proTaxView',$data);
    }
    public function getData(Request $request)
    {
        // start 
$proTaxTable =  DB::table('pro_taxes')->where('company_id',session()->get('company_id'))->get();


// end
        // $proTaxs =  DB::table('proTaxs')->where('company_id',session()->get('company_id'))->get();
        $allData = DataTables::of($proTaxTable)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
            $btn =
            '<button type="button" class="text-secondary proTaxDeleteBtn bg-white"  style="border:none;" data-pro_tax_id="' . $row->tax_id . '"  data-bs-toggle="modal" data-bs-target="#proTaxDeleteConfirm"><i class="fas fa-trash-alt fs-6 text-danger"></i>
            </button><button class="text-secondary sidenav_zero_index proTaxEditBtn  bg-white" data-bs-toggle="modal" data-bs-target="#proTaxUpdateModal" style="border: none;" data-pro_tax_id="' . $row->tax_id . '">
                    <a href="#"> <i class="fas fa-edit fs-6 text-success ">
                    </i>
                    </a>
                </button>';
            return $btn;
        })->addColumn('active',function($row){
            if($row->active==1){
                return '<span class="badge bg-success">Active</span>';

            }
            else{
                return '<span class="badge bg-danger">Block</span>';


            }

        })
        ->rawColumns(['action','active'])
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
        $data['title']='Manage Product Tax';
        $data['navbar_headings']='Manage Product Tax';
        return view('product/proTaxCreate',$data);
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
            'tax_name'=>'required',
            'percentage'=>'required'
        ]);
        $request['company_id']=session()->get('company_id');
        $request['active']= $request->active=="on"?'1':'0';
        
        $proTaxAdded= ProTax::create($request->all());
        if($proTaxAdded){
            return response()->json(true);
        }
        else{
            return response()->json(false);
        }

        
    }

// update

    public function proTaxFetch(Request $request)
    {
        $proTaxId = $request->proTaxId;
        $proTaxSingle =  DB::table('pro_taxes')
            ->select('*')
            ->where('tax_id', '=', $proTaxId)
            ->get();
        $leave = $proTaxSingle->first();
        return response()->json($leave);
    }

    public function update(Request $request){
        unset($request['_token']);
        $request->validate([
            'tax_name'=>'required',
            'percentage'=>'required'
        ]);
        $request['company_id']=session()->get('company_id');
        $request['active']= $request->active=="on"?'1':'0';
    

        $proTaxUpdated= ProTax::where('tax_id',$request->tax_id)->update ($request->all());
        if($proTaxUpdated){
            return response()->json(true);
        }
        else{
            return response()->json(false);
        }



    }
    // delete
    public function delete(Request $request)
    {
        $proTaxId = $request->proTaxId;
        $proTaxDeleted = ProTax::where('tax_id', $proTaxId)->delete();

        if ($proTaxDeleted) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

}

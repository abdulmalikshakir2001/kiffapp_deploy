<?php

namespace App\Http\Controllers\product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product\ProBrand;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class ProBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title']='Manage Product Brand';
        $data['navbar_headings']='Manage Product Brand';
        return view('product/proBrandView',$data);
    }
    public function getData(Request $request)
    {
        // start 
$proBrandTable =  DB::table('pro_brands')->where('company_id',session()->get('company_id'))->get();


// end
        // $proBrands =  DB::table('proBrands')->where('company_id',session()->get('company_id'))->get();
        $allData = DataTables::of($proBrandTable)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
            $btn =
            '<button type="button" class="text-secondary proBrandDeleteBtn bg-white"  style="border:none;" data-pro_brand_id="' . $row->brand_id . '"  data-bs-toggle="modal" data-bs-target="#proBrandDeleteConfirm"><i class="fas fa-trash-alt fs-6 text-danger"></i>
            </button><button class="text-secondary sidenav_zero_index proBrandEditBtn  bg-white" data-bs-toggle="modal" data-bs-target="#proBrandUpdateModal" style="border: none;" data-pro_brand_id="' . $row->brand_id . '">
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
        $data['title']='Manage Product Brand';
        $data['navbar_headings']='Manage Product Brand';
        return view('product/proBrandCreate',$data);
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
            'brand_name'=>'required',
        ]);
        $request['company_id']=session()->get('company_id');
        $request['active']= $request->active=="on"?'1':'0';
        
        $proBrandAdded= ProBrand::create($request->all());
        if($proBrandAdded){
            return response()->json(true);
        }
        else{
            return response()->json(false);
        }

        
    }

// update

    public function proBrandFetch(Request $request)
    {
        $proBrandId = $request->proBrandId;
        $proBrandSingle =  DB::table('pro_brands')
            ->select('*')
            ->where('brand_id', '=', $proBrandId)
            ->get();
        $leave = $proBrandSingle->first();
        return response()->json($leave);
    }

    public function update(Request $request){
        unset($request['_token']);
        $request->validate([
            'brand_name'=>'required',
        ]);
        $request['company_id']=session()->get('company_id');
        $request['active']= $request->active=="on"?'1':'0';
    

        $proBrandUpdated= ProBrand::where('brand_id',$request->brand_id)->update ($request->all());
        if($proBrandUpdated){
            return response()->json(true);
        }
        else{
            return response()->json(false);
        }



    }
    // delete
    public function delete(Request $request)
    {
        $proBrandId = $request->proBrandId;
        $proBrandDeleted = ProBrand::where('brand_id', $proBrandId)->delete();

        if ($proBrandDeleted) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

}

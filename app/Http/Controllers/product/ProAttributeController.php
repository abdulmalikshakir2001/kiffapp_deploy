<?php

namespace App\Http\Controllers\product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product\ProAttribute;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class ProAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title']='Manage Product Attribute';
        $data['navbar_headings']='Manage Product Attribute';
        return view('product/proAttributeView',$data);
    }
    public function getData(Request $request)
    {
        // start 
$proAttributeTable =  DB::table('pro_attributes')->where('company_id',session()->get('company_id'))->get();


// end
        // $proAttributes =  DB::table('proAttributes')->where('company_id',session()->get('company_id'))->get();
        $allData = DataTables::of($proAttributeTable)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
            $btn =
            '<button type="button" class="text-secondary proAttributeDeleteBtn bg-white"  style="border:none;" data-pro_attribute_id="' . $row->attribute_id . '"  data-bs-toggle="modal" data-bs-target="#proAttributeDeleteConfirm"><i class="fas fa-trash-alt fs-6 text-danger"></i>
            </button><button class="text-secondary sidenav_zero_index proAttributeEditBtn  bg-white" data-bs-toggle="modal" data-bs-target="#proAttributeUpdateModal" style="border: none;" data-pro_attribute_id="' . $row->attribute_id . '">
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
        $data['title']='Manage Product Attribute';
        $data['navbar_headings']='Manage Product Attribute';
        return view('product/proAttributeCreate',$data);
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
            'name'=>'required',
        ]);
        $request['company_id']=session()->get('company_id');
        $request['active']= $request->active=="on"?'1':'0';
        
        $proAttributeAdded= ProAttribute::create($request->all());
        if($proAttributeAdded){
            return response()->json(true);
        }
        else{
            return response()->json(false);
        }

        
    }

// update

    public function proAttributeFetch(Request $request)
    {
        $proAttributeId = $request->proAttributeId;
        $proAttributeSingle =  DB::table('pro_attributes')
            ->select('*')
            ->where('attribute_id', '=', $proAttributeId)
            ->get();
        $leave = $proAttributeSingle->first();
        return response()->json($leave);
    }

    public function update(Request $request){
        unset($request['_token']);
        $request->validate([
            'name'=>'required',
        ]);
        $request['company_id']=session()->get('company_id');
        $request['active']= $request->active=="on"?'1':'0';
    

        $proAttributeUpdated= ProAttribute::where('attribute_id',$request->attribute_id)->update ($request->all());
        if($proAttributeUpdated){
            return response()->json(true);
        }
        else{
            return response()->json(false);
        }



    }
    // delete
    public function delete(Request $request)
    {
        $proAttributeId = $request->proAttributeId;
        $proAttributeDeleted = ProAttribute::where('attribute_id', $proAttributeId)->delete();

        if ($proAttributeDeleted) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

}

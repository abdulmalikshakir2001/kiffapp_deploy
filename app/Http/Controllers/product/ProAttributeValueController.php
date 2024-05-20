<?php

namespace App\Http\Controllers\product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product\ProAttributeValue;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class ProAttributeValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title']='Manage Product Attribute Value';
        $data['navbar_headings']='Manage Product Attribute Value';
        $data['attributes']=DB::table('pro_attributes')->where('company_id',session()->get('company_id'))->get();
        return view('product/proAttributeValueView',$data);
    }
    public function getData(Request $request)
    {
        // start 
$proAttributeValueTable =  DB::table('pro_attribute_values')->select('pro_attribute_values.*','pro_attributes.name as attribute_name')->join('pro_attributes','pro_attribute_values.attribute_id','=','pro_attributes.attribute_id')->where('pro_attribute_values.company_id',session()->get('company_id'))->get();


// end
        // $proAttributeValues =  DB::table('proAttributeValues')->where('company_id',session()->get('company_id'))->get();
        $allData = DataTables::of($proAttributeValueTable)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
            $btn =
            '<button type="button" class="text-secondary proAttributeValueDeleteBtn bg-white"  style="border:none;" data-pro_attribute_value_id="' . $row->attribute_value_id . '"  data-bs-toggle="modal" data-bs-target="#proAttributeValueDeleteConfirm"><i class="fas fa-trash-alt fs-6 text-danger"></i>
            </button><button class="text-secondary sidenav_zero_index proAttributeValueEditBtn  bg-white" data-bs-toggle="modal" data-bs-target="#proAttributeValueUpdateModal" style="border: none;" data-pro_attribute_value_id="' . $row->attribute_value_id . '">
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
        $data['title']='Manage Product Attribute Value';
        $data['navbar_headings']='Manage Product Attribute Value';
        return view('product/proAttributeValueCreate',$data);
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
        
        $proAttributeValueAdded= ProAttributeValue::create($request->all());
        if($proAttributeValueAdded){
            return response()->json(true);
        }
        else{
            return response()->json(false);
        }

        
    }

// update

    public function proAttributeValueFetch(Request $request)
    {
        $proAttributeValueId = $request->proAttributeValueId;
        $proAttributeValueSingle =  DB::table('pro_attribute_values')
            ->select('*')
            ->where('attribute_value_id', '=', $proAttributeValueId)
            ->get();
        $leave = $proAttributeValueSingle->first();
        return response()->json($leave);
    }

    public function update(Request $request){
        unset($request['_token']);
        $request->validate([
            'name'=>'required',
        ]);
        $request['company_id']=session()->get('company_id');
        $request['active']= $request->active=="on"?'1':'0';
    

        $proAttributeValueUpdated= ProAttributeValue::where('attribute_value_id',$request->attribute_value_id)->update ($request->all());
        if($proAttributeValueUpdated){
            return response()->json(true);
        }
        else{
            return response()->json(false);
        }



    }
    // delete
    public function delete(Request $request)
    {
        $proAttributeValueId = $request->proAttributeValueId;
        $proAttributeValueDeleted = ProAttributeValue::where('attribute_value_id', $proAttributeValueId)->delete();

        if ($proAttributeValueDeleted) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

}

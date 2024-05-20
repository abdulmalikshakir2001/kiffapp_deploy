<?php

namespace App\Http\Controllers\product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product\ProCategory;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class ProCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title']='Manage Product Category';
        $data['navbar_headings']='Manage Product Category';
        $data['parentCategories']=DB::table('pro_categories')->where('parent','0')->get();
        return view('product/proCategoryView',$data);
    }
    public function getData(Request $request)
    {
        // start 
$proCategoryTable =  DB::table('pro_categories as p')->select('p.*','p_c.category_name as child_category')->leftJoin('pro_categories as p_c','p.category_id','=','p_c.parent')->get();


// end
        // $proCategorys =  DB::table('proCategorys')->where('company_id',session()->get('company_id'))->get();
        $allData = DataTables::of($proCategoryTable)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
            $btn =
            '<button type="button" class="text-secondary proCategoryDeleteBtn bg-white"  style="border:none;" data-pro_category_id="' . $row->category_id . '"  data-bs-toggle="modal" data-bs-target="#proCategoryDeleteConfirm"><i class="fas fa-trash-alt fs-6 text-danger"></i>
            </button><button class="text-secondary sidenav_zero_index proCategoryEditBtn  bg-white" data-bs-toggle="modal" data-bs-target="#proCategoryUpdateModal" style="border: none;" data-pro_category_id="' . $row->category_id . '">
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
        $data['title']='Manage Product Category';
        $data['navbar_headings']='Manage Product Category';
        return view('product/proCategoryCreate',$data);
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
            'category_name'=>'required',
        ]);
        $request['company_id']=session()->get('company_id');
        $request['active']= $request->active=="on"?'1':'0';
        if($request->parent){
            $request['parent']= $request->parent;

            
        }
        else{
            $request['parent']= '0';

        }
        $proCategoryAdded= ProCategory::create($request->all());
        if($proCategoryAdded){
            return response()->json(true);
        }
        else{
            return response()->json(false);
        }

        
    }

// update

    public function proCategoryFetch(Request $request)
    {
        $proCategoryId = $request->proCategoryId;
        $proCategorySingle =  DB::table('pro_categories')
            ->select('*')
            ->where('category_id', '=', $proCategoryId)
            ->get();
        $leave = $proCategorySingle->first();
        return response()->json($leave);
    }

    public function update(Request $request){
        unset($request['_token']);
        $request->validate([
            'category_name'=>'required',
        ]);
        $request['company_id']=session()->get('company_id');
        $request['active']= $request->active=="on"?'1':'0';
        // return response()->json($request->all());
        if($request->parent!=0){
            $request['parent']= $request->parent;

            
        }
        else{
            $request['parent']= '0';

        }

        $proCategoryUpdated= ProCategory::where('category_id',$request->category_id)->update ($request->all());
        if($proCategoryUpdated){
            return response()->json(true);
        }
        else{
            return response()->json(false);
        }



    }
    // delete
    public function delete(Request $request)
    {
        $proCategoryId = $request->proCategoryId;
        $proCategoryDeleted = ProCategory::where('category_id', $proCategoryId)->delete();

        if ($proCategoryDeleted) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

}

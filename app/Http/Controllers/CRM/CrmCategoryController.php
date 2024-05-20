<?php

namespace App\Http\Controllers\CRM;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CRM\CrmCategory;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class CrmCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title']='Manage Category';
        $data['navbar_headings']='Manage Category';
        return view('crm/crm_view_category',$data);
    }
    public function getData(Request $request)
    {
        // start 
$crm_category_table =  DB::table('crm_categories')->where('company_id', session()->get('company_id'))->get();


// end
        // $crm_categorys =  DB::table('crm_categories')->where('company_id',session()->get('company_id'))->get();
        $allData = DataTables::of($crm_category_table)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
            $btn =
            '<button type="button" class="text-secondary crm_category_delete_btn bg-white"  style="border:none;" data-delete_crm_category_id="' . $row->category_id . '"  data-bs-toggle="modal" data-bs-target="#delete_confirm_crm_category"><i class="fas fa-trash-alt fs-6 text-danger"></i>
            </button><button class="text-secondary sidenav_zero_index crm_category_edit_btn  bg-white" data-bs-toggle="modal" data-bs-target="#update_crm_category" style="border: none;" data-update_crm_category_id="' . $row->category_id . '">
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
        $data['title']='Manage Category';
        $data['navbar_headings']='Manage Category';
        return view('crm/create_crm_category',$data);
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
        $crm_category_added= CrmCategory::create($request->all());
        if($crm_category_added){
            return response()->json(true);
        }
        else{
            return response()->json(false);
        }
    }
// update
    public function fetch_crm_category(Request $request)
    {
        $update_crm_category_id = $request->update_crm_category_id;
        $single_crm_category_query =  DB::table('crm_categories')
            ->select('*')
            ->where('category_id', '=', $update_crm_category_id)
            ->get();
        $leave = $single_crm_category_query->first();
        return response()->json($leave);
    }

    public function update_crm_category(Request $request){
        unset($request['_token']);
        $request->validate([
            'category_name'=>'required',
            
        ]);
        $request['company_id']=session()->get('company_id');

        $crm_category_updated= CrmCategory::where('category_id',$request->category_id)->update ($request->all());
        if($crm_category_updated){
            return response()->json(true);
        }
        else{
            return response()->json(false);
        }



    }
    // delete
    public function delete_crm_category(Request $request)
    {
        $delete_crm_category_id = $request->delete_crm_category_id;
        $crm_category_deleted = CrmCategory::where('category_id', $delete_crm_category_id)->delete();

        if ($crm_category_deleted) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

}

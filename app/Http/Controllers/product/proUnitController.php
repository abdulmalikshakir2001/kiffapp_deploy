<?php
namespace App\Http\Controllers\product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product\ProUnit;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
class ProUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title']='Manage Product Unit';
        $data['navbar_headings']='Manage Product Unit';
        return view('product/proUnitView',$data);
    }
    public function getData(Request $request)
    {
        // start 
$proUnitTable =  DB::table('pro_units')->where('company_id',session()->get('company_id'))->get();


// end
        // $proUnits =  DB::table('proUnits')->where('company_id',session()->get('company_id'))->get();
        $allData = DataTables::of($proUnitTable)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
            $btn =
            '<button type="button" class="text-secondary proUnitDeleteBtn bg-white"  style="border:none;" data-pro_unit_id="' . $row->unit_id . '"  data-bs-toggle="modal" data-bs-target="#proUnitDeleteConfirm"><i class="fas fa-trash-alt fs-6 text-danger"></i>
            </button><button class="text-secondary sidenav_zero_index proUnitEditBtn  bg-white" data-bs-toggle="modal" data-bs-target="#proUnitUpdateModal" style="border: none;" data-pro_unit_id="' . $row->unit_id . '">
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
        $data['title']='Manage Product Unit';
        $data['navbar_headings']='Manage Product Unit';
        return view('product/proUnitCreate',$data);
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
            'unit_name'=>'required',
        ]);
        $request['company_id']=session()->get('company_id');
        $request['active']= $request->active=="on"?'1':'0';
        
        $proUnitAdded= ProUnit::create($request->all());
        if($proUnitAdded){
            return response()->json(true);
        }
        else{
            return response()->json(false);
        }

        
    }

// update

    public function proUnitFetch(Request $request)
    {
        $proUnitId = $request->proUnitId;
        $proUnitSingle =  DB::table('pro_units')
            ->select('*')
            ->where('unit_id', '=', $proUnitId)
            ->get();
        $leave = $proUnitSingle->first();
        return response()->json($leave);
    }

    public function update(Request $request){
        unset($request['_token']);
        $request->validate([
            'unit_name'=>'required',
        ]);
        $request['company_id']=session()->get('company_id');
        $request['active']= $request->active=="on"?'1':'0';
    

        $proUnitUpdated= ProUnit::where('unit_id',$request->unit_id)->update ($request->all());
        if($proUnitUpdated){
            return response()->json(true);
        }
        else{
            return response()->json(false);
        }



    }
    // delete
    public function delete(Request $request)
    {
        $proUnitId = $request->proUnitId;
        $proUnitDeleted = ProUnit::where('unit_id', $proUnitId)->delete();

        if ($proUnitDeleted) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

}

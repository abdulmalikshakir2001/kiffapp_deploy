<?php
namespace App\Http\Controllers\product;
use App\Http\Controllers\Controller;
use App\Models\Users\User;
use App\Models\product\ProWarrenty;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use PDF;
class ProWarrentyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['title'] = 'All Warrenty';
        $data['navbar_headings'] = 'All Warrenty';
        return view('product/proWarrentyView', $data);
    }
    public function getData(Request $request)

    {
        $proWarrenty= DB::table('pro_warrenties')->where('company_id',session()->get('company_id'))->get();
        // $proWarrenty =  DB::table('pro_warrentys')->where('company_id', session()->get('company_id'))->get();
        $allData = DataTables::of($proWarrenty)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn =
                    '<button  type="button"  class="text-secondary  proWarrentyDeleteBtn bg-white "  style="border:none;" data-pro_warrenty_id="' . $row->warrenty_id . '"data-bs-toggle="modal" data-bs-target="#deleteConfirmModal" ><i class="fas fa-trash-alt fs-6 text-danger"></i>
            </button>
            <button class="text-secondary proWarrentyEditBtn bg-white"  style="border: none;" data-pro_warrenty_id="' . $row->warrenty_id . '" >
                    <a href="#"> <i class="fas fa-edit fs-6 text-success">
                    </i>
                    </a>

                </button>
                <button class="badge-info text-secondary  sidenav_zero_index border_5_font_12 proWarrentyDetailsButton"  style="border: none;" data-pro_warrenty_id="' . $row->warrenty_id . '" >
                        <a href="' . route('proWarrentyDetails', $row->warrenty_id) . '" class="text-white"> <i class="fas fa-eye ">
                        </i>
                        View
                        </a>
                    </button>
                
                ';
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
        $data['title'] = 'Create Warrenty';
        $data['navbar_headings'] = 'Create  Warrenty';
        return view('product/proWarrentyCreate', $data);
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
            'warrenty_name' => 'required',
            'duration' => 'required',
            
        ]);
        $request['company_id'] = session()->get('company_id');
        $request['product_id'] = session()->get('company_id');

        $proWarrentyAdded = ProWarrenty::insert($request->all());
        if ($proWarrentyAdded) {
            return response()->json('true');
        } else {
            return response()->json('false');
        }
    }

    public function delete(Request $request)
    {
        $proWarrentyId = $request->proWarrentyId;

        $proWarrentyDeleted = ProWarrenty::where('warrenty_id', $proWarrentyId)->delete();
        if ($proWarrentyDeleted) {
            return response()->json('true');
        } else {
            return response()->json('false');
        }
    }

    public function updateForm(Request $request)
    {
        $data['warrenty'] = ProWarrenty::where('warrenty_id', $request->proWarrentyId)->get()->first();
        $data['title'] = 'Update Warrenty';
        $data['navbar_headings'] = 'Update  Warrenty';
        return view('product/proWarrentyUpdate', $data);
    }
    public function update(Request $request)
    {
        unset($request['_token']);
        $request->validate([
            'warrenty_name' => 'required',
            'duration' => 'required',
            
        ]);
        $request['company_id'] = session()->get('company_id');

        $proWarrentyUpdated = ProWarrenty::where('warrenty_id', $request->warrenty_id)->update($request->all());
        if ($proWarrentyUpdated) {
            return response()->json('true');
        } else {
            return response()->json('false');
        }
    }

    public function Details(Request $request)
    {
        $data['warrenty'] = ProWarrenty::where('warrenty_id', $request->proWarrentyId)->get()->first();
        $data['title'] = ' Warrenty Details';
        $data['navbar_headings'] = 'Warrenty Details';

        return view('product/proWarrentyDetails', $data);
    }




    public function proWarrentyUrl(Request $request)
    {
        $url = url('proWarrentyDetailsPrint' . '/' . $request->proWarrentyId);
        return response()->json($url);
    }


    public function proWarrentyDetailsPrint(Request $request)

    {
        $data['warrenty'] = ProWarrenty::where('warrenty_id', $request->proWarrentyId)->get()->first();
        $data['title'] = ' Warrenty Details';
        $data['navbar_headings'] = 'Warrenty Details';
        // for hrm view payroll start
        $pdf = PDF::loadView('product/proWarrentyDetailsPrint', $data)->setPaper('a4')->setOption('margin-bottom', 20);

        //  return response()->json( $pdf->output());
        return response($pdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="file.pdf"',
        ]);
    }
}

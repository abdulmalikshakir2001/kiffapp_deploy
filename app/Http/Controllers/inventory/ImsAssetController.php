<?php

namespace App\Http\Controllers\inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\inventory\ImsAsset;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use DNS1D;
use DNS2D;

class ImsAssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title'] = 'Manage Asset';
        $data['navbar_headings'] = 'Manage Asset';
        $data['warehouses'] = DB::table('pur_warehouses')->where('company_id','=',session('company_id'))->get();
        return view('inventory/imsAssetView', $data);
    }
    public function getData(Request $request)
    {
        
        $imsAssetTable =  ImsAsset::where('company_id', session()->get('company_id'))->get();


        
        
        $allData = DataTables::of($imsAssetTable)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn =
                    '<button type="button" class="text-secondary imsAssetDeleteBtn bg-white"  style="border:none;" data-ims_asset_id="' . $row->ims_asset_id . '"  data-bs-toggle="" data-bs-target=""><i class="fas fa-trash-alt fs-6 text-danger"></i>
            </button><button class="text-secondary sidenav_zero_index imsAssetEditBtn  bg-white" data-bs-toggle="modal" data-bs-target="#imsAssetUpdateModal" style="border: none;" data-ims_asset_id="' . $row->ims_asset_id . '">
                    <a href="#"> <i class="fas fa-edit fs-6 text-success ">
                    </i>
                    </a>
                </button>';
                return $btn;
            })->addColumn('warehouse_id',function($row){
                return $row->warehouse->warehouse_name;

            })
            ->rawColumns(['action','warehouse_id'])
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
        $data['title'] = 'Manage Asset';
        $data['navbar_headings'] = 'Manage Asset';
        return view('inventory/imsAssetCreate', $data);
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
            'warehouse_id' => 'required',
        ]);
        $request['company_id'] = session()->get('company_id');
        $randNumber = rand(1345689359, 1098354890);
        $qrCodeRandNumber = rand(1345689359, 9999994899);
        $request['barcode'] = $randNumber;
        $request['barcode_string'] = json_encode(DNS1D::getBarcodeHTML($randNumber, 'C128'));
        $request['qr_code'] = $qrCodeRandNumber;
        $request['qr_code_string'] = json_encode(DNS2D::getBarcodeHTML(".$qrCodeRandNumber.", 'QRCODE', 5, 5));
        if($request->qty==null){
            $request['qty'] = 1;

        }

        $imsAssetAdded = ImsAsset::create($request->all());
        if ($imsAssetAdded) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    // update

    public function imsAssetFetch(Request $request)
    {
        $imsAssetId = $request->imsAssetId;
        $imsAssetSingle =  DB::table('ims_assets')
            ->select('*')
            ->where('ims_asset_id', '=', $imsAssetId)
            ->get();
        $asset = $imsAssetSingle->first();
        return response()->json($asset);
    }

    public function update(Request $request)
    {
        unset($request['_token']);
        $request->validate([
            'name' => 'required',
            'warehouse_id' => 'required',
        ]);
        $request['company_id'] = session()->get('company_id');
        if($request->qty==null){
            $request['qty'] = 1;
        }
        


        $imsAssetUpdated = ImsAsset::where('ims_asset_id', $request->ims_asset_id)->update($request->all());
        if ($imsAssetUpdated) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
    // delete
    public function delete(Request $request)
    {
        $imsAssetId = $request->imsAssetId;
        $imsAssetDeleted = ImsAsset::where('ims_asset_id', $imsAssetId)->delete();

        if ($imsAssetDeleted) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
}

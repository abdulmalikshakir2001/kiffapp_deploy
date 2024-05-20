<?php

namespace App\Http\Controllers\account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\account\AccFamily;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use DNS1D;
use DNS2D;

class AccFamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title'] = 'Manage Family';
        $data['navbar_headings'] = 'Manage Family';
        $data['warehouses'] = DB::table('pur_warehouses')->where('company_id','=',session('company_id'))->get();
        return view('account/accFamilyView', $data);
    }
    public function getData(Request $request)
    {
        
        $accFamilyTable =  AccFamily::get();


        
        
        $allData = DataTables::of($accFamilyTable)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn =
                    '<button type="button" class="text-secondary accFamilyDeleteBtn bg-white"  style="border:none;" data-acc_family_id="' . $row->acc_family_id . '"  data-bs-toggle="" data-bs-target=""><i class="fas fa-trash-alt fs-6 text-danger"></i>
            </button><button class="text-secondary sidenav_zero_index accFamilyEditBtn  bg-white" data-bs-toggle="modal" data-bs-target="#accFamilyUpdateModal" style="border: none;" data-acc_family_id="' . $row->acc_family_id . '">
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
    

}

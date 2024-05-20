<?php

namespace App\Http\Controllers\CompaniesPositions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompaniesPositions\CompaniesPosition;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class CompaniesPositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title']='All Companies Position';
        $data['navbar_headings']='All Companies Position';
        return view('companies_positions/view_companies_positions',$data);
    }
    public function getData(Request $request)
    
    {
        $companies_positions =  DB::table('companies_positions')->get();
                $allData = DataTables::of($companies_positions)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn =
                            '<button type="button" class="text-secondary com_pos_delete_btn bg-white"  style="border:none;" data-delete_com_pos_id="' . $row->position_id . '"  data-bs-toggle="modal" data-bs-target="#delete_confirm_com_pos"><i class="fas fa-trash-alt fs-6 text-danger"></i>
                </button><button class="text-secondary com_pos_edit_btn bg-white" data-bs-toggle="" data-bs-target="" style="border: none;" data-update_com_pos_id="' . $row->position_id . '">
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
        $data['title']='Companies Position';
        $data['navbar_headings']='Companies Position';
        return view('companies_positions/create_companies_positions',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'position_name' => 'required',
            'company_id' => 'required',
        ]);
        $companies_positions_tbl= new CompaniesPosition();
          $companies_positions_tbl->insertCompaniesPositions($request->all());
        if($companies_positions_tbl){
            return response()->json(true);
        }
        else{
            return response()->json(false);
        }

        
    }


    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)

    {

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function deleteCompaniesPositions(Request $request){
        $companies_positions_tbl= new CompaniesPosition();
         $companies_positions_deleted=$companies_positions_tbl->deleteCompaniesPositions($request->all());
         if($companies_positions_deleted){
            return response()->json(true);
         }
         else{
            return response()->json(false);

         }
        
        


    }
    public function updateCompaniesPositionsForm(Request $request){
        $position_id= $request->update_position_id;
    $single_com_pos_query=  DB::table('companies_positions')
    ->select('*')
    ->where('position_id','=',$position_id)
    ->get();
    $data['single_com_pos']=$single_com_pos_query->first();
        $data['title']='Update Position';
        $data['navbar_headings']='Update Position';
        return view('companies_positions/update_companies_positions',$data);
    }
    public function updateCompaniesPositions(Request $request){
        $request->validate([
            'position_name' => 'required',
            'company_id' => 'required',
        ]);
        $companies_positions_tbl= new CompaniesPosition();
         $companies_positions_updated=  $companies_positions_tbl->updateCompaniesPositions($request->all());
        if($companies_positions_updated){
            return response()->json(true);
        }
        else{
            return response()->json(false);
        }


    }
    


}

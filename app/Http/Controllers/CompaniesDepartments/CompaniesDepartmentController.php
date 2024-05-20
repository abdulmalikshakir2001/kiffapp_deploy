<?php

namespace App\Http\Controllers\CompaniesDepartments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompaniesDepartments\CompaniesDepartment;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
class CompaniesDepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title']='All Companies Department';
        $data['navbar_headings']='All Companies Department';
        return view('companies_departments/view_companies_departments',$data);
    }
    public function getData(Request $request)
    
    {
        $companies_departments =  DB::table('companies_departments')->get();
                $allData = DataTables::of($companies_departments)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn =
                            '<button type="button" class="text-secondary com_dep_delete_btn bg-white"  style="border:none;" data-delete_com_dep_id="' . $row->department_id . '"  data-bs-toggle="modal" data-bs-target="#delete_confirm_com_dep"><i class="fas fa-trash-alt fs-6 text-danger"></i>
                </button><button class="text-secondary com_dep_edit_btn bg-white" data-bs-toggle="" data-bs-target="" style="border: none;" data-update_com_dep_id="' . $row->department_id . '">
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
        $data['title']='Companies Department';
        $data['navbar_headings']='Companies Department';
        return view('companies_departments/create_companies_departments',$data);
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
            'department_name' => 'required',
            'company_id' => 'required',
        ]);
        $companies_departments_tbl= new CompaniesDepartment();
          $companies_departments_tbl->insertCompaniesDepartments($request->all());
        if($companies_departments_tbl){
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
    public function deleteCompaniesDepartments(Request $request){
        $companies_departments_tbl= new CompaniesDepartment();
         $companies_departments_deleted=$companies_departments_tbl->deleteCompaniesDepartments($request->all());
         if($companies_departments_deleted){
            return response()->json(true);
         }
         else{
            return response()->json(false);

         }
        
        


    }
    public function updateCompaniesDepartmentsForm(Request $request){
        $department_id= $request->update_department_id;
    $single_com_dep_query=  DB::table('companies_departments')
    ->select('*')
    ->where('department_id','=',$department_id)
    ->get();
    $data['single_com_dep']=$single_com_dep_query->first();
        $data['title']='Update  Department';
        $data['navbar_headings']='Update Position Department';
        return view('companies_departments/update_companies_departments',$data);
    }
    public function updateCompaniesDepartment(Request $request){
        $request->validate([
            'department_name' => 'required',
            'company_id' => 'required',
        ]);
        $companies_departments_tbl= new CompaniesDepartment();
         $companies_departments_updated=  $companies_departments_tbl->updateCompaniesDepartments($request->all());
        if($companies_departments_updated){
            return response()->json(true);
        }
        else{
            return response()->json(false);
        }


    }
    


}

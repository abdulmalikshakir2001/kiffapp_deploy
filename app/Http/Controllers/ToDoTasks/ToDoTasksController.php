<?php

namespace App\Http\Controllers\ToDoTasks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompaniesDepartments\CompaniesDepartment;
use App\Models\ToDoTasks\ToDoTask;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Support\Facades\DB;

class ToDoTasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title']='All To Do Task';
        $data['navbar_headings']='All To Do Task';
        return view('to_do_tasks/view_to_do_tasks',$data);
    }
    public function getData(Request $request)
    
    {
        $to_do_tasks =  DB::table('to_do_tasks')->where('user_id',session()->get('user_id'))->get();
                $allData = DataTables::of($to_do_tasks)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn =
                            '<button type="button" class="text-secondary to_do_tasks_delete_btn bg-white"  style="border:none;" data-delete_to_do_tasks_id="' . $row->to_do_task_id . '"  data-bs-toggle="modal" data-bs-target="#delete_confirm_to_do_tasks"><i class="fas fa-trash-alt fs-6 text-danger"></i>
                </button><button class="text-secondary to_do_tasks_edit_btn bg-white" data-bs-toggle="" data-bs-target="" style="border: none;" data-update_to_do_tasks_id="' . $row->to_do_task_id . '">
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
        $data['title']='To Do Tasks';
        $data['navbar_headings']='To Do Tasks';
        return view('to_do_tasks/create_to_do_tasks',$data);
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
            'task_name' => 'required',
        ]);
        $to_do_task_arr=[
            'task_name'=>$request->task_name,
            'task_description'=>$request->task_description,
            'user_id'=>session()->get('user_id')
        ];
        $to_do_tasks_inserted=ToDoTask::create($to_do_task_arr);
        if($to_do_tasks_inserted){
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
    public function deleteToDoTasks(Request $request){
        $to_do_tasks_deleted= ToDoTask::find($request->delete_to_do_tasks_id)->delete();

         if($to_do_tasks_deleted){
            return response()->json(true);
         }
         else{
            return response()->json(false);

         }
        
        


    }
    public function updateToDoTasksForm(Request $request){
        
        $to_do_tasks_id= $request->update_to_do_tasks_id;
    $single_to_do_tasks_query=  DB::table('to_do_tasks')
    ->select('*')
    ->where('to_do_task_id','=',$to_do_tasks_id)
    ->get();


    $data['single_to_do_tasks']=$single_to_do_tasks_query->first();
        $data['title']='Update  Task';
        $data['navbar_headings']='Update Task';
        return view('to_do_tasks/update_to_do_tasks',$data);
    }
    public function updateToDoTasks(Request $request){
        $request->validate([
            'task_name' => 'required',
        ]);
        $task_status= $request->status=='on'?'1':'0';
        $request['status']=$task_status;
        unset($request['_token']);
        // return response()->json($request->all());
        $to_do_task_updated= ToDoTask::where('to_do_task_id',$request->to_do_task_id)->update($request->all());
        
        // $companies_departments_tbl= new CompaniesDepartment();
        //  $to_do_task_updated_updated=  $companies_departments_tbl->updateCompaniesDepartments($request->all());
        if($to_do_task_updated){
            return response()->json(true);
        }
        else{
            return response()->json(false);
        }


    }
    


}

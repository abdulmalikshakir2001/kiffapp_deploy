<?php

namespace App\Http\Controllers\AppliedCandidate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobVacancy\JobVacancy;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\Users\User;
use App\Models\JobVacancy\AppliedCandidate;

class AppliedCandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title'] = 'All Candidates';
        $data['navbar_headings'] = 'All Candidates';

        return view('applied_candidate/view_applied_candidate', $data);
    }
    public function getData(Request $request)

    {
        // start 
        $applied_candidates =  DB::table('applied_candidates')->where('company_id', session()->get('company_id'))->get();
        $user_id_for_job = [];
        foreach ($applied_candidates as $value) {
            array_push($user_id_for_job, $value->user_id);
        }
        $user_unique =     array_unique($user_id_for_job);

        $user_jobs = [];
        foreach ($user_unique as $user_id) {
            $user_three_job_vac = User::find($user_id)->job_vacancies;
            foreach ($user_three_job_vac as $vacancies) {
                $user_name = DB::table('users')->where('user_id', $vacancies->pivot->user_id)->get()->first();
                $vacancies['username'] = $user_name->username;
                $vacancies['employee_cv'] = $user_name->employee_cv;
                $vacancies['user_id'] = $user_name->user_id;
                $vacancies['job_vacancy_id'] = $vacancies->pivot->job_vacancy_id;
                $user_jobs[] = $vacancies;
            }
        }
        // end



        // $applied_candidates =  DB::table('applied_candidates')->where('company_id',session()->get('company_id'))->get();
        $allData = DataTables::of($user_jobs)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $check_interview= DB::table('interviews')->where('user_id',$row->user_id)->where('job_vacancy_id',$row->job_vacancy_id)->get();

                


                $btn =
                    '
                            <a href="' . route('download_candidate_file', $row->employee_cv) . '"  class="download_cv" data-file_name="' . $row->employee_cv . '" data-user_id="' . $row->user_id . '"> <i class="fas fa-file-pdf text-danger fs-4"></i> </a>
                <button class="btn btn-primary btn-sm mb-0 ms-4 sidenav_zero_index shotlist_btn" data-bs-toggle="modal" data-bs-target="#shotlist" style="border: none;"  
                data-job_vacancy_id="' . $row->job_vacancy_id . '"
                 data-user_id="' . $row->user_id . '" >Call For Interview</button>';
                 if(count($check_interview)>0){
                    $btn.='<button type="button" class="btn btn-info btn-sm mb-0 ms-2">Inteviewed</button>';

                 }

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
        $data['title'] = 'Job Vacancy';
        $data['navbar_headings'] = 'Job Vacancy';
        return view('job_vacancies/create_job_vacancies', $data);
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
            'vacancy_name' => 'required',
        ]);
        $request['vacancy_status'] = $request->vacancy_status == "on" ? "publish" : "draft";
        $request['description'] = htmlentities($request->description);
        $request['company_id'] = session()->get('company_id');
        $request['vacancy_code'] = rand(0, 99999);

        $job_vacancy_added = JobVacancy::create($request->all());
        if ($job_vacancy_added) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
    // delete job vacancy start 
    public function delete_job_vacancies(Request $request)
    {
        $job_vacancy_id = $request->delete_job_vacancies_id;
        $job_vacancy_deleted = JobVacancy::where('job_vacancy_id', $job_vacancy_id)->delete();

        if ($job_vacancy_deleted) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
    // delete job vacancy start 
    //  update job vacancy start 

    public function fetch_job_vacancy(Request $request)
    {
        $job_vacancy_id = $request->update_job_vacancies_id;
        $single_job_vacancies_query =  DB::table('job_vacancies')
            ->select('*')
            ->where('job_vacancy_id', '=', $job_vacancy_id)
            ->get();
        $vacancy = $single_job_vacancies_query->first();
        return response()->json($vacancy);
    }

    public function update_job_vacancies(Request $request)
    {
        $request->validate([
            'vacancy_name' => 'required',
        ]);
        $request['vacancy_status'] = $request->vacancy_status == "on" ? "publish" : "draft";
        $request['description'] = htmlentities($request->description);
        unset($request['_token']);
        $job_vacancy_updated = JobVacancy::where('job_vacancy_id', $request->job_vacancy_id)->update($request->all());

        if ($job_vacancy_updated) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
    //  update job vacancy start 
    // show jobs start 
    public function show_job_details()
    {
        $data['title'] = 'All Jobs';
        $data['navbar_headings'] = 'All Jobs';
        $get_com_id = DB::table('landing_pages')->where('unique_url_code', session('company_unique_code'))->get()->first();
        $data['company_id'] = $get_com_id->company_id;
        $data['com_job_vacancies'] = DB::table('job_vacancies')->where('company_id', $get_com_id->company_id)->get();


        return view('dashboard/users/all_jobs', $data);
    }
    // show jobs end 
    // applied jobs start
    public function applied_job(Request $request)
    {
        unset($request['_token']);
        $check_job_vac = DB::table('applied_candidates')->where('user_id', session()->get('user_id'))->where('job_vacancy_id', $request->job_vacancy_id)->get();
        if (count($check_job_vac) > 0) {
            return response()->json('apply_exist');
        }

        $job_applied = AppliedCandidate::create(['user_id' => session()->get('user_id'), 'company_id' => $request->company_id, 'job_vacancy_id' => $request->job_vacancy_id]);
        if ($job_applied) {
            return response()->json('application_created');
        } else {
            return response()->json(false);
        }
    }
    // applied end

    public function download_candidate_file(Request $request)
    {
        
        $candidate_file_path = storage_path('app/public/job_candidate_cvs/') . $request->download_backup;
        // return response()->json($candidate_file_path);
        return  response()->download($candidate_file_path);
    }

    // interview status start 
    public function view_interview_status()
    {
        $data['title'] = 'Interview status';
        $data['navbar_headings'] = 'Interview status';
        return view('applied_candidate/view_interview_status', $data);
    }
    public function get_data_interview(Request $request)

    {
// start 
$applied_candidates =  DB::table('interviews')->where('company_id', session()->get('company_id'))->get();
$user_id_for_job = [];
foreach ($applied_candidates as $value) {
    array_push($user_id_for_job, $value->user_id);
}
$user_unique =     array_unique($user_id_for_job);


$user_jobs = [];
$i=0;
foreach ($user_unique as $user_id) {
    $user_three_job_vac = User::find($user_id)->job_vacancies_interview;
    foreach ($user_three_job_vac as $vacancies) {
        $user_name = DB::table('users')->where('user_id', $vacancies->pivot->user_id)->get()->first();
        $vacancies['username'] = $user_name->username;
        $vacancies['employee_cv'] = $user_name->employee_cv;
        $vacancies['user_id'] = $user_name->user_id;
        $vacancies['job_vacancy_id'] = $vacancies->pivot->job_vacancy_id;
        $vacancies['status'] = $applied_candidates[$i]->status;
        $user_jobs[] = $vacancies;
        $i++;
    }
}

// end



        // $applied_candidates =  DB::table('applied_candidates')->where('company_id',session()->get('company_id'))->get();
        $allData = DataTables::of($user_jobs)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn =
                    '
                <button class="btn btn-primary btn-sm mb-0 ms-4 sidenav_zero_index change_status_btn" data-bs-toggle="modal" data-bs-target="#change_status" style="border: none;"  
                data-job_vacancy_id="' . $row->job_vacancy_id . '"
                 data-user_id="' . $row->user_id . '" >Change Status</button>';
                return $btn;
            })->addColumn('status',function($row){
                if($row->status==0){
                    return '<span class="badge bg-info text-white" style="font-size:10px">Not Hired</span>';

                }
                else{
                return '<span class="badge bg-success text-white" style="font-size:10px">Hired</span>';
                }

            })

            ->rawColumns(['action','status'])
            ->make(true);
        return $allData;
    }
    // interview status end 
    public function interview_status_change(Request $request){
        unset($request['_token']);
        $request['status']=$request->status=="on"?'1':"0";
        $candidate_hired= DB::table('interviews')->where('user_id',$request->user_id)->where('job_vacancy_id',$request->job_vacancy_id)->update(['status'=>$request->status]);
        if($candidate_hired){
            DB::table('users')->where('user_id',$request->user_id)->update([
                'user_type'=>'Employee',
                'company_id'=>session()->get('company_id')
            ]);
            echo true;

        }
        else{
            echo false;
        }


    }


}

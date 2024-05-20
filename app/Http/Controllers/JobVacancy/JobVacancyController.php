<?php

namespace App\Http\Controllers\JobVacancy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobVacancy\JobVacancy;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\Users\User;
use App\Models\JobVacancy\AppliedCandidate;

class JobVacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title'] = 'All JobVacancy';
        $data['navbar_headings'] = 'All JobVacancy';
        $data['applicants'] = count(DB::table('applied_candidates')->where('company_id', session()->get('company_id'))->get());
        return view('job_vacancies/view_job_vacancies', $data);
    }
    public function getData(Request $request)
    {
        $job_vacancies =  DB::table('job_vacancies')->where('company_id', session()->get('company_id'))->get();
        $allData = DataTables::of($job_vacancies)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn =
                    '<button type="button" class="text-secondary job_vacancies_delete_btn bg-white"  style="border:none;" data-delete_job_vacancies_id="' . $row->job_vacancy_id . '"  data-bs-toggle="modal" data-bs-target="#delete_confirm_job_vacancies"><i class="fas fa-trash-alt fs-6 text-danger"></i>
                </button><button class="text-secondary sidenav_zero_index job_vacancies_edit_btn  bg-white" data-bs-toggle="modal" data-bs-target="#update_job_vacancies" style="border: none;" data-update_job_vacancies_id="' . $row->job_vacancy_id . '">
                        <a href="#"> <i class="fas fa-edit fs-6 text-success ">
                        </i>
                        </a>
                    </button>';
                return $btn;
            })->addColumn('vacancy_status', function ($row) {
                if ($row->vacancy_status == "publish") {

                    return '<span class="badge bg-success" style="font-size:10px;letter-spacing:.1rem">' . $row->vacancy_status . '</span>';
                } else {
                    return '<span class="badge bg-info" style="font-size:10px;letter-spacing:.1rem">' . $row->vacancy_status . '</span>';
                }
            })->addColumn('description', function ($row) {
                return html_entity_decode($row->description);
            })
            ->rawColumns(['action', 'vacancy_status', 'description'])
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




}

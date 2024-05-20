<?php

namespace App\Http\Controllers\Interview;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Interview\Interview;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\Users\User;
use App\Models\JobVacancy\AppliedCandidate;

class InterviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }
    public function call_interview(Request $request){
        $check_interview= DB::table('interviews')->where('user_id',$request->user_id)->where('job_vacancy_id', $request->job_vacancy_id)->get();
        if(count($check_interview)>0){
            return response()->json('already_interviewed');

        }
        
        unset($request['_token']);
        $request['company_id']=session()->get('company_id');
        $interviewed= Interview::create($request->all());
        if($interviewed){
            return response()->json(true);
        }


    }

    


}

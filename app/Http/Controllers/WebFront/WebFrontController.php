<?php

namespace App\Http\Controllers\WebFront;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Mockery\Undefined;

class WebFrontController extends Controller
{
    
    //
    public function WebFront(Request $request){

            
          $request->unique_url;
        if($request->unique_url){
            $company_code= explode('/',url()->current())[3];
            session(['company_unique_code'=> $company_code]);
            $check_landing_page= DB::table('landing_pages')->where('unique_url_code',$request->unique_url)->get();
            if(count($check_landing_page)>0){
                $data['page_content']= DB::table('landing_pages')->where('unique_url_code',$request->unique_url)->get()->first();
                // return $data['page_content']->company_id;
                // fetch jobs start 
                $data['page_content']->company_jobs= DB::table('job_vacancies')->where('company_id',$data['page_content']->company_id)->get();

                // fetch jobs end 
            }
            else{

                $data['page_content']=(object) ['header'=>'No Company exist with the given name','main_content'=>null,'footer'=>null,'company_jobs'=>null];
                
            }
            return view('webfront.webfront',$data);
        }
        $dashcompany_code=null;
        $check_landing_page= DB::table('landing_pages')->where('company_id','1')->get();
        if(count($check_landing_page)>0){
            $data['page_content']= DB::table('landing_pages')->where('company_id','1')->get()->first();
            $data['page_content']->company_jobs=null;
        }
        else{
        $data['page_content']=(object) ['header'=>'No Company exist with the given name','main_content'=>null,'footer'=>null,'company_jobs'=>null];
        }
            return view('webfront.webfront',$data);
        }
        
}

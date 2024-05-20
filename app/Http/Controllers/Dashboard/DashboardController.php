<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*
     public function __construct()
    {
        $this->middleware('auth');
    }
    */

    public function index(Request $request)
    {
        if(App::isLocale('ar')){
            $data['title']='لوحة القيادة';
            $data['navbar_headings']='لوحة القيادة';

        }
        else{
            $data['title']='Dashboard';
            $data['navbar_headings']='Dashboard';
        }
        // $data['app_logo']= DB::table('app_settings')->select('app_logo')->get()->first();
        // $notifications= DB::table('notifications')->get();
        // $data['notification_count']=count($notifications);

       
            return view('dashboard.dashboard',$data);



    }


}

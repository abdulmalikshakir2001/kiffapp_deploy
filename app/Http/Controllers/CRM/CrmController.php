<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CrmController extends Controller
{
    //
    public function crmDashboard(Request $request){
        $data['title'] = 'Crm Dashboard';
        $data['navbar_headings'] = 'Crm Dashboard';
        $data['leads']=DB::table('crm_leads')->get()->count();
        $data['oppertunities']=DB::table('crm_oppertunities')->get()->count();
        $data['contacts']=DB::table('users')->where('user_type','ContactOnly')->get()->count();
        $data['phoneCalls']=DB::table('crm_schedule_phone_calls')->get()->count();

        $data['labels']=['Leads','Oppertunities','Contacts','Phone Calls'];
        $data['data']=[$data['leads'],$data['oppertunities'],$data['contacts'],$data['phoneCalls']];
        return view('crm/crmDashboard',$data);


    }
}

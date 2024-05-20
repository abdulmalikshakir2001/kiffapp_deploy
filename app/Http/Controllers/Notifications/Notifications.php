<?php

namespace App\Http\Controllers\Notifications;

use App\Http\Controllers\Controller;
use App\Models\Notifications\OnOffNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Notifications extends Controller
{
    //
    public function markAsRead(){
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }
    public function markNotification(Request $request){
        auth()->user()->unreadNotifications->when($request->input(key:'id'),function($query) use($request){
            return $query->where('id',$request->input(key:'id'));



        })->markAsRead();
        return response()->noContent();
        ;

    }
    public function emailSettingView(){
        $data['title']='Email settings ';
        $data['navbar_headings']='Email settings ';
         $data['notif_name']= OnOffNotification::get();
        return view('notifications/email_settings',$data);
    }

    public function OnOffEmail(Request $request){
        unset($request['_token']);
        if(count($request->all()) >0){
            $on_of_notif_arr=$request->all();
            foreach ($on_of_notif_arr as $key => $value) {
                # code...
                DB::table('on_off_notifications')->where('notification_name',$value)->update(['status'=>'1']);
                DB::table('on_off_notifications')->whereNotIn('notification_name',$on_of_notif_arr)->update(['status'=>'0']);


            }
            echo true;

            // return response()->json($request->all());
        }
        else{
            DB::table('on_off_notifications')->update(['status'=>'0']);
            echo true;




        }


    }

    


}

<?php
namespace App\Http\Controllers\AppSettings;
use App\Models\AppSettings\AppSetting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
class AppSettingsController extends Controller
{
    public function change_logo(){
        $data['title']='Change Logo';
        $data['navbar_headings']='Change Logo';
        return view('app_settings/change_app_logo',$data);
    }
    public function update_app_logo(Request $request){
        $request->validate([
            'app_logo'=>'mimes:jpg,png'
        ]);
        $image_updated= AppSetting::where('app_setting_id',1)->update(['app_logo'=>$request->app_logo->getClientOriginalName()]);
        if(!file_exists(public_path('storage'))){
            File::makeDirectory(public_path('storage'));
        }
        $file_name= $request->app_logo->getClientOriginalName();
        $file_moved= $request->app_logo->move(public_path('storage/app_logo') ,$file_name);
       if($file_moved){
            session()->flash('status', 'App Logo changed');
            session()->flash('class', 'show');
            return response()->json(true);
        }
        else{
            return false;
        }

    }
}

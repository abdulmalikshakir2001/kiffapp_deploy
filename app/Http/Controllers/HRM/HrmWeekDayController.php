<?php

namespace App\Http\Controllers\HRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HRM\HrmWeekDay;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Laravel\Ui\Presets\React;
use Yajra\DataTables\Contracts\DataTable;

class HrmWeekDayController extends Controller
{
    //
    public function index()
    {
        //
        $data['title'] = 'Manage Week Days';
        $data['navbar_headings'] = 'Manage Week Days';
        return view('hrm/view_hrm_week_day', $data);
    }
    public function getData(Request $request)
    {
        // start 
        $hrm_week_day_table =  DB::table('hrm_week_days')->where('company_id', session()->get('company_id'))->get();


        // end
        // $hrm_week_days =  DB::table('hrm_week_days')->where('company_id',session()->get('company_id'))->get();
        $allData = DataTables::of($hrm_week_day_table)
            ->addIndexColumn()
            ->addColumn('monday', function ($row) {
                if ($row->monday == 1) {
                    $input_checkbox = '<div class="form-check form-switch">
                                        <input  class="form-check-input day_input" type="checkbox" id="monday" name="monday"  value='.$row->monday.' checked>
                                    </div>';
                    return $input_checkbox;
                } else {
                    $input_checkbox = '<div class="form-check form-switch">
                                        <input  class="form-check-input day_input" type="checkbox" id="monday" name="monday" value='.$row->monday.' >
                                    </div>';
                    return $input_checkbox;
                }
            })
            ->addColumn('tuesday', function ($row) {
                if ($row->tuesday == 1) {
                    $input_checkbox = '<div class="form-check form-switch">
                                        <input  class="form-check-input day_input" type="checkbox" id="tuesday" name="tuesday" value='.$row->tuesday.' checked>
                                    </div>';
                    return $input_checkbox;
                } else {
                    $input_checkbox = '<div class="form-check form-switch">
                                        <input  class="form-check-input day_input" type="checkbox" id="tuesday" name="tuesday" value='.$row->tuesday.'>
                                    </div>';
                    return $input_checkbox;
                }
            })
            ->addColumn('wednesday', function ($row) {
                if ($row->wednesday == 1) {
                    $input_checkbox = '<div class="form-check form-switch">
                                        <input  class="form-check-input day_input" type="checkbox" id="wednesday" name="wednesday" value='.$row->wednesday.'  checked>
                                    </div>';
                    return $input_checkbox;
                } else {
                    $input_checkbox = '<div class="form-check form-switch">
                                        <input  class="form-check-input day_input" type="checkbox" id="wednesday" name="wednesday value='.$row->wednesday.' ">
                                    </div>';
                    return $input_checkbox;
                }
            })
            ->addColumn('thursday', function ($row) {
                if ($row->thursday == 1) {
                    $input_checkbox = '<div class="form-check form-switch">
                                        <input  class="form-check-input day_input" type="checkbox" id="thursday" name="thursday"  value='.$row->thursday.' checked>
                                    </div>';
                    return $input_checkbox;
                } else {
                    $input_checkbox = '<div class="form-check form-switch">
                                        <input  class="form-check-input day_input" type="checkbox" id="thursday" name="thursday"  value='.$row->thursday.'>
                                    </div>';
                    return $input_checkbox;
                }
            })
            ->addColumn('friday', function ($row) {
                if ($row->friday == 1) {
                    $input_checkbox = '<div class="form-check form-switch">
                                        <input  class="form-check-input day_input" type="checkbox" id="friday" name="friday" value='.$row->friday.' checked>
                                    </div>';
                    return $input_checkbox;
                } else {
                    $input_checkbox = '<div class="form-check form-switch">
                                        <input  class="form-check-input day_input" type="checkbox" id="friday" name="friday" value='.$row->friday.'>
                                    </div>';
                    return $input_checkbox;
                }
            })
            ->addColumn('saturday', function ($row) {
                if ($row->saturday == 1) {
                    $input_checkbox = '<div class="form-check form-switch">
                                        <input  class="form-check-input day_input" type="checkbox" id="saturday" name="saturday" value='.$row->saturday.' checked>
                                    </div>';
                    return $input_checkbox;
                } else {
                    $input_checkbox = '<div class="form-check form-switch">
                                        <input  class="form-check-input day_input" type="checkbox" id="saturday" name="saturday" value='.$row->saturday.'>
                                    </div>';
                    return $input_checkbox;
                }
            })
            ->addColumn('sunday', function ($row) {
                if ($row->sunday == 1) {
                    $input_checkbox = '<div class="form-check form-switch">
                                        <input  class="form-check-input day_input" type="checkbox" id="sunday" name="sunday" value='.$row->sunday.' checked>
                                    </div>';
                    return $input_checkbox;
                } else {
                    $input_checkbox = '<div class="form-check form-switch">
                                        <input  class="form-check-input day_input" type="checkbox" id="sunday" name="sunday" value='.$row->sunday.'>
                                    </div>';
                return $input_checkbox;
                }
                
            })

            ->rawColumns(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'])
            ->make(true);
        return $allData;
    }

    public function on_off_day(Request $request)
    {
        // return response()->json($request->all());
        $day_name=$request->day_name;
        $week_day_updated= DB::table('hrm_week_days')->where('week_day_id',1)->update([$day_name=>$request->on_off]);
        if($week_day_updated){
            return response()->json('true');

        }
        else{
            return response()->json('false');

        }
    }
}

<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LandingPage\LandingPage;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Support\Facades\DB;

class LandingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title']='All Landing pages';
        $data['navbar_headings']='All Landing pages';
        return view('landing_page/view_landing_page',$data);
    }
    public function getData(Request $request)
    
    {
        $landing_page =  DB::table('landing_pages')->get();
                $allData = DataTables::of($landing_page)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn =
                            '<button type="button" class="text-secondary landing_page_delete_btn bg-white"  style="border:none;" data-delete_landing_page_id="' . $row->id . '"  data-bs-toggle="modal" data-bs-target="#delete_confirm_landing_page"><i class="fas fa-trash-alt fs-6 text-danger"></i>
                </button><button class="text-secondary landing_page_edit_btn bg-white" data-bs-toggle="" data-bs-target="" style="border: none;" data-update_landing_page_id="' . $row->id . '">
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
        $data['title']='Landing Page';
        $data['navbar_headings']='Landing Page';
        return view('landing_page/create_landing_page',$data);
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
            'header' => 'required',
            'main_content' => 'required',
            'footer' => 'required',
            'product_template' => 'required',
            'unique_url_code' => 'required|unique:landing_pages',
        ]);
        unset($request['token']);
        $request['company_id']=session()->get('company_id');
        $request['header']=htmlentities($request->header);
        $request['main_content']=htmlentities($request->main_content);
        $request['footer']=htmlentities($request->footer);

         $landing_page_inserted= LandingPage::create($request->all());
        if($landing_page_inserted){
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
    public function deleteLandingPage(Request $request){
        $landing_page_deleted= LandingPage::where('id',$request->delete_landing_page_id)->delete();

         
         if($landing_page_deleted){
            return response()->json(true);
         }
         else{
            return response()->json(false);

         }
        
        


    }
    public function updateLandingPageForm(Request $request){
        $update_landing_page_id= $request->update_landing_page_id;
    $single_landing_page_query=  DB::table('landing_pages')
    ->select('*')
    ->where('id','=',$update_landing_page_id)
    ->get();
    $data['single_landing_page']=$single_landing_page_query->first();
        $data['title']='Update  Landing page';
        $data['navbar_headings']='Update Landing page';
        return view('landing_page/update_landing_page',$data);
    }
    public function updateLandingPage(Request $request){
        $request->validate([
            'header' => 'required',
            'main_content' => 'required',
            'footer' => 'required',
            'product_template' => 'required',
            'unique_url_code' => 'required',
        ]);
        unset($request['_token']);
        $landing_page_updated= LandingPage::where('id',$request->id)->update($request->all());

        if($landing_page_updated){
            return response()->json(true);
        }
        else{
            return response()->json(false);
        }


    }
    public function isExistUrl(Request $request){
        $exist_url=  LandingPage::where('unique_url_code',$request->unique_url_code)->first();
       //  echo json_encode($exist_user);
        if($exist_url){
           echo 'false';
        }
        else{
           echo 'true';
        }
       }

       public function isExistUrlUpdate(Request $request){
        $exist_url=  LandingPage::where('id','!=',$request->id)->where('unique_url_code',$request->unique_url_code)->get()->count();
          //  echo json_encode($exist_user);
           if($exist_url >=1){
              echo 'false';
           }
           else{
              echo 'true';
           }
          }
    


}

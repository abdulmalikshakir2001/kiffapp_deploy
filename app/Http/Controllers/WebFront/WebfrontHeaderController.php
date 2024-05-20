<?php

namespace App\Http\Controllers\WebFront;

use App\Http\Controllers\Controller;
use App\Models\WebFront\WebFront;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebfrontHeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
        //
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
    // update header start 
    public  function update_header(){
        $data['title']='Web Front Header';
        $data['navbar_headings']='Web Front Header';
        $data['header']=DB::table('landing_pages')->select('header','id')->where('company_id',session()->get('company_id'))->get()->first();
        return view('webfront/header/update_header',$data);
    }
    public function update_header_db(Request $request){
        $header_updated= DB::table('landing_pages')->where('id',$request->id)->update(['header'=>  html_entity_decode( $request->header)]);
        if($header_updated){
            echo true;

        }
        else{
            echo false;

        }
    }
    // update header end
    // update body start 
    public  function update_body(){
        $data['title']='Web Front Body';
        $data['navbar_headings']='Web Front Body';
        $data['body']=DB::table('landing_pages')->select('main_content','id')->where('company_id',session()->get('company_id'))->get()->first();
        return view('webfront/body/update_body',$data);
    }
    public function update_body_db(Request $request){
        $body_updated= DB::table('landing_pages')->where('id',$request->id)->update(['main_content'=>html_entity_decode($request->main_content)]);
        if($body_updated){
            echo true;

        }
        else{
            echo false;

        }
    }
    // update body end
    // update footer start 
    public  function update_footer(){
        $data['title']='Web Front Footer';
        $data['navbar_headings']='Web Front Footer';
        $data['footer']=DB::table('landing_pages')->select('footer','id')->where('company_id',session()->get('company_id'))->get()->first();
        return view('webfront/footer/update_footer',$data);
    }
    public function database_update_footer(Request $request){
        $footer_updated= DB::table('landing_pages')->where('id',$request->id)->update(['footer'=> html_entity_decode($request->footer)]);
        if($footer_updated){
            echo true;

        }
        else{
            echo false;

        }
    }
    // update footer end

}

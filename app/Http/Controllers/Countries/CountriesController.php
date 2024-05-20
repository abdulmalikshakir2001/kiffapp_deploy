<?php

namespace App\Http\Controllers\Countries;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Countries\Countries;
use Yajra\DataTables\Facades\DataTables;


use Illuminate\Support\Facades\DB;

class CountriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title']='All Countries';
        $data['navbar_headings']='All Countries';
        return view('countries/view_countries',$data);
    }
    public function getData(Request $request)
    
    {
        $countries =  DB::table('countries')->get();
                $allData = DataTables::of($countries)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn =
                            '<button type="button" class="text-secondary countries_delete_btn bg-white"  style="border:none;" data-delete_countries_id="' . $row->country_id . '"  data-bs-toggle="modal" data-bs-target="#delete_confirm_countries"><i class="fas fa-trash-alt fs-6 text-danger"></i>
                </button><button class="text-secondary countries_edit_btn bg-white" data-bs-toggle="" data-bs-target="" style="border: none;" data-update_countries_id="' . $row->country_id . '">
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
        $data['title']='Countries';
        $data['navbar_headings']='Countries';
        return view('countries/create_countries',$data);
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
            'country' => 'required',
            'currency' => 'required',
            'currency_code' => 'required',
            'currency_symbol' => 'required',
            'thousand_separator' => 'required',
            'thousand_separator' => 'required',
            'decimal_separator' => 'required',
        ]);
        $countries_tbl= new Countries();
          $countries_added=  $countries_tbl->insertCountries($request->all());
        if($countries_added){
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
    public function deleteCountries(Request $request){
        $countries_tbl= new Countries();
         $countries_deleted=$countries_tbl->deleteCountries($request->all());
         if($countries_deleted){
            return response()->json(true);
         }
         else{
            return response()->json(false);

         }
        
        


    }
    public function updateCountriesForm(Request $request){
        $country_id= $request->update_countries_id;
    $single_countries_query=  DB::table('countries')
    ->select('*')
    ->where('country_id','=',$country_id)
    ->get();
    $data['single_countries']=$single_countries_query->first();
        $data['title']='Update  Country';
        $data['navbar_headings']='Update Country';
        return view('countries/update_countries',$data);
    }
    public function updateCountries(Request $request){
        $request->validate([
            'country' => 'required',
            'currency' => 'required',
            'currency_code' => 'required',
            'currency_symbol' => 'required',
            'thousand_separator' => 'required',
            'thousand_separator' => 'required',
            'decimal_separator' => 'required',
        ]);
        $countries_tbl= new Countries();
         $countries_updated= $countries_tbl->updateCountries($request->all());
        if($countries_updated){
            return response()->json(true);
        }
        else{
            return response()->json(false);
        }


    }
    


}

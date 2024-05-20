<?php

namespace App\Http\Controllers\Companies;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Companies\Companie;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;


class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title']='All Companies ';
        $data['navbar_headings']='All Companies ';
        return view('companies/view_companies',$data);
    }
    public function getData(Request $request)
    
    {
        $companies =  DB::table('companies')->get();
                $allData = DataTables::of($companies)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn =
                            '<button type="button" class="text-secondary companies_delete_btn bg-white"  style="border:none;" data-delete_companies_id="' . $row->company_id . '"  data-bs-toggle="modal" data-bs-target="#delete_confirm_companies"><i class="fas fa-trash-alt fs-6 text-danger"></i>
                </button><button class="text-secondary companies_edit_btn bg-white" data-bs-toggle="" data-bs-target="" style="border: none;" data-update_companies_id="' . $row->company_id . '">
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
        $data['title']='Companies ';
        $data['navbar_headings']='Companies ';
        $countries= DB::table('countries')->get();
        $data['countries']=$countries;
        return view('companies/create_companies',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required',
        ]);
        unset($request['_token']);
        $is_active= $request->is_active==true?1:0;
        $request['is_active']=$is_active;


        
        $req= $request->only('company_name',
        'registration_number',
        'address',
        'city',
        'state',
        'landmark',
        'zip_code',
        'country_id',
        'tax1_name',
        'tax1_number',
        'tax2_name',
        'tax2_number',
        'phone_number',
        'contact_number',
        'email',

        'sku_prefix',
        'time_zone',
        'date_format',
        'time_format',
        'fy_start_month',
        'default_profit_percent',
        'default_sales_discount_percent',
        'default_sales_tax_percent',
        'default_barcode_type',
        'pos_settings',
        'email_settings',
        'sms_settings',
        'common_settings',
        'website',
        'webfront_public_code',
        'currency_symbol_placement',
        'stock_accounting_method',
        'enable_purchase',
        'enable_product_expiry',
        'enable_price_tax',
        'enable_category',
        'enable_sub_category',
        'enable_brand',
        'is_active');

        $lastCompanyCreatedId= Companie::insertGetId($req);
        if($lastCompanyCreatedId){
            // logo start 
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            // $profileLogoName = $profileLogo->getClientOriginalName();
            $logoName = 'companyId' . $lastCompanyCreatedId . '.' . $logo->getClientOriginalExtension();
            if (!file_exists(public_path('app'))) {
                File::makeDirectory(public_path('app'));
            }
            if (!file_exists(public_path('app/public'))) {
                File::makeDirectory(public_path('app/public'));
            }
            $request->logo->move(public_path('app/public/company_logo'), $logoName);
            // User::where('user_id', session()->get('user_id'))->update(['profile_logo' => $profileLogoName]);
            DB::table('companies')->where('company_id',$lastCompanyCreatedId)->update(['logo' => $logoName]);
        }
        // logo end 


        return response()->json(true);

        }
        else{
            return response()->json(false);
        }

        
        
        
        
        
    }


    

    
    public function deleteCompanies(Request $request){

        $companies_deleted= Companie::where('company_id',$request->delete_companies_id)->delete();
         if($companies_deleted){
            return response()->json(true);
         }
         else{
            return response()->json(false);

         }
        
        


    }
    public function updateCompaniesForm(Request $request){
        $companies_id= $request->update_companies_id;
        $countries= DB::table('countries')->get();
        $data['countries']=$countries;
    $single_companies_query=  DB::table('companies')
    ->select('*')
    ->where('company_id','=',$companies_id)
    ->get();
    $data['single_companies']=$single_companies_query->first();
        $data['title']='Update  Companies';
        $data['navbar_headings']='Update Companies';
        return view('companies/update_companies',$data);
    }
    public function updateCompanies(Request $request){
        $request->validate([
            'company_name' => 'required',
        ]);
        unset($request['_token']);
        $is_active= $request->is_active==true?1:0;
        $request['is_active']=$is_active;


        // logo start 
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            // $profileLogoName = $profileLogo->getClientOriginalName();
            $logoName = 'companyId' . session()->get('company_id') . '.' . $logo->getClientOriginalExtension();
            if(!file_exists(public_path('app'))){
                File::makeDirectory(public_path('app'));

            }
            if(!file_exists(public_path('app/public'))){
                File::makeDirectory(public_path('app/public'));

            }
            if (!file_exists(public_path('app/public/company_logo'))) {
                File::makeDirectory(public_path('app/public/company_logo'));
            }
            $fileMoved =  $request->logo->move(public_path('app/public/company_logo'), $logoName);
             if($fileMoved){
                Artisan::call('storage:link');


             }

            // User::where('user_id', session()->get('user_id'))->update(['profile_logo' => $profileLogoName]);
            DB::table('companies')->where('company_id', session()->get('company_id'))->update(['logo' => $logoName]);
        }
        // logo end 
        $req= $request->only('company_name',
        'registration_number',
        'address',
        'city',
        'state',
        'landmark',
        'zip_code',
        'country_id',
        'tax1_name',
        'tax1_number',
        'tax2_name',
        'tax2_number',
        'phone_number',
        'contact_number',
        'email',
        'sku_prefix',
        'time_zone',
        'date_format',
        'time_format',
        'fy_start_month',
        'default_profit_percent',
        'default_sales_discount_percent',
        'default_sales_tax_percent',
        'default_barcode_type',
        'pos_settings',
        'email_settings',
        'sms_settings',
        'common_settings',
        'website',
        'webfront_public_code',
        'currency_symbol_placement',
        'stock_accounting_method',
        'enable_purchase',
        'enable_product_expiry',
        'enable_price_tax',
        'enable_category',
        'enable_sub_category',
        'enable_brand',
        'is_active');

        $companies_updated= Companie::where('company_id',$request->company_id)->update($req);
        if($companies_updated){
            return response()->json(true);
        }
        else{
            return response()->json(false);
        }
    }
    public function updateOwnerCompany(){
        $countries= DB::table('countries')->get();
        $data['countries']=$countries;
        $data['title']=session()->get('user_fullname');
        $data['navbar_headings']=session()->get('user_fullname');
        $single_companies_query=  DB::table('companies')
    ->select('*')
    ->where('company_id','=',session()->get('company_id'))
    ->get();
    $data['single_companies']=$single_companies_query->first();
        return view('companies/update_companies',$data);

    }



    public function updateCompanyByAppForm(Request $request){
        $companies_id= $request->update_companies_id;
        $countries= DB::table('countries')->get();
        $data['countries']=$countries;
    $single_companies_query=  DB::table('companies')
    ->select('*')
    ->where('company_id','=',$companies_id)
    ->get();
    $data['single_companies']=$single_companies_query->first();
        $data['title']='Update  Companies';
        $data['navbar_headings']='Update Companies';
        return view('companies/update_company_by_app',$data);
    }


    public function updateCompaniesPost(Request $request){
        $request->validate([
            'company_name' => 'required',
        ]);
        unset($request['_token']);
        $is_active= $request->is_active==true?1:0;
        $request['is_active']=$is_active;


        // logo start 
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            // $profileLogoName = $profileLogo->getClientOriginalName();
            $logoName = 'companyId' . $request->company_id . '.' . $logo->getClientOriginalExtension();
            if (!file_exists(public_path('app'))) {
                File::makeDirectory(public_path('app'));
            }
            if (!file_exists(public_path('app/public'))) {
                File::makeDirectory(public_path('app/public'));
            }
            
            if (!file_exists(public_path('app/public/company_logo'))) {
                File::makeDirectory(public_path('app/public/company_logo'));
            }
             $fileMoved =  $request->logo->move(public_path('app/public/company_logo'), $logoName);
             
            // User::where('user_id', session()->get('user_id'))->update(['profile_logo' => $profileLogoName]);
            DB::table('companies')->where('company_id', $request->company_id)->update(['logo' => $logoName]);
        }
        // logo end 
        $req= $request->only('company_name',
        'registration_number',
        'address',
        'city',
        'state',
        'landmark',
        'zip_code',
        'country_id',
        'tax1_name',
        'tax1_number',
        'tax2_name',
        'tax2_number',
        'phone_number',
        'contact_number',
        'email',
        'sku_prefix',
        'time_zone',
        'date_format',
        'time_format',
        'fy_start_month',
        'default_profit_percent',
        'default_sales_discount_percent',
        'default_sales_tax_percent',
        'default_barcode_type',
        'pos_settings',
        'email_settings',
        'sms_settings',
        'common_settings',
        'website',
        'webfront_public_code',
        'currency_symbol_placement',
        'stock_accounting_method',
        'enable_purchase',
        'enable_product_expiry',
        'enable_price_tax',
        'enable_category',
        'enable_sub_category',
        'enable_brand',
        'is_active');

        $companies_updated= Companie::where('company_id',$request->company_id)->update($req);
        if($companies_updated){
            return response()->json(true);
        }
        else{
            return response()->json(false);
        }
    }
}

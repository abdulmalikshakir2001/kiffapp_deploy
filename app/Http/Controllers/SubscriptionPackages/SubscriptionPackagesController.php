<?php

namespace App\Http\Controllers\SubscriptionPackages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubscriptionPackages\SubscriptionPackages;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Support\Facades\DB;

class SubscriptionPackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title']='All Subscription Packages';
        $data['navbar_headings']='All Subscription Packages';
        return view('subscription_packages/view_subscription_packages',$data);
    }
    public function getData(Request $request)
    
    {
        $subscription_packages =  DB::table('subscription_packages')->get();
                $allData = DataTables::of($subscription_packages)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn =
                            '<button type="button" class="text-secondary subscription_packages_delete_btn bg-white"  style="border:none;" data-delete_subscription_packages_id="' . $row->package_id . '"  data-bs-toggle="modal" data-bs-target="#delete_confirm_subscription_packages"><i class="fas fa-trash-alt fs-6 text-danger"></i>
                </button><button class="text-secondary subscription_packages_edit_btn bg-white" data-bs-toggle="" data-bs-target="" style="border: none;" data-update_subscription_packages_id="' . $row->package_id . '">
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
        $data['title']='Subscription Packages';
        $data['navbar_headings']='Subscription ackages';
        return view('subscription_packages/create_subscription_packages',$data);
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
            'package_name' => 'required',
            'package_description' => 'required',
            'price' => 'required|numeric',
            'duration' => 'required|numeric',
            'duration_type' => 'required',
            'trail_period_in_days' => 'required|numeric',
            'sort_order' => 'required|numeric',
            'allowed_users' => 'required|numeric',
            'allowed_products' => 'required|numeric',
            'allowed_customers' => 'required|numeric',
            'allowed_suppliers' => 'required|numeric',
            'allowed_purchaseorders' => 'required|numeric',
            'allowed_salesinvoices' => 'required|numeric',
            'allowed_accounts' => 'required|numeric',
            
        ]);
        // return response()->json($request->module_crm);
        $subscription_packages_tbl= new SubscriptionPackages();
        $module_hrm_value= $request->module_hrm==true?'1':'0';
        $request['module_hrm']=$module_hrm_value;
        $module_crm_value= $request->module_crm==true?'1':'0';
        $request['module_crm']=$module_crm_value;
        $module_products_value= $request->module_products==true?'1':'0';
        $request['module_products']=$module_products_value;
        
        $module_purchase_value= $request->module_purchase==true?'1':'0';
        $request['module_purchase']=$module_purchase_value;
        
        $module_inventroy_value= $request->module_inventroy==true?'1':'0';
        $request['module_inventroy']=$module_inventroy_value;
        
        $module_sales_value= $request->module_sales==true?'1':'0';
        $request['module_sales']=$module_sales_value;
        
        $module_accounts_value= $request->module_accounts==true?'1':'0';
        $request['module_accounts']=$module_accounts_value;
        
        $is_active_value= $request->is_active==true?'1':'0';
        $request['is_active']=$is_active_value;


          $subscription_packages_tbl->insertSubscriptionPackages($request->all());
        if($subscription_packages_tbl){
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
    public function deleteSubscriptionPackages(Request $request){
        $subscription_packages_tbl= new SubscriptionPackages();
         $subscription_packages_deleted=$subscription_packages_tbl->deleteSubscriptionPackages($request->all());
         if($subscription_packages_deleted){
            return response()->json(true);
         }
         else{
            return response()->json(false);

         }
        
        


    }
    public function updateSubscriptionPackagesForm(Request $request){
        $subscription_packages_id= $request->update_subscription_packages_id;
    $single_subscription_packages_query=  DB::table('subscription_packages')
    ->select('*')
    ->where('package_id','=',$subscription_packages_id)
    ->get();
    $data['single_subscription_packages']=$single_subscription_packages_query->first();
        $data['title']='Update  Subscription Packages';
        $data['navbar_headings']='Update Subscription Packages';
        return view('subscription_packages/update_subscription_packages',$data);
    }
    public function updateSubscriptionPackages(Request $request){
        $request->validate([
            'package_name' => 'required',
            'package_description' => 'required',
            'price' => 'required|numeric',
            'duration' => 'required|numeric',
            'duration_type' => 'required',
            'trail_period_in_days' => 'required|numeric',
            'sort_order' => 'required|numeric',
            'allowed_users' => 'required|numeric',
            'allowed_products' => 'required|numeric',
            'allowed_customers' => 'required|numeric',
            'allowed_suppliers' => 'required|numeric',
            'allowed_purchaseorders' => 'required|numeric',
            'allowed_salesinvoices' => 'required|numeric',
            'allowed_accounts' => 'required|numeric',
            
        ]);
        // return response()->json($request->module_crm);
        $subscription_packages_tbl= new SubscriptionPackages();
        $module_hrm_value= $request->module_hrm==true?'1':'0';
        $request['module_hrm']=$module_hrm_value;
        $module_crm_value= $request->module_crm==true?'1':'0';
        $request['module_crm']=$module_crm_value;
        $module_products_value= $request->module_products==true?'1':'0';
        $request['module_products']=$module_products_value;
        
        $module_purchase_value= $request->module_purchase==true?'1':'0';
        $request['module_purchase']=$module_purchase_value;
        
        $module_inventroy_value= $request->module_inventroy==true?'1':'0';
        $request['module_inventroy']=$module_inventroy_value;
        
        $module_sales_value= $request->module_sales==true?'1':'0';
        $request['module_sales']=$module_sales_value;
        
        $module_accounts_value= $request->module_accounts==true?'1':'0';
        $request['module_accounts']=$module_accounts_value;
        
        $is_active_value= $request->is_active==true?'1':'0';
        $request['is_active']=$is_active_value;
        unset($request['_token']);
        // return response()->json($request->all());

        $subscription_packages_tbl= new SubscriptionPackages();
         $subscription_packages_updated=  $subscription_packages_tbl->updateSubscriptionPackages($request->all());
        if($subscription_packages_updated){
            return response()->json(true);
        }
        else{
            return response()->json(false);
        }


    }
    


}

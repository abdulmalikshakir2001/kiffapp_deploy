<?php

namespace App\Http\Controllers\Subscriptions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscriptions\Subscriptions;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
class SubscriptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title']='All Subscriptions';
        $data['navbar_headings']='All Subscriptions';
        return view('subscriptions/view_subscriptions',$data);
    }
    public function getData(Request $request)
    {
        $subscriptions =  DB::table('subscriptions')->select('subscription_packages.package_name','companies.company_name','subscriptions.*')->join('subscription_packages','subscriptions.package_id','subscription_packages.package_id')->join('companies','subscriptions.company_id','companies.company_id')->get();
                $allData = DataTables::of($subscriptions)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn =
                            '<button type="button" class="text-secondary subscriptions_delete_btn bg-white"  style="border:none;" data-delete_subscriptions_id="' . $row->subscription_id . '"  data-bs-toggle="modal" data-bs-target="#delete_confirm_subscriptions"><i class="fas fa-trash-alt fs-6 text-danger"></i>
                </button><button class="text-secondary subscriptions_edit_btn bg-white" data-bs-toggle="" data-bs-target="" style="border: none;" data-update_subscriptions_id="' . $row->subscription_id . '">
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
        $data['title']='subscriptions';
        $data['navbar_headings']='subscriptions';
        $data['companies']= DB::table('companies')->get();
        $data['subscription_packages']= DB::table('subscription_packages')->get();
        return view('subscriptions/create_subscriptions',$data);
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
            'company_id' => 'required|numeric',
            'package_id' => 'required|numeric',
            'start_date' => 'required',
            'end_date' => 'required',
            'trial_ends_date' => 'required',
            'price' => 'required',
            'status' => 'required',
        ]);
        $is_active_value= $request->is_active==true?'1':'0';
        $request['is_active']=$is_active_value;

        $is_paid_offline_value= $request->is_paid_offline==true?'1':'0';
        $request['is_paid_offline']=$is_paid_offline_value;
        unset($request['_token']);
        $subscriptions_tbl= new Subscriptions();
          $subscriptions_tbl->insertSubscriptions($request->all());
        if($subscriptions_tbl){
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
    public function deleteSubscriptions(Request $request){
        $subscriptions_tbl= new Subscriptions();
         $subscriptions_deleted=$subscriptions_tbl->deleteSubscriptions($request->all());
         if($subscriptions_deleted){
            return response()->json(true);
         }
         else{
            return response()->json(false);

         }
        
        


    }
    public function updateSubscriptionsForm(Request $request){
        $subscriptions_id= $request->subscriptions_id;
    $single_subscriptions_query=  DB::table('subscriptions')
    ->select('*')
    ->where('subscription_id','=',$subscriptions_id)
    ->get();
    $data['single_subscriptions']=$single_subscriptions_query->first();
        $data['title']='Update  Subscription';
        $data['navbar_headings']='Update Subscriptions';
        $data['companies']= DB::table('companies')->get();
        $data['subscription_packages']= DB::table('subscription_packages')->get();
        return view('subscriptions/update_subscriptions',$data);
    }
    public function updateSubscriptions(Request $request){
        $request->validate([
            'company_id' => 'required|numeric',
            'package_id' => 'required|numeric',
            'start_date' => 'required',
            'end_date' => 'required',
            'trial_ends_date' => 'required',
            'price' => 'required',
            'status' => 'required',
        ]);


        $is_active_value= $request->is_active=="on"?'1':'0';
        $request['is_active']=$is_active_value;

        $is_paid_offline_value= $request->is_paid_offline==true?'1':'0';
        $request['is_paid_offline']=$is_paid_offline_value;
        unset($request['_token']);
        $subscriptions_tbl= new Subscriptions();
         $subscriptions_updated=  $subscriptions_tbl->updateSubscriptions($request->all());
        if($subscriptions_updated){
            return response()->json(true);
        }
        else{
            return response()->json(false);
        }


    }
        // fetxh subscription packages for company 
        public function companySubscription(){
            $data['title']=' Company Subscription';
            $data['navbar_headings']='Company Subscription ';
            $data['subscription_packages']= DB::table('subscription_packages')->get();
            // subscription history
            // $data['subscription_history']= DB::table('subscriptions sub')->select('sub_pack.package_name','sub.is_active')->join('subscription_packages sub_pack','sub.package_id','=','sub_pack.package_id')->where('company_id',session()->get('company_id'))->get();
            return view('subscriptions/company_subscription',$data);
    
            
    
        }
        public function fetchPackages(){
    
    
        }
        // fetxh subscription packages for end

        public function add_company_subs(Request $request){
            $data=[
                'package_id'=>$request->package_id,
                'company_id'=>session()->get('company_id'),
            ];
            echo  DB::table('subscriptions')->insert($data);
        }
    


}

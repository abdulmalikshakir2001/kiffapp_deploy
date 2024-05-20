<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DefaultAssignToUser extends Model
{
    use HasFactory;
        // assign default groups to user start 
        function assignWalkInCustomer($company_id){
            DB::table('users')->insert([
                'username'=>'walk in customer '.$company_id ,
                'email'=>'walkincustomer@gmail.com',
                'user_type'=>'Customer',
                'company_id'=>$company_id

            ]);

        }
        function assgin_default_groups_to_user($user_created)
        {
            $users_groups = DB::table('users_groups')->select(DB::raw('group_concat(group_name) as group_name'))->whereBetween('group_id', [3, 3])->get()->first();
            DB::table('users_groups_assigned')->insert(['user_id' => $user_created, 'groups' => $users_groups->group_name]);
        }
        // assign default groups to user end 
        // assign subscription to user start 
        public function assign_subscription_to_user($company_id){
              $basic_subscription=(array) DB::table('subscriptions')->get()->first();
              $basic_subscription['company_id']=$company_id;
              unset($basic_subscription['subscription_id']);
              DB::table('subscriptions')->insert($basic_subscription);
    
    
        }
        // assign subscription to user end 

        // assign workshift to company start 
        public function assign_work_shifts_to_company($company_id){
            DB::table('work_shifts')->insert([
                'shift_name'=>'morning_shift',
                'start_time'=>'08:00',
                'end_time'=>'16:00',
                'company_id'=>$company_id

            ]);
            DB::table('work_shifts')->insert([
                'shift_name'=>'evening_shift',
                'start_time'=>'16:00',
                'end_time'=>'00:00',
                'company_id'=>$company_id

            ]);
            DB::table('work_shifts')->insert([
                'shift_name'=>'night_shift',
                'start_time'=>'01:00',
                'end_time'=>'08:00',
                'company_id'=>$company_id

            ]);

        }
        // assign workshift to company end 
    // create landing page for register user start 
    public function assignDefaultWarehouseAndStock($company_id){
        $warehouseId =  DB::table('pur_warehouses')->insertGetId([
            'company_id' => $company_id,
            'warehouse_name' => 'main warehouse',
            'contact_number' => 'dummy',
            'address' => 'dummy',
            'city' => 'dummy',
            'country' => 'dummy',
            'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),
            

        ]);
        if($warehouseId){
            DB::table('pur_warehouse_stocks')->insert([
                'warehouse_id'=>$warehouseId,
                'company_id'=>$company_id,
                'product_id'=>'0',
                'stock_qty'=>'0',
                'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),


            ]);


        }

    }

    public function create_landing_page($company_id,$unique_url=null)
    {


        DB::table('landing_pages')->insert(
            [
                'header' =>  '<div class="nav-menu fixed-top gradient-color">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <nav class="navbar navbar-dark navbar-expand-lg">
                                <a class="navbar-brand" href="index.html"><img style="width:40px" src="{{asset("storage/app_logo/".show_app_logo()) }}" class="img-fluid" alt="logo"></a>
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span> </button>
                                <div class="collapse navbar-collapse" id="navbar">
                                    <ul class="navbar-nav ms-auto">
                                        <li class="nav-item"> <a class="nav-link active" href="#home">HOME <span class="sr-only"></span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" href="#features">FEATURES</a> </li>
                                        <li class="nav-item"> <a class="nav-link" href="#gallery">GALLERY</a> </li>
                                        <li class="nav-item"> <a class="nav-link" href="#plans">PRICE PLANS</a> </li>
                                        <li class="nav-item"> <a class="nav-link" href="#contact">CONTACT</a> </li>
                                        <li class="nav-item"> <a class="nav-link" href="{{url()->current()."/jobs"}}">JOBS</a> </li>
                                        <li class="nav-item"><a href="{{url("/")}}/login" class="btn btn-outline-light my-3 my-sm-0 ml-lg-3">Login</a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <header class="" id="home">
                <div class="container mt-5">
                    <h1>Zaratica ERP | Do it the smart way</h1>
                    <p class="tagline">The one and only solution for any kind of business needs needs. Just type in "zaratica" in your browser and you are good to go. </p>
                </div>
                <div class="img-holder mt-3"><img src="{{asset("webfront/t1/images/dashboard.png")}}" alt="phone" class="img-fluid"></div>
            </header>',
                'main_content' =>'<div class="client-logos my-5">
                <div class="container text-center">
                    <img src="{{asset("webfront/t1/images/client-logos.png")}}" alt="client logos" class="img-fluid">
                </div>
                </div>
                
                <div class="section light-bg" id="features">
                
                
                <div class="container">
                
                    <div class="section-title">
                        <small>HIGHLIGHTS</small>
                        <h3>Features</h3>
                    </div>
                
                
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="card features">
                                <div class="card-body">
                                    <div class="media">
                                        <span class="ti-face-smile gradient-fill ti-3x mr-3"></span>
                                        <div class="media-body">
                                            <h4 class="card-title">Simple</h4>
                                            <p class="card-text">Zaratica is simple to use, and helps your cover all your business needs.
                                                You will be up and running in less five minutes.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="card features">
                                <div class="card-body">
                                    <div class="media">
                                        <span class="ti-settings gradient-fill ti-3x mr-3"></span>
                                        <div class="media-body">
                                            <h4 class="card-title">Cloud Based</h4>
                                            <p class="card-text"> Zaratica is a cloud based ERP Application, all you need is to register your account and setup your company profile
                                                and in lest than 5 minutes you will be up and running the best ERP Platform for your business.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="card features">
                                <div class="card-body">
                                    <div class="media">
                                        <span class="ti-lock gradient-fill ti-3x mr-3"></span>
                                        <div class="media-body">
                                            <h4 class="card-title">Secure</h4>
                                            <p class="card-text">All your information is privatly hosted on our cloud servers and only you can access them. we keep data confidentiality
                                                as our high priority.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="card features">
                                <div class="card-body">
                                    <div class="media">
                                        <span class="ti-face-smile gradient-fill ti-3x mr-3"></span>
                                        <div class="media-body">
                                            <h4 class="card-title">Human Resource Management</h4>
                                            <p class="card-text">
                                                1. Employees Details<br>
                                                2. Overtime Management<br>
                                                3. Attendance Management<br>
                                                4. Leave Management<br>
                                                5. Payroll<br>
                                                6. Recruitment Process<br>
                                                7. Reports and many more…<br>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="card features">
                                <div class="card-body">
                                    <div class="media">
                                        <span class="ti-settings gradient-fill ti-3x mr-3"></span>
                                        <div class="media-body">
                                            <h4 class="card-title">Purchses</h4>
                                            <p class="card-text">
                                                1. Vendors Management<br>
                                                2. Purchase Request<br>
                                                3. Quotations<br>
                                                4. Purchase Orders<br>
                                                5. Goods Receipt Notes (GRN)<br>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="card features">
                                <div class="card-body">
                                    <div class="media">
                                        <span class="ti-lock gradient-fill ti-3x mr-3"></span>
                                        <div class="media-body">
                                            <h4 class="card-title">Sales</h4>
                                            <p class="card-text">
                                                1. Inventory and Stock Management<br>
                                                2. Distributors Sales Note<br>
                                                3. Retailer and Wholesale<br>
                                                4. Retailers Record<br>
                                                5. Stock Transfer Requests<br>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="card features">
                                <div class="card-body">
                                    <div class="media">
                                        <span class="ti-face-smile gradient-fill ti-3x mr-3"></span>
                                        <div class="media-body">
                                            <h4 class="card-title">CRM</h4>
                                            <p class="card-text">
                                                1. Contacts<br />
                                                2. Customers Details<br />
                                                3. Leads Management<br />
                                                4. Opportunities Management<br />
                                                5. Phone Calls Log<br />
                                                6. Scheduled Phone Calls<br />
                                                7. Help Disk<br />
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="card features">
                                <div class="card-body">
                                    <div class="media">
                                        <span class="ti-settings gradient-fill ti-3x mr-3"></span>
                                        <div class="media-body">
                                            <h4 class="card-title">Inventory</h4>
                                            <p class="card-text">
                                                1. Products<br />
                                                2. Stock Request Notes<br />
                                                3. Transfer Notes<br />
                                                4. Stock Receipt<br />
                                                5. Damage Stocks<br />
                                                6. Stock Consumption<br />
                                                7. Manage Returns<br />
                                                8. Manage Distributors<br />
                                                9. Manage Retailers<br />
                                                10. Assets Management<br />
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="card features">
                                <div class="card-body">
                                    <div class="media">
                                        <span class="ti-lock gradient-fill ti-3x mr-3"></span>
                                        <div class="media-body">
                                            <h4 class="card-title">Inventory ..</h4>
                                            <p class="card-text">
                                                11. Warehouses<br />
                                                12. Multi-Location Inventory Control<br />
                                                14. Multiple Stock Valuation methods<br />
                                                15. Batch/Size wise Stock Control<br />
                                                16. Negative Stock checking<br />
                                                17. User defined BARCODE generation<br />
                                                18. Auto order generation and order processing<br />
                                                19. Pricing management based on item<br />
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="card features">
                                <div class="card-body">
                                    <div class="media">
                                        <span class="ti-face-smile gradient-fill ti-3x mr-3"></span>
                                        <div class="media-body">
                                            <h4 class="card-title">Accounting & Finance</h4>
                                            <p class="card-text">
                                                1. Finance System Configuration<br />
                                                2. Multi Level Chart of Accounts<br />
                                                3. Multi Fiscal Periods<br />
                                                4. General Ledgers<br />
                                                5. Account Payable<br />
                                                6. Account Receivables<br />
                                                7. Audit Control<br />
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="card features">
                                <div class="card-body">
                                    <div class="media">
                                        <span class="ti-settings gradient-fill ti-3x mr-3"></span>
                                        <div class="media-body">
                                            <h4 class="card-title">Document Archiving</h4>
                                            <p class="card-text">
                                                1. Keep important files on the cloud <br />
                                                2. Organize by folders <br />
                                                3. Keeps File Versions <br />
                
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="card features">
                                <div class="card-body">
                                    <div class="media">
                                        <span class="ti-lock gradient-fill ti-3x mr-3"></span>
                                        <div class="media-body">
                                            <h4 class="card-title">System Administration</h4>
                                            <p class="card-text">
                                                1. Default Configuration<br />
                                                2. User Accounts & Groups<br />
                                                3. Role Based Privileges<br />
                                                4. Role Based Menu Access<br />
                                                5. User"s Communications<br />
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br />
                </div>
                
                
                
                </div>
                <div class="section">
                
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-6">
                            <div class="box-icon"><span class="ti-mobile gradient-fill ti-3x"></span></div>
                            <h2>Mobile Friendly</h2>
                            <p class="mb-4">
                                Zaratica also works good on Mobile devices. The mobile friendly User Interface (UI) makes it accessable on almost any mobile device.
                            </p>
                        </div>
                    </div>
                    <div class="perspective-phone">
                        <img src="{{asset("webfront/t1/images/perspective.png")}}" alt="perspective phone" class="img-fluid">
                    </div>
                </div>
                
                </div>
                
                
                <div class="section light-bg">
                <div class="container">
                    <div class="section-title">
                        <small>FEATURES</small>
                        <h3>Do more with our app</h3>
                    </div>
                
                    <ul class="nav nav-tabs nav-justified" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#communication">Communication</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#schedule">Scheduling</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#messages">Messages</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#livechat">Live Chat</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="communication">
                            <div class="d-flex flex-column flex-lg-row">
                                <img src="images/graphic.png" alt="graphic" class="img-fluid rounded align-self-start mr-lg-5 mb-5 mb-lg-0">
                                <div>
                
                                    <h2>Communicate with ease</h2>
                                    <p class="lead">Uniquely underwhelm premium outsourcing with proactive leadership skills. </p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer rutrum, urna eu pellentesque pretium, nisi nisi fermentum enim, et sagittis dolor nulla vel sapien. Vestibulum sit amet mattis ante. Ut placerat dui eu nulla
                                        congue tincidunt ac a nibh. Mauris accumsan pulvinar lorem placerat volutpat. Praesent quis facilisis elit. Sed condimentum neque quis ex porttitor,
                                    </p>
                                    <p> malesuada faucibus augue aliquet. Sed elit est, eleifend sed dapibus a, semper a eros. Vestibulum blandit vulputate pharetra. Phasellus lobortis leo a nisl euismod, eu faucibus justo sollicitudin. Mauris consectetur, tortor
                                        sed tempor malesuada, sem nunc porta augue, in dictum arcu tortor id turpis. Proin aliquet vulputate aliquam.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="schedule">
                            <div class="d-flex flex-column flex-lg-row">
                                <div>
                                    <h2>Scheduling when you want</h2>
                                    <p class="lead">Uniquely underwhelm premium outsourcing with proactive leadership skills. </p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer rutrum, urna eu pellentesque pretium, nisi nisi fermentum enim, et sagittis dolor nulla vel sapien. Vestibulum sit amet mattis ante. Ut placerat dui eu nulla
                                        congue tincidunt ac a nibh. Mauris accumsan pulvinar lorem placerat volutpat. Praesent quis facilisis elit. Sed condimentum neque quis ex porttitor,
                                    </p>
                                    <p> malesuada faucibus augue aliquet. Sed elit est, eleifend sed dapibus a, semper a eros. Vestibulum blandit vulputate pharetra. Phasellus lobortis leo a nisl euismod, eu faucibus justo sollicitudin. Mauris consectetur, tortor
                                        sed tempor malesuada, sem nunc porta augue, in dictum arcu tortor id turpis. Proin aliquet vulputate aliquam.
                                    </p>
                                </div>
                                <img src="images/graphic.png" alt="graphic" class="img-fluid rounded align-self-start mr-lg-5 mb-5 mb-lg-0">
                            </div>
                        </div>
                        <div class="tab-pane fade" id="messages">
                            <div class="d-flex flex-column flex-lg-row">
                                <img src="images/graphic.png" alt="graphic" class="img-fluid rounded align-self-start mr-lg-5 mb-5 mb-lg-0">
                                <div>
                                    <h2>Realtime Messaging service</h2>
                                    <p class="lead">Uniquely underwhelm premium outsourcing with proactive leadership skills. </p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer rutrum, urna eu pellentesque pretium, nisi nisi fermentum enim, et sagittis dolor nulla vel sapien. Vestibulum sit amet mattis ante. Ut placerat dui eu nulla
                                        congue tincidunt ac a nibh. Mauris accumsan pulvinar lorem placerat volutpat. Praesent quis facilisis elit. Sed condimentum neque quis ex porttitor,
                                    </p>
                                    <p> malesuada faucibus augue aliquet. Sed elit est, eleifend sed dapibus a, semper a eros. Vestibulum blandit vulputate pharetra. Phasellus lobortis leo a nisl euismod, eu faucibus justo sollicitudin. Mauris consectetur, tortor
                                        sed tempor malesuada, sem nunc porta augue, in dictum arcu tortor id turpis. Proin aliquet vulputate aliquam.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="livechat">
                            <div class="d-flex flex-column flex-lg-row">
                                <div>
                                    <h2>Live chat when you needed</h2>
                                    <p class="lead">Uniquely underwhelm premium outsourcing with proactive leadership skills. </p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer rutrum, urna eu pellentesque pretium, nisi nisi fermentum enim, et sagittis dolor nulla vel sapien. Vestibulum sit amet mattis ante. Ut placerat dui eu nulla
                                        congue tincidunt ac a nibh. Mauris accumsan pulvinar lorem placerat volutpat. Praesent quis facilisis elit. Sed condimentum neque quis ex porttitor,
                                    </p>
                                    <p> malesuada faucibus augue aliquet. Sed elit est, eleifend sed dapibus a, semper a eros. Vestibulum blandit vulputate pharetra. Phasellus lobortis leo a nisl euismod, eu faucibus justo sollicitudin. Mauris consectetur, tortor
                                        sed tempor malesuada, sem nunc porta augue, in dictum arcu tortor id turpis. Proin aliquet vulputate aliquam.
                                    </p>
                                </div>
                                <img src="{{asset("webfront/t1/images/graphic.png")}}" alt="graphic" class="img-fluid rounded align-self-start mr-lg-5 mb-5 mb-lg-0">
                            </div>
                        </div>
                    </div>
                
                
                </div>
                </div>
                
                <div class="section light-bg">
                
                <div class="container">
                    <div class="section-title">
                        <small>How to Get Started</small>
                        <h3>Do more with Zaratica</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <ul class="list-unstyled ui-steps">
                                <li class="media">
                                    <div class="circle-icon mr-4">1</div>
                                    <div class="media-body">
                                        <h5>Create an Account</h5>
                                        <p>
                                            Create an account on the zaratica cloud.
                                        </p>
                                    </div>
                                </li>
                                <li class="media my-4">
                                    <div class="circle-icon mr-4">2</div>
                                    <div class="media-body">
                                        <h5>Upload Logo and Details</h5>
                                        <p>
                                            Upload your business Logo and other details and you are one step clouser to your personlaize online cloud erp application
                                        </p>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="circle-icon mr-4">3</div>
                                    <div class="media-body">
                                        <h5>Choose a subscription pacakge</h5>
                                        <p>
                                            Select your subscription and you are good to go.
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <img src="{{asset("webfront/t1/images/iphonex.png")}}" alt="iphone" class="img-fluid">
                        </div>
                
                    </div>
                
                </div>
                
                </div>
                <!-- // end .section -->
                
                
                <div class="section">
                <div class="container">
                    <div class="section-title">
                        <small>TESTIMONIALS</small>
                        <h3>What our Customers Says</h3>
                    </div>
                
                    <div class="testimonials owl-carousel">
                        <div class="testimonials-single">
                            <img src="images/client.png" alt="client" class="client-img">
                            <blockquote class="blockquote">Uniquely streamline highly efficient scenarios and 24/7 initiatives. Conveniently embrace multifunctional ideas through proactive customer service. Distinctively conceptualize 2.0 intellectual capital via user-centric partnerships.</blockquote>
                            <h5 class="mt-4 mb-2">Crystal Gordon</h5>
                            <p class="text-primary">United States</p>
                        </div>
                        <div class="testimonials-single">
                            <img src="images/client.png" alt="client" class="client-img">
                            <blockquote class="blockquote">Uniquely streamline highly efficient scenarios and 24/7 initiatives. Conveniently embrace multifunctional ideas through proactive customer service. Distinctively conceptualize 2.0 intellectual capital via user-centric partnerships.</blockquote>
                            <h5 class="mt-4 mb-2">Crystal Gordon</h5>
                            <p class="text-primary">United States</p>
                        </div>
                        <div class="testimonials-single">
                            <img src="images/client.png" alt="client" class="client-img">
                            <blockquote class="blockquote">Uniquely streamline highly efficient scenarios and 24/7 initiatives. Conveniently embrace multifunctional ideas through proactive customer service. Distinctively conceptualize 2.0 intellectual capital via user-centric partnerships.</blockquote>
                            <h5 class="mt-4 mb-2">Crystal Gordon</h5>
                            <p class="text-primary">United States</p>
                        </div>
                    </div>
                
                </div>
                
                </div>
                <!-- // end .section -->
                
                
                <div class="section light-bg" id="gallery">
                <div class="container">
                    <div class="section-title">
                        <small>GALLERY</small>
                        <h3>App Screenshots</h3>
                    </div>
                
                    <div class="img-gallery owl-carousel owl-theme">
                        <img src="{{asset("webfront/t1/images/screen1.jpg")}}" alt="image">
                        <img src="{{asset("webfront/t1/images/screen2.jpg")}}" alt="image">
                        <img src="{{asset("webfront/t1/images/screen3.jpg")}}" alt="image">
                        <img src="{{asset("webfront/t1/images/screen1.jpg")}}" alt="image">
                    </div>
                
                </div>
                
                </div>
                
                <div class="section" id="plans">
                <div class="container">
                    <div class="section-title">
                        <small>PRICING</small>
                        <h3>Choose a subscription plan</h3>
                    </div>
                
                    <div class="card-deck">
                        <div class="card pricing">
                            <div class="card-head">
                                <small class="text-primary">BASIC</small>
                                <span class="price">$4<sub>/m</sub></span>
                            </div>
                            <ul class="list-group list-group-flush">
                                <div class="list-group-item">10 Products</div>
                                <div class="list-group-item">100 Invoices</div>
                                <div class="list-group-item">Basic Support</div>
                                <div class="list-group-item"><del>Collaboration</del></div>
                                <div class="list-group-item"><del>Reports and analytics</del></div>
                            </ul>
                            <div class="card-body">
                                <a href="#" class="btn btn-primary btn-lg btn-block">Choose this Plan</a>
                            </div>
                        </div>
                        <div class="card pricing popular">
                            <div class="card-head">
                                <small class="text-primary">PREOFESSIONAL</small>
                                <span class="price">$14<sub>/m</sub></span>
                            </div>
                            <ul class="list-group list-group-flush">
                                <div class="list-group-item">Unlimited Products</div>
                                <div class="list-group-item">Unlimited Invoices</div>
                                <div class="list-group-item">Priority Support</div>
                                <div class="list-group-item">Collaboration</div>
                                <div class="list-group-item">Reports and analytics</div>
                            </ul>
                            <div class="card-body">
                                <a href="#" class="btn btn-primary btn-lg btn-block">Choose this Plan</a>
                            </div>
                        </div>
                        <div class="card pricing">
                            <div class="card-head">
                                <small class="text-primary">ENTERPRISE</small>
                                <span class="price">$25<sub>/m</sub></span>
                            </div>
                            <ul class="list-group list-group-flush">
                                <div class="list-group-item">Unlimited Projects</div>
                                <div class="list-group-item">Unlimited Storage</div>
                                <div class="list-group-item">Collaboration</div>
                                <div class="list-group-item">Inventory Management</div>
                                <div class="list-group-item">Accounting and Finance</div>
                                <div class="list-group-item">Reports and analytics</div>
                            </ul>
                            <div class="card-body">
                                <a href="#" class="btn btn-primary btn-lg btn-block">Choose this Plan</a>
                            </div>
                        </div>
                    </div>
                
                
                </div>
                
                </div>
                
                
                <div class="section pt-0">
                <div class="container">
                    <div class="section-title">
                        <small>FAQ</small>
                        <h3>Frequently Asked Questions</h3>
                    </div>
                
                    <div class="row pt-4">
                        <div class="col-md-6">
                            <h4 class="mb-3">Can I try before I buy?</h4>
                            <p class="light-font mb-5">
                                Yes. in order to try it before you buy you need to request for a demo account. We will provide you the demo account details via email.
                            </p>
                
                        </div>
                        <div class="col-md-6">
                            <h4 class="mb-3">Can I change my plan later?</h4>
                            <p class="light-font mb-5">
                                Yes you can upgrade or downgrade a plan any time you like.
                            </p>
                            <h4 class="mb-3">Can we have a dedicated instance of the Application?</h4>
                            <p class="light-font mb-5">
                                For Enterprise users with just a little extra a month you can have your own Zaratica Instance.
                            </p>
                
                        </div>
                    </div>
                </div>
                
                </div>', 
                'footer' =>'<!-- start section  -->
                <div class="section bg-gradient">
                    <div class="container">
                        <div class="call-to-action">
                            <div class="box-icon"><span class="ti-mobile gradient-fill ti-3x"></span></div>
                            <h2>Acess it from Anywhere</h2>
                            <p class="tagline">Available for all major browsers on mobile and desktop platforms. Rapidiously visualize optimal ROI rather
                                than enterprise-wide methods of empowerment. </p>
                            <p class="text-primary"><small><i>*Works on Safari, Google Chrome, firefox and many more. </i></small></p>
                        </div>
                    </div>
                </div>
                <!-- // end .section -->
                <div class="light-bg py-5" id="contact">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 text-center text-lg-left">
                                <p class="mb-2"> <span class="ti-location-pin mr-2"></span> Office No.1, Smart Electronics Plaza, Sakhakot, Malakand KP, Pakistan</p>
                                <div class=" d-block d-sm-inline-block">
                                    <p class="mb-2">
                                        <span class="ti-email mr-2"></span> <a class="mr-4" href="mailto:support@zorkif.com">support@zorkif.com</a>
                                    </p>
                                </div>
                                <div class="d-block d-sm-inline-block">
                                    <p class="mb-0">
                                        <span class="ti-headphone-alt mr-2"></span> <a href="tel:+92 331 9195103">+92 331 9195103</a>
                                    </p>
                                </div>
                
                            </div>
                            <div class="col-lg-6">
                                <div class="social-icons">
                                    <a href="#"><span class="ti-facebook"></span></a>
                                    <a href="#"><span class="ti-twitter-alt"></span></a>
                                    <a href="#"><span class="ti-instagram"></span></a>
                                </div>
                            </div>
                        </div>
                
                    </div>
                
                </div>
                <footer class="my-5 text-center">
                    <!-- Copyright removal is not prohibited! -->
                    <p class="mb-2"><small>COPYRIGHT © 2022. ALL RIGHTS RESERVED. ZARATICA BY <a href="https://Zorkif.com">Zorkif.com</a></small></p>
                </footer>', 
                'unique_url_code' => $unique_url==null?substr(md5(rand()), 0, 15):$unique_url, 'product_template' => 'dummy', 'company_id' => $company_id
            ]
        );
    }
    // create landing page for register user end

}

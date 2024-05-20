@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/subscriptions/css/subscriptions.css')}}">
@endSection
@section('body_content')
<div class="row">
    <div class="col-md-12">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @if(session('status'))
                    <div class="mb-3 col-md-12">
                        <div class="alert alert-success   text-white user_updated_msg" role="alert">
                            {{session('status')}}
                            <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                        </div>
                    </div>

                    @endif
                </div>


                <!-- plans start ---------------------------------------------------------------------------------- -->
                @foreach($subscription_packages as $company_package)

                <div class="col-md-6">
                    <div class="card text-center">
                        <div class="card-header">
                            {{$company_package->package_name}}
                        </div>
                        <div class="card-body">
                            <!-- form -->
                            <form action="" id="company_subscription">
                                <input type="hidden" name="package_id" id="package_id" value="{{$company_package->package_id}}">

                                <!-- shwing package start -->
                                <div class="container-fluid">
                                    <div class="row text-start">
                                        <!-- no of users  -->
                                        <div class="col-md-6 mb-4 ">
                                            Allowed Users {{$company_package->allowed_users}}

                                        </div>
                                        <!-- no of products -->
                                        <div class="col-md-6 mb-4 ">
                                            Allowed Products {{$company_package->allowed_products == '-1'?"unlimited":""}}
                                        </div>
                                        <!-- no of customers -->
                                        <div class="col-md-6 mb-3 ">
                                            Allowed Customers {{$company_package->allowed_customers == '-1'?"unlimited":""}}
                                        </div>
                                        <!-- no of suppliers -->
                                        <div class="col-md-6 mb-4 ">
                                            Allowed Suppliers {{$company_package->allowed_suppliers == '-1'?"unlimited":""}}
                                        </div>
                                        <!-- no of purchase orders -->
                                        <div class="col-md-6 mb-4 ">
                                            Allowed purchase orders {{$company_package->allowed_purchaseorders == '-1'?"unlimited":""}}
                                        </div>
                                        <!-- no of sales invoices -->
                                        <div class="mb-4 col-md-6">
                                            Allowed salesInvoice {{$company_package->allowed_salesinvoices == '-1'?"unlimited":""}}
                                        </div>
                                        <!-- no of accounts-->
                                        <div class="mb-4 col-md-6">
                                            Allowed Accounts {{$company_package->allowed_accounts == '-1'?"unlimited":""}}
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" id="subscribe_plan_btn" class="btn bg-gradient-dark w-100 my-4 mb-2">Send Request</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- shwing package  end-->
                            </form>
                            <!-- form -->
                        </div>
                    </div>
                </div>

                @endforeach
                <!---------------------------------------------------------------------------------- plans  end-->
                <!-- hisrtory start  -->
                <div class="col-md-12">
                    <div class="subscription_history mt-4">
                        <div class="card">
                            <div class="card-header">
                                Subscription History
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">First</th>
                                            <th scope="col">Last</th>
                                            <th scope="col">Handle</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>@mdo</td>
                                        </tr>

                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>
                </div>

                <!-- hisrtory end  -->
            </div>
        </div>


    </div>
</div>

@endSection
@section('page_script_links')
<script>
    $(document).ready(function () {
        @php
    $baseUrl = config('app.url');
    echo "var base_url = '".$baseUrl.
    "';";
    @endphp

    $(function(){
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $('#company_subscription').on('submit',function(e){
            e.preventDefault();
            $.ajax({
                type: "post",
                url: base_url+"add_company_subs",
                data: $('#company_subscription').serialize(),
                success: function (response) {
                    // alert(response);
                    console.log(response);
                }
            });
        })
    })

    

    
    
});
</script>
@endSection
@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/sale/css/sal_pos_detail.css')}}">
@endSection
@section('body_content')
<div class="row">
    <div class="col-md-12">

        <form action="" id="user_added_form" >
            @csrf
            <input type="hidden" name="remember_token" id="remember_token">

            <div class="container-fluid profile">
                <div class="row gy-4 profile_row">
<!--  lable div end  -->
<div class="col-md-12">
    <div class="parent">
        <div class="row position-relative">
            <div class="col-md-4">
                <h5 class="">Transactions History</h5>
            </div>
            <div class="col-md-8 col-8 d-flex justify-content-end">
                <button type="button"
                    class="btn btn-sm bg-primary print_button letter-spacing text-white"
                    data-id="{{$cashRegister->id}}"><i
                        class="fas fa-print"></i> print</button>
            </div>
            <div class="col-md-8 col-12 msg">
                <div class="alert alert-success d-none  text-white waitMessage"
                    role="alert" id="waitMessage">
                    Please wait..........request processing
                    <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                </div>
            </div>



        </div>
    </div>
</div>
<!-- lable div end  -->
                    <!-- lable div end  -->
                    @php 
                    $invoiceInc = 0 ;
                    @endphp
                    

                    @foreach($cashRegister->transactions as $transaction)

                    <!-- user information start  -->
                    <div class="col-md-12">

                        <div class="parent">
                            <h5 class="">Invoice : {{$transaction->invoice->ref_num}}</h5>
                            <div class="row gy-3">



                                <!-- content here  -->
                                <div class="col-md-6">

                                    <div class="primary_blue">Bill To </div>
                                    <div class="fw-bold" >Name :<span class="fw-normal">{{$transaction->invoice->user->username}} </span></div>
                                    <div class="fw-bold" >Email : <span class="fw-normal">{{$transaction->invoice->user->email}}</span></div>
                                    <div class="fw-bold" >Contact : <span class="fw-normal">{{$transaction->invoice->user->contact_number}}</span> </div>
                                    <div class="fw-bold" >Gender : <span class="fw-normal">{{$transaction->invoice->user->gender}}</span> </div>
                                    <div class="fw-bold" >Address :  <span class="fw-normal">{{$transaction->invoice->user->address}}</span></div>
                                    <div class="fw-bold" >State :  <span class="fw-normal">{{$transaction->invoice->user->state}}</span></div>

                                </div>
                                <div class="col-md-6">

                                    <div>{!! json_decode( $transaction->invoice->qr_code_string) !!} </div>
                                    <div class="fw-bold mt-2" >QR code  :<span class="fw-normal">{{$transaction->invoice->qr_code}} </span></div>

                                    @if($transaction->invoice->invoice_status =='approved')
                                    <div class="fw-bold">Invoice status : <span class="badge bg-success">Paid</span> </div>
                                    @else
                                    <div class="fw-bold">Invoice status : <span class="badge bg-danger">Un Paid</span> </div>

                                    @endif
                                    
                                    
                                    <div class="fw-bold">  creation date : <span class="fw-normal"> {{ date('d-m-Y', strtotime($transaction->invoice->created_at)) }}   </span>  </div>


                                </div>

                                <!-- product start  -->
                                <div class="col-md-12">
                                    <div class="container-fluid product_container p-0">
                                        <div class="table-container">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Product Name </th>
                                                        <th scope="col">Description</th>
                                                        <th scope="col">Rate</th>
                                                        <th scope="col">Qty</th>

                                                        <th scope="col">Taxes </th>
                                                        <th scope="col">Taxes Value </th>
                                                        <th scope="col">Disc</th>
                                                        <th scope="col">Sub Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php 
                                                    $i =0;
                                                    @endphp
                                                    @foreach($transaction->invoice->details as $detail)
                                                    <tr>
                                                        <td>{{$detail->product->product_name}}</td>
                                                        <td>{{$detail->product->product_description}}</td>
                                                        <td>{{$detail->unit_price}}</td>
                                                        <td>{{$detail->quantity}}</td>
                                                        @if($detail->pro_taxes =="NULL")
                                                        <td>No taxes</td>
                                                        @else
                                                        <td>{{$detail->pro_taxes}}</td>
                                                        @endif
                                                        <td> {{implode(',', $taxesAll[$invoiceInc][$i])}}</td>
                                                        <td>{{$detail->discount}}</td>
                                                        <td>{{$detail->sub_total}}</td>
                                                    </tr>
                                                    @php 
                                                    $i++;
                                                    @endphp
                                                    @endforeach
                                                    <!-- Add more rows as needed -->
                                                </tbody>
                                                <tfoot>
                                                    <tr class="subtotal" >
                                                        <td colspan="7">Total Taxes</td>
                                                            <td>{{$taxesPerInvoiceArray[$invoiceInc] . '%'}}</td> 
                                                    </tr>
                                                    <tr class="subtotal">
                                                        
                                                        <td colspan="7">Total</td>
                                                        <td>{{$subTotalPerInvoiceArray[$invoiceInc]}}</td> 
                                                    </tr>
                                                    
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- product end  -->

                                <!-- transaction footer starts  -->
                                
                                <!-- transaction footer end  -->
                                


                                <!-- content here  -->







                            </div>
                        </div>
                    </div>
                    <!-- user information end  -->
                    @php 
                    $invoiceInc++;
                    @endphp 
                    
                    @endforeach

                    <div class="col-md-12">
                        <div class="parent">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-end">
                                    <h5 class="heading_size" id="heading_size"> Transactions Amount : {{$transactionsAmount}}</h5>
                                </div>
                                </div>

                                

                            </div>
                        </div>
                    </div>






                </div>
            </div>

        </form>







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

        //  base_url = "http://127.0.0.1:8000/";
        $("#gender").select2({
            // dropdownParent: $('#register_form'),
            // dropdownCssClass:'increasezindex',
            placeholder: "Select gender",
            allowClear: true,
            width: "100%",
        });
        // martial status
        $("#company_id").select2({
            placeholder: "Select company",
            allowClear: true,
            width: "100%",
        });
        // martial company_id
        $("#marital_status").select2({
            placeholder: "Martial status",
            allowClear: true,
            width: "100%",
        });
        // country id
        $("#country_id").select2({
            placeholder: "Select Country",
            allowClear: true,
            width: "100%",
        });
        // ui_lang
        $("#ui_language").select2({
            placeholder: "Select Language",
            allowClear: true,
            width: "100%",
        });
        // ui_lang
        $("#user_type").select2({
            placeholder: "User type",
            allowClear: true,
            width: "100%",
        });
        // positon id
        $("#position_id").select2({
            placeholder: "Position",
            allowClear: true,
            width: "100%",
        });
        //deapartment   id
        $("#department_id").select2({
            placeholder: "Department",
            allowClear: true,
            width: "100%",
        });
        //blood group
        $("#blood_group").select2({
            placeholder: "Bloo group",
            allowClear: true,
            width: "100%",
        });

        //
        // add users start
        $("#user_added_form").validate({
            rules: {
                username: {
                    required: true,
                    // remote:base_url+'register_user'
                    remote: {
                        url: base_url + "is_exist_user_name",
                        type: "post",
                        data: {
                            username: function () {
                                return $("#username").val();
                            },
                            user_id: function () {
                                return $("#user_id").val();
                            },
                            _token: $('meta[name="csrf-token"]').attr("content"),
                        },
                    },
                },
                first_name: {
                    required: true,
                },
                last_name: {
                    required: true,
                },
                phone_number: {
                    required: true,
                    number: true,
                    maxlength: 15,
                },
                email: {
                    required: true,
                    email: true,
                    remote: {
                        url: base_url + "is_exist_email",
                        type: "post",
                        data: {
                            email: function () {
                                return $("#email").val();
                            },
                            user_id: function () {
                                return $("#user_id").val();
                            },
                            _token: $('meta[name="csrf-token"]').attr("content"),
                        },
                    },
                },
                password: {
                    required: true,
                },


                user_type: {
                    required: true,
                },
            },
            messages: {
                username: {
                    required: "Please Enter Your name",
                    remote: "an account with this user name already exist",
                },
                first_name: {
                    required: "Enter First Name",
                },
                last_name: {
                    required: "Enter Last Name",
                },
                phone_number: {
                    required: "Contact required",
                    number: "Only numbers are allowed",
                    maxlength: "Length should be less than 15 charactor",
                },
                email: {
                    required: "Email Required",
                    email: "Please enter a valid Email",
                    remote: "Email already register",
                },
                password: {
                    required: "Password Required",
                },



                user_type: {
                    required: "User Type Required",
                },
            },
            submitHandler: function (form) {
                $.ajax({
                    type: "post",
                    url: base_url + "users",
                    data: new FormData(form),
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        // alert(response);
                        // console.log( response);
                        if (response == 1) {
                            // alert("user updated successfully")
                            // $('.update_msg').removeClass("d-none");
                            $("#user_added_form").trigger("reset");
                            $(".user_updated_msg").removeClass("d-none");
                            window.scrollTo(0, 0)
                        }
                    },
                });
            },
        });
        // add users end




        // hide select error when the field is selected start 

        $('#user_type').on('change', function (param) {
            let user_type_value = $(this).val();
            if (user_type_value == "") {

                $('#user_type-error').removeClass('d-none') // label
            } else {
                $('#user_type-error').addClass('d-none') // label

            }
        })

        $('#marital_status').on('change', function (param) {
            let marital_status_value = $(this).val();
            if (marital_status_value == "") {

                $('#marital_status-error').removeClass('d-none') // label
            } else {
                $('#marital_status-error').addClass('d-none') // label

            }
        })


        $('#ui_language').on('change', function (param) {
            let uiLanguageValue = $(this).val();
            if (uiLanguageValue == "") {

                $('#ui_language-error').removeClass('d-none') // label
            } else {
                $('#ui_language-error').addClass('d-none') // label

            }
        })


        $('#blood_group').on('change', function (param) {
            let bloodGroupValue = $(this).val();
            if (bloodGroupValue == "") {

                $('#blood_group-error').removeClass('d-none') // label
            } else {
                $('#blood_group-error').addClass('d-none') // label

            }
        })
        // hide select error when the field is selected end 


          //  crm lead details print start
          $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click', '.print_button', function() {
                // alert($(this).data('user_id'))
                let id = $(this).data('id')
                
                $.ajax({
                    type: "post",
                    url: base_url + "cash_register_url",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {

                        $('.waitMessage').removeClass('d-none')
                        if ($('#emp_details_iframe').length === 0) {
                            let iframe = document.createElement('iframe')
                            iframe.setAttribute('id', "emp_details_iframe")
                            iframe.setAttribute('class', "d-none")
                            iframe.setAttribute('src', response)
                            $('body').append(iframe)
                            iframe.onload = function(param) {
                                $('.waitMessage').addClass('d-none')
                                iframe.contentWindow.print();
                            }
                        } else {
                            let iframe = $('#emp_details_iframe')[0]
                            //   iframe.setAttribute('src', "data:application/pdf;base64," + response)
                            iframe.setAttribute('src', response)
                            iframe.onload = function(param) {
                                $('.waitMessage').addClass('d-none')
                                iframe.contentWindow.print();
                            }
                        }
                    }
                });

            })

            // crm lead details print end 












    });
</script>
@endSection
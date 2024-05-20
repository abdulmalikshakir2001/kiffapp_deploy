@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/create_update_user/css/create_user.css')}}">
<link rel="stylesheet" href="{{asset('dashboard_assets/hrm/css/hrm_employee_details.css')}}">
@endSection
@section('body_content')
<div class="row">
    <div class="col-md-12">
        <form action="" id="user_update_form">
            @csrf
            <input disabled type="hidden" name="user_id" id="user_id" value="{{$single_user->user_id}}">
            <input disabled type="hidden" name="remember_token" id="remember_token" value="{{csrf_token() }}">

            <div class="container-fluid profile">
                <div class="row gy-4 profile_row">
                    <!--  lable div end  -->
                    <div class="col-md-12">
                        <div class="parent">

                            <div class="row position-relative">
                                <div class="col-md-4 col-4">
                                    <h5 class="">Employee Details</h5>
                                </div>
                                <div class="col-md-8 col-8 d-flex justify-content-end">
                                    <button type="button" class="btn btn-sm bg-primary print_employee_details letter-spacing text-white" data-user_id="{{$single_user->user_id}}"><i class="fas fa-print"></i> print</button>
                                </div>
                                <div class="col-md-8 col-12 msg">
                                    <div class="alert alert-success d-none text-white user_updated_msg" role="alert" id="user_update_msg">
                                        Please wait..........request processing
                                        <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>
                    <!-- lable div end  -->




                    <!-- user information start  -->
                    <div class="col-md-8">
                        <div class="parent">
                            <h5 class="">User Information</h5>
                            <div class="row gy-3">

                                <div class="col-md-6">
                                    <label for="">User Name</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="User Name" aria-label="User Name" name="username" id="username" value="{{$single_user->username}}" disabled>
                                </div>

                                <div class="col-md-6">
                                    <label for="">First Name</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="First Name" aria-label="First Name" name="first_name" id="first_name" value="{{$single_user->first_name}}">
                                </div>

                                <div class="col-md-6">
                                    <label for="">Middle Name</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Middle name" aria-label="Middle name" name="middle_names" id="middle_names" value="{{$single_user->middle_names}}">
                                </div>

                                <div class="col-md-6">
                                    <label for="">Last Name</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Last Name" aria-label="Last Name" name="last_name" id="last_name" value="{{$single_user->last_name}}">
                                </div>


                                <div class="col-md-6">
                                    <label for="">Mobile Number</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Mobile Number" aria-label="Mobile number" name="mobile_number" id="mobile_number" value="{{$single_user->mobile_number}}">

                                </div>

                                <div class="col-md-6">
                                    <label for="">Phone Number</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Phone number" aria-label="Phone number" name="phone_number" id="phone_number" value="{{$single_user->phone_number}}">

                                </div>

                                <div class="col-md-6">
                                    <label for="">Email</label>
                                    <input disabled type="email" class="form-control input_diabled" placeholder="Email" aria-label="Email" name="email" id="email" value="{{$single_user->email}}">

                                </div>

                                <div class="col-md-6">
                                    <label for="">Date Of Birth</label>
                                    <input disabled type="date" class="form-control input_diabled" placeholder="" aria-label="dateOfBirth" name="dob" id="dob" value="{{$single_user->dob}}">

                                </div>

                                <div class="col-md-6 form-check">
                                    <input disabled class="form-check-input" type="checkbox" id="is_active" name="is_active" {{$single_user->is_active=='1'?'checked':''}}>
                                    <label class="form-check-label " for="is_active" style="opacity:1 !important">
                                        is active ?
                                    </label>
                                </div>

                                <div class="col-md-6 form-check">
                                    <input disabled class="form-check-input" type="checkbox" id="allow_login" name="allow_login" {{$single_user->allow_login=='1'?'checked':''}}>
                                    <label class="form-check-label" for="allow_login" style="opacity:1 !important">
                                        Allowed Login
                                    </label>

                                </div>



                            </div>
                        </div>
                    </div>
                    <!-- user information end  -->

                    <!-- profile photo start  -->
                    <div class="col-md-4">
                        <div class="parent h-100">
                            <h5 class="">Employee Photo</h5>
                            <div class="row gy-4">

                                <div class="col-md-12">
                                    @if($single_user->profile_logo)
                                    <img src="{{asset('storage/profile_logo/'.$single_user->profile_logo)}}" alt="" width="100%" height="200px" style="border-radius:10px;">
                                    @else
                                    <img src="{{asset('storage/profile_logo/default.png')}}" alt="" width="100%" height="200px" style="border-radius:10px;">

                                    @endif



                                </div>



                            </div>
                        </div>
                    </div>
                    <!-- profile photo end  -->


                    <!-- Address start  -->
                    <div class="col-md-12">
                        <div class="parent">
                            <h5 class="">Location Information</h5>
                            <div class="row gy-3">

                                <div class="col-md-4">
                                    <label for="">Address</label>
                                    <textarea disabled name="address" id="" cols="" rows="1" id="address" placeholder="Address" class="form-control input_diabled">{{$single_user->address}}</textarea>
                                </div>

                                <div class="col-md-4">
                                    <label for="">Zip code</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Zip Code" aria-label="Zip code" name="zip_code" id="zip_code" value="{{$single_user->zip_code}}">
                                </div>

                                <div class="col-md-4">
                                    <label for="">City</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="City" aria-label="City" name="city" id="city" value="{{$single_user->city}}">
                                </div>

                                <div class="col-md-4">
                                    <label for="">State</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="State/Province" aria-label="State" name="state" id="state" value="{{$single_user->state}}">

                                </div>
                                <div class="col-md-4">
                                    <label for="">Land mark</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Landmark" aria-label="landmark" name="landmark" id="landmark" value="{{$single_user->landmark}}">
                                </div>

                                <div class="col-md-4">
                                    <label for="">Country </label>
                                    <select disabled name="country_id" id="country_id" class="form-select country_id">
                                        <option></option>
                                        @foreach($countries as $country)
                                        <option value="{{$country->country_id}}" {{$single_user->country_id==$country->country_id?'selected':''}}>{{$country->country}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Address end  -->
                    <!-- employee information start  -->
                    <div class="col-md-12">
                        <div class="parent">
                            <h5 class="">Employee Information</h5>
                            <div class="row gy-3">

                                <div class="col-md-4">
                                    <label for="">Employee No</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Employee no" aria-label="Employee no" name="employee_no" id="employee_no" value="{{$single_user->employee_no}}">
                                </div>

                                <div class="col-md-4">
                                    <label for="">Basic Salary</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Basic Salary" aria-label="Basic Salary" name="basic_salary" id="basic_salary" value="{{$single_user->basic_salary}}">
                                </div>

                                <div class="col-md-4">
                                    <label for="food_allownce">Food Allownce</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Food Allownce" aria-label="Food Allownce" name="food_allownce" id="food_allownce" value="{{$single_user->food_allownce}}">
                                </div>

                                <div class="col-md-4">
                                    <label for="medical_allownce">Medical Allownce</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Medical Allownce" aria-label="Medical Allownce" name="medical_allownce" id="medical_allownce" value="{{$single_user->medical_allownce}}">

                                </div>
                                <div class="col-md-4">
                                    <label for="transport_allownce">Transport Allownce</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Transport Allownce" aria-label="Transport Allownce" name="transport_allownce" id="transport_allownce" value="{{$single_user->transport_allownce}}">
                                </div>

                                <div class="col-md-4">
                                    <label for="other_allownces">Other Allownce</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Other Allownce" aria-label="Other Allownce" name="other_allownces" id="other_allownces" value="{{$single_user->other_allownces}}">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Work Shift</label>
                                    <select disabled name="work_shift_id" id="work_shift_id" class="form-select">
                                        <option></option>
                                        @foreach($work_shifts as $work_shift)
                                        <option value="{{$work_shift->work_shift_id}}" {{$single_user->work_shift_id==$work_shift->work_shift_id?"selected":""}}>{{$work_shift->shift_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- employee information end  -->
                    <!-- More information start   -->
                    <div class="col-md-12">
                        <div class="parent">
                            <h5 class="">More Information</h5>
                            <div class="row gy-3">

                                <div class="col-md-4">
                                    <label for="">Facebook Link</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Fb link" aria-label="Fb link" name="fb_link" id="fb_link" value="{{$single_user->fb_link}}">
                                </div>

                                <div class="col-md-4">
                                    <label for="">Twitter Link</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Twitter link" aria-label="Twitter link" name="twitter_link" id="twitter_link" value="{{$single_user->twitter_link}}">
                                </div>
                                <div class="col-md-4">
                                    <label for="">User Type </label>
                                    <select disabled name="user_type" id="user_type" class="form-select input_diabled user_type">
                                        <option></option>
                                        <option value="Owner" {{ $single_user->user_type == 'Owner' ? 'selected' : '' }}>Owner</option>
                                        <option value="User" {{ $single_user->user_type == 'User' ? 'selected' : '' }}>User</option>


                                        <option value="Employee" {{ $single_user->user_type == 'Employee' ? 'selected' : '' }}> Employee</option>
                                        <option value="Supplier" {{ $single_user->user_type == 'Supplier' ? 'selected' : '' }}> Supplier</option>
                                        <option value="Customer" {{ $single_user->user_type == 'Customer' ? 'selected' : '' }}> Customer</option>
                                        <option value="SupplierCustomer" {{ $single_user->user_type == 'SupplierCustomer' ? 'selected' : '' }}> SupplierCustomer</option>
                                        <option value="ContactOnly" {{ $single_user->user_type == 'ContactOnly' ? 'selected' : '' }}>ContactOnly</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for=""> Language</label>
                                    <select disabled name="ui_language" id="ui_language" class="form-select ui_lang">
                                        <option></option>
                                        <option value="en" {{$single_user->ui_language=="en"?"selected":""}}>English</option>
                                        <option value="ar" {{$single_user->ui_language=="ar"?"selected":""}}>Arabic</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="">Blood Group</label>
                                    <select disabled name="blood_group" id="blood_group" class="form-select blood_group">
                                        <option></option>
                                        <option value="A+" {{$single_user->blood_group=="A+"?"selected":""}}>A+</option>
                                        <option value="A-" {{$single_user->blood_group=="A-"?"selected":""}}>A-</option>
                                        <option value="B-" {{$single_user->blood_group=="B-"?"selected":""}}>B-</option>
                                        <option value="B+" {{$single_user->blood_group=="B+"?"selected":""}}>B+</option>
                                        <option value="AB+" {{$single_user->blood_group=="AB+"?"selected":""}}>AB+</option>
                                        <option value="AB-" {{$single_user->blood_group=="AB-"?"selected":""}}>AB-</option>
                                        <option value="O+" {{$single_user->blood_group=="O+"?"selected":""}}>O+</option>
                                        <option value="O-" {{$single_user->blood_group=="O-"?"selected":""}}>O-</option>
                                        <option value="UnKnown" {{$single_user->blood_group=="UnKnown"?"selected":""}}>Unknown</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="">Marital status</label>
                                    <select disabled name="marital_status" id="marital_status" class="form-select martial_status">
                                        <option></option>
                                        <option value="Single" {{$single_user->marital_status=="Single"?"selected":""}}>Single</option>
                                        <option value="Married" {{$single_user->marital_status=="Married"?"selected":""}}>Married</option>
                                        <option value="Divorced" {{$single_user->marital_status=="Divorced"?"selected":""}}>Divorced</option>
                                        <option value="Widowed" {{$single_user->marital_status=="Widowed"?"selected":""}}>Widowed</option>
                                        <option value="Undisclosed" {{$single_user->marital_status=="Undisclosed"?"selected":""}}>Undisclosed</option>
                                    </select>
                                </div>



                                <div class="col-md-4">
                                    <label for="">Social Media 1</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Social media 1" aria-label="Social media 1" name="social_media_1" id="socail_media_1" value="{{$single_user->social_media_1}}">
                                </div>

                                <div class="col-md-4">
                                    <label for="">Social Media 2</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Social media 2" aria-label="Social media 2" name="social_media_2" id="socail_media_2" value="{{$single_user->social_media_2}}">

                                </div>

                                <div class="col-md-4">
                                    <label for="">Social Media 3</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Social media 3" aria-label="Social media 3" name="social_media_3" id="socail_media_3" value="{{$single_user->social_media_3}}">
                                </div>

                                <div class="col-md-4">
                                    <label for="">Social Media 4</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Social media 4" aria-label="Social media 4" name="social_media_4" id="socail_media_4" value="{{$single_user->social_media_4}}">
                                </div>

                                <div class="col-md-4">
                                    <label for="">Custom Field 1</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Custom Field 1" aria-label="Custom Field 1" name="custom_field_1" id="custom_field_1" value="{{$single_user->custom_field_1}}">
                                </div>

                                <div class="col-md-4">
                                    <label for="">Custom Field 2</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Custom Field 2" aria-label="Custom Field 2" name="custom_field_2" id="custom_field_2" value="{{$single_user->custom_field_2}}">

                                </div>

                                <div class="col-md-4">
                                    <label for="">Custom Field 3</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Custom Field 3" aria-label="Custom Field 3" name="custom_field_3" id="custom_field_3" value="{{$single_user->custom_field_3}}">
                                </div>

                                <div class="col-md-4">
                                    <label for="">Custom Field 4</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Custom Field 4" aria-label="Custom Field 4" name="custom_field_4" id="custom_field_4" value="{{$single_user->custom_field_4}}">

                                </div>


                                <div class="col-md-4">
                                    <label for="">Custom Field 5</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Custom Field 5" aria-label="Custom Field 5" name="custom_field_5" id="custom_field_5" value="{{$single_user->custom_field_5}}">
                                </div>

                                <div class="col-md-4">
                                    <label for="">Custom Field 6</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Custom Field 6" aria-label="Custom Field 6" name="custom_field_6" id="custom_field_6" value="{{$single_user->custom_field_6}}">
                                </div>


                                <div class="col-md-4">
                                    <label for="">Custom Field 7</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Custom Field 7" aria-label="Custom Field 7" name="custom_field_7" id="custom_field_7" value="{{$single_user->custom_field_7}}">
                                </div>

                                <div class="col-md-4">
                                    <label for="">Custom Field 8</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Custom Field 8" aria-label="Custom Field 8" name="custom_field_8" id="custom_field_8" value="{{$single_user->custom_field_8}}">

                                </div>

                                <div class="col-md-4">
                                    <label for="">Custom Field 9</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Custom Field 9" aria-label="Custom Field 9" name="custom_field_9" id="custom_field_9" value="{{$single_user->custom_field_9}}">
                                </div>
                            </div>

                        </div>
                    </div>


                    <!--  More information end   -->
                    <!-- bank details start  -->
                    <div class="col-md-12">
                        <div class="parent">
                            <h5 class="">Bank Details</h5>
                            <div class="row gy-3">

                                <div class="col-md-4">
                                    <label for="">Credit Limit</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Credit limit" aria-label="Credit limit" name="credit_limit" id="credit_limit" value="{{$single_user->credit_limit}}">
                                </div>

                                <div class="col-md-4">
                                    <label for="">Bank Details</label>
                                    <textarea disabled name="bank_details" id="bank_details" cols="" rows="1" placeholder="Bank Details" class="form-control input_diabled">{{$single_user->bank_details}}</textarea>
                                </div>

                                <div class="col-md-4">
                                    <label for="">Tax Number</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Tax number" aria-label="Tax number" name="tax_number" id="tax_number" value="{{$single_user->tax_number}}">
                                </div>



                            </div>
                        </div>
                    </div>

                    <!-- bank details end  -->



                    <!-- button start  -->


                    <!-- button end  -->
                </div>
            </div>

        </form>






    </div>
</div>

@endSection
@section('page_script_links')
<script>
    $(document).ready(function() {

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
        //blood group
        $("#work_shift_id").select2({
            placeholder: "Work Shift",
            allowClear: true,
            width: "100%",
        });

        //
        // add users start
        
        // add users end




        

        // print employee details start 
        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

        $(document).on('click', '.print_employee_details', function() {
            // alert($(this).data('user_id'))
            let user_id = $(this).data('user_id')
            $.ajax({
                type: "post",
                url: base_url + "returnUrl",
                data: {
                    user_id: user_id
                },
                dataType: "json",
                // beforeSend: function() {
                //     $('.user_updated_msg').removeClass('d-none')
                // },
                // complete: function() {
                //     $('.user_updated_msg').addClass('d-none')
                // },
                success: function(response) {
                    // alert(user_id);
                    $('.user_updated_msg').removeClass('d-none')
                    if ($('#emp_details_iframe').length === 0) {
          let iframe = document.createElement('iframe')
          iframe.setAttribute('id', "emp_details_iframe")
          iframe.setAttribute('class', "d-none")
        //   iframe.setAttribute('width', "100%")
        //   iframe.setAttribute('height', "700px")
        //   iframe.setAttribute('src', "data:application/pdf;base64," + response)
          iframe.setAttribute('src',response)
          $('body').append(iframe)
                //   iframe.contentWindow.print();
          iframe.onload = function(param) {
                    $('.user_updated_msg').addClass('d-none')
                  iframe.contentWindow.print();
                }
        } else {
          let iframe = $('#emp_details_iframe')[0]
        //   iframe.setAttribute('src', "data:application/pdf;base64," + response)
        iframe.setAttribute('src',response)
          iframe.onload = function(param) {
            $('.user_updated_msg').addClass('d-none')
                  iframe.contentWindow.print();
                }
        }
                }
            });

        })

        // print employee details end 






    });
</script>
@endSection
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="stylesheet" href="{{public_path('dashboard_assets/assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{public_path('dashboard_assets/crm/css/crm_create_contact.css')}}">
    <link rel="stylesheet" href="{{public_path('dashboard_assets/crm/css/crm_contact_details_print.css')}}">

<link id="pagestyle" href="{{public_path('dashboard_assets/assets/scss/argon-dashboard.css')}}" rel="stylesheet" type="text/css">
<style>
    
</style>

<!-- <link href="{{public_path('dashboard_assets/assets/css/custom.css')}}" rel="stylesheet" type="text/css" /> -->
  

    <title>Contact Details Print</title>
</head>
<body>
    <head></head>
    <section>
    <form action="" id="user_update_form">
            @csrf
            <input disabled type="hidden" name="user_id" id="user_id" value="{{$single_user->user_id}}">
            <input disabled type="hidden" name="remember_token" id="remember_token" value="{{csrf_token() }}">

            <div class="container-fluid profile">
                <div class="row gy-4 profile_row">
                    <!--  lable div end  -->
                    <div class="col-12">
                        <div class="parent emp_print_header">
                            <div class="row position-relative">
                                <div class="col-4 col-4">
                                    <h5 class="">Contact Details</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- lable div end  -->


<div class="user_info_photo">
                    <!-- user information start  -->
                    <div class="user_info_main padding-2">
                            <h5 class="">User Information</h5>
                            <div class="row gy-3 all_inputs">

                                <div class="col-6">
                                    <label for="">User Name</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="User Name" aria-label="User Name" name="username" id="username" value="{{$single_user->username}}" disabled>
                                </div>

                                <div class="col-6">
                                    <label for="">First Name</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="First Name" aria-label="First Name" name="first_name" id="first_name" value="{{$single_user->first_name}}">
                                </div>

                                <div class="col-6">
                                    <label for="">Middle Name</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Middle name" aria-label="Middle name" name="middle_names" id="middle_names" value="{{$single_user->middle_names}}">
                                </div>

                                <div class="col-6">
                                    <label for="">Last Name</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Last Name" aria-label="Last Name" name="last_name" id="last_name" value="{{$single_user->last_name}}">
                                </div>


                                <div class="col-6">
                                    <label for="">Mobile Number</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Mobile Number" aria-label="Mobile number" name="mobile_number" id="mobile_number" value="{{$single_user->mobile_number}}">

                                </div>

                                <div class="col-6">
                                    <label for="">Phone Number</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Phone number" aria-label="Phone number" name="phone_number" id="phone_number" value="{{$single_user->phone_number}}">

                                </div>

                                <div class="col-6">
                                    <label for="">Email</label>
                                    <input disabled type="email" class="form-control input_diabled" placeholder="Email" aria-label="Email" name="email" id="email" value="{{$single_user->email}}">

                                </div>

                                <div class="col-6">
                                    <label for="">Date Of Birth</label>
                                    <input disabled type="date" class="form-control input_diabled" placeholder="" aria-label="dateOfBirth" name="dob" id="dob" value="{{$single_user->dob}}">

                                </div>

                                

                             <div class="input_checkbox_main">
                                <div class=" form-check">
                                    <label class="form-check-label custom-checkbox" for="is_active" style="opacity:1 !important">
                                    <input disabled class="form-check-input mycheckbox" type="checkbox" id="is_active" name="is_active" {{$single_user->is_active=='1'?'checked':''}}>
                                    <span class="checkmark"></span>
                                        is active ?
                                    </label>
                                </div>

                                <div class=" form-check">
                                    <label class="form-check-label custom-checkbox" for="allow_login" style="opacity:1 !important">
                                    <input disabled class="form-check-input " type="checkbox" id="allow_login" name="allow_login" {{$single_user->allow_login=='1'?'checked':''}}>
                                    <span class="checkmark"></span>
                                        Allowed Login
                                    </label>

                                </div>

                                </div>



                            </div>
                    </div>
                    <!-- user information end  -->

                    <!-- profile photo start  -->
                    <div class="photo_main ">
                        <div class="parent padding-2">
                            <h5 class="">Contact Photo</h5>
                            <div class="row gy-4">

                                <div class="col-12">
                                    @if($single_user->profile_logo)
                                    <img src="{{public_path('storage/profile_logo/'.$single_user->profile_logo)}}" alt="" width="100%" height="200px" style="border-radius:10px;">
                                    @else
                                    <img src="{{public_path('storage/profile_logo/default.png')}}" alt="" width="100%" height="200px" style="border-radius:10px;">

                                    @endif



                                </div>



                            </div>
                        </div>
                    </div>
                    <!-- profile photo end  -->

                    </div>    


                    <!-- Address start  -->
                    <div class="col-12 location_info_main">
                        <div class="parent">
                            <h5 class="">Location Information</h5>
                            <div class="row gy-3 location_inputs">

                                <div class="col-4">
                                    <label for="">Address</label>
                                    <textarea disabled name="address" id="" cols="" rows="1" id="address" placeholder="Address" class="form-control input_diabled" style="border: 2px solid #d2d6da; font-family:'Roboto', sans-serif;color:black;">{{$single_user->address}}</textarea>
                                </div>

                                <div class="col-4">
                                    <label for="">Zip code</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Zip Code" aria-label="Zip code" name="zip_code" id="zip_code" value="{{$single_user->zip_code}}">
                                </div>

                                <div class="col-4">
                                    <label for="">City</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="City" aria-label="City" name="city" id="city" value="{{$single_user->city}}">
                                </div>

                                <div class="col-4">
                                    <label for="">State</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="State/Province" aria-label="State" name="state" id="state" value="{{$single_user->state}}">

                                </div>
                                <div class="col-4">
                                    <label for="">Land mark</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Landmark" aria-label="landmark" name="landmark" id="landmark" value="{{$single_user->landmark}}">
                                </div>

                                <div class="col-4">
                                    <label for="">Country </label>
                                    <select disabled name="country_id" id="country_id" class="form-select country_id" style="border: 2px solid #d2d6da;font-family:'Roboto', sans-serif;color:black;">
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
                    
                    <!-- More information start   -->
                    <div class="col-12 more_information_main">
                        <div class="parent">
                            <h5 class="">More Information</h5>
                            <div class="row gy-3 more_information_inputs">

                                <div class="col-4 ">
                                    <label for="">Facebook Link</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Fb link" aria-label="Fb link" name="fb_link" id="fb_link" value="{{$single_user->fb_link}}">
                                </div>

                                <div class="col-4">
                                    <label for="">Twitter Link</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Twitter link" aria-label="Twitter link" name="twitter_link" id="twitter_link" value="{{$single_user->twitter_link}}">
                                </div>
                                <div class="col-4">
                                    <label for="">User Type </label>
                                    <select disabled name="user_type" id="user_type" class="form-select input_diabled user_type" style="border: 2px solid #d2d6da;font-family:'Roboto', sans-serif;color:black; ">
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
                                <div class="col-4">
                                    <label for=""> Language</label>
                                    <select disabled name="ui_language" id="ui_language" class="form-select ui_lang" style="border: 2px solid #d2d6da; font-family:'Roboto', sans-serif;color:black;">
                                        <option></option>
                                        <option value="en" {{$single_user->ui_language=="en"?"selected":""}}>English</option>
                                        <option value="ar" {{$single_user->ui_language=="ar"?"selected":""}}>Arabic</option>
                                    </select>
                                </div>

                                <div class="col-4">
                                    <label for="">Blood Group</label>
                                    <select disabled name="blood_group" id="blood_group" class="form-select blood_group" style="border: 2px solid #d2d6da; font-family:'Roboto', sans-serif;color:black;">
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

                                <div class="col-4">
                                    <label for="">Marital status</label>
                                    <select disabled name="marital_status" id="marital_status" class="form-select martial_status" style="border: 2px solid #d2d6da; font-family:'Roboto', sans-serif;color:black;">
                                        <option></option>
                                        <option value="Single" {{$single_user->marital_status=="Single"?"selected":""}}>Single</option>
                                        <option value="Married" {{$single_user->marital_status=="Married"?"selected":""}}>Married</option>
                                        <option value="Divorced" {{$single_user->marital_status=="Divorced"?"selected":""}}>Divorced</option>
                                        <option value="Widowed" {{$single_user->marital_status=="Widowed"?"selected":""}}>Widowed</option>
                                        <option value="Undisclosed" {{$single_user->marital_status=="Undisclosed"?"selected":""}}>Undisclosed</option>
                                    </select>
                                </div>



                                <div class="col-4">
                                    <label for="">Social Media 1</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Social media 1" aria-label="Social media 1" name="social_media_1" id="socail_media_1" value="{{$single_user->social_media_1}}">
                                </div>

                                <div class="col-4">
                                    <label for="">Social Media 2</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Social media 2" aria-label="Social media 2" name="social_media_2" id="socail_media_2" value="{{$single_user->social_media_2}}">

                                </div>

                                <div class="col-4">
                                    <label for="">Social Media 3</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Social media 3" aria-label="Social media 3" name="social_media_3" id="socail_media_3" value="{{$single_user->social_media_3}}">
                                </div>

                                <div class="col-4">
                                    <label for="">Social Media 4</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Social media 4" aria-label="Social media 4" name="social_media_4" id="socail_media_4" value="{{$single_user->social_media_4}}">
                                </div>

                                <div class="col-4">
                                    <label for="">Custom Field 1</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Custom Field 1" aria-label="Custom Field 1" name="custom_field_1" id="custom_field_1" value="{{$single_user->custom_field_1}}">
                                </div>

                                <div class="col-4">
                                    <label for="">Custom Field 2</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Custom Field 2" aria-label="Custom Field 2" name="custom_field_2" id="custom_field_2" value="{{$single_user->custom_field_2}}">

                                </div>

                                <div class="col-4">
                                    <label for="">Custom Field 3</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Custom Field 3" aria-label="Custom Field 3" name="custom_field_3" id="custom_field_3" value="{{$single_user->custom_field_3}}">
                                </div>

                                <div class="col-4">
                                    <label for="">Custom Field 4</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Custom Field 4" aria-label="Custom Field 4" name="custom_field_4" id="custom_field_4" value="{{$single_user->custom_field_4}}">

                                </div>


                                <div class="col-4">
                                    <label for="">Custom Field 5</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Custom Field 5" aria-label="Custom Field 5" name="custom_field_5" id="custom_field_5" value="{{$single_user->custom_field_5}}">
                                </div>

                                <div class="col-4">
                                    <label for="">Custom Field 6</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Custom Field 6" aria-label="Custom Field 6" name="custom_field_6" id="custom_field_6" value="{{$single_user->custom_field_6}}">
                                </div>


                                <div class="col-4">
                                    <label for="">Custom Field 7</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Custom Field 7" aria-label="Custom Field 7" name="custom_field_7" id="custom_field_7" value="{{$single_user->custom_field_7}}">
                                </div>

                                <div class="col-4">
                                    <label for="">Custom Field 8</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Custom Field 8" aria-label="Custom Field 8" name="custom_field_8" id="custom_field_8" value="{{$single_user->custom_field_8}}">

                                </div>

                                <div class="col-4">
                                    <label for="">Custom Field 9</label>
                                    <input disabled type="text" class="form-control input_diabled" placeholder="Custom Field 9" aria-label="Custom Field 9" name="custom_field_9" id="custom_field_9" value="{{$single_user->custom_field_9}}">
                                </div>
                            </div>

                        </div>
                    </div>
                    <!--  More information end   -->
                </div>
            </div>

        </form>

    </section>
    <footer></footer>



    
</body>
</html>
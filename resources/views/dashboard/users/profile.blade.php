@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/create_update_user/css/profile.css')}}">

@endSection
@section('body_content')

<form action="" id="user_profile_form">
    <input type="hidden" name="user_id" id="user_id" value="{{session()->get('user_id')}}">

    <div class="container-fluid profile">
        <div class="row gy-4 profile_row">
            <!--  lable div end  -->
            <div class="col-md-12">
                <div class="parent">

                    <div class="row">
                        <div class="col-md-4">
                            <h5 class="">Profile Information</h5>
                        </div>



                        <div class="col-md-8">
                            <div class="alert alert-success  d-none text-white user_profile_updated_msg user_updated_msg" role="alert">
                                Profile Updated successfully
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
                            <input type="text" class="form-control" placeholder="User Name" aria-label="User Name" name="username" id="username" value="{{$user->username}}">
                        </div>

                        <div class="col-md-6">
                            <label for="">First Name</label>
                            <input type="text" class="form-control" placeholder="First Name" aria-label="First Name" name="first_name" id="first_name" value="{{$user->first_name}}">
                        </div>

                        <div class="col-md-6">
                            <label for="">Middle Name</label>
                            <input type="text" class="form-control" placeholder="Middle name" aria-label="Middle name" name="middle_names" id="middle_names" value="{{$user->middle_names}}">
                        </div>

                        <div class="col-md-6">
                            <label for="">Last Name</label>
                            <input type="text" class="form-control" placeholder="Last Name" aria-label="Last Name" name="last_name" id="last_name" value="{{$user->last_name}}">
                        </div>

                        <div class="col-md-4">
                            <label for="">Mobile Number</label>
                            <input type="text" class="form-control" placeholder="Mobile Number" aria-label="Mobile number" name="mobile_number" id="mobile_number" value="{{$user->mobile_number}}">

                        </div>

                        <div class="col-md-4">
                            <label for="">Phone Number</label>
                            <input type="text" class="form-control" placeholder="Phone number" aria-label="Phone number" name="phone_number" id="phone_number" value="{{$user->phone_number}}">

                        </div>

                        <div class="col-md-4">
                            <label for="">Email</label>
                            <input type="email" class="form-control" placeholder="Email" aria-label="Email" name="email" id="email" value="{{$user->email}}">

                        </div>


                    </div>
                </div>
            </div>
            <!-- user information end  -->

            <!-- profile photo start  -->
            <div class="col-md-4">
                <div class="parent h-100">
                    <h5 class="">Profile Photo</h5>
                    <div class="row gy-3">
                    <div class="col-md-12 d-flex justify-content-center">
                  @if($user->profile_logo)
                  <img src="{{asset('app/public/profile_logo/'.$user->profile_logo)}}" alt="" width="150px" height="150px" style="border-radius:10px;">
                  @else
                  <img src="{{asset('default.png')}}" alt="" width="150px" height="150px" style="border-radius:10px;">

                  @endif



                </div>
                        <div class="col-md-12">
                            <label for="">Upload Image</label>
                            <input type="File" class="form-control" placeholder="profile_logo" aria-label="profile_logo" name="profile_logo" id="profile_logo">

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
                            <textarea name="address" id="" cols="" rows="1" id="address" placeholder="Address" class="form-control">{{$user->address}}</textarea>
                        </div>

                        <div class="col-md-4">
                            <label for="">Zip code</label>
                            <input type="text" class="form-control" placeholder="Zip Code" aria-label="Zip code" name="zip_code" id="zip_code" value="{{$user->zip_code}}">
                        </div>

                        <div class="col-md-4">
                            <label for="">City</label>
                            <input type="text" class="form-control" placeholder="City" aria-label="City" name="city" id="city" value="{{$user->city}}">
                        </div>

                        <div class="col-md-4">
                            <label for="">State</label>
                            <input type="text" class="form-control" placeholder="State/Province" aria-label="State" name="state" id="state" value="{{$user->state}}">

                        </div>
                        <div class="col-md-8">
                            <label for="">Land mark</label>
                            <input type="text" class="form-control" placeholder="Landmark" aria-label="landmark" name="landmark" id="landmark" value="{{$user->landmark}}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Address end  -->
            <!-- More information start   -->
            <div class="col-md-12">
                <div class="parent">
                    <h5 class="">More Information</h5>
                    <div class="row gy-3">

                        <div class="col-md-4">
                            <label for="">Facebook Link</label>
                            <input type="text" class="form-control" placeholder="Fb link" aria-label="Fb link" name="fb_link" id="fb_link"  value="{{$user->fb_link}}">
                        </div>

                        <div class="col-md-4">
                            <label for="">Twitter Link</label>
                            <input type="text" class="form-control" placeholder="Twitter link" aria-label="Twitter link" name="twitter_link" id="twitter_link" value="{{$user->twitter_link}}">
                        </div>

                        <div class="col-md-4">
                            <label for=""> Language</label>
                            <select name="ui_language" id="ui_language" class="form-select ui_lang">
                                <option></option>
                                <option value="en" {{$user->ui_language=="en"?"selected":""}}>English</option>
                                <option value="ar" {{$user->ui_language=="ar"?"selected":""}} >Arabic</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="">Blood Group</label>
                            <select name="blood_group" id="blood_group" class="form-select blood_group">
                                <option></option>
                                <option value="A+" {{$user->blood_group=="A+"?"selected":""}}>A+</option>
                                <option value="A-" {{$user->blood_group=="A-"?"selected":""}}>A-</option>
                                <option value="B-" {{$user->blood_group=="B-"?"selected":""}}>B-</option>
                                <option value="B+" {{$user->blood_group=="B+"?"selected":""}}>B+</option>
                                <option value="AB+" {{$user->blood_group=="AB+"?"selected":""}}>AB+</option>
                                <option value="AB-" {{$user->blood_group=="AB-"?"selected":""}}>AB-</option>
                                <option value="O+" {{$user->blood_group=="O+"?"selected":""}}>O+</option>
                                <option value="O-" {{$user->blood_group=="O-"?"selected":""}}>O-</option>
                                <option value="UnKnown" {{$user->blood_group=="UnKnown"?"selected":""}}>Unknown</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="">Marital status</label>
                            <select name="marital_status" id="marital_status" class="form-select martial_status">
                                <option></option>
                                <option value="Single" {{$user->marital_status=="Single"?"selected":""}} >Single</option>
                                <option value="Married" {{$user->marital_status=="Married"?"selected":""}} >Married</option>
                                <option value="Divorced" {{$user->marital_status=="Divorced"?"selected":""}} >Divorced</option>
                                <option value="Widowed" {{$user->marital_status=="Widowed"?"selected":""}} >Widowed</option>
                                <option value="Undisclosed" {{$user->marital_status=="Undisclosed"?"selected":""}} >Undisclosed</option>
                            </select>
                        </div>



                        <div class="col-md-4">
                            <label for="">Social Media 1</label>
                            <input type="text" class="form-control" placeholder="Social media 1" aria-label="Social media 1" name="social_media_1" id="socail_media_1" value="{{$user->social_media_1}}">
                        </div>

                        <div class="col-md-4">
                            <label for="">Social Media 2</label>
                            <input type="text" class="form-control" placeholder="Social media 2" aria-label="Social media 2" name="social_media_2" id="socail_media_2" value="{{$user->social_media_2}}">

                        </div>

                        <div class="col-md-4">
                            <label for="">Social Media 3</label>
                            <input type="text" class="form-control" placeholder="Social media 3" aria-label="Social media 3" name="social_media_3" id="socail_media_3" value="{{$user->social_media_3}}">
                        </div>

                        <div class="col-md-4">
                            <label for="">Social Media 4</label>
                            <input type="text" class="form-control" placeholder="Social media 4" aria-label="Social media 4" name="social_media_4" id="socail_media_4" value="{{$user->social_media_4}}">
                        </div>

                        <div class="col-md-4">
                            <label for="">Custom Field 1</label>
                            <input type="text" class="form-control" placeholder="Custom Field 1" aria-label="Custom Field 1" name="custom_field_1" id="custom_field_1" value="{{$user->custom_field_1}}">
                        </div>

                        <div class="col-md-4">
                            <label for="">Custom Field 2</label>
                            <input type="text" class="form-control" placeholder="Custom Field 2" aria-label="Custom Field 2" name="custom_field_2" id="custom_field_2" value="{{$user->custom_field_2}}">

                        </div>

                        <div class="col-md-4">
                            <label for="">Custom Field 3</label>
                            <input type="text" class="form-control" placeholder="Custom Field 3" aria-label="Custom Field 3" name="custom_field_3" id="custom_field_3" value="{{$user->custom_field_3}}"> 
                        </div>

                        <div class="col-md-4">
                            <label for="">Custom Field 4</label>
                            <input type="text" class="form-control" placeholder="Custom Field 4" aria-label="Custom Field 4" name="custom_field_4" id="custom_field_4" value="{{$user->custom_field_4}}">

                        </div>


                        <div class="col-md-4">
                            <label for="">Custom Field 5</label>
                            <input type="text" class="form-control" placeholder="Custom Field 5" aria-label="Custom Field 5" name="custom_field_5" id="custom_field_5" value="{{$user->custom_field_5}}">
                        </div>

                        <div class="col-md-4">
                            <label for="">Custom Field 6</label>
                            <input type="text" class="form-control" placeholder="Custom Field 6" aria-label="Custom Field 6" name="custom_field_6" id="custom_field_6" value="{{$user->custom_field_6}}">
                        </div>


                        <div class="col-md-4">
                            <label for="">Custom Field 7</label>
                            <input type="text" class="form-control" placeholder="Custom Field 7" aria-label="Custom Field 7" name="custom_field_7" id="custom_field_7" value="{{$user->custom_field_7}}">
                        </div>

                        <div class="col-md-4">
                            <label for="">Custom Field 8</label>
                            <input type="text" class="form-control" placeholder="Custom Field 8" aria-label="Custom Field 8" name="custom_field_8" id="custom_field_8" value="{{$user->custom_field_8}}">

                        </div>

                        <div class="col-md-4">
                            <label for="">Custom Field 9</label>
                            <input type="text" class="form-control" placeholder="Custom Field 9" aria-label="Custom Field 9" name="custom_field_9" id="custom_field_9" value="{{$user->custom_field_9}}">
                        </div>
                    </div>

                </div>
            </div>


            <!--  More information end   -->

            <!-- button start  -->
            <div class="col-md-12">
                <div class="parent">
                    <div class="row justify-content-end">
                        <div class="col-md-2">

                            <button type="submit" class="btn btn-primary update_profile_button w-100">Update</button>

                        </div>
                    </div>
                </div>
            </div>

            <!-- button end  -->




        </div>
    </div>

</form>

@endSection
@section('page_script_links')
<script type="text/javascript">
    $(document).ready(function() {
        // base url start 
        @php
        $baseUrl = config('app.url');
        echo "var base_url = '".$baseUrl.
        "';";
        @endphp
        // base url end





        // select field for language start 
        $("#ui_language").select2({
            placeholder: "Select Language",
            allowClear: true,
            width: "100%",
        });
        // select field for language end 
        // select field for blood group start 
        $("#blood_group").select2({
            placeholder: "Select Blood Group",
            allowClear: true,
            width: "100%",
        });
        // select field for blood group end 

        // select field for marital status start
        $("#marital_status").select2({
            placeholder: "Martial status",
            allowClear: true,
            width: "100%",
        });
        // select field for marital status end


        // update user profile start 
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#user_profile_form").validate({
            rules: {
                username: {
                    required: true,
                    // remote:base_url+'register_user'
                    remote: {
                        url: base_url + "is_exist_user_name_for_update",
                        type: "post",
                        data: {
                            username: function() {
                                return $("#username").val();
                            },
                            user_id: function() {
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
                        url: base_url + "is_exist_email_for_update",
                        type: "post",
                        data: {
                            email: function() {
                                return $("#email").val();
                            },
                            user_id: function() {
                                return $("#user_id").val();
                            },
                            _token: $('meta[name="csrf-token"]').attr("content"),
                        },
                    },
                },
                ui_language: {
                    required: true
                },
                marital_status: {
                    required: true
                },
                blood_group: {
                    required: true
                }

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
                ui_language: {
                    required: "Select Language"
                },
                marital_status: {
                    required: "Select Marital Status"
                },
                blood_group: {
                    required: "Select Blood Group"
                }


            },
            submitHandler: function(form) {
                $.ajax({
                    type: "post",
                    url: base_url + "updateUserProfile",
                    data: new FormData(form),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response == 'true') {
                            $(".user_profile_updated_msg").removeClass("d-none");
                                window.scrollTo(0,0)
                                
                        }
                    },
                });
            },
        });
        // update user profile end 

        // hide select error when the field is selected start 
        $('#marital_status').on('change', function(param) {
            let marital_status_value = $(this).val();
            if (marital_status_value == "") {

                $('#marital_status-error').removeClass('d-none') // label
            } else {
                $('#marital_status-error').addClass('d-none') // label

            }
        })


        $('#ui_language').on('change', function(param) {
            let uiLanguageValue = $(this).val();
            if (uiLanguageValue == "") {

                $('#ui_language-error').removeClass('d-none') // label
            } else {
                $('#ui_language-error').addClass('d-none') // label

            }
        })


        $('#blood_group').on('change', function(param) {
            let bloodGroupValue = $(this).val();
            if (bloodGroupValue == "") {

                $('#blood_group-error').removeClass('d-none') // label
            } else {
                $('#blood_group-error').addClass('d-none') // label

            }
        })
        // hide select error when the field is selected end 







        // select field for  language  start
        // $('#ui_language').css('color','#b9b9b9');
        // $('#ui_language').change(function() {
        //    var current = $('#ui_language').val();
        //    if (current != 'null') {
        //        $('#ui_language').css('color','black');
        //    } else {
        //        $('#ui_language').css('color','#b9b9b9');
        //    }
        // }); 
        // select field for  language  end
    });
    
</script>
@endSection
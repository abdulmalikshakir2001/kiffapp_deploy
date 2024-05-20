@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/crm/css/crm_create_contact.css')}}">
@endSection
@section('body_content')
<div class="row">
  <div class="col-md-12">

    <form action="" id="user_added_form">
      @csrf
      <input type="hidden" name="remember_token" id="remember_token">

      <div class="container-fluid profile">
        <div class="row gy-4 profile_row">
          <!--  lable div end  -->
          <div class="col-md-12">
            <div class="parent">

              <div class="row">
                <div class="col-md-4">
                  <h5 class="">Add Contact</h5>
                </div>

                <div class="col-md-8">
                  <div class="alert alert-success  d-none text-white user_updated_msg" role="alert" id="user_update_msg">
                    Contact added successfully
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
                  <input type="text" class="form-control" placeholder="User Name" aria-label="User Name" name="username" id="username">
                </div>

                <div class="col-md-6">
                  <label for="">First Name</label>
                  <input type="text" class="form-control" placeholder="First Name" aria-label="First Name" name="first_name" id="first_name">
                </div>

                <div class="col-md-6">
                  <label for="">Middle Name</label>
                  <input type="text" class="form-control" placeholder="Middle name" aria-label="Middle name" name="middle_names" id="middle_names">
                </div>

                <div class="col-md-6">
                  <label for="">Last Name</label>
                  <input type="text" class="form-control" placeholder="Last Name" aria-label="Last Name" name="last_name" id="last_name">
                </div>
                <div class="col-md-6">
                  <label for="">Mobile Number</label>
                  <input type="text" class="form-control" placeholder="Mobile Number" aria-label="Mobile number" name="mobile_number" id="mobile_number">
                </div>
                <div class="col-md-6">
                  <label for="">Phone Number</label>
                  <input type="text" class="form-control" placeholder="Phone number" aria-label="Phone number" name="phone_number" id="phone_number">

                </div>

                <div class="col-md-6">
                  <label for="">Email</label>
                  <input type="email" class="form-control" placeholder="Email" aria-label="Email" name="email" id="email">

                </div>

                <div class="col-md-6">
                  <label for="">Date Of Birth</label>
                  <input type="date" class="form-control" placeholder="" aria-label="dateOfBirth" name="dob" id="dob">

                </div>

                <div class="col-md-6 form-check">
                  <input class="form-check-input" type="checkbox" id="is_active" name="is_active">
                  <label class="form-check-label" for="is_active">
                    is active ?
                  </label>
                </div>

                <div class="col-md-6 form-check">
                  <input class="form-check-input" type="checkbox" id="allow_login" name="allow_login">
                  <label class="form-check-label" for="allow_login">
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
              <h5 class="">Contact Photo</h5>
              <div class="row">
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
                  <textarea name="address" id="" cols="" rows="1" id="address" placeholder="Address" class="form-control"></textarea>
                </div>

                <div class="col-md-4">
                  <label for="">Zip code</label>
                  <input type="text" class="form-control" placeholder="Zip Code" aria-label="Zip code" name="zip_code" id="zip_code">
                </div>

                <div class="col-md-4">
                  <label for="">City</label>
                  <input type="text" class="form-control" placeholder="City" aria-label="City" name="city" id="city">
                </div>

                <div class="col-md-4">
                  <label for="">State</label>
                  <input type="text" class="form-control" placeholder="State/Province" aria-label="State" name="state" id="state">

                </div>
                <div class="col-md-4">
                  <label for="">Land mark</label>
                  <input type="text" class="form-control" placeholder="Landmark" aria-label="landmark" name="landmark" id="landmark">
                </div>

                <div class="col-md-4">
                  <label for="">Country </label>
                  <select name="country_id" id="country_id" class="form-select country_id">
                    <option></option>
                    @foreach($countries as $country)
                    <option value="{{$country->country_id}}">{{$country->country}}</option>
                    @endforeach
                  </select>
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
                  <input type="text" class="form-control" placeholder="Fb link" aria-label="Fb link" name="fb_link" id="fb_link">
                </div>

                <div class="col-md-4">
                  <label for="">Twitter Link</label>
                  <input type="text" class="form-control" placeholder="Twitter link" aria-label="Twitter link" name="twitter_link" id="twitter_link">
                </div>
                <div class="col-md-4">
                  <label for="">User Type </label>
                  <select name="user_type" id="user_type" class="form-select user_type">
                    <option></option>
                    <option value="Owner">Owner</option>
                    <option value="User">User</option>


                    <option value="Employee"> Employee</option>
                    <option value="Supplier"> Supplier</option>
                    <option value="Customer"> Customer</option>
                    <option value="SupplierCustomer"> SupplierCustomer</option>
                    <option value="ContactOnly" selected>ContactOnly</option>
                  </select>

                </div>



                <div class="col-md-4">
                  <label for=""> Language</label>
                  <select name="ui_language" id="ui_language" class="form-select ui_lang">
                    <option></option>
                    <option value="en">English</option>
                    <option value="ar">Arabic</option>
                  </select>
                </div>

                <div class="col-md-4">
                  <label for="">Blood Group</label>
                  <select name="blood_group" id="blood_group" class="form-select blood_group">
                    <option></option>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B-">B-</option>
                    <option value="B+">B+</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                    <option value="UnKnown">Unknown</option>
                  </select>
                </div>

                <div class="col-md-4">
                  <label for="">Marital status</label>
                  <select name="marital_status" id="marital_status" class="form-select martial_status">
                    <option></option>
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Divorced">Divorced</option>
                    <option value="Widowed">Widowed</option>
                    <option value="Undisclosed">Undisclosed</option>
                  </select>
                </div>



                <div class="col-md-4">
                  <label for="">Social Media 1</label>
                  <input type="text" class="form-control" placeholder="Social media 1" aria-label="Social media 1" name="social_media_1" id="socail_media_1">
                </div>

                <div class="col-md-4">
                  <label for="">Social Media 2</label>
                  <input type="text" class="form-control" placeholder="Social media 2" aria-label="Social media 2" name="social_media_2" id="socail_media_2">

                </div>

                <div class="col-md-4">
                  <label for="">Social Media 3</label>
                  <input type="text" class="form-control" placeholder="Social media 3" aria-label="Social media 3" name="social_media_3" id="socail_media_3">
                </div>

                <div class="col-md-4">
                  <label for="">Social Media 4</label>
                  <input type="text" class="form-control" placeholder="Social media 4" aria-label="Social media 4" name="social_media_4" id="socail_media_4">
                </div>

                <div class="col-md-4">
                  <label for="">Custom Field 1</label>
                  <input type="text" class="form-control" placeholder="Custom Field 1" aria-label="Custom Field 1" name="custom_field_1" id="custom_field_1">
                </div>

                <div class="col-md-4">
                  <label for="">Custom Field 2</label>
                  <input type="text" class="form-control" placeholder="Custom Field 2" aria-label="Custom Field 2" name="custom_field_2" id="custom_field_2">

                </div>

                <div class="col-md-4">
                  <label for="">Custom Field 3</label>
                  <input type="text" class="form-control" placeholder="Custom Field 3" aria-label="Custom Field 3" name="custom_field_3" id="custom_field_3">
                </div>

                <div class="col-md-4">
                  <label for="">Custom Field 4</label>
                  <input type="text" class="form-control" placeholder="Custom Field 4" aria-label="Custom Field 4" name="custom_field_4" id="custom_field_4">

                </div>


                <div class="col-md-4">
                  <label for="">Custom Field 5</label>
                  <input type="text" class="form-control" placeholder="Custom Field 5" aria-label="Custom Field 5" name="custom_field_5" id="custom_field_5">
                </div>

                <div class="col-md-4">
                  <label for="">Custom Field 6</label>
                  <input type="text" class="form-control" placeholder="Custom Field 6" aria-label="Custom Field 6" name="custom_field_6" id="custom_field_6">
                </div>


                <div class="col-md-4">
                  <label for="">Custom Field 7</label>
                  <input type="text" class="form-control" placeholder="Custom Field 7" aria-label="Custom Field 7" name="custom_field_7" id="custom_field_7">
                </div>

                <div class="col-md-4">
                  <label for="">Custom Field 8</label>
                  <input type="text" class="form-control" placeholder="Custom Field 8" aria-label="Custom Field 8" name="custom_field_8" id="custom_field_8">

                </div>

                <div class="col-md-4">
                  <label for="">Custom Field 9</label>
                  <input type="text" class="form-control" placeholder="Custom Field 9" aria-label="Custom Field 9" name="custom_field_9" id="custom_field_9">
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

                  <button type="submit" class="btn btn-primary  w-100" id="added_user_btn">Add contact</button>

                </div>
              </div>
            </div>
          </div>

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
    $("#user_added_form").validate({
      rules: {
        username: {
          required: true,
          // remote:base_url+'register_user'
          remote: {
            url: base_url + "is_exist_user_name",
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
            url: base_url + "is_exist_email",
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
        


        user_type: {
          required: true,
        },
        work_shift_id:{
          required:true,

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
        
        user_type: {
          required: "User Type Required",
        },
        work_shift_id:{
          required:"Select work shift",

        },
        
      },
      submitHandler: function(form) {
        $.ajax({
          type: "post",
          url: base_url + "contact",
          data: new FormData(form),
          processData: false,
          contentType: false,
          success: function(response) {
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

    $('#work_shift_id').on('change', function(param) {
      let work_shift_id_value = $(this).val();
      if (work_shift_id_value == "") {

        $('#work_shift_id-error').removeClass('d-none') // label
      } else {
        $('#work_shift_id-error').addClass('d-none') // label

      }
    })
    $('#user_type').on('change', function(param) {
      let user_type_value = $(this).val();
      if (user_type_value == "") {

        $('#user_type-error').removeClass('d-none') // label
      } else {
        $('#user_type-error').addClass('d-none') // label

      }
    })

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











  });
</script>

@endSection
@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/create_update_user/css/create_user.css')}}">
<link rel="stylesheet" href="{{asset('dashboard_assets/create_update_user/css/job_candidate_profile.css')}}">
@endSection
@section('body_content')
<div class="row">
    <div class="col-md-12 p-0 col-wrapper">
        <!-- content start  -->
        <div class="container-fluid p-4 create_user_main">
            <div class="row">
                <div class="col-md-12 ">
                    <div class="job_cand_menu_parent">
                        <ul class="job_cand_menu">
                            <a href="javascript:void">
                                <li class="text-uppercase"> home</li>
                            </a>
                            <a href="{{route('show_job_details')}}">
                                <li class="text-uppercase"> Jobs</li>
                            </a>
                        </ul>
                    </div>
                </div>

                <!-- new start  -->
                <div class="container">
                    <div class="row gutters">
                        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="account-settings">
                                        <div class="user-profile">
                                            <div class="user-avatar">
                                                <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Maxwell Admin">
                                            </div>
                                            <h5 class="user-name">{{$user->username}}</h5>
                                            <h6 class="user-email">{{$user->email}}</h6>
                                        </div>
                                        <div class="about">
                                            <h5>Adress</h5>
                                            <p>{{$user->address}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                            <div class="card h-100">
                                <div class="card-body">
                                    <!-- form start  -->
                                    <form role="form" action="" method="" id="job_candidate_profile_udpate_form" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="remember_token" id="remember_token">
                                        <div class="row gutters">
                                            <!-- show message when resume sent start  -->
                                            <div class="mb-3 col-md-12">
                                                <div class="alert alert-success  d-none text-white resume_sent_msg user_updated_msg" role="alert">
                                                    Job resume sent successfully
                                                    <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                                </div>
                                            </div>
                                            <!-- show message when resume sent end  -->
                                            <!-- show message to upload cv start  -->
                                            @if(session('status'))
                                            <div class="mb-3 col-md-12">
                                                <div class="alert alert-success   text-white user_updated_msg" role="alert">
                                                    {{session('status')}}
                                                    <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                                </div>
                                            </div>
                                            @endif
                                            <!-- show message to upload cv end  -->
                                        </div>


                                        <div class="row gutters">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <h6 class="mb-2 text-primary">Personal Details</h6>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                                <div class="form-group">
                                                    <label for="username">User Name</label>
                                                    <input type="text" class="form-control" placeholder="User Name" aria-label="User Name" name="username" id="username" value="{{$user->username}}">
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                                <div class="form-group">
                                                    <label for="first_name">First Name</label>
                                                    <input type="text" class="form-control" placeholder="First Name" aria-label="First Name" name="first_name" id="first_name" value="{{$user->first_name}}">
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                                <div class="form-group">
                                                    <label for="middle_names">Middle Name</label>
                                                    <input type="text" class="form-control" placeholder="Middle name" aria-label="Middle name" name="middle_names" id="middle_names" value="{{$user->middle_names}}">
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                                <div class="form-group">
                                                    <label for="last_name">Last Name</label>
                                                    <input type="text" class="form-control" placeholder="Last Name" aria-label="Last Name" name="last_name" id="last_name" value="{{$user->last_name}}">
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                                <div class="form-group">
                                                    <label for="last_name">Email</label>
                                                    <input type="text" class="form-control" placeholder="Email" aria-label="Email" name="email" id="email" value="{{$user->email}}">
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                                <div class="form-group">
                                                    <label for="">Upload CV</label>
                                                    <input type="File" class="form-control" placeholder="Job Candidate CV" aria-label="Job Candidate CV " name="employee_cv" id="employee_cv">
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                                <div class="form-group">
                                                    <label for="phone_number">Phone Number</label>
                                                    <input type="text" class="form-control" placeholder="Phone number" aria-label="Phone number" name="phone_number" id="phone_number" value="{{$user->phone_number}}">
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                                <div class="form-group">
                                                    <label for=""> Gender</label>
                                                    <select name="gender" id="gender" class="form-select gender">
                                                        <!-- <option selected>Open this select menu</option> -->
                                                        <option></option>
                                                        <option value="Male" {{$user->gender=="Male"?"selected":""}}>Male</option>
                                                        <option value="Female" {{$user->gender=="Female"?"selected":""}}>Female</option>
                                                        <option value="Other" {{$user->gender=="Other"?"selected":""}}>Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                                <div class="form-group">
                                                    <label for="">Ui Language</label>
                                                    <select name="ui_language" id="ui_language" class="form-select ui_lang">
                                                        <option></option>
                                                        <option value="en" {{$user->ui_language=="en"?"selected":""}}>English</option>
                                                        <option value="ar" {{$user->ui_language=="ar"?"selected":""}}>Arabic</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row gutters">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <h6 class="mt-3 mb-2 text-primary">Address</h6>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                <div class="form-group">
                                                    <label for="address">Address</label>
                                                    <textarea name="address" id="" cols="" rows="1" id="address" placeholder="Address" class="form-control">{{$user->address}}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                <div class="form-group">
                                                    <label for="zip_code">Zip code</label>
                                                    <input type="text" class="form-control" placeholder="Zip Code" aria-label="Zip code" name="zip_code" id="zip_code" value="{{$user->zip_code}}">
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                <div class="form-group">
                                                    <label for="city">City</label>
                                                    <input type="text" class="form-control" placeholder="City" aria-label="City" name="city" id="city" value="{{$user->city}}">
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                <div class="form-group">
                                                    <label for="state">State</label>
                                                    <input type="text" class="form-control" placeholder="State/Province" aria-label="State" name="state" id="state" value="{{$user->state}}">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row gutters">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <div class="text-right">

                                                    <button type="sumbit" id="submit" name="submit" class="btn btn-primary">Send CV</button>
                                                </div>
                                            </div>
                                        </div>

                                    </form>
                                    <!-- form end  -->


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- new end  -->



            </div>
        </div>
        <!-- content end  -->





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
                data: $(form).serialize(),
                dataType: "json",
                success: function (response) {
                    // alert(response);
                    // console.log( response);
                    if (response == 1) {
                        // alert("user updated successfully")
                        // $('.update_msg').removeClass("d-none");
                        $("#user_added_form").trigger("reset");
                        $(".user_updated_msg").removeClass("d-none");
                    }
                },
            });
        },
    });
    // add users end

    // update  user start

    $("#user_update_form").validate({
        rules: {
            username: {
                required: true,
                // remote:base_url+'register_user'
                remote: {
                    url: base_url + "is_exist_user_name_for_update",
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
                    url: base_url + "is_exist_email_for_update",
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

            country_id: {
                required: true,
                number: true,
            },
            position_id: {
                required: true,
                number: true,
            },
            department_id: {
                required: true,
                number: true,
            },
            company_id: {
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

            country_id: {
                required: "Country Required",
                number: "only numbers are allowed",
            },
            position_id: {
                required: "Positin Required",
                number: "only numbers are allowed",
            },
            department_id: {
                required: "Department Required",
                number: "only numbers are allowed",
            },
            company_id: {
                required: "Company required",
            },
            user_type: {
                required: "User Type Required",
            },
        },
        submitHandler: function (form) {
            $.ajax({
                type: "post",
                url: base_url + "update_user",
                data: $(form).serialize(),
                dataType: "json",
                success: function (response) {
                    // alert(response);
                    // console.log( response);
                    if (response.status == 1) {
                        $("#user_update_form").trigger("reset");

                        // alert("user updated successfully")
                        // $('.update_msg').removeClass("d-none");
                        $(".user_updated_msg").removeClass("d-none");
                    }
                },
            });
        },
    });

    // update  user end

    // datatables start

    $(function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $("#view_user").DataTable({
            processing: true,
            serverSide: true,
            ajax: base_url + "get_data",
            columns: [
                { data: "DT_RowIndex", name: "DT_RowIndex" },
                { data: "username", name: "username" },
                { data: "email", name: "email" },
                { data: "phone_number", name: "phone_number" },
                { data: "gender", name: "gender" },
                { data: "company_name", name: "company_name" },
                { data: "action", name: "action" },
            ],
        });
    });
    // datatables end

    // update user start
    $(document).on("click", ".user_edit_btn", function (param) {
        let update_user_id = $(this).data("update_user_id");
        location.replace(base_url + "updateUser/" + update_user_id);
    });
    // update user end

    // delete user start
    $(document).on("click", ".user_delete_btn", function (param) {
        let delete_user_id = $(this).data("delete_user_id");
        $(".confirm_delete_user").on("click", function () {
            $.ajax({
                type: "post",
                url: base_url + "deleteUser",
                data: { delete_user_id: delete_user_id },
                dataType: "json",
                success: function (response) {
                    // alert(response)
                    $("#view_user").DataTable().ajax.reload();
                },
            });
        });
    });
    // delete user end

    // adding button to the create user datatable to add user start
    setTimeout(() => {
        $(document)
            .find("#view_user_filter")
            .append(
                '<span class="add_user_div" ">\
                     <button type="button" class="btn bg-primary add_user_by_owner btn-sm mb-0" data-bs-toggle="modal" data-bs-target="" style="height:32px"> <span class="material-symbols-outlined text-white" style="line-height:17px !important">\
              person_add\
            </span></button>\
      </span>\
   '
            );
            // check the contstains for company owner to add user start 
             
            $('.add_user_by_owner').on('click',function(){
                $.ajax({
                    type: "post",
                     url:base_url+ "check_user_count",
                    data: "",
                    dataType: "json",
                    success: function (response) {
                        if(response.users_count==5){
                            $('#limited_user_count').modal('show');
                        }
                        else{
                                window.location.replace(base_url+'users/create')
                        }
                        
                    }
                });
            })
            // check the contstains for company owner to add user end
    }, 1);

    // adding button to the create user datatable to add user end

    // adding groups to users start
    $(document).on("click", ".users_groups_assign", function () {
        // alert($(this).data('groups_id_for_per'))
        let user_id_for_groups = $(this).data("user_id_for_groups");
        let user_name = $(this).data("user_name_for_groups");

        // send group id to index fun of user groups to show edit switch buttons start
        $.ajax({
            type: "post",
            url: base_url + "users_edit_groups",
            data: { user_id_for_groups: user_id_for_groups },
            dataType: "json",
            success: function (response) {
                // alert(response);
                console.log(response.groups);
                let group_arr = response.groups.split(",");
                console.log(group_arr);
                let groups = $(".groups");
                $(groups).each(function (key, value) {
                    // console.log(value)
                    let group_value = $(value).val();
                    if (group_arr.includes(group_value)) {
                        // console.log(permission_value);
                        $(value).prop("checked", true);
                    } else {
                        $(value).prop("checked", false);
                    }
                });
            },
        });

        $(".user_name").text(user_name);
        $("#user_id").val(user_id_for_groups);
        $("#assign_groups_form").on("submit", function (e) {
            e.preventDefault();
            function sendData(url) {
                $.ajax({
                    type: "post",
                    url: url,
                    data: $("#assign_groups_form").serialize(),
                    dataType: "json",
                    success: function (response) {
                        // $("#view_users_groups").trigger("reset");
                        $("#view_user").DataTable().ajax.reload();
                        // reset all permission swtihces start
                        let all_groups = $(".groups");
                        $(all_groups).each(function (key, value) {
                            $(value).prop("checked", false);
                        });

                        // reset all permission swtihces end
                        // alert(response);
                        // console.log(response);
                    },
                });
            }
            sendData(base_url + "assign_groups_to_user");
        });
    });

    $(document).on("click", function (e) {
        if (
            $(e.target).parents("#group_assign_main").attr("id") !=
            "group_assign_main"
        ) {
            $("#assign_groups_form").trigger("reset");
        }
    });
    // update user profile start 
    $("#user_profile_udpate_form").validate({
        rules: {
            username: {
                required: true,
                // remote:base_url+'register_user'
                // remote: {
                //     url: base_url + "is_exist_user_name_for_update",
                //     type: "post",
                //     data: {
                //         username: function () {
                //             return $("#username").val();
                //         },
                //         user_id: function () {
                //             return $("#user_id").val();
                //         },
                //         _token: $('meta[name="csrf-token"]').attr("content"),
                //     },
                // },
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
       

       
        },
        messages: {
            username: {
                required: "Please Enter Your name",
                // remote: "an account with this user name already exist",
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
        },
        submitHandler: function (form) {
            $.ajax({
                type: "post",
                url: base_url + "update_user_profile",
                data: $(form).serialize(),
                dataType: "json",
                success: function (response) {
                        $(".user_updated_msg").removeClass("d-none");
                },
            });
        },
    });
    // update user profile end 


    // update job candidate start 
    $("#job_candidate_profile_udpate_form").validate({
        rules: {
            username: {
                required: true,
                // remote:base_url+'register_user'
                // remote: {
                //     url: base_url + "is_exist_user_name_for_update",
                //     type: "post",
                //     data: {
                //         username: function () {
                //             return $("#username").val();
                //         },
                //         user_id: function () {
                //             return $("#user_id").val();
                //         },
                //         _token: $('meta[name="csrf-token"]').attr("content"),
                //     },
                // },
            },
            first_name: {
                required: true,
            },
            last_name: {
                required: true,
            },
            phone_number: {
                required: true,
                maxlength: 15,
            },
            employee_cv:{
                required: true,
            }
        },
        messages: {
            username: {
                required: "Please Enter Your name",
                // remote: "an account with this user name already exist",
            },
            first_name: {
                required: "Enter First Name",
            },
            last_name: {
                required: "Enter Last Name",
            },
            phone_number: {
                required: "Contact required",
                maxlength: "Length should be less than 15 charactor",
            },
            employee_cv:{
                required: 'please upload your cv  ',

            }
        },
        submitHandler: function (form) {
            $.ajax({
                type: "post",
                url: base_url + "update_job_candidate_profile",
                data: new FormData(form),
            processData:false,
            contentType:false,
                success: function (response) {
                        $(".resume_sent_msg").removeClass("d-none");
                },
            });
        },
    });
    // update job candidate end 

    // employee start 
      // datatables start

      $(function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $("#view_employee").DataTable({
            processing: true,
            serverSide: true,
            ajax: base_url + "get_data_employee",
            columns: [
                { data: "DT_RowIndex", name: "DT_RowIndex" },
                { data: "username", name: "username" },
                { data: "email", name: "email" },
                { data: "phone_number", name: "phone_number" },
                { data: "gender", name: "gender" },
                { data: "action", name: "action" },
            ],
        });
    });
    // datatables end
    // employee end 
    
});

    
</script>
@endSection
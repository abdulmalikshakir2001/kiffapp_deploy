@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/create_update_user/css/change_password.css')}}">

@endSection
@section('body_content')
<div class="row">
    <div class="col-md-12">
        <!-- content start  -->
        <div class="container-fluid p-4 create_user_main">
            <div class="row">
                <div class="col-md-12">
                    <form role="form" action="" method="post" id="change_password_form">
                        @csrf
                        <div class="container-fluid">
                            <div class="row">
                                <!-- show message when companies   added  start  -->
                                <div class="mb-3 col-md-12">
                  <div class="alert alert-success  d-none text-white user_updated_msg" role="alert">
                    Password changed successfully
                    <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                  </div>
                </div>
                                <!-- show message when companies   added  start  -->
                                <div class="col-md-12 d-flex justify-content-center">
                                <div class="input_change_pass_parent">




                                <!-- old password -->
                                <div class="mb-3 ">
                                    <label for="">Old password</label>
                                    <input type="password" class="form-control" placeholder="Old password" aria-label="Old Password" name="old_password" id="old_password">
                                </div>
                                <!-- new password password -->
                                <div class="mb-3 ">
                                <label for="">New password</label>
                                    <input type="password" class="form-control" placeholder="New password" aria-label="New Password" name="new_password" id="new_password">
                                </div>
                                <!-- confirm password -->
                                <div class="mb-3 ">
                                <label for="">Confirm password</label>
                                    <input type="password" class="form-control" placeholder="Confirm password" aria-label="Confirm Password" name="new_password_confirmation" id="new_password_confirmation">
                                </div>
                              
                                <div class="text-center">
                                    <button type="submit" id="change_password_btn" class="btn bg-gradient-dark w-100 my-4 mb-2">Change Password</button>
                                </div>


                                </div>
                                </div>



                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!-- content end  -->

    </div>
</div>

@endSection
@section('page_script_links')
<script>
    @php
    $baseUrl = config('app.url');
    echo "var base_url = '".$baseUrl.
    "';";
    @endphp
        $("#change_password_form").validate({
        rules: {
            old_password: {
                required: true,
                // remote:base_url+'register_user'
                remote: {
                    url: base_url + "check_password",
                    type: "post",
                    data: {
                        old_password: function () {
                            return $("#old_password").val();
                        },
                        
                        _token: $('meta[name="csrf-token"]').attr("content"),
                    },
                },
            },
            'new_password':{
                required:true
            },
            'new_password_confirmation':{
                required:true,
                equalTo:'#new_password'
            }
           
           
        },
        messages: {
       
            old_password: {
                required: "Old password Required",
                remote:"Old password is incorrect",
            },
            new_password: {
                required: "New password Required",
            },
            new_password_confirmation: {
                required: " confirmation  Required",
                equalTo:"Entered password not matched with the new password"
            },
        },
        submitHandler: function (form) {
            $.ajax({
                type: "post",
                url: base_url + "update_password",
                data: $('#change_password_form').serialize(),
                // dataType: "json",
                success: function (response) {
                    // alert(response);
                    // console.log( response);
                    if (response) {
                        $('#change_password_form').trigger('reset')
                        $(".user_updated_msg").removeClass("d-none");
                    }
                },
            });
        },
    });
</script>

@endSection
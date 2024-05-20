@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/create_update_user/css/update_user_profile.css')}}">
@endSection
@section('body_content')
<div class="row">
    <div class="col-md-12">
        <!-- content start  -->
        <div class="container-fluid p-4 create_user_main">
            <div class="row">
                <div class="col-md-12">
                    <form role="form" action="" method="post" id="change_app_logo_form" enctype="multipart/form-data">
                        @csrf
                        <div class="container-fluid">
                            <div class="row">
                                <!-- show message when companies positions  added  start  -->
                                <div class="mb-3 col-md-12">
                  <div class="alert alert-success  text-white d-none  user_updated_msg" role="alert">
                    App logo Changed
                    <i class="fa-solid fa-xmark  fa_xmark_user xmark_logo float-end fs-4"></i>
                  </div>
                </div>
                                <!-- show message when companies positions  added  start  -->
                                <!-- user name -->
                                <div class="change_logo_parent d-flex flex-column align-items-center">
                                    <div class="col-md-6">
                                        <img src="{{asset('storage/app_logo/'.show_app_logo())}}" class="show_app_logo_img mb-3" alt="">
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <input type="File" class="form-control" placeholder="Upload Logo" aria-label="Upload Logo" name="app_logo" id="app_logo">
                                    </div>
                                    
                                    <div class="text-center col-md-6">
                                        <button type="submit" id="Change_logo_btn" class="btn bg-gradient-dark w-100 my-4 mb-2">Change Logo</button>
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
    "use strict";
$(document).ready(function () {
    @php
    $baseUrl = config('app.url');
    echo "var base_url = '".$baseUrl.
    "';";
    @endphp

    $('#change_app_logo_form').on('submit',function (e) {  
        e.preventDefault();
        $.ajax({
            type: "post",
            url: base_url+"update_app_logo",
            data: new FormData(this),
            processData:false,
            contentType:false,
            success: function (response) {
                if(response==true){
                    location.reload();
                    // $('.user_updated_msg').removeClass('d-none');
                }
                
            }
        });
    })
    // disapper logo msg 
    
});
</script>

@endSection
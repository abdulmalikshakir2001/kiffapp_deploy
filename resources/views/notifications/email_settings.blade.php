@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/notifications/css/notifications.css')}}">
@endSection
@section('body_content')
<div class="row">
    <div class="col-md-12">
        <!-- content start  -->
        <div class="container-fluid p-4 create_user_main">
            <div class="row">
                <div class="col-md-12">
                    <form role="form" action="" method="post" id="email_on_off_form">
                        @csrf
                        <div class="container-fluid">
                            <div class="row">
                            <div class="mb-3 col-md-12">
                                    <div class="alert alert-success  d-none text-white user_updated_msg" role="alert">
                                        Changes saved 
                                        <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                    </div>
                                </div>
                                <!-- show message when companies positions  added  start  -->
                                @foreach($notif_name as $notification_names)
                                
                                
                                <div class="mb-3 col-md-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="{{$notification_names->notification_name}}"   value="{{$notification_names->notification_name}}" name="{{$notification_names->notification_name}}" {{$notification_names->status=="1"?'checked':""}}>
                                        <label class="form-check-label" for="{{$notification_names->notification_name}}">{{$notification_names->notification_name}}</label>
                                    </div>
                                </div>
                                
                                @endforeach
                                



                                <div class="text-center">
                                    <button type="submit" id="email_switch_btn" class="btn bg-gradient-dark w-100 my-4 mb-2">Save</button>
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
          echo "var base_url = '" . $baseUrl . "';";
      @endphp
    $('#email_on_off_form').on('submit',function(e){
        e.preventDefault();
        $.ajax({
            type: "post",
            url: base_url+"on_off_email",
            data: $('#email_on_off_form').serialize(),
            success: function (response) {
                if(response){
                    $('.user_updated_msg').removeClass('d-none');
                }
                
            }
        });
    })
});
</script>
@endSection
@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/webfront/header/css/header.css')}}">
@endSection
@section('body_content')
<div class="row">
    <div class="col-md-12">
        <!-- content start  -->
        <div class="container-fluid p-4 create_user_main">
            <div class="row">
                <div class="col-md-12">
                    <form role="form" action="" method="post" id="webfront_header_updated_form">
                        @csrf
                        <div class="container-fluid">
                            <div class="row">
                                <!-- input hidden -->
                                <input type="hidden" id="id" name="id" value="{{$header->id}}">
                                <!-- show message when companies positions  added  start  -->
                                <div class="mb-3 col-md-12">
                  <div class="alert alert-success  d-none text-white user_updated_msg" role="alert">
                    Web Front Header  updated 
                    <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                  </div>
                </div>
                                <!-- show message when companies positions  added  start  -->
                      <!-- header-->
                      <div class="header_parent d-flex flex-column align-items-center">
                      <div class="mb-3 col-md-12">
                                    <label>Header</label>
                                    <textarea name="header" id="header" cols="" rows="1" placeholder="Header" class="form-control">{{ htmlentities($header->header)}}</textarea>
                                </div>
                                <div class="text-center col-md-6">
                                    <button type="submit" id="added_webfront_header_btn" class="btn bg-gradient-dark w-100 my-4 mb-2">update Header</button>
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
    tinymce.init({
        selector: "#header",
        
        toolbar:
            "undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat",
        tinycomments_mode: "embedded",
        tinycomments_author: "Author name",
        mergetags_list: [
            { value: "First.Name", title: "First Name" },
            { value: "Email", title: "Email" },
        ],
    });

    //   update header start
    $("#webfront_header_updated_form").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: base_url + "database_update_head",
            data: $("#webfront_header_updated_form").serialize(),
            success: function (response) {
                $('.user_updated_msg').removeClass('d-none')
            },
        });
    });
    //   update header end
    //   update body start
    $("#webfront_body_updated_form").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: base_url + "database_update_body",
            data: $("#webfront_body_updated_form").serialize(),
            success: function (response) {
                $('.user_updated_msg').removeClass('d-none')
            },
        });
    });
    //   update body end
    //   update footer start
    $("#webfront_footer_updated_form").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: base_url + "database_update_footer",
            data: $("#webfront_footer_updated_form").serialize(),
            success: function (response) {
                $('.user_updated_msg').removeClass('d-none')
            },
        });
    });
    //   update footer start
});

</script>

@endSection
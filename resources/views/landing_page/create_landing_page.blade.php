@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/landing_page/css/landing_page.css')}}">
@endSection
@section('body_content')
<div class="row">
    <div class="col-md-12">
        <!-- content start  -->
        <div class="container-fluid p-4 create_user_main">
            <div class="row">
                <div class="col-md-12">
                    <form role="form" action="" method="post" id="landing_page_form">
                        @csrf
                        <div class="container-fluid">
                            <div class="row">
                                <!-- show message when companies positions  added  start  -->
                                <div class="mb-3 col-md-12">
                                    <div class="alert alert-success  d-none text-white user_updated_msg" role="alert">
                                        Landing page added
                                        <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                    </div>
                                </div>
                                <!-- show message when companies positions  added  start  -->
                                <div class="landing_page_items d-flex flex-column align-items-center">
                                <!-- header-->
                                <div class="mb-3 col-md-6">
                                    <label>Header</label>
                                    <textarea name="header" id="header" cols="" rows="1" placeholder="Header" class="form-control"></textarea>
                                </div>
                                <!-- main content-->
                                <div class="mb-3 col-md-6">
                                    <label>Mian content of landing page</label>
                                    <textarea name="main_content" id="main_content" cols="" rows="1" placeholder="Main content" class="form-control"></textarea>
                                </div>
                                <!-- footer-->
                                <div class="mb-3 col-md-6">
                                    <label>Footer of landing page</label>
                                    <textarea name="footer" id="footer" cols="" rows="1" placeholder="footer" class="form-control"></textarea>
                                </div>
                                <!-- url -->
                                <div class="mb-3 col-md-6">
                                    <label>Unique name for landing page</label>
                                    <input type="text" class="form-control" placeholder="Unique url" aria-label="Middle name" name="unique_url_code" id="unique_url_code">
                                </div>
                                <!-- product template -->
                                <div class="mb-3 col-md-6">
                                    <label>Unique name for landing page</label>
                                    <input type="text" class="form-control" placeholder="Product template" aria-label="Middle name" name="product_template" id="product_template">
                                </div>
                                <div class="text-center col-md-6">
                                    <button type="submit" id="added_com_dep_btn" class="btn bg-gradient-dark w-100 my-4 mb-2">Add Landing Page</button>
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
            echo "var base_url = '" . $baseUrl . "';";
        @endphp
    // martial status
    // $("#company_id").select2({
    //     placeholder: "Select Company",
    //     allowClear: true,
    //     width: "100%",
    // });
    // add department start
    $("#landing_page_form").validate({
        rules: {
            header: {
                required: true,
            },

            main_content: {
                required: true,
            },
            footer: {
                required: true,
            },
            unique_url_code: {
                required: true,
                remote: {
                    url: base_url + "is_exist_url",
                    type: "post",
                    data: {
                        unique_url_code: function () {
                            return $("#unique_url_code").val();
                        },
                        _token: $('meta[name="csrf-token"]').attr("content"),
                    },
                },
            },
            product_template: {
                required: true,
            },
        },
        messages: {
            footer: {
                required: "footer required",
            },
            header: {
                required: "Header required",
            },
            main_content: {
                required: "Content Required",
            },
            unique_url_code: {
                required: " Unique url code required",
                remote: "Url already exist",
            },
            product_template: {
                required: " Template  required",
            },
        },
        submitHandler: function (form) {
            $.ajax({
                type: "post",
                url: base_url + "landing_page",
                data: $(form).serialize(),
                dataType: "json",
                success: function (response) {
                    if (response) {
                        $(".user_updated_msg").removeClass("d-none");
                        $("#landing_page_form").trigger("reset");
                    }
                },
            });
        },
    });

    // add department end
    // dattables
    $(function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $("#view_landing_page").DataTable({
            processing: true,
            serverSide: true,
            ajax: base_url + "get_data_landing_page",
            columns: [
                { data: "DT_RowIndex", name: "DT_RowIndex" },
                { data: "header", name: "header" },
                { data: "main_content", name: "main_content" },
                { data: "footer", name: "footer" },
                { data: "unique_url_code", name: "unique_url_code" },
                { data: "action", name: "action" },
            ],
        });
    });
    // dattables end

    // delete user start
    $(document).on("click", ".landing_page_delete_btn", function (param) {
        let delete_landing_page_id = $(this).data("delete_landing_page_id");
        $(".confirm_delete_landing_page").on("click", function () {
            $.ajax({
                type: "post",
                url: base_url + "delete_landing_page",
                data: { delete_landing_page_id: delete_landing_page_id },
                dataType: "json",
                success: function (response) {
                    if (response) {
                        $("#view_landing_page").DataTable().ajax.reload();
                    }
                },
            });
        });
    });
    // delete user end
    // update start
    $(document).on("click", ".landing_page_edit_btn", function (param) {
        let update_landing_page_id = $(this).data("update_landing_page_id");
        location.replace(
            base_url + "updateLandingPage/" + update_landing_page_id
        );
    });
    $("#update_landing_page_form").validate({
        rules: {
            header: {
                required: true,
            },

            main_content: {
                required: true,
            },
            footer: {
                required: true,
            },
            unique_url_code: {
                required: true,
                remote: {
                    url: base_url + "isExistUrlUpdate",
                    type: "post",
                    data: {
                        unique_url_code: function () {
                            return $("#unique_url_code").val();
                        },
                        id:$('#id').val(),
                        
                        _token: $('meta[name="csrf-token"]').attr("content"),
                    },
                },
            },
            product_template: {
                required: true,
            },
        },
        messages: {
            footer: {
                required: "footer required",
            },
            header: {
                required: "Header required",
            },
            main_content: {
                required: "Content Required",
            },
            unique_url_code: {
                required: " Unique url code required",
                remote: "Url already exist",
            },
            product_template: {
                required: " Template  required",
            },
        },
        submitHandler: function (form) {
            $.ajax({
                type: "post",
                url: base_url + "update_landing_page",
                data: $(form).serialize(),
                dataType: "json",
                success: function (response) {
                    if (response) {
                        $(".user_updated_msg").removeClass("d-none");
                    }
                },
            });
        },
    });
    // update end
});

</script>

@endSection
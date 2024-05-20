@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/companies_departments/css/companies_departments.css')}}">
@endSection
@section('body_content')
<div class="row">
    <div class="col-md-12">
        <!-- content start  -->
        <div class="container-fluid p-4 create_user_main">
            <div class="row">
                <div class="col-md-12">
                    <form role="form" action="" method="post" id="companies_departments_updated_form">
                        @csrf
                        <input type="hidden" name="department_id" id="department_id" value="{{$single_com_dep->department_id}}">
                        <div class="container-fluid">
                            <div class="row">
                                <!-- show message when companies positions  added  start  -->
                                <div class="mb-3 col-md-12">
                                    <div class="alert alert-success  d-none text-white user_updated_msg" role="alert">
                                        Companies Department updated
                                        <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                    </div>
                                </div>
                                <!-- show message when companies positions  added  start  -->
                                <!-- user name -->
                                <div class="mb-3 col-md-6">
                                    <input type="text" class="form-control" placeholder="Department Name" aria-label="Department Name" name="department_name" id="department_name" value="{{$single_com_dep->department_name}}">
                                </div>

                                <div class="text-center">
                                    <button type="submit" id="update_com_dep_btn" class="btn bg-gradient-dark w-100 my-4 mb-2">Update Department</button>
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
    // martial status
    $("#company_id").select2({
        placeholder: "Select Company",
        allowClear: true,
        width: "100%",
    });
    // add department start
    $("#companies_departments_form").validate({
        rules: {
            department_name: {
                required: true,
            },
            company_id: {
                required: true,
                number: true,
            },
        },
        messages: {
            department_name: {
                required: "Department Required",
            },
            company_id: {
                required: "Country Required",
                number: "only numbers are allowed",
            },
        },
        submitHandler: function (form) {
            $.ajax({
                type: "post",
                url: base_url + "companies_department",
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

    // add department end
    // dattables
    $(function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $("#view_companies_departments").DataTable({
            processing: true,
            serverSide: true,
            ajax: base_url + "get_data_com_dep",
            columns: [
                { data: "DT_RowIndex", name: "DT_RowIndex" },
                { data: "department_name", name: "department_name" },
                { data: "action", name: "action" },
            ],
        });
    });
    // dattables end

    // delete user start
    $(document).on("click", ".com_dep_delete_btn", function (param) {
        let delete_com_dep_id = $(this).data("delete_com_dep_id");
        $(".confirm_delete_com_dep").on("click", function () {
            $.ajax({
                type: "post",
                url: base_url + "delete_com_dep",
                data: { delete_com_dep_id: delete_com_dep_id },
                dataType: "json",
                success: function (response) {
                    if (response) {
                        $("#view_companies_departments")
                            .DataTable()
                            .ajax.reload();
                    }
                },
            });
        });
    });
    // delete user end
    // update start
    $(document).on("click", ".com_dep_edit_btn", function (param) {
        let update_com_dep_id = $(this).data("update_com_dep_id");
        location.replace(base_url + "updateDepartment/" + update_com_dep_id);
    });
    $("#companies_departments_updated_form").validate({
        rules: {
            department_name: {
                required: true,
            },
            company_id: {
                required: true,
                number: true,
            },
        },
        messages: {
            department_name: {
                required: "Department Required",
            },
            company_id: {
                required: "Country Required",
                number: "only numbers are allowed",
            },
        },
        submitHandler: function (form) {
            $.ajax({
                type: "post",
                url: base_url + "update_com_dep",
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
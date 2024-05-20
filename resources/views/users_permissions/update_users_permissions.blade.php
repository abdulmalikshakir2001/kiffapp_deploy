@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/users_permissions/css/users_permissions.css')}}">
@endSection
@section('body_content')
<div class="row">
    <div class="col-md-12">
        <!-- content start  -->
        <div class="container-fluid p-4 create_user_main">
            <div class="row">
                <div class="col-md-12">
                    <form role="form" action="" method="post" id="users_permissions_updated_form">
                        <input type="hidden" name="permission_id" id="permission_id" value="{{$single_users_permissions->permission_id}}">
                        @csrf
                        <div class="container-fluid">
                            <div class="row">
                                <!-- show message when companies positions  added  start  -->
                                <div class="mb-3 col-md-12">
                  <div class="alert alert-success  d-none text-white user_updated_msg" role="alert">
                  Users Permissions Updated 
                    <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                  </div>
                </div>
                                <!-- show message when companies positions  added  start  -->
                                <!-- app module  name -->
                                <div class="mb-3 col-md-6">
                                    <input type="text" class="form-control" placeholder="App module Name" aria-label="App module Name" name="app_module_name" id="app_module_name" 
                                    value="{{$single_users_permissions->app_module_name}}">
                                </div>
                                <!-- permission  name -->
                                <div class="mb-3 col-md-6">
                                    <input type="text" class="form-control" placeholder="Permission Name" aria-label="Permission Name" name="permission_name" id="permission_name"
                                    value="{{$single_users_permissions->permission_name}}"
                                    >
                                </div>
                                
                                <div class="text-center">
                                    <button type="submit" id="update_users_permissions_btn" class="btn bg-gradient-dark w-100 my-4 mb-2">Update permissions</button>
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
    
    // add users permissions start
    $("#users_permissions_form").validate({
        rules: {
            app_module_name: {
                required: true,
            },
            
        },
        messages: {
            app_module_name: {
                required: "This field is required",
            },
            
        },
        submitHandler: function (form) {
            $.ajax({
                type: "post",
                url: base_url + "users_permissions",
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

        $("#view_users_permissions").DataTable({
            processing: true,
            serverSide: true,
            ajax: base_url + "get_data_users_permissions",
            columns: [
                { data: "DT_RowIndex", name: "DT_RowIndex" },
                { data: "app_module_name", name: "app_module_name" },
                { data: "permission_name", name: "permission_name" },
                { data: "action", name: "action" },
            ],
        });
    });
    // dattables end

    // delete user start
    $(document).on("click", ".users_permissions_delete_btn", function (param) {
        let delete_users_permissions_id = $(this).data("delete_users_permissions_id");
        $(".confirm_delete_users_permissions").on("click", function () {
            $.ajax({
                type: "post",
                url: base_url + "delete_users_permissions",
                data: { delete_users_permissions_id: delete_users_permissions_id },
                dataType: "json",
                success: function (response) {
                    if (response) {
                        $("#view_users_permissions")
                            .DataTable()
                            .ajax.reload();
                    }
                },
            });
        });
    });
    // delete user end
    // update start
    $(document).on("click", ".users_permissions_edit_btn", function (param) {
        let update_users_permissions_id = $(this).data("update_users_permissions_id");
        location.replace(base_url + "updateUsersPermissions/" + update_users_permissions_id);
    });
    $("#users_permissions_updated_form").validate({
        rules: {
            app_module_name: {
                required: true,
            },
            
        },
        messages: {
            app_module_name: {
                required: "This field is required Required",
            },
            
        },
        submitHandler: function (form) {
            $.ajax({
                type: "post",
                url: base_url + "update_users_permissions",
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
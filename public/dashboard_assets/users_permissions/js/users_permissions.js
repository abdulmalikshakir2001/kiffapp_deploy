"use strict";
$(document).ready(function () {
    const base_url = "http://127.0.0.1:8000/";
    
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

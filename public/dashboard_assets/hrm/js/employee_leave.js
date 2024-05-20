"use strict";
$(document).ready(function () {
    // parse html entities start
    function html_decode(input) {
        let parser = new DOMParser().parseFromString(input, "text/html");
        return parser.documentElement.textContent;
    }
    // parse html entities end

    // tiny mce start
    const base_url = "http://127.0.0.1:8000/";
    // Leave Type
    $("#leave_type_id").select2({
        placeholder: "Leave Type",
        allowClear: true,
        width: "100%",
    });
    // $("#employee_leave_update_form #leave_type_id").select2({
    //     placeholder: "Leave Type",
    //     allowClear: true,
    //     width: "100%",
    // });
    // Leave Type
    $("#user_id").select2({
        placeholder: "Employee Name",
        allowClear: true,
        width: "100%",
    });
    // $("#employee_leave_update_form #employee_id").select2({
    //     placeholder: "Employee Name",
    //     allowClear: true,
    //     width: "100%",
    // });

    // add job vacancies  start
    $("#employee_leave_form").validate({
        rules: {
            user_id: {
                required: true,
            },
            leave_type_id: {
                required: true,
            },
            start_date: {
                required: true,
            },
            end_date: {
                required: true,
            },
        },
        messages: {
            user_id: {
                required: "Employee name required",
            },
            leave_type_id: {
                required: "Leave Type required",
            },
            start_date: {
                required: "Start Date Required",
            },
            end_date: {
                required: "End Date Required",
            },
        },
        submitHandler: function (form) {
            $.ajax({
                type: "post",
                url: base_url + "employee_leave",
                data: $(form).serialize(),
                dataType: "json",
                success: function (response) {
                    if (response) {
                        $("#employee_leave_form").trigger("reset");
                        $("#view_employee_leave").DataTable().ajax.reload();
                        $("#add_employee_leave").modal("toggle");
                        $(".leave_added_msg").removeClass("d-none");
                    }
                },
            });
        },
    });

    // add job vaccanices end
    // dattables
    $(function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $("#view_employee_leave").DataTable({
            processing: true,
            serverSide: true,
            ajax: base_url + "get_data_employee_leave",
            columns: [
                { data: "DT_RowIndex", name: "DT_RowIndex" },
                { data: "username", name: "username" },
                { data: "leave_type", name: "leave_type" },
                { data: "start_date", name: "start_date" },
                { data: "end_date", name: "end_date" },
                { data: "is_paid", name: "is_paid" },
                { data: "approval_status", name: "approval_status" },
                { data: "action", name: "action" },
            ],
        });
    });
    // dattables end

    // delete user start
    $(document).on("click", ".employee_leave_delete_btn", function (param) {
        let delete_employee_leave_id = $(this).data("delete_employee_leave_id");
        $(".confirm_delete_employee_leave").on("click", function () {
            $.ajax({
                type: "post",
                url: base_url + "delete_employee_leave",
                data: { delete_employee_leave_id: delete_employee_leave_id },
                dataType: "json",
                success: function (response) {
                    if (response) {
                        $("#view_employee_leave").DataTable().ajax.reload();
                        $(".employee_leave_deleted_msg").removeClass("d-none");
                    }
                },
            });
        });
    });
    // delete user end
    // update employee leave  start
    $(document).on("click", ".employee_leave_edit_btn", function (param) {
        let update_employee_leave_id = $(this).data("update_employee_leave_id");
        $.ajax({
            type: "post",
            url: base_url + "fetch_employee_leave",
            data: { update_employee_leave_id: update_employee_leave_id },
            dataType: "json",
            success: function (response) {
                if (response) {
                    $("#employee_leave_update_form")
                        .find("#user_id")
                        .val(response.user_id);
                    $("#employee_leave_update_form")
                        .find(".leave_type_id")
                        .val(response.leave_type_id);
                    $("#employee_leave_update_form")
                        .find("#start_date")
                        .val(response.start_date);
                    $("#employee_leave_update_form")
                        .find("#end_date")
                        .val(response.end_date);
                    $("#employee_leave_update_form")
                        .find("#employee_leave_id")
                        .val(response.employee_leave_id);

                    if (response.is_paid == "paid") {
                        $("#employee_leave_update_form")
                            .find("#is_paid")
                            .prop("checked", true);
                    } else {
                        $("#employee_leave_update_form")
                            .find("#is_paid")
                            .prop("checked", false);
                    }
                }
            },
        });
    });

    $("#employee_leave_update_form").validate({
        rules: {
            user_id: {
                required: true,
            },
            leave_type_id: {
                required: true,
            },
            start_date: {
                required: true,
            },
            end_date: {
                required: true,
            },
        },
        messages: {
            user_id: {
                required: "Employee name required",
            },
            leave_type_id: {
                required: "Leave Type required",
            },
            start_date: {
                required: "Start Date Required",
            },
            end_date: {
                required: "End Date Required",
            },
        },
        submitHandler: function (form) {
            $.ajax({
                type: "post",
                url: base_url + "update_employee_leave",
                data: $(form).serialize(),
                dataType: "json",
                success: function (response) {
                    if (response) {
                        $("#view_employee_leave").DataTable().ajax.reload();
                        $(".employee_leave_updated_msg").removeClass("d-none");
                        $("#employee_leave_update_form").trigger("reset");
                    }
                },
            });
        },
    });
    // update employee leave  end

    // add  button to data table to add job vacancy start
    // adding button to the create user datatable to add user start
    setTimeout(() => {
        $(document).find("#view_employee_leave_filter").append(
            '<span class="add_user_div" ">\
                         <button type="button" class="btn bg-primary sidenav_zero_index add_employee_leave_btn btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#add_employee_leave" style="height:32px"> <i class="fa-solid fa-plus text-white"></i>\
                </button>\
          </span>\
       '
        );
        // check the contstains for company owner to add user start
    }, 1);
    // add  button to data table to add job vacancy end

    // approve leave start
    $(document).on("click", ".approve_leave", function (param) {
        let employee_leave_id = $(this).data("employee_leave_id");
            $.ajax({
                type: "post",
                url: base_url + "approve_employee_leave",
                data: { employee_leave_id: employee_leave_id},
                dataType: "json",
                success: function (response) {
                    if (response) {
                        $("#view_employee_leave").DataTable().ajax.reload();
                    }
                },
        });
    });

    // approve leave end
    // reject leave start
    $(document).on("click", ".reject_leave", function (param) {
        let employee_leave_id = $(this).data("employee_leave_id");
            $.ajax({
                type: "post",
                url: base_url + "reject_employee_leave",
                data: { employee_leave_id: employee_leave_id},
                dataType: "json",
                success: function (response) {
                    if (response=="true") {
                        $("#view_employee_leave").DataTable().ajax.reload();
                    }
                },
        });
    });

    // reject leave end
});

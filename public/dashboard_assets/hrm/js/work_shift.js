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

    // add job vacancies  start
    $("#work_shift_form").validate({
        rules: {
            shift_name: {
                required: true,
            },

            start_time: {
                required: true,
            },
            end_time: {
                required: true,
            },
        },
        messages: {
            shift_name: {
                required: "Shift Name required",
            },
            start_time: {
                required: "Start time Required",
            },
            end_date: {
                required: "End time Required",
            },
        },
        submitHandler: function (form) {
            $.ajax({
                type: "post",
                url: base_url + "work_shift",
                data: $(form).serialize(),
                dataType: "json",
                success: function (response) {
                    if (response) {
                        $("#work_shift_form").trigger("reset");
                        $("#view_work_shift").DataTable().ajax.reload();
                        $("#add_work_shift").modal("toggle");
                        $(".work_shift_added_msg").removeClass("d-none");
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

        $("#view_work_shift").DataTable({
            processing: true,
            serverSide: true,
            ajax: base_url + "get_data_work_shift",
            columns: [
                { data: "DT_RowIndex", name: "DT_RowIndex" },
                { data: "shift_name", name: "shift_name" },
                { data: "start_time", name: "start_time" },
                { data: "end_time", name: "end_time" },
                { data: "compromize_time", name: "compromize_time" },
                { data: "action", name: "action" },
            ],
        });
    });
    // dattables end

    // delete user start
    $(document).on("click", ".work_shift_delete_btn", function (param) {
        let delete_work_shift_id = $(this).data("delete_work_shift_id");
        $(".confirm_delete_work_shift").on("click", function () {
            $.ajax({
                type: "post",
                url: base_url + "delete_work_shift",
                data: { delete_work_shift_id: delete_work_shift_id },
                dataType: "json",
                success: function (response) {
                    if (response) {
                        $("#view_work_shift").DataTable().ajax.reload();
                        $(".work_shift_deleted_msg").removeClass("d-none");
                    }
                },
            });
        });
    });
    // delete user end
    // update employee leave  start
    $(document).on("click", ".work_shift_edit_btn", function (param) {
        let update_work_shift_id = $(this).data("update_work_shift_id");
        $.ajax({
            type: "post",
            url: base_url + "fetch_work_shift",
            data: { update_work_shift_id: update_work_shift_id },
            dataType: "json",
            success: function (response) {
                if (response) {
                    $("#work_shift_update_form")
                        .find("#work_shift_id")
                        .val(response.work_shift_id);
                    $("#work_shift_update_form")
                        .find("#shift_name")
                        .val(response.shift_name);
                    $("#work_shift_update_form")
                        .find("#start_time")
                        .val(response.start_time);
                    $("#work_shift_update_form")
                        .find("#end_time")
                        .val(response.end_time);
                    $("#work_shift_update_form")
                        .find("#compromize_time")
                        .val(response.compromize_time);
                }
            },
        });
    });

    $("#work_shift_update_form").validate({
        rules: {
            shift_name: {
                required: true,
            },

            start_time: {
                required: true,
            },
            end_time: {
                required: true,
            },
        },
        messages: {
            shift_name: {
                required: "Shift Name required",
            },
            start_time: {
                required: "Start time Required",
            },
            end_date: {
                required: "End time Required",
            },
        },
        submitHandler: function (form) {
            $.ajax({
                type: "post",
                url: base_url + "update_work_shift",
                data: $(form).serialize(),
                dataType: "json",
                success: function (response) {
                    if (response) {
                        $("#view_work_shift").DataTable().ajax.reload();
                        $(".work_shift_updated_msg").removeClass("d-none");
                        $("#work_shift_update_form").trigger("reset");
                        $('#update_work_shift').modal("toggle")
                    }
                },
            });
        },
    });
    // update employee leave  end

    // add  button to data table to add job vacancy start
    // adding button to the create user datatable to add user start
    setTimeout(() => {
        $(document).find("#view_work_shift_filter").append(
            '<span class="add_user_div" ">\
                         <button type="button" class="btn bg-primary sidenav_zero_index add_work_shift_btn btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#add_work_shift" style="height:32px"> <i class="fa-solid fa-plus text-white"></i>\
                </button>\
          </span>\
       '
        );
        // check the contstains for company owner to add user start
    }, 1);
    // add  button to data table to add job vacancy end
});

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
    $("#public_holiday_form").validate({
        rules: {
            holiday_name: {
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
            holiday_name: {
                required: "Holiday Name required",
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
                url: base_url + "public_holiday",
                data: $(form).serialize(),
                dataType: "json",
                success: function (response) {
                    if (response) {
                        $("#public_holiday_form").trigger("reset");
                        $("#view_public_holiday").DataTable().ajax.reload();
                        $("#add_public_holiday").modal("toggle");
                        $(".public_holiday_added_msg").removeClass("d-none");
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

        $("#view_public_holiday").DataTable({
            processing: true,
            serverSide: true,
            ajax: base_url + "get_data_public_holiday",
            columns: [
                { data: "DT_RowIndex", name: "DT_RowIndex" },
                { data: "holiday_name", name: "holiday_name" },
                { data: "start_date", name: "start_date" },
                { data: "end_date", name: "end_date" },
                { data: "action", name: "action" },
            ],
        });
    });
    // dattables end

    // delete user start
    $(document).on("click", ".public_holiday_delete_btn", function (param) {
        let delete_public_holiday_id = $(this).data("delete_public_holiday_id");
        $(".confirm_delete_public_holiday").on("click", function () {
            $.ajax({
                type: "post",
                url: base_url + "delete_public_holiday",
                data: { delete_public_holiday_id: delete_public_holiday_id },
                dataType: "json",
                success: function (response) {
                    if (response) {
                        $("#view_public_holiday").DataTable().ajax.reload();
                        $(".public_holiday_deleted_msg").removeClass("d-none");
                    }
                },
            });
        });
    });
    // delete user end
    // update employee leave  start
    $(document).on("click", ".public_holiday_edit_btn", function (param) {
        let update_public_holiday_id = $(this).data("update_public_holiday_id");
        $.ajax({
            type: "post",
            url: base_url + "fetch_public_holiday",
            data: { update_public_holiday_id: update_public_holiday_id },
            dataType: "json",
            success: function (response) {
                if (response) {
                    $("#public_holiday_update_form")
                        .find("#public_holiday_id")
                        .val(response.public_holiday_id);
                    $("#public_holiday_update_form")
                        .find("#holiday_name")
                        .val(response.holiday_name);
                    $("#public_holiday_update_form")
                        .find("#start_date")
                        .val(response.start_date);
                    $("#public_holiday_update_form")
                        .find("#end_date")
                        .val(response.end_date);
                }
            },
        });
    });

    $("#public_holiday_update_form").validate({
        rules: {
            holiday_name: {
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
            holiday_name: {
                required: "Holiday Name required",
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
                url: base_url + "update_public_holiday",
                data: $(form).serialize(),
                dataType: "json",
                success: function (response) {
                    if (response) {
                        $("#view_public_holiday").DataTable().ajax.reload();
                        $(".public_holiday_updated_msg").removeClass("d-none");
                        $("#public_holiday_update_form").trigger("reset");
                        $('#update_public_holiday').modal("toggle")
                    }
                },
            });
        },
    });
    // update employee leave  end

    // add  button to data table to add job vacancy start
    // adding button to the create user datatable to add user start
    setTimeout(() => {
        $(document).find("#view_public_holiday_filter").append(
            '<span class="add_user_div" ">\
                         <button type="button" class="btn bg-primary sidenav_zero_index add_public_holiday_btn btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#add_public_holiday" style="height:32px"> <i class="fa-solid fa-plus text-white"></i>\
                </button>\
          </span>\
       '
        );
        // check the contstains for company owner to add user start
    }, 1);
    // add  button to data table to add job vacancy end
});

"use strict";
$(document).ready(function () {
    const base_url = "http://127.0.0.1:8000/";
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

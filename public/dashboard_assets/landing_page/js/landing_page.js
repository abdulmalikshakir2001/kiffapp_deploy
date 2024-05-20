"use strict";
$(document).ready(function () {
    const base_url = "http://127.0.0.1:8000/";
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

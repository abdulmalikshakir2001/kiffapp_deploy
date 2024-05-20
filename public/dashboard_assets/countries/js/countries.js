"use strict";
$(document).ready(function () {
    const base_url = "http://127.0.0.1:8000/";

    // add countries start
    $("#countries_form").validate({
        rules: {
            country: {
                required: true,
            },
            currency: {
                required: true,
            },
            currency_code: {
                required: true,
            },
            currency_symbol: {
                required: true,
            },
            thousand_separator: {
                required: true,
            },
            decimal_separator: {
                required: true,
            },
        },
        messages: {
            country: {
                required: "Country Required",
            },
            currency: {
                required: "Currency Required",
            },
            currency_code: {
                required: "Currency code required",
            },
            currency_symbol: {
                required: "Currency symbol required",
            },
            thousand_separator: {
                required: "Thousand separator required",
            },
            decimal_separator: {
                required: "Decimal Separator required",
            },
        },
        submitHandler: function (form) {
            $.ajax({
                type: "post",
                url: base_url + "countries",
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
    // add countries end
    // dattables
    $(function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $("#view_countries").DataTable({
            processing: true,
            serverSide: true,
            ajax: base_url + "get_data_countries",
            columns: [
                { data: "DT_RowIndex", name: "DT_RowIndex" },
                { data: "country", name: "country" },
                { data: "currency", name: "currency" },
                { data: "currency_code", name: "currency_code" },
                { data: "currency_symbol", name: "currency_symbol" },
                { data: "thousand_separator", name: "thousand_separator" },
                { data: "decimal_separator", name: "decimal_separator" },
                { data: "action", name: "action" },
            ],
        });
    });
    // dattables end

    // delete user start
    $(document).on("click", ".countries_delete_btn", function (param) {
        let delete_countries_id = $(this).data("delete_countries_id");
        $(".confirm_delete_countries").on("click", function () {
            $.ajax({
                type: "post",
                url: base_url + "delete_countries",
                data: { delete_countries_id: delete_countries_id },
                dataType: "json",
                success: function (response) {
                    if (response) {
                        $("#view_countries")
                            .DataTable()
                            .ajax.reload();
                    }
                },
            });
        });
    });
    // delete user end
    // update start
    $(document).on("click", ".countries_edit_btn", function (param) {
        let update_countries_id = $(this).data("update_countries_id");
        location.replace(base_url + "updateCountries/" + update_countries_id);
    });
    $("#countries_updated_form").validate({
        rules: {
            country: {
                required: true,
            },
            currency: {
                required: true,
            },
            currency_code: {
                required: true,
            },
            currency_symbol: {
                required: true,
            },
            thousand_separator: {
                required: true,
            },
            decimal_separator: {
                required: true,
            },
        },
        messages: {
            country: {
                required: "Country Required",
            },
            currency: {
                required: "Currency Required",
            },
            currency_code: {
                required: "Currency code required",
            },
            currency_symbol: {
                required: "Currency symbol required",
            },
            thousand_separator: {
                required: "Thousand separator required",
            },
            decimal_separator: {
                required: "Decimal Separator required",
            },
        },
        submitHandler: function (form) {
            $.ajax({
                type: "post",
                url: base_url + "update_countries",
                data: $(form).serialize(),
                dataType: "json",
                success: function (response) {
                    if (response) {
                        $(".user_updated_msg").removeClass("d-none");
                        $('#view_countries').DataTable().ajax.relaod();
                    }
                },
            });
        },
    });
    // update end
});

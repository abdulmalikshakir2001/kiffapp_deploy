@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/countries/css/countries.css')}}">
@endSection
@section('body_content')
<div class="row">
    <div class="col-md-12">
        <!-- content start  -->
        <div class="container-fluid p-4 create_user_main">
            <div class="row">
                <div class="col-md-12">
                    <form role="form" action="" method="post" id="countries_form">
                        @csrf
                        <div class="container-fluid">
                            <div class="row">
                                <!-- show message when companies positions  added  start  -->
                                <div class="mb-3 col-md-12">
                  <div class="alert alert-success  d-none text-white user_updated_msg" role="alert">
                  Country added 
                    <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                  </div>
                </div>
                                <!-- show message when companies positions  added  start  -->
                                <!-- Country -->
                                <div class="mb-3 col-md-6">
                                    <input type="text" class="form-control" placeholder="Country Name" aria-label="Country" name="country" id="country">
                                </div>
                                <!-- currency -->
                                <div class="mb-3 col-md-6">
                                    <input type="text" class="form-control" placeholder="Currency" aria-label=" Currency" name="currency" id="currency">
                                </div>
                                <!-- currency_code -->
                                <div class="mb-3 col-md-6">
                                    <input type="text" class="form-control" placeholder="Currency Code" aria-label=" Currency Code" name="currency_code" id="currency_code">
                                </div>
                                <!-- currency_symbol -->
                                <div class="mb-3 col-md-6">
                                    <input type="text" class="form-control" placeholder="Currency Symbol" aria-label=" Currency Symbol" name="currency_symbol" id="currency_symbol">
                                </div>
                                <!-- thousand_separator -->
                                <div class="mb-3 col-md-6">
                                    <input type="text" class="form-control" placeholder="Thousand Separator" aria-label=" Thousand Separator" name="thousand_separator" id="thousand_separator">
                                </div>
                                <!-- decimal_separator -->
                                <div class="mb-3 col-md-6">
                                    <input type="text" class="form-control" placeholder="Decimal Separator" aria-label=" Decimal Separator" name="decimal_separator" id="decimal_separator">
                                </div>
                                <div class="text-center">
                                    <button type="submit" id="add_countries_btn" class="btn bg-gradient-dark w-100 my-4 mb-2">Add Country</button>
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

</script>
@endSection
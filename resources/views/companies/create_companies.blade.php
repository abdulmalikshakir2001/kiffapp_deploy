@extends('dashboard/nav_footer')
@section('page_header_links')
    <link rel="stylesheet" href="{{ asset('dashboard_assets/companies/css/companies.css') }}">
@endSection
@section('body_content')
    <div class="row">
        <div class="col-md-12">

            <form action="" id="companies_form">

                @csrf


                <div class="container-fluid profile">
                    <div class="row gy-4 profile_row">
                        <!--  lable div end  -->
                        <div class="col-md-12">
                            <div class="parent">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h5 class="">Create Company</h5>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="alert alert-success  d-none text-white crmLeadAddedMessage user_updated_msg"
                                            role="alert" id="crmLeadaddedMessage">
                                            Company Created successfully
                                            <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- lable div end  -->

                        <!-- user information start  -->
                        <div class="col-md-8">
                            <div class="parent">
                                <h5 class="">Company Information</h5>
                                <div class="row gy-3">

                                    <div class="col-md-6">
                                        <label for="company_name">Company Name</label>
                                        <input type="text" class="form-control" placeholder="Company Name"
                                            aria-label="Company Name" name="company_name" id="company_name">
                                    </div>


                                    <div class="col-md-6">
                                        <label for="">Registration Number</label>
                                        <input type="text" class="form-control" placeholder="Registration Number"
                                            aria-label="Registration Number" name="registration_number"
                                            id="registration_number">

                                    </div>

                                    <div class="col-md-6">
                                        <label for="">Phone Number</label>
                                        <input type="text" class="form-control" placeholder="Phone Number"
                                            aria-label="Tax2 Number" name="phone_number" id="phone_number">

                                    </div>


                                    <div class="col-md-6">
                                        <label for="">Contact Number</label>
                                        <input type="text" class="form-control" placeholder="Contact Number"
                                            aria-label="Contact Number" name="contact_number" id="contact_number">

                                    </div>

                                    <div class="col-md-12">
                                        <label for="">Email</label>
                                        <input type="email" class="form-control" placeholder="Email" aria-label="Email"
                                            name="email" id="email">


                                    </div>

                                    <div class="col-md-12 form-check">
                                        <input type="checkbox" name="is_active" id="is_active" class="form-check-input">
                                        <label class="form-check-label" for="is_active">
                                            Is Active
                                        </label>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <!-- user information end  -->

                        <!-- logo start  -->
                        <div class="col-md-4">
                            <div class="parent h-100">
                                <h5 class="">Logo</h5>
                                <div class="row gy-4">
                                    <div class="col-md-12">
                                        <label for="">Upload Image</label>
                                        <input type="File" class="form-control" placeholder="profile_logo"
                                            aria-label="profile_logo" name="logo" id="logo">
                                    </div>


                                </div>
                            </div>
                        </div>
                        <!-- logo end  -->

                        <!--  location information  start  -->
                        <div class="col-md-12">
                            <div class="parent">
                                <h5 class="">Location Information</h5>
                                <div class="row gy-3">

                                    <div class="col-md-4">
                                        <label for="">Address</label>
                                        <textarea name="address" id="address" cols="" rows="1" class="form-control" placeholder="Address"></textarea>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="">City</label>
                                        <input type="text" class="form-control" placeholder="City" aria-label="City"
                                            name="city" id="city">
                                    </div>


                                    <div class="col-md-4">
                                        <label for="">State</label>
                                        <input type="text" class="form-control" placeholder="State"
                                            aria-label="State" name="state" id="state">
                                    </div>


                                    <div class="col-md-4">
                                        <label for="">Landmark</label>
                                        <input type="text" class="form-control" placeholder="landmark"
                                            aria-label="landmark" name="landmark" id="landmark">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="">Zip code</label>
                                        <input type="text" class="form-control" placeholder="Zip Code"
                                            aria-label="Zip Code" name="zip_code" id="zip_code">
                                    </div>








                                </div>
                            </div>
                        </div>

                        <!-- location information  start   -->








                        <!--  Settings  start  -->
                        <div class="col-md-12">
                            <div class="parent">
                                <h5 class="">Settings</h5>
                                <div class="row gy-3">




                                    <div class="col-md-4">
                                        <label for="">Position </label>
                                        <textarea cols="" rows="1" class="form-control" name="pos_settings" id="pos_settings"
                                            placeholder="Pos Settings"></textarea>
                                    </div>



                                    <div class="col-md-4">
                                        <label for="">Email Settings</label>

                                        <textarea cols="" rows="1" class="form-control" name="email_settings" id="email_settings"
                                            placeholder="Email Settings"> </textarea>
                                    </div>


                                    <div class="col-md-4">
                                        <label for="">Sms Settings</label>
                                        <textarea cols="" rows="1" class="form-control" name="sms_settings" id="sms_settings"
                                            placeholder="Sms Settings"></textarea>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="">Common Settings</label>

                                        <textarea cols="" rows="1" class="form-control" name="common_settings" id="common_settings"
                                            placeholder="Common Settings"></textarea>

                                    </div>




                                    <div class="col-md-4">
                                        <label for="">Website</label>
                                        <input type="text" class="form-control" placeholder="website"
                                            aria-label="website" name="website" id="website">

                                    </div>

                                    <div class="col-md-4">

                                    </div>





                                </div>
                            </div>
                        </div>
                        <!-- Settings end  -->


                        <!--  Product information  start  -->
                        <div class="col-md-12">
                            <div class="parent">
                                <h5 class="">Product Information</h5>
                                <div class="row gy-3">




                                    <div class="col-md-4">
                                        <label for="">Currency Symbol Placement</label>
                                        <select name="currency_symbol_placement" id="currency_symbol_placement"
                                            class="form-select currency_symbol_placement">
                                            <option></option>
                                            <option value="before">
                                                Before</option>
                                            <option value="after">
                                                After</option>
                                        </select>
                                    </div>



                                    <div class="col-md-4">
                                        <label for="">Stock Accounting Method</label>
                                        <select name="stock_accounting_method" id="stock_accounting_method"
                                            class="form-select stock_accounting_method">
                                            <option></option>
                                            <option value="fifo">
                                                FIFO</option>
                                            <option value="lifo">
                                                LIFO</option>
                                        </select>
                                    </div>


                                    <div class="col-md-4">
                                        <label for="">Enable Purchase</label>
                                        <select name="enable_purchase" id="enable_purchase"
                                            class="form-select enable_purchase">
                                            <option></option>
                                            <option value="1">Enable
                                            </option>
                                            <option value="0">Disable
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="">Enable Product Expiry</label>
                                        <select name="enable_product_expiry" id="enable_product_expiry"
                                            class="form-select enable_product_expiry">
                                            <option></option>
                                            <option value="1">
                                                Enable
                                            </option>
                                            <option value="0">
                                                Disable
                                            </option>
                                        </select>

                                    </div>


                                    <div class="col-md-4">
                                        <label for="">Enable Price Tax</label>
                                        <select name="enable_price_tax" id="enable_price_tax"
                                            class="form-select enable_price_tax">
                                            <option></option>
                                            <option value="1">Enable
                                            </option>
                                            <option value="0">Disable
                                            </option>
                                        </select>
                                    </div>



                                    <div class="col-md-4">
                                        <label for="">Enable Category</label>
                                        <select name="enable_category" id="enable_category"
                                            class="form-select enable_category">
                                            <option></option>
                                            <option value="1">Enable
                                            </option>
                                            <option value="0">Disable
                                            </option>
                                        </select>

                                    </div>

                                    <div class="col-md-4">
                                        <label for="">Enable Sub Category</label>
                                        <select name="enable_sub_category" id="enable_sub_category"
                                            class="form-select enable_sub_category">
                                            <option></option>
                                            <option value="1">
                                                Enable
                                            </option>
                                            <option value="0">
                                                Disable
                                            </option>
                                        </select>

                                    </div>

                                    <div class="col-md-4">
                                        <label for="">Enable Brand</label>
                                        <select name="enable_brand" id="enable_brand" class="form-select enable_brand">
                                            <option></option>
                                            <option value="1">Enable
                                            </option>
                                            <option value="0">Disable
                                            </option>
                                        </select>

                                    </div>


                                    <div class="col-md-4">
                                        <label for="">Time Format</label>
                                        <select name="time_format" id="time_format" class="form-select time_format">

                                            <option></option>
                                            <option value="12">12</option>
                                            <option value="24">24</option>
                                        </select>

                                    </div>


                                    <div class="col-md-4">
                                        <label for="">Default Barcode Type </label>
                                        <select name="default_barcode_type" id="default_barcode_type"
                                            class="form-select default_barcode_type">
                                            <option></option>
                                            <option value="C128">
                                                C128
                                            </option>
                                            <option value="C39">
                                                C39
                                            </option>
                                            <option value="EAN13">
                                                EAN13
                                            </option>
                                            <option value="EAN8">
                                                EAN8
                                            </option>
                                            <option value="UPCA">
                                                UPCA
                                            </option>
                                            <option value="UPCE">UPCE
                                            </option>
                                        </select>

                                    </div>

                                    <div class="col-md-4">
                                        <label for="">Country Name</label>
                                        <select name="country_id" id="country_id" class="form-select country_id">
                                            <option></option>
                                            @foreach ($countries as $country)
                                                <option value="{{$country->country_id}}">{{$country->country}}</option>
                                            @endforeach
                                        </select>


                                    </div>

                                    <div class="col-md-4">
                                        <label for="">Default Sales Discount Percent</label>
                                        <input type="text" class="form-control"
                                            placeholder="Default Sales Discount Percent"
                                            aria-label="Default Sales Discount Percent"
                                            name="default_sales_discount_percent" id="default_sales_discount_percent">

                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Default Profit Percent</label>
                                        <input type="text" class="form-control" placeholder="Default Profit Percent"
                                            aria-label="Default Profit Percent" name="default_profit_percent"
                                            id="default_profit_percent">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="">Default Sales Tax Percent</label>
                                        <input type="text" class="form-control"
                                            placeholder="Default Sales Discount Percent"
                                            aria-label="Default Sales Tax Percent" name="default_sales_tax_percent"
                                            id="default_sales_tax_percent">
                                    </div>





                                </div>
                            </div>
                        </div>
                        <!-- Product information end  -->



                        <!--  More inoformation start  -->
                        <div class="col-md-12">
                            <div class="parent">
                                <h5 class="">More Inoformation</h5>
                                <div class="row gy-3">







                                    <div class="col-md-4">
                                        <label for="">Tax 1 Name</label>
                                        <input type="text" class="form-control" placeholder="Tax1 Name"
                                            aria-label="Tax1 Name" name="tax1_name" id="tax1_name">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="">Text2 Name</label>
                                        <input type="text" class="form-control" placeholder="Tax2 Name"
                                            aria-label="Tax2 Name" name="tax2_name" id="tax2_name">
                                    </div>





                                    <div class="col-md-4">
                                        <label for="">Text1 Number</label>
                                        <input type="text" class="form-control" placeholder="Tax1 Number"
                                            aria-label="Tax1 Number" name="tax1_number" id="tax1_number">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="">Text2 Number</label>
                                        <input type="text" class="form-control" placeholder="Tax2 Number"
                                            aria-label="Tax2 Number" name="tax2_number" id="tax2_number">


                                    </div>

                                    <div class="col-md-4">
                                        <label for="">Sku Prefix</label>
                                        <input type="text" class="form-control" placeholder="Sku Prefix"
                                            aria-label="Sku Prefix" name="sku_prefix" id="sku_prefix">

                                    </div>

                                    <div class="col-md-4">
                                        <label for="">Time Zone</label>
                                        <input type="text" class="form-control" placeholder="time_zone"
                                            aria-label="time_zone" name="time_zone" id="time_zone">
                                    </div>


                                    <div class="col-md-4">
                                        <label for="">Date Format</label>
                                        <input type="text" class="form-control" placeholder="Date format"
                                            aria-label="date_format" name="date_format" id="date_format">

                                    </div>

                                    <div class="col-md-4">
                                        <label for="">Fy Start Month</label>
                                        <input type="text" class="form-control" placeholder="fy Start Month"
                                            aria-label="fy Start Month" name="fy_start_month" id="fy_start_month">

                                    </div>



                                    <div class="col-md-4">

                                    </div>








                                </div>
                            </div>
                        </div>
                        <!-- More inoformation end  -->






                        <!-- button start  -->
                        <div class="col-md-12">
                            <div class="parent">
                                <div class="row justify-content-end">
                                    <div class="col-md-2">

                                        <button type="submit" class="btn btn-primary  w-100"
                                            id="update_companies_btn">Add
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- button end  -->
                    </div>
                </div>
            </form>

        </div>
    </div>
@endSection
@section('page_script_links')
    <script>
        "use strict";
        $(document).ready(function() {
            @php
                $baseUrl = config('app.url');
                echo "var base_url = '" . $baseUrl . "';";
            @endphp

          



            // country id  status
            $("#country_id").select2({
                placeholder: "Select Country",
                allowClear: true,
                width: "100%",
            });
            // country id  status
            $("#time_format").select2({
                placeholder: "Select time format",
                allowClear: true,
                width: "100%",
            });
            // currency_symbol_placement
            $("#currency_symbol_placement").select2({
                placeholder: "currency Symbol Placement",
                allowClear: true,
                width: "100%",
            });
            // enable_purchase
            $("#enable_purchase").select2({
                placeholder: "Enable Purchase",
                allowClear: true,
                width: "100%",
            });
            // enable_product_expiry
            $("#enable_product_expiry").select2({
                placeholder: "Enable Product expiry",
                allowClear: true,
                width: "100%",
            });
            // enable_price_tax
            $("#enable_price_tax").select2({
                placeholder: "Enable Price Tax",
                allowClear: true,
                width: "100%",
            });
            // enable_category
            $("#enable_category").select2({
                placeholder: "Enable Category",
                allowClear: true,
                width: "100%",
            });
            // enable_sub_category
            $("#enable_sub_category").select2({
                placeholder: "Enable Sub Category",
                allowClear: true,
                width: "100%",
            });
            // enable_brand
            $("#enable_brand").select2({
                placeholder: "Enable Brand",
                allowClear: true,
                width: "100%",
            });
            // stock_accounting_method
            $("#stock_accounting_method").select2({
                placeholder: "currency Symbol Placement",
                allowClear: true,
                width: "100%",
            });
            // default_barcode_type
            $("#default_barcode_type").select2({
                placeholder: "Barcode type",
                allowClear: true,
                width: "100%",
            });


            // hide select error on fill up start
            $('#country_id').on('change', function(param) {
                let countryIdValue = $(this).val();
                if (countryIdValue == "") {

                    $('#country_id-error').removeClass('d-none') // label
                } else {
                    $('#country_id-error').addClass('d-none') // label

                }
            })


            $('#time_format').on('change', function(param) {
                let timeFormatValue = $(this).val();
                if (timeFormatValue == "") {

                    $('#time_format-error').removeClass('d-none') // label
                } else {
                    $('#time_format-error').addClass('d-none') // label

                }
            })

            $('#currency_symbol_placement').on('change', function(param) {
                let currency_symbol_placementValue = $(this).val();
                if (currency_symbol_placementValue == "") {

                    $('#currency_symbol_placement-error').removeClass('d-none') // label
                } else {
                    $('#currency_symbol_placement-error').addClass('d-none') // label

                }
            })





            $('#enable_purchase').on('change', function(param) {
                let enable_purchaseValue = $(this).val();
                if (enable_purchaseValue == "") {

                    $('#enable_purchase-error').removeClass('d-none') // label
                } else {
                    $('#enable_purchase-error').addClass('d-none') // label

                }
            })

            $('#enable_product_expiry').on('change', function(param) {
                let enable_product_expiryValue = $(this).val();
                if (enable_product_expiryValue == "") {

                    $('#enable_product_expiry-error').removeClass('d-none') // label
                } else {
                    $('#enable_product_expiry-error').addClass('d-none') // label

                }
            })

            $('#enable_price_tax').on('change', function(param) {
                let enable_price_taxValue = $(this).val();
                if (enable_price_taxValue == "") {

                    $('#enable_price_tax-error').removeClass('d-none') // label
                } else {
                    $('#enable_price_tax-error').addClass('d-none') // label

                }
            })








            $('#enable_category').on('change', function(param) {
                let enable_categoryValue = $(this).val();
                if (enable_categoryValue == "") {

                    $('#enable_category-error').removeClass('d-none') // label
                } else {
                    $('#enable_category-error').addClass('d-none') // label

                }
            })

            $('#enable_sub_category').on('change', function(param) {
                let enable_sub_categoryValue = $(this).val();
                if (enable_sub_categoryValue == "") {

                    $('#enable_sub_category-error').removeClass('d-none') // label
                } else {
                    $('#enable_sub_category-error').addClass('d-none') // label

                }
            })

            $('#enable_brand').on('change', function(param) {
                let enable_brandValue = $(this).val();
                if (enable_brandValue == "") {

                    $('#enable_brand-error').removeClass('d-none') // label
                } else {
                    $('#enable_brand-error').addClass('d-none') // label

                }
            })

            $('#stock_accounting_method').on('change', function(param) {
                let stock_accounting_methodValue = $(this).val();
                if (stock_accounting_methodValue == "") {

                    $('#stock_accounting_method-error').removeClass('d-none') // label
                } else {
                    $('#stock_accounting_method-error').addClass('d-none') // label

                }
            })

            $('#default_barcode_type').on('change', function(param) {
                let default_barcode_typeValue = $(this).val();
                if (default_barcode_typeValue == "") {

                    $('#default_barcode_type-error').removeClass('d-none') // label
                } else {
                    $('#default_barcode_type-error').addClass('d-none') // label

                }
            })



            // hide select error on fill up  end
            // add companies start
            $("#companies_form").validate({
                rules: {
                    company_name: {
                        required: true,
                    },
                    time_zone: {
                        required: true,
                    },
                    date_format: {
                        required: true,
                    },
                    time_format: {
                        required: true,
                    },
                    country_id:{
                      required:true

                    },

                    fy_start_month: {
                        required: true,
                        number:true
                    },
                    default_profit_percent: {
                        required: true,
                        number:true
                    },
                    webfront_theme: {
                        required: true,
                    },
                    currency_symbol_placement: {
                        required: true,
                    },
                    stock_accounting_method: {
                        required: true,
                    },
                    enable_purchase: {
                        required: true,
                    },
                    enable_product_expiry: {
                        required: true,
                    },
                    enable_price_tax: {
                        required: true,
                    },
                    enable_category: {
                        required: true,
                    },
                    enable_sub_category: {
                        required: true,
                    },
                    enable_brand: {
                        required: true,
                    },
                    default_barcode_type: {
                        required: true,
                    },

                },
                messages: {
                    company_name: {
                        required: "Company Required",
                    },
                    time_zone: {
                        required: "Time zone Required",
                    },

                    date_format: {
                        required: "Date format required",
                    },
                    time_format: {
                        required: "time format required",
                    },
                    fy_start_month: {
                        required: "fy start month required",
                        number:'only Numbers are allowed'
                    },
                    default_profit_percent: {
                        required: "Default profit percent  required",
                        number:'Only numbers are allowed'
                    },

                    webfront_theme: {
                        required: "Web front theme required",
                    },
                    currency_symbol_placement: {
                        required: "currency symbol placement required",
                    },
                    stock_accounting_method: {
                        required: "stock accounting method required",
                    },
                    enable_purchase: {
                        required: "This field is required",
                    },
                    enable_product_expiry: {
                        required: "This field is required",
                    },
                    enable_price_tax: {
                        required: "This field is required",
                    },
                    enable_category: {
                        required: "This field is required",
                    },
                    enable_sub_category: {
                        required: "This field is required",
                    },
                    enable_brand: {
                        required: "This field is required",
                    },
                    default_barcode_type: {
                        required: "This field is required",
                    },
                    country_id:{
                      required:"country Required"
                    },

                },
                submitHandler: function(form) {
                    $.ajax({
                        type: "post",
                        url: base_url + "companies",
                        data: new FormData(form),
                        processData:false,
                        contentType:false,
                        success: function(response) {
                            if (response) {
                                $('#companies_form').trigger('reset');
                                $(".user_updated_msg").removeClass("d-none");
                                window.scrollTo(0, 0)
                            }
                        },
                    });
                },
            });

            // add department end
            // dattables
            $(function() {
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });

                $("#view_companies").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: base_url + "get_data_companies",
                    columns: [{
                            data: "DT_RowIndex",
                            name: "DT_RowIndex"
                        },
                        {
                            data: "company_name",
                            name: "company_name"
                        },
                        {
                            data: "registration_number",
                            name: "registration_number"
                        },
                        {
                            data: "address",
                            name: "address"
                        },
                        {
                            data: "contact_number",
                            name: "contact_number"
                        },
                        {
                            data: "email",
                            name: "email"
                        },
                        {
                            data: "action",
                            name: "action"
                        },
                    ],
                });
            });
            // dattables end

            // delete user start
            $(document).on("click", ".companies_delete_btn", function(param) {
                let delete_companies_id = $(this).data("delete_companies_id");
                $(".confirm_delete_companies").on("click", function() {
                    $.ajax({
                        type: "post",
                        url: base_url + "delete_companies",
                        data: {
                            delete_companies_id: delete_companies_id
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response) {
                                $("#view_companies")
                                    .DataTable()
                                    .ajax.reload();
                            }
                        },
                    });
                });
            });
            // delete user end
            // update start
            $(document).on("click", ".companies_edit_btn", function(param) {
                let update_companies_id = $(this).data("update_companies_id");
                location.replace(base_url + "updateCompanies/" + update_companies_id);
            });

            // update end
            setTimeout(() => {
                $(document).find('#view_companies_filter').append('<span class="add_user_div" ">\
                    <a href="' + base_url + "companies/create" + '"> <button type="button" class="btn bg-primary btn-sm mb-0" style="height:32px"> <span class="material-symbols-outlined text-white" style="line-height:17px !important">\
                          add_business\
                        </span></button>\
                    </a>\
                  </span>\
               ')
            }, 1);

            setTimeout(() => {
                let companies_delete_btn = $(".companies_delete_btn");
                // console.log(delete_btn_main);
                $(companies_delete_btn).each(function(key, value) {
                    // delete_user_id
                    if ($(value).data("delete_companies_id") == 1) {
                        $(value).prop("disabled", true);
                        $(value).css({
                            display: "none"
                        });
                        $(value).removeAttr("data-bs-target", null);
                    } else {
                        $(value).prop("disabled", false);
                    }
                });

            }, 1000);
        });
    </script>
@endSection

@extends('dashboard/nav_footer')
@section('page_header_links')
    <link rel="stylesheet" href="{{ asset('dashboard_assets/subscription_packages/css/subscription_packages.css') }}">
@endSection
@section('body_content')
    




    <div class="row">
        <div class="col-md-12">

            <form action="" id="subscription_packages_form">
                @csrf


                <div class="container-fluid profile">
                    <div class="row gy-4 profile_row">
                        <!--  lable div end  -->
                        <div class="col-md-12">
                            <div class="parent">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h5 class="">Add Subscription Package</h5>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="alert alert-success  d-none text-white crmLeadAddedMessage user_updated_msg"
                                            role="alert" id="crmLeadaddedMessage">
                                            Subscription Package added successfully
                                            <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- lable div end  -->




                        <!-- user information start  -->
                        <div class="col-md-12">
                            <div class="parent">
                                <h5 class="">Package Information</h5>
                                <div class="row gy-3">

                                    <div class="col-md-6">
                                        <label for="">Package Name</label>
                                        <input type="text" class="form-control" placeholder="Package Name"
                                            aria-label="Package Name" name="package_name" id="package_name">
                                    </div>


                                    <div class="col-md-6">
                                        <label for="">Package Description</label>

                                        <input type="text" class="form-control" placeholder="Package Description"
                                            aria-label="Package Description" name="package_description"
                                            id="package_description">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="">Price</label>

                                        <input type="text" class="form-control" placeholder="Price" aria-label="Price"
                                            name="price" id="price">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="">Duration</label>
                                        <input type="number" class="form-control" placeholder="duration"
                                            aria-label="duration" name="duration" id="duration">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="">Trail period in days</label>
                                        <input type="number" class="form-control" placeholder="Trail period in days"
                                            aria-label="Trail period in days" name="trail_period_in_days"
                                            id="trail_period_in_days">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="">Sort Order</label>
                                        <input type="text" class="form-control" placeholder="Sort Order"
                                            aria-label="Sort Order" name="sort_order" id="sort_order">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="">Allowed Users </label>

                                        <input type="text" class="form-control"
                                            placeholder="Allowed Users ,  -1=unlimited" aria-label="Allowed Users"
                                            name="allowed_users" id="allowed_users">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="">Allowed Products </label>

                                        <input type="text" class="form-control"
                                            placeholder="Allowed Products -1=unlimited" aria-label="Allowed Products"
                                            name="allowed_products" id="allowed_products">
                                    </div>


                                    <div class="col-md-6">
                                        <label for="">Allowed Customers </label>
                                        <input type="text" class="form-control"
                                            placeholder="Allowed Customers -1=unlimited" aria-label="Allowed Customers"
                                            name="allowed_customers" id="allowed_customers">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="">Allowed Suppliers </label>

                                        <input type="text" class="form-control"
                                            placeholder="Allowed Suppliers, -1=unlimited" aria-label="Allowed Suppliers"
                                            name="allowed_suppliers" id="allowed_suppliers">

                                    </div>

                                    <div class="col-md-6">
                                        <label for="">Allowed Purchaseorders </label>
                                        <input type="text" class="form-control"
                                            placeholder="Allowed Purchaseorders, -1=unlimited"
                                            aria-label="Allowed Purchaseorders" name="allowed_purchaseorders"
                                            id="allowed_purchaseorders">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="">Allowed Salesinvoices </label>

                                        <input type="text" class="form-control"
                                            placeholder="Allowed Salesinvoices , -1=unlimited"
                                            aria-label="Allowed Salesinvoices" name="allowed_salesinvoices"
                                            id="allowed_salesinvoices">
                                    </div>


                                    <div class="col-md-6">
                                        <label for="">Allowed accounts </label>
                                        <input type="text" class="form-control"
                                            placeholder="allowed_accounts,-1=unlimited " aria-label="Allowed Accounts"
                                            name="allowed_accounts" id="allowed_accounts">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="">Duration Type</label>
                                        <select name="duration_type" id="duration_type"
                                            class="form-select duration_type">
                                            <option></option>
                                            <option value="Days">Days</option>
                                            <option value="Months">Months</option>
                                            <option value="Years">Years</option>
                                        </select>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <!-- user information end  -->




                        <!--  modules permissions  start  -->
                        <div class="col-md-12">
                            <div class="parent">
                                <h5 class="">Module Permissions </h5>
                                <div class="row gy-3">

                                    <div class="col-md-3 form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="module_hrm"
                                            name="module_hrm">
                                        <label class="form-check-label" for="module_hrm">Module hrm</label>

                                    </div>

                                    <div class="col-md-3 form-check form-switch">
                                        <input class="form-check-input " type="checkbox" id="module_crm"
                                            name="module_crm">
                                        <label class="form-check-label" for="">Module crm</label>
                                    </div>



                                    <div class="col-md-3 form-check form-switch">
                                        <input class="form-check-input " type="checkbox" id="module_products"
                                            name="module_products">
                                        <label class="form-check-label" for="">Module Products</label>
                                    </div>

                                    <div class="col-md-3 form-check form-switch">
                                        <input class="form-check-input " type="checkbox" id="module_purchase"
                                            name="module_purchase">
                                        <label class="form-check-label" for="">Module Purchase</label>
                                    </div>

                                    <div class="col-md-3 form-check form-switch">
                                        <input class="form-check-input " type="checkbox" id="module_inventroy"
                                            name="module_inventroy">
                                        <label class="form-check-label" for="">Module Inventroy</label>
                                    </div>

                                    <div class="col-md-3 form-check form-switch">
                                        <input class="form-check-input " type="checkbox" id="module_sales"
                                            name="module_sales">
                                        <label class="form-check-label" for="">Module Sales</label>
                                    </div>
                                    <div class="col-md-3 form-check form-switch">
                                        
                                            <input class="form-check-input " type="checkbox" id="module_accounts"
                                                name="module_accounts">
                                            <label class="form-check-label" for="">module_accounts</label>
                                        </div>






                                    </div>
                                    <div class="col-md-3"> `</div>
                                    <div class="col-md-12 form-check ">
                                      <input class="form-check-input " type="checkbox" id="is_active"
                                      name="is_active">
                                  <label class="form-check-label" for="">Is Active</label>

                                    </div>
                                </div>
                            </div>

                            <!-- modules permissions  start end  -->






                            <!-- button start  -->
                            <div class="col-md-12">
                                <div class="parent">
                                    <div class="row justify-content-end">
                                        <div class="col-md-2">

                                            <button type="submit" class="btn btn-primary  w-100" id="added_subscription_package_btn">Add
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
            // martial status
            $("#duration_type").select2({
                placeholder: "Select Duration type",
                allowClear: true,
                width: "100%",
            });
            $('#duration_type').on('change', function(param) {
                let duration_typeValue = $(this).val();
                if (duration_typeValue == "") {
                    $('#duration_type-error').removeClass('d-none') // label
                } else {
                    $('#duration_type-error').addClass('d-none') // label
                }
            })

            // add department start
            $("#subscription_packages_form").validate({
                rules: {
                    package_name: {
                        required: true,
                    },
                    package_description: {
                        required: true,
                    },
                    price: {
                        required: true,
                        number: true
                    },
                    duration: {
                        required: true,
                    },
                    duration_type: {
                        required: true,
                    },
                    trail_period_in_days: {
                        required: true,
                    },
                    sort_order: {
                        required: true,
                        number: true,
                    },
                    allowed_users: {
                        required: true,
                        number: true,
                    },
                    allowed_products: {
                        required: true,
                        number: true,
                    },
                    allowed_customers: {
                        required: true,
                        number: true,
                    },
                    allowed_suppliers: {
                        required: true,
                        number: true,
                    },
                    allowed_purchaseorders: {
                        required: true,
                        number: true,
                    },
                    allowed_salesinvoices: {
                        required: true,
                        number: true,
                    },
                    allowed_accounts: {
                        required: true,
                        number: true,
                    },
                },
                messages: {
                    package_name: {
                        required: "Package name Required",
                    },
                    package_description: {
                        required: "Description required",
                    },
                    price: {
                        required: "price required",
                        number: 'numbers are allowed'
                    },
                    duration: {
                        required: "Duration required",
                    },
                    duration_type: {
                        required: "Select the duration type",
                    },
                    trail_period_in_days: {
                        required: "Enter the period for trail days",
                    },
                    sort_order: {
                        required: "Enter sort order",
                        number: "only integers are allowed",
                    },
                    allowed_users: {
                        required: "Enter the allowed users",
                        number: "only integers are allowed",
                    },
                    allowed_products: {
                        required: "Enter the amount of products  to allow",
                        number: "only integers are allowed",
                    },
                    allowed_customers: {
                        required: "Enter the amount of customers  to allow",
                        number: "only integers are allowed",
                    },
                    allowed_suppliers: {
                        required: "Enter the amount of suppliers  to allow",
                        number: "only integers are allowed",
                    },
                    allowed_purchaseorders: {
                        required: "Enter the amount of purchase orders",
                        number: "only integers are allowed",
                    },
                    allowed_salesinvoices: {
                        required: 'Enter Number of invoices',
                        number: "only integers are allowed",
                    },
                    allowed_accounts: {
                        required: 'Enter Number of allowed accounts',
                        number: "only integers are allowed",
                    },
                },
                submitHandler: function(form) {
                    $.ajax({
                        type: "post",
                        url: base_url + "subscription_packages",
                        data: $(form).serialize(),
                        dataType: "json",
                        success: function(response) {
                            if (response) {
                                $('#subscription_packages_form').trigger('reset');
                                $(".user_updated_msg").removeClass("d-none");
                                window.scrollTo(0,0)
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

                $("#view_subscription_packages").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: base_url + "get_data_subscription_packages",
                    columns: [{
                            data: "DT_RowIndex",
                            name: "DT_RowIndex"
                        },
                        {
                            data: "package_name",
                            name: "package_name"
                        },
                        {
                            data: "package_description",
                            name: "package_description"
                        },
                        {
                            data: "price",
                            name: "price"
                        },
                        {
                            data: "duration",
                            name: "duration"
                        },
                        {
                            data: "duration_type",
                            name: "duration_type"
                        },
                        {
                            data: "trail_period_in_days",
                            name: "trail_period_in_days"
                        },
                        {
                            data: "sort_order",
                            name: "sort_order"
                        },
                        {
                            data: "allowed_users",
                            name: "allowed_users"
                        },
                        {
                            data: "is_active",
                            name: "is_active"
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
            $(document).on("click", ".subscription_packages_delete_btn", function(param) {
                let delete_subscription_packages_id = $(this).data("delete_subscription_packages_id");
                $(".confirm_delete_subscription_packages").on("click", function() {
                    $.ajax({
                        type: "post",
                        url: base_url + "delete_subscription_packages",
                        data: {
                            delete_subscription_packages_id: delete_subscription_packages_id
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response) {
                                $("#view_subscription_packages")
                                    .DataTable()
                                    .ajax.reload();
                            }
                        },
                    });
                });
            });
            // delete user end
            // update start
            $(document).on("click", ".subscription_packages_edit_btn", function(param) {
                let update_subscription_packages_id = $(this).data("update_subscription_packages_id");
                location.replace(base_url + "updateSubscriptionPackages/" +
                    update_subscription_packages_id);
            });
            $("#subscription_packages_updated_form").validate({
                rules: {
                    package_name: {
                        required: true,
                    },
                    package_description: {
                        required: true,
                    },
                    price: {
                        required: true,
                        number: true
                    },
                    duration: {
                        required: true,
                    },
                    duration_type: {
                        required: true,
                    },
                    trail_period_in_days: {
                        required: true,
                    },
                    sort_order: {
                        required: true,
                        number: true,
                    },
                    allowed_users: {
                        required: true,
                        number: true,
                    },
                    allowed_products: {
                        required: true,
                        number: true,
                    },
                    allowed_customers: {
                        required: true,
                        number: true,
                    },
                    allowed_suppliers: {
                        required: true,
                        number: true,
                    },
                    allowed_purchaseorders: {
                        required: true,
                        number: true,
                    },
                    allowed_salesinvoices: {
                        required: true,
                        number: true,
                    },
                    allowed_accounts: {
                        required: true,
                        number: true,
                    },
                },
                messages: {
                    package_name: {
                        required: "Package name Required",
                    },
                    package_description: {
                        required: "Description required",
                    },
                    price: {
                        required: "price required",
                        number: 'numbers are allowed'
                    },
                    duration: {
                        required: "Duration required",
                    },
                    duration_type: {
                        required: "Select the duration type",
                    },
                    trail_period_in_days: {
                        required: "Enter the period for trail days",
                    },
                    sort_order: {
                        required: "Enter sort order",
                        number: "only integers are allowed",
                    },
                    allowed_users: {
                        required: "Enter the allowed users",
                        number: "only integers are allowed",
                    },
                    allowed_products: {
                        required: "Enter the amount of products  to allow",
                        number: "only integers are allowed",
                    },
                    allowed_customers: {
                        required: "Enter the amount of customers  to allow",
                        number: "only integers are allowed",
                    },
                    allowed_suppliers: {
                        required: "Enter the amount of suppliers  to allow",
                        number: "only integers are allowed",
                    },
                    allowed_purchaseorders: {
                        required: "Enter the amount of purchase orders",
                        number: "only integers are allowed",
                    },
                    allowed_salesinvoices: {
                        required: 'Enter Number of invoices',
                        number: "only integers are allowed",
                    },
                    allowed_accounts: {
                        required: 'Enter Number of allowed accounts',
                        number: "only integers are allowed",
                    },
                },
                submitHandler: function(form) {
                    $.ajax({
                        type: "post",
                        url: base_url + "update_subscription_packages",
                        data: $(form).serialize(),
                        dataType: "json",
                        success: function(response) {
                            if (response) {
                                $(".user_updated_msg").removeClass("d-none");
                            }
                        },
                    });
                },
            });
            // update end
            setTimeout(() => {
                $(document).find('#view_subscription_packages_filter').append('<span class="add_user_div" ">\
                                        <a href="' + base_url + "subscription_packages/create" + '"> <button type="button" class="btn bg-primary btn-sm mb-0" style="height:32px"> <span class="material-symbols-outlined text-white" style="line-height:17px !important">\
                                              subscriptions\
                                            </span></button>\
                                        </a>\
                                      </span>\
                                   ')
            }, 1);
        });
    </script>
@endSection

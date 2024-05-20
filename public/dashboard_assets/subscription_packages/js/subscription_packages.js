"use strict";
$(document).ready(function () {
    const base_url = "http://127.0.0.1:8000/";
        // martial status
        $("#duration_type").select2({
            placeholder: "Select Duration type",
            allowClear: true,
            width: "100%",
        }); 
    
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
                number:true
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
                number:true,
            },
            allowed_users: {
                required: true,
                number:true,
            },
            allowed_products: {
                required: true,
                number:true,
            },
            allowed_customers: {
                required: true,
                number:true,
            },
            allowed_suppliers: {
                required: true,
                number:true,
            },
            allowed_purchaseorders: {
                required: true,
                number:true,
            },
            allowed_salesinvoices: {
                required: true,
                number:true,
            },
            allowed_accounts: {
                required: true,
                number:true,
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
                number:'numbers are allowed'
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
                number:"only integers are allowed",
            },
            allowed_users: {
                required: "Enter the allowed users",
                number:"only integers are allowed",
            },
            allowed_products: {
                required: "Enter the amount of products  to allow",
                number:"only integers are allowed",
            },
            allowed_customers: {
                required: "Enter the amount of customers  to allow",
                number:"only integers are allowed",
            },
            allowed_suppliers: {
                required: "Enter the amount of suppliers  to allow",
                number:"only integers are allowed",
            },
            allowed_purchaseorders: {
                required: "Enter the amount of purchase orders",
                number:"only integers are allowed",
            },
            allowed_salesinvoices: {
                required: 'Enter Number of invoices',
                number:"only integers are allowed",
            },
            allowed_accounts: {
                required: 'Enter Number of allowed accounts',
                number:"only integers are allowed",
            },
        },
        submitHandler: function (form) {
            $.ajax({
                type: "post",
                url: base_url + "subscription_packages",
                data: $(form).serialize(),
                dataType: "json",
                success: function (response) {
                    if (response) {
                        $('#subscription_packages_form').trigger('reset');
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

        $("#view_subscription_packages").DataTable({
            processing: true,
            serverSide: true,
            ajax: base_url + "get_data_subscription_packages",
            columns: [
                { data: "DT_RowIndex", name: "DT_RowIndex" },
                { data: "package_name", name: "package_name" },
                { data: "package_description", name: "package_description" },
                { data: "price", name: "price" },
                { data: "duration", name: "duration" },
                { data: "duration_type", name: "duration_type" },
                { data: "trail_period_in_days", name: "trail_period_in_days" },
                { data: "sort_order", name: "sort_order" },
                { data: "allowed_users", name: "allowed_users" },
                { data: "is_active", name: "is_active" },
                { data: "action", name: "action" },
            ],
        });
    });
    // dattables end

    // delete user start
    $(document).on("click", ".subscription_packages_delete_btn", function (param) {
        let delete_subscription_packages_id = $(this).data("delete_subscription_packages_id");
        $(".confirm_delete_subscription_packages").on("click", function () {
            $.ajax({
                type: "post",
                url: base_url + "delete_subscription_packages",
                data: { delete_subscription_packages_id: delete_subscription_packages_id },
                dataType: "json",
                success: function (response) {
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
    $(document).on("click", ".subscription_packages_edit_btn", function (param) {
        let update_subscription_packages_id = $(this).data("update_subscription_packages_id");
        location.replace(base_url + "updateSubscriptionPackages/" + update_subscription_packages_id);
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
                number:true
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
                number:true,
            },
            allowed_users: {
                required: true,
                number:true,
            },
            allowed_products: {
                required: true,
                number:true,
            },
            allowed_customers: {
                required: true,
                number:true,
            },
            allowed_suppliers: {
                required: true,
                number:true,
            },
            allowed_purchaseorders: {
                required: true,
                number:true,
            },
            allowed_salesinvoices: {
                required: true,
                number:true,
            },
            allowed_accounts: {
                required: true,
                number:true,
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
                number:'numbers are allowed'
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
                number:"only integers are allowed",
            },
            allowed_users: {
                required: "Enter the allowed users",
                number:"only integers are allowed",
            },
            allowed_products: {
                required: "Enter the amount of products  to allow",
                number:"only integers are allowed",
            },
            allowed_customers: {
                required: "Enter the amount of customers  to allow",
                number:"only integers are allowed",
            },
            allowed_suppliers: {
                required: "Enter the amount of suppliers  to allow",
                number:"only integers are allowed",
            },
            allowed_purchaseorders: {
                required: "Enter the amount of purchase orders",
                number:"only integers are allowed",
            },
            allowed_salesinvoices: {
                required: 'Enter Number of invoices',
                number:"only integers are allowed",
            },
            allowed_accounts: {
                required: 'Enter Number of allowed accounts',
                number:"only integers are allowed",
            },
        },
        submitHandler: function (form) {
            $.ajax({
                type: "post",
                url: base_url + "update_subscription_packages",
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
    setTimeout(() => {
        $(document).find('#view_subscription_packages_filter').append('<span class="add_user_div" ">\
        <a href="'+base_url+"subscription_packages/create"+'"> <button type="button" class="btn bg-primary btn-sm mb-0" style="height:32px"> <span class="material-symbols-outlined text-white" style="line-height:17px !important">\
              subscriptions\
            </span></button>\
        </a>\
      </span>\
   ')
       }, 1);
});

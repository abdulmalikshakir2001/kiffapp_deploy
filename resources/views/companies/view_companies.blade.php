@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/companies/css/companies.css')}}">
@endSection
@section('body_content')
<div class="row">
  <div class="col-md-12 ">
    <!-- Button trigger modal -->
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="delete_confirm_companies" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <!-- <div class="modal-header border-0">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div> -->
          <div class="modal-body">
            Are You sure to delete this company ?

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            <button type="button" class="btn btn-primary confirm_delete_companies" data-bs-dismiss="modal">Confirm</button>
          </div>
        </div>
      </div>
    </div>
    <!-- content start  -->
    <div class="card mb-4 view_user_card">
      <!-- <div class="card-header pb-0">
              <h6>Authors table</h6>
            </div> -->

      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0  hover" id="view_companies" style="width: 100%;">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">S no</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Company Name</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Registration Number</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Address</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Contact Number</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Email</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">Actions</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
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
  $(document).ready(function() {
    @php
    $baseUrl = config('app.url');
    echo "var base_url = '".$baseUrl.
    "';";
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
    // add department start
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
        country_id: {
          required: true,
          number: true,
        },
        fy_start_month: {
          required: true,
        },
        default_profit_percent: {
          required: true,
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
        },
        default_profit_percent: {
          required: "Default profit percent  required",
        },
        country_id: {
          required: "Country Required",
          number: "only numbers are allowed",
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

      },
      submitHandler: function(form) {
        alert('ok')
        $.ajax({
          type: "post",
          url: base_url + "companies",
          data: $(form).serialize(),
          dataType: "json",
          success: function(response) {
            if (response) {
              $('#companies_form').trigger('reset');
              $(".user_updated_msg").removeClass("d-none");
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
      location.replace(base_url + "updateCompanyByApp/" + update_companies_id);
    });
    $("#companies_updated_form").validate({
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
        country_id: {
          required: true,
          number: true,
        },
        fy_start_month: {
          required: true,
        },
        default_profit_percent: {
          required: true,
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
        },
        default_profit_percent: {
          required: "Default profit percent  required",
        },
        country_id: {
          required: "Country Required",
          number: "only numbers are allowed",
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

      },
      submitHandler: function(form) {
        $.ajax({
          type: "post",
          url: base_url + "update_companies",
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
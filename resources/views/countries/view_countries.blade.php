@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/countries/css/countries.css')}}">
@endSection
@section('body_content')
<div class="row">
  <div class="col-md-12 ">
                      <!-- Button trigger modal -->
<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="delete_confirm_countries" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <!-- <div class="modal-header border-0">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div> -->
      <div class="modal-body">
        Are You sure to delete this  Country ?
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <button type="button" class="btn btn-primary confirm_delete_countries" data-bs-dismiss="modal">Confirm</button>
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
                <table class="table align-items-center mb-0  hover" id="view_countries" style="width: 100%;">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder">S no</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Country Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Currency</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Currency Code</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Currency symbol</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Thousand Separator</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Decimal Separator</th>
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
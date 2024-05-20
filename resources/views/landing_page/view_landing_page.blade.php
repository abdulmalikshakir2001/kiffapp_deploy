@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/landing_page/css/langing_pages.css')}}">
@endSection
@section('body_content')
<div class="row">
  <div class="col-md-12 ">
                      <!-- Button trigger modal -->
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="delete_confirm_landing_page" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <!-- <div class="modal-header border-0">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div> -->
      <div class="modal-body">
        Are You sure to delete this Landing page ?
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <button type="button" class="btn btn-primary confirm_delete_landing_page" data-bs-dismiss="modal">Confirm</button>
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
                <table class="table align-items-center mb-0  hover" id="view_landing_page" style="width: 100%;">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder">S no</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Header</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">Content</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">Footer</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">Url</th>
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
          echo "var base_url = '" . $baseUrl . "';";
      @endphp
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

</script>
@endSection
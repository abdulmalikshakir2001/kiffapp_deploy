@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/companies_departments/css/companies_departments.css')}}">
@endSection
@section('body_content')
<div class="row">
  <div class="col-md-12 ">
                      <!-- Button trigger modal -->
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="delete_confirm_com_dep" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <!-- <div class="modal-header border-0">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div> -->
      <div class="modal-body">
        Are You sure to delete this company department ?
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <button type="button" class="btn btn-primary confirm_delete_com_dep" data-bs-dismiss="modal">Confirm</button>
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
                <table class="table align-items-center mb-0  hover" id="view_companies_departments" style="width: 100%;">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder">S no</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Department Name</th>
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
  
  </script>
@endSection
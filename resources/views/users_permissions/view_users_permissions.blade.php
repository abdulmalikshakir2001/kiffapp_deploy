@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/users_permissions/css/users_permissions.css')}}">
@endSection
@section('body_content')
<div class="row">
  <div class="col-md-12 ">
                      <!-- Button trigger modal -->
<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="delete_confirm_users_permissions" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <!-- <div class="modal-header border-0">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div> -->
      <div class="modal-body">
        Are You sure to delete this Users Permissions ?
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <button type="button" class="btn btn-primary confirm_delete_users_permissions" data-bs-dismiss="modal">Confirm</button>
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
                <table class="table align-items-center mb-0  hover" id="view_users_permissions" style="width: 100%;">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder">S no</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder">App Module  Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Permission  Name</th>
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
  
  // add users permissions start
  $("#users_permissions_form").validate({
      rules: {
          app_module_name: {
              required: true,
          },
          
      },
      messages: {
          app_module_name: {
              required: "This field is required",
          },
          
      },
      submitHandler: function (form) {
          $.ajax({
              type: "post",
              url: base_url + "users_permissions",
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

      $("#view_users_permissions").DataTable({
          processing: true,
          serverSide: true,
          ajax: base_url + "get_data_users_permissions",
          columns: [
              { data: "DT_RowIndex", name: "DT_RowIndex" },
              { data: "app_module_name", name: "app_module_name" },
              { data: "permission_name", name: "permission_name" },
              { data: "action", name: "action" },
          ],
      });
  });
  // dattables end

  // delete user start
  $(document).on("click", ".users_permissions_delete_btn", function (param) {
      let delete_users_permissions_id = $(this).data("delete_users_permissions_id");
      $(".confirm_delete_users_permissions").on("click", function () {
          $.ajax({
              type: "post",
              url: base_url + "delete_users_permissions",
              data: { delete_users_permissions_id: delete_users_permissions_id },
              dataType: "json",
              success: function (response) {
                  if (response) {
                      $("#view_users_permissions")
                          .DataTable()
                          .ajax.reload();
                  }
              },
          });
      });
  });
  // delete user end
  // update start
  $(document).on("click", ".users_permissions_edit_btn", function (param) {
      let update_users_permissions_id = $(this).data("update_users_permissions_id");
      location.replace(base_url + "updateUsersPermissions/" + update_users_permissions_id);
  });
  $("#users_permissions_updated_form").validate({
      rules: {
          app_module_name: {
              required: true,
          },
          
      },
      messages: {
          app_module_name: {
              required: "This field is required Required",
          },
          
      },
      submitHandler: function (form) {
          $.ajax({
              type: "post",
              url: base_url + "update_users_permissions",
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
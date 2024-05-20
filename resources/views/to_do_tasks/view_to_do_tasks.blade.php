@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/to_do_tasks/css/to_do_tasks.css')}}">
@endSection
@section('body_content')
<div class="row">
  <div class="col-md-12 ">
    <!-- Button trigger modal -->
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="delete_confirm_to_do_tasks" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
            <button type="button" class="btn btn-primary confirm_delete_to_do_tasks" data-bs-dismiss="modal">Confirm</button>
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
          <table class="table align-items-center mb-0  hover" id="view_to_do_tasks" style="width: 100%;">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">S no</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Task</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Description</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">status</th>
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
    // martial status


    // add department start
    $("#to_do_tasks_form").validate({
      rules: {
        task_name: {
          required: true,
        },
      },
      messages: {
        task_name: {
          required: "Task name required",
        },
      },
      submitHandler: function(form) {
        $.ajax({
          type: "post",
          url: base_url + "to_do_tasks",
          data: $(form).serialize(),
          dataType: "json",
          success: function(response) {
            if (response) {
              $("#view_to_do_tasks")
                .DataTable()
                .ajax.reload();
              $('#to_do_tasks_form').trigger('reset')
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

      $("#view_to_do_tasks").DataTable({
        processing: true,
        serverSide: true,
        ajax: base_url + "get_data_to_do_tasks",
        columns: [{
            data: "DT_RowIndex",
            name: "DT_RowIndex"
          },
          {
            data: "task_name",
            name: "task_name"
          },
          {
            data: "task_description",
            name: "task_description"
          },
          {
            data: "status",
            name: "statu"
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
    $(document).on("click", ".to_do_tasks_delete_btn", function(param) {
      let delete_to_do_tasks_id = $(this).data("delete_to_do_tasks_id");
      $(".confirm_delete_to_do_tasks").on("click", function() {
        $.ajax({
          type: "post",
          url: base_url + "delete_to_do_tasks",
          data: {
            delete_to_do_tasks_id: delete_to_do_tasks_id
          },
          dataType: "json",
          success: function(response) {
            if (response) {
              $("#view_to_do_tasks")
                .DataTable()
                .ajax.reload();
            }
          },
        });
      });
    });
    // delete user end
    // update start
    $(document).on("click", ".to_do_tasks_edit_btn", function(param) {
      let update_to_do_tasks_id = $(this).data("update_to_do_tasks_id");
      location.replace(base_url + "updateToDoTasks/" + update_to_do_tasks_id);
    });
    $("#update_to_do_tasks_form").validate({
      rules: {
        task_name: {
          required: true,
        },
      },
      messages: {
        task_name: {
          required: "Task name required",
        },
      },
      submitHandler: function(form) {
        $.ajax({
          type: "post",
          url: base_url + "update_to_do_tasks",
          data: $(form).serialize(),
          dataType: "json",
          success: function(response) {
            if (response) {
              $(".user_updated_msg").removeClass("d-none");
              $("#view_to_do_tasks")
                .DataTable()
                .ajax.reload();
            }
          },
        });
      },
    });
    // update end
    setTimeout(() => {
      $(document).find('#view_to_do_tasks_filter').append('<span class="add_user_div" ">\
        <a href="' + base_url + "to_do_tasks/create" + '"> <button type="button" class="btn bg-primary btn-sm mb-0" style="height:32px"> <span class="material-symbols-outlined text-white" style="line-height:17px !important">\
              add_business\
            </span></button>\
        </a>\
      </span>\
   ')
    }, 1);


  });
</script>
@endSection
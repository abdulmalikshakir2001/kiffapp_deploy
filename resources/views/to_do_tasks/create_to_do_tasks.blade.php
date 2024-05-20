@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/to_do_tasks/css/to_do_tasks.css')}}">
@endSection
@section('body_content')
<div class="row">
    <div class="col-md-12">
        <!-- content start  -->
        <div class="container-fluid p-4 create_user_main">
            <div class="row">
                <div class="col-md-12">
                    <form role="form" action="" method="post" id="to_do_tasks_form">
                        @csrf
                        <div class="container-fluid">
                            <div class="row">
                                <!-- show message when companies positions  added  start  -->
                                <div class="mb-3 col-md-12 ">
                  <div class="alert alert-success  d-none text-white user_updated_msg" role="alert">
                    Task added successfully
                    <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                  </div>
                </div>
                                <!-- show message when task added  added  end  -->
                                <!-- task  name  start-->
                                <div class="task_input_main_parent d-flex justify-content-center">
                                <div class="task_inputs_parent">
                                    <!-- heading -->
                                    <div class="mb-3">
                                        <h4>Add New Task</h4>

                                    </div>
                                <div class="mb-3 ">
                                    <input type="text" class="form-control" placeholder="Task Name" aria-label="Task Name" name="task_name" id="task_name">
                                </div>
                                <!-- task description start  -->
                                <div class="mb-3 ">
                                    <textarea name="task_description" id="task_description" cols="" rows="" class="form-control" placeholder="Enter Description for task here ..."></textarea>
                                </div>
                                <!-- task description end  -->
                                <!-- task  name  end -->
                                
                                <div class="text-center">
                                    <button type="submit" id="added_to_do_tasks_btn" class="btn bg-gradient-dark w-100 my-4 mb-2">Add Task</button>
                                </div>

                                </div>
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
              $('#to_do_tasks_form').trigger('reset')
              $('#view_to_do_tasks').DataTable().ajax.reload();

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
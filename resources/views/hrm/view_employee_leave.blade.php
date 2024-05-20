@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/hrm/css/employee_leave.css')}}">
@endSection
@section('body_content')
<div class="row">
  <div class="col-md-12 ">

    <!-- Button trigger modal -->
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="delete_confirm_employee_leave" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <form id="delete_form">
            <input type="hidden" name="delete_employee_leave_id" id="delete_employee_leave_id">
        </form>
          <!-- <div class="modal-header border-0">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div> -->
          <div class="modal-body">
            Are You sure to delete this Employee Leave ?

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            <button type="button" class="btn btn-primary confirm_delete_employee_leave" data-bs-dismiss="modal">Confirm</button>
          </div>
        </div>
      </div>
    </div>

    <!-- add job vacncies start  -->
    <div class="modal fade" id="add_employee_leave" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header vacancy_modal_header">
            <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Add Leave</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-0">
            <!-- content start   -->
            <div class="container-fluid create_user_main p-0">
              <div class="row">
                <div class="col-md-12">
                  <form role="form" action="" method="post" id="employee_leave_form">
                    @csrf
                    <div class="container-fluid">
                      <div class="row">
                        <!-- employee_name -->
                        <div class="mb-3 col-md-6 position-relative">
                          <label for="user_id">Employee Name</label>
                          <select name="user_id" id="user_id" class="form-select user_id">
                                <option></option>
                                @foreach($employees as $employee)
                                <option value="{{$employee->user_id}}">{{$employee->username}}</option>
                                @endforeach
                              </select>
                        </div>
                        <!-- leave type -->
                        <div class="mb-3 col-md-6">
                          <label for="leave_type_id">Leave Type</label>
                          <select name="leave_type_id" id="leave_type_id" class="form-select leave_type_id">
                                <option></option>
                                @foreach($leave_types as $leave_type)
                                <option value="{{$leave_type->leave_type_id}}">{{$leave_type->leave_type}}</option>
                                @endforeach
                              </select>
                        </div>
                        <!-- start date -->
                        <div class="mb-3 col-md-6">
                          <label for="start_date">Start Date</label>
                          <input type="date" class="form-control" placeholder="Start Date " aria-label="Start Date" name="start_date" id="start_date">
                        </div>

                       
                        <!-- end_date -->
                        <div class="mb-3 col-md-6">
                          <label for="end_date">End Date</label>
                          <input type="date" name="end_date" id="end_date" placeholder="End Date" class="form-control">
                        </div>
                        
                        <!-- is paid -->
                        <div class="mb-3 col-md-12">
                          <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_paid" name="is_paid">
                            <label class="form-check-label" for="is_paid">Is paid</label>
                          </div>
                        </div>
                        <div class="text-center col-md-6 m-auto">
                          <button type="submit" id="add_employee_leave_btn" class="btn bg-primary w-100 my-4 mb-2 text-white">Add Leave</button>
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
      </div>
    </div>
    <!-- add job vacncies end  -->
    <!-- update job vacncies start  -->
    <div class="modal fade" id="update_employee_leave" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header vacancy_modal_header">
            <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">update Leave</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-0">
            <!-- content start   -->
            <div class="container-fluid create_user_main p-0">
              <div class="row">
                <div class="col-md-12">
                  <form role="form" action="" method="post" id="employee_leave_update_form">
                    <input type="hidden"  name="employee_leave_id" id="employee_leave_id" value="">
                    @csrf
                    <div class="container-fluid">
                      <div class="row">
                        <!-- employee_name -->
                        <div class="mb-3 col-md-6 position-relative">
                          <label for="user_id">Employee Name</label>
                          <select name="user_id" id="user_id" class="form-select user_id">
                                <option></option>
                                @foreach($employees as $employee)
                                <option value="{{$employee->user_id}}">{{$employee->username}}</option>
                                @endforeach
                              </select>
                        </div>
                        <!-- leave type -->
                        <div class="mb-3 col-md-6">
                          <label for="leave_type_id">Leave Type</label>
                          <select name="leave_type_id" id="leave_type_id" class="form-select leave_type_id">
                                <option></option>
                                @foreach($leave_types as $leave_type)
                                <option value="{{$leave_type->leave_type_id}}">{{$leave_type->leave_type}}</option>
                                @endforeach
                              </select>
                        </div>
                        <!-- start date -->
                        <div class="mb-3 col-md-6">
                          <label for="start_date">Start Date</label>
                          <input type="date" class="form-control" placeholder="Start Date " aria-label="Start Date" name="start_date" id="start_date">
                        </div>

                       
                        <!-- end_date -->
                        <div class="mb-3 col-md-6">
                          <label for="end_date">End Date</label>
                          <input type="date" name="end_date" id="end_date" placeholder="End Date" class="form-control">
                        </div>
                        
                        <!-- is paid -->
                        <div class="mb-3 col-md-12">
                          <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_paid" name="is_paid"
                            
                            >
                            <label class="form-check-label" for="is_paid">Is paid</label>
                          </div>
                        </div>
                        <div class="text-center col-md-6 m-auto">
                          <button type="submit" id="update_employee_leave_btn" class="btn bg-primary w-100 my-4 mb-2 text-white" data-bs-dismiss="modal">Update Leave</button>
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
      </div>
    </div>
    <!-- update job vacncies end  -->



    <!-- content start  -->
    <div class="card mb-4 view_user_card">
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0  hover" id="view_employee_leave" style="width: 100%;">
            
            <!-- show message when job vacancy  added  start  -->
            <div class="mb-3 col-md-12">
              <div class="alert alert-success  d-none text-white leave_added_msg user_updated_msg" role="alert">
                Leave added
                <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
              </div>
            </div>
            <!-- show message when job vacancy  added  start  -->
            <!-- show message when job vacancy   updated  start  -->
            <div class="mb-3 col-md-12">
              <div class="alert alert-success  d-none text-white employee_leave_updated_msg user_updated_msg" role="alert">
                Leave updated
                <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
              </div>
            </div>
            <!-- show message when job vacancy   updated  start  -->
            <!-- show message when job vacancy   deleted start  -->
            <div class="mb-3 col-md-12">
              <div class="alert alert-success  d-none text-white employee_leave_deleted_msg user_updated_msg" role="alert">
                Leave deleted
                <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
              </div>
            </div>
            <!-- show message when job vacancy   deleted  start  -->
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">S no</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Employee Name</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Leave Type</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Start Date</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">End Date</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Status</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Approval Status</th>
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
    // parse html entities start
    function html_decode(input) {
        let parser = new DOMParser().parseFromString(input, "text/html");
        return parser.documentElement.textContent;
    }
    // parse html entities end

    // tiny mce start
    @php
            $baseUrl = config('app.url');
            echo "var base_url = '" . $baseUrl . "';";
        @endphp
    // Leave Type
    $("#leave_type_id").select2({
        placeholder: "Leave Type",
        allowClear: true,
        width: "100%",
    });
    // $("#employee_leave_update_form #leave_type_id").select2({
    //     placeholder: "Leave Type",
    //     allowClear: true,
    //     width: "100%",
    // });
    // Leave Type
    $("#user_id").select2({
        placeholder: "Employee Name",
        allowClear: true,
        width: "100%",
    });
    // $("#employee_leave_update_form #employee_id").select2({
    //     placeholder: "Employee Name",
    //     allowClear: true,
    //     width: "100%",
    // });

    // add job vacancies  start
    $("#employee_leave_form").validate({
        rules: {
            user_id: {
                required: true,
            },
            leave_type_id: {
                required: true,
            },
            start_date: {
                required: true,
            },
            end_date: {
                required: true,
            },
        },
        messages: {
            user_id: {
                required: "Employee name required",
            },
            leave_type_id: {
                required: "Leave Type required",
            },
            start_date: {
                required: "Start Date Required",
            },
            end_date: {
                required: "End Date Required",
            },
        },
        submitHandler: function (form) {
            $.ajax({
                type: "post",
                url: base_url + "employee_leave",
                data: $(form).serialize(),
                dataType: "json",
                success: function (response) {
                    if (response) {
                        $("#employee_leave_form").trigger("reset");
                        $("#view_employee_leave").DataTable().ajax.reload();
                        $("#add_employee_leave").modal("toggle");
                        $(".leave_added_msg").removeClass("d-none");
                    }
                },
            });
        },
    });

    // add job vaccanices end
    // dattables
    $(function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $("#view_employee_leave").DataTable({
            processing: true,
            serverSide: true,
            ajax: base_url + "get_data_employee_leave",
            columns: [
                { data: "DT_RowIndex", name: "DT_RowIndex" },
                { data: "username", name: "username" },
                { data: "leave_type", name: "leave_type" },
                { data: "start_date", name: "start_date" },
                { data: "end_date", name: "end_date" },
                { data: "is_paid", name: "is_paid" },
                { data: "approval_status", name: "approval_status" },
                { data: "action", name: "action" },
            ],
        });
    });
    // dattables end

    // delete user start
    $(document).on("click", ".employee_leave_delete_btn", function (param) {
        $('#delete_employee_leave_id').val($(this).data("delete_employee_leave_id"))   ;
        $(".confirm_delete_employee_leave").on("click", function () {
            $.ajax({
                type: "post",
                url: base_url + "delete_employee_leave",
                data: $('#delete_form').serialize(),
                dataType: "json",
                success: function (response) {
                    if (response) {
                        $("#view_employee_leave").DataTable().ajax.reload();
                        $(".employee_leave_deleted_msg").removeClass("d-none");
                    }
                },
            });
        });
    });
    // delete user end
    // update employee leave  start
    $(document).on("click", ".employee_leave_edit_btn", function (param) {
        let update_employee_leave_id = $(this).data("update_employee_leave_id");
        $.ajax({
            type: "post",
            url: base_url + "fetch_employee_leave",
            data: { update_employee_leave_id: update_employee_leave_id },
            dataType: "json",
            success: function (response) {
                if (response) {
                    $("#employee_leave_update_form")
                        .find("#user_id")
                        .val(response.user_id);
                    $("#employee_leave_update_form")
                        .find(".leave_type_id")
                        .val(response.leave_type_id);
                    $("#employee_leave_update_form")
                        .find("#start_date")
                        .val(response.start_date);
                    $("#employee_leave_update_form")
                        .find("#end_date")
                        .val(response.end_date);
                    $("#employee_leave_update_form")
                        .find("#employee_leave_id")
                        .val(response.employee_leave_id);

                    if (response.is_paid == "paid") {
                        $("#employee_leave_update_form")
                            .find("#is_paid")
                            .prop("checked", true);
                    } else {
                        $("#employee_leave_update_form")
                            .find("#is_paid")
                            .prop("checked", false);
                    }
                }
            },
        });
    });

    $("#employee_leave_update_form").validate({
        rules: {
            user_id: {
                required: true,
            },
            leave_type_id: {
                required: true,
            },
            start_date: {
                required: true,
            },
            end_date: {
                required: true,
            },
        },
        messages: {
            user_id: {
                required: "Employee name required",
            },
            leave_type_id: {
                required: "Leave Type required",
            },
            start_date: {
                required: "Start Date Required",
            },
            end_date: {
                required: "End Date Required",
            },
        },
        submitHandler: function (form) {
            $.ajax({
                type: "post",
                url: base_url + "update_employee_leave",
                data: $(form).serialize(),
                dataType: "json",
                success: function (response) {
                    if (response) {
                        $("#view_employee_leave").DataTable().ajax.reload();
                        $(".employee_leave_updated_msg").removeClass("d-none");
                        $("#employee_leave_update_form").trigger("reset");
                    }
                },
            });
        },
    });
    // update employee leave  end

    // add  button to data table to add job vacancy start
    // adding button to the create user datatable to add user start
    setTimeout(() => {
        $(document).find("#view_employee_leave_filter").append(
            '<span class="add_user_div" ">\
                         <button type="button" class="btn bg-primary sidenav_zero_index add_employee_leave_btn btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#add_employee_leave" style="height:32px"> <i class="fa-solid fa-plus text-white"></i>\
                </button>\
          </span>\
       '
        );
        // check the contstains for company owner to add user start
    }, 1);
    // add  button to data table to add job vacancy end

    // approve leave start
    $(document).on("click", ".approve_leave", function (param) {
        let employee_leave_id = $(this).data("employee_leave_id");
            $.ajax({
                type: "post",
                url: base_url + "approve_employee_leave",
                data: { employee_leave_id: employee_leave_id},
                dataType: "json",
                success: function (response) {
                    if (response) {
                        $("#view_employee_leave").DataTable().ajax.reload();
                    }
                },
        });
    });

    // approve leave end
    // reject leave start
    $(document).on("click", ".reject_leave", function (param) {
        let employee_leave_id = $(this).data("employee_leave_id");
            $.ajax({
                type: "post",
                url: base_url + "reject_employee_leave",
                data: { employee_leave_id: employee_leave_id},
                dataType: "json",
                success: function (response) {
                    if (response=="true") {
                        $("#view_employee_leave").DataTable().ajax.reload();
                    }
                },
        });
    });

    // reject leave end
});

</script>

@endSection
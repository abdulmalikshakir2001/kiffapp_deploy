@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/hrm/css/public_holiday.css')}}">
@endSection
@section('body_content')
<div class="row">
  <div class="col-md-12 ">

    <!-- Button trigger modal -->
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="delete_confirm_public_holiday" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <form id="delete_form">
            <input type="hidden" name="delete_public_holiday_id" id="delete_public_holiday_id">
        </form>
          <!-- <div class="modal-header border-0">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div> -->
          <div class="modal-body">
            Are You sure to delete this Public Holiday ?

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            <button type="button" class="btn btn-primary confirm_delete_public_holiday" data-bs-dismiss="modal">Confirm</button>
          </div>
        </div>
      </div>
    </div>

    <!-- add public_holiday start  -->
    <div class="modal fade" id="add_public_holiday" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header vacancy_modal_header">
            <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Add Public Holiday</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-0">
            <!-- content start   -->
            <div class="container-fluid create_user_main p-0">
              <div class="row">
                <div class="col-md-12">
                  <form role="form" action="" method="post" id="public_holiday_form">
                    @csrf
                    <div class="container-fluid">
                      <div class="row">
                        <!-- holiday name -->
                        <div class="mb-3 col-md-6">
                          <label for="start_date">Holiday Name</label>
                          <input type="text" class="form-control" placeholder="Holiday Name " aria-label="Start Date" name="holiday_name" id="holiday_name">
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
                        
                        
                        <div class="text-center col-md-6 m-auto">
                          <button type="submit" id="add_public_holiday_btn" class="btn bg-primary w-100 my-4 mb-2 text-white">Add Public Holiday</button>
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
    <div class="modal fade" id="update_public_holiday" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header vacancy_modal_header">
            <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Update Public Holiday</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-0">
            <!-- content start   -->
            <div class="container-fluid create_user_main p-0">
              <div class="row">
                <div class="col-md-12">
                    <form role="form" action="" method="post" id="public_holiday_update_form">
                        <input type="hidden"  name="public_holiday_id" id="public_holiday_id" value="">
                    @csrf
                    <div class="container-fluid">
                      <div class="row">
                        <!-- holiday name -->
                        <div class="mb-3 col-md-6">
                          <label for="start_date">Holiday Name</label>
                          <input type="text" class="form-control" placeholder="Holiday Name " aria-label="Start Date" name="holiday_name" id="holiday_name">
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
                        
                        
                        <div class="text-center col-md-6 m-auto">
                          <button type="submit" id="add_public_holiday_btn" class="btn bg-primary w-100 my-4 mb-2 text-white">Update Public Holiday</button>
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
          <table class="table align-items-center mb-0  hover" id="view_public_holiday" style="width: 100%;">
            
            <!-- show message when public_holiday   added  start  -->
            <div class="mb-3 col-md-12">
              <div class="alert alert-success  d-none text-white public_holiday_added_msg user_updated_msg" role="alert">
                Public Holiday added
                <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
              </div>
            </div>
            <!-- show message when public_holiday   added  start  -->
            <!-- show message when public_holiday    updated  start  -->
            <div class="mb-3 col-md-12">
              <div class="alert alert-success  d-none text-white public_holiday_updated_msg user_updated_msg" role="alert">
              Public Holiday updated
                <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
              </div>
            </div>
            <!-- show message when public_holiday    updated  start  -->
            <!-- show message when public_holiday    deleted start  -->
            <div class="mb-3 col-md-12">
              <div class="alert alert-success  d-none text-white public_holiday_deleted_msg user_updated_msg" role="alert">
              Public Holiday deleted
                <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
              </div>
            </div>
            <!-- show message when job vacancy   deleted  start  -->
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">S no</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Holiday Name</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Start Date</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">End Date</th>
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

    // add job vacancies  start
    $("#public_holiday_form").validate({
        rules: {
            holiday_name: {
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
            holiday_name: {
                required: "Holiday Name required",
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
                url: base_url + "public_holiday",
                data: $(form).serialize(),
                dataType: "json",
                success: function (response) {
                    if (response) {
                        $("#public_holiday_form").trigger("reset");
                        $("#view_public_holiday").DataTable().ajax.reload();
                        $("#add_public_holiday").modal("toggle");
                        $(".public_holiday_added_msg").removeClass("d-none");
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

        $("#view_public_holiday").DataTable({
            processing: true,
            serverSide: true,
            ajax: base_url + "get_data_public_holiday",
            columns: [
                { data: "DT_RowIndex", name: "DT_RowIndex" },
                { data: "holiday_name", name: "holiday_name" },
                { data: "start_date", name: "start_date" },
                { data: "end_date", name: "end_date" },
                { data: "action", name: "action" },
            ],
        });
    });
    // dattables end

    // delete user start
    $(document).on("click", ".public_holiday_delete_btn", function (param) {
        $('#delete_public_holiday_id').val($(this).data("delete_public_holiday_id")) ;
        $(".confirm_delete_public_holiday").on("click", function () {
            $.ajax({
                type: "post",
                url: base_url + "delete_public_holiday",
                data: $('#delete_form').serialize(),
                dataType: "json",
                success: function (response) {
                    if (response) {
                        $("#view_public_holiday").DataTable().ajax.reload();
                        $(".public_holiday_deleted_msg").removeClass("d-none");
                    }
                },
            });
        });
    });
    // delete user end
    // update employee leave  start
    $(document).on("click", ".public_holiday_edit_btn", function (param) {
        let update_public_holiday_id = $(this).data("update_public_holiday_id");
        $.ajax({
            type: "post",
            url: base_url + "fetch_public_holiday",
            data: { update_public_holiday_id: update_public_holiday_id },
            dataType: "json",
            success: function (response) {
                if (response) {
                    $("#public_holiday_update_form")
                        .find("#public_holiday_id")
                        .val(response.public_holiday_id);
                    $("#public_holiday_update_form")
                        .find("#holiday_name")
                        .val(response.holiday_name);
                    $("#public_holiday_update_form")
                        .find("#start_date")
                        .val(response.start_date);
                    $("#public_holiday_update_form")
                        .find("#end_date")
                        .val(response.end_date);
                }
            },
        });
    });

    $("#public_holiday_update_form").validate({
        rules: {
            holiday_name: {
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
            holiday_name: {
                required: "Holiday Name required",
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
                url: base_url + "update_public_holiday",
                data: $(form).serialize(),
                dataType: "json",
                success: function (response) {
                    if (response) {
                        $("#view_public_holiday").DataTable().ajax.reload();
                        $(".public_holiday_updated_msg").removeClass("d-none");
                        $("#public_holiday_update_form").trigger("reset");
                        $('#update_public_holiday').modal("toggle")
                    }
                },
            });
        },
    });
    // update employee leave  end

    // add  button to data table to add job vacancy start
    // adding button to the create user datatable to add user start
    setTimeout(() => {
        $(document).find("#view_public_holiday_filter").append(
            '<span class="add_user_div" ">\
                         <button type="button" class="btn bg-primary sidenav_zero_index add_public_holiday_btn btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#add_public_holiday" style="height:32px"> <i class="fa-solid fa-plus text-white"></i>\
                </button>\
          </span>\
       '
        );
        // check the contstains for company owner to add user start
    }, 1);
    // add  button to data table to add job vacancy end
});

</script>

@endSection
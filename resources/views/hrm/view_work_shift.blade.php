@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/hrm/css/work_shift.css')}}">
@endSection
@section('body_content')
<div class="row">
    <div class="col-md-12 ">

        <!-- Button trigger modal -->
        <!-- Button trigger modal -->


        <!-- Modal -->
        <div class="modal fade" id="delete_confirm_work_shift" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form id="delete_form">
                        <input type="hidden" name="delete_work_shift_id" id="delete_work_shift_id">
                    </form>
                    <!-- <div class="modal-header border-0">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div> -->
                    <div class="modal-body">
                        Are You sure to delete this Work Shift ?

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="button" class="btn btn-primary confirm_delete_work_shift" data-bs-dismiss="modal">Confirm</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- add work_shift start  -->
        <div class="modal fade" id="add_work_shift" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header vacancy_modal_header">
                        <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Add Work Shift</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        <!-- content start   -->
                        <div class="container-fluid create_user_main p-0">
                            <div class="row">
                                <div class="col-md-12">
                                    <form role="form" action="" method="post" id="work_shift_form">
                                        @csrf
                                        <div class="container-fluid">
                                            <div class="row">
                                                <!-- shift name -->
                                                <div class="mb-3 col-md-6">
                                                    <label for="start_date">Shift Name</label>
                                                    <input type="text" class="form-control" placeholder="Shift Name " aria-label="Shift Name" name="shift_name" id="shift_name">
                                                </div>

                                                <!-- start_time -->
                                                <div class="mb-3 col-md-6">
                                                    <label for="start_time">Start Time</label>
                                                    <input type="time" class="form-control" placeholder="Start Time " aria-label="Start Time" name="start_time" id="start_time">
                                                </div>


                                                <!-- end_time -->
                                                <div class="mb-3 col-md-6">
                                                    <label for="end_time">End Time</label>
                                                    <input type="time" name="end_time" id="end_time" placeholder="End Time" class="form-control">
                                                </div>
                                                <!-- compromize_time -->
                                                <div class="mb-3 col-md-6">
                                                    <label for="compromize_time">compromize Time</label>
                                                    <input type="time" name="compromize_time" id="compromize_time" placeholder="Compromize Time" class="form-control">
                                                </div>


                                                <div class="text-center col-md-6 m-auto">
                                                    <button type="submit" id="add_work_shift_btn" class="btn bg-primary w-100 my-4 mb-2 text-white">Add Work Shift</button>
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
        <div class="modal fade" id="update_work_shift" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header vacancy_modal_header">
                        <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Update Work Shift</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        <!-- content start   -->
                        <div class="container-fluid create_user_main p-0">
                            <div class="row">
                                <div class="col-md-12">
                                    <form role="form" action="" method="post" id="work_shift_update_form">
                                        <input type="hidden" name="work_shift_id" id="work_shift_id" value="">
                                        @csrf
                                        <div class="container-fluid">
                                            <div class="row">
                                                <!-- shift name -->
                                                <div class="mb-3 col-md-6">
                                                    <label for="start_date">Shift Name</label>
                                                    <input type="text" class="form-control" placeholder="Shift Name " aria-label="Shift Name" name="shift_name" id="shift_name">
                                                </div>

                                                <!-- start_time -->
                                                <div class="mb-3 col-md-6">
                                                    <label for="start_time">Start Time</label>
                                                    <input type="time" class="form-control" placeholder="Start Time " aria-label="Start Time" name="start_time" id="start_time">
                                                </div>


                                                <!-- end_time -->
                                                <div class="mb-3 col-md-6">
                                                    <label for="end_time">End Time</label>
                                                    <input type="time" name="end_time" id="end_time" placeholder="End Time" class="form-control">
                                                </div>
                                                <!-- compromize_time -->
                                                <div class="mb-3 col-md-6">
                                                    <label for="compromize_time">compromize Time</label>
                                                    <input type="time" name="compromize_time" id="compromize_time" placeholder="Compromize Time" class="form-control">
                                                </div>
                                                <div class="text-center col-md-6 m-auto">
                                                    <button type="submit" id="add_work_shift_btn" class="btn bg-primary w-100 my-4 mb-2 text-white">Update Work Shift</button>
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
                    <table class="table align-items-center mb-0  hover" id="view_work_shift" style="width: 100%;">

                        <!-- show message when work_shift   added  start  -->
                        <div class="mb-3 col-md-12">
                            <div class="alert alert-success  d-none text-white work_shift_added_msg user_updated_msg" role="alert">
                                Work Shift added
                                <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                            </div>
                        </div>
                        <!-- show message when work_shift   added  start  -->
                        <!-- show message when work_shift    updated  start  -->
                        <div class="mb-3 col-md-12">
                            <div class="alert alert-success  d-none text-white work_shift_updated_msg user_updated_msg" role="alert">
                                Work Shift updated
                                <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                            </div>
                        </div>
                        <!-- show message when work_shift    updated  start  -->
                        <!-- show message when work_shift    deleted start  -->
                        <div class="mb-3 col-md-12">
                            <div class="alert alert-success  d-none text-white work_shift_deleted_msg user_updated_msg" role="alert">
                                Work Shift deleted
                                <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                            </div>
                        </div>
                        <!-- show message when job vacancy   deleted  start  -->
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">S no</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Shift Name</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Start Time</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">End Time</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Compromize Time</th>
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
    $("#work_shift_form").validate({
        rules: {
            shift_name: {
                required: true,
            },

            start_time: {
                required: true,
            },
            end_time: {
                required: true,
            },
        },
        messages: {
            shift_name: {
                required: "Shift Name required",
            },
            start_time: {
                required: "Start time Required",
            },
            end_date: {
                required: "End time Required",
            },
        },
        submitHandler: function (form) {
            $.ajax({
                type: "post",
                url: base_url + "work_shift",
                data: $(form).serialize(),
                dataType: "json",
                success: function (response) {
                    if (response) {
                        $("#work_shift_form").trigger("reset");
                        $("#view_work_shift").DataTable().ajax.reload();
                        $("#add_work_shift").modal("toggle");
                        $(".work_shift_added_msg").removeClass("d-none");
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

        $("#view_work_shift").DataTable({
            processing: true,
            serverSide: true,
            ajax: base_url + "get_data_work_shift",
            columns: [
                { data: "DT_RowIndex", name: "DT_RowIndex" },
                { data: "shift_name", name: "shift_name" },
                { data: "start_time", name: "start_time" },
                { data: "end_time", name: "end_time" },
                { data: "compromize_time", name: "compromize_time" },
                { data: "action", name: "action" },
            ],
        });
    });
    // dattables end

    // delete user start
    $(document).on("click", ".work_shift_delete_btn", function (param) {
        $('#delete_work_shift_id').val( $(this).data("delete_work_shift_id"))  ;
        $(".confirm_delete_work_shift").on("click", function () {
            $.ajax({
                type: "post",
                url: base_url + "delete_work_shift",
                data: $('#delete_form').serialize(),
                dataType: "json",
                success: function (response) {
                    if (response) {
                        $("#view_work_shift").DataTable().ajax.reload();
                        $(".work_shift_deleted_msg").removeClass("d-none");
                    }
                },
            });
        });
    });
    // delete user end
    // update employee leave  start
    $(document).on("click", ".work_shift_edit_btn", function (param) {
        let update_work_shift_id = $(this).data("update_work_shift_id");
        $.ajax({
            type: "post",
            url: base_url + "fetch_work_shift",
            data: { update_work_shift_id: update_work_shift_id },
            dataType: "json",
            success: function (response) {
                if (response) {
                    $("#work_shift_update_form")
                        .find("#work_shift_id")
                        .val(response.work_shift_id);
                    $("#work_shift_update_form")
                        .find("#shift_name")
                        .val(response.shift_name);
                    $("#work_shift_update_form")
                        .find("#start_time")
                        .val(response.start_time);
                    $("#work_shift_update_form")
                        .find("#end_time")
                        .val(response.end_time);
                    $("#work_shift_update_form")
                        .find("#compromize_time")
                        .val(response.compromize_time);
                }
            },
        });
    });

    $("#work_shift_update_form").validate({
        rules: {
            shift_name: {
                required: true,
            },

            start_time: {
                required: true,
            },
            end_time: {
                required: true,
            },
        },
        messages: {
            shift_name: {
                required: "Shift Name required",
            },
            start_time: {
                required: "Start time Required",
            },
            end_date: {
                required: "End time Required",
            },
        },
        submitHandler: function (form) {
            $.ajax({
                type: "post",
                url: base_url + "update_work_shift",
                data: $(form).serialize(),
                dataType: "json",
                success: function (response) {
                    if (response) {
                        $("#view_work_shift").DataTable().ajax.reload();
                        $(".work_shift_updated_msg").removeClass("d-none");
                        $("#work_shift_update_form").trigger("reset");
                        $('#update_work_shift').modal("toggle")
                    }
                },
            });
        },
    });
    // update employee leave  end

    // add  button to data table to add job vacancy start
    // adding button to the create user datatable to add user start
    setTimeout(() => {
        $(document).find("#view_work_shift_filter").append(
            '<span class="add_user_div" ">\
                         <button type="button" class="btn bg-primary sidenav_zero_index add_work_shift_btn btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#add_work_shift" style="height:32px"> <i class="fa-solid fa-plus text-white"></i>\
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
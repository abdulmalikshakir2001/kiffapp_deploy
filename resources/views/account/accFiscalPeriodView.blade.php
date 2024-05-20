@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{ asset('dashboard_assets/account/css/acc_fiscal_period.css') }}">
@endSection
@section('body_content')
<div class="row">
    <div class="col-md-12 ">

        <!-- status change modal  -->
        <!-- Modal -->
        <div class="modal fade" id="status_change_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Status Change</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="status_change_form">
                            @csrf
                            <input type="hidden" name="status" id="status">
                            <input type="hidden" name="status_change_id" id="status_change_id">

                        </form>
                        Click ok to save changes

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn bg-gradient-primary"
                            id="status_change_confirm_button" data-bs-dismiss="modal">ok</button>
                    </div>
                </div>
            </div>
        </div>





        <!-- Modal -->
        <div class="modal fade" id="accFiscalPeriodDeleteConfirm" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form id="delete_form">
                        <input type="hidden" name="accFiscalPeriodId" id="acc_fiscal_period_delete_id">
                    </form>
                    <!-- <div class="modal-header border-0">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div> -->
                    <div class="modal-body">
                        Are You sure to delete this Fiscal Period ?

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="button" class="btn btn-primary accFiscalPeriodDeleteConfirmBtn"
                            data-bs-dismiss="modal">Confirm</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- add accFiscalPeriod start  -->
        <div class="modal fade" id="accFiscalPeriodAddModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header vacancy_modal_header">
                        <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Add Fiscal Period</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        <!-- content start   -->
                        <div class="container-fluid create_user_main p-0">
                            <div class="row">
                                <div class="col-md-12">
                                    <form role="form" action="" method="post" id="accFiscalPeriodForm">
                                        @csrf
                                        <div class="container-fluid">
                                            <div class="row">
                                                <!-- Fiscal Period name -->
                                                <div class="mb-3 col-md-6">
                                                    <label for="name">Fiscal Period Name</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Fiscal Period Name "
                                                        aria-label="Fiscal Period Name" name="name" id="name">
                                                </div>

                                                <!-- start date -->
                                                <div class="mb-3 col-md-6">
                                                    <label for="start_date">Start Date</label>
                                                    <input type="date" class="form-control" name="start_date"
                                                        id="start_date">
                                                </div>
                                                <!-- end date -->
                                                <div class="mb-3 col-md-12">
                                                    <label for="end_date">End Date</label>
                                                    <input type="date" class="form-control" name="end_date"
                                                        id="end_date">
                                                </div>


                                                <!-- Status -->
                                                <div class="mb-3 col-md-12">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="status_add"
                                                            name="status_add">
                                                        <label class="form-check-label" for="status_add">Status</label>
                                                    </div>

                                                </div>











                                                <div class="text-center col-md-12 m-auto">
                                                    <button type="submit" id="accFiscalPeriodAddBtn"
                                                        class="btn bg-primary w-100 my-4 mb-2 text-white">Add</button>
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
        <div class="modal fade" id="accFiscalPeriodUpdateModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header vacancy_modal_header">
                        <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Update Fiscal Period</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        <!-- content start   -->
                        <div class="container-fluid create_user_main p-0">
                            <div class="row">
                                <div class="col-md-12">
                                    <form role="form" action="" method="post" id="accFiscalPeriodUpdateForm">
                                        <input type="hidden" name="acc_fiscal_period_id" id="acc_fiscal_period_id"
                                            value="">
                                        @csrf
                                        <div class="container-fluid">
                                            <div class="row">
                                                <!-- Fiscal Period name -->
                                                <div class="mb-3 col-md-6">
                                                    <label for="name">Fiscal Period Name</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Fiscal Period Name "
                                                        aria-label="Fiscal Period Name" name="name" id="name">
                                                </div>

                                                <!-- start date -->
                                                <div class="mb-3 col-md-6">
                                                    <label for="start_date">Start Date</label>
                                                    <input type="date" class="form-control" name="start_date"
                                                        id="start_date">
                                                </div>
                                                <!-- end date -->
                                                <div class="mb-3 col-md-6">
                                                    <label for="end_date">End Date</label>
                                                    <input type="date" class="form-control" name="end_date"
                                                        id="end_date">
                                                </div>






                                                {{-- button --}}
                                                <div class="text-center col-md-12 m-auto">
                                                    <button type="submit" id="accFiscalPeriodUpdateBtn"
                                                        class="btn bg-primary w-100 my-4 mb-2 text-white">Update</button>
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
                    <table class="table align-items-center mb-0  hover" id="accFiscalPeriodTable" style="width: 100%;">

                        <!-- show message when accFiscalPeriod   added  start  -->
                        <div class="mb-3 col-md-12">
                            <div class="alert alert-success  d-none text-white accFiscalPeriodAddedMsg user_updated_msg"
                                role="alert">
                                Fiscal Period added
                                <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                            </div>
                        </div>
                        <!-- show message when accFiscalPeriod   added  start  -->
                        <!-- show message when accFiscalPeriod    updated  start  -->
                        <div class="mb-3 col-md-12">
                            <div class="alert alert-success  d-none text-white accFiscalPeriodUpdatedMsg user_updated_msg"
                                role="alert">
                                Fiscal Period updated
                                <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                            </div>
                        </div>
                        <!-- show message when accFiscalPeriod    updated  start  -->
                        <!-- show message when accFiscalPeriod    deleted start  -->
                        <div class="mb-3 col-md-12">
                            <div class="alert alert-success  d-none text-white accFiscalPeriodDeletedMsg user_updated_msg"
                                role="alert">
                                Fiscal Period deleted
                                <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                            </div>
                        </div>
                        <!-- show message when job vacancy   deleted  start  -->
                        <!-- show message when status change start  -->
                        <div class="mb-3 col-md-12">
                            <div class="alert alert-success  d-none text-white status_change_message user_updated_msg"
                                role="alert">
                                Status Changed
                                <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                            </div>
                        </div>
                        <!-- show message when status change  start  -->
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">S no</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Name
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Start Date
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">End Date
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Status
                                </th>



                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">
                                    Actions</th>
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


        // warehouse 
        $('#warehouse_id').on('change', function (param) {
            let warehouse_idValue = $(this).val();
            if (warehouse_idValue == "") {
                $('#warehouse_id-error').removeClass('d-none') // label
            } else {
                $('#warehouse_id-error').addClass('d-none') // label
            }
        })
        $("#warehouse_id").select2({
            placeholder: "Select Warehouse",
            allowClear: true,
            width: "100%",
        });
        $('#warehouse_id_update').on('change', function (param) {

            let warehouse_id_updateValue = $(this).val();
            if (warehouse_id_updateValue == "") {
                $('#warehouse_id_update-error').removeClass('d-none') // label
            } else {
                $('#warehouse_id_update-error').addClass('d-none') // label
            }
        })
        $("#warehouse_id_update").select2({
            placeholder: "Select Warehouse",
            allowClear: true,
            width: "100%",
        });





        // parent
        $("#parent").select2({
            placeholder: "Select Category",
            allowClear: true,
            width: "100%",
        });
        $("#accFiscalPeriodUpdateForm #parent").select2({
            placeholder: "Select Category",
            allowClear: true,
            width: "100%",
        });

        // hide select error when the field is selected start 
        $('#accFiscalPeriodUpdateForm #parent').on('change', function (param) {
            let parentValue = $(this).val();
            if (parentValue == "") {
                $('#parent-error').removeClass('d-none') // label
            } else {
                $('#parent-error').addClass('d-none') // label
            }
        })

        // tiny mce start
        @php
        $baseUrl = config('app.url');
                echo "var base_url = '".$baseUrl. "';";
        @endphp

        // add job vacancies  start
        $("#accFiscalPeriodForm").validate({
            rules: {
                name: {
                    required: true,
                },
                warehouse_id: {
                    required: true

                }
            },
            messages: {
                name: {
                    required: "Fiscal Period name required",
                },
                warehouse_id: {
                    required: 'This field is required'

                }

            },

            submitHandler: function (form) {
                $.ajax({
                    type: "post",
                    url: base_url + "acc_fiscal_period",
                    data: $(form).serialize(),
                    dataType: "json",
                    success: function (response) {
                        if (response) {
                            defaultSelect2($('#accFiscalPeriodForm').find('#warehouse_id'))
                            $("#accFiscalPeriodForm").trigger("reset");
                            $("#accFiscalPeriodTable").DataTable().ajax.reload();
                            $("#accFiscalPeriodAddModal").modal("toggle");
                            $(".accFiscalPeriodAddedMsg").removeClass("d-none");
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
            $("#accFiscalPeriodTable").DataTable({
                processing: true,
                serverSide: true,
                ajax: base_url + "acc_fiscal_period_get_data",
                columns: [{
                    data: "DT_RowIndex",
                    name: "DT_RowIndex"
                },
                {
                    data: "name",
                    name: "name"
                },
                {
                    data: "start_date",
                    name: "start_date"
                },
                {
                    data: "end_date",
                    name: "end_date"
                },
                {
                    data: "status",
                    name: "status"
                },
                {
                    data: "action",
                    name: "action"
                },
                ],
                "drawCallback": function (settings) {
                    $('.status_add').on('click', function () {
                        let status = $(this).data('status')
                        let id = $(this).data('id')
                        $('#status').val(status)
                        $('#status_change_id').val(id)
                        $('#status_change_confirm_button').on('click', function (e) {
                            e.stopImmediatePropagation();
                            // send form start 
                            
                                // Make a POST request with the FormData
                                fetch(base_url + 'fiscal_period_status_change', {
                                    method: 'POST',
                                    body: new FormData(document.getElementById('status_change_form'))
                                })
                                    .then(response => {
                                        if (!response.ok) {
                                            throw new Error('Network response was not ok');
                                        }
                                        return response.json();
                                    })
                                    .then(data => {
                                        // Process the response data
                                        $('.status_change_message').removeClass('d-none')
                                        $("#accFiscalPeriodTable").DataTable().ajax.reload();
                                        
                                    })
                                    .catch(error => {
                                        console.error('Fetch error:', error);
                                    });
                            



                            // send form end 



                        })


                    })

                }


            });
        });
        // dattables end

        // delete user start
        $(document).on("click", ".accFiscalPeriodDeleteBtn", function (param) {
            $('#acc_fiscal_period_delete_id').val($(this).data("acc_fiscal_period_id"));

            $('#sidenav-main')

            setTimeout(() => {
                $('#accFiscalPeriodDeleteConfirm').modal('show')
            }, 50);


            $(".accFiscalPeriodDeleteConfirmBtn").on("click", function () {
                $.ajax({
                    type: "post",
                    url: base_url + "acc_fiscal_period_delete",
                    data: $('#delete_form').serialize(),
                    dataType: "json",
                    success: function (response) {
                        if (response) {
                            $("#accFiscalPeriodTable").DataTable().ajax.reload();
                            $(".accFiscalPeriodDeletedMsg").removeClass("d-none");
                        }
                    },
                });
            });
        });
        // delete user end
        // update employee leave  start
        $(document).on("click", ".accFiscalPeriodEditBtn", function (param) {
            let accFiscalPeriodId = $(this).data("acc_fiscal_period_id");
            $.ajax({
                type: "post",
                url: base_url + "acc_fiscal_period_fetch",
                data: {
                    accFiscalPeriodId: accFiscalPeriodId
                },
                dataType: "json",
                success: function (response) {
                    if (response) {
                        $("#accFiscalPeriodUpdateForm")
                            .find("#acc_fiscal_period_id")
                            .val(response.acc_fiscal_period_id);
                        $("#accFiscalPeriodUpdateForm")
                            .find("#name")
                            .val(response.name);
                        $("#accFiscalPeriodUpdateForm")
                            .find("#start_date")
                            .val(response.start_date);
                        $("#accFiscalPeriodUpdateForm")
                            .find("#end_date")
                            .val(response.end_date);










                    }
                },
            });
        });

        $("#accFiscalPeriodUpdateForm").validate({
            rules: {
                name: {
                    required: true,
                },
                warehouse_id: {
                    required: true

                }
            },
            messages: {
                name: {
                    required: "Fiscal Period name required",
                },
                warehouse_id: {
                    required: 'This field is required'

                }

            },


            submitHandler: function (form) {
                $.ajax({
                    type: "post",
                    url: base_url + "acc_fiscal_period_update",
                    data: $(form).serialize(),
                    dataType: "json",
                    success: function (response) {
                        if (response) {
                            $("#accFiscalPeriodTable").DataTable().ajax.reload();
                            $(".accFiscalPeriodUpdatedMsg").removeClass("d-none");

                            $('#accFiscalPeriodUpdateModal').modal("toggle")
                        }
                    },
                });
            },
        });
        // update employee leave  end

        // add  button to data table to add job vacancy start
        // adding button to the create user datatable to add user start
        setTimeout(() => {
            $(document).find("#accFiscalPeriodTable_filter").append(
                '<span class="add_user_div" ">\
                                     <button type="button" class="btn bg-primary sidenav_zero_index accFiscalPeriodAddBtn btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#accFiscalPeriodAddModal" style="height:32px"> <i class="fa-solid fa-plus text-white"></i>\
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
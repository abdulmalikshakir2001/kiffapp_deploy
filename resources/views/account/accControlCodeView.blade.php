@extends('dashboard/nav_footer')
@section('page_header_links')
    <link rel="stylesheet" href="{{ asset('dashboard_assets/account/css/acc_control_code.css') }}">
@endSection
@section('body_content')
    <div class="row">
        <div class="col-md-12 ">

            <!-- Button trigger modal -->
            <!-- Button trigger modal -->


            <!-- Modal -->
            <div class="modal fade" id="accControlCodeDeleteConfirm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form id="delete_form">
                            <input type="hidden" name="accControlCodeId" id="acc_control_code_delete_id">
                        </form>

                        <!-- <div class="modal-header border-0">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div> -->
                        <div class="modal-body">
                            Are You sure to delete this Contol Code ?

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                            <button type="button" class="btn btn-primary accControlCodeDeleteConfirmBtn"
                                data-bs-dismiss="modal">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- add accControlCode start  -->
            <div class="modal fade" id="accControlCodeAddModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header vacancy_modal_header">
                            <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Add Contol Code</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-0">
                            <!-- content start   -->
                            <div class="container-fluid create_user_main p-0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form role="form" action="" method="post" id="accControlCodeForm">
                                            @csrf
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <!-- Contol Code name -->
                                                    <div class="mb-3 col-md-6">
                                                        <label for="control_code">Contol Code </label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Contol Code " aria-label="Contol Code "
                                                            name="control_code" id="control_code">
                                                    </div>
                                                    <!-- Description -->
                                                    <div class="mb-3 col-md-6">
                                                        <label for="name">Description</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Description" aria-label="Description"
                                                            name="description" id="description">
                                                    </div>
                                                    
                                                    


                                                    
                                                    


                                                    <div class="text-center col-md-12 m-auto">
                                                        <button type="submit" id="accControlCodeAddBtn"
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
            <div class="modal fade" id="accControlCodeUpdateModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header vacancy_modal_header">
                            <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Update Contol Code</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-0">
                            <!-- content start   -->
                            <div class="container-fluid create_user_main p-0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form role="form" action="" method="post" id="accControlCodeUpdateForm">
                                            <input type="hidden" name="acc_control_code_id" id="acc_control_code_id" value="">
                                            @csrf
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <!-- Contol Code name -->
                                                    <div class="mb-3 col-md-6">
                                                        <label for="control_code">Contol Code </label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Contol Code " aria-label="Contol Code "
                                                            name="control_code" id="control_code">
                                                    </div>
                                                           <!-- Description -->
                                                           <div class="mb-3 col-md-6">
                                                            <label for="name">Description</label>
                                                            <input type="text" class="form-control"
                                                                placeholder="Description" aria-label="Description"
                                                                name="description" id="description">
                                                        </div>
                                                        
                                                        
    
    
                                                    
                                             
                                                    

                                                    {{-- button --}}
                                                    <div class="text-center col-md-12 m-auto">
                                                        <button type="submit" id="accControlCodeUpdateBtn"
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
                        <table class="table align-items-center mb-0  hover" id="accControlCodeTable" style="width: 100%;">

                            <!-- show message when accControlCode   added  start  -->
                            <div class="mb-3 col-md-12">
                                <div class="alert alert-success  d-none text-white accControlCodeAddedMsg user_updated_msg"
                                    role="alert">
                                    Contol Code added
                                    <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                </div>
                            </div>
                            <!-- show message when accControlCode   added  start  -->
                            <!-- show message when accControlCode    updated  start  -->
                            <div class="mb-3 col-md-12">
                                <div class="alert alert-success  d-none text-white accControlCodeUpdatedMsg user_updated_msg"
                                    role="alert">
                                    Contol Code updated
                                    <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                </div>
                            </div>
                            <!-- show message when accControlCode    updated  start  -->
                            <!-- show message when accControlCode    deleted start  -->
                            <div class="mb-3 col-md-12">
                                <div class="alert alert-success  d-none text-white accControlCodeDeletedMsg user_updated_msg"
                                    role="alert">
                                    Contol Code deleted
                                    <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                </div>
                            </div>
                            <!-- show message when job vacancy   deleted  start  -->
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">S no</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Control Code
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Description
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
        $(document).ready(function() {
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
            $("#accControlCodeUpdateForm #parent").select2({
                placeholder: "Select Category",
                allowClear: true,
                width: "100%",
            });

            // hide select error when the field is selected start 
            $('#accControlCodeUpdateForm #parent').on('change', function(param) {
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
                echo "var base_url = '" . $baseUrl . "';";
            @endphp

            // add job vacancies  start
            $("#accControlCodeForm").validate({
                rules: {
                    name: {
                        required: true,
                    },
                    warehouse_id:{
                        required:true

                    }
                },
                messages: {
                    name: {
                        required: "Contol Code name required",
                    },
                    warehouse_id:{
                        required:'This field is required'

                    }

                },
                
                submitHandler: function(form) {
                    $.ajax({
                        type: "post",
                        url: base_url + "acc_control_code",
                        data: $(form).serialize(),
                        dataType: "json",
                        success: function(response) {
                            if (response) {
                                defaultSelect2($('#accControlCodeForm').find('#warehouse_id'))
                                $("#accControlCodeForm").trigger("reset");
                                $("#accControlCodeTable").DataTable().ajax.reload();
                                $("#accControlCodeAddModal").modal("toggle");
                                $(".accControlCodeAddedMsg").removeClass("d-none");
                            }
                        },
                    });
                },
            });

            // add job vaccanices end
            // dattables
            $(function() {
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });

                $("#accControlCodeTable").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: base_url + "acc_control_code_get_data",
                    columns: [{
                            data: "DT_RowIndex",
                            name: "DT_RowIndex"
                        },
                        {
                            data: "control_code",
                            name: "control_code"
                        },
                        {
                            data: "description",
                            name: "description"
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
            $(document).on("click", ".accControlCodeDeleteBtn", function(param) {
                $('#acc_control_code_delete_id').val($(this).data("acc_control_code_id"));

                $('#sidenav-main')

                setTimeout(() => {
                    $('#accControlCodeDeleteConfirm').modal('show')
                }, 50);

                
                $(".accControlCodeDeleteConfirmBtn").on("click", function() {
                    $.ajax({
                        type: "post",
                        url: base_url + "acc_control_code_delete",
                        data: $('#delete_form').serialize(),
                        dataType: "json",
                        success: function(response) {
                            if (response) {
                                $("#accControlCodeTable").DataTable().ajax.reload();
                                $(".accControlCodeDeletedMsg").removeClass("d-none");
                            }
                        },
                    });
                });
            });
            // delete user end
            // update employee leave  start
            $(document).on("click", ".accControlCodeEditBtn", function(param) {
                let accControlCodeId = $(this).data("acc_control_code_id");
                $.ajax({
                    type: "post",
                    url: base_url + "acc_control_code_fetch",
                    data: {
                        accControlCodeId: accControlCodeId
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response) {
                            $("#accControlCodeUpdateForm")
                                .find("#acc_control_code_id")
                                .val(response.acc_control_code_id);
                            $("#accControlCodeUpdateForm")
                                .find("#control_code")
                                .val(response.control_code);
                            $("#accControlCodeUpdateForm")
                                .find("#description")
                                .val(response.description);
                            

                                






                            

                        }
                    },
                });
            });

            $("#accControlCodeUpdateForm").validate({
                rules: {
                    name: {
                        required: true,
                    },
                    warehouse_id:{
                        required:true

                    }
                },
                messages: {
                    name: {
                        required: "Contol Code name required",
                    },
                    warehouse_id:{
                        required:'This field is required'

                    }

                },
                
                
                submitHandler: function(form) {
                    $.ajax({
                        type: "post",
                        url: base_url + "acc_control_code_update",
                        data: $(form).serialize(),
                        dataType: "json",
                        success: function(response) {
                            if (response) {
                                $("#accControlCodeTable").DataTable().ajax.reload();
                                $(".accControlCodeUpdatedMsg").removeClass("d-none");
                                
                                $('#accControlCodeUpdateModal').modal("toggle")
                            }
                        },
                    });
                },
            });
            // update employee leave  end

            // add  button to data table to add job vacancy start
            // adding button to the create user datatable to add user start
            setTimeout(() => {
                $(document).find("#accControlCodeTable_filter").append(
                    '<span class="add_user_div" ">\
                                     <button type="button" class="btn bg-primary sidenav_zero_index accControlCodeAddBtn btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#accControlCodeAddModal" style="height:32px"> <i class="fa-solid fa-plus text-white"></i>\
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

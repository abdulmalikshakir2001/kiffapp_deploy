@extends('dashboard/nav_footer')
@section('page_header_links')
    <link rel="stylesheet" href="{{ asset('dashboard_assets/account/css/acc_cost_center.css') }}">
@endSection
@section('body_content')
    <div class="row">
        <div class="col-md-12 ">

            <!-- Button trigger modal -->
            <!-- Button trigger modal -->


            <!-- Modal -->
            <div class="modal fade" id="accCostCenterDeleteConfirm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form id="delete_form">
                            <input type="hidden" name="accCostCenterId" id="acc_cost_center_delete_id">
                        </form>
                        <!-- <div class="modal-header border-0">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div> -->
                        <div class="modal-body">
                            Are You sure to delete this Cost Center ?

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                            <button type="button" class="btn btn-primary accCostCenterDeleteConfirmBtn"
                                data-bs-dismiss="modal">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- add accCostCenter start  -->
            <div class="modal fade" id="accCostCenterAddModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header vacancy_modal_header">
                            <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Add Cost Center</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-0">
                            <!-- content start   -->
                            <div class="container-fluid create_user_main p-0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form role="form" action="" method="post" id="accCostCenterForm">
                                            @csrf
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <!-- Cost Center name -->
                                                    <div class="mb-3 col-md-6">
                                                        <label for="name">Cost Center Name</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Cost Center Name " aria-label="Cost Center Name"
                                                            name="name" id="name">
                                                    </div>
                                                    <!-- Description -->
                                                    <div class="mb-3 col-md-6">
                                                        <label for="name">Description</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Description" aria-label="Description"
                                                            name="description" id="description">
                                                    </div>
                                                    
                                                    


                                                    
                                                    


                                                    <div class="text-center col-md-12 m-auto">
                                                        <button type="submit" id="accCostCenterAddBtn"
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
            <div class="modal fade" id="accCostCenterUpdateModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header vacancy_modal_header">
                            <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Update Cost Center</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-0">
                            <!-- content start   -->
                            <div class="container-fluid create_user_main p-0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form role="form" action="" method="post" id="accCostCenterUpdateForm">
                                            <input type="hidden" name="acc_cost_center_id" id="acc_cost_center_id" value="">
                                            @csrf
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <!-- Cost Center name -->
                                                    <div class="mb-3 col-md-6">
                                                        <label for="name">Cost Center Name</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Cost Center Name " aria-label="Cost Center Name"
                                                            name="name" id="name">
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
                                                        <button type="submit" id="accCostCenterUpdateBtn"
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
                        <table class="table align-items-center mb-0  hover" id="accCostCenterTable" style="width: 100%;">

                            <!-- show message when accCostCenter   added  start  -->
                            <div class="mb-3 col-md-12">
                                <div class="alert alert-success  d-none text-white accCostCenterAddedMsg user_updated_msg"
                                    role="alert">
                                    Cost Center added
                                    <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                </div>
                            </div>
                            <!-- show message when accCostCenter   added  start  -->
                            <!-- show message when accCostCenter    updated  start  -->
                            <div class="mb-3 col-md-12">
                                <div class="alert alert-success  d-none text-white accCostCenterUpdatedMsg user_updated_msg"
                                    role="alert">
                                    Cost Center updated
                                    <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                </div>
                            </div>
                            <!-- show message when accCostCenter    updated  start  -->
                            <!-- show message when accCostCenter    deleted start  -->
                            <div class="mb-3 col-md-12">
                                <div class="alert alert-success  d-none text-white accCostCenterDeletedMsg user_updated_msg"
                                    role="alert">
                                    Cost Center deleted
                                    <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                </div>
                            </div>
                            <!-- show message when job vacancy   deleted  start  -->
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">S no</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Name
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
            $("#accCostCenterUpdateForm #parent").select2({
                placeholder: "Select Category",
                allowClear: true,
                width: "100%",
            });

            // hide select error when the field is selected start 
            $('#accCostCenterUpdateForm #parent').on('change', function(param) {
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
            $("#accCostCenterForm").validate({
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
                        required: "Cost Center name required",
                    },
                    warehouse_id:{
                        required:'This field is required'

                    }

                },
                
                submitHandler: function(form) {
                    $.ajax({
                        type: "post",
                        url: base_url + "acc_cost_center",
                        data: $(form).serialize(),
                        dataType: "json",
                        success: function(response) {
                            if (response) {
                                defaultSelect2($('#accCostCenterForm').find('#warehouse_id'))
                                $("#accCostCenterForm").trigger("reset");
                                $("#accCostCenterTable").DataTable().ajax.reload();
                                $("#accCostCenterAddModal").modal("toggle");
                                $(".accCostCenterAddedMsg").removeClass("d-none");
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

                $("#accCostCenterTable").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: base_url + "acc_cost_center_get_data",
                    columns: [{
                            data: "DT_RowIndex",
                            name: "DT_RowIndex"
                        },
                        {
                            data: "name",
                            name: "name"
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
            $(document).on("click", ".accCostCenterDeleteBtn", function(param) {
                 $('#acc_cost_center_delete_id').val($(this).data("acc_cost_center_id"))   ;

                $('#sidenav-main')

                setTimeout(() => {
                    $('#accCostCenterDeleteConfirm').modal('show')
                }, 50);

                
                $(".accCostCenterDeleteConfirmBtn").on("click", function() {
                    $.ajax({
                        type: "post",
                        url: base_url + "acc_cost_center_delete",
                        data: $('#delete_form').serialize(),
                        dataType: "json",
                        success: function(response) {
                            if (response) {
                                $("#accCostCenterTable").DataTable().ajax.reload();
                                $(".accCostCenterDeletedMsg").removeClass("d-none");
                            }
                        },
                    });
                });
            });
            // delete user end
            // update employee leave  start
            $(document).on("click", ".accCostCenterEditBtn", function(param) {
                let accCostCenterId = $(this).data("acc_cost_center_id");
                $.ajax({
                    type: "post",
                    url: base_url + "acc_cost_center_fetch",
                    data: {
                        accCostCenterId: accCostCenterId
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response) {
                            $("#accCostCenterUpdateForm")
                                .find("#acc_cost_center_id")
                                .val(response.acc_cost_center_id);
                            $("#accCostCenterUpdateForm")
                                .find("#name")
                                .val(response.name);
                            $("#accCostCenterUpdateForm")
                                .find("#description")
                                .val(response.description);
                            

                                






                            

                        }
                    },
                });
            });

            $("#accCostCenterUpdateForm").validate({
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
                        required: "Cost Center name required",
                    },
                    warehouse_id:{
                        required:'This field is required'

                    }

                },
                
                
                submitHandler: function(form) {
                    $.ajax({
                        type: "post",
                        url: base_url + "acc_cost_center_update",
                        data: $(form).serialize(),
                        dataType: "json",
                        success: function(response) {
                            if (response) {
                                $("#accCostCenterTable").DataTable().ajax.reload();
                                $(".accCostCenterUpdatedMsg").removeClass("d-none");
                                
                                $('#accCostCenterUpdateModal').modal("toggle")
                            }
                        },
                    });
                },
            });
            // update employee leave  end

            // add  button to data table to add job vacancy start
            // adding button to the create user datatable to add user start
            setTimeout(() => {
                $(document).find("#accCostCenterTable_filter").append(
                    '<span class="add_user_div" ">\
                                     <button type="button" class="btn bg-primary sidenav_zero_index accCostCenterAddBtn btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#accCostCenterAddModal" style="height:32px"> <i class="fa-solid fa-plus text-white"></i>\
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

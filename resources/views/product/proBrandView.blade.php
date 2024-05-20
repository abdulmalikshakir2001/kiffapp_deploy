@extends('dashboard/nav_footer')
@section('page_header_links')
    <link rel="stylesheet" href="{{ asset('dashboard_assets/product/css/proBrand.css') }}">
@endSection
@section('body_content')
    <div class="row">
        <div class="col-md-12 ">

            <!-- Button trigger modal -->
            <!-- Button trigger modal -->


            <!-- Modal -->
            <div class="modal fade" id="proBrandDeleteConfirm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form id="delete_form">
                            <input type="hidden" name="proBrandId" id="proBrandId">
                        </form>
                        <!-- <div class="modal-header border-0">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div> -->
                        <div class="modal-body">
                            Are You sure to delete this Product Brand ?

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                            <button type="button" class="btn btn-primary proBrandDeleteConfirmBtn"
                                data-bs-dismiss="modal">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- add proBrand start  -->
            <div class="modal fade" id="proBrandAddModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header vacancy_modal_header">
                            <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Add Product Brand</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-0">
                            <!-- content start   -->
                            <div class="container-fluid create_user_main p-0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form role="form" action="" method="post" id="proBrandForm">
                                            @csrf
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <!-- holiday name -->
                                                    <div class="mb-3 col-md-6">
                                                        <label for="brand_name">Brand Name</label>
                                                        <input type="text" class="form-control" placeholder="Brand Name "
                                                            aria-label="Brand Name" name="brand_name" id="brand_name">
                                                    </div>

                                                    <!-- start date -->
                                                    <div class="mb-3 col-md-6">
                                                        <label for="description">Description</label>
                                                        <textarea name="description" cols="" rows="1" id="description" placeholder="Internal Notes"
                                                            class="form-control"></textarea>
                                                    </div>

                                                    <div class="mb-3 col-md-12 form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="active"
                                                            name="active">
                                                        <label class="form-check-label" for="active">Active</label>

                                                    </div>


                                                    <div class="text-center col-md-12 m-auto">
                                                        <button type="submit" id="proBrandAddBtn"
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
            <div class="modal fade" id="proBrandUpdateModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header vacancy_modal_header">
                            <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Update Product Brand</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-0">
                            <!-- content start   -->
                            <div class="container-fluid create_user_main p-0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form role="form" action="" method="post" id="proBrandUpdateForm">
                                            <input type="hidden" name="brand_id" id="brand_id" value="">
                                            @csrf
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <!-- category name -->
                                                    <div class="mb-3 col-md-6">
                                                        <label for="brand_name">Brand Name</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Brand Name " aria-label="Brand Name"
                                                            name="brand_name" id="brand_name">
                                                    </div>

                                                    <!-- description date -->
                                                    <div class="mb-3 col-md-6">
                                                        <label for="description">Description</label>
                                                        <textarea name="description" cols="" rows="1" id="description" placeholder="Internal Notes"
                                                            class="form-control"></textarea>
                                                    </div>



                                                    {{-- is active --}}

                                                    <div class="mb-3 col-md-12 form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="active"
                                                            name="active">
                                                        <label class="form-check-label" for="active">Active</label>

                                                    </div>

                                                    {{-- button --}}
                                                    <div class="text-center col-md-12 m-auto">
                                                        <button type="submit" id="proBrandUpdateBtn"
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
                        <table class="table align-items-center mb-0  hover" id="proBrandTable" style="width: 100%;">

                            <!-- show message when proBrand   added  start  -->
                            <div class="mb-3 col-md-12">
                                <div class="alert alert-success  d-none text-white proBrandAddedMsg user_updated_msg"
                                    role="alert">
                                    Product Brand added
                                    <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                </div>
                            </div>
                            <!-- show message when proBrand   added  start  -->
                            <!-- show message when proBrand    updated  start  -->
                            <div class="mb-3 col-md-12">
                                <div class="alert alert-success  d-none text-white proBrandUpdatedMsg user_updated_msg"
                                    role="alert">
                                    Product Brand updated
                                    <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                </div>
                            </div>
                            <!-- show message when proBrand    updated  start  -->
                            <!-- show message when proBrand    deleted start  -->
                            <div class="mb-3 col-md-12">
                                <div class="alert alert-success  d-none text-white proBrandDeletedMsg user_updated_msg"
                                    role="alert">
                                    Product Brand deleted
                                    <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                </div>
                            </div>
                            <!-- show message when job vacancy   deleted  start  -->
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">S no</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Brand Name
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Description</th>
                                    
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Status</th>
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


            // parent
            $("#parent").select2({
                placeholder: "Select Category",
                allowClear: true,
                width: "100%",
            });
            $("#proBrandUpdateForm #parent").select2({
                placeholder: "Select Category",
                allowClear: true,
                width: "100%",
            });

            // hide select error when the field is selected start 
            $('#proBrandUpdateForm #parent').on('change', function(param) {
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
            $("#proBrandForm").validate({
                rules: {
                    category_name: {
                        required: true,
                    },
                },
                messages: {
                    category_name: {
                        required: "Category Name required",
                    },
                },
                submitHandler: function(form) {
                    $.ajax({
                        type: "post",
                        url: base_url + "proBrand",
                        data: $(form).serialize(),
                        dataType: "json",
                        success: function(response) {
                            if (response) {
                                $("#proBrandForm").trigger("reset");
                                $("#proBrandTable").DataTable().ajax.reload();
                                $("#proBrandAddModal").modal("toggle");
                                $(".proBrandAddedMsg").removeClass("d-none");
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

                $("#proBrandTable").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: base_url + "proBrandGetData",
                    columns: [{
                            data: "DT_RowIndex",
                            name: "DT_RowIndex"
                        },
                        {
                            data: "brand_name",
                            name: "brand_name"
                        },
                        {
                            data: "description",
                            name: "description"
                        },

                        {
                            data: "active",
                            name: "active"
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
            $(document).on("click", ".proBrandDeleteBtn", function(param) {
                $('#proBrandId').val($(this).data("pro_brand_id"))   ;
                $(".proBrandDeleteConfirmBtn").on("click", function() {
                    $.ajax({
                        type: "post",
                        url: base_url + "proBrandDelete",
                        data: $('#delete_form').serialize(),
                        dataType: "json",
                        success: function(response) {
                            if (response) {
                                $("#proBrandTable").DataTable().ajax.reload();
                                $(".proBrandDeletedMsg").removeClass("d-none");
                            }
                        },
                    });
                });
            });
            // delete user end
            // update employee leave  start
            $(document).on("click", ".proBrandEditBtn", function(param) {
                let proBrandId = $(this).data("pro_brand_id");
                $.ajax({
                    type: "post",
                    url: base_url + "proBrandFetch",
                    data: {
                        proBrandId: proBrandId
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response) {
                            $("#proBrandUpdateForm")
                                .find("#brand_id")
                                .val(response.brand_id);
                            $("#proBrandUpdateForm")
                                .find("#brand_name")
                                .val(response.brand_name);
                            $("#proBrandUpdateForm")
                                .find("#description")
                                .val(response.description);

                            if (response.active == 1) {
                                $("#proBrandUpdateForm")
                                    .find("#active").prop('checked', true)

                            } else {
                                $("#proBrandUpdateForm")
                                    .find("#active").prop('checked', false)

                            }

                        }
                    },
                });
            });

            $("#proBrandUpdateForm").validate({
                rules: {
                    category_name: {
                        required: true,
                    },


                },
                messages: {
                    category_name: {
                        required: "Category Name required",
                    },

                },
                submitHandler: function(form) {
                    $.ajax({
                        type: "post",
                        url: base_url + "proBrandUpdate",
                        data: $(form).serialize(),
                        dataType: "json",
                        success: function(response) {
                            if (response) {
                                $("#proBrandTable").DataTable().ajax.reload();
                                $(".proBrandUpdatedMsg").removeClass("d-none");
                                $("#proBrandUpdateForm").trigger("reset");
                                $('#proBrandUpdateModal').modal("toggle")
                            }
                        },
                    });
                },
            });
            // update employee leave  end

            // add  button to data table to add job vacancy start
            // adding button to the create user datatable to add user start
            setTimeout(() => {
                $(document).find("#proBrandTable_filter").append(
                    '<span class="add_user_div" ">\
                                     <button type="button" class="btn bg-primary sidenav_zero_index proBrandAddBtn btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#proBrandAddModal" style="height:32px"> <i class="fa-solid fa-plus text-white"></i>\
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

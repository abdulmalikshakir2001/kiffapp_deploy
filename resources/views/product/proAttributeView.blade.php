@extends('dashboard/nav_footer')
@section('page_header_links')
    <link rel="stylesheet" href="{{ asset('dashboard_assets/product/css/proAttribute.css') }}">
@endSection
@section('body_content')
    <div class="row">
        <div class="col-md-12 ">

            <!-- Button trigger modal -->
            <!-- Button trigger modal -->


            <!-- Modal -->
            <div class="modal fade" id="proAttributeDeleteConfirm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form id="delete_form">
                            <input type="hidden" name="proAttributeId" id="proAttributeId">
                        </form>
                        <!-- <div class="modal-header border-0">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div> -->
                        <div class="modal-body">
                            Are You sure to delete this Product Attribute ?

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                            <button type="button" class="btn btn-primary proAttributeDeleteConfirmBtn"
                                data-bs-dismiss="modal">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- add proAttribute start  -->
            <div class="modal fade" id="proAttributeAddModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header vacancy_modal_header">
                            <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Add Product Attribute</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-0">
                            <!-- content start   -->
                            <div class="container-fluid create_user_main p-0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form role="form" action="" method="post" id="proAttributeForm">
                                            @csrf
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <!-- holiday name -->
                                                    <div class="mb-3 col-md-6">
                                                        <label for="name">Attribute Name</label>
                                                        <input type="text" class="form-control" placeholder="Attribute Name "
                                                            aria-label="Attribute Name" name="name" id="name">
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
                                                        <button type="submit" id="proAttributeAddBtn"
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
            <div class="modal fade" id="proAttributeUpdateModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header vacancy_modal_header">
                            <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Update Product Attribute</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-0">
                            <!-- content start   -->
                            <div class="container-fluid create_user_main p-0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form role="form" action="" method="post" id="proAttributeUpdateForm">
                                            <input type="hidden" name="attribute_id" id="attribute_id" value="">
                                            @csrf
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <!-- category name -->
                                                    <div class="mb-3 col-md-6">
                                                        <label for="name">Attribute Name</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Attribute Name " aria-label="Attribute Name"
                                                            name="name" id="name">
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
                                                        <button type="submit" id="proAttributeUpdateBtn"
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
                        <table class="table align-items-center mb-0  hover" id="proAttributeTable" style="width: 100%;">

                            <!-- show message when proAttribute   added  start  -->
                            <div class="mb-3 col-md-12">
                                <div class="alert alert-success  d-none text-white proAttributeAddedMsg user_updated_msg"
                                    role="alert">
                                    Product Attribute added
                                    <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                </div>
                            </div>
                            <!-- show message when proAttribute   added  start  -->
                            <!-- show message when proAttribute    updated  start  -->
                            <div class="mb-3 col-md-12">
                                <div class="alert alert-success  d-none text-white proAttributeUpdatedMsg user_updated_msg"
                                    role="alert">
                                    Product Attribute updated
                                    <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                </div>
                            </div>
                            <!-- show message when proAttribute    updated  start  -->
                            <!-- show message when proAttribute    deleted start  -->
                            <div class="mb-3 col-md-12">
                                <div class="alert alert-success  d-none text-white proAttributeDeletedMsg user_updated_msg"
                                    role="alert">
                                    Product Attribute deleted
                                    <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                </div>
                            </div>
                            <!-- show message when job vacancy   deleted  start  -->
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">S no</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Attribute Name
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
            $("#proAttributeUpdateForm #parent").select2({
                placeholder: "Select Category",
                allowClear: true,
                width: "100%",
            });

            // hide select error when the field is selected start 
            $('#proAttributeUpdateForm #parent').on('change', function(param) {
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
            $("#proAttributeForm").validate({
                rules: {
                    name: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: "Attribute Name required",
                    },
                },
                submitHandler: function(form) {
                    $.ajax({
                        type: "post",
                        url: base_url + "proAttribute",
                        data: $(form).serialize(),
                        dataType: "json",
                        success: function(response) {
                            if (response) {
                                $("#proAttributeForm").trigger("reset");
                                $("#proAttributeTable").DataTable().ajax.reload();
                                $("#proAttributeAddModal").modal("toggle");
                                $(".proAttributeAddedMsg").removeClass("d-none");
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

                $("#proAttributeTable").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: base_url + "proAttributeGetData",
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
            $(document).on("click", ".proAttributeDeleteBtn", function(param) {
                $('#proAttributeId').val($(this).data("pro_attribute_id"))   ;
                $(".proAttributeDeleteConfirmBtn").on("click", function() {
                    $.ajax({
                        type: "post",
                        url: base_url + "proAttributeDelete",
                        data: $('#delete_form').serialize(),
                        dataType: "json",
                        success: function(response) {
                            if (response) {
                                $("#proAttributeTable").DataTable().ajax.reload();
                                $(".proAttributeDeletedMsg").removeClass("d-none");
                            }
                        },
                    });
                });
            });
            // delete user end
            // update employee leave  start
            $(document).on("click", ".proAttributeEditBtn", function(param) {
                let proAttributeId = $(this).data("pro_attribute_id");
                $.ajax({
                    type: "post",
                    url: base_url + "proAttributeFetch",
                    data: {
                        proAttributeId: proAttributeId
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response) {
                            $("#proAttributeUpdateForm")
                                .find("#attribute_id")
                                .val(response.attribute_id);
                            $("#proAttributeUpdateForm")
                                .find("#name")
                                .val(response.name);
                            $("#proAttributeUpdateForm")
                                .find("#description")
                                .val(response.description);

                            if (response.active == 1) {
                                $("#proAttributeUpdateForm")
                                    .find("#active").prop('checked', true)

                            } else {
                                $("#proAttributeUpdateForm")
                                    .find("#active").prop('checked', false)

                            }

                        }
                    },
                });
            });

            $("#proAttributeUpdateForm").validate({
                rules: {
                    name: {
                        required: true,
                    },


                },
                messages: {
                    name: {
                        required: "Attribute Name required",
                    },

                },
                submitHandler: function(form) {
                    $.ajax({
                        type: "post",
                        url: base_url + "proAttributeUpdate",
                        data: $(form).serialize(),
                        dataType: "json",
                        success: function(response) {
                            if (response) {
                                $("#proAttributeTable").DataTable().ajax.reload();
                                $(".proAttributeUpdatedMsg").removeClass("d-none");
                                $("#proAttributeUpdateForm").trigger("reset");
                                $('#proAttributeUpdateModal').modal("toggle")
                            }
                        },
                    });
                },
            });
            // update employee leave  end

            // add  button to data table to add job vacancy start
            // adding button to the create user datatable to add user start
            setTimeout(() => {
                $(document).find("#proAttributeTable_filter").append(
                    '<span class="add_user_div" ">\
                                     <button type="button" class="btn bg-primary sidenav_zero_index proAttributeAddBtn btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#proAttributeAddModal" style="height:32px"> <i class="fa-solid fa-plus text-white"></i>\
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

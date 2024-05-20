@extends('dashboard/nav_footer')
@section('page_header_links')
    <link rel="stylesheet" href="{{ asset('dashboard_assets/product/css/proCategory.css') }}">
@endSection
@section('body_content')
    <div class="row">
        <div class="col-md-12 ">

            <!-- Button trigger modal -->
            <!-- Button trigger modal -->


            <!-- Modal -->
            <div class="modal fade" id="proCategoryDeleteConfirm" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form id="delete_form">
                            <input type="hidden" name="proCategoryId" id="proCategoryId">
                        </form>
                        <!-- <div class="modal-header border-0">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div> -->
                        <div class="modal-body">
                            Are You sure to delete this Product Category ?

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                            <button type="button" class="btn btn-primary proCategoryDeleteConfirmBtn"
                                data-bs-dismiss="modal">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- add proCategory start  -->
            <div class="modal fade" id="proCategoryAddModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header vacancy_modal_header">
                            <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Add Product Category</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-0">
                            <!-- content start   -->
                            <div class="container-fluid create_user_main p-0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form role="form" action="" method="post" id="proCategoryForm">
                                            @csrf
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <!-- holiday name -->
                                                    <div class="mb-3 col-md-6">
                                                        <label for="category_name">Category Name</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Category Name " aria-label="Category Name"
                                                            name="category_name" id="category_name">
                                                    </div>

                                                    <!-- start date -->
                                                    <div class="mb-3 col-md-6">
                                                        <label for="description">Description</label>
                                                        <textarea name="description" cols="" rows="1" id="description" placeholder="Internal Notes"
                                                            class="form-control"></textarea>
                                                    </div>


                                                    <!-- end_date -->
                                                    <div class="mb-3 col-md-6">
                                                        <label for="parent">Sub Category of</label>
                                                        <select name="parent" id="parent" class="form-select parent">
                                                            <option></option>
                                                            @foreach ($parentCategories as $parentCategory)
                                                                <option value="{{ $parentCategory->category_id }}">
                                                                    {{ $parentCategory->category_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3 col-md-12 form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="active"
                                                            name="active">
                                                        <label class="form-check-label" for="active">Active</label>

                                                    </div>
                                                    <div class="text-center col-md-12 m-auto">
                                                        <button type="submit" id="proCategoryAddBtn"
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
            <div class="modal fade" id="proCategoryUpdateModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header vacancy_modal_header">
                            <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Update Product Category</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-0">
                            <!-- content start   -->
                            <div class="container-fluid create_user_main p-0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form role="form" action="" method="post" id="proCategoryUpdateForm">
                                            <input type="hidden" name="category_id" id="category_id" value="">
                                            @csrf
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <!-- category name -->
                                                    <div class="mb-3 col-md-6">
                                                        <label for="category_name">Category Name</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Category Name " aria-label="Category Name"
                                                            name="category_name" id="category_name">
                                                    </div>

                                                    <!-- description date -->
                                                    <div class="mb-3 col-md-6">
                                                        <label for="description">Description</label>
                                                        <textarea name="description" cols="" rows="1" id="description" placeholder="Internal Notes"
                                                            class="form-control"></textarea>
                                                    </div>
                                                    <!-- parent -->
                                                    <div class="mb-3 col-md-6">
                                                        <label for="parent">Sub Category of</label>
                                                        <select name="parent" id="parent_one" class="form-select parent">
                                                            <option value="0">Select Category</option>
                                                            @foreach ($parentCategories as $parentCategory)
                                                                <option value="{{ $parentCategory->category_id }}">
                                                                    {{ $parentCategory->category_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    {{-- is active --}}

                                                    <div class="mb-3 col-md-12 form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="active"
                                                            name="active">
                                                        <label class="form-check-label" for="active">Active</label>

                                                    </div>

                                                    {{-- button --}}
                                                    <div class="text-center col-md-12 m-auto">
                                                        <button type="submit" id="proCategoryUpdateBtn"
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
                        <table class="table align-items-center mb-0  hover" id="proCategoryTable" style="width: 100%;">

                            <!-- show message when proCategory   added  start  -->
                            <div class="mb-3 col-md-12">
                                <div class="alert alert-success  d-none text-white proCategoryAddedMsg user_updated_msg"
                                    role="alert">
                                    Product Category added
                                    <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                </div>
                            </div>
                            <!-- show message when proCategory   added  start  -->
                            <!-- show message when proCategory    updated  start  -->
                            <div class="mb-3 col-md-12">
                                <div class="alert alert-success  d-none text-white proCategoryUpdatedMsg user_updated_msg"
                                    role="alert">
                                    Product Category updated
                                    <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                </div>
                            </div>
                            <!-- show message when proCategory    updated  start  -->
                            <!-- show message when proCategory    deleted start  -->
                            <div class="mb-3 col-md-12">
                                <div class="alert alert-success  d-none text-white proCategoryDeletedMsg user_updated_msg"
                                    role="alert">
                                    Product Category deleted
                                    <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                </div>
                            </div>
                            <!-- show message when job vacancy   deleted  start  -->
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">S no</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Category Name
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Description</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Child Category
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Active</th>
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
            // $("#proCategoryUpdateForm #parent_one").select2({
            //     placeholder: "Select Category",
            //     allowClear: true,
            //     width: "100%",
            // });

            // hide select error when the field is selected start 
            $('#proCategoryUpdateForm #parent').on('change', function(param) {
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
            $("#proCategoryForm").validate({
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
                        url: base_url + "proCategory",
                        data: $(form).serialize(),
                        dataType: "json",
                        success: function(response) {
                            if (response) {
                                $("#proCategoryForm").trigger("reset");
                                $("#proCategoryTable").DataTable().ajax.reload();
                                $("#proCategoryAddModal").modal("toggle");
                                $(".proCategoryAddedMsg").removeClass("d-none");
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

                $("#proCategoryTable").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: base_url + "proCategoryGetData",
                    columns: [{
                            data: "DT_RowIndex",
                            name: "DT_RowIndex"
                        },
                        {
                            data: "category_name",
                            name: "category_name"
                        },
                        {
                            data: "description",
                            name: "description"
                        },
                        {
                            data: "child_category",
                            name: "child_category"
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
            $(document).on("click", ".proCategoryDeleteBtn", function(param) {
                $('#proCategoryId').val($(this).data("pro_category_id"))   ;
                $(".proCategoryDeleteConfirmBtn").on("click", function() {
                    $.ajax({
                        type: "post",
                        url: base_url + "proCategoryDelete",
                        data: $('#delete_form').serialize(),
                        dataType: "json",
                        success: function(response) {
                            if (response) {
                                $("#proCategoryTable").DataTable().ajax.reload();
                                $(".proCategoryDeletedMsg").removeClass("d-none");
                            }
                        },
                    });
                });
            });
            // delete user end
            // update employee leave  start
            $(document).on("click", ".proCategoryEditBtn", function(param) {
                let proCategoryId = $(this).data("pro_category_id");
                $.ajax({
                    type: "post",
                    url: base_url + "proCategoryFetch",
                    data: {
                        proCategoryId: proCategoryId
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response) {
                            $("#proCategoryUpdateForm")
                                .find("#category_id")
                                .val(response.category_id);
                            $("#proCategoryUpdateForm")
                                .find("#category_name")
                                .val(response.category_name);
                            $("#proCategoryUpdateForm")
                                .find("#description")
                                .val(response.description);
                                
                            $("#proCategoryUpdateForm")
                                .find("#parent_one")
                                .val(response.parent);

                            if (response.active == 1) {
                                $("#proCategoryUpdateForm")
                                    .find("#active").prop('checked', true)

                            } else {
                                $("#proCategoryUpdateForm")
                                    .find("#active").prop('checked', false)

                            }

                        }
                    },
                });
            });

            $("#proCategoryUpdateForm").validate({
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
                        url: base_url + "proCategoryUpdate",
                        data: $(form).serialize(),
                        dataType: "json",
                        success: function(response) {
                            if (response) {
                                $("#proCategoryTable").DataTable().ajax.reload();
                                $(".proCategoryUpdatedMsg").removeClass("d-none");
                                $("#proCategoryUpdateForm").trigger("reset");
                                $('#proCategoryUpdateModal').modal("toggle")
                            }
                        },
                    });
                },
            });
            // update employee leave  end

            // add  button to data table to add job vacancy start
            // adding button to the create user datatable to add user start
            setTimeout(() => {
                $(document).find("#proCategoryTable_filter").append(
                    '<span class="add_user_div" ">\
                                     <button type="button" class="btn bg-primary sidenav_zero_index proCategoryAddBtn btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#proCategoryAddModal" style="height:32px"> <i class="fa-solid fa-plus text-white"></i>\
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

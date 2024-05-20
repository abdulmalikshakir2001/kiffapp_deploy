@extends('dashboard/nav_footer')
@section('page_header_links')
    <link rel="stylesheet" href="{{ asset('dashboard_assets/product/css/proAttributeValue.css') }}">
@endSection
@section('body_content')
    <div class="row">
        <div class="col-md-12 ">

            <!-- Button trigger modal -->
            <!-- Button trigger modal -->


            <!-- Modal -->
            <div class="modal fade" id="proAttributeValueDeleteConfirm" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form id="delete_form">
                            <input type="hidden" name="proAttributeValueId" id="proAttributeValueId">
                        </form>
                        <!-- <div class="modal-header border-0">
                            <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div> -->
                        <div class="modal-body">
                            Are You sure to delete this Product Attribute Value ?

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                            <button type="button" class="btn btn-primary proAttributeValueDeleteConfirmBtn"
                                data-bs-dismiss="modal">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- add proAttributeValue start  -->
            <div class="modal fade" id="proAttributeValueAddModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header vacancy_modal_header">
                            <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Add Product Attribute Value</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-0">
                            <!-- content start   -->
                            <div class="container-fluid create_user_main p-0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form role="form" action="" method="post" id="proAttributeValueForm">
                                            @csrf
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <!-- holiday name -->
                                                    <div class="mb-3 col-md-6">
                                                        <label for="name">Attribute Value Name</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Attribute Value Name "
                                                            aria-label="Attribute Value Name" name="name" id="name">
                                                    </div>


                                                    {{-- attribute id --}}

                                                    <div class="col-md-6">
                                                        <label for="attribute_id"> Attribute Name </label>
                                                        <select name="attribute_id" id="attribute_id"
                                                            class="form-select attribute_id">
                                                            <option></option>
                                                            @foreach ($attributes as $attribute)
                                                                <option value="{{ $attribute->attribute_id }}">
                                                                    {{ $attribute->name }}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>

                                                    <!-- start date -->
                                                    <div class="mb-3 col-md-6">
                                                        <label for="description">Description</label>
                                                        <textarea name="description" cols="" rows="1" id="description" placeholder="Description"
                                                            class="form-control"></textarea>
                                                    </div>

                                                    <div class="mb-3 col-md-12 form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="active"
                                                            name="active">
                                                        <label class="form-check-label" for="active">Active</label>

                                                    </div>


                                                    <div class="text-center col-md-12 m-auto">
                                                        <button type="submit" id="proAttributeValueAddBtn"
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
            <div class="modal fade" id="proAttributeValueUpdateModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header vacancy_modal_header">
                            <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Update Product Attribute Value
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-0">
                            <!-- content start   -->
                            <div class="container-fluid create_user_main p-0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form role="form" action="" method="post"
                                            id="proAttributeValueUpdateForm">
                                            <input type="hidden" name="attribute_value_id" id="attribute_value_id"
                                                value="">
                                            @csrf
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <!-- category name -->
                                                    <div class="mb-3 col-md-6">
                                                        <label for="name">Attribute Value Name</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Attribute Value Name "
                                                            aria-label="Attribute Value Name" name="name"
                                                            id="name">
                                                    </div>

                                                    {{-- attribute id --}}

                                                    <div class="col-md-6">
                                                        <label for="attribute_id"> Attribute Name </label>
                                                        <select name="attribute_id" id="attribute_id"
                                                            class="form-select attribute_id">
                                                            <option value="" selected>Select Attribute </option>
                                                            @foreach ($attributes as $attribute)
                                                                <option value="{{ $attribute->attribute_id }}">
                                                                    {{ $attribute->name }}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>


                                                    <!-- description date -->
                                                    <div class="mb-3 col-md-6">
                                                        <label for="description">Description</label>
                                                        <textarea name="description" cols="" rows="1" id="description" placeholder="Description"
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
                                                        <button type="submit" id="proAttributeValueUpdateBtn"
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
                        <table class="table align-items-center mb-0  hover" id="proAttributeValueTable"
                            style="width: 100%;">

                            <!-- show message when proAttributeValue   added  start  -->
                            <div class="mb-3 col-md-12">
                                <div class="alert alert-success  d-none text-white proAttributeValueAddedMsg user_updated_msg"
                                    role="alert">
                                    Product Attribute Value added
                                    <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                </div>
                            </div>
                            <!-- show message when proAttributeValue   added  start  -->
                            <!-- show message when proAttributeValue    updated  start  -->
                            <div class="mb-3 col-md-12">
                                <div class="alert alert-success  d-none text-white proAttributeValueUpdatedMsg user_updated_msg"
                                    role="alert">
                                    Product Attribute Value updated
                                    <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                </div>
                            </div>
                            <!-- show message when proAttributeValue    updated  start  -->
                            <!-- show message when proAttributeValue    deleted start  -->
                            <div class="mb-3 col-md-12">
                                <div class="alert alert-success  d-none text-white proAttributeValueDeletedMsg user_updated_msg"
                                    role="alert">
                                    Product Attribute Value deleted
                                    <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                </div>
                            </div>
                            <!-- show message when job vacancy   deleted  start  -->
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">S no</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Attribute Value
                                        Name
                                    </th>
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
            $("#attribute_id").select2({
                placeholder: "Select Attribute",
                allowClear: true,
                width: "100%",
            });
            // $("#proAttributeValueUpdateForm #attribute_id").select2({
            //     placeholder: "Select Category",
            //     allowClear: true,
            //     width: "100%",
            // });

            // hide select error when the field is selected start 
            $('#attribute_id').on('change', function(param) {
                let attribute_idValue = $(this).val();
                if (attribute_idValue == "") {
                    $('#attribute_id-error').removeClass('d-none') // label
                } else {
                    $('#attribute_id-error').addClass('d-none') // label
                }
            })
            $('#proAttributeValueUpdateForm #attribute_id').on('change', function(param) {
                let attribute_idValue = $(this).val();
                if (attribute_idValue == "") {
                    $('#attribute_id-error').removeClass('d-none') // label
                } else {
                    $('#attribute_id-error').addClass('d-none') // label
                }
            })

            // tiny mce start
            @php
                $baseUrl = config('app.url');
                echo "var base_url = '" . $baseUrl . "';";
            @endphp

            // add job vacancies  start
            $("#proAttributeValueForm").validate({
                rules: {
                    name: {
                        required: true,
                    },
                    attribute_id: {
                        required: true
                    }
                },
                messages: {
                    name: {
                        required: "Attribute Value required",
                    },
                    attribute_id: {
                        required: 'Attribue required'
                    }
                },
                submitHandler: function(form) {
                    $.ajax({
                        type: "post",
                        url: base_url + "proAttributeValue",
                        data: $(form).serialize(),
                        dataType: "json",
                        success: function(response) {
                            if (response) {
                                $("#proAttributeValueForm").trigger("reset");
                                $("#proAttributeValueTable").DataTable().ajax.reload();
                                $("#proAttributeValueAddModal").modal("toggle");
                                $(".proAttributeValueAddedMsg").removeClass("d-none");
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

                $("#proAttributeValueTable").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: base_url + "proAttributeValueGetData",
                    columns: [{
                            data: "DT_RowIndex",
                            name: "DT_RowIndex"
                        },
                        {
                            data: "name",
                            name: "name"
                        },
                        {
                            data: "attribute_name",
                            name: "attribute_name"
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
            $(document).on("click", ".proAttributeValueDeleteBtn", function(param) {
                $('#proAttributeValueId').val($(this).data("pro_attribute_value_id"))   ;
                $(".proAttributeValueDeleteConfirmBtn").on("click", function() {
                    $.ajax({
                        type: "post",
                        url: base_url + "proAttributeValueDelete",
                        data: $('#delete_form').serialize(),
                        dataType: "json",
                        success: function(response) {
                            if (response) {
                                $("#proAttributeValueTable").DataTable().ajax.reload();
                                $(".proAttributeValueDeletedMsg").removeClass("d-none");
                            }
                        },
                    });
                });
            });
            // delete user end
            // update employee leave  start
            $(document).on("click", ".proAttributeValueEditBtn", function(param) {
                let proAttributeValueId = $(this).data("pro_attribute_value_id");
                $.ajax({
                    type: "post",
                    url: base_url + "proAttributeValueFetch",
                    data: {
                        proAttributeValueId: proAttributeValueId
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response) {
                            $("#proAttributeValueUpdateForm")
                                .find("#attribute_value_id")
                                .val(response.attribute_value_id);
                            $("#proAttributeValueUpdateForm")
                                .find("#name")
                                .val(response.name);
                            $("#proAttributeValueUpdateForm")
                                .find("#attribute_id")
                                .val(response.attribute_id);
                            $("#proAttributeValueUpdateForm")
                                .find("#description")
                                .val(response.description);

                            if (response.active == 1) {
                                $("#proAttributeValueUpdateForm")
                                    .find("#active").prop('checked', true)

                            } else {
                                $("#proAttributeValueUpdateForm")
                                    .find("#active").prop('checked', false)

                            }

                        }
                    },
                });
            });

            $("#proAttributeValueUpdateForm").validate({
                rules: {
                    name: {
                        required: true,
                    },
                    attribute_id: {
                        required: true
                    }


                },
                messages: {
                    name: {
                        required: "Attribute value required",
                    },
                    attribute_id: {
                        required: 'Attribue required'
                    }

                },
                submitHandler: function(form) {
                    $.ajax({
                        type: "post",
                        url: base_url + "proAttributeValueUpdate",
                        data: $(form).serialize(),
                        dataType: "json",
                        success: function(response) {
                            if (response) {
                                $("#proAttributeValueTable").DataTable().ajax.reload();
                                $(".proAttributeValueUpdatedMsg").removeClass("d-none");
                                $("#proAttributeValueUpdateForm").trigger("reset");
                                $('#proAttributeValueUpdateModal').modal("toggle")
                            }
                        },
                    });
                },
            });
            // update employee leave  end

            // add  button to data table to add job vacancy start
            // adding button to the create user datatable to add user start
            setTimeout(() => {
                $(document).find("#proAttributeValueTable_filter").append(
                    '<span class="add_user_div" ">\
                                             <button type="button" class="btn bg-primary sidenav_zero_index proAttributeValueAddBtn btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#proAttributeValueAddModal" style="height:32px"> <i class="fa-solid fa-plus text-white"></i>\
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

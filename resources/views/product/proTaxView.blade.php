@extends('dashboard/nav_footer')
@section('page_header_links')
    <link rel="stylesheet" href="{{ asset('dashboard_assets/product/css/proTax.css') }}">
@endSection
@section('body_content')
    <div class="row">
        <div class="col-md-12 ">

            <!-- Button trigger modal -->
            <!-- Button trigger modal -->


            <!-- Modal -->
            <div class="modal fade" id="proTaxDeleteConfirm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form id="delete_form">
                            <input type="hidden" name="proTaxId" id="proTaxId">
                        </form>
                        <!-- <div class="modal-header border-0">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div> -->
                        <div class="modal-body">
                            Are You sure to delete this Product Tax ?

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                            <button type="button" class="btn btn-primary proTaxDeleteConfirmBtn"
                                data-bs-dismiss="modal">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- add proTax start  -->
            <div class="modal fade" id="proTaxAddModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header vacancy_modal_header">
                            <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Add Product Tax</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-0">
                            <!-- content start   -->
                            <div class="container-fluid create_user_main p-0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form role="form" action="" method="post" id="proTaxForm">
                                            @csrf
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <!-- holiday name -->
                                                    <div class="mb-3 col-md-6">
                                                        <label for="tax_name">Tax Name</label>
                                                        <input type="text" class="form-control" placeholder="Tax Name "
                                                            aria-label="Tax Name" name="tax_name" id="tax_name">
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label for="percentage">Percentage</label>
                                                        <input type="text" class="form-control" placeholder="Percentage"
                                                            aria-label="Percentage" name="percentage" id="percentage">
                                                    </div>

                                                    <!-- start date -->
                                                    <div class="mb-3 col-md-6">
                                                        <label for="description">Description</label>
                                                        <textarea name="description" cols="" rows="1" id="description" placeholder="Description"
                                                            class="form-control"></textarea>
                                                    </div>

                                                    <div class="mb-3 col-md-6">
                                                        <label for="rules">Rules</label>
                                                        <input type="text" class="form-control" placeholder="Rules "
                                                            aria-label="Rules" name="rules" id="rules">
                                                    </div>

                                                    <div class="mb-3 col-md-12 form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="active"
                                                            name="active">
                                                        <label class="form-check-label" for="active">Active</label>

                                                    </div>


                                                    <div class="text-center col-md-12 m-auto">
                                                        <button type="submit" id="proTaxAddBtn"
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
            <div class="modal fade" id="proTaxUpdateModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header vacancy_modal_header">
                            <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Update Product Tax</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-0">
                            <!-- content start   -->
                            <div class="container-fluid create_user_main p-0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form role="form" action="" method="post" id="proTaxUpdateForm">
                                            <input type="hidden" name="tax_id" id="tax_id" value="">
                                            @csrf
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <!-- holiday name -->
                                                    <div class="mb-3 col-md-6">
                                                        <label for="tax_name">Tax Name</label>
                                                        <input type="text" class="form-control" placeholder="Tax Name "
                                                            aria-label="Tax Name" name="tax_name" id="tax_name">
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label for="percentage">Percentage</label>
                                                        <input type="text" class="form-control" placeholder="Percentage "
                                                            aria-label="Percentage" name="percentage" id="percentage">
                                                    </div>

                                                    <!-- start date -->
                                                    <div class="mb-3 col-md-6">
                                                        <label for="description">Description</label>
                                                        <textarea name="description" cols="" rows="1" id="description" placeholder="Description"
                                                            class="form-control"></textarea>
                                                    </div>

                                                    <div class="mb-3 col-md-6">
                                                        <label for="rules">Rules</label>
                                                        <input type="text" class="form-control" placeholder="Rules "
                                                            aria-label="Rules" name="rules" id="rules">
                                                    </div>

                                                    <div class="mb-3 col-md-12 form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="active"
                                                            name="active">
                                                        <label class="form-check-label" for="active">Active</label>

                                                    </div>


                                                    {{-- button --}}
                                                    <div class="text-center col-md-12 m-auto">
                                                        <button type="submit" id="proTaxUpdateBtn"
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
                        <table class="table align-items-center mb-0  hover" id="proTaxTable" style="width: 100%;">

                            <!-- show message when proTax   added  start  -->
                            <div class="mb-3 col-md-12">
                                <div class="alert alert-success  d-none text-white proTaxAddedMsg user_updated_msg"
                                    role="alert">
                                    Product Tax added
                                    <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                </div>
                            </div>
                            <!-- show message when proTax   added  start  -->
                            <!-- show message when proTax    updated  start  -->
                            <div class="mb-3 col-md-12">
                                <div class="alert alert-success  d-none text-white proTaxUpdatedMsg user_updated_msg"
                                    role="alert">
                                    Product Tax updated
                                    <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                </div>
                            </div>
                            <!-- show message when proTax    updated  start  -->
                            <!-- show message when proTax    deleted start  -->
                            <div class="mb-3 col-md-12">
                                <div class="alert alert-success  d-none text-white proTaxDeletedMsg user_updated_msg"
                                    role="alert">
                                    Product Tax deleted
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
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Percentage</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Rules</th>
                              
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
            $("#proTaxUpdateForm #parent").select2({
                placeholder: "Select Category",
                allowClear: true,
                width: "100%",
            });

            // hide select error when the field is selected start 
            $('#proTaxUpdateForm #parent').on('change', function(param) {
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
            $("#proTaxForm").validate({
                rules: {
                    tax_name: {
                        required: true,
                    },
                    percentage:{
                        required:true,
                        number:true
                    }
                },
                messages: {
                    tax_name: {
                        required: "Tax Name required",
                    },
                    percentage:{
                        required:'Percentage required',
                        number:"Only Numbers are allowed"
                    }
                },
                submitHandler: function(form) {
                    $.ajax({
                        type: "post",
                        url: base_url + "proTax",
                        data: $(form).serialize(),
                        dataType: "json",
                        success: function(response) {
                            if (response) {
                                $("#proTaxForm").trigger("reset");
                                $("#proTaxTable").DataTable().ajax.reload();
                                $("#proTaxAddModal").modal("toggle");
                                $(".proTaxAddedMsg").removeClass("d-none");
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

                $("#proTaxTable").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: base_url + "proTaxGetData",
                    columns: [{
                            data: "DT_RowIndex",
                            name: "DT_RowIndex"
                        },
                        {
                            data: "tax_name",
                            name: "tax_name"
                        },
                        {
                            data: "description",
                            name: "description"
                        },
                        {
                            data: "percentage",
                            name: "percentage"
                        },
                        {
                            data: "rules",
                            name: "rules"
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
            $(document).on("click", ".proTaxDeleteBtn", function(param) {
                $('#proTaxId').val($(this).data("pro_tax_id"))   ;
                $(".proTaxDeleteConfirmBtn").on("click", function() {
                    $.ajax({
                        type: "post",
                        url: base_url + "proTaxDelete",
                        data: $('#delete_form').serialize(),
                        dataType: "json",
                        success: function(response) {
                            if (response) {
                                $("#proTaxTable").DataTable().ajax.reload();
                                $(".proTaxDeletedMsg").removeClass("d-none");
                            }
                        },
                    });
                });
            });
            // delete user end
            // update employee leave  start
            $(document).on("click", ".proTaxEditBtn", function(param) {
                let proTaxId = $(this).data("pro_tax_id");
                $.ajax({
                    type: "post",
                    url: base_url + "proTaxFetch",
                    data: {
                        proTaxId: proTaxId
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response) {
                            $("#proTaxUpdateForm")
                                .find("#tax_id")
                                .val(response.tax_id);
                            $("#proTaxUpdateForm")
                                .find("#tax_name")
                                .val(response.tax_name);
                            $("#proTaxUpdateForm")
                                .find("#description")
                                .val(response.description);
                            $("#proTaxUpdateForm")
                                .find("#percentage")
                                .val(response.percentage);
                            $("#proTaxUpdateForm")
                                .find("#rules")
                                .val(response.rules);

                            if (response.active == 1) {
                                $("#proTaxUpdateForm")
                                    .find("#active").prop('checked', true)

                            } else {
                                $("#proTaxUpdateForm")
                                    .find("#active").prop('checked', false)

                            }

                        }
                    },
                });
            });

            $("#proTaxUpdateForm").validate({
                rules: {
                    tax_name: {
                        required: true,
                    },
                    percentage:{
                        required:true,
                        number:true
                    }
                },
                messages: {
                    tax_name: {
                        required: "Tax Name required",
                    },
                    percentage:{
                        required:'Percentage required',
                        number:"Only Numbers are allowed"
                    }
                },
                submitHandler: function(form) {
                    $.ajax({
                        type: "post",
                        url: base_url + "proTaxUpdate",
                        data: $(form).serialize(),
                        dataType: "json",
                        success: function(response) {
                            if (response) {
                                $("#proTaxTable").DataTable().ajax.reload();
                                $(".proTaxUpdatedMsg").removeClass("d-none");
                                $("#proTaxUpdateForm").trigger("reset");
                                $('#proTaxUpdateModal').modal("toggle")
                            }
                        },
                    });
                },
            });
            // update employee leave  end

            // add  button to data table to add job vacancy start
            // adding button to the create user datatable to add user start
            setTimeout(() => {
                $(document).find("#proTaxTable_filter").append(
                    '<span class="add_user_div" ">\
                                     <button type="button" class="btn bg-primary sidenav_zero_index proTaxAddBtn btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#proTaxAddModal" style="height:32px"> <i class="fa-solid fa-plus text-white"></i>\
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

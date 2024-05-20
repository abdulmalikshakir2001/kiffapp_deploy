
@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{ asset('dashboard_assets/purchase/css/pur_warehouse_stock.css') }}">
@endSection
@section('body_content')
<div class="row">
    <div class="col-md-12 ">

        <!-- Button trigger modal -->
        <!-- Button trigger modal -->


        <!-- >odal -->
        <div class="modal fade" id="pur_warehouse_stock_delete_confirm" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form id="delete_form">
                        <input type="hidden" name="purWarehouseStockId" id="purWarehouseStockId">
                    </form>
                    <!-- <div class="modal-header border-0">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div> -->
                    <div class="modal-body">
                        Are You sure to delete this Warehouse Stock ?

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="button" class="btn btn-primary pur_warehouse_stock_delete_confirm_btn"
                            data-bs-dismiss="modal">Confirm</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- add pur_warehouse_stock start  -->
        <div class="modal fade" id="pur_warehouse_stock_add_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header vacancy_modal_header">
                        <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Add Warehouse Stock</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        <!-- content start   -->
                        <div class="container-fluid create_user_main p-0">
                            <div class="row">
                                <div class="col-md-12">
                                    <form role="form" action="" method="post" id="pur_warehouse_stock_add_form">
                                        @csrf
                                        <div class="container-fluid">
                                            <div class="row">
                                                <!-- Stock quantity -->
                                                <div class="mb-3 col-md-6">
                                                    <label for="stock_qty">Stock Quantity</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Stock Quantity " aria-label="Stock Quantity"
                                                        name="stock_qty" id="stock_qty">
                                                </div>

                                                

                                                {{-- warehouse  --}}
                                        <div class="col-md-6">
                                            <label for="warehouse_id"> Select Warehouse </label>
                                            <select name="warehouse_id" id="warehouse_id" class="form-select warehouse_id">
                                                <option></option>
                                                @foreach ($warehouses as $warehouse)
                                                <option value="{{ $warehouse->warehouse_id }}">
                                                    {{ $warehouse->warehouse_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>

                                                {{-- product  --}}
                                        <div class="col-md-6">
                                            <label for="product_id"> Select Warehouse </label>
                                            <select name="product_id" id="product_id" class="form-select product_id">
                                                <option></option>
                                                @foreach ($products as $product)
                                                <option value="{{ $product->product_id }}">
                                                    {{ $product->product_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>





                                                <div class="text-center col-md-12 m-auto">
                                                    <button type="submit" id="pur_warehouse_stock_add_btn"
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
        <div class="modal fade" id="pur_warehouse_stock_update_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header vacancy_modal_header">
                        <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Update Warehouse</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        <!-- content start   -->
                        <div class="container-fluid create_user_main p-0">
                            <div class="row">
                                <div class="col-md-12">
                                    <form role="form" action="" method="post" id="pur_warehouse_stock_update_form">
                                        @csrf
                                        <div class="container-fluid">
                                            <div class="row">
                                                <input type="hidden" id="warehouse_stock_id" name="warehouse_stock_id" >
                                                <!-- Stock quantity -->
                                                <div class="mb-3 col-md-6">
                                                    <label for="stock_qty">Stock Quantity</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Stock Quantity " aria-label="Stock Quantity"
                                                        name="stock_qty" id="stock_qty">
                                                </div>

                                                

                                                {{-- warehouse  --}}
                                        <div class="col-md-6">
                                            <label for="warehouse_id_update"> Select Warehouse </label>
                                            <select name="warehouse_id_update" id="warehouse_id_update" class="form-select warehouse_id_update">
                                                <option></option>
                                                @foreach ($warehouses as $warehouse)
                                                <option value="{{ $warehouse->warehouse_id }}">
                                                    {{ $warehouse->warehouse_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>

                                                {{-- product  --}}
                                        <div class="col-md-6">
                                            <label for="product_id_update"> Select Warehouse </label>
                                            <select name="product_id_update" id="product_id_update" class="form-select product_id_update">
                                                <option></option>
                                                @foreach ($products as $product)
                                                <option value="{{ $product->product_id }}">
                                                    {{ $product->product_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>





                                                <div class="text-center col-md-12 m-auto">
                                                    <button type="submit" id="pur_warehouse_stock_update_btn"
                                                        class="btn bg-primary w-100 my-4 mb-2 text-white">update</button>
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
                    <table class="table align-items-center mb-0  hover" id="pur_warehouse_stock_table" style="width: 100%;">

                        <!-- show message when pur_warehouse_stock   added  start  -->
                        <div class="mb-3 col-md-12">
                            <div class="alert alert-success  d-none text-white pur_warehouse_stock_added_msg user_updated_msg"
                                role="alert">
                                Warehouse Stock added
                                <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                            </div>
                        </div>
                        <!-- show message when pur_warehouse_stock   added  start  -->
                        <!-- show message when pur_warehouse_stock    updated  start  -->
                        <div class="mb-3 col-md-12">
                            <div class="alert alert-success  d-none text-white pur_warehouse_stock_updated_msg user_updated_msg"
                                role="alert">
                                Warehouse Stock updated
                                <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                            </div>
                        </div>
                        <!-- show message when pur_warehouse_stock    updated  start  -->
                        <!-- show message when pur_warehouse_stock    deleted start  -->
                        <div class="mb-3 col-md-12">
                            <div class="alert alert-success  d-none text-white pur_warehouse_stock_deleted_msg user_updated_msg"
                                role="alert">
                                Warehouse Stock deleted
                                <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                            </div>
                        </div>
                        <!-- show message when job vacancy   deleted  start  -->
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">S no</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Warehouse Name
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">product Name</th>

                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Stock Qty
                                </th>
                                
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Address
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
        function defaultSelect2(selectDropDown) { // pass selected element
            $(selectDropDown).val("").change();
            $(selectDropDown).prop('disabled', false)
            $(selectDropDown).find('option').each((key, value) => {
                $(value).prop('selected', false)
            })

        }
        // parse html entities start
    function html_decode(input) {
            let parser = new DOMParser().parseFromString(input, "text/html");
            return parser.documentElement.textContent;
        }
        // parse html entities end


        // parent
        $("#warehouse_id").select2({
            placeholder: "Select Warehouse",
            allowClear: true,
            width: "100%",
        });
        $("#product_id").select2({
            placeholder: "Select Product",
            allowClear: true,
            width: "100%",
        });

        // hide select error when the field is selected start 
        $('#warehouse_id').on('change', function (param) {
            let warehouse_idValue = $(this).val();
            if (warehouse_idValue == "") {
                $('#warehouse_id-error').removeClass('d-none') // label
            } else {
                $('#warehouse_id-error').addClass('d-none') // label
            }
        })
        $('#product_id').on('change', function (param) {
            let product_idValue = $(this).val();
            if (product_idValue == "") {
                $('#product_id-error').removeClass('d-none') // label
            } else {
                $('#product_id-error').addClass('d-none') // label
            }
        })
        // parent
        $("#warehouse_id_update").select2({
            placeholder: "Select Warehouse",
            allowClear: true,
            width: "100%",
        });
        $("#product_id_update").select2({
            placeholder: "Select Product",
            allowClear: true,
            width: "100%",
        });

        // hide select error when the field is selected start 
        $('#warehouse_id_update').on('change', function (param) {
            let warehouse_id_updateValue = $(this).val();
            if (warehouse_id_updateValue == "") {
                $('#warehouse_id_update-error').removeClass('d-none') // label
            } else {
                $('#warehouse_id_update-error').addClass('d-none') // label
            }
        })
        $('#product_id_update').on('change', function (param) {
            let product_id_updateValue = $(this).val();
            if (product_id_updateValue == "") {
                $('#product_id_update-error').removeClass('d-none') // label
            } else {
                $('#product_id_update-error').addClass('d-none') // label
            }
        })

        // tiny mce start
        @php
        $baseUrl = config('app.url');
                echo "var base_url = '".$baseUrl. "';";
        @endphp

        // add job vacancies  start
        $("#pur_warehouse_stock_add_form").validate({
            rules: {
                warehouse_id: {
                    required: true,
                },
                product_id: {
                    required: true,
                },
                stock_qty: {
                    required: true,
                },
                
                
            },
            messages: {
                warehouse_id: {
                    required: "Warehouse Name required",
                },
                product_id: {
                    required: "Product required",
                },
                stock_qty: {
                    required: "Enter stock quantity",
                },
                
            },
            submitHandler: function (form) {
                $.ajax({
                    type: "post",
                    url: base_url + "pur_warehouse_stock",
                    data: $(form).serialize(),
                    dataType: "json",
                    success: function (response) {
                        if (response) {
                            $("#pur_warehouse_stock_add_form").trigger("reset");
                            $("#pur_warehouse_stock_table").DataTable().ajax.reload();
                            $("#pur_warehouse_stock_add_modal").modal("toggle");
                            $(".pur_warehouse_stock_added_msg").removeClass("d-none");
                            defaultSelect2($('#warehouse_id'))
                            defaultSelect2($('#product_id'))
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

            $("#pur_warehouse_stock_table").DataTable({
                processing: true,
                serverSide: true,
                ajax: base_url + "pur_warehouse_stock_get_data",
                columns: [{
                    data: "DT_RowIndex",
                    name: "DT_RowIndex"
                },
                {
                    data: "warehouse_name",
                    name: "warehouse_name"
                },
                {
                    data: "product_name",
                    name: "product_name"
                },

                {
                    data: "stock_qty",
                    name: "stock_qty"
                },
                {
                    data: "address",
                    name: "address"
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
        $(document).on("click", ".pur_warehouse_stock_delete_btn", function (param) {
             $('#purWarehouseStockId').val($(this).data("pur_warehouse_stock_id"))  ;
            $(".pur_warehouse_stock_delete_confirm_btn").on("click", function () {
                $.ajax({
                    type: "post",
                    url: base_url + "pur_warehouse_stock_delete",
                    data: $('#delete_form').serialize(),
                    dataType: "json",
                    success: function (response) {
                        if (response) {
                            $("#pur_warehouse_stock_table").DataTable().ajax.reload();
                            $(".pur_warehouse_stock_deleted_msg").removeClass("d-none");
                        }
                    },
                });
            });
        });
        // delete user end
        // update employee leave  start
        $(document).on("click", ".pur_warehouse_stock_edit_btn", function (param) {
            let purWarehouseStockId = $(this).data("pur_warehouse_stock_id");
            $.ajax({
                type: "post",
                url: base_url + "pur_warehouse_stock_fetch",
                data: {
                    purWarehouseStockId: purWarehouseStockId
                },
                dataType: "json",
                success: function (response) {
                    if (response) {
                        $("#pur_warehouse_stock_update_form")
                            .find("#warehouse_stock_id")
                            .val(response.warehouse_stock_id);
                        $("#pur_warehouse_stock_update_form")
                            .find("#warehouse_id_update")
                            .val(response.warehouse_id).change();
                        $("#pur_warehouse_stock_update_form")
                            .find("#product_id_update")
                            .val(response.product_id).change();
                        $("#pur_warehouse_stock_update_form")
                            .find("#stock_qty")
                            .val(response.stock_qty);
                        



                    }
                },
            });
        });

        $("#pur_warehouse_stock_update_form").validate({
            rules: {
                warehouse_id_update: {
                    required: true,
                },
                product_id_update: {
                    required: true,
                },
                stock_qty: {
                    required: true,
                },
                
                
            },
            messages: {
                warehouse_id_update: {
                    required: "Warehouse Name required",
                },
                product_id_update: {
                    required: "Product required",
                },
                stock_qty: {
                    required: "Enter stock quantity",
                },
                
            },
            submitHandler: function (form) {
                $.ajax({
                    type: "post",
                    url: base_url + "pur_warehouse_stock_update",
                    data: $(form).serialize(),
                    dataType: "json",
                    success: function (response) {
                        if (response) {
                            $("#pur_warehouse_stock_table").DataTable().ajax.reload();
                            $(".pur_warehouse_stock_updated_msg").removeClass("d-none");
                            $('#pur_warehouse_stock_update_modal').modal("toggle")
                        }
                    },
                });
            },
        });
        // update employee leave  end

        // add  button to data table to add job vacancy start
        // adding button to the create user datatable to add user start
        setTimeout(() => {
            $(document).find("#pur_warehouse_stock_table_filter").append(
                '<span class="add_user_div" ">\
                                     <button type="button" class="btn bg-primary sidenav_zero_index pur_warehouse_stock_add_btn btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#pur_warehouse_stock_add_modal" style="height:32px"> <i class="fa-solid fa-plus text-white"></i>\
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
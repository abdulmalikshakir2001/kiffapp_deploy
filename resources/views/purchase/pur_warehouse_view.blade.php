@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{ asset('dashboard_assets/purchase/css/pur_warehouse.css') }}">
@endSection
@section('body_content')
<div class="row">
    <div class="col-md-12 ">

        <!-- Button trigger modal -->
        <!-- Button trigger modal -->


        <!-- >odal -->
        <div class="modal fade" id="pur_warehouse_delete_confirm" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form id="delete_form">
                        <input type="hidden" name="purWarehouseId" id="purWarehouseId">
                    </form>
                    <!-- <div class="modal-header border-0">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div> -->
                    <div class="modal-body">
                        Are You sure to delete this Warehouse ?

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="button" class="btn btn-primary pur_warehouse_delete_confirm_btn"
                            data-bs-dismiss="modal">Confirm</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- add pur_warehouse start  -->
        <div class="modal fade" id="pur_warehouse_add_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header vacancy_modal_header">
                        <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Add Warehouse</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        <!-- content start   -->
                        <div class="container-fluid create_user_main p-0">
                            <div class="row">
                                <div class="col-md-12">
                                    <form role="form" action="" method="post" id="pur_warehouse_add_form">
                                        @csrf
                                        <div class="container-fluid">
                                            <div class="row">
                                                <!-- Warehouse name -->
                                                <div class="mb-3 col-md-6">
                                                    <label for="warehouse_name">Warehouse Name</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Warehouse Name " aria-label="Warehouse Name"
                                                        name="warehouse_name" id="warehouse_name">
                                                </div>

                                                <!-- address -->
                                                <div class="mb-3 col-md-6">
                                                    <label for="address">Address</label>
                                                    <textarea name="address" cols="" rows="1" id="address"
                                                        placeholder="Address" class="form-control"></textarea>
                                                </div>
                                                <!-- Contact Number  -->
                                                <div class="mb-3 col-md-6">
                                                    <label for="contact_number">Contact Number</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Contact Number " aria-label="Contact Number"
                                                        name="contact_number" id="contact_number">
                                                </div>
                                                <!-- city  -->

                                                <div class="mb-3 col-md-6">
                                                    <label for="city">City</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="City " aria-label="Contact Number"
                                                        name="city" id="city">
                                                </div>


                                                {{-- country --}}
                                        <div class="col-md-4">
                                            <label for="country_add"> Country </label>
                                            <select name="country_add" id="country_add" class="form-select country">
                                                <option></option>
                                                @foreach ($countries as $country)
                                                <option value="{{ $country->country }}">
                                                    {{ $country->country }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>





                                                <div class="text-center col-md-12 m-auto">
                                                    <button type="submit" id="pur_warehouse_add_btn"
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
        <div class="modal fade" id="pur_warehouse_update_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                                    <form role="form" action="" method="post" id="pur_warehouse_update_form">
                                        <input type="hidden" name="warehouse_id" id="warehouse_id" value="">
                                        @csrf
                                        <div class="container-fluid">
                                            <div class="row">
                                         <!-- Warehouse name -->
                                         <div class="mb-3 col-md-6">
                                            <label for="warehouse_name">Warehouse Name</label>
                                            <input type="text" class="form-control"
                                                placeholder="Warehouse Name " aria-label="Warehouse Name"
                                                name="warehouse_name" id="warehouse_name">
                                        </div>

                                        <!-- address -->
                                        <div class="mb-3 col-md-6">
                                            <label for="address">Address</label>
                                            <textarea name="address" cols="" rows="1" id="address"
                                                placeholder="Address" class="form-control"></textarea>
                                        </div>
                                        <!-- Contact Number  -->
                                        <div class="mb-3 col-md-6">
                                            <label for="contact_number">Contact Number</label>
                                            <input type="text" class="form-control"
                                                placeholder="Contact Number " aria-label="Contact Number"
                                                name="contact_number" id="contact_number">
                                        </div>
                                        <!-- city  -->

                                        <div class="mb-3 col-md-6">
                                            <label for="city">City</label>
                                            <input type="text" class="form-control"
                                                placeholder="Contact Number " aria-label="Contact Number"
                                                name="city" id="city">
                                        </div>


                                        {{-- country --}}
                                <div class="col-md-4">
                                    <label for="country"> Supplier Name </label>
                                    <select name="country" id="country" class="form-select country">
                                        <option></option>
                                        @foreach ($countries as $country)
                                        <option value="{{ $country->country }}">
                                            {{ $country->country }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                                {{-- button --}}
                                                <div class="text-center col-md-12 m-auto">
                                                    <button type="submit" id="pur_warehouse_update_btn"
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
                    <table class="table align-items-center mb-0  hover" id="pur_warehouse_table" style="width: 100%;">

                        <!-- show message when pur_warehouse   added  start  -->
                        <div class="mb-3 col-md-12">
                            <div class="alert alert-success  d-none text-white pur_warehouse_added_msg user_updated_msg"
                                role="alert">
                                Warehouse added
                                <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                            </div>
                        </div>
                        <!-- show message when pur_warehouse   added  start  -->
                        <!-- show message when pur_warehouse    updated  start  -->
                        <div class="mb-3 col-md-12">
                            <div class="alert alert-success  d-none text-white pur_warehouse_updated_msg user_updated_msg"
                                role="alert">
                                Warehouse updated
                                <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                            </div>
                        </div>
                        <!-- show message when pur_warehouse    updated  start  -->
                        <!-- show message when pur_warehouse    deleted start  -->
                        <div class="mb-3 col-md-12">
                            <div class="alert alert-success  d-none text-white pur_warehouse_deleted_msg user_updated_msg"
                                role="alert">
                                Warehouse deleted
                                <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                            </div>
                        </div>
                        <!-- show message when job vacancy   deleted  start  -->
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">S no</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Warehouse Name
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Address</th>

                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Contact Number
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">City</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Country</th>
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
        $("#country").select2({
            placeholder: "Select Country",
            allowClear: true,
            width: "100%",
        });
        $("#country_add").select2({
            placeholder: "Select country",
            allowClear: true,
            width: "100%",
        });

        // hide select error when the field is selected start 
        $('#country').on('change', function (param) {
            let countryValue = $(this).val();
            if (countryValue == "") {
                $('#country-error').removeClass('d-none') // label
            } else {
                $('#country-error').addClass('d-none') // label
            }
        })
        $('#country_add').on('change', function (param) {
            let countryValue = $(this).val();
            if (countryValue == "") {
                $('#country_add-error').removeClass('d-none') // label
            } else {
                $('#country_add-error').addClass('d-none') // label
            }
        })

        // tiny mce start
        @php
        $baseUrl = config('app.url');
                echo "var base_url = '".$baseUrl. "';";
        @endphp

        // add job vacancies  start
        $("#pur_warehouse_add_form").validate({
            rules: {
                warehouse_name: {
                    required: true,
                },
                contact_number: {
                    required: true,
                },
                city: {
                    required: true,
                },
                country_add: {
                    required: true,
                },
                
            },
            messages: {
                warehouse_name: {
                    required: "Warehouse Name required",
                },
                contact_number: {
                    required: "Contact Number required",
                },
                city: {
                    required: "City required",
                },
                country_add: {
                    required: "Country required",
                },
            },
            submitHandler: function (form) {
                $.ajax({
                    type: "post",
                    url: base_url + "pur_warehouse",
                    data: $(form).serialize(),
                    dataType: "json",
                    success: function (response) {
                        if (response) {
                            $("#pur_warehouse_add_form").trigger("reset");
                            $("#pur_warehouse_table").DataTable().ajax.reload();
                            $("#pur_warehouse_add_modal").modal("toggle");
                            $(".pur_warehouse_added_msg").removeClass("d-none");
                            defaultSelect2($('#country_add'))
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

            $("#pur_warehouse_table").DataTable({
                processing: true,
                serverSide: true,
                ajax: base_url + "pur_warehouse_get_data",
                columns: [{
                    data: "DT_RowIndex",
                    name: "DT_RowIndex"
                },
                {
                    data: "warehouse_name",
                    name: "warehouse_name"
                },
                {
                    data: "address",
                    name: "address"
                },

                {
                    data: "contact_number",
                    name: "contact_number"
                },
                {
                    data: "city",
                    name: "city"
                },
                {
                    data: "country",
                    name: "country"
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
        $(document).on("click", ".pur_warehouse_delete_btn", function (param) {
           $('#purWarehouseId').val($(this).data("pur_warehouse_id"))  ;
            $(".pur_warehouse_delete_confirm_btn").on("click", function () {
                $.ajax({
                    type: "post",
                    url: base_url + "pur_warehouse_delete",
                    data: $('#delete_form').serialize(),
                    dataType: "json",
                    success: function (response) {
                        if (response) {
                            $("#pur_warehouse_table").DataTable().ajax.reload();
                            $(".pur_warehouse_deleted_msg").removeClass("d-none");
                        }
                    },
                });
            });
        });
        // delete user end
        // update employee leave  start
        $(document).on("click", ".pur_warehouse_edit_btn", function (param) {
            let purWarehouseId = $(this).data("pur_warehouse_id");
            $.ajax({
                type: "post",
                url: base_url + "pur_warehouse_fetch",
                data: {
                    purWarehouseId: purWarehouseId
                },
                dataType: "json",
                success: function (response) {
                    if (response) {
                        $("#pur_warehouse_update_form")
                            .find("#warehouse_id")
                            .val(response.warehouse_id);
                        $("#pur_warehouse_update_form")
                            .find("#warehouse_name")
                            .val(response.warehouse_name);
                        $("#pur_warehouse_update_form")
                            .find("#address")
                            .val(response.address);
                        $("#pur_warehouse_update_form")
                            .find("#contact_number")
                            .val(response.contact_number);
                        $("#pur_warehouse_update_form")
                            .find("#city")
                            .val(response.city);
                        $("#pur_warehouse_update_form")
                            .find("#country")
                            .val(response.country).change();



                    }
                },
            });
        });

        $("#pur_warehouse_update_form").validate({
            rules: {
                warehouse_name: {
                    required: true,
                },
                contact_number: {
                    required: true,
                },
                city: {
                    required: true,
                },
                country: {
                    required: true,
                },
                
            },
            messages: {
                warehouse_name: {
                    required: "Warehouse Name required",
                },
                contact_number: {
                    required: "Contact Number required",
                },
                city: {
                    required: "City required",
                },
                country: {
                    required: "Country required",
                },
            },
            submitHandler: function (form) {
                $.ajax({
                    type: "post",
                    url: base_url + "pur_warehouse_update",
                    data: $(form).serialize(),
                    dataType: "json",
                    success: function (response) {
                        if (response) {
                            $("#pur_warehouse_table").DataTable().ajax.reload();
                            $(".pur_warehouse_updated_msg").removeClass("d-none");
                            $('#pur_warehouse_update_modal').modal("toggle")
                        }
                    },
                });
            },
        });
        // update employee leave  end

        // add  button to data table to add job vacancy start
        // adding button to the create user datatable to add user start
        setTimeout(() => {
            $(document).find("#pur_warehouse_table_filter").append(
                '<span class="add_user_div" ">\
                                     <button type="button" class="btn bg-primary sidenav_zero_index pur_warehouse_add_btn btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#pur_warehouse_add_modal" style="height:32px"> <i class="fa-solid fa-plus text-white"></i>\
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
@extends('dashboard/nav_footer')
@section('page_header_links')
    <link rel="stylesheet" href="{{ asset('dashboard_assets/inventory/css/ims_asset.css') }}">
@endSection
@section('body_content')
    <div class="row">
        <div class="col-md-12 ">

            <!-- Button trigger modal -->
            <!-- Button trigger modal -->


            <!-- Modal -->
            <div class="modal fade" id="imsAssetDeleteConfirm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form id="delete_form">
                            <input type="hidden" name="imsAssetId" id="imsAssetId">
                        </form>
                        
                        <!-- <div class="modal-header border-0">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div> -->
                        <div class="modal-body">
                            Are You sure to delete this Asset ?

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                            <button type="button" class="btn btn-primary imsAssetDeleteConfirmBtn"
                                data-bs-dismiss="modal">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- add imsAsset start  -->
            <div class="modal fade" id="imsAssetAddModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header vacancy_modal_header">
                            <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Add Asset</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-0">
                            <!-- content start   -->
                            <div class="container-fluid create_user_main p-0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form role="form" action="" method="post" id="imsAssetForm">
                                            @csrf
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <!-- Asset name -->
                                                    <div class="mb-3 col-md-6">
                                                        <label for="name">Asset Name</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Asset Name " aria-label="Asset Name"
                                                            name="name" id="name">
                                                    </div>
                                                    <!-- Quantity -->
                                                    <div class="mb-3 col-md-6">
                                                        <label for="qty">Quantity</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter Quantity " aria-label="Asset Name"
                                                            name="qty" id="qty">
                                                    </div>


                                                    <!-- warehouse  -->
                                                    <div class="mb-3 col-md-6">
                                                        <label for="warehouse_id"> Warehouse Name </label>
                                            <select name="warehouse_id" id="warehouse_id" class="form-select warehouse_id">
                                                <option></option>
                                                @foreach($warehouses as $warehouse)
                                                <option value={{$warehouse->warehouse_id}}> {{$warehouse->warehouse_name}}</option>
                                                @endforeach
                                                
                                            </select>
                                                    </div>





                                                    
                                                    <!-- description date -->
                                                    <div class="mb-3 col-md-6">
                                                        <label for="description">Description</label>
                                                        <textarea name="description" cols="" rows="1" id="description" placeholder="Enter Description "
                                                            class="form-control"></textarea>
                                                    </div>


                                                    <div class="text-center col-md-12 m-auto">
                                                        <button type="submit" id="imsAssetAddBtn"
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
            <div class="modal fade" id="imsAssetUpdateModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header vacancy_modal_header">
                            <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Update Asset</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-0">
                            <!-- content start   -->
                            <div class="container-fluid create_user_main p-0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form role="form" action="" method="post" id="imsAssetUpdateForm">
                                            <input type="hidden" name="ims_asset_id" id="ims_asset_id" value="">
                                            @csrf
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <!-- Asset name -->
                                                    <div class="mb-3 col-md-6">
                                                        <label for="name_update">Asset Name</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Asset Name " aria-label="Asset Name"
                                                            name="name" id="name_update">
                                                    </div>
                                                    <!-- Quantity -->
                                                    <div class="mb-3 col-md-6">
                                                        <label for="qty">Quantity</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter Quantity " aria-label="Asset Name"
                                                            name="qty" id="qty">
                                                    </div>


                                                    <!-- warehouse  -->
                                                    <div class="mb-3 col-md-6">
                                                        <label for="warehouse_id_update"> Warehouse Name </label>
                                            <select name="warehouse_id" id="warehouse_id_update" class="form-select warehouse_id_update">
                                                <option></option>
                                                @foreach($warehouses as $warehouse)
                                                <option value={{$warehouse->warehouse_id}}> {{$warehouse->warehouse_name}}</option>
                                                @endforeach
                                                
                                            </select>
                                                    </div>





                                                    
                                                    <!-- description date -->
                                                    <div class="mb-3 col-md-6">
                                                        <label for="description">Description</label>
                                                        <textarea name="description" cols="" rows="1" id="description" placeholder="Enter Description "
                                                            class="form-control"></textarea>
                                                    </div>




                                                    

                                                    {{-- button --}}
                                                    <div class="text-center col-md-12 m-auto">
                                                        <button type="submit" id="imsAssetUpdateBtn"
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
                        <table class="table align-items-center mb-0  hover" id="imsAssetTable" style="width: 100%;">

                            <!-- show message when imsAsset   added  start  -->
                            <div class="mb-3 col-md-12">
                                <div class="alert alert-success  d-none text-white imsAssetAddedMsg user_updated_msg"
                                    role="alert">
                                    Asset added
                                    <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                </div>
                            </div>
                            <!-- show message when imsAsset   added  start  -->
                            <!-- show message when imsAsset    updated  start  -->
                            <div class="mb-3 col-md-12">
                                <div class="alert alert-success  d-none text-white imsAssetUpdatedMsg user_updated_msg"
                                    role="alert">
                                    Asset updated
                                    <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                </div>
                            </div>
                            <!-- show message when imsAsset    updated  start  -->
                            <!-- show message when imsAsset    deleted start  -->
                            <div class="mb-3 col-md-12">
                                <div class="alert alert-success  d-none text-white imsAssetDeletedMsg user_updated_msg"
                                    role="alert">
                                    Asset deleted
                                    <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                </div>
                            </div>
                            <!-- show message when job vacancy   deleted  start  -->
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">S no</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Name
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Qty
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Warehouse
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Description</th>
                                    
                                    
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
            $("#imsAssetUpdateForm #parent").select2({
                placeholder: "Select Category",
                allowClear: true,
                width: "100%",
            });

            // hide select error when the field is selected start 
            $('#imsAssetUpdateForm #parent').on('change', function(param) {
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
            $("#imsAssetForm").validate({
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
                        required: "Asset name required",
                    },
                    warehouse_id:{
                        required:'This field is required'

                    }

                },
                
                submitHandler: function(form) {
                    $.ajax({
                        type: "post",
                        url: base_url + "ims_asset",
                        data: $(form).serialize(),
                        dataType: "json",
                        success: function(response) {
                            if (response) {
                                defaultSelect2($('#imsAssetForm').find('#warehouse_id'))
                                $("#imsAssetForm").trigger("reset");
                                $("#imsAssetTable").DataTable().ajax.reload();
                                $("#imsAssetAddModal").modal("toggle");
                                $(".imsAssetAddedMsg").removeClass("d-none");
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

                $("#imsAssetTable").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: base_url + "ims_asset_get_data",
                    columns: [{
                            data: "DT_RowIndex",
                            name: "DT_RowIndex"
                        },
                        {
                            data: "name",
                            name: "name"
                        },
                        {
                            data: "qty",
                            name: "qty"
                        },
                        {
                            data: "warehouse_id",
                            name: "warehouse_id"
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
            $(document).on("click", ".imsAssetDeleteBtn", function(param) {
                $('#imsAssetId').val($(this).data("ims_asset_id"))  ;

                $('#sidenav-main')

                setTimeout(() => {
                    $('#imsAssetDeleteConfirm').modal('show')
                }, 50);

                
                $(".imsAssetDeleteConfirmBtn").on("click", function() {
                    $.ajax({
                        type: "post",
                        url: base_url + "ims_asset_delete",
                        data: $('#delete_form').serialize(),
                        dataType: "json",
                        success: function(response) {
                            if (response) {
                                $("#imsAssetTable").DataTable().ajax.reload();
                                $(".imsAssetDeletedMsg").removeClass("d-none");
                            }
                        },
                    });
                });
            });
            // delete user end
            // update employee leave  start
            $(document).on("click", ".imsAssetEditBtn", function(param) {
                let imsAssetId = $(this).data("ims_asset_id");
                $.ajax({
                    type: "post",
                    url: base_url + "ims_asset_fetch",
                    data: {
                        imsAssetId: imsAssetId
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response) {
                            $("#imsAssetUpdateForm")
                                .find("#ims_asset_id")
                                .val(response.ims_asset_id);
                            $("#imsAssetUpdateForm")
                                .find("#name_update")
                                .val(response.name);
                            $("#imsAssetUpdateForm")
                                .find("#description")
                                .val(response.description);
                            $("#imsAssetUpdateForm")
                                .find("#qty")
                                .val(response.qty);

                                $(document).find('.warehouse_id_update option').each((key,value)=>{
                                    if( $(value).val() == response.warehouse_id){
                                        $('#warehouse_id_update').val(response.warehouse_id).change()

                                    }

                                    

                                })






                            

                        }
                    },
                });
            });

            $("#imsAssetUpdateForm").validate({
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
                        required: "Asset name required",
                    },
                    warehouse_id:{
                        required:'This field is required'

                    }

                },
                
                
                submitHandler: function(form) {
                    $.ajax({
                        type: "post",
                        url: base_url + "ims_asset_update",
                        data: $(form).serialize(),
                        dataType: "json",
                        success: function(response) {
                            if (response) {
                                $("#imsAssetTable").DataTable().ajax.reload();
                                $(".imsAssetUpdatedMsg").removeClass("d-none");
                                
                                $('#imsAssetUpdateModal').modal("toggle")
                            }
                        },
                    });
                },
            });
            // update employee leave  end

            // add  button to data table to add job vacancy start
            // adding button to the create user datatable to add user start
            setTimeout(() => {
                $(document).find("#imsAssetTable_filter").append(
                    '<span class="add_user_div" ">\
                                     <button type="button" class="btn bg-primary sidenav_zero_index imsAssetAddBtn btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#imsAssetAddModal" style="height:32px"> <i class="fa-solid fa-plus text-white"></i>\
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

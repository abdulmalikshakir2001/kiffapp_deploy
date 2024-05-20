@extends('dashboard/nav_footer')
@section('page_header_links')
    <link rel="stylesheet" href="{{ asset('dashboard_assets/account/css/acc_currency.css') }}">
@endSection
@section('body_content')
    <div class="row">
        <div class="col-md-12 ">

            <!-- Button trigger modal -->
            <!-- Button trigger modal -->


            <!-- Modal -->
            <div class="modal fade" id="accCurrencyDeleteConfirm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form id="delete_form">
                            <input type="hidden" name="accCurrencyId" id="acc_currency_delete_id">
                        </form>

                        <div class="modal-body">
                            Are You sure to delete this Currency ?

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                            <button type="button" class="btn btn-primary accCurrencyDeleteConfirmBtn"
                                data-bs-dismiss="modal">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- add accCurrency start  -->
            <div class="modal fade" id="accCurrencyAddModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header vacancy_modal_header">
                            <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Add Currency</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-0">
                            <!-- content start   -->
                            <div class="container-fluid create_user_main p-0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form role="form" action="" method="post" id="accCurrencyForm">
                                            @csrf
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <!-- Currency name -->
                                                    <div class="mb-3 col-md-6">
                                                        <label for="name">Currency Name</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Currency Name " aria-label="Currency Name"
                                                            name="name" id="name">
                                                    </div>
                                                    <!-- currency code  -->
                                                    <div class="mb-3 col-md-6">
                                                        <label for="currency_code">Currency Code</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Currency Code" aria-label="Currency Code"
                                                            name="currency_code" id="currency_code">
                                                    </div>
                                                    <!-- Exchange rate  -->
                                                    <div class="mb-3 col-md-12">
                                                        <label for="exchange_rate">Exchange rate</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Currency Code" aria-label="Currency Code"
                                                            name="exchange_rate" id="exchange_rate">
                                                    </div>
                                                    <!-- is default  -->
                                                    <div class="mb-3 col-md-6">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="is_default" name="is_default">
                                                            <label class="custom-control-label" for="is_default">is default</label>
                                                          </div>
                                                    </div>
                                                    
                                                    


                                                    
                                                    


                                                    <div class="text-center col-md-12 m-auto">
                                                        <button type="submit" id="accCurrencyAddBtn"
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
            <div class="modal fade" id="accCurrencyUpdateModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header vacancy_modal_header">
                            <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Update Currency</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-0">
                            <!-- content start   -->
                            <div class="container-fluid create_user_main p-0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form role="form" action="" method="post" id="accCurrencyUpdateForm">
                                            <input type="hidden" name="acc_currency_id" id="acc_currency_id" value="">
                                            @csrf
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <!-- Currency name -->
                                                    <div class="mb-3 col-md-6">
                                                        <label for="name">Currency Name</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Currency Name " aria-label="Currency Name"
                                                            name="name" id="name">
                                                    </div>
                                             <!-- currency code  -->
                                             <div class="mb-3 col-md-6">
                                                <label for="currency_code">Currency Code</label>
                                                <input type="text" class="form-control"
                                                    placeholder="Currency Code" aria-label="Currency Code"
                                                    name="currency_code" id="currency_code">
                                            </div>
                                            <div class="mb-3 col-md-12">
                                                <label for="exchange_rate">Exchange rate</label>
                                                <input type="text" class="form-control"
                                                    placeholder="Currency Code" aria-label="Currency Code"
                                                    name="exchange_rate" id="exchange_rate">
                                            </div>
                                            <!-- is default  -->
                                            <div class="mb-3 col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="is_default" name="is_default">
                                                    <label class="custom-control-label" for="is_default">is default</label>
                                                  </div>
                                            </div>
                                            
                                                       
    
    
                                                    
                                             
                                                    

                                                    {{-- button --}}
                                                    <div class="text-center col-md-12 m-auto">
                                                        <button type="submit" id="accCurrencyUpdateBtn"
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
                        <table class="table align-items-center mb-0  hover" id="accCurrencyTable" style="width: 100%;">

                            <!-- show message when default currency not set     start  -->
                            @if(session()->has('message'))
                            <div class="mb-3 col-md-12">
                                <div class="alert alert-success   text-white accCurrencyAddedMsg user_updated_msg"
                                    role="alert">
                                    {{session('message')}}
                                    <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                </div>
                            </div>
                            @endif
                            <!-- show message when default currency not set    end  -->
                            <!-- show message when accCurrency   added  start  -->
                            <div class="mb-3 col-md-12">
                                <div class="alert alert-success  d-none text-white accCurrencyAddedMsg user_updated_msg"
                                    role="alert">
                                    Currency added
                                    <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                </div>
                            </div>
                            <!-- show message when accCurrency   added  start  -->
                            <!-- show message when accCurrency    updated  start  -->
                            <div class="mb-3 col-md-12">
                                <div class="alert alert-success  d-none text-white accCurrencyUpdatedMsg user_updated_msg"
                                    role="alert">
                                    Currency updated
                                    <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                </div>
                            </div>
                            <!-- show message when accCurrency    updated  start  -->
                            <!-- show message when accCurrency    deleted start  -->
                            <div class="mb-3 col-md-12">
                                <div class="alert alert-success  d-none text-white accCurrencyDeletedMsg user_updated_msg"
                                    role="alert">
                                    Currency deleted
                                    <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                </div>
                            </div>
                            <!-- show message when job vacancy   deleted  start  -->
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">S no</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Name
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Currency Code
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Default Currency 
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">
                                        Exchange Rate


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
            $("#accCurrencyUpdateForm #parent").select2({
                placeholder: "Select Category",
                allowClear: true,
                width: "100%",
            });

            // hide select error when the field is selected start 
            $('#accCurrencyUpdateForm #parent').on('change', function(param) {
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
            $("#accCurrencyForm").validate({
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
                        required: "Currency name required",
                    },
                    warehouse_id:{
                        required:'This field is required'

                    }

                },
                
                submitHandler: function(form) {
                    $.ajax({
                        type: "post",
                        url: base_url + "acc_currency",
                        data: $(form).serialize(),
                        dataType: "json",
                        success: function(response) {
                            if (response) {
                                defaultSelect2($('#accCurrencyForm').find('#warehouse_id'))
                                $("#accCurrencyForm").trigger("reset");
                                $("#accCurrencyTable").DataTable().ajax.reload();
                                $("#accCurrencyAddModal").modal("toggle");
                                $(".accCurrencyAddedMsg").removeClass("d-none");
                                $('#accCurrencyForm').find('#exchange_rate').prop('disabled',false).val("")
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

                $("#accCurrencyTable").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: base_url + "acc_currency_get_data",
                    columns: [{
                            data: "DT_RowIndex",
                            name: "DT_RowIndex"
                        },
                        {
                            data: "name",
                            name: "name"
                        },
                        {
                            data: "currency_code",
                            name: "currency_code"
                        },
                        {
                            data: "is_default",
                            name: "is_default"
                        },
                        {
                            data: "exchange_rate",
                            name: "exchange_rate"
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
            $(document).on("click", ".accCurrencyDeleteBtn", function(param) {
                $('#acc_currency_delete_id').val($(this).data("acc_currency_id"));


                $('#sidenav-main')

                setTimeout(() => {
                    $('#accCurrencyDeleteConfirm').modal('show')
                }, 50);

                
                $(".accCurrencyDeleteConfirmBtn").on("click", function() {
                    $.ajax({
                        type: "post",
                        url: base_url + "acc_currency_delete",
                        data: $('#delete_form').serialize(),
                        dataType: "json",
                        success: function(response) {
                            if (response) {
                                $("#accCurrencyTable").DataTable().ajax.reload();
                                $(".accCurrencyDeletedMsg").removeClass("d-none");
                            }
                        },
                    });
                });
            });
            // delete user end
            // update employee leave  start
            $(document).on("click", ".accCurrencyEditBtn", function(param) {
                let accCurrencyId = $(this).data("acc_currency_id");
                $.ajax({
                    type: "post",
                    url: base_url + "acc_currency_fetch",
                    data: {
                        accCurrencyId: accCurrencyId
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response) {
                            $("#accCurrencyUpdateForm")
                                .find("#acc_currency_id")
                                .val(response.acc_currency_id);
                            $("#accCurrencyUpdateForm")
                                .find("#name")
                                .val(response.name);
                            $("#accCurrencyUpdateForm")
                                .find("#currency_code")
                                .val(response.currency_code);
                            $("#accCurrencyUpdateForm")
                                .find("#exchange_rate")
                                .val(response.exchange_rate);



                                if(response.is_default == '1'){
                                    $("#accCurrencyUpdateForm")
                                .find("#is_default").prop('checked',true)

                                $("#accCurrencyUpdateForm")
                                .find("#exchange_rate")
                                .prop('disabled',true);


                                }
                                else{
                                    $("#accCurrencyUpdateForm")
                                .find("#is_default").prop('checked',false)
                                $("#accCurrencyUpdateForm")
                                .find("#exchange_rate")
                                .prop('disabled',false);

                                }
                            
                            

                                






                            

                        }
                    },
                });
            });

            $("#accCurrencyUpdateForm").validate({
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
                        required: "Currency name required",
                    },
                    warehouse_id:{
                        required:'This field is required'

                    }

                },
                
                
                submitHandler: function(form) {
                    $.ajax({
                        type: "post",
                        url: base_url + "acc_currency_update",
                        data: $(form).serialize(),
                        dataType: "json",
                        success: function(response) {
                            if (response) {
                                $("#accCurrencyTable").DataTable().ajax.reload();
                                $(".accCurrencyUpdatedMsg").removeClass("d-none");
                                $('#accCurrencyUpdateModal').modal("toggle")
                            }
                        },
                    });
                },
            });
            // update employee leave  end

            // add  button to data table to add job vacancy start
            // adding button to the create user datatable to add user start
            setTimeout(() => {
                $(document).find("#accCurrencyTable_filter").append(
                    '<span class="add_user_div" ">\
                                     <button type="button" class="btn bg-primary sidenav_zero_index accCurrencyAddBtn btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#accCurrencyAddModal" style="height:32px"> <i class="fa-solid fa-plus text-white"></i>\
                            </button>\
                      </span>\
                   '
                );
                // check the contstains for company owner to add user start
            }, 1);
            // add  button to data table to add job vacancy end
            // add form checkbox checked or not 

            function checkboxChecking(form,elem,checkbox){ // form , exchange rate , checkbox  names required
                
                if($('#' + form).find('#' + checkbox).prop('checked')){
                    $('#'+form).find('#' +elem).val(1).prop('disabled',true)
                 } 
                 else{
                    $('#'+form).find('#'+elem).prop('disabled',false).val("")

                 }

            }




            $('#accCurrencyForm').find('#is_default').on('change',function () { 
                checkboxChecking('accCurrencyForm','exchange_rate','is_default') 
             })
            $('#accCurrencyUpdateForm').find('#is_default').on('change',function () { 
                checkboxChecking('accCurrencyUpdateForm','exchange_rate','is_default') 
             })


        });

    </script>
@endSection

@extends('dashboard/nav_footer')
@section('page_header_links')
    <link rel="stylesheet" href="{{ asset('dashboard_assets/account/css/acc_account_balance.css') }}">
@endSection
@section('body_content')
    <div class="row">
        <div class="col-md-12 ">

            <!-- Button trigger modal -->
            <!-- Button trigger modal -->


            <!-- Modal -->
            <div class="modal fade" id="accAccountBalanceDeleteConfirm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form id="delete_form">
                            <input type="hidden" name="accAccountBalanceId" id="acc_balance_delete_id">
                        </form>
                        <!-- <div class="modal-header border-0">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div> -->
                        <div class="modal-body">
                            Are You sure to delete this Account Balance ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                            <button type="button" class="btn btn-primary accAccountBalanceDeleteConfirmBtn"
                                data-bs-dismiss="modal">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- add accAccountBalance start  -->
            <div class="modal fade" id="accAccountBalanceAddModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header vacancy_modal_header">
                            <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Add Account Balance</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-0">
                            <!-- content start   -->
                            <div class="container-fluid create_user_main p-0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form role="form" action="" method="post" id="accAccountBalanceForm">
                                            @csrf
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <!-- Account Balance name -->
                                                    <div class="mb-3 col-md-6">
                                                        <label for="account_id">Account Balance Name</label>
                                                        <select name="account_id" id="account_id" class="form-select account_id">
                                                            <option></option>
                                                            @foreach($accounts as $account)
                                                            <option value={{$account->acc_account_id}}> {{$account->name}}</option>
                                                            @endforeach
                                                            
                                                        </select>
                                                        
                                                    </div>
                                                    <!-- Description -->
                                                    <div class="mb-3 col-md-6">
                                                        <label for="balance">Balance</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Balance" aria-label="Balance"
                                                            name="balance" id="balance">
                                                    </div>
                                                    
                                                    


                                                    
                                                    


                                                    <div class="text-center col-md-12 m-auto">
                                                        <button type="submit" id="accAccountBalanceAddBtn"
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
            <div class="modal fade" id="accAccountBalanceUpdateModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header vacancy_modal_header">
                            <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Update Account Balance</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-0">
                            <!-- content start   -->
                            <div class="container-fluid create_user_main p-0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form role="form" action="" method="post" id="accAccountBalanceUpdateForm">
                                            <input type="hidden" name="acc_account_balance_id" id="acc_account_balance_id" value="">
                                            @csrf
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <!-- Account Balance name -->
                                                    <div class="mb-3 col-md-6">
                                                        <label for="account_id_update">Account Balance Name</label>
                                                        <select name="account_id_update" id="account_id_update" class="form-select account_id_update">
                                                            <option></option>
                                                            @foreach($accounts as $account)
                                                            <option value={{$account->acc_account_id}}> {{$account->name}}</option>
                                                            @endforeach
                                                            
                                                        </select>
                                                        
                                                    </div>
                                                    <!-- Description -->
                                                    <div class="mb-3 col-md-6">
                                                        <label for="balance_update">Balance</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Balance" aria-label="Balance"
                                                            name="balance_update" id="balance_update">
                                                    </div>
                                                    
                                                    

    
                                                    
                                             
                                                    

                                                    {{-- button --}}
                                                    <div class="text-center col-md-12 m-auto">
                                                        <button type="submit" id="accAccountBalanceUpdateBtn"
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
                        <table class="table align-items-center mb-0  hover" id="accAccountBalanceTable" style="width: 100%;">

                            <!-- show message when accAccountBalance   added  start  -->
                            <div class="mb-3 col-md-12">
                                <div class="alert alert-success  d-none text-white accAccountBalanceAddedMsg user_updated_msg"
                                    role="alert">
                                    Account Balance added
                                    <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                </div>
                            </div>
                            <!-- show message when accAccountBalance   added  start  -->
                            <!-- show message when account and balance exist   start  -->
                            <div class="mb-3 col-md-12">
                                <div class="alert alert-info  d-none text-white accAccountBalanceExistMsg user_updated_msg"
                                    role="alert">
                                    Account Balance already exist please Update
                                    <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                </div>
                            </div>
                            <!-- show message when account and balance exist   start  -->
                            <!-- show message when accAccountBalance    updated  start  -->
                            <div class="mb-3 col-md-12">
                                <div class="alert alert-success  d-none text-white accAccountBalanceUpdatedMsg user_updated_msg"
                                    role="alert">
                                    Account Balance updated
                                    <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                </div>
                            </div>
                            <!-- show message when accAccountBalance    updated  start  -->
                            <!-- show message when accAccountBalance    deleted start  -->
                            <div class="mb-3 col-md-12">
                                <div class="alert alert-success  d-none text-white accAccountBalanceDeletedMsg user_updated_msg"
                                    role="alert">
                                    Account Balance deleted
                                    <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                </div>
                            </div>
                            <!-- show message when job vacancy   deleted  start  -->
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">S no</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Account Name
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Balance
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
    

            // warehouse 
            $('#account_id').on('change', function (param) {
            let account_idValue = $(this).val();
            if (account_idValue == "") {
                $('#account_id-error').removeClass('d-none') // label
            } else {
                $('#account_id-error').addClass('d-none') // label
            }
        })
        $("#account_id").select2({
            placeholder: "Select Account",
            allowClear: true,
            width: "100%",
        });
            $('#account_id_update').on('change', function (param) {

            let account_updateValue = $(this).val();
            if (account_updateValue == "") {
                $('#account_id_update-error').removeClass('d-none') // label
            } else {
                $('#account_id_update-error').addClass('d-none') // label
            }
        })
        $("#account_id_update").select2({
            placeholder: "Select Account",
            allowClear: true,
            width: "100%",
        });
        




            // parent
            $("#parent").select2({
                placeholder: "Select Category",
                allowClear: true,
                width: "100%",
            });
            $("#accAccountBalanceUpdateForm #parent").select2({
                placeholder: "Select Category",
                allowClear: true,
                width: "100%",
            });

            // hide select error when the field is selected start 
            $('#accAccountBalanceUpdateForm #parent').on('change', function(param) {
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
            $("#accAccountBalanceForm").validate({
                rules: {
                    account_id: {
                        required: true,
                    },
                    balance:{
                        required:true

                    }
                },
                messages: {
                    account_id: {
                        required: "This field is required",
                    },
                    balance:{
                        required:'This field is required'

                    }

                },
                
                submitHandler: function(form) {
                    $.ajax({
                        type: "post",
                        url: base_url + "acc_account_balance",
                        data: $(form).serialize(),
                        dataType: "json",
                        success: function(response) {
                            if (response == true) {
                            
                                
                                $(".accAccountBalanceAddedMsg").removeClass("d-none");
                            }
                            else if (response == 'account exist'){
                                $(".accAccountBalanceExistMsg").removeClass("d-none");
                                
                            }
                            defaultSelect2($('#accAccountBalanceForm').find('#account_id'))
                                $('#account_id').val("").change()
                                $("#accAccountBalanceForm").trigger("reset");
                                $("#accAccountBalanceTable").DataTable().ajax.reload();
                                $("#accAccountBalanceAddModal").modal("toggle");



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

                $("#accAccountBalanceTable").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: base_url + "acc_account_balance_get_data",
                    columns: [{
                            data: "DT_RowIndex",
                            name: "DT_RowIndex"
                        },
                        {
                            data: "account_name",
                            name: "account_name"
                        },
                        {
                            data: "balance",
                            name: "balance"
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
            $(document).on("click", ".accAccountBalanceDeleteBtn", function(e) {
                // alert('on thired deleted first two also run')
                // e.stopImmediatePropagation()
                // let accAccountBalanceId = $(this).data("acc_account_balance_id");
                // $('#acc_balance_delete_id').val($(this).data("acc_account_balance_id"))
                $('#acc_balance_delete_id').val($(this).data("acc_account_balance_id"))
                

                // $('#sidenav-main')

                setTimeout(() => {
                    $('#accAccountBalanceDeleteConfirm').modal('show')
                }, 50);
                $(".accAccountBalanceDeleteConfirmBtn").on("click", function() {
                    $.ajax({
                        type: "post",
                        url: base_url + "acc_account_balance_delete",
                        data: $('#delete_form').serialize(),
                        // dataType: "json",
                        success: function(response) {
                            if (response) {
                                $("#accAccountBalanceTable").DataTable().ajax.reload();
                                $(".accAccountBalanceDeletedMsg").removeClass("d-none");
                                
                            }
                        },
                    });
                });
            });
            // delete user end
            // update employee leave  start
            $(document).on("click", ".accAccountBalanceEditBtn", function(param) {
                
                let accAccountBalanceId = $(this).data("acc_account_balance_id");
                $.ajax({
                    type: "post",
                    url: base_url + "acc_account_balance_fetch",
                    data: {
                        accAccountBalanceId: accAccountBalanceId
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response) {
                            $("#accAccountBalanceUpdateForm")
                                .find("#acc_account_balance_id")
                                .val(response.acc_account_balance_id);
                            $("#accAccountBalanceUpdateForm")
                                .find("#account_id_update")
                                .val(response.account_id).change();
                            $("#accAccountBalanceUpdateForm")
                                .find("#balance_update")
                                .val(response.balance);
                            

                                






                            

                        }
                    },
                });
            });

            $("#accAccountBalanceUpdateForm").validate({
                rules: {
                    account_id_update: {
                        required: true,
                    },
                    balance_update:{
                        required:true

                    }
                },
                messages: {
                    account_id_update: {
                        required: "This field is required",
                    },
                    balance_update:{
                        required:'This field is required'

                    }

                },
                
                
                submitHandler: function(form) {
                    $.ajax({
                        type: "post",
                        url: base_url + "acc_account_balance_update",
                        data: $(form).serialize(),
                        dataType: "json",
                        success: function(response) {
                            if (response) {
                                $("#accAccountBalanceTable").DataTable().ajax.reload();
                                $(".accAccountBalanceUpdatedMsg").removeClass("d-none");
                                
                                $('#accAccountBalanceUpdateModal').modal("toggle")
                            }
                        },
                    });
                },
            });
            // update employee leave  end

            // add  button to data table to add job vacancy start
            // adding button to the create user datatable to add user start
            setTimeout(() => {
                $(document).find("#accAccountBalanceTable_filter").append(
                    '<span class="add_user_div" ">\
                                     <button type="button" class="btn bg-primary sidenav_zero_index accAccountBalanceAddBtn btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#accAccountBalanceAddModal" style="height:32px"> <i class="fa-solid fa-plus text-white"></i>\
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

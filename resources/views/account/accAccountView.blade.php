@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{ asset('dashboard_assets/account/css/acc_account.css') }}">
@endSection
@section('body_content')
<div class="row">
    <div class="col-md-12 ">

        <!-- Button trigger modal -->
        <!-- Button trigger modal -->


        <!-- Modal -->
        <div class="modal fade" id="accAccountDeleteConfirm" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <!-- <div class="modal-header border-0">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div> -->
                    <div class="modal-body">
                        Are You sure to delete this Account ?

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="button" class="btn btn-primary accAccountDeleteConfirmBtn"
                            data-bs-dismiss="modal">Confirm</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- add accAccount start  -->
        <div class="modal fade" id="accAccountAddModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header vacancy_modal_header">
                        <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Add Account</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        <!-- content start   -->
                        <div class="container-fluid create_user_main p-0">
                            <div class="row">
                                <div class="col-md-12">
                                    <form role="form" action="" method="post" id="accAccountForm">
                                        @csrf
                                        <div id="family_code_div" class="d-none">1</div>
                                        <div class="container-fluid">
                                            <div class="row">
                                                <!-- Account name -->
                                                <div class="mb-3 col-md-6">
                                                    <label for="name">Account Name</label>
                                                    <input type="text" class="form-control" placeholder="Account Name "
                                                        aria-label="Account Name" name="name" id="name">
                                                </div>
                                                <!-- currency code  -->
                                                <div class="mb-3 col-md-6">
                                                    <label for="code">Code</label>
                                                    <input type="text" class="form-control" placeholder="Account Code"
                                                        aria-label="Account Code" name="code" id="code" disabled>
                                                </div>
                                                <!-- account type -->
                                                <div class="mb-3 col-md-6">
                                                    <label for="type">Account Type</label>
                                                    <select name="type" id="type" class="form-select  type">
                                                        <option></option>

                                                        @foreach($accFamilies as $accFamily)
                                                        <option value="{{$accFamily->family_code}}">
                                                            {{$accFamily->family_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <!-- parent-->
                                                <div class="mb-3 col-md-6">
                                                    <label for="parent">Parent</label>
                                                    <select disabled name="parent" id="parent"
                                                        class="form-select  parent">
                                                        <option></option>

                                                        @foreach($accounts as $account)
                                                        <option value="{{$account->code}}">{{$account->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                       <!-- Account name -->
                                                       <div class="mb-3 col-md-12">
                                                        <label for="opening_balance">Opening Balance</label>
                                                        <input type="text" name="opening_balance" id="opening_balance" class="form-control" value="0.00">
                                                       </div>
                                                       
                                                <!-- remarks -->
                                                <div class="mb-3 col-md-12">
                                                    <label for="remarks">Remarks</label>


                                                    <textarea name="remarks" id="remarks" cols="" rows="2"
                                                        class="form-control" aria-placeholder=""
                                                        placeholder="Remarks"></textarea>
                                                </div>













                                                <div class="text-center col-md-12 m-auto">
                                                    <button type="submit" id="accAccountAddBtn"
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
        <div class="modal fade" id="accAccountUpdateModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header vacancy_modal_header">
                        <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Update Account</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        <!-- content start   -->
                        <div class="container-fluid create_user_main p-0">
                            <div class="row">
                                <div class="col-md-12">
                                    <form role="form" action="" method="post" id="accAccountUpdateForm">
                                        <input type="hidden" name="acc_account_id" id="acc_account_id" value="">
                                        @csrf
                                        <div class="container-fluid">
                                            <div class="row">
                                                <!-- Account name -->
                                                <div class="mb-3 col-md-6">
                                                    <label for="name_update">Account Name</label>
                                                    <input type="text" class="form-control" placeholder="Account Name "
                                                        aria-label="Account Name" name="name_update" id="name_update">
                                                </div>
                                                <!-- currency code  -->
                                                <div class="mb-3 col-md-6">
                                                    <label for="code_update">Code</label>
                                                    <input type="text" class="form-control" placeholder="Account Code"
                                                        aria-label="Account Code" name="code_update" id="code_update"
                                                        disabled>
                                                </div>
                                                <!-- account type -->
                                                <div class="mb-3 col-md-6">
                                                    <label for="type_update">Account Type</label>
                                                    <select name="type_update" id="type_update"
                                                        class="form-select  type">
                                                        <option></option>

                                                        @foreach($accFamilies as $accFamily)
                                                        <option value="{{$accFamily->family_code}}">
                                                            {{$accFamily->family_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <!-- parent-->
                                                <div class="mb-3 col-md-6">
                                                    <label for="parent_update">Parent</label>
                                                    <select name="parent_update" id="parent_update"
                                                        class="form-select  parent">
                                                        <option></option>

                                                        @foreach($accounts as $account)
                                                        <option value="{{$account->code}}">{{$account->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <!-- remarks -->
                                                <div class="mb-3 col-md-12">
                                                    <label for="remarks_update">Remarks</label>


                                                    <textarea name="remarks_update" id="remarks_update" cols="" rows="2"
                                                        class="form-control" aria-placeholder=""
                                                        placeholder="Remarks"></textarea>
                                                </div>








                                                {{-- button --}}
                                                <div class="text-center col-md-12 m-auto">
                                                    <button type="submit" id="accAccountUpdateBtn"
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
                    <table class="table align-items-center mb-0  hover" id="accAccountTable" style="width: 100%;">

                        <!-- show message when accAccount   added  start  -->
                        <div class="mb-3 col-md-12">
                            <div class="alert alert-success  d-none text-white accAccountAddedMsg user_updated_msg"
                                role="alert">
                                Account added
                                <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                            </div>
                        </div>
                        <!-- show message when accAccount   added  start  -->
                        <!-- show message when accAccount    updated  start  -->
                        <div class="mb-3 col-md-12">
                            <div class="alert alert-success  d-none text-white accAccountUpdatedMsg user_updated_msg"
                                role="alert">
                                Account updated
                                <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                            </div>
                        </div>
                        <!-- show message when accAccount    updated  start  -->
                        <!-- show message when accAccount    deleted start  -->
                        <div class="mb-3 col-md-12">
                            <div class="alert alert-success  d-none text-white accAccountDeletedMsg user_updated_msg"
                                role="alert">
                                Account deleted
                                <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                            </div>
                        </div>
                        <!-- show message when job vacancy   deleted  start  -->
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">S no</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Name
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Account Code
                                </th>


                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Type
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Remarks
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



        // type
        $('#type').on('change', function (param) {
            let typeValue = $(this).val();
            if (typeValue == "") {
                $('#type-error').removeClass('d-none') // label
            } else {
                $('#type-error').addClass('d-none') // label
            }
        })
        $("#type").select2({
            placeholder: "Select Family",
            allowClear: true,
            width: "100%",
        });
        // type update
        $('#type_update').on('change', function (param) {
            let type_updateValue = $(this).val();
            if (type_updateValue == "") {
                $('#type_update-error').removeClass('d-none') // label
            } else {
                $('#type_update-error').addClass('d-none') // label
            }
        })
        $("#type_update").select2({
            placeholder: "Select Family",
            allowClear: true,
            width: "100%",
        });
        // parent update
        $('#parent_update').on('change', function (param) {
            let parent_updateValue = $(this).val();
            if (parent_updateValue == "") {
                $('#parent_update-error').removeClass('d-none') // label
            } else {
                $('#parent_update-error').addClass('d-none') // label
            }
        })
        $("#parent_update").select2({
            placeholder: "Select Parent",
            allowClear: true,
            width: "100%",
        });





        // parent
        $("#parent").select2({
            placeholder: "Select Category",
            allowClear: true,
            width: "100%",
        });
        $("#accAccountUpdateForm #parent").select2({
            placeholder: "Select Category",
            allowClear: true,
            width: "100%",
        });

        // hide select error when the field is selected start 
        $('#accAccountUpdateForm #parent').on('change', function (param) {
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
                echo "var base_url = '".$baseUrl. "';";

        @endphp



        // add job vacancies  start
        $("#accAccountForm").validate({
            rules: {
                name: {
                    required: true,
                },
                type: {
                    required: true

                }
            },
            messages: {
                name: {
                    required: "Account name required",
                },
                type: {
                    required: 'This field is required'

                }

            },

            submitHandler: function (form) {

                $.ajax({
                    type: "post",
                    url: base_url + "acc_account",
                    data: {
                        name: $('#name').val(),
                        code: $('#code').val(),
                        type: $('#type').val(),
                        parent: $('#parent').val(),
                        remarks: $('#remarks').val(),
                        opening_balance: $('#opening_balance').val(),

                    },
                    dataType: "json",
                    success: function (response) {
                        if (response) {

                            defaultSelect2($('#accAccountForm').find('#type'))
                            defaultSelect2($('#accAccountForm').find('#parent'))
                            $("#accAccountForm").trigger("reset");
                            $("#accAccountTable").DataTable().ajax.reload();
                            $("#accAccountAddModal").modal("toggle");
                            $(".accAccountAddedMsg").removeClass("d-none");
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

            $("#accAccountTable").DataTable({
                processing: true,
                serverSide: true,
                ajax: base_url + "acc_account_get_data",
                columns: [{
                    data: "DT_RowIndex",
                    name: "DT_RowIndex"
                },
                {
                    data: "name",
                    name: "name"
                },
                {
                    data: "code",
                    name: "code"
                },
                {
                    data: "type",
                    name: "type"
                },

                {
                    data: "remarks",
                    name: "remarks"
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
        $(document).on("click", ".accAccountDeleteBtn", function (param) {
            let accAccountId = $(this).data("acc_account_id");

            $('#sidenav-main')

            setTimeout(() => {
                $('#accAccountDeleteConfirm').modal('show')
            }, 50);


            $(".accAccountDeleteConfirmBtn").on("click", function () {
                $.ajax({
                    type: "post",
                    url: base_url + "acc_account_delete",
                    data: {
                        accAccountId: accAccountId
                    },
                    dataType: "json",
                    success: function (response) {
                        if (response) {
                            $("#accAccountTable").DataTable().ajax.reload();
                            $(".accAccountDeletedMsg").removeClass("d-none");
                        }
                    },
                });
            });
        });
        // delete user end
        // update employee leave  start
        $(document).on("click", ".accAccountEditBtn", function (e) {
            // e.stopPropagation()
            $('#parent_update').off('change')
            
            let accAccountId = $(this).data("acc_account_id");
            $.ajax({
                type: "post",
                url: base_url + "acc_account_fetch",
                data: {
                    accAccountId: accAccountId
                },
                dataType: "json",
        
                success: function (response) {
            

                    if (response) {
                        $("#accAccountUpdateForm")
                            .find("#acc_account_id")
                            .val(response.acc_account_id);
                        $("#accAccountUpdateForm")
                            .find("#name_update")
                            .val(response.name);
                        $("#accAccountUpdateForm")
                            .find("#code_update")
                            .val(response.code);
                        $("#accAccountUpdateForm")
                            .find("#remarks_update")
                            .val(response.remarks);
            // $('#parent_update').on('change')



                        $('#type_update').val(response.type).change()

                        let codeSplit = $('#code_update').val().split('-')
                        codeSplit.pop()
                        //   console.log(codeSplit)
                        $('#parent_update').val(codeSplit.join('-')).change()
                        
                        




                        setTimeout(() => {
                            // alert( $('#parent_update').val())
                            if ($('#parent_update').val() != null) {
                                $('#type_update').prop('disabled', true)
                                // $('#parent_update').val(codeSplit.join('-')).change()

                                

                            }
                            

                        }, 100);

                        // 
                        // check child accouont for update  start ---------------------------------------------------------

                    
                            
                        // $('#parent_update').off('change')
                        $('#parent_update').on("change", function (e) {
                            alert('parent request send')



                            let accountCode = $(this).val();
                            if ($(this).val() != "") {

                                const checkAccountPromise = fetch(base_url + "check_child_account", {
                                    method: "post",
                                    headers: {
                                        "Content-type": "application/json",
                                        "X-CSRF-TOKEN": document.head.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                    },
                                    body: JSON.stringify({
                                        accountCode: accountCode

                                    })


                                })
                                checkAccountPromise.then((response) => {
                                    return response.json()

                                }).then((json) => {
                                    // console.log(json)


                                    $('#code_update').val(json)
                                    // $('#parent_update').off('change')

                                    return 1


                                }).then((codeAppend) => {
                                    if (codeAppend == 1) {




                                        // remove disable property form parent start 





                                        let codeString = $('#code_update').val();
                                        let accFamilies = @json($accFamiliesCodeArray);
                                        for (let familyCode of accFamilies) {
                                            let regex = new RegExp('^' + familyCode)
                                            if (regex.test(codeString)) {
                                                // console.log(`string start with ${familyCode}`)
                                                let check = $('#type_update').find('option').each((key, value) => {
                                                    // console.log($(value).val())
                                                    if ($(value).val() == familyCode) {
                                                        // current
                                                        $(value).prop('selected', true)
                                                        $('#type_update').val(familyCode).change()
                                                        $('#type_update').prop('disabled', true)
                                                        $('#family_code_div').text(familyCode)

                                                        // $(this).off('change')
                                                        return false



                                                        // sessionStorage.setItem('familyCode',familyCode)
                                                    }
                                                    else {
                                                        $(value).prop('selected', false)
                                                    }
                                                })
                                                // console.log(check)


                                            }
                                            else {
                                                console.log(`not match `)
                                            }


                                        }





                                        // $('#parent').prop('disabled',false)


                                        // remove disable property form parent end 




                                    }


                                })

                            }
                            else {
                                // alert('parent emtpy')
                                $('#code_update').val("")
                                $('#type_update').val("").change()
                                $('#type_update').prop('disabled', false)
                            }



                        })
                    
                        
                        
                    




                        $('#type_update').on("change", function (e) {
                            e.stopImmediatePropagation()

                            if ($('#parent_update').val() == "") {
                                let familyCode = $(this).val();
                                if ($(this).val() != "") {

                                    const checkHeadPromise = fetch(base_url + "check_head_account", {
                                        method: "post",
                                        headers: {
                                            "Content-type": "application/json",
                                            "X-CSRF-TOKEN": document.head.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                        },
                                        body: JSON.stringify({
                                            familyCode: familyCode

                                        })


                                    })
                                    checkHeadPromise.then((response) => {
                                        return response.json()

                                    }).then((json) => {
                                        // console.log(json)


                                        $('#code_update').val(json)


                                    })

                                }
                            }
                        })

                    
                        // check child accouont end 
                        
                        











                    }
                },
            });
        });

        $("#accAccountUpdateForm").validate({
            rules: {
                name_update: {
                    required: true,
                },
                type_update: {
                    required: true

                }
            },
            messages: {
                name_update: {
                    required: "Account name required",
                },
                type_update: {
                    required: 'This field is required'

                }

            },


            submitHandler: function (form) {
                $.ajax({
                    type: "post",
                    url: base_url + "acc_account_update",
                    data: {
                        acc_account_id: $('#acc_account_id').val(),
                        name_update: $('#name_update').val(),
                        code_update: $('#code_update').val(),
                        type_update: $('#type_update').val(),
                        parent_update: $('#parent_update').val(),
                        remarks_update: $('#remarks_update').val(),
                    },
                    dataType: "json",
                    success: function (response) {
                        if (response) {
                            $("#accAccountTable").DataTable().ajax.reload();
                            $(".accAccountUpdatedMsg").removeClass("d-none");

                            $('#accAccountUpdateModal').modal("toggle")
                        }
                    },
                });
            },
        });
        // update employee leave  end

        // add  button to data table to add job vacancy start
        // adding button to the create user datatable to add user start
        setTimeout(() => {
            $(document).find("#accAccountTable_filter").append(
                '<span class="add_user_div" ">\
                                     <button type="button" class="btn bg-primary sidenav_zero_index accAccountAddBtn btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#accAccountAddModal" style="height:32px"> <i class="fa-solid fa-plus text-white"></i>\
                            </button>\
                      </span>\
                   '
            );
            // check the contstains for company owner to add user start
        }, 1);
        // add  button to data table to add job vacancy end

        // check head accouont start 


        $('#type').on("change", function () {

            if ($('#parent').val() == "") {
                let familyCode = $(this).val();
                if ($(this).val() != "") {

                    const checkHeadPromise = fetch(base_url + "check_head_account", {
                        method: "post",
                        headers: {
                            "Content-type": "application/json",
                            "X-CSRF-TOKEN": document.head.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            familyCode: familyCode

                        })


                    })
                    checkHeadPromise.then((response) => {
                        return response.json()

                    }).then((json) => {
                        // console.log(json)


                        $('#code').val(json)


                    })

                }
            }
        })

        // check head accouont end 
        // check child accouont start 
        $('#parent').on("change", function () {


            let accountCode = $(this).val();
            if ($(this).val() != "") {

                const checkAccountPromise = fetch(base_url + "check_child_account", {
                    method: "post",
                    headers: {
                        "Content-type": "application/json",
                        "X-CSRF-TOKEN": document.head.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        accountCode: accountCode

                    })


                })
                checkAccountPromise.then((response) => {
                    return response.json()

                }).then((json) => {
                    // console.log(json)


                    $('#code').val(json)

                    return 1


                }).then((codeAppend) => {
                    if (codeAppend == 1) {




                        // remove disable property form parent start 





                        let codeString = $('#code').val();
                        let accFamilies = @json($accFamiliesCodeArray);
                        for (let familyCode of accFamilies) {
                            let regex = new RegExp('^' + familyCode)
                            if (regex.test(codeString)) {
                                // console.log(`string start with ${familyCode}`)
                                let check = $('#type').find('option').each((key, value) => {
                                    // console.log($(value).val())
                                    if ($(value).val() == familyCode) {
                                        // current
                                        $(value).prop('selected', true)
                                        $('#type').val(familyCode).change()
                                        $('#type').prop('disabled', true)
                                        $('#family_code_div').text(familyCode)

                                        // $(this).off('change')
                                        return false



                                        // sessionStorage.setItem('familyCode',familyCode)
                                    }
                                    else {
                                        $(value).prop('selected', false)
                                    }
                                })
                                // console.log(check)


                            }
                            else {
                                console.log(`not match `)
                            }


                        }





                        // $('#parent').prop('disabled',false)


                        // remove disable property form parent end 




                    }


                })

            }
            else {
                // alert('parent emtpy')
                $('#code').val("")
                $('#type').val("").change()
                $('#type').prop('disabled', false)
            }



        })
        // check child accouont end 

        // remove disable property form parent start 
        $('#type').on('change', function () {
            $('#parent').prop('disabled', false)

        })
        // remove disable property form parent end 
        // we store family code in div after parent change then type change start 
        // current
        let target = document.getElementById('family_code_div'); // select the div element you want to observe
        // console.log(target)
        // const familyCodeNode =  target.childNodes[0]
        // console.log(`first child of target node is : ${familyCodeNode}`)

        var observer = new MutationObserver(function (mutations) {
            // $('#type').off('change')
            // console.log(mutations)
            for (let mutation of mutations) {
                // console.log(mutation)

                if (mutation.addedNodes.length == 1) {
                    // alert('old remove new added')
                    // alert( $('#type').val())
                    // alert('after parent selection  type selected according to code  family')


                    // $('#type').val($(target).text()).change()

                }

            }

        });

        var config = { characterData: true, childList: true };
        observer.observe(target, config);




        // we store family code in div after parent change then type change end 

        // 
        $('#opening_balance').on('click',function(){
            $(this).val("")
        })
        
        

        // 




    });
</script>
@endSection
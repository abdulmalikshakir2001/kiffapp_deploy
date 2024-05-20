@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{ asset('dashboard_assets/purchase/css/pur_invoice.css') }}">
@endSection
@section('body_content')
<div class="row profile">
    <div class="col-md-12">

        {{-- quotation request form start --}}

        <div class="row">
            <div class="col-md-12">
                {{-- start --}}

                {{-- end --}}

                <form action="" id="pur_purchase_quotation_form">
                    @csrf
                    <div class="container-fluid ">
                        <div class="row gy-4 profile_row">
                            <!--  lable div end  -->
                            <div class="col-md-12">
                                <div class="parent">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h5 class="">Add Delivery Note </h5>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="alert alert-success  d-none text-white pur_purchase_quotation_added_message user_updated_msg"
                                                role="alert" id="pur_purchase_quotation_added_message">
                                                Delivery Note added successfully
                                                <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- lable div end  -->

                            <!-- user information start  -->
                            <div class="col-md-12">
                                <div class="parent">
                                    <h5 class="">Delivery Note </h5>
                                    <div class="row gy-3">
                                        {{-- supplier --}}
                                        <div class="col-md-4">
                                            <label for="supplier_id"> Supplier Name </label>
                                            <select name="supplier_id" id="supplier_id" class="form-select supplier_id">
                                                <option></option>
                                                @foreach ($suppliers as $supplier)
                                                <option value="{{ $supplier->user_id }}">
                                                    {{ $supplier->username }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        {{-- po --}}
                                        <div class="col-md-4">
                                            <label for="pur_order_id"> select PO </label>
                                            <select name="pur_order_id" id="pur_order_id"
                                                class="form-select pur_order_id">
                                                <option></option>
                                                @foreach ($purPurchaseOrders as $purPurchaseOrder)
                                                <option value="{{ $purPurchaseOrder->pur_order_id }}">
                                                    {{ $purPurchaseOrder->ref_num }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        {{-- ref num --}}
                                        <div class="col-md-4">
                                            <label for="ref_num">Refrence Number</label>
                                            <input type="text" name="ref_num" id="ref_num" class="form-control"
                                                placeholder="Refrence Number" value="{{ rand(2342234, 9898795) }}">
                                        </div>

                                        {{-- description --}}

                                        <div class="col-md-4">
                                            <label for="description">Description</label>
                                            <textarea name="description" id="description" cols="" rows="1"
                                                placeholder="Description" class="form-control"></textarea>
                                        </div>

                                        {{-- delivery date --}}
                                        <div class="col-md-4">
                                            <label for="delivery_date">Delivery Date</label>
                                            <input type="date" name="delivery_date" id="delivery_date"
                                                class="form-control">
                                        </div>
                                        {{-- creation date --}}
                                        <div class="col-md-4">
                                            <label for="creation_date">Creation Date</label>
                                            <input type="date" name="creation_date" id="creation_date"
                                                class="form-control">
                                        </div>
                                        {{-- creation time --}}
                                        <div class="col-md-4">
                                            <label for="creation_time">Creation Time</label>
                                            <input type="time" name="creation_time" id="creation_time"
                                                class="form-control">
                                        </div>
                                        
                                        {{-- invoice status --}}
                                        <div class="col-md-6">
                                            <label for="status"> Status </label>
                                            <select name="status" id="status"
                                                class="form-select status">
                                                <option></option>
                                                <option value="pending">Pending</option>
                                                <option value="delivered">Delivered</option>
                                                <option value="cancelled">Cancelled</option>
                                            </select>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <!-- user information end  -->

                            <!--  lable div end  -->
                            <div class="col-md-12">
                                <div class="parent">
                                    <div class="row">
                                        <div class="d-sm-flex justify-content-sm-between">
                                            <h5 class="">Delivery Note Details</h5>
                                            <div>

                                                <button type="button" class="btn btn-primary mb-0 add_item" id=""> <i
                                                        class="fa-solid fa-plus pe-2 "></i>Add
                                                    Item
                                                </button>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- lable div end  -->

                            <!-- quotation details start  -->
                            <div class="col-md-12 product_quotation_request_detail_parent mt-0 quotation_details">
                                <div class="parent">

                                    <div class="row gy-3">
                                        {{-- product_id --}}
                                        {{-- <div class="col-md-12 d-flex justify-content-end">
                                            <button type="button" class="text-secondary delete_item  bg-white "
                                                style="border:none;"><i class="fas fa-trash-alt fs-6 text-danger"></i>
                                            </button>
                                        </div> --}}
                                        <div class="col-md-6">
                                            <label for="product_id"> Select Product </label>
                                            <select name="product_id" id="product_id" class="form-select product_id">
                                                <option></option>
                                                @foreach ($products as $product)
                                                <option value="{{ $product->product_id }}">
                                                    {{ $product->product_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        {{-- quantity --}}
                                        <div class="col-md-6">
                                            <label for="quantity_first">Quantity</label>
                                            <input type="text" name="quantity" id="quantity_first"
                                                class="form-control quantity qty price_qty_keyup"
                                                placeholder="Quantity">
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- quotation details end  -->

                            <!-- button start  -->
                            <div class="col-md-12">
                                <div class="parent">
                                    <div class="row justify-content-end">
                                        <div class="col-md-2">

                                            <button type="submit" class="btn btn-primary  w-100" id="">Add
                                            </button>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- button end  -->

                        </div>
                    </div>
                </form>
            </div>
        </div>
        {{-- quotation request form start --}}

    </div>
</div>
@endSection
@section('page_script_links')
<script>
    $(document).ready(function () {


        function defaultSelect2(selectDropDown) { // pass selected element
            $(selectDropDown).val("").change();
            $(selectDropDown).prop('disabled', false)
            $(selectDropDown).find('option').each((key, value) => {
                $(value).prop('selected', false)
            })

        }

        @php
        $baseUrl = config('app.url');
                echo "var base_url = '".$baseUrl. "';";
        @endphp


        if ($(document).find('.product_id').length == 1) {

            $("#product_id").select2({
                placeholder: "Select Product",
                allowClear: true,
                width: "100%",
            });

            // hide select error on change when not null start 
            $('#product_id').on('change', function (param) {
                let product_idValue = $(this).val();
                if (product_idValue == "") {
                    $('#product_id-error').removeClass('d-none') // label
                } else {
                    $('#product_id-error').addClass('d-none') // label
                }
            })
            $('#supplier_id').on('change', function (param) {
                let supplier_idValue = $(this).val();
                if (supplier_idValue == "") {
                    $('#supplier_id-error').removeClass('d-none') // label
                } else {
                    $('#supplier_id-error').addClass('d-none') // label
                }
            })
            $("#supplier_id").select2({
                placeholder: "Select Supplier",
                allowClear: true,
                width: "100%",
            });
            // pqr
            $('#pur_order_id').on('change', function (param) {
                let pro_quotation_req_idValue = $(this).val();
                if (pro_quotation_req_idValue == "") {
                    $('#pur_order_id-error').removeClass('d-none') // label
                } else {
                    $('#pur_order_id-error').addClass('d-none') // label
                }
            })
            $("#pur_order_id").select2({
                placeholder: "Select PO",
                allowClear: true,
                width: "100%",
            });
            // status
            $('#status').on('change', function (param) {
                let statusValue = $(this).val();
                if (statusValue == "") {
                    $('#status-error').removeClass('d-none') // label
                } else {
                    $('#status-error').addClass('d-none') // label
                }
            })
            $("#status").select2({
                placeholder: "Select Status",
                allowClear: true,
                width: "100%",
            });
            // hide select error on change when not null end 


        }





        // append product details form to another start 
        let i = 0; //for naming and ids
        $('.add_item').on("click", function () {


            let quotationDetailsArray = $(".quotation_details")
            let lastQuotationDetail = quotationDetailsArray[quotationDetailsArray
                .length - 1];

            $(lastQuotationDetail).after(`<div class="col-md-12 quotation_details">
                                    <div class="parent">
                                        <div class="row gy-3">
                                            {{-- product_id --}}
                                             <div class="col-md-12 d-flex justify-content-end">
                                                <button  type="button"  class="text-secondary bg-white delete_item"  style="border:none;" ><i class="fas fa-trash-alt fs-6 text-danger"></i>
                                                </button>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="product_id_${i}"> Select Product </label>
                                                <select name="product_id_${i}" id="product_id_${i}" class="form-select product_id">
                                                    <option></option>
                                                    @foreach ($products as $product)
                                                        <option value="{{ $product->product_id }}">
                                                            {{ $product->product_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div> 
                
                                            {{-- quantity --}}
                                            <div class="col-md-6">
                                                <label for="quantity_${i}">Quantity</label>
                                                <input type="text" name="quantity_${i}" id="quantity_${i}" class="form-control quantity qty price_qty_keyup"
                                                    placeholder="Quantity">
                                            </div>
                                        </div>
                                    </div>
                                </div>`)





            // validation start---------------------------------------------------------------------
            $('#product_id_' + i).select2({
                placeholder: "Select Product",
                allowClear: true,
                width: "100%",
            })
            let productDropArray = $('.product_id');
            $(productDropArray).each(function (key, value) {
                $(value).on('change', function () {
                    if ($(value).next().hasClass('error')) {
                        let val = $(value).val()
                        if (val == "") {
                            $(value).next().removeClass('d-none')
                        } else {
                            $(value).next().addClass('d-none')

                        }
                    }

                })

            })
            // validation end-------------------------------------------------------------------------
            // delete quotation details start 
            $('.delete_item').on("click", function (e) {
                $(this).closest('.quotation_details').remove();
                e.stopPropagation();
            })

            // delete quotation details end 
            // add form end 
            i++;



        })
        // click  add_item end 

        // disable select filed fo taxes when select for full quotation product one will be disalbed and viceversa
        // append product details form to another end 
        $.validator.addClassRules({
            product_id: {
                required: true
            },
            qty: {
                required: true
            },

        })


        $("#pur_purchase_quotation_form").validate({
            rules: {
                ref_num: {
                    required: true,
                    number: true
                },
                creation_date: {
                    required: true,
                },
                creation_time: {
                    required: true,
                },
                supplier_id: {
                    required: true,
                },
                pur_order_id: {
                    required: true,
                },
                delivery_date: {
                    required: true
                },
                status: {
                    required: true
                }




            },
            messages: {
                ref_num: {
                    required: "Refrence Number required",
                    number: "Only Numbers are allowed",
                },
                creation_date: {
                    required: "Date required",
                },
                creation_time: {
                    required: "Time required",
                },
                supplier_id: {
                    required: 'Please select supplier',
                },
                pur_invoice_id: {
                    required: 'Please select Invoice',
                },
                delivery_date: {
                    required: "Delivery Date required"
                },
                status: {
                    required: "Status required"
                }


            },
            submitHandler: function (form) {

                // product ids start 
                let productIdsArray = [] // contain all the product ids


                if ($('.product_ids_array').length == 0) {
                    $('#pur_purchase_quotation_form').prepend(
                        `<input type="hidden" name="product_ids_array" id="product_ids_array" class="product_ids_array" value=${productIdsArray}>`
                    )
                }
                let productArray = $('.product_id');
                $(productArray).each(function (key, value) {
                    // console.log($(value).val());
                    productIdsArray.push($(value).val())
                })
                $('#product_ids_array').val(productIdsArray)
                // product ids end
                
                // product quantity start 
                let productQuantityArray = [] // contain all the product ids
                if ($('.product_quantity_array').length == 0) {
                    $('#pur_purchase_quotation_form').prepend(
                        `<input type="hidden" name="product_quantity_array" id="product_quantity_array" class="product_quantity_array" value=${productQuantityArray}>`
                    )
                }
                let quantityArray = $('.quantity');
                $(quantityArray).each(function (key, value) {
                    // console.log($(value).val());
                    productQuantityArray.push($(value).val())
                })
                $('#product_quantity_array').val(productQuantityArray)

                // product quantity end
                



                $.ajax({
                    type: "post",
                    url: base_url + "pur_delivery_note",
                    data: new FormData(form),
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response == 'true') {
                            // current
                            defaultSelect2($('#pur_order_id'))
                            defaultSelect2($('#supplier_id'))
                            defaultSelect2($('#status'))

                            $('.product_id').each((key, product) => {
                                defaultSelect2(product)
                            })

                            // select2-selection__rendered  /
                            $("#pur_purchase_quotation_form")
                                .trigger("reset");
                            $(".pur_purchase_quotation_added_message")
                                .removeClass("d-none");
                            window.scrollTo(0, 0)
                        }
                    },
                });
            },
        });


    });
</script>
@endSection
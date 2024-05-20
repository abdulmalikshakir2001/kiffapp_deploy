@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{ asset('dashboard_assets/purchase/css/pur_purchase_return.css') }}">
@endSection
@section('body_content')
<div class="row profile">
    <div class="col-md-12">
        {{-- quotation request form start --}}

        <div class="row">
            <div class="col-md-12">

                <form action="" id="pur_purchase_return_form">
                    <input type="hidden" name="pur_purchase_return_id" id="pur_purchase_return_id"
                        value="{{ $purPurchaseReturn->pur_purchase_return_id }}">
                    @csrf


                    <div class="container-fluid ">
                        <div class="row gy-4 profile_row">
                            <!--  lable div end  -->
                            <div class="col-md-12">
                                <div class="parent">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h5 class="">Update Purchase Return </h5>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="alert alert-success  d-none text-white pur_purchase_return_added_message user_updated_msg"
                                                role="alert" id="pur_purchase_return_added_message">
                                                Purchase Return Updated successfully
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
                                    <div class="d-sm-flex justify-content-sm-between mb-4">
                                        <h5 class="">Purchase Return </h5>
                                        
                                    </div>
                                    <div class="row gy-3">
                                        {{-- supplier --}}
                                        <div class="col-md-4">
                                            <label for="supplier_id"> Supplier Name </label>
                                            <select name="supplier_id" id="supplier_id" class="form-select supplier_id">
                                                <option></option>
                                                @foreach ($suppliers as $supplier)
                                                <option value="{{ $supplier->user_id }}" {{$purPurchaseReturn->
                                                    supplier_id==$supplier->user_id ?"selected":""}}
                                                    >{{ $supplier->username }}
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
                                                <option value="{{ $purPurchaseOrder->pur_order_id }}" {{$purPurchaseReturn->
                                                    pur_order_id==$purPurchaseOrder->pur_order_id
                                                    ?"selected":""}}
                                                    >
                                                    {{ $purPurchaseOrder->ref_num }}</option>
                                                @endforeach
                                            </select>
                                        </div>


                                        {{-- ref num --}}

                                        <div class="col-md-4">
                                            <label for="ref_num">Refrence Number</label>
                                            <input type="text" name="ref_num" id="ref_num" class="form-control"
                                                placeholder="Refrence Number" value="{{ $purPurchaseReturn->ref_num }}">
                                        </div>



                                        {{-- description --}}

                                        <div class="col-md-4">
                                            <label for="description">Description</label>
                                            <textarea name="description" id="description" cols="" rows="1"
                                                placeholder="Description"
                                                class="form-control">{{ $purPurchaseReturn->description }}</textarea>
                                        </div>

                                        {{-- creation date --}}
                                        <div class="col-md-4">
                                            <label for="creation_date">Creation Date</label>
                                            <input type="date" name="creation_date" id="creation_date"
                                                class="form-control" value="{{ $purPurchaseReturn->creation_date }}">
                                        </div>
                                        {{-- delivery date --}}
                                        <div class="col-md-4">
                                            <label for="delivery_date">Delivery Date</label>
                                            <input type="date" name="delivery_date" id="delivery_date"
                                                class="form-control" value="{{$purPurchaseReturn->delivery_date}}">
                                        </div>

                                        {{-- creation time --}}
                                        <div class="col-md-4">
                                            <label for="creation_time">Creation Time</label>
                                            <input type="time" name="creation_time" id="creation_time"
                                                class="form-control" value="{{ $purPurchaseReturn->creation_time }}">
                                        </div>
                                        
                                        {{--  status --}}
                                        <div class="col-md-6">
                                            <label for="_status"> Status </label>
                                            <select name="status" id="status"
                                                class="form-select status">
                                                <option></option>
                                                <option value="pending" {{$purPurchaseReturn->
                                                    status=="pending"?"selected":""}}
                                                    >Pending</option>
                                                <option value="delivered" {{$purPurchaseReturn->
                                                    status=="delivered"?"selected":""}}
                                                    >Delivered</option>
                                                <option value="cancelled" {{$purPurchaseReturn->
                                                    status=="cancelled"?"selected":""}}
                                                    >Cancelled</option>
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
                                            <h5 class="">Purchase Return Details</h5>



                                        </div>



                                    </div>
                                </div>
                            </div>
                            <!-- lable div end  -->



                            @php
                            $i = 0;
                            @endphp
                            @foreach ($purPurchaseReturn->details as $detail)
                            <!-- quotation details start  -->
                            <div class="col-md-12 product_quotation_request_detail_parent quotation_details">
                                <div class="parent">

                                    <div class="row gy-3">
                                        {{-- product_id --}}
                                        {{-- <div class="col-md-12 d-flex justify-content-end">
                                            <button type="button" class="text-secondary delete_item  bg-white "
                                                style="border:none;"><i class="fas fa-trash-alt fs-6 text-danger"></i>
                                            </button>
                                        </div> --}}
                                        <input type="hidden" name="detail_id" id="detail_id" class="detail_id"
                                            value="{{ $detail->pur_purchase_return_detail_id }}">
                                        <div class="col-md-6">
                                            <label for="product_id_{{ $i }}"> Select Product </label>
                                            <select name="product_id_{{ $i }}" id="product_id_{{ $i }}"
                                                class="form-select product_id">
                                                <option></option>
                                                @foreach ($products as $product)
                                                <option value="{{ $product->product_id }}" {{ $product->product_id ==
                                                    $detail->product_id ? 'selected' : '' }}>
                                                    {{ $product->product_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        {{-- quantity --}}
                                        <div class="col-md-6">
                                            <label for="quantity_{{ $i }}">Quantity</label>
                                            <input type="text" name="quantity_{{ $i }}" id="quantity_first_{{ $i }}"
                                                class="form-control quantity qty price_qty_keyup" placeholder="Quantity"
                                                value="{{ $detail->quantity }}">
                                        </div>

                                        


                                        

                                    </div>
                                </div>
                            </div>
                            <!-- quotation details end  -->

                            @php
                            $i++;
                            @endphp
                            @endforeach






                            <!-- button start  -->
                            <div class="col-md-12">
                                <div class="parent">
                                    <div class="row justify-content-end">
                                        <div class="col-md-2">

                                            <button type="submit" class="btn btn-primary  w-100" id="">Update
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
    
    function defaultSelect2(selectDropDown) { // pass selected element
        $(selectDropDown).val("").change();
        $(selectDropDown).prop('disabled', false)
        $(selectDropDown).find('option').each((key, value) => {
            $(value).prop('selected', false)
        })

    }
    
    $(document).ready(function () {
        @php
        $baseUrl = config('app.url');
                echo "var base_url = '".$baseUrl. "';";
        @endphp


        @php
        $inc = 0;
        @endphp
        @foreach($purPurchaseReturn -> details as $detail)


        $("#product_id_" + "{{ $inc }}").select2({
            placeholder: "Select Product",
            allowClear: true,
            width: "100%",
        });

        // hide select error on change when not null start 
        $('#product_id_' + "{{ $inc }}").on('change', function (param) {
            let product_idValue = $(this).val();
            if (product_idValue == "") {
                $('#product_id_' + "{{ $inc }}" + '-error').removeClass('d-none') // label
            } else {
                $('#product_id_' + "{{ $inc }}" + '-error').addClass('d-none') // label
            }
        })

        @php
        $inc++;
        @endphp
        @endforeach




        // supplier

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
            let pur_order_idValue = $(this).val();
            if (pur_order_idValue == "") {
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
















        $.validator.addClassRules({
            product_id: {
                required: true
            },
            qty: {
                required: true
            },

        })
        $("#pur_purchase_return_form").validate({
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
                pur_order_id: {
                    required: 'Please select PQR',
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
                    $('#pur_purchase_return_form').prepend(
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
                    $('#pur_purchase_return_form').prepend(
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
                // details id  start 
                let detailIdArray = [] // contain all the product ids
                if ($('.detail_id_array').length == 0) {
                    $('#pur_purchase_return_form').prepend(
                        `<input type="hidden" name="detail_id_array" id="detail_id_array" class="detail_id_array" value=${detailIdArray}>`
                    )
                }
                let detailArray = $('.detail_id');
                $(detailArray).each(function (key, value) {
                    // console.log($(value).val());


                    detailIdArray.push($(value).val())

                })
                $('#detail_id_array').val(detailIdArray)
                // details id  end

                $.ajax({
                    type: "post",
                    url: base_url + "pur_purchase_return_update",
                    data: new FormData(form),
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response == 'true') {
                            $(".pur_purchase_return_added_message")
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
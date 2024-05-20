@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{ asset('dashboard_assets/sale/css/sal_delivery_note.css') }}">
@endSection
@section('body_content')
<div class="row profile">
    <div class="col-md-12">
        {{-- quotation request form start --}}

        <div class="row">
            <div class="col-md-12">

                <form action="" id="sal_delivery_note_form">
                    <input disabled type="hidden" name="sal_delivery_note_id" id="sal_delivery_note_id"
                        value="{{ $salDeliveryNote->sal_delivery_note_id }}">
                    @csrf


                    <div class="container-fluid ">
                        <div class="row gy-4 profile_row">
<!--  lable div end  -->
<div class="col-md-12">
    <div class="parent">
        <div class="row position-relative">
            <div class="col-md-4">
                <h5 class="">Delivery Note Details</h5>
            </div>
            <div class="col-md-8 col-8 d-flex justify-content-end">
                <button type="button"
                    class="btn btn-sm bg-primary print_button letter-spacing text-white"
                    data-id="{{ $salDeliveryNote->sal_delivery_note_id }}"><i
                        class="fas fa-print"></i> print</button>
            </div>
            <div class="col-md-8 col-12 msg">
                <div class="alert alert-success d-none  text-white waitMessage" role="alert"
                    id="waitMessage">
                    Please wait..........request processing
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
                                        <h5 class="">Delivery Note </h5>
                                        
                                    </div>
                                    <div class="row gy-3">
                                        {{-- supplier --}}
                                        <div class="col-md-4">
                                            <label for="supplier_id"> Supplier Name </label>
                                            <select disabled name="supplier_id" id="supplier_id" class="form-select supplier_id">
                                                <option></option>
                                                @foreach ($suppliers as $supplier)
                                                <option value="{{ $supplier->user_id }}" {{$salDeliveryNote->
                                                    supplier_id==$supplier->user_id ?"selected":""}}
                                                    >{{ $supplier->username }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        {{-- po --}}
                                        <div class="col-md-4">
                                            <label for="sal_order_id"> select PO </label>
                                            <select disabled name="sal_order_id" id="sal_order_id"
                                                class="form-select sal_order_id">
                                                <option></option>
                                                @foreach ($salOrders as $salOrder)
                                                <option value="{{ $salOrder->sal_order_id }}" {{$salDeliveryNote->
                                                    sal_order_id==$salOrder->sal_order_id
                                                    ?"selected":""}}
                                                    >
                                                    {{ $salOrder->ref_num }}</option>
                                                @endforeach
                                            </select>
                                        </div>


                                        {{-- ref num --}}

                                        <div class="col-md-4">
                                            <label for="ref_num">Refrence Number</label>
                                            <input disabled type="text" name="ref_num" id="ref_num" class="form-control input_disabled "
                                                placeholder="Refrence Number" value="{{ $salDeliveryNote->ref_num }}">
                                        </div>



                                        {{-- description --}}

                                        <div class="col-md-4">
                                            <label for="description">Description</label>
                                            <textarea disabled name="description" id="description" cols="" rows="1"
                                                placeholder="Description"
                                                class="form-control input_disabled ">{{ $salDeliveryNote->description }}</textarea>
                                        </div>

                                        {{-- creation date --}}
                                        <div class="col-md-4">
                                            <label for="creation_date">Creation Date</label>
                                            <input disabled type="date" name="creation_date" id="creation_date"
                                                class="form-control input_disabled " value="{{ $salDeliveryNote->creation_date }}">
                                        </div>
                                        {{-- delivery date --}}
                                        <div class="col-md-4">
                                            <label for="delivery_date">Delivery Date</label>
                                            <input disabled type="date" name="delivery_date" id="delivery_date"
                                                class="form-control input_disabled " value="{{$salDeliveryNote->delivery_date}}">
                                        </div>

                                        {{-- creation time --}}
                                        <div class="col-md-4">
                                            <label for="creation_time">Creation Time</label>
                                            <input disabled type="time" name="creation_time" id="creation_time"
                                                class="form-control input_disabled " value="{{ $salDeliveryNote->creation_time }}">
                                        </div>
                                        
                                        {{--  status --}}
                                        <div class="col-md-6">
                                            <label for="_status"> Status </label>
                                            <select disabled name="status" id="status"
                                                class="form-select status">
                                                <option></option>
                                                <option value="pending" {{$salDeliveryNote->
                                                    status=="pending"?"selected":""}}
                                                    >Pending</option>
                                                <option value="delivered" {{$salDeliveryNote->
                                                    status=="delivered"?"selected":""}}
                                                    >Delivered</option>
                                                <option value="cancelled" {{$salDeliveryNote->
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
                                            <h5 class="">Product Details</h5>



                                        </div>



                                    </div>
                                </div>
                            </div>
                            <!-- lable div end  -->



                            @php
                            $i = 0;
                            @endphp
                            @foreach ($salDeliveryNote->details as $detail)
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
                                        <input disabled type="hidden" name="detail_id" id="detail_id" class="detail_id"
                                            value="{{ $detail->sal_delivery_note_detail_id }}">
                                        <div class="col-md-6">
                                            <label for="product_id_{{ $i }}"> Select Product </label>
                                            <select disabled name="product_id_{{ $i }}" id="product_id_{{ $i }}"
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
                                            <input disabled type="text" name="quantity_{{ $i }}" id="quantity_first_{{ $i }}"
                                                class="form-control input_disabled  quantity qty price_qty_keyup" placeholder="Quantity"
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
        @foreach($salDeliveryNote -> details as $detail)


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
        $('#sal_order_id').on('change', function (param) {
            let sal_order_idValue = $(this).val();
            if (sal_order_idValue == "") {
                $('#sal_order_id-error').removeClass('d-none') // label
            } else {
                $('#sal_order_id-error').addClass('d-none') // label
            }
        })
        $("#sal_order_id").select2({
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





         //  crm lead details print start
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click', '.print_button', function () {
            // alert($(this).data('user_id'))
            let id = $(this).data('id')
            $.ajax({
                type: "post",
                url: base_url + "sal_delivery_note_url",
                data: {
                    id: id
                },
                dataType: "json",
                success: function (response) {

                    $('.waitMessage').removeClass('d-none')
                    if ($('#emp_details_iframe').length === 0) {
                        let iframe = document.createElement('iframe')
                        iframe.setAttribute('id', "emp_details_iframe")
                        iframe.setAttribute('class', "d-none")
                        iframe.setAttribute('src', response)
                        $('body').append(iframe)
                        iframe.onload = function (param) {
                            $('.waitMessage').addClass('d-none')
                            iframe.contentWindow.print();
                        }
                    } else {
                        let iframe = $('#emp_details_iframe')[0]
                        //   iframe.setAttribute('src', "data:application/pdf;base64," + response)
                        iframe.setAttribute('src', response)
                        iframe.onload = function (param) {
                            $('.waitMessage').addClass('d-none')
                            iframe.contentWindow.print();
                        }
                    }
                }
            });

        })

        // crm lead details print end 

















        
    });
</script>
@endSection
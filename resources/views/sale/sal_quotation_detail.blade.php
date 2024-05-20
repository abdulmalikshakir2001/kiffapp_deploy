@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{ asset('dashboard_assets/sale/css/sal_quotation.css') }}">
@endSection
@section('body_content')
<div class="row profile">
    <div class="col-md-12">
        {{-- quotation request form start --}}

        <div class="row">
            <div class="col-md-12">

                <form action="" id="sal_quotation_form">
                    <input disabled type="hidden" name="sal_quotation_id" id="sal_quotation_id"
                        value="{{ $salQuotation->sal_quotation_id }}">
                    @csrf


                    <div class="container-fluid ">
                        <div class="row gy-4 profile_row">
                            <!--  lable div end  -->
                            <div class="col-md-12">
                                <div class="parent">
                                    <div class="row position-relative">
                                        <div class="col-md-4">
                                            <h5 class="">Sale Quotation Details</h5>
                                        </div>
                                        <div class="col-md-8 col-8 d-flex justify-content-end">
                                            <button type="button"
                                                class="btn btn-sm bg-primary print_button letter-spacing text-white"
                                                data-id="{{ $salQuotation->sal_quotation_id }}"><i
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
                                    <h5 class="">Sale Quotation </h5>
                                    <div class="row gy-3">
                                        {{-- supplier --}}
                                        <div class="col-md-4">
                                            <label for="supplier_id"> Supplier Name </label>
                                            <select disabled name="supplier_id" id="supplier_id"
                                                class="form-select supplier_id">
                                                <option></option>
                                                @foreach ($suppliers as $supplier)
                                                <option value="{{ $supplier->user_id }}" {{ $salQuotation->
                                                    supplier_id == $supplier->user_id ? 'selected' : '' }}>
                                                    {{ $supplier->username }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        
                                        {{-- ref num --}}

                                        <div class="col-md-4">
                                            <label for="ref_num">Refrence Number</label>
                                            <input disabled type="text" name="ref_num" id="ref_num"
                                                class="form-control input_disabled" placeholder="Refrence Number"
                                                value="{{ $salQuotation->ref_num }}">
                                        </div>



                                        {{-- description --}}

                                        <div class="col-md-4">
                                            <label for="description">Description</label>
                                            <textarea disabled name="description" id="description" cols="" rows="1"
                                                placeholder="Description"
                                                class="form-control input_disabled">{{ $salQuotation->description }}</textarea>
                                        </div>

                                        {{-- creation date --}}
                                        <div class="col-md-4">
                                            <label for="creation_date">Creation Date</label>
                                            <input disabled type="date" name="creation_date" id="creation_date"
                                                class="form-control input_disabled"
                                                value="{{ $salQuotation->creation_date }}">
                                        </div>
                                        {{-- delivery date --}}
                                        <div class="col-md-4">
                                            <label for="delivery_date">Delivery Date</label>
                                            <input disabled type="date" name="delivery_date" id="delivery_date"
                                                class="form-control input_disabled"
                                                value="{{ $salQuotation->delivery_date }}">
                                        </div>

                                        {{-- creation time --}}
                                        <div class="col-md-4">
                                            <label for="creation_time">Creation Time</label>
                                            <input disabled type="time" name="creation_time" id="creation_time"
                                                class="form-control input_disabled"
                                                value="{{ $salQuotation->creation_time }}">
                                        </div>
                                        {{-- taxes --}}
                                        <div class="col-md-6">
                                            <label for="taxes"> Taxes

                                            </label>
                                            <select disabled name="taxes" id="taxes" class="form-select taxes"
                                                multiple="multiple">

                                                <option></option>
                                                @php
                                                $taxesArray = explode(',', $salQuotation->taxes);
                                                @endphp
                                                @foreach ($taxes as $tax)
                                                <option value="{{ $tax->tax_name }}" {{ in_array($tax->tax_name,
                                                    $taxesArray) ? 'selected' : '' }}>
                                                    {{ $tax->tax_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        {{-- quotation status --}}
                                        <div class="col-md-6">
                                            <label for="quotation_status"> Status </label>
                                            <select disabled name="quotation_status" id="quotation_status"
                                                class="form-select quotation_status">
                                                <option></option>
                                                <option value="pending" {{ $salQuotation->quotation_status ==
                                                    'pending' ? 'selected' : '' }}>
                                                    Pending</option>
                                                <option value="approved" {{ $salQuotation->quotation_status ==
                                                    'approved' ? 'selected' : '' }}>
                                                    Approved</option>
                                                <option value="rejected" {{ $salQuotation->quotation_status ==
                                                    'rejected' ? 'selected' : '' }}>
                                                    Rejected</option>
                                            </select>
                                        </div>
                                        {{-- <div class="col-md-2">
                                            <label for=""></label>
                                            <button type="submit" class="btn btn-primary  w-100" id="">Add
                                            </button>
                                        </div> --}}


                                    </div>
                                </div>
                            </div>
                            <!-- user information end  -->



                            <!--  lable div end  -->
                            <div class="col-md-12">
                                <div class="parent">
                                    <div class="row">
                                        <div class="d-sm-flex justify-content-sm-between">
                                            <h5 class="">Sale Quotation Details</h5>

                                            {{-- <button type="button" class="btn btn-primary add_item " id=""> <i
                                                    class="fa-solid fa-plus pe-2 "></i>Add Item
                                            </button> --}}
                                        </div>



                                    </div>
                                </div>
                            </div>
                            <!-- lable div end  -->



                            @php
                            $i = 0;
                            @endphp
                            @foreach ($salQuotation->details as $detail)
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
                                            value="{{ $detail->sal_quotation_detail_id }}">
                                        <div class="col-md-4">
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
                                        {{-- unit price --}}

                                        <div class="col-md-4">
                                            <label for="unit_price_{{ $i }}">Unit Price</label>
                                            <input disabled type="text" name="unit_price_{{ $i }}"
                                                id="unit_price_{{ $i }}" class="form-control input_disabled unit_price"
                                                placeholder="Unit Price" value="{{ $detail->unit_price }}">
                                        </div>
                                        {{-- quantity --}}
                                        <div class="col-md-4">
                                            <label for="quantity_{{ $i }}">Quantity</label>
                                            <input disabled type="text" name="quantity_{{ $i }}"
                                                id="quantity_first_{{ $i }}"
                                                class="form-control input_disabled quantity qty" placeholder="Quantity"
                                                value="{{ $detail->quantity }}">
                                        </div>

                                        {{-- Discount --}}
                                        <div class="col-md-4">
                                            <label for="discount">Discount</label>
                                            <input disabled type="text" name="discount" id="discount"
                                                class="form-control input_disabled discount" placeholder="Discount"
                                                value="{{ $detail->discount }}">
                                        </div>







                                        {{-- taxes --}}
                                        <div class="col-md-8">
                                            <label for="pro_taxes_{{ $i }}"> Taxes </label>
                                            <select disabled name="pro_taxes_{{ $i }}" id="pro_taxes_{{ $i }}"
                                                class="form-select pro_taxes" multiple="multiple">

                                                <option></option>
                                                @php
                                                $proTaxesArray = explode(',', $detail->pro_taxes);
                                                print_r($proTaxesArray);
                                                @endphp
                                                @foreach ($taxes as $tax)
                                                <option value="{{ $tax->tax_name }}" {{ in_array($tax->tax_name,
                                                    $proTaxesArray) ? 'selected' : '' }}>
                                                    {{ $tax->tax_name }}
                                                </option>
                                                @endforeach
                                            </select>
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
    $(document).ready(function () {


        @php
        $baseUrl = config('app.url');
                echo "var base_url = '".$baseUrl. "';";
        @endphp


        $("#taxes").select2({
            placeholder: "Select Taxes",
            allowClear: true,
            width: "100%",
        });
        $('#taxes').on('change', function (param) {
            let taxesValue = $(this).val();
            if (taxesValue == "") {
                $('#taxes-error').removeClass('d-none') // label
            } else {
                $('#taxes-error').addClass('d-none') // label
            }
        })

        @php
        $inc = 0;
        @endphp
        @foreach($salQuotation -> details as $detail)

        $("#pro_taxes_" + "{{ $inc }}").select2({
            placeholder: "Select Taxes",
            allowClear: true,
            width: "100%",
        });
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
        
        // status
        $('#quotation_status').on('change', function (param) {
            let quotation_statusValue = $(this).val();
            if (quotation_statusValue == "") {
                $('#quotation_status-error').removeClass('d-none') // label
            } else {
                $('#quotation_status-error').addClass('d-none') // label
            }
        })
        $("#quotation_status").select2({
            placeholder: "Select Status",
            allowClear: true,
            width: "100%",
        });

        // hide select error on change when not null end 



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
                url: base_url + "sal_quotation_url",
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
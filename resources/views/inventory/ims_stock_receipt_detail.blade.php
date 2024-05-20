@extends('dashboard/nav_footer')
@section('page_header_links')
    <link rel="stylesheet" href="{{ asset('dashboard_assets/inventory/css/ims_stock_request.css') }}">
@endSection
@section('body_content')
    <div class="row profile">
        <div class="col-md-12">
            {{-- quotation request form  start --}}

            <div class="row">
                <div class="col-md-12">
                    <form action="" id="ims_stock_request_form">
                        <input disabled  type="hidden" name="ims_stock_request_id" id="ims_stock_request_id" value="{{$ims_stock_request->ims_stock_request_id}}">
                        @csrf


                        <div class="container-fluid ">
                            <div class="row gy-4 profile_row">
                                <!--  lable div end  -->
                                <div class="col-md-12">
                                    <div class="parent">
                                        <div class="row position-relative">
                                            <div class="col-md-4">
                                                <h5 class="">Stock Receipt Details</h5>
                                            </div>
                                            <div class="col-md-8 col-8 d-flex justify-content-end">
                                                <button type="button"
                                                    class="btn btn-sm bg-primary print_button letter-spacing text-white"
                                                    data-id="{{ $ims_stock_request->ims_stock_request_id }}"><i class="fas fa-print"></i>
                                                    print</button>
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
                                        <h5 class="">Stock Receipt </h5>
                                        <div class="row gy-3">

                                            {{-- ref num --}}
                         
                                            <div class="col-md-4">
                                                <label for="ref_num">Refrence Number</label>
                                                <input disabled  type="text" name="ref_num" id="ref_num" class="form-control input_disabled "
                                                    placeholder="Refrence Number" value="{{ $ims_stock_request->ref_num }}">
                                            </div>

                                            {{-- description --}}

                                            <div class="col-md-4">
                                                <label for="description">Description</label>
                                                <textarea disabled  name="description" id="description" cols="" rows="1" placeholder="Description"
                                                    class="form-control input_disabled ">{{ $ims_stock_request->description }}</textarea>
                                            </div>

                         <!-- status -->
                         <div class="col-md-4">
                            <label for="status"> Status </label>
                            <select disabled  name="status" id="status" class="form-select input_disabled  status">
                                <option></option>
                                <option value="pending"
                                {{$ims_stock_request->status=='pending'?"selected":""}}
                                >Pending</option>
                                <option value="processing"
                                {{$ims_stock_request->status=='processing'?"selected":""}}
                                >Processing</option>


                                <option value="approved"
                                {{$ims_stock_request->status=='approved'?"selected":""}}
                                >Approved</option>
                                
                            </select>
                        </div>
                        <!-- ware house (request from) -->
                        <div class="col-md-4">
                            <label for="stock_request_from"> Stock Receipt From </label>
                            <select disabled  name="stock_request_from" id="stock_request_from" class="form-select input_disabled  stock_request_from">
                                <option></option>
                                @foreach($warehouses as $warehouse)
                                <option value={{$warehouse->warehouse_id}}
                                    {{$ims_stock_request->stock_request_from==$warehouse->warehouse_id?"selected":""}}
                                    
                                    > {{$warehouse->warehouse_name}}</option>
                                @endforeach
                                
                            </select>
                        </div>
                        <!-- ware house (request to) -->
                        <div class="col-md-4">
                            <label for="stock_request_to"> Stock Receipt To </label>
                            <select disabled  name="stock_request_to" id="stock_request_to" class="form-select input_disabled  stock_request_to">
                                <option></option>
                                @foreach($warehouses as $warehouse)
                                <option value={{$warehouse->warehouse_id}}
                                    {{$ims_stock_request->stock_request_to==$warehouse->warehouse_id?"selected":""}}
                                    > {{$warehouse->warehouse_name}}</option>
                                @endforeach
                                
                            </select>
                        </div>
                        <!-- employee (stock request by) -->
                        <div class="col-md-4">
                            <label for="employee_id"> Stock Receipt By </label>
                            <select disabled  name="employee_id" id="employee_id" class="form-select input_disabled  employee_id">
                                <option></option>
                                @foreach($employees as $employee)
                                <option value={{$employee->user_id}}
                                    {{$ims_stock_request->employee_id==$employee->user_id?"selected":""}}
                                    > {{$employee->username}}</option>
                                @endforeach
                                
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
                                                <h5 class="">Stock Receipt Details</h5>

                                                {{-- <button type="button" class="btn btn-primary add_item " id=""> <i
                                                        class="fa-solid fa-plus pe-2 "></i>Add Item
                                                </button> --}}
                                            </div>



                                        </div>
                                    </div>
                                </div>
                                <!-- lable div end  -->



                                   @php
                                   $i=0;
                                   @endphp
                                   @foreach($ims_stock_request->details as $detail)

                                <!-- quotation details start  -->
                                <div class="col-md-12 product_quotation_request_detail_parent quotation_details">
                                    <div class="parent">

                                        <div class="row gy-3">
                                            {{-- product_id --}}
                                            {{-- <div class="col-md-12 d-flex justify-content-end">
                                                <button  type="button"  class="text-secondary delete_item  bg-white "  style="border:none;" ><i class="fas fa-trash-alt fs-6 text-danger"></i>
                                                </button>
                                            </div> --}}
                                            <input disabled  type="hidden" name="detail_id" id="detail_id" class="detail_id" value="{{$detail->ims_stock_request_detail_id}}">
                                            <div class="col-md-6">
                                                <label for="product_id_{{$i}}"> Select Product </label>
                                                <select disabled  name="product_id_{{$i}}" id="product_id_{{$i}}" class="form-select input_disabled  product_id">
                                                    <option></option>
                                                    @foreach ($products as $product)
                                                        <option value="{{ $product->product_id }}"
                                                            {{$product->product_id==$detail->product_id?"selected":""}}
                                                            
                                                            >
                                                            {{ $product->product_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            
                                            {{-- quantity --}}
                                            <div class="col-md-6">
                                                <label for="quantity_{{$i}}">Quantity</label>
                                                <input disabled  type="text" name="quantity_{{$i}}" id="quantity_first_{{$i}}"
                                                    class="form-control input_disabled  quantity qty" placeholder="Quantity"
                                                    value="{{$detail->quantity}}"
                                                    >
                                            </div>

                                            







                                            {{-- taxes --}}
                                            <div class="col-md-8 d-none">
                                                <label for="pro_taxes_{{$i}}"> Taxes </label>
                                                <select disabled  name="pro_taxes_{{$i}}" id="pro_taxes_{{$i}}" class="form-select input_disabled  pro_taxes"
                                                    multiple="multiple">

                                                    <option></option>
                                                    @php 
                                                    $proTaxesArray= explode(',',$detail->pro_taxes);
                                                    print_r($proTaxesArray);
                                                    @endphp
                                                    @foreach ($taxes as $tax)
                                                        <option value="{{ $tax->tax_name }}"
                                                            {{in_array($tax->tax_name,$proTaxesArray)?"selected":""}}
                                                            >{{ $tax->tax_name }}
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
            {{-- quotation request form  start --}}

            {{-- product quotation req  details form start --}}
            <div class="row">
                <div class="col-md-12">

                    <form action="" id="ims_stock_request_details_form">
                        @csrf


                        <div class="container-fluid ">
                            <div class="row gy-4 profile_row">



                            </div>
                        </div>
                    </form>

                </div>
            </div>
            {{-- product quotation req  details form start --}}





        </div>
    </div>
@endSection
@section('page_script_links')
    <script>
        $(document).ready(function() {


            @php
                $baseUrl = config('app.url');
                echo "var base_url = '" . $baseUrl . "';";
            @endphp


            $("#taxes").select2({
                placeholder: "Select Taxes",
                allowClear: true,
                width: "100%",
            });
            $('#taxes').on('change', function(param) {
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
            @foreach ($ims_stock_request->details as $detail)

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
                $('#product_id_' + "{{ $inc }}").on('change', function(param) {
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
            // hide select error on change when not null end 




            //  crm lead details print start
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click', '.print_button', function() {
                // alert($(this).data('user_id'))
                let id = $(this).data('id')
                $.ajax({
                    type: "post",
                    url: base_url + "ims_stock_receipt_url",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {
                        $('.waitMessage').removeClass('d-none')
                        if ($('#emp_details_iframe').length === 0) {
                            let iframe = document.createElement('iframe')
                            iframe.setAttribute('id', "emp_details_iframe")
                            iframe.setAttribute('class', "d-none")
                            iframe.setAttribute('src', response)
                            $('body').append(iframe)
                            iframe.onload = function(param) {
                                $('.waitMessage').addClass('d-none')
                                iframe.contentWindow.print();
                            }
                        } else {
                            let iframe = $('#emp_details_iframe')[0]
                            //   iframe.setAttribute('src', "data:application/pdf;base64," + response)
                            iframe.setAttribute('src', response)
                            iframe.onload = function(param) {
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

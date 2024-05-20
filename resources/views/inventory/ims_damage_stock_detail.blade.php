@extends('dashboard/nav_footer')
@section('page_header_links')
    <link rel="stylesheet" href="{{ asset('dashboard_assets/inventory/css/ims_damage_stock.css') }}">
@endSection
@section('body_content')
    <div class="row profile">
        <div class="col-md-12">
            {{-- quotation request form  start --}}

            <div class="row">
                <div class="col-md-12">
                    <form action="" id="ims_damage_stock_form">
                        <input disabled  type="hidden" name="ims_damage_stock_id" id="ims_damage_stock_id" value="{{$ims_damage_stock->ims_damage_stock_id}}">
                        @csrf


                        <div class="container-fluid ">
                            <div class="row gy-4 profile_row">
                                <!--  lable div end  -->
                                <div class="col-md-12">
                                    <div class="parent">
                                        <div class="row position-relative">
                                            <div class="col-md-4">
                                                <h5 class="">Damage Stock  Details</h5>
                                            </div>
                                            <div class="col-md-8 col-8 d-flex justify-content-end">
                                                <button type="button"
                                                    class="btn btn-sm bg-primary print_button letter-spacing text-white"
                                                    data-id="{{ $ims_damage_stock->ims_damage_stock_id }}"><i class="fas fa-print"></i>
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
                                        <h5 class="">Damage Stock  </h5>
                                        <div class="row gy-3">

                                            {{-- ref num --}}
                         
                                            <div class="col-md-6">
                                                <label for="ref_num">Refrence Number</label>
                                                <input disabled  type="text" name="ref_num" id="ref_num" class="form-control input_disabled "
                                                    placeholder="Refrence Number" value="{{ $ims_damage_stock->ref_num }}">
                                            </div>

                                            {{-- description --}}

                                            <div class="col-md-6">
                                                <label for="description">Description</label>
                                                <textarea disabled  name="description" id="description" cols="" rows="1" placeholder="Description"
                                                    class="form-control input_disabled ">{{ $ims_damage_stock->description }}</textarea>
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
                                                <h5 class="">Damage Stock  Details</h5>

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
                                   @foreach($ims_damage_stock->details as $detail)

                                <!-- quotation details start  -->
                                <div class="col-md-12 product_quotation_request_detail_parent quotation_details">
                                    <div class="parent">

                                        <div class="row gy-3">
                                            {{-- product_id --}}
                                            {{-- <div class="col-md-12 d-flex justify-content-end">
                                                <button  type="button"  class="text-secondary delete_item  bg-white "  style="border:none;" ><i class="fas fa-trash-alt fs-6 text-danger"></i>
                                                </button>
                                            </div> --}}
                                            <input disabled  type="hidden" name="detail_id" id="detail_id" class="detail_id" value="{{$detail->ims_damage_stock_detail_id}}">
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
            @foreach ($ims_damage_stock->details as $detail)

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
                    url: base_url + "ims_damage_stock_url",
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

@extends('dashboard/nav_footer')
@section('page_header_links')
    <link rel="stylesheet" href="{{ asset('dashboard_assets/purchase/css/pur_pro_quotation_req.css') }}">
@endSection
@section('body_content')
    <div class="row profile">
        <div class="col-md-12">
            {{-- quotation request form  start --}}

            <div class="row">
                <div class="col-md-12">

                    <form action="" id="pro_quotation_req_form">
                        <input type="hidden" name="pro_quotation_req_id" id="pro_quotation_req_id" value="{{$pro_quotation_req->pro_quotation_req_id}}">
                        @csrf


                        <div class="container-fluid ">
                            <div class="row gy-4 profile_row">
                                <!--  lable div end  -->
                                <div class="col-md-12">
                                    <div class="parent">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h5 class="">Update Quotation Request</h5>
                                            </div>

                                            <div class="col-md-8">
                                                <div class="alert alert-success  d-none text-white pro_quotation_req_added_message user_updated_msg"
                                                    role="alert" id="pro_quotation_req_added_message">
                                                    Quotation Request Updated successfully
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
                                        <h5 class="">Quotation Request </h5>
                                        <div class="row gy-3">

                                            {{-- ref num --}}
                                            {{-- creation time --}}
                                            <div class="col-md-4">
                                                <label for="ref_num">Refrence Number</label>
                                                <input type="text" name="ref_num" id="ref_num" class="form-control"
                                                    placeholder="Refrence Number" value="{{ $pro_quotation_req->ref_num }}">
                                            </div>

                                            {{-- description --}}

                                            <div class="col-md-4">
                                                <label for="description">Description</label>
                                                <textarea name="description" id="description" cols="" rows="1" placeholder="Description"
                                                    class="form-control">{{ $pro_quotation_req->description }}</textarea>
                                            </div>

                                            {{-- creation date  --}}
                                            <div class="col-md-4">
                                                <label for="creation_date">Creation Date</label>
                                                <input type="date" name="creation_date" id="creation_date"
                                                    class="form-control" value="{{ $pro_quotation_req->creation_date }}">
                                            </div>
                                            {{-- creation time --}}
                                            <div class="col-md-4">
                                                <label for="creation_time">Creation Time</label>
                                                <input type="time" name="creation_time" id="creation_time"
                                                    class="form-control" value="{{ $pro_quotation_req->creation_time }}">
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
                                                <h5 class="">Quotation Request Details</h5>

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
                                   @foreach($pro_quotation_req->details as $detail)

                                <!-- quotation details start  -->
                                <div class="col-md-12 product_quotation_request_detail_parent quotation_details">
                                    <div class="parent">

                                        <div class="row gy-3">
                                            {{-- product_id --}}
                                            {{-- <div class="col-md-12 d-flex justify-content-end">
                                                <button  type="button"  class="text-secondary delete_item  bg-white "  style="border:none;" ><i class="fas fa-trash-alt fs-6 text-danger"></i>
                                                </button>
                                            </div> --}}
                                            <input type="hidden" name="detail_id" id="detail_id" class="detail_id" value="{{$detail->pro_quotation_req_detail_id}}">
                                            <div class="col-md-6">
                                                <label for="product_id_{{$i}}"> Select Product </label>
                                                <select name="product_id_{{$i}}" id="product_id_{{$i}}" class="form-select product_id">
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
                                                <input type="text" name="quantity_{{$i}}" id="quantity_first_{{$i}}"
                                                    class="form-control quantity qty" placeholder="Quantity"
                                                    value="{{$detail->quantity}}"
                                                    >
                                            </div>

                                            







                                            {{-- taxes --}}
                                            <div class="col-md-8 d-none">
                                                <label for="pro_taxes_{{$i}}"> Taxes </label>
                                                <select name="pro_taxes_{{$i}}" id="pro_taxes_{{$i}}" class="form-select pro_taxes"
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
            {{-- quotation request form  start --}}

            {{-- product quotation req  details form start --}}
            <div class="row">
                <div class="col-md-12">

                    <form action="" id="pro_quotation_req_details_form">
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
                  $inc=0;
                  @endphp
                @foreach($pro_quotation_req->details as $detail)

                $("#pro_taxes_"+"{{$inc}}").select2({
                    placeholder: "Select Taxes",
                    allowClear: true,
                    width: "100%",
                });
                $("#product_id_"+"{{$inc}}").select2({
                    placeholder: "Select Product",
                    allowClear: true,
                    width: "100%",
                });

                // hide select error on change when not null start 
                $('#product_id_'+"{{$inc}}").on('change', function(param) {
                    let product_idValue = $(this).val();
                    if (product_idValue == "") {
                        $('#product_id_'+"{{$inc}}"+'-error').removeClass('d-none') // label
                    } else {
                        $('#product_id_'+"{{$inc}}"+'-error').addClass('d-none') // label
                    }
                })
                
                @php 
                  $inc++;
                  @endphp

                @endforeach
                // hide select error on change when not null end 






            // append product details form to another start 
            let i = 0; //for naming and ids
            $('.add_item').on("click", function() {
                let quotationDetailsArray = $(".quotation_details")
                let lastQuotationDetail = quotationDetailsArray[quotationDetailsArray.length - 1];

                $(lastQuotationDetail).after(`<div class="col-md-12 quotation_details">
                                    <div class="parent">
                                        <div class="row gy-3">
                                            {{-- product_id --}}
                                             <div class="col-md-12 d-flex justify-content-end">
                                                <button  type="button"  class="text-secondary bg-white delete_item"  style="border:none;" ><i class="fas fa-trash-alt fs-6 text-danger"></i>
                                                </button>
                                            </div>
                                            <div class="col-md-4">
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
                                            <div class="col-md-4">
                                                <label for="quantity_${i}">Quantity</label>
                                                <input type="text" name="quantity_${i}" id="quantity_${i}" class="form-control quantity qty"
                                                    placeholder="Quantity">
                                            </div>

                                            

                                            {{-- taxes --}}
                                            <div class="col-md-8 d-none">
                                                <label for="pro_taxes_${i}"> Taxes </label>
                                                <select name="pro_taxes_${i}" id="pro_taxes_${i}" class="form-select pro_taxes"
                                                    multiple="multiple">
                                                    <option></option>
                                                    @foreach ($taxes as $tax)
                                                        <option value="{{ $tax->tax_name }}">{{ $tax->tax_name }}</option>
                                                    @endforeach
                                                </select>
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
                $(productDropArray).each(function(key, value) {




                    $(value).on('change', function() {
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








                $('#pro_taxes_' + i).select2({
                    placeholder: "Select Taxes",
                    allowClear: true,
                    width: "100%",

                })
                $(`#pro_taxes_${i}`).on('change', function(param) {
                    let pro_taxesValue = $(this).val();
                    if (pro_taxesValue == "") {
                        $(`#pro_taxes_${i}-error`).removeClass('d-none') // label
                    } else {
                        $(`#pro_taxes_${i}-error`).addClass('d-none') // label
                    }
                })
                // validation end-------------------------------------------------------------------------




                // delete quotation details start 
                $('.delete_item').on("click", function(e) {
                    $(this).closest('.quotation_details').remove();
                    e.stopPropagation();
                })

                // delete quotation details end 

                // taxes start 








                // add form end 


                i++;








            })
            // append product details form to another end 
            $.validator.addClassRules({
                product_id: {
                    required: true
                },
                qty: {
                    required: true
                },
                unit_price: {
                    required: true
                }
            })
            $("#pro_quotation_req_form").validate({
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
                },
                submitHandler: function(form) {
                    // product ids start 
                    let productIdsArray = [] // contain all the product ids


                    if ($('.product_ids_array').length == 0) {
                        $('#pro_quotation_req_form').prepend(
                            `<input type="hidden" name="product_ids_array" id="product_ids_array" class="product_ids_array" value=${productIdsArray}>`
                        )
                    }
                    let productArray = $('.product_id');
                    $(productArray).each(function(key, value) {
                        // console.log($(value).val());
                        productIdsArray.push($(value).val())
                    })
                    $('#product_ids_array').val(productIdsArray)
                    // product ids end
                    // product quantity start 
                    let productQuantityArray = [] // contain all the product ids
                    if ($('.product_quantity_array').length == 0) {
                        $('#pro_quotation_req_form').prepend(
                            `<input type="hidden" name="product_quantity_array" id="product_quantity_array" class="product_quantity_array" value=${productQuantityArray}>`
                        )
                    }
                    let quantityArray = $('.quantity');
                    $(quantityArray).each(function(key, value) {
                        // console.log($(value).val());
                        productQuantityArray.push($(value).val())
                    })
                    $('#product_quantity_array').val(productQuantityArray)

                    // product quantity end
                    // Unit  start 
                    let productUnitPriceArray = [] // contain all the product ids
                    if ($('.product_unit_price_array').length == 0) {
                        $('#pro_quotation_req_form').prepend(
                            `<input type="hidden" name="product_unit_price_array" id="product_unit_price_array" class="product_unit_price_array" value=${productUnitPriceArray}>`
                        )
                    }
                    let unitPriceArray = $('.unit_price');
                    $(unitPriceArray).each(function(key, value) {
                        // console.log($(value).val());
                        productUnitPriceArray.push($(value).val())
                    })
                    $('#product_unit_price_array').val(productUnitPriceArray)
                    // Unit end
                    // discount  start 
                    let productDiscountArray = [] // contain all the product ids
                    if ($('.product_discount_array').length == 0) {
                        $('#pro_quotation_req_form').prepend(
                            `<input type="hidden" name="product_discount_array" id="product_discount_array" class="product_discount_array" value=${productDiscountArray}>`
                        )
                    }
                    let discountArray = $('.discount');
                    $(discountArray).each(function(key, value) {
                        // console.log($(value).val());
                        if ($(value).val() == "") {
                            productDiscountArray.push('0')
                        } else {

                            productDiscountArray.push($(value).val())
                        }

                    })
                    $('#product_discount_array').val(productDiscountArray)
                    // discount end

                    // details id  start 
                    let detailIdArray = [] // contain all the product ids
                    if ($('.detail_id_array').length == 0) {
                        $('#pro_quotation_req_form').prepend(
                            `<input type="hidden" name="detail_id_array" id="detail_id_array" class="detail_id_array" value=${detailIdArray}>`
                        )
                    }
                    let detailArray = $('.detail_id');
                    $(detailArray).each(function(key, value) {
                        // console.log($(value).val());
                        

                        detailIdArray.push($(value).val())

                    })
                    $('#detail_id_array').val(detailIdArray)
                    // details id  end
                    // pro_taxes  start 
                    let productTaxesArray = {} // contain all the product ids
                    if ($('.product_taxes_array').length == 0) {
                        $('#pro_quotation_req_form').prepend(
                            `<input type="hidden" name="product_taxes_array" id="product_taxes_array" class="product_taxes_array" value="${productTaxesArray}">`
                        )
                    }
                    let taxesArray = $('.pro_taxes');
                    let t = 0;
                    $(taxesArray).each(function(key, value) {
                        // console.log($(value).val());
                        if ($(value).val() == "") {
                            productTaxesArray['tax_' + t] = 'NULL';




                        } else {
                            productTaxesArray['tax_' + t] = $(value).val().join(
                                ',');



                        }
                        t++;

                    })
                    $('#product_taxes_array').val(JSON.stringify(productTaxesArray))
                    console.log(productTaxesArray);
                    // pro_taxes end

                    // taxes start 
                    if ($('.taxes_main').length == 0) {
                        $('#pro_quotation_req_form').prepend(
                            `<input type="hidden" name="taxes_main" id="taxes_main" class="taxes_main">`
                        )
                    }
                    $('#taxes_main').val($('#taxes').val())
                    // taxes end



                    $.ajax({
                        type: "post",
                        url: base_url + "pro_quotation_req_update",
                        data: new FormData(form),
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response == 'true') {
                                $("#pro_quotation_req_form").trigger("reset");
                                $(".pro_quotation_req_added_message")
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

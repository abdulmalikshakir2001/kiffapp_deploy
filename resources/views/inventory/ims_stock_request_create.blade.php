@extends('dashboard/nav_footer')

@section('page_header_links')
<link rel="stylesheet" href="{{ asset('dashboard_assets/inventory/css/ims_stock_request.css') }}">
@endSection
@section('body_content')
<div class="row profile">
    <div class="col-md-12">
        {{-- quotation request form start --}}

        <div class="row">
            <div class="col-md-12">

                <form action="" id="ims_stock_request_from">
                    @csrf


                    <div class="container-fluid ">
                        <div class="row gy-4 profile_row">
                            <!--  lable div end  -->
                            <div class="col-md-12">
                                <div class="parent">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h5 class="">Add Stock Request</h5>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="alert alert-success  d-none text-white ims_stock_request_added_message user_updated_msg"
                                                role="alert" id="ims_stock_request_added_message">
                                                Stock Request added successfully
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
                                    <h5 class="">Stock Request </h5>
                                    <div class="row gy-3">

                                        {{-- ref num --}}
                                        {{-- creation time --}}
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

                                        
                                        <!-- ware house (request from) -->
                                        <div class="col-md-4">
                                            <label for="stock_request_from"> Stock Request From </label>
                                            <select name="stock_request_from" id="stock_request_from" class="form-select stock_request_from">
                                                <option></option>
                                                @foreach($warehouses as $warehouse)
                                                <option value={{$warehouse->warehouse_id}}> {{$warehouse->warehouse_name}}</option>
                                                @endforeach
                                                
                                            </select>
                                        </div>
                                        <!-- ware house (request to) -->
                                        <div class="col-md-4">
                                            <label for="stock_request_to"> Stock Request To </label>
                                            <select name="stock_request_to" id="stock_request_to" class="form-select stock_request_to">
                                                <option></option>
                                                @foreach($warehouses as $warehouse)
                                                <option value={{$warehouse->warehouse_id}}> {{$warehouse->warehouse_name}}</option>
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
                                            <h5 class="">Stock Request Details</h5>

                                            <button type="button" class="btn btn-primary add_item " id=""> <i
                                                    class="fa-solid fa-plus pe-2 "></i>Add Item
                                            </button>
                                        </div>



                                    </div>
                                </div>
                            </div>
                            <!-- lable div end  -->






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
                                        {{-- unit price --}}


                                        {{-- quantity --}}
                                        <div class="col-md-6">
                                            <label for="quantity_first">Quantity</label>
                                            <input type="text" name="quantity" id="quantity_first"
                                                class="form-control quantity qty" placeholder="Quantity">
                                        </div>






                                        {{-- taxes --}}
                                        <div class="col-md-8 d-none">
                                            <label for="pro_taxes"> Taxes </label>
                                            <select name="pro_taxes" id="pro_taxes" class="form-select pro_taxes"
                                                multiple="multiple">
                                                <option></option>
                                                @foreach ($taxes as $tax)
                                                <option value="{{ $tax->tax_name }}">{{ $tax->tax_name }}</option>
                                                @endforeach
                                            </select>
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

        {{-- product quotation req details form start --}}
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
        {{-- product quotation req details form start --}}





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
        
        
        // stock request from
        $('#stock_request_from').on('change', function (param) {
            let stock_request_fromValue = $(this).val();
            if (stock_request_fromValue == "") {
                $('#stock_request_from-error').removeClass('d-none') // label
            } else {
                $('#stock_request_from-error').addClass('d-none') // label
            }
        })
        $("#stock_request_from").select2({
            placeholder: "Stock Request From",
            allowClear: true,
            width: "100%",
        });
        // stock request from
        $('#stock_request_to').on('change', function (param) {
            let stock_request_toValue = $(this).val();
            if (stock_request_toValue == "") {
                $('#stock_request_to-error').removeClass('d-none') // label
            } else {
                $('#stock_request_to-error').addClass('d-none') // label
            }
        })
        $("#stock_request_to").select2({
            placeholder: "Stock Request To",
            allowClear: true,
            width: "100%",
        });
        

        if ($(document).find('.pro_taxes').length == 1) {
            $("#taxes").select2({
                placeholder: "Select Taxes",
                allowClear: true,
                width: "100%",
            });

            $("#pro_taxes").select2({
                placeholder: "Select Taxes",
                allowClear: true,
                width: "100%",
            });
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
            $('#taxes').on('change', function (param) {
                let taxesValue = $(this).val();
                if (taxesValue == "") {
                    $('#taxes-error').removeClass('d-none') // label
                } else {
                    $('#taxes-error').addClass('d-none') // label
                }
            })
            $('#pro_taxes').on('change', function (param) {
                let pro_taxesValue = $(this).val();
                if (pro_taxesValue == "") {
                    $('#pro_taxes-error').removeClass('d-none') // label
                } else {
                    $('#pro_taxes-error').addClass('d-none') // label
                }
            })
            // hide select error on change when not null end 

        }





        // append product details form to another start 
        let i = 0; //for naming and ids
        $('.add_item').on("click", function () {
            let quotationDetailsArray = $(".quotation_details")
            let lastStockDetail = quotationDetailsArray[quotationDetailsArray.length - 1];

            $(lastStockDetail).after(`<div class="col-md-12 quotation_details">
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








            $('#pro_taxes_' + i).select2({
                placeholder: "Select Taxes",
                allowClear: true,
                width: "100%",

            })
            $(`#pro_taxes_${i}`).on('change', function (param) {
                let pro_taxesValue = $(this).val();
                if (pro_taxesValue == "") {
                    $(`#pro_taxes_${i}-error`).removeClass('d-none') // label
                } else {
                    $(`#pro_taxes_${i}-error`).addClass('d-none') // label
                }
            })
            // validation end-------------------------------------------------------------------------




            // delete quotation details start 
            $('.delete_item').on("click", function (e) {
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
                required: true,
                number: true
            },
            unit_price: {
                required: true

            }
        })


        $("#ims_stock_request_from").validate({
            rules: {
                ref_num: {
                    required: true,
                    number: true
                },
                
                stock_request_from: {
                    required: true
                },
                stock_request_to: {
                    required: true
                },
                
            },
            messages: {
                ref_num: {
                    required: "Refrence Number required",
                    number: "Only Numbers are allowed",
                },
                
                stock_request_from: {
                    required: "This field is required",
                },
                stock_request_to: {
                    required: "This field is required",
                }
                

            },
            
            
            submitHandler: function (form) {
                // product ids start 
                let productIdsArray = [] // contain all the product ids


                if ($('.product_ids_array').length == 0) {
                    $('#ims_stock_request_from').prepend(
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
                    $('#ims_stock_request_from').prepend(
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
                    url: base_url + "ims_stock_request",
                    data: new FormData(form),
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response == 'true') {
                            // current

                            $('.product_id').each((key, value) => {
                                // $(value)
                                defaultSelect2($(value))

                            })
                            defaultSelect2($('#status'))
                            defaultSelect2($('#stock_request_from'))
                            defaultSelect2($('#stock_request_to'))
                            defaultSelect2($('#employee_id'))
                            $("#ims_stock_request_from").trigger("reset");
                            $(".ims_stock_request_added_message")
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
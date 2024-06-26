@extends('dashboard/nav_footer')
@section('page_header_links')
    <link rel="stylesheet" href="{{ asset('dashboard_assets/product/css/proProduct.css') }}">
@endSection
@section('body_content')
    <div class="row">
        <div class="col-md-12">
            <form action="" id="proProductAddForm">
                <input type="hidden" id="attribute_input" name="attribute_input" value="">
                @csrf
                <div class="container-fluid profile">
                    <div class="row gy-4 profile_row">
                        <!--  lable div end  -->
                        <div class="col-md-12">
                            <div class="parent">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h5 class="">Add Product</h5>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="alert alert-success  d-none text-white proProductAddedMessage user_updated_msg"
                                            role="alert" id="proProductaddedMessage">
                                            Product added successfully
                                            <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- lable div end  -->




                        <!-- product information start  -->
                        <div class="col-md-8">
                            <div class="parent">
                                <h5 class="">Product Information</h5>
                                <div class="row gy-3">

                                    {{-- product name --}}
                                    <div class="col-md-6">
                                        <label for="product_name">Product Name</label>
                                        <input type="text" name="product_name" id="product_name" class="form-control"
                                            placeholder="Product Name">
                                    </div>
                                    {{-- product sku  --}}
                                    <div class="col-md-6">
                                        <label for="product_sku">SKU</label>
                                        <input type="text" name="product_sku" id="product_sku" class="form-control"
                                            placeholder="product sku"
                                            value="{{rand(234345,889998)}}"
                                            >
                                    </div>
                                    {{-- description --}}
                                    <div class="col-md-6">
                                        <label for="product_description">Description</label>
                                        <textarea name="product_description" id="product_description" cols="" rows="1"
                                            placeholder="Product Description" class="form-control"></textarea>
                                    </div>
                                    {{-- sale price --}}
                                    <div class="col-md-6">
                                        <label for="product_sale_price">Sale Price</label>
                                        <input type="text" name="product_sale_price" id="product_sale_price"
                                            class="form-control" placeholder="Sale Price">
                                    </div>
                                    {{-- purchase --}}
                                    <div class="col-md-6">
                                        <label for="product_purchase_price">Purchase Price</label>
                                        <input type="text" name="product_purchase_price" id="product_purchase_price"
                                            class="form-control" placeholder="Purchase Price">
                                    </div>
                                    {{-- product code --}}
                                    <div class="col-md-6">
                                        <label for="product_code">Product barcode</label>
                                        <input type="text" name="product_code" id="product_code"
                                            class="form-control" placeholder="Product code">
                                    </div>
                                    {{-- barcode type --}}
                                    <div class="col-md-6">
                                        <label for="product_barcode_type"> Barcode Type </label>
                                        <select name="product_barcode_type" id="product_barcode_type"
                                            class="form-select product_barcode_type">
                                            <option></option>
                                            <option value="C128">C128</option>
                                            <option value="C39">C39</option>
                                            <option value="EAN13">EAN13</option>
                                            <option value="EAN8">EAN8</option>
                                            <option value="UPCA">
                                                UPCA
                                            </option>
                                            <option value="UPCE">UPCE
                                            </option>
                                        </select>
                                    </div>
                                    {{-- taxes --}}
                                    <div class="col-md-12">
                                        <label for="product_taxes"> Taxes </label>
                                        <select name="product_taxes[]" id="product_taxes" class="form-select product_taxes"
                                            multiple="multiple">
                                            <option></option>
                                            @foreach ($taxes as $tax)
                                                <option value="{{ $tax->tax_name }}">{{ $tax->tax_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- category --}}
                                    <div class="col-md-12">
                                        <label for="product_categories"> Category </label>
                                        <select name="product_categories[]" id="product_categories"
                                            class="form-select product_categories" multiple="multiple">
                                            <option></option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->category_name }}">{{ $category->category_name }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>
                                    {{-- type --}}
                                    <div class="col-md-6">
                                        <label for="type"> Type </label>
                                        <select name="type" id="type" class="form-select type">
                                            <option></option>
                                            <option value="service">Service</option>
                                            <option value="product" selected>Product</option>
                                        </select>
                                    </div>
                                    {{-- unit --}}
                                    <div class="col-md-6">
                                        <label for="product_unit"> Unit </label>
                                        <select name="product_unit" id="product_unit" class="form-select product_unit">
                                            <option></option>
                                            @foreach($units as $unit)
                                            <option value="{{$unit->unit_name}}">{{$unit->unit_name}}</option>
                                            @endforeach

                                        </select>
                                    </div>






















                                    <div class="col-md-6 form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="sell_online"
                                            name="sell_online">
                                        <label class="form-check-label" for="sell_online">Sell Online</label>
                                    </div>
                                    <div class="col-md-6 form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="is_varient"
                                            name="is_varient">
                                        <label class="form-check-label" for="is_varient">is varient</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- product  information end  -->
                        <!-- product image start  -->
                        <div class="col-md-4">
                            <div class="parent h-100">
                                <h5 class="">Product Photo</h5>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="product_image">Upload Image</label>
                                        <input type="File" class="form-control" placeholder="product_image"
                                            aria-label="product_image" name="product_image" id="product_image">
                                    </div>


                                </div>
                            </div>
                        </div>
                        <!-- product image end  -->





                        <!-- settings start  -->
                        <div class="col-md-12 d-none variant_information">
                            <div class="parent h-100">
                                <h5 class="">Varient Information</h5>
                                <div class="row">
                                    {{-- parent product id --}}
                                    {{-- type --}}
                                    <div class="col-md-6">
                                        <label for="parent_product_id"> Select Product for variant </label>
                                        <select name="parent_product_id" id="parent_product_id"
                                            class="form-select parent_product_id">
                                            <option></option>
                                            @foreach ($parentProduct as $product)
                                                <option value="{{ $product->product_id }}">{{ $product->product_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>


                                    {{-- type --}}
                                    @foreach ($attributes as $attribute)
                                        <div class="col-md-6">
                                            <label for="type"> {{ $attribute->name }} </label>
                                            <select name="{{ $attribute->name }}" id="{{ $attribute->name }}"
                                                class="form-select">
                                                <option></option>
                                                @php
                                                    $valueArray = explode(',', $attribute->value);
                                                @endphp

                                                @foreach ($valueArray as $value)
                                                    <option value="{{ $value }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endforeach






                                </div>
                            </div>
                        </div>
                        <!-- setting  end  -->













                        <!-- button start  -->
                        <div class="col-md-12">
                            <div class="parent">
                                <div class="row justify-content-end">
                                    <div class="col-md-2">

                                        <button type="submit" class="btn btn-primary  w-100" id="added_user_btn">Add
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
@endSection
@section('page_script_links')
    <script>
        $(document).ready(function() {

            @php
                $baseUrl = config('app.url');
                echo "var base_url = '" . $baseUrl . "';";
                
            @endphp

            // getting attribute name  start
            let allAttributes = []
            @foreach ($attributes as $attribute)
                ;
                allAttributes.push("{{ $attribute->name }}")
                $("#"+"{{ $attribute->name }}").select2({
                placeholder: "Select" + " "+ "{{ $attribute->name }}",
                allowClear: true,
                width: "100%",
            });
            @endforeach
            console.log(allAttributes);
            let attributeString = allAttributes.join(',');
            $('#attribute_input').val(attributeString)

            // getting attribute name  end



            // replace proudct name with the product drown name start 
            $('#parent_product_id').on('change', function() {
                 let optionText= $('#parent_product_id option:selected').text()
                 $('#product_name').val(optionText)

            })
            // replace proudct name with the product drown name end
            $('#is_varient').on('click', function() {
                if ($(this).is(':checked')) {
                    $('.variant_information').removeClass('d-none')
                    $('#product_name').prop('disabled', true)
                } else {
                    $('.variant_information').addClass('d-none')
                    $('#product_name').prop('disabled', false)
                }
            })



            //  type
            $("#type").select2({
                placeholder: "Select Type",
                allowClear: true,
                width: "100%",
            });
            //  type
            $("#parent_product_id").select2({
                placeholder: "Select Product",
                allowClear: true,
                width: "100%",
            });
            //  type
            $("#product_barcode_type").select2({
                placeholder: "Select Barcode Type",
                allowClear: true,
                width: "100%",
            });
            //  unit
            $("#product_unit").select2({
                placeholder: "Select Type",
                allowClear: true,
                width: "100%",
            });

            $("#product_categories").select2({
                placeholder: "Select Categories",
                allowClear: true,
                width: "100%",
            });
            $("#product_taxes").select2({
                placeholder: "Select Taxes",
                allowClear: true,
                width: "100%",
            });

            // hide select error when the field is selected start 
            $('#type').on('change', function(param) {
                let typeValue = $(this).val();
                if (typeValue == "") {
                    $('#type-error').removeClass('d-none') // label
                } else {
                    $('#type-error').addClass('d-none') // label
                }
            })
            $('#product_unit').on('change', function(param) {
                let product_unitValue = $(this).val();
                if (product_unitValue == "") {
                    $('#product_unit-error').removeClass('d-none') // label
                } else {
                    $('#product_unit-error').addClass('d-none') // label
                }
            })
            $('#product_barcode_type').on('change', function(param) {
                let product_barcode_typeValue = $(this).val();
                if (product_barcode_typeValue == "") {
                    $('#product_barcode_type-error').removeClass('d-none') // label
                } else {
                    $('#product_barcode_type-error').addClass('d-none') // label
                }
            })

            // hide select error when the field is selected end 

            //
            // crm lead add  start
            $("#proProductAddForm").validate({
                rules: {
                    product_sku: {
                        required: true,
                        remote:{
                            url:base_url+"is_exist_product_sku",
                            type:"post",
                            data:{
                                product_sku:function(){
                                    return $('#product_sku').val();

                                },

                                _token: $('meta[name="csrf-token"]').attr("content"),
                            },


                        },
                        number:true,
                    },
                    product_sale_price: {
                        required: true,
                        number: true
                    },
                    product_purchase_price: {
                        required: true,
                        number: true
                    },
                    product_unit: {
                        required: true,
                    },
                    type: {
                        required: true,
                    },
                    product_barcode_type: {
                        required: true,
                    },
                    



                },
                messages: {
                    product_sku: {
                        required: "Sku required",
                        remote:"sku already exist",
                        number:'Only numbers are allowed'

                    },
                    product_sale_price: {
                        required: "Sale Price required",
                        number: "only numbers are allowed"
                    },
                    product_purchase_price: {
                        required: "Sale Price required",
                        number: "Only numbers are allowed"
                    },
                    product_unit: {
                        required: "Unit required",
                    },
                    type: {
                        required: "Product Type required",
                    },
                    product_barcode_type: {
                        required: "Barcode required",
                    },
                    
                },
                submitHandler: function(form) {
                    $('#product_name').prop('disabled', false)
                    $.ajax({
                        type: "post",
                        url: base_url + "proProduct",
                        data: new FormData(form),
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response == 'true') {
                                // current
                                defaultSelect2($('#product_barcode_type'))
                                defaultSelect2($('#product_taxes'))
                                defaultSelect2($('#product_categories'))
                                 defaultSelect2($('#product_unit'))
                                 defaultSelect2($('#parent_product_id'))
                                 // getting attribute name  start
            // let allAttributes = []
            @foreach ($attributes as $attribute)
                ;
                defaultSelect2($("#"+"{{ $attribute->name }}"))
                
            @endforeach
            

            // getting attribute name  end



                                $("#proProductAddForm").trigger("reset");
                                $(".proProductAddedMessage").removeClass("d-none");
                                window.scrollTo(0, 0)
                            }
                        },
                    });
                },
            });
            // // crm lead add  end
















        });
    </script>
@endSection

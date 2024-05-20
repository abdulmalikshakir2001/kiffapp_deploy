<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ public_path('dashboard_assets/product/css/proProduct.css') }}">
    <link rel="stylesheet" href="{{ public_path('dashboard_assets/product/css/proProductDetailsPrint.css') }}">

    <title>Document</title>
</head>

<body>
    <header></header>
    <section>
        <form action="" id="proProductUpdateForm">
            <input disabled type="hidden" id="product_id" name="product_id" value="{{ $product->product_id }}">
            <input disabled type="hidden" id="attribute_input" name="attribute_input" value="">
            @csrf
            <div class="container-fluid parent_wrapper">
                <div class="row gy-4 parent_row">
                    <!--  lable div end  -->
                    <div class="col-md-12 parent_row_col">
                        <div class="parent">
                            <div class="row position-relative">
                                <div class="col-md-4">
                                    <h5 class="">Product Details</h5>
                                </div>




                            </div>
                        </div>
                    </div>
                    <!-- lable div end  -->




                    <!-- product information start  -->
                    <div class="col-md-8 parent_row_col">
                        <div class="parent ">
                            <div class=" nested_first_row">
                                <h5 class="nested_first_row_col" >Product Information</h5>
                                <div class="nested_first_row_col" style="position:relative;top:40px;">
                                    <span>{!! json_decode($product->product_barcode) !!}</span>
                                    <p style="padding-top:5px;">
                                        {{ $product->product_code }}</p>
                                </div>
                            </div>
                            <div class="row gy-3 nested_first_row">

                                {{-- product name --}}
                                <div class="col-md-6 nested_first_row_col">
                                    <label for="product_name">Product Name</label>
                                    <input disabled type="text" name="product_name" id="product_name"
                                        class="form-control input_disabled" placeholder="Product Name"
                                        value="{{ $product->product_name }}">
                                </div>
                                {{-- product sku  --}}
                                <div class="col-md-6 nested_first_row_col">
                                    <label for="product_sku">SKU</label>
                                    <input disabled type="text" name="product_sku" id="product_sku"
                                        class="form-control input_disabled" placeholder="product sku "
                                        value="{{ $product->product_sku }}">
                                </div>
                                {{-- description --}}
                                <div class="col-md-6 nested_first_row_col">
                                    <label for="product_description">Description</label>
                                    <textarea disabled name="product_description" id="product_description" cols="" rows="1"
                                        placeholder="Product Description" class="form-control input_disabled">{{ $product->product_description }}</textarea>
                                </div>
                                {{-- sale price --}}
                                <div class="col-md-6 nested_first_row_col">
                                    <label for="product_sale_price">Sale Price</label>
                                    <input disabled type="text" name="product_sale_price" id="product_sale_price"
                                        class="form-control input_disabled" placeholder="Sale Price"
                                        value="{{ $product->product_sale_price }}">
                                </div>
                                {{-- purchase --}}
                                <div class="col-md-6 nested_first_row_col">
                                    <label for="product_purchase_price">Purchase Price</label>
                                    <input disabled type="text" name="product_purchase_price"
                                        id="product_purchase_price" class="form-control input_disabled"
                                        placeholder="Purchase Price" value="{{ $product->product_purchase_price }}">
                                </div>
                                {{-- barcode type --}}
                                <div class="col-md-6 nested_first_row_col">
                                    <label for="product_barcode_type"> Barcode Type </label>
                                    <select disabled name="product_barcode_type" id="product_barcode_type"
                                        class="form-select product_barcode_type">
                                        <option></option>
                                        <option value="C128"
                                            {{ $product->product_barcode_type == 'C128' ? 'selected' : '' }}>C128
                                        </option>
                                        <option value="C39"
                                            {{ $product->product_barcode_type == 'C39' ? 'selected' : '' }}>C39
                                        </option>
                                        <option value="EAN13"
                                            {{ $product->product_barcode_type == 'EAN13' ? 'selected' : '' }}>EAN13
                                        </option>
                                        <option value="EAN8"
                                            {{ $product->product_barcode_type == 'EAN8' ? 'selected' : '' }}>EAN8
                                        </option>
                                        <option value="UPCA"
                                            {{ $product->product_barcode_type == 'UPCA' ? 'selected' : '' }}>
                                            UPCA
                                        </option>
                                        <option value="UPCE"
                                            {{ $product->product_barcode_type == 'UPCE' ? 'selected' : '' }}>UPCE
                                        </option>
                                    </select>
                                </div>
                                {{-- taxes --}}
                                <div class="col-md-12 nested_first_row_col">
                                    <label for="product_barcode_type"> Product Taxes </label>
                                    <input type="text" value="{{$product->product_taxes}}">

                                </div>
                                {{-- category --}}
                                <div class="col-md-12 nested_first_row_col">
                                    <label for="product_barcode_type"> Product Categories </label>
                                    <input type="text" value="{{$product->product_categories}}">



                                </div>
                                {{-- type --}}
                                <div class="col-md-6 nested_first_row_col">
                                    <label for="type"> Type </label>
                                    <select disabled name="type" id="type" class="form-select type">
                                        <option></option>
                                        <option value="service" {{ $product->type == 'service' ? 'selected' : '' }}>
                                            Service
                                        </option>
                                        <option value="product" {{ $product->type == 'product' ? 'selected' : '' }}>
                                            Product
                                        </option>
                                    </select>
                                </div>
                                {{-- unit --}}
                                <div class="col-md-6 nested_first_row_col">
                                    <label for="product_unit"> Unit </label>
                                    <select disabled name="product_unit" id="product_unit"
                                        class="form-select product_unit">
                                        <option></option>
                                        @foreach ($units as $unit)
                                            <option value="{{ $unit->unit_name }}"
                                                {{ $product->product_unit == $unit->unit_name ? 'selected' : '' }}>
                                                {{ $unit->unit_name }}</option>
                                        @endforeach

                                    </select>
                                </div>






















                                <div class="col-md-6 form-check form-switch nested_first_row_col">
                                    <input disabled class="form-check-input" type="checkbox" id="sell_online"
                                        name="sell_online">
                                    <label class="form-check-label" for="sell_online">Sell Online</label>
                                </div>
                                <div class="col-md-6 form-check form-switch nested_first_row_col">
                                    <input disabled class="form-check-input" type="checkbox" id="is_varient"
                                        name="is_varient" {{ $product->is_varient == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_varient">is varient</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product  information end  -->
                    <!-- product image start  -->
                    <div class="col-md-4 parent_row_col">
                        <div class="parent h-100">
                            <h5 class="">Product Photo</h5>
                            <div class="row">



                                <div class="col-md-12 ">
                                    @if ($product->product_image)
                                        <img src="{{ public_path('storage/' . 'company_id_' . session()->get('company_id') . '_products' . '/' . $product->product_image) }}"
                                            alt="" width="100%" height="400px"
                                            style="border-radius:10px;">
                                    @else
                                        <img src="{{ public_path('default.png') }}" alt="" width="100%"
                                            height="400px" style="border-radius:10px;">
                                    @endif

                                </div>



                            </div>
                        </div>
                    </div>
                    <!-- product image end  -->





                    <!-- settings start  -->
                    <div class="col-md-12 d-none variant_information parent_row_col">
                        <div class="parent h-100">
                            <h5 class="">Varient Information</h5>
                            <div class="row nested_first_row">
                                {{-- parent product id --}}
                                {{-- type --}}
                                <div class="col-md-6 nested_first_row_col">
                                    <label for="parent_product_id"> Select Product for variant </label>
                                    <select disabled name="parent_product_id" id="parent_product_id"
                                        class="form-select parent_product_id">
                                        <option></option>
                                        @foreach ($parentProduct as $productPar)
                                            <option value="{{ $productPar->product_id }}"
                                                {{ $productPar->product_id == $product->parent_product_id ? 'selected' : '' }}>
                                                {{ $productPar->product_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>


                                {{-- type --}}
                                @php
                                    $proAttributesArray = get_object_vars(json_decode($product->attributes));
                                    $proAttributesKeys = array_keys($proAttributesArray);
                                    $a = 0;
                                @endphp



                                @foreach ($attributes as $attribute)
                                    <div class="col-md-6 nested_first_row_col">
                                        <label for="type"> {{ $attribute->name }} </label>
                                        <select disabled name="{{ $attribute->name }}" id="{{ $attribute->name }}"
                                            class="form-select">
                                            <option></option>
                                            @php
                                                $valueArray = explode(',', $attribute->value);
                                            @endphp

                                            @foreach ($valueArray as $value)
                                                <option value="{{ $value }}"
                                                    {{ $proAttributesArray[$proAttributesKeys[$a]] == $value ? 'selected' : '' }}>
                                                    {{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @php
                                        $a++;
                                    @endphp
                                @endforeach






                            </div>
                        </div>
                    </div>
                    <!-- setting  end  -->














                </div>
            </div>
        </form>

    </section>
    <footer></footer>
    <script>
        @php
                $baseUrl = config('app.url');
                echo "var base_url = '" . $baseUrl . "';";
                
            @endphp

            // check if vaient checked 
            if( $('#is_varient').is(":checked")){
           $('.variant_information').removeClass('d-none')

            }
            else{
                $('.variant_information').addClass('d-none')

            }

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

    </script>

</body>

</html>

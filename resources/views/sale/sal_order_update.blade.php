@extends('dashboard/nav_footer')
@section('page_header_links')
    <link rel="stylesheet" href="{{ asset('dashboard_assets/sale/css/sal_quotation.css') }}">
@endSection
@section('body_content')
    <div class="row profile">
        <div class="col-md-12">
            {{-- quotation request form  start --}}

            <div class="row">
                <div class="col-md-12">

                    <form action="" id="sal_order_form">
                        <input type="hidden" name="sal_order_id" id="sal_order_id"
                            value="{{ $salOrder->sal_order_id }}">
                        @csrf


                        <div class="container-fluid ">
                            <div class="row gy-4 profile_row">
                                <!--  lable div end  -->
                                <div class="col-md-12">
                                    <div class="parent">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h5 class="">Update Order </h5>
                                            </div>

                                            <div class="col-md-8">
                                                <div class="alert alert-success  d-none text-white sal_order_added_message user_updated_msg"
                                                    role="alert" id="sal_order_added_message">
                                                    Order Updated successfully
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
                                        <h5 class="">Order </h5>
                                        <div class="row gy-3">
                                            {{-- supplier --}}
                                            <div class="col-md-4">
                                                <label for="supplier_id"> Supplier Name </label>
                                                <select name="supplier_id" id="supplier_id" class="form-select supplier_id">
                                                    <option></option>
                                                    @foreach ($suppliers as $supplier)
                                                        <option value="{{ $supplier->user_id }}"
                                                            {{ $salOrder->supplier_id == $supplier->user_id ? 'selected' : '' }}>
                                                            {{ $supplier->username }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            
                                            {{-- pq --}}
                                            <div class="col-md-4">
                                                <label for="sal_quotation_id"> select Sale quotation </label>
                                                <select name="sal_quotation_id" id="sal_quotation_id" class="form-select sal_quotation_id"
                                                    >
                                                    <option></option>
                                                    @foreach ($salQuotations as $salQuotation)
                                                        <option value="{{ $salQuotation->sal_quotation_id }}"

                                                            {{$salOrder->sal_quotation_id==$salQuotation->sal_quotation_id?"selected":""}}
                                                            >{{ $salQuotation->ref_num }}</option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            {{-- ref num --}}

                                            <div class="col-md-4">
                                                <label for="ref_num">Refrence Number</label>
                                                <input type="text" name="ref_num" id="ref_num" class="form-control"
                                                    placeholder="Refrence Number" value="{{ $salOrder->ref_num }}">
                                            </div>



                                            {{-- description --}}

                                            <div class="col-md-4">
                                                <label for="description">Description</label>
                                                <textarea name="description" id="description" cols="" rows="1" placeholder="Description"
                                                    class="form-control">{{ $salOrder->description }}</textarea>
                                            </div>
                                            {{-- order date  --}}
                                            <div class="col-md-4">
                                                <label for="order_date">Order Date</label>
                                                <input type="date" name="order_date" id="order_date"
                                                    class="form-control" value="{{ $salOrder->order_date }}">
                                            </div>
                                            
                                            {{-- order time --}}
                                            <div class="col-md-4">
                                                <label for="order_time">Order Time</label>
                                                <input type="time" name="order_time" id="order_time"
                                                    class="form-control"
                                                    value="{{ $salOrder->order_time }}"
                                                    >
                                            </div>

                                            

                                            {{-- taxes --}}
                                            <div class="col-md-6">
                                                <label for="taxes"> Taxes

                                                </label>
                                                <select name="taxes" id="taxes" class="form-select taxes"
                                                    multiple="multiple">

                                                    <option></option>
                                                    @php
                                                        $taxesArray = explode(',', $salOrder->taxes);
                                                    @endphp
                                                    @foreach ($taxes as $tax)
                                                        <option value="{{ $tax->tax_name }}"
                                                            {{ in_array($tax->tax_name, $taxesArray) ? 'selected' : '' }}>
                                                            {{ $tax->tax_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            

                                            {{-- quotation status --}}
                                            <div class="col-md-6">
                                                <label for="status"> Status </label>
                                                <select name="status" id="status" class="form-select status">
                                                    <option></option>
                                                    <option value="open" {{$salOrder->status=="open"?"selected":""}}>Opened</option>
                                                    <option value="shipped" 
                                                    {{$salOrder->status=="shipped"?"selected":""}}
                                                    >Shipped</option>
                                                    <option value="cancelled"
                                                    {{$salOrder->status=="cancelled"?"selected":""}}
                                                    >Cancelled</option>
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
                                            <!-- <div class="d-sm-flex justify-content-sm-between">
                                                <h5 class="">Order Details</h5>

                                                
                                            </div> -->
                                            <div class="d-sm-flex justify-content-sm-between mb-4">
                                        <h5 class="">Order Details</h5>
                                        <div>
                                            <label for="">Total Amount</label>

                                            <input type="text" id="total_amount" name="total_amount" class="total_amount valid" placeholder="Total Amount" value="{{$salOrder->total_price}}">


                                        </div>
                                    </div>



                                        </div>
                                    </div>
                                </div>
                                <!-- lable div end  -->



                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($salOrder->details as $detail)
                                    <!-- quotation details start  -->
                                    <div class="col-md-12 product_quotation_request_detail_parent quotation_details">
                                        <div class="parent">

                                            <div class="row gy-3">
                                                {{-- product_id --}}
                                                {{-- <div class="col-md-12 d-flex justify-content-end">
                                                <button  type="button"  class="text-secondary delete_item  bg-white "  style="border:none;" ><i class="fas fa-trash-alt fs-6 text-danger"></i>
                                                </button>
                                            </div> --}}
                                                <input type="hidden" name="detail_id" id="detail_id" class="detail_id"
                                                    value="{{ $detail->sal_order_detail_id }}">
                                                <div class="col-md-4">
                                                    <label for="product_id_{{ $i }}"> Select Product </label>
                                                    <select name="product_id_{{ $i }}"
                                                        id="product_id_{{ $i }}"
                                                        class="form-select product_id">
                                                        <option></option>
                                                        @foreach ($products as $product)
                                                            <option value="{{ $product->product_id }}"
                                                                {{ $product->product_id == $detail->product_id ? 'selected' : '' }}>
                                                                {{ $product->product_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                {{-- unit price  --}}

                                                <div class="col-md-4">
                                                    <label for="unit_price_{{ $i }}">Unit Price</label>
                                                    <input type="text" name="unit_price_{{ $i }}"
                                                        id="unit_price_{{ $i }}"
                                                        class="form-control unit_price price_qty_keyup" placeholder="Unit Price"
                                                        value="{{ $detail->unit_price }}">
                                                </div>
                                                {{-- quantity --}}
                                                <div class="col-md-4">
                                                    <label for="quantity_{{ $i }}">Quantity</label>
                                                    <input type="text" name="quantity_{{ $i }}"
                                                        id="quantity_first_{{ $i }}"
                                                        class="form-control quantity qty price_qty_keyup" placeholder="Quantity"
                                                        value="{{ $detail->quantity }}">
                                                </div>

                                                {{-- Discount --}}
                                                <div class="col-md-4">
                                                    <label for="discount">Discount</label>
                                                    <input type="text" name="discount" id="discount"
                                                        class="form-control discount" placeholder="Discount"
                                                        value="{{ $detail->discount }}">
                                                </div>
                                                                                        <!-- taxes in percent  -->
                                        <div class="col-md-4">
                                            <label for="taxes_in_perc">Taxes in %</label>
                                            <textarea name="taxes_in_perc" id="taxes_in_perc" cols="" rows="1"
                                                class="form-control taxes_in_perc"
                                                placeholder="Taxes %">{{$taxesNamesAndPercentage[$i]}}</textarea>
                                        </div>
                                        <!-- sub total -->
                                        <div class="col-md-4">
                                            <label for="sub_total">Sub Total</label>
                                            <input type="sub_total" name="sub_total" id="sub_total"
                                                class="form-control sub_total" placeholder="Sub Total"
                                                onfocus="focused(this)" onfocusout="defocused(this)"
                                                value="{{$detail->sub_total}}">
                                        </div>










                                                {{-- taxes --}}
                                                <div class="col-md-8">
                                                    <label for="pro_taxes_{{ $i }}"> Taxes </label>
                                                    <select name="pro_taxes_{{ $i }}"
                                                        id="pro_taxes_{{ $i }}" class="form-select pro_taxes"
                                                        multiple="multiple">

                                                        <option></option>
                                                        @php
                                                            $proTaxesArray = explode(',', $detail->pro_taxes);
                                                            print_r($proTaxesArray);
                                                        @endphp
                                                        @foreach ($taxes as $tax)
                                                            <option value="{{ $tax->tax_name }}"
                                                                {{ in_array($tax->tax_name, $proTaxesArray) ? 'selected' : '' }}>
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






                                <!-- button start  -->
                                <div class="col-md-12">
                                    <div class="parent">
                                        <div class="row justify-content-end">
                                            <div class="col-md-2">

                                                <button type="submit" class="btn btn-primary  w-100"
                                                    id="">Update
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







        </div>
    </div>
@endSection
@section('page_script_links')
    <script>
         function fetchTaxesAfter(taxesNames, productMainParent) {
        $(productMainParent).find('.taxes_in_perc').val("")
        const proTaxesNames = $(taxesNames).val()
        const optionsFortaxesField = {
            method: "POST",
            headers: {
                "Content-type": "application/json"
            },
            body: JSON.stringify({
                proTaxesNames: proTaxesNames,
                _token: $(
                    'meta[name="csrf-token"]'
                ).attr(
                    "content")
            })

        }
        const taxesNamesAndValues = fetch(base_url +
            "product_taxes_select_field",
            optionsFortaxesField)
        taxesNamesAndValues.then((response) => {
            return response.json()

        }).then((json) => {
            const taxesNamesForTaxeField =
                json[0];
            const taxesValuesForTaxeField =
                json[1];
            const
                taxesValuesSumForTaxeField =
                    taxesValuesForTaxeField
                        .reduce((
                            carrier, item) => {
                            return carrier +
                                item;

                        })
            // newwork
            // console.log(taxesValuesSumForTaxeField);
            let incForTax = 0;
            let taxesNamesValue = []



            taxesNamesForTaxeField.forEach((
                value, index) => {
                taxesNamesValue
                    .push(
                        `${value} = ${taxesValuesForTaxeField[incForTax]} %`
                    )
                incForTax++
            })
            // console.log(taxesNamesValue);
            $(productMainParent).find('.taxes_in_perc').val(`Quotation taxes are :  ${taxesNamesValue}`)



        })

    }

    function showSubTotalWithOutTaxAfter() {
        let subTotalFill = 0
        $('.price_qty_keyup').on('keyup', function () {
            subTotalFill = 0
            // alert('ok')
            // console.log($('.sub_total')); 
            $('.sub_total').length

            $('.sub_total').each((key, value) => {
                if ($(value).val() != "") {
                    subTotalFill++
                }
            })
            // console.log(subTotalFill);
            if (subTotalFill == $('.sub_total').length) {
                let subTotalValue = []

                $('.sub_total').each((key, value) => {
                    subTotalValue.push(parseInt($(value).val()))



                })
                // console.log(subTotalValue);
                const subTotalValueSum = subTotalValue.reduce((carrier, item) => {
                    return carrier + item
                })
                // console.log(subTotalValueSum);
                $('#total_amount').val(subTotalValueSum)


            }
            else {
                $('#total_amount').val("")

            }

        })

    }
    function defaultSelect2(selectDropDown) { // pass selected element
        $(selectDropDown).val("").change();
        $(selectDropDown).prop('disabled', false)
        $(selectDropDown).find('option').each((key, value) => {
            $(value).prop('selected', false)
        })

    }


    function afterEmptyFields(productMainParent) {
        $(productMainParent).find('.unit_price').val("")
        $(productMainParent).find('.qty').val("")
        $(productMainParent).find('.discount').val("")
        $(productMainParent).find('#sub_total').val("")
        $(productMainParent).find('#total_amount').val("")
        $(productMainParent).find('.taxes_in_perc').val("")
    }
    async function fetchTaxesForProductId(url, data) {
        const response = await fetch(url, {
            method: "POST",
            headers: {
                "Content-type": "application/json"
            },
            body: JSON.stringify(data)
        })
        return await response.json();

    }




    function hideSelectTaxAndShowPlaceHolder(selectField) { // pass selector of selectField

        $(`${selectField} option`).each((key, value) => {

            $(value).prop('selected', false)
        })
        // select2-selection__rendered  // make it hide
        $(`${selectField}`).next('.select2').find('.select2-selection__rendered').hide()
        $(`${selectField}`).next('.select2').find('.select2-search__field').css({
            'width': '100%',
            'padding-left': '10px',
            'font-size': '15px',
        })
        $(`${selectField}`).next('.select2').find('.select2-search__field').attr(
            'placeholder',
            'Select taxes')
        // $(`${selectField}`).next('.select2').find('.select2-search__field').addClass(
        //     'color')

    }

    function emptyFields() {
        $('#taxes_in_perc').val("")
        $('#total_amount').val("")
        $('#sub_total').val("")
        $('.unit_price').val("")
        $('.qty').val("")
    }

    function showTotalAndSubTotalWithOutTax() {
        $('.price_qty_keyup').on('keyup', function () {
            $('#sub_total').val(multiplyTwoInputValues($('.unit_price'), $(
                '.qty')))
            $('#total_amount').val(multiplyTwoInputValues($('.unit_price'), $(
                '.qty')))
        })

    }
    function showSubTotalWithOutTaxAfterAddItem(productMainParent) {
        $(productMainParent).find('.price_qty_keyup').on('keyup', function () {
            $(productMainParent).find('.sub_total').val(multiplyTwoInputValues($(productMainParent).find('.unit_price'), $(productMainParent).find('.qty')))

        })

    }

    function fetchTaxes(taxesNames) {




        $('.taxes_in_perc').val("")
        const proTaxesNames = $(taxesNames).val()
        const optionsFortaxesField = {
            method: "POST",
            headers: {
                "Content-type": "application/json"
            },
            body: JSON.stringify({
                proTaxesNames: proTaxesNames,
                _token: $(
                    'meta[name="csrf-token"]'
                ).attr(
                    "content")
            })

        }
        const taxesNamesAndValues = fetch(base_url +
            "product_taxes_select_field",
            optionsFortaxesField)
        taxesNamesAndValues.then((response) => {
            return response.json()

        }).then((json) => {
            const taxesNamesForTaxeField =
                json[0];
            const taxesValuesForTaxeField =
                json[1];
            const
                taxesValuesSumForTaxeField =
                    taxesValuesForTaxeField
                        .reduce((
                            carrier, item) => {
                            return carrier +
                                item;

                        })
            // newwork
            // console.log(taxesValuesSumForTaxeField);
            let incForTax = 0;
            let taxesNamesValue = []



            taxesNamesForTaxeField.forEach((
                value, index) => {
                taxesNamesValue
                    .push(
                        `${value} = ${taxesValuesForTaxeField[incForTax]} %`
                    )
                incForTax++
            })
            // console.log(taxesNamesValue);
            $('#taxes_in_perc').val(`Quotation taxes are :  ${taxesNamesValue}`)

            $(".price_qty_keyup").on(
                'keyup',
                function () {
                    // 
                    const
                        unitPriceValue =
                            parseInt($(
                                '#unit_price'
                            )
                                .val())
                    const
                        quantityValue =
                            $(
                                '#quantity_first'
                            ).val()
                    if (unitPriceValue !=
                        "" &&
                        quantityValue !=
                        "") {
                        $('#sub_total')
                            .val(
                                multiplyTwoInputValues(
                                    $(
                                        '.unit_price'
                                    ),
                                    $(
                                        '.qty'
                                    )
                                ))
                        const tax =
                            taxesValuesSumForTaxeField /
                            100
                        let totalPriceWithOutTax =
                            unitPriceValue *
                            quantityValue
                        const taxRate =
                            totalPriceWithOutTax *
                            tax
                        let priceWithTax =
                            totalPriceWithOutTax +
                            taxRate
                        $('#total_amount')
                            .val(
                                priceWithTax
                            )
                    } else {
                        $("#total_amount")
                            .val("")
                        $("#sub_total")
                            .val("")
                    }
                })

        })

    }
    async function proTaxesInfo(url, data) {
        let taxesInfo = {}
        let response = await fetch(url, {
            method: "POST",
            headers: {
                "Content-type": "application/json"
            },
            body: JSON.stringify(data)
        })
        // console.log(await productTaxesNamesAndValues.json());
        let proTaxesNamesAndValuesArray = await response.json();
        const [taxesNames, taxesValues] = proTaxesNamesAndValuesArray
        let inc = 0;
        let taxesNamesAndValues = []
        $(taxesNames).each((key, value) => {
            taxesNamesAndValues.push(`${value} = ${taxesValues[inc]} %`)
            inc++

        })

        const taxesValueSum = taxesValues.reduce((carrier, item) => {
            return carrier + item
        })
        // console.log(taxesNamesAndValues);
        taxesInfo.taxesNamesAndValues = taxesNamesAndValues
        taxesInfo.taxesNames = taxesNames;
        taxesInfo.taxesValues = taxesValues;
        taxesInfo.taxesValueSum = taxesValueSum;

        return taxesInfo;




    }

    // Utility functions start -------------------------------------------------------------
    function multiplyTwoInputValues(input1, input2) {
        const pattern = /^\d+$/g
        const input1Val = input1.val()
        const input2Val = input2.val()
        if (input1Val != "" && input2Val != "") {
            // pattern 
            if (pattern.test(input1Val.concat(input2Val))) {
                return parseInt(input1Val) * parseInt(input2Val)
            } else {
                return ""
            }
            // pattern 

        } else {
            return "";

        }
    }

    function productSubTotalWithTax(unitPriceInput, qtyInput, totalTaxesPerProduct) {

        const pattern = /^\d+$/g
        const unitPriceInputVal = unitPriceInput.val()
        const qtyInputVal = qtyInput.val()
        if (unitPriceInputVal != "" && qtyInputVal != "") {
            // pattern 
            if (pattern.test(unitPriceInputVal.concat(
                qtyInputVal))) {

                // return parseInt(unitPriceInputVal) * parseInt(
                //     qtyInputVal)
                const tax = totalTaxesPerProduct / 100
                const taxRate = unitPriceInputVal * tax
                // alert(taxRate)
                const unitPriceWithTax = parseInt(unitPriceInputVal) + taxRate
                const subTotal = unitPriceWithTax * parseInt(qtyInputVal)
                return subTotal

            } else {
                return ""
            }
            // pattern 

        } else {
            return "";

        }

    }
    // Utility functions end -------------------------------------------------------------
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
            @foreach ($salOrder->details as $detail)

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




            // supplier

            $('#supplier_id').on('change', function(param) {
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
            $('#pro_quotation_req_id').on('change', function(param) {
                let pro_quotation_req_idValue = $(this).val();
                if (pro_quotation_req_idValue == "") {
                    $('#pro_quotation_req_id-error').removeClass('d-none') // label
                } else {
                    $('#pro_quotation_req_id-error').addClass('d-none') // label
                }
            })
            $("#pro_quotation_req_id").select2({
                placeholder: "Select PQR",
                allowClear: true,
                width: "100%",
            });
          // status
          $('#status').on('change', function(param) {
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
            // sale Quotation
            $('#sal_quotation_id').on('change', function(param) {
                let sal_quotation_idValue = $(this).val();
                if (sal_quotation_idValue == "") {
                    $('#sal_quotation_id-error').removeClass('d-none') // label
                } else {
                    $('#sal_quotation_id-error').addClass('d-none') // label
                }
            })
            $("#sal_quotation_id").select2({
                placeholder: "Select Sale quotation",
                allowClear: true,
                width: "100%",
            });

            // hide select error on change when not null end 
            

        // showing total and subtotal after sending ajax request and fetch taxes start ----------------------------



        const productArray = $('.product_id')
        const productArrayOne = [...productArray];
        // showing sub total  on page load start 
        let keyDownExecuted = false;
        $(productArrayOne).each((key, value) => {

            const productMainParentOne = $(value).closest('.parent')
            $(productMainParentOne).find('.price_qty_keyup').one('keydown', function () {

                // total amount start 
                const allSubTotalSumArray = [];
                $('.sub_total').each((key, value) => {
                    // console.log($(value).val()); 
                    allSubTotalSumArray.push(parseInt($(value).val()));

                })
                const allSubTotalSum = allSubTotalSumArray.reduce((carrier, item) => {
                    return carrier + item
                })
                // alert(allSubTotalSum)
                //  alert( parseInt( $('#total_amount').val()) - parseInt(allSubTotalSum))
                const quotationTaxAmount = parseInt($('#total_amount').val()) - parseInt(allSubTotalSum)
                let quantitiesArray = []
                $('.qty').each((key, value) => {
                    quantitiesArray.push(parseInt($(value).val()))
                })
                const qtySum = quantitiesArray.reduce((carrier, value) => {
                    return carrier + value
                })
                const quotationTax = quotationTaxAmount / qtySum


                // total amount emd
                const qtyValueOne = $(productMainParentOne).find('.qty').val()
                const unitPriceValueOne = $(productMainParentOne).find('.unit_price').val()
                const subTotalValue = $(productMainParentOne).find('.sub_total').val()
                const tax = ((subTotalValue / qtyValueOne) - unitPriceValueOne)
                if ($(productMainParentOne).find('.taxAfterUpdate').length == 0) {
                    // alert('no input ')
                    $(productMainParentOne).append(`<input type="hidden" name="taxAfterUpdate" id="taxAfterUpdate" class="taxAfterUpdate" value="">`)


                }
                if ($(productMainParentOne).find('.taxAfterUpdate').val() == "") {
                    // alert('value is empty')
                    $(productMainParentOne).find('.taxAfterUpdate').val(tax)
                    if ($(productMainParentOne).find('.taxAfterUpdate').length != 0) {
                        // alert('length greater than 0 ')
                        $(productMainParentOne).find('.price_qty_keyup').on("keyup", function () {

                            // alert(taxRate)
                            const unitPriceValueOne = $(productMainParentOne).find('.unit_price').val()
                            const qtyValueOneOne = $(productMainParentOne).find('.qty').val()


                            if (unitPriceValueOne != "" && qtyValueOneOne != "") {
                                const taxForQty = parseInt($(productMainParentOne).find('.qty').val()) * parseInt(tax)
                                const amountWithOutTax = multiplyTwoInputValues($(productMainParentOne).find('.unit_price'), $(productMainParentOne).find('.qty'))
                                const taxRate = tax / 100
                                const fullTax = amountWithOutTax * taxRate


                                $(productMainParentOne).find('.sub_total').val(amountWithOutTax + fullTax)
                                //  alert(amountWithOutTax + taxForQty)
                            }
                            else {
                                // alert('one empty')
                                $(productMainParentOne).find('.sub_total').val("")
                            }


                        })

                    }

                    // keyDownExecuted = true;
                }






                if ($('.taxes').val() != '') {

                    // alert(quotationTax)
                    // current 
                    // show total amount start 
                    let priceQtyFill = 0
                    let totalAmountPerPro = []

                    $('.price_qty_keyup').on('keyup', function () {
                        const qtyArray = $('.qty')
                        const unitPriceArray = $('.unit_price')
                        priceQtyFill = 0;
                        totalAmountPerPro = []

                        // alert('click')
                        const priceQtyCount = $('.unit_price').length + $('.qty').length
                        let inc = 0

                        $('.unit_price').each((key, value) => {
                            if ($(value).val() != "") {
                                priceQtyFill++

                            }
                            const qty = $(qtyArray)[inc]
                            if ($(qty).val() != "") {
                                priceQtyFill++
                            }
                            inc++

                        })
                        // console.log(priceQtyFill);
                        inc = 0;
                        // console.log(priceQtyFill);

                        if (priceQtyFill == priceQtyCount) {
                            let j = 0
                            // const qtySingle=  $('.qty')[j]
                            // alert('both are equal')
                            $('.unit_price').each((key, value) => {
                                const singleQty = $('.qty')[j]
                                totalAmountPerPro.push(parseInt($(value).val()) * parseInt($(singleQty).val()))
                                // console.log(j);


                                j++

                            })

                            // console.log(totalAmountPerPro);
                            const totalAmount = totalAmountPerPro.reduce((carrier, item) => {
                                return carrier + item
                            })
                            const tax = quotationTax / 100
                            const taxRate = totalAmount * tax
                            // alert(taxRate)
                            const subTotalAll = []
                            $('.sub_total').each((key, value) => {
                                subTotalAll.push(parseInt($(value).val()));
                            })
                            console.log(subTotalAll);
                            const subTotalAllSum = subTotalAll.reduce((carrier, item) => {
                                return carrier + item
                            })
                            // console.log(subTotalAllSum);
                            $('#total_amount').val(subTotalAllSum + taxRate)


                            // console.log(totalAmount);
                        }
                        else {
                            $('#total_amount').val("")
                        }
                    })
                    // show total amount end 
                }
                else {
                    // alert('taxes empty')
                    // show total amount start 
                    let priceQtyFill = 0
                    let totalAmountPerPro = []

                    $('.price_qty_keyup').on('keyup', function () {
                        const qtyArray = $('.qty')
                        const unitPriceArray = $('.unit_price')
                        priceQtyFill = 0;
                        totalAmountPerPro = []

                        // alert('click')
                        const priceQtyCount = $('.unit_price').length + $('.qty').length
                        let inc = 0

                        $('.unit_price').each((key, value) => {
                            if ($(value).val() != "") {
                                priceQtyFill++

                            }
                            const qty = $(qtyArray)[inc]
                            if ($(qty).val() != "") {
                                priceQtyFill++
                            }
                            inc++

                        })
                        // console.log(priceQtyFill);
                        inc = 0;
                        // console.log(priceQtyFill);

                        if (priceQtyFill == priceQtyCount) {
                            let j = 0
                            // const qtySingle=  $('.qty')[j]
                            // alert('both are equal')
                            $('.unit_price').each((key, value) => {
                                const singleQty = $('.qty')[j]
                                totalAmountPerPro.push(parseInt($(value).val()) * parseInt($(singleQty).val()))
                                // console.log(j);


                                j++

                            })

                            // console.log(totalAmountPerPro);
                            const totalAmount = totalAmountPerPro.reduce((carrier, item) => {
                                return carrier + item
                            })
                            const tax = quotationTax / 100
                            const taxRate = totalAmount * tax
                            // alert(taxRate)
                            const subTotalAll = []
                            $('.sub_total').each((key, value) => {
                                subTotalAll.push(parseInt($(value).val()));
                            })
                            console.log(subTotalAll);
                            const subTotalAllSum = subTotalAll.reduce((carrier, item) => {
                                return carrier + item
                            })
                            // console.log(subTotalAllSum);
                            $('#total_amount').val(subTotalAllSum)


                            // console.log(totalAmount);
                        }
                        else {
                            $('#total_amount').val("")
                        }
                    })
                    // show total amount end 

                }
            })

        })

        // showing sub total  on page load end 








        productArray.each((key, value) => {
            $(value).on('change', function () {
                // alert('changed')



                const productMainParent = $(this).closest('.parent');



                afterEmptyFields(productMainParent) // parent selector of all child inputs

                const productId = $(this).val()
                if ($('.taxes').val() == "") {



                    const productTaxes = fetch(base_url + "product_taxes", {
                        method: "POST",
                        headers: {
                            "Content-type": "application/json"
                        },
                        body: JSON.stringify({
                            productId: productId,
                            _token: $('meta[name="csrf-token"]')
                                .attr("content")
                        })
                    })
                    productTaxes.then((serverResponse) => {
                        // console.log(response);
                        return serverResponse.json()
                    }).then((response) => {
                        if (response.length == 0) {
                            defaultSelect2($(productMainParent).find('.pro_taxes'))
                            afterEmptyFields()

                            showSubTotalWithOutTaxAfterAddItem(productMainParent)
                            // show total amount start 
                            let priceQtyFill = 0
                            let totalAmountPerPro = []

                            $('.price_qty_keyup').on('keyup', function () {
                                const qtyArray = $('.qty')
                                const unitPriceArray = $('.unit_price')
                                priceQtyFill = 0;
                                totalAmountPerPro = []

                                // alert('click')
                                const priceQtyCount = $('.unit_price').length + $('.qty').length
                                let inc = 0

                                $('.unit_price').each((key, value) => {
                                    if ($(value).val() != "") {
                                        priceQtyFill++

                                    }
                                    const qty = $(qtyArray)[inc]
                                    if ($(qty).val() != "") {
                                        priceQtyFill++
                                    }
                                    inc++

                                })
                                // console.log(priceQtyFill);
                                inc = 0;
                                // console.log(priceQtyFill);

                                if (priceQtyFill == priceQtyCount) {
                                    let j = 0
                                    // const qtySingle=  $('.qty')[j]
                                    // alert('both are equal')
                                    $('.unit_price').each((key, value) => {
                                        const singleQty = $('.qty')[j]
                                        totalAmountPerPro.push(parseInt($(value).val()) * parseInt($(singleQty).val()))
                                        // console.log(j);


                                        j++

                                    })

                                    // console.log(totalAmountPerPro);
                                    const totalAmount = totalAmountPerPro.reduce((carrier, item) => {
                                        return carrier + item
                                    })
                                    const tax = response.taxesValueSum / 100
                                    const taxRate = totalAmount * tax
                                    // alert(taxRate)
                                    const subTotalAll = []
                                    $('.sub_total').each((key, value) => {
                                        subTotalAll.push(parseInt($(value).val()));
                                    })
                                    console.log(subTotalAll);
                                    const subTotalAllSum = subTotalAll.reduce((carrier, item) => {
                                        return carrier + item
                                    })
                                    // console.log(subTotalAllSum);
                                    $('#total_amount').val(subTotalAllSum)


                                    // console.log(totalAmount);
                                }
                                else {
                                    $('#total_amount').val("")
                                }
                            })
                            // show total amount end 
                            $('.taxes').on('change', function () {
                                $('#total_amount').val("")
                                afterEmptyFields(productMainParent)
                                const taxesValue = $(this).val();
                                if ($(this).val() != "") {
                                    const productTaxesLength = $('.pro_taxes').length




                                    // alert(productTaxesLength)
                                    $('.pro_taxes').each((key, value) => {
                                        const taxesMainParent = $(value).closest('.parent');
                                        if ($(value).val().length != 0) {


                                            // console.log($(value).val().length);
                                            // $(value).val()
                                            proTaxesInfo(
                                                base_url +
                                                "product_taxes_select_field", {
                                                proTaxesNames:
                                                    taxesValue,
                                                _token: $(
                                                    'meta[name="csrf-token"]'
                                                )
                                                    .attr(
                                                        "content"
                                                    )
                                            }).then((response) => {
                                                // console.log(response);
                                                proTaxesInfo(
                                                    base_url +
                                                    "product_taxes_select_field", {
                                                    proTaxesNames:
                                                        $(value).val(),
                                                    _token: $(
                                                        'meta[name="csrf-token"]'
                                                    )
                                                        .attr(
                                                            "content"
                                                        )
                                                }).then((productResponse) => {
                                                    $('#total_amount').val("")
                                                    $(taxesMainParent).find('.taxes_in_perc').val(`${productResponse.taxesNamesAndValues} \n Quotation taxes are : ${response.taxesNamesAndValues}`)



                                                    // show total amount start 
                                                    let priceQtyFill = 0
                                                    let totalAmountPerPro = []

                                                    $('.price_qty_keyup').on('keyup', function () {
                                                        const qtyArray = $('.qty')
                                                        const unitPriceArray = $('.unit_price')
                                                        priceQtyFill = 0;
                                                        totalAmountPerPro = []

                                                        // alert('click')
                                                        const priceQtyCount = $('.unit_price').length + $('.qty').length
                                                        let inc = 0

                                                        $('.unit_price').each((key, value) => {
                                                            if ($(value).val() != "") {
                                                                priceQtyFill++

                                                            }
                                                            const qty = $(qtyArray)[inc]
                                                            if ($(qty).val() != "") {
                                                                priceQtyFill++
                                                            }
                                                            inc++

                                                        })
                                                        // console.log(priceQtyFill);
                                                        inc = 0;
                                                        // console.log(priceQtyFill);

                                                        if (priceQtyFill == priceQtyCount) {
                                                            let j = 0
                                                            // const qtySingle=  $('.qty')[j]
                                                            // alert('both are equal')
                                                            $('.unit_price').each((key, value) => {
                                                                const singleQty = $('.qty')[j]
                                                                totalAmountPerPro.push(parseInt($(value).val()) * parseInt($(singleQty).val()))
                                                                // console.log(j);


                                                                j++

                                                            })

                                                            // console.log(totalAmountPerPro);
                                                            const totalAmount = totalAmountPerPro.reduce((carrier, item) => {
                                                                return carrier + item
                                                            })
                                                            const tax = response.taxesValueSum / 100
                                                            const taxRate = totalAmount * tax
                                                            // alert(taxRate)
                                                            const subTotalAll = []
                                                            $('.sub_total').each((key, value) => {
                                                                subTotalAll.push(parseInt($(value).val()));
                                                            })
                                                            console.log(subTotalAll);
                                                            const subTotalAllSum = subTotalAll.reduce((carrier, item) => {
                                                                return carrier + item
                                                            })
                                                            // console.log(subTotalAllSum);
                                                            $('#total_amount').val(subTotalAllSum + taxRate)


                                                            // console.log(totalAmount);
                                                        }
                                                        else {
                                                            $('#total_amount').val("")
                                                        }

                                                    })
                                                    // show total amount end
                                                })

                                            })

                                        }
                                        else {

                                            // alert('pro taxes empty')
                                            proTaxesInfo(
                                                base_url +
                                                "product_taxes_select_field", {
                                                proTaxesNames:
                                                    $('.taxes').val(),
                                                _token: $(
                                                    'meta[name="csrf-token"]'
                                                )
                                                    .attr(
                                                        "content"
                                                    )
                                            }).then((response) => {
                                                // console.log(response);
                                                $(taxesMainParent).find('.taxes_in_perc').val(`Quotation taxes are :  ${response.taxesNamesAndValues}`)
                                                // show total amount start 
                                                let priceQtyFill = 0
                                                let totalAmountPerPro = []

                                                $('.price_qty_keyup').on('keyup', function () {
                                                    const qtyArray = $('.qty')
                                                    const unitPriceArray = $('.unit_price')
                                                    priceQtyFill = 0;
                                                    totalAmountPerPro = []

                                                    // alert('click')
                                                    const priceQtyCount = $('.unit_price').length + $('.qty').length
                                                    let inc = 0

                                                    $('.unit_price').each((key, value) => {
                                                        if ($(value).val() != "") {
                                                            priceQtyFill++

                                                        }
                                                        const qty = $(qtyArray)[inc]
                                                        if ($(qty).val() != "") {
                                                            priceQtyFill++
                                                        }
                                                        inc++

                                                    })
                                                    // console.log(priceQtyFill);
                                                    inc = 0;
                                                    // console.log(priceQtyFill);

                                                    if (priceQtyFill == priceQtyCount) {
                                                        let j = 0
                                                        // const qtySingle=  $('.qty')[j]
                                                        // alert('both are equal')
                                                        $('.unit_price').each((key, value) => {
                                                            const singleQty = $('.qty')[j]
                                                            totalAmountPerPro.push(parseInt($(value).val()) * parseInt($(singleQty).val()))
                                                            // console.log(j);


                                                            j++

                                                        })

                                                        // console.log(totalAmountPerPro);
                                                        const totalAmount = totalAmountPerPro.reduce((carrier, item) => {
                                                            return carrier + item
                                                        })
                                                        const tax = response.taxesValueSum / 100
                                                        const taxRate = totalAmount * tax
                                                        // alert(taxRate)
                                                        const subTotalAll = []
                                                        $('.sub_total').each((key, value) => {
                                                            subTotalAll.push(parseInt($(value).val()));
                                                        })
                                                        console.log(subTotalAll);
                                                        const subTotalAllSum = subTotalAll.reduce((carrier, item) => {
                                                            return carrier + item
                                                        })
                                                        // console.log(subTotalAllSum);
                                                        $('#total_amount').val(subTotalAllSum + taxRate)


                                                        // console.log(totalAmount);
                                                    }
                                                    else {
                                                        $('#total_amount').val("")
                                                    }
                                                })
                                                // show total amount start


                                            })
                                        }
                                    })

                                }
                                else {
                                    $('.pro_taxes').each((key, value) => {
                                        const taxesMainParent = $(value).closest('.parent');
                                        if ($(value).val().length != 0) {
                                            // alert('only product taxes are filled and taxes empth ')
                                            proTaxesInfo(
                                                base_url +
                                                "product_taxes_select_field", {
                                                proTaxesNames:
                                                    $(value).val(),
                                                _token: $(
                                                    'meta[name="csrf-token"]'
                                                )
                                                    .attr(
                                                        "content"
                                                    )
                                            }).then((response) => {
                                                // console.log(response);
                                                $(taxesMainParent).find('.taxes_in_perc').val(response.taxesNamesAndValues)
                                                $(taxesMainParent).find('.price_qty_keyup').off('keyup')

                                                $(taxesMainParent).find('.price_qty_keyup').on('keyup', function () {
                                                    const priceQtyMainParent = $(this).closest('.parent')
                                                    // console.log(priceQtyMainParent);
                                                    $(priceQtyMainParent).find('.sub_total').val(
                                                        productSubTotalWithTax($(priceQtyMainParent).find('.unit_price'), $(priceQtyMainParent).find('.qty'), response.taxesValueSum)
                                                    )


                                                })
                                                // show total amount start 
                                                let priceQtyFill = 0
                                                let totalAmountPerPro = []

                                                $('.price_qty_keyup').on('keyup', function () {
                                                    const qtyArray = $('.qty')
                                                    const unitPriceArray = $('.unit_price')
                                                    priceQtyFill = 0;
                                                    totalAmountPerPro = []

                                                    // alert('click')
                                                    const priceQtyCount = $('.unit_price').length + $('.qty').length
                                                    let inc = 0

                                                    $('.unit_price').each((key, value) => {
                                                        if ($(value).val() != "") {
                                                            priceQtyFill++

                                                        }
                                                        const qty = $(qtyArray)[inc]
                                                        if ($(qty).val() != "") {
                                                            priceQtyFill++
                                                        }
                                                        inc++

                                                    })
                                                    // console.log(priceQtyFill);
                                                    inc = 0;
                                                    // console.log(priceQtyFill);

                                                    if (priceQtyFill == priceQtyCount) {
                                                        let j = 0
                                                        // const qtySingle=  $('.qty')[j]
                                                        // alert('both are equal')
                                                        $('.unit_price').each((key, value) => {
                                                            const singleQty = $('.qty')[j]
                                                            totalAmountPerPro.push(parseInt($(value).val()) * parseInt($(singleQty).val()))
                                                            // console.log(j);


                                                            j++

                                                        })

                                                        // console.log(totalAmountPerPro);
                                                        const totalAmount = totalAmountPerPro.reduce((carrier, item) => {
                                                            return carrier + item
                                                        })
                                                        // const tax = response.taxesValueSum / 100
                                                        // const taxRate = totalAmount * tax
                                                        // alert(taxRate)
                                                        const subTotalAll = []
                                                        $('.sub_total').each((key, value) => {
                                                            subTotalAll.push(parseInt($(value).val()));
                                                        })
                                                        console.log(subTotalAll);
                                                        const subTotalAllSum = subTotalAll.reduce((carrier, item) => {
                                                            return carrier + item
                                                        })
                                                        // console.log(subTotalAllSum);
                                                        $('#total_amount').val(subTotalAllSum)


                                                        // console.log(totalAmount);
                                                    }
                                                    else {
                                                        $('#total_amount').val("")
                                                    }

                                                })
                                                // show total amount end







                                            })


                                        }
                                        else {
                                            $(taxesMainParent).find('.price_qty_keyup').off('keyup')
                                            $(taxesMainParent).find('.price_qty_keyup').on("keyup", () => {
                                                $(taxesMainParent).find('.sub_total').val(

                                                    showSubTotalWithOutTaxAfterAddItem(taxesMainParent)
                                                )

                                                // show total amount start 
                                                let priceQtyFill = 0
                                                let totalAmountPerPro = []

                                                $('.price_qty_keyup').on('keyup', function () {
                                                    const qtyArray = $('.qty')
                                                    const unitPriceArray = $('.unit_price')
                                                    priceQtyFill = 0;
                                                    totalAmountPerPro = []

                                                    // alert('click')
                                                    const priceQtyCount = $('.unit_price').length + $('.qty').length
                                                    let inc = 0

                                                    $('.unit_price').each((key, value) => {
                                                        if ($(value).val() != "") {
                                                            priceQtyFill++

                                                        }
                                                        const qty = $(qtyArray)[inc]
                                                        if ($(qty).val() != "") {
                                                            priceQtyFill++
                                                        }
                                                        inc++

                                                    })
                                                    // console.log(priceQtyFill);
                                                    inc = 0;
                                                    // console.log(priceQtyFill);

                                                    if (priceQtyFill == priceQtyCount) {
                                                        let j = 0
                                                        // const qtySingle=  $('.qty')[j]
                                                        // alert('both are equal')
                                                        $('.unit_price').each((key, value) => {
                                                            const singleQty = $('.qty')[j]
                                                            totalAmountPerPro.push(parseInt($(value).val()) * parseInt($(singleQty).val()))
                                                            // console.log(j);


                                                            j++

                                                        })

                                                        // console.log(totalAmountPerPro);
                                                        const totalAmount = totalAmountPerPro.reduce((carrier, item) => {
                                                            return carrier + item
                                                        })
                                                        // const tax = response.taxesValueSum / 100
                                                        // const taxRate = totalAmount * tax
                                                        // alert(taxRate)
                                                        const subTotalAll = []
                                                        $('.sub_total').each((key, value) => {
                                                            subTotalAll.push(parseInt($(value).val()));
                                                        })
                                                        console.log(subTotalAll);
                                                        const subTotalAllSum = subTotalAll.reduce((carrier, item) => {
                                                            return carrier + item
                                                        })
                                                        // console.log(subTotalAllSum);
                                                        $('#total_amount').val(subTotalAllSum)


                                                        // console.log(totalAmount);
                                                    }
                                                    else {
                                                        $('#total_amount').val("")
                                                    }

                                                })
                                                // show total amount end


                                            })




                                        }

                                    })



                                }
                            })

                            $(productMainParent).find('.pro_taxes').on('change', function () {
                                // afterEmptyFields()
                                afterEmptyFields(productMainParent)
                                $('#total_amount').val("")

                                if ($(this).val() != "") {
                                    if ($('.taxes').val() != "") {
                                        // afterEmptyFields()
                                        // this block will show subtotal and total amount start 
                                        proTaxesInfo(
                                            base_url +
                                            "product_taxes_select_field", {
                                            proTaxesNames: $(
                                                '.taxes'
                                            )
                                                .val(),
                                            _token: $(
                                                'meta[name="csrf-token"]'
                                            )
                                                .attr(
                                                    "content"
                                                )
                                        }).then((response) => {
                                            proTaxesInfo(
                                                base_url +
                                                "product_taxes_select_field", {
                                                proTaxesNames: $(productMainParent).find(
                                                    '.pro_taxes'
                                                )
                                                    .val(),
                                                _token: $(
                                                    'meta[name="csrf-token"]'
                                                )
                                                    .attr(
                                                        "content"
                                                    )
                                            }).then((productResponse) => {
                                                console.log(productResponse);
                                                $(productMainParent).find('.taxes_in_perc').val(`${productResponse.taxesNamesAndValues} \n Quotation taxes are : ${response.taxesNamesAndValues}`)
                                                // productSubTotalWithTax  taxesValueSum
                                                $(productMainParent).find('.price_qty_keyup').on('keyup', function () {
                                                    $(productMainParent).find('.sub_total').val(productSubTotalWithTax($(productMainParent).find('.unit_price'), $(productMainParent).find('.qty'), productResponse.taxesValueSum))

                                                })
                                                // show total amount start 
                                                let priceQtyFill = 0
                                                let totalAmountPerPro = []

                                                $('.price_qty_keyup').on('keyup', function () {
                                                    const qtyArray = $('.qty')
                                                    const unitPriceArray = $('.unit_price')
                                                    priceQtyFill = 0;
                                                    totalAmountPerPro = []

                                                    // alert('click')
                                                    const priceQtyCount = $('.unit_price').length + $('.qty').length
                                                    let inc = 0

                                                    $('.unit_price').each((key, value) => {
                                                        if ($(value).val() != "") {
                                                            priceQtyFill++

                                                        }
                                                        const qty = $(qtyArray)[inc]
                                                        if ($(qty).val() != "") {
                                                            priceQtyFill++
                                                        }
                                                        inc++

                                                    })
                                                    // console.log(priceQtyFill);
                                                    inc = 0;
                                                    // console.log(priceQtyFill);

                                                    if (priceQtyFill == priceQtyCount) {
                                                        let j = 0
                                                        // const qtySingle=  $('.qty')[j]
                                                        // alert('both are equal')
                                                        $('.unit_price').each((key, value) => {
                                                            const singleQty = $('.qty')[j]
                                                            totalAmountPerPro.push(parseInt($(value).val()) * parseInt($(singleQty).val()))
                                                            // console.log(j);


                                                            j++

                                                        })

                                                        // console.log(totalAmountPerPro);
                                                        const totalAmount = totalAmountPerPro.reduce((carrier, item) => {
                                                            return carrier + item
                                                        })
                                                        const tax = response.taxesValueSum / 100
                                                        const taxRate = totalAmount * tax
                                                        // alert(taxRate)
                                                        const subTotalAll = []
                                                        $('.sub_total').each((key, value) => {
                                                            subTotalAll.push(parseInt($(value).val()));
                                                        })
                                                        console.log(subTotalAll);
                                                        const subTotalAllSum = subTotalAll.reduce((carrier, item) => {
                                                            return carrier + item
                                                        })
                                                        // console.log(subTotalAllSum);
                                                        $('#total_amount').val(subTotalAllSum + taxRate)


                                                        // console.log(totalAmount);
                                                    }
                                                    else {
                                                        $('#total_amount').val("")
                                                    }



                                                })
                                                // show total amount end 

                                            })

                                            // pro taxes end 
                                            // taxesNamesAndValues
                                        })

                                        // this block will show subtotal and total amount start 

                                    }
                                    else {

                                        afterEmptyFields(productMainParent)
                                        proTaxesInfo(
                                            base_url +
                                            "product_taxes_select_field", {
                                            proTaxesNames: $(productMainParent).find(
                                                '.pro_taxes'
                                            )
                                                .val(),
                                            _token: $(
                                                'meta[name="csrf-token"]'
                                            )
                                                .attr(
                                                    "content"
                                                )
                                        }).then((response) => {
                                            // console.log(response)
                                            $(productMainParent).find('.taxes_in_perc').val(response.taxesNamesAndValues)
                                            $(productMainParent).find('.price_qty_keyup').off('keyup')
                                            $(productMainParent).find('.price_qty_keyup').on('keyup', function () {
                                                $(productMainParent).find('.sub_total').val(productSubTotalWithTax($(productMainParent).find('.unit_price'), $(productMainParent).find('.qty'), response.taxesValueSum))


                                            })
                                            // show total amount start 
                                            let priceQtyFill = 0
                                            let totalAmountPerPro = []

                                            $('.price_qty_keyup').on('keyup', function () {
                                                const qtyArray = $('.qty')
                                                const unitPriceArray = $('.unit_price')
                                                priceQtyFill = 0;
                                                totalAmountPerPro = []

                                                // alert('click')
                                                const priceQtyCount = $('.unit_price').length + $('.qty').length
                                                let inc = 0

                                                $('.unit_price').each((key, value) => {
                                                    if ($(value).val() != "") {
                                                        priceQtyFill++

                                                    }
                                                    const qty = $(qtyArray)[inc]
                                                    if ($(qty).val() != "") {
                                                        priceQtyFill++
                                                    }
                                                    inc++

                                                })
                                                // console.log(priceQtyFill);
                                                inc = 0;
                                                // console.log(priceQtyFill);

                                                if (priceQtyFill == priceQtyCount) {
                                                    let j = 0
                                                    // const qtySingle=  $('.qty')[j]
                                                    // alert('both are equal')
                                                    $('.unit_price').each((key, value) => {
                                                        const singleQty = $('.qty')[j]
                                                        totalAmountPerPro.push(parseInt($(value).val()) * parseInt($(singleQty).val()))
                                                        // console.log(j);


                                                        j++

                                                    })

                                                    // console.log(totalAmountPerPro);
                                                    const totalAmount = totalAmountPerPro.reduce((carrier, item) => {
                                                        return carrier + item
                                                    })
                                                    const tax = response.taxesValueSum / 100
                                                    const taxRate = totalAmount * tax
                                                    // alert(taxRate)
                                                    const subTotalAll = []
                                                    $('.sub_total').each((key, value) => {
                                                        subTotalAll.push(parseInt($(value).val()));
                                                    })
                                                    console.log(subTotalAll);
                                                    const subTotalAllSum = subTotalAll.reduce((carrier, item) => {
                                                        return carrier + item
                                                    })
                                                    // console.log(subTotalAllSum);
                                                    $('#total_amount').val(subTotalAllSum)


                                                    // console.log(totalAmount);
                                                }
                                                else {
                                                    $('#total_amount').val("")
                                                }



                                            })
                                            // show total amount end 
                                        })

                                    }



                                }
                                else {
                                    afterEmptyFields(productMainParent)
                                    if ($('.taxes').val() != "") {
                                        proTaxesInfo(
                                            base_url +
                                            "product_taxes_select_field", {
                                            proTaxesNames: $(
                                                '.taxes'
                                            )
                                                .val(),
                                            _token: $(
                                                'meta[name="csrf-token"]'
                                            )
                                                .attr(
                                                    "content"
                                                )
                                        }).then((response) => {
                                            $(productMainParent).find('.taxes_in_perc').val(`Quotation taxes are :  ${response.taxesNamesAndValues}`)
                                            showSubTotalWithOutTaxAfterAddItem(productMainParent)
                                            // alert('pro  taxes are empty and taxes not empty')
                                            // show total amount start 
                                            let priceQtyFill = 0
                                            let totalAmountPerPro = []

                                            $('.price_qty_keyup').on('keyup', function () {
                                                const qtyArray = $('.qty')
                                                const unitPriceArray = $('.unit_price')
                                                priceQtyFill = 0;
                                                totalAmountPerPro = []

                                                // alert('click')
                                                const priceQtyCount = $('.unit_price').length + $('.qty').length
                                                let inc = 0

                                                $('.unit_price').each((key, value) => {
                                                    if ($(value).val() != "") {
                                                        priceQtyFill++

                                                    }
                                                    const qty = $(qtyArray)[inc]
                                                    if ($(qty).val() != "") {
                                                        priceQtyFill++
                                                    }
                                                    inc++

                                                })
                                                // console.log(priceQtyFill);
                                                inc = 0;
                                                // console.log(priceQtyFill);

                                                if (priceQtyFill == priceQtyCount) {
                                                    let j = 0
                                                    // const qtySingle=  $('.qty')[j]
                                                    // alert('both are equal')
                                                    $('.unit_price').each((key, value) => {
                                                        const singleQty = $('.qty')[j]
                                                        totalAmountPerPro.push(parseInt($(value).val()) * parseInt($(singleQty).val()))
                                                        // console.log(j);


                                                        j++

                                                    })

                                                    // console.log(totalAmountPerPro);
                                                    const totalAmount = totalAmountPerPro.reduce((carrier, item) => {
                                                        return carrier + item
                                                    })
                                                    const tax = response.taxesValueSum / 100
                                                    const taxRate = totalAmount * tax
                                                    // alert(taxRate)
                                                    const subTotalAll = []
                                                    $('.sub_total').each((key, value) => {
                                                        subTotalAll.push(parseInt($(value).val()));
                                                    })
                                                    console.log(subTotalAll);
                                                    const subTotalAllSum = subTotalAll.reduce((carrier, item) => {
                                                        return carrier + item
                                                    })
                                                    // console.log(subTotalAllSum);
                                                    $('#total_amount').val(subTotalAllSum + taxRate)


                                                    // console.log(totalAmount);
                                                }
                                                else {
                                                    $('#total_amount').val("")
                                                }



                                            })
                                            // show total amount end 





                                        })

                                    } else {

                                        showSubTotalWithOutTaxAfterAddItem(productMainParent)
                                        // show total amount start 
                                        let priceQtyFill = 0
                                        let totalAmountPerPro = []

                                        $('.price_qty_keyup').on('keyup', function () {
                                            const qtyArray = $('.qty')
                                            const unitPriceArray = $('.unit_price')
                                            priceQtyFill = 0;
                                            totalAmountPerPro = []

                                            // alert('click')
                                            const priceQtyCount = $('.unit_price').length + $('.qty').length
                                            let inc = 0

                                            $('.unit_price').each((key, value) => {
                                                if ($(value).val() != "") {
                                                    priceQtyFill++

                                                }
                                                const qty = $(qtyArray)[inc]
                                                if ($(qty).val() != "") {
                                                    priceQtyFill++
                                                }
                                                inc++

                                            })
                                            // console.log(priceQtyFill);
                                            inc = 0;
                                            // console.log(priceQtyFill);

                                            if (priceQtyFill == priceQtyCount) {
                                                let j = 0
                                                // const qtySingle=  $('.qty')[j]
                                                // alert('both are equal')
                                                $('.unit_price').each((key, value) => {
                                                    const singleQty = $('.qty')[j]
                                                    totalAmountPerPro.push(parseInt($(value).val()) * parseInt($(singleQty).val()))
                                                    // console.log(j);


                                                    j++

                                                })

                                                // console.log(totalAmountPerPro);
                                                const totalAmount = totalAmountPerPro.reduce((carrier, item) => {
                                                    return carrier + item
                                                })
                                                // const tax = response.taxesValueSum / 100
                                                // const taxRate = totalAmount * tax
                                                // alert(taxRate)
                                                const subTotalAll = []
                                                $('.sub_total').each((key, value) => {
                                                    subTotalAll.push(parseInt($(value).val()));
                                                })
                                                console.log(subTotalAll);
                                                const subTotalAllSum = subTotalAll.reduce((carrier, item) => {
                                                    return carrier + item
                                                })
                                                // console.log(subTotalAllSum);
                                                $('#total_amount').val(subTotalAllSum)


                                                // console.log(totalAmount);
                                            }
                                            else {
                                                $('#total_amount').val("")
                                            }

                                        })
                                        // show total amount end


                                        // $(productMainParent).find(".price_qty_keyup").on("keyup",function(){
                                        //     $(productMainParent).find(".sub_total").val(

                                        //     )
                                        // })




                                    }


                                }
                            })








                        }
                        else {
                            //  in this block we get 3 arrays which are taxesNames,taxesNameValuw,taxesPercentage    for that product which have taxes start
                            let
                                taxesNames = []; // contain taxes names
                            let
                                taxesNameValue = []; // contain taxes names and values
                            let
                                taxesPercentage = []; // this array contain taxes percentage after response from product_taxes url.
                            let i = 0;
                            response[0].forEach(
                                function (item,
                                    index,
                                    arr) {
                                    taxesNameValue
                                        .push(
                                            item +
                                            '=' +
                                            response[1][i] + "%")
                                    taxesPercentage
                                        .push(response[1][i])
                                    taxesNames.push(item)
                                    i++;
                                })
                            $(productMainParent).find('.taxes_in_perc').val(taxesNameValue)

                            // console.log($(taxesNames)); 

                            // if product have taxes then select those taxes in pro taxes start 
                            const productTaxesForDisplay = []
                            $(productMainParent).find('.pro_taxes option').each((key, value) => {

                                if (taxesNames.includes($(value).attr('value'))) {
                                    productTaxesForDisplay.push($(value).attr('value'))
                                }
                            })
                            $(productMainParent).find('.pro_taxes').val(productTaxesForDisplay).change();
                            $(productMainParent).find('.pro_taxes').prop('disabled', true)
                            // if product have taxes then select those taxes in pro taxes end

                            const taxesPercentageSum = taxesPercentage.reduce((carrier, item) => {
                                return carrier + item
                            })
                            $(productMainParent).find(".price_qty_keyup").on('keyup', function () {
                                // alert('ok')
                                $(productMainParent).find('.sub_total').val(productSubTotalWithTax($(productMainParent).find(".unit_price"), $(productMainParent).find(".qty"), taxesPercentageSum))




                            })



                            //  in this block we get 3 arrays which are taxesNames,taxesNameValuw,taxesPercentage  for that product which have taxes end




                            // show total amount start 
                            let priceQtyFill = 0
                            let totalAmountPerPro = []

                            $('.price_qty_keyup').on('keyup', function () {
                                const qtyArray = $('.qty')
                                const unitPriceArray = $('.unit_price')
                                priceQtyFill = 0;
                                totalAmountPerPro = []

                                // alert('click')
                                const priceQtyCount = $('.unit_price').length + $('.qty').length
                                let inc = 0

                                $('.unit_price').each((key, value) => {
                                    if ($(value).val() != "") {
                                        priceQtyFill++

                                    }
                                    const qty = $(qtyArray)[inc]
                                    if ($(qty).val() != "") {
                                        priceQtyFill++
                                    }
                                    inc++

                                })
                                // console.log(priceQtyFill);
                                inc = 0;
                                // console.log(priceQtyFill);

                                if (priceQtyFill == priceQtyCount) {
                                    let j = 0
                                    // const qtySingle=  $('.qty')[j]
                                    // alert('both are equal')
                                    $('.unit_price').each((key, value) => {
                                        const singleQty = $('.qty')[j]
                                        totalAmountPerPro.push(parseInt($(value).val()) * parseInt($(singleQty).val()))
                                        // console.log(j);


                                        j++

                                    })

                                    // console.log(totalAmountPerPro);
                                    const totalAmount = totalAmountPerPro.reduce((carrier, item) => {
                                        return carrier + item
                                    })
                                    // const tax = response.taxesValueSum / 100
                                    // const taxRate = totalAmount * tax
                                    // alert(taxRate)
                                    const subTotalAll = []
                                    $('.sub_total').each((key, value) => {
                                        subTotalAll.push(parseInt($(value).val()));
                                    })
                                    console.log(subTotalAll);
                                    const subTotalAllSum = subTotalAll.reduce((carrier, item) => {
                                        return carrier + item
                                    })
                                    // console.log(subTotalAllSum);
                                    $('#total_amount').val(subTotalAllSum)


                                    // console.log(totalAmount);
                                }
                                else {
                                    $('#total_amount').val("")
                                }

                            })
                            // show total amount end
                            $('.taxes').on('change', function () {
                                $('#total_amount').val("")
                                afterEmptyFields(productMainParent)
                                const taxesValue = $(this).val();
                                if ($(this).val() != "") {
                                    const productTaxesLength = $('.pro_taxes').length




                                    // alert(productTaxesLength)
                                    $('.pro_taxes').each((key, value) => {
                                        const taxesMainParent = $(value).closest('.parent');
                                        if ($(value).val().length != 0) {


                                            // console.log($(value).val().length);
                                            // $(value).val()
                                            proTaxesInfo(
                                                base_url +
                                                "product_taxes_select_field", {
                                                proTaxesNames:
                                                    taxesValue,
                                                _token: $(
                                                    'meta[name="csrf-token"]'
                                                )
                                                    .attr(
                                                        "content"
                                                    )
                                            }).then((response) => {
                                                // console.log(response);
                                                proTaxesInfo(
                                                    base_url +
                                                    "product_taxes_select_field", {
                                                    proTaxesNames:
                                                        $(value).val(),
                                                    _token: $(
                                                        'meta[name="csrf-token"]'
                                                    )
                                                        .attr(
                                                            "content"
                                                        )
                                                }).then((productResponse) => {
                                                    $('#total_amount').val("")
                                                    $(taxesMainParent).find('.taxes_in_perc').val(`${productResponse.taxesNamesAndValues} \n Quotation taxes are : ${response.taxesNamesAndValues}`)


                                                    // show total amount start 
                                                    let priceQtyFill = 0
                                                    let totalAmountPerPro = []

                                                    $('.price_qty_keyup').on('keyup', function () {
                                                        const qtyArray = $('.qty')
                                                        const unitPriceArray = $('.unit_price')
                                                        priceQtyFill = 0;
                                                        totalAmountPerPro = []

                                                        // alert('click')
                                                        const priceQtyCount = $('.unit_price').length + $('.qty').length
                                                        let inc = 0

                                                        $('.unit_price').each((key, value) => {
                                                            if ($(value).val() != "") {
                                                                priceQtyFill++

                                                            }
                                                            const qty = $(qtyArray)[inc]
                                                            if ($(qty).val() != "") {
                                                                priceQtyFill++
                                                            }
                                                            inc++

                                                        })
                                                        // console.log(priceQtyFill);
                                                        inc = 0;
                                                        // console.log(priceQtyFill);

                                                        if (priceQtyFill == priceQtyCount) {
                                                            let j = 0
                                                            // const qtySingle=  $('.qty')[j]
                                                            // alert('both are equal')
                                                            $('.unit_price').each((key, value) => {
                                                                const singleQty = $('.qty')[j]
                                                                totalAmountPerPro.push(parseInt($(value).val()) * parseInt($(singleQty).val()))
                                                                // console.log(j);


                                                                j++

                                                            })

                                                            // console.log(totalAmountPerPro);
                                                            const totalAmount = totalAmountPerPro.reduce((carrier, item) => {
                                                                return carrier + item
                                                            })
                                                            const tax = response.taxesValueSum / 100
                                                            const taxRate = totalAmount * tax
                                                            // alert(taxRate)
                                                            const subTotalAll = []
                                                            $('.sub_total').each((key, value) => {
                                                                subTotalAll.push(parseInt($(value).val()));
                                                            })
                                                            console.log(subTotalAll);
                                                            const subTotalAllSum = subTotalAll.reduce((carrier, item) => {
                                                                return carrier + item
                                                            })
                                                            // console.log(subTotalAllSum);
                                                            $('#total_amount').val(subTotalAllSum + taxRate)


                                                            // console.log(totalAmount);
                                                        }
                                                        else {
                                                            $('#total_amount').val("")
                                                        }

                                                    })
                                                    // show total amount end
                                                })

                                            })

                                        }
                                        else {

                                            // alert('pro taxes empty')
                                            proTaxesInfo(
                                                base_url +
                                                "product_taxes_select_field", {
                                                proTaxesNames:
                                                    $('.taxes').val(),
                                                _token: $(
                                                    'meta[name="csrf-token"]'
                                                )
                                                    .attr(
                                                        "content"
                                                    )
                                            }).then((response) => {
                                                // console.log(response);
                                                $(taxesMainParent).find('.taxes_in_perc').val(`Quotation taxes are :  ${response.taxesNamesAndValues}`)
                                                // show total amount start 
                                                let priceQtyFill = 0
                                                let totalAmountPerPro = []

                                                $('.price_qty_keyup').on('keyup', function () {
                                                    const qtyArray = $('.qty')
                                                    const unitPriceArray = $('.unit_price')
                                                    priceQtyFill = 0;
                                                    totalAmountPerPro = []

                                                    // alert('click')
                                                    const priceQtyCount = $('.unit_price').length + $('.qty').length
                                                    let inc = 0

                                                    $('.unit_price').each((key, value) => {
                                                        if ($(value).val() != "") {
                                                            priceQtyFill++

                                                        }
                                                        const qty = $(qtyArray)[inc]
                                                        if ($(qty).val() != "") {
                                                            priceQtyFill++
                                                        }
                                                        inc++

                                                    })
                                                    // console.log(priceQtyFill);
                                                    inc = 0;
                                                    // console.log(priceQtyFill);

                                                    if (priceQtyFill == priceQtyCount) {
                                                        let j = 0
                                                        // const qtySingle=  $('.qty')[j]
                                                        // alert('both are equal')
                                                        $('.unit_price').each((key, value) => {
                                                            const singleQty = $('.qty')[j]
                                                            totalAmountPerPro.push(parseInt($(value).val()) * parseInt($(singleQty).val()))
                                                            // console.log(j);


                                                            j++

                                                        })

                                                        // console.log(totalAmountPerPro);
                                                        const totalAmount = totalAmountPerPro.reduce((carrier, item) => {
                                                            return carrier + item
                                                        })
                                                        const tax = response.taxesValueSum / 100
                                                        const taxRate = totalAmount * tax
                                                        // alert(taxRate)
                                                        const subTotalAll = []
                                                        $('.sub_total').each((key, value) => {
                                                            subTotalAll.push(parseInt($(value).val()));
                                                        })
                                                        console.log(subTotalAll);
                                                        const subTotalAllSum = subTotalAll.reduce((carrier, item) => {
                                                            return carrier + item
                                                        })
                                                        // console.log(subTotalAllSum);
                                                        $('#total_amount').val(subTotalAllSum + taxRate)


                                                        // console.log(totalAmount);
                                                    }
                                                    else {
                                                        $('#total_amount').val("")
                                                    }
                                                })
                                                // show total amount start

                                            })
                                        }
                                    })

                                }
                                else {
                                    $('.pro_taxes').each((key, value) => {
                                        const taxesMainParent = $(value).closest('.parent');
                                        if ($(value).val().length != 0) {
                                            // alert('only product taxes are filled and taxes empth ')
                                            proTaxesInfo(
                                                base_url +
                                                "product_taxes_select_field", {
                                                proTaxesNames:
                                                    $(value).val(),
                                                _token: $(
                                                    'meta[name="csrf-token"]'
                                                )
                                                    .attr(
                                                        "content"
                                                    )
                                            }).then((response) => {
                                                // console.log(response);
                                                $(taxesMainParent).find('.taxes_in_perc').val(response.taxesNamesAndValues)
                                                $(taxesMainParent).find('.price_qty_keyup').off('keyup')

                                                $(taxesMainParent).find('.price_qty_keyup').on('keyup', function () {
                                                    const priceQtyMainParent = $(this).closest('.parent')
                                                    // console.log(priceQtyMainParent);
                                                    $(priceQtyMainParent).find('.sub_total').val(
                                                        productSubTotalWithTax($(priceQtyMainParent).find('.unit_price'), $(priceQtyMainParent).find('.qty'), response.taxesValueSum)
                                                    )


                                                })
                                                // show total amount start 
                                                let priceQtyFill = 0
                                                let totalAmountPerPro = []

                                                $('.price_qty_keyup').on('keyup', function () {
                                                    const qtyArray = $('.qty')
                                                    const unitPriceArray = $('.unit_price')
                                                    priceQtyFill = 0;
                                                    totalAmountPerPro = []

                                                    // alert('click')
                                                    const priceQtyCount = $('.unit_price').length + $('.qty').length
                                                    let inc = 0

                                                    $('.unit_price').each((key, value) => {
                                                        if ($(value).val() != "") {
                                                            priceQtyFill++

                                                        }
                                                        const qty = $(qtyArray)[inc]
                                                        if ($(qty).val() != "") {
                                                            priceQtyFill++
                                                        }
                                                        inc++

                                                    })
                                                    // console.log(priceQtyFill);
                                                    inc = 0;
                                                    // console.log(priceQtyFill);

                                                    if (priceQtyFill == priceQtyCount) {
                                                        let j = 0
                                                        // const qtySingle=  $('.qty')[j]
                                                        // alert('both are equal')
                                                        $('.unit_price').each((key, value) => {
                                                            const singleQty = $('.qty')[j]
                                                            totalAmountPerPro.push(parseInt($(value).val()) * parseInt($(singleQty).val()))
                                                            // console.log(j);


                                                            j++

                                                        })

                                                        // console.log(totalAmountPerPro);
                                                        const totalAmount = totalAmountPerPro.reduce((carrier, item) => {
                                                            return carrier + item
                                                        })
                                                        // const tax = response.taxesValueSum / 100
                                                        // const taxRate = totalAmount * tax
                                                        // alert(taxRate)
                                                        const subTotalAll = []
                                                        $('.sub_total').each((key, value) => {
                                                            subTotalAll.push(parseInt($(value).val()));
                                                        })
                                                        console.log(subTotalAll);
                                                        const subTotalAllSum = subTotalAll.reduce((carrier, item) => {
                                                            return carrier + item
                                                        })
                                                        // console.log(subTotalAllSum);
                                                        $('#total_amount').val(subTotalAllSum)


                                                        // console.log(totalAmount);
                                                    }
                                                    else {
                                                        $('#total_amount').val("")
                                                    }

                                                })
                                                // show total amount end







                                            })


                                        }
                                        else {
                                            $(taxesMainParent).find('.price_qty_keyup').off('keyup')
                                            $(taxesMainParent).find('.price_qty_keyup').on("keyup", () => {
                                                $(taxesMainParent).find('.sub_total').val(

                                                    showSubTotalWithOutTaxAfterAddItem(taxesMainParent)
                                                )

                                                // show total amount start 
                                                let priceQtyFill = 0
                                                let totalAmountPerPro = []

                                                $('.price_qty_keyup').on('keyup', function () {
                                                    const qtyArray = $('.qty')
                                                    const unitPriceArray = $('.unit_price')
                                                    priceQtyFill = 0;
                                                    totalAmountPerPro = []

                                                    // alert('click')
                                                    const priceQtyCount = $('.unit_price').length + $('.qty').length
                                                    let inc = 0

                                                    $('.unit_price').each((key, value) => {
                                                        if ($(value).val() != "") {
                                                            priceQtyFill++

                                                        }
                                                        const qty = $(qtyArray)[inc]
                                                        if ($(qty).val() != "") {
                                                            priceQtyFill++
                                                        }
                                                        inc++

                                                    })
                                                    // console.log(priceQtyFill);
                                                    inc = 0;
                                                    // console.log(priceQtyFill);

                                                    if (priceQtyFill == priceQtyCount) {
                                                        let j = 0
                                                        // const qtySingle=  $('.qty')[j]
                                                        // alert('both are equal')
                                                        $('.unit_price').each((key, value) => {
                                                            const singleQty = $('.qty')[j]
                                                            totalAmountPerPro.push(parseInt($(value).val()) * parseInt($(singleQty).val()))
                                                            // console.log(j);


                                                            j++

                                                        })

                                                        // console.log(totalAmountPerPro);
                                                        const totalAmount = totalAmountPerPro.reduce((carrier, item) => {
                                                            return carrier + item
                                                        })
                                                        // const tax = response.taxesValueSum / 100
                                                        // const taxRate = totalAmount * tax
                                                        // alert(taxRate)
                                                        const subTotalAll = []
                                                        $('.sub_total').each((key, value) => {
                                                            subTotalAll.push(parseInt($(value).val()));
                                                        })
                                                        console.log(subTotalAll);
                                                        const subTotalAllSum = subTotalAll.reduce((carrier, item) => {
                                                            return carrier + item
                                                        })
                                                        // console.log(subTotalAllSum);
                                                        $('#total_amount').val(subTotalAllSum)


                                                        // console.log(totalAmount);
                                                    }
                                                    else {
                                                        $('#total_amount').val("")
                                                    }

                                                })
                                                // show total amount end


                                            })




                                        }

                                    })



                                }
                            })

                            $(productMainParent).find('.pro_taxes').on('change', function () {
                                // afterEmptyFields()
                                afterEmptyFields(productMainParent)
                                $('#total_amount').val("")

                                if ($(this).val() != "") {
                                    if ($('.taxes').val() != "") {
                                        // afterEmptyFields()
                                        // this block will show subtotal and total amount start 
                                        proTaxesInfo(
                                            base_url +
                                            "product_taxes_select_field", {
                                            proTaxesNames: $(
                                                '.taxes'
                                            )
                                                .val(),
                                            _token: $(
                                                'meta[name="csrf-token"]'
                                            )
                                                .attr(
                                                    "content"
                                                )
                                        }).then((response) => {
                                            proTaxesInfo(
                                                base_url +
                                                "product_taxes_select_field", {
                                                proTaxesNames: $(productMainParent).find(
                                                    '.pro_taxes'
                                                )
                                                    .val(),
                                                _token: $(
                                                    'meta[name="csrf-token"]'
                                                )
                                                    .attr(
                                                        "content"
                                                    )
                                            }).then((productResponse) => {
                                                console.log(productResponse);
                                                $(productMainParent).find('.taxes_in_perc').val(`${productResponse.taxesNamesAndValues} \n Quotation taxes are : ${response.taxesNamesAndValues}`)
                                                // productSubTotalWithTax  taxesValueSum
                                                $(productMainParent).find('.price_qty_keyup').on('keyup', function () {
                                                    $(productMainParent).find('.sub_total').val(productSubTotalWithTax($(productMainParent).find('.unit_price'), $(productMainParent).find('.qty'), productResponse.taxesValueSum))

                                                })
                                                // show total amount start 
                                                let priceQtyFill = 0
                                                let totalAmountPerPro = []

                                                $('.price_qty_keyup').on('keyup', function () {
                                                    const qtyArray = $('.qty')
                                                    const unitPriceArray = $('.unit_price')
                                                    priceQtyFill = 0;
                                                    totalAmountPerPro = []

                                                    // alert('click')
                                                    const priceQtyCount = $('.unit_price').length + $('.qty').length
                                                    let inc = 0

                                                    $('.unit_price').each((key, value) => {
                                                        if ($(value).val() != "") {
                                                            priceQtyFill++

                                                        }
                                                        const qty = $(qtyArray)[inc]
                                                        if ($(qty).val() != "") {
                                                            priceQtyFill++
                                                        }
                                                        inc++

                                                    })
                                                    // console.log(priceQtyFill);
                                                    inc = 0;
                                                    // console.log(priceQtyFill);

                                                    if (priceQtyFill == priceQtyCount) {
                                                        let j = 0
                                                        // const qtySingle=  $('.qty')[j]
                                                        // alert('both are equal')
                                                        $('.unit_price').each((key, value) => {
                                                            const singleQty = $('.qty')[j]
                                                            totalAmountPerPro.push(parseInt($(value).val()) * parseInt($(singleQty).val()))
                                                            // console.log(j);


                                                            j++

                                                        })

                                                        // console.log(totalAmountPerPro);
                                                        const totalAmount = totalAmountPerPro.reduce((carrier, item) => {
                                                            return carrier + item
                                                        })
                                                        const tax = response.taxesValueSum / 100
                                                        const taxRate = totalAmount * tax
                                                        // alert(taxRate)
                                                        const subTotalAll = []
                                                        $('.sub_total').each((key, value) => {
                                                            subTotalAll.push(parseInt($(value).val()));
                                                        })
                                                        console.log(subTotalAll);
                                                        const subTotalAllSum = subTotalAll.reduce((carrier, item) => {
                                                            return carrier + item
                                                        })
                                                        // console.log(subTotalAllSum);
                                                        $('#total_amount').val(subTotalAllSum + taxRate)


                                                        // console.log(totalAmount);
                                                    }
                                                    else {
                                                        $('#total_amount').val("")
                                                    }



                                                })
                                                // show total amount end 

                                            })

                                            // pro taxes end 
                                            // taxesNamesAndValues
                                        })

                                        // this block will show subtotal and total amount start 

                                    }
                                    else {

                                        afterEmptyFields(productMainParent)
                                        proTaxesInfo(
                                            base_url +
                                            "product_taxes_select_field", {
                                            proTaxesNames: $(productMainParent).find(
                                                '.pro_taxes'
                                            )
                                                .val(),
                                            _token: $(
                                                'meta[name="csrf-token"]'
                                            )
                                                .attr(
                                                    "content"
                                                )
                                        }).then((response) => {
                                            // console.log(response)
                                            $(productMainParent).find('.taxes_in_perc').val(response.taxesNamesAndValues)
                                            $(productMainParent).find('.price_qty_keyup').off('keyup')
                                            $(productMainParent).find('.price_qty_keyup').on('keyup', function () {
                                                $(productMainParent).find('.sub_total').val(productSubTotalWithTax($(productMainParent).find('.unit_price'), $(productMainParent).find('.qty'), response.taxesValueSum))


                                            })
                                            // show total amount start 
                                            let priceQtyFill = 0
                                            let totalAmountPerPro = []

                                            $('.price_qty_keyup').on('keyup', function () {
                                                const qtyArray = $('.qty')
                                                const unitPriceArray = $('.unit_price')
                                                priceQtyFill = 0;
                                                totalAmountPerPro = []

                                                // alert('click')
                                                const priceQtyCount = $('.unit_price').length + $('.qty').length
                                                let inc = 0

                                                $('.unit_price').each((key, value) => {
                                                    if ($(value).val() != "") {
                                                        priceQtyFill++

                                                    }
                                                    const qty = $(qtyArray)[inc]
                                                    if ($(qty).val() != "") {
                                                        priceQtyFill++
                                                    }
                                                    inc++

                                                })
                                                // console.log(priceQtyFill);
                                                inc = 0;
                                                // console.log(priceQtyFill);

                                                if (priceQtyFill == priceQtyCount) {
                                                    let j = 0
                                                    // const qtySingle=  $('.qty')[j]
                                                    // alert('both are equal')
                                                    $('.unit_price').each((key, value) => {
                                                        const singleQty = $('.qty')[j]
                                                        totalAmountPerPro.push(parseInt($(value).val()) * parseInt($(singleQty).val()))
                                                        // console.log(j);


                                                        j++

                                                    })

                                                    // console.log(totalAmountPerPro);
                                                    const totalAmount = totalAmountPerPro.reduce((carrier, item) => {
                                                        return carrier + item
                                                    })
                                                    const tax = response.taxesValueSum / 100
                                                    const taxRate = totalAmount * tax
                                                    // alert(taxRate)
                                                    const subTotalAll = []
                                                    $('.sub_total').each((key, value) => {
                                                        subTotalAll.push(parseInt($(value).val()));
                                                    })
                                                    console.log(subTotalAll);
                                                    const subTotalAllSum = subTotalAll.reduce((carrier, item) => {
                                                        return carrier + item
                                                    })
                                                    // console.log(subTotalAllSum);
                                                    $('#total_amount').val(subTotalAllSum)


                                                    // console.log(totalAmount);
                                                }
                                                else {
                                                    $('#total_amount').val("")
                                                }



                                            })
                                            // show total amount end 
                                        })

                                    }



                                }
                                else {
                                    afterEmptyFields(productMainParent)
                                    if ($('.taxes').val() != "") {
                                        proTaxesInfo(
                                            base_url +
                                            "product_taxes_select_field", {
                                            proTaxesNames: $(
                                                '.taxes'
                                            )
                                                .val(),
                                            _token: $(
                                                'meta[name="csrf-token"]'
                                            )
                                                .attr(
                                                    "content"
                                                )
                                        }).then((response) => {
                                            $(productMainParent).find('.taxes_in_perc').val(`Quotation taxes are :  ${response.taxesNamesAndValues}`)
                                            showSubTotalWithOutTaxAfterAddItem(productMainParent)
                                            // alert('pro  taxes are empty and taxes not empty')
                                            // show total amount start 
                                            let priceQtyFill = 0
                                            let totalAmountPerPro = []

                                            $('.price_qty_keyup').on('keyup', function () {
                                                const qtyArray = $('.qty')
                                                const unitPriceArray = $('.unit_price')
                                                priceQtyFill = 0;
                                                totalAmountPerPro = []

                                                // alert('click')
                                                const priceQtyCount = $('.unit_price').length + $('.qty').length
                                                let inc = 0

                                                $('.unit_price').each((key, value) => {
                                                    if ($(value).val() != "") {
                                                        priceQtyFill++

                                                    }
                                                    const qty = $(qtyArray)[inc]
                                                    if ($(qty).val() != "") {
                                                        priceQtyFill++
                                                    }
                                                    inc++

                                                })
                                                // console.log(priceQtyFill);
                                                inc = 0;
                                                // console.log(priceQtyFill);

                                                if (priceQtyFill == priceQtyCount) {
                                                    let j = 0
                                                    // const qtySingle=  $('.qty')[j]
                                                    // alert('both are equal')
                                                    $('.unit_price').each((key, value) => {
                                                        const singleQty = $('.qty')[j]
                                                        totalAmountPerPro.push(parseInt($(value).val()) * parseInt($(singleQty).val()))
                                                        // console.log(j);


                                                        j++

                                                    })

                                                    // console.log(totalAmountPerPro);
                                                    const totalAmount = totalAmountPerPro.reduce((carrier, item) => {
                                                        return carrier + item
                                                    })
                                                    const tax = response.taxesValueSum / 100
                                                    const taxRate = totalAmount * tax
                                                    // alert(taxRate)
                                                    const subTotalAll = []
                                                    $('.sub_total').each((key, value) => {
                                                        subTotalAll.push(parseInt($(value).val()));
                                                    })
                                                    console.log(subTotalAll);
                                                    const subTotalAllSum = subTotalAll.reduce((carrier, item) => {
                                                        return carrier + item
                                                    })
                                                    // console.log(subTotalAllSum);
                                                    $('#total_amount').val(subTotalAllSum + taxRate)


                                                    // console.log(totalAmount);
                                                }
                                                else {
                                                    $('#total_amount').val("")
                                                }



                                            })
                                            // show total amount end 





                                        })

                                    } else {

                                        showSubTotalWithOutTaxAfterAddItem(productMainParent)
                                        // show total amount start 
                                        let priceQtyFill = 0
                                        let totalAmountPerPro = []

                                        $('.price_qty_keyup').on('keyup', function () {
                                            const qtyArray = $('.qty')
                                            const unitPriceArray = $('.unit_price')
                                            priceQtyFill = 0;
                                            totalAmountPerPro = []

                                            // alert('click')
                                            const priceQtyCount = $('.unit_price').length + $('.qty').length
                                            let inc = 0

                                            $('.unit_price').each((key, value) => {
                                                if ($(value).val() != "") {
                                                    priceQtyFill++

                                                }
                                                const qty = $(qtyArray)[inc]
                                                if ($(qty).val() != "") {
                                                    priceQtyFill++
                                                }
                                                inc++

                                            })
                                            // console.log(priceQtyFill);
                                            inc = 0;
                                            // console.log(priceQtyFill);

                                            if (priceQtyFill == priceQtyCount) {
                                                let j = 0
                                                // const qtySingle=  $('.qty')[j]
                                                // alert('both are equal')
                                                $('.unit_price').each((key, value) => {
                                                    const singleQty = $('.qty')[j]
                                                    totalAmountPerPro.push(parseInt($(value).val()) * parseInt($(singleQty).val()))
                                                    // console.log(j);


                                                    j++

                                                })

                                                // console.log(totalAmountPerPro);
                                                const totalAmount = totalAmountPerPro.reduce((carrier, item) => {
                                                    return carrier + item
                                                })
                                                // const tax = response.taxesValueSum / 100
                                                // const taxRate = totalAmount * tax
                                                // alert(taxRate)
                                                const subTotalAll = []
                                                $('.sub_total').each((key, value) => {
                                                    subTotalAll.push(parseInt($(value).val()));
                                                })
                                                console.log(subTotalAll);
                                                const subTotalAllSum = subTotalAll.reduce((carrier, item) => {
                                                    return carrier + item
                                                })
                                                // console.log(subTotalAllSum);
                                                $('#total_amount').val(subTotalAllSum)


                                                // console.log(totalAmount);
                                            }
                                            else {
                                                $('#total_amount').val("")
                                            }

                                        })
                                        // show total amount end


                                        // $(productMainParent).find(".price_qty_keyup").on("keyup",function(){
                                        //     $(productMainParent).find(".sub_total").val(

                                        //     )
                                        // })




                                    }


                                }
                            })




                        }

                    })


                }
                else {
                    // alert('taxes not  empty')
                    const productTaxes = fetch(base_url + "product_taxes", {
                        method: "POST",
                        headers: {
                            "Content-type": "application/json"
                        },
                        body: JSON.stringify({
                            productId: productId,
                            _token: $('meta[name="csrf-token"]')
                                .attr("content")
                        })
                    })
                    productTaxes.then((serverResponse) => {
                        // console.log(response);
                        return serverResponse.json()
                    }).then((response) => {
                        if (response.length == 0) {
                            
                            defaultSelect2($(productMainParent).find('.pro_taxes'))
                            afterEmptyFields()
                            showSubTotalWithOutTaxAfterAddItem(productMainParent)
                            // showSubTotalWithOutTaxAfter()


                            proTaxesInfo(
                                base_url +
                                "product_taxes_select_field", {
                                proTaxesNames: $(
                                    '.taxes'
                                )
                                    .val(),
                                _token: $(
                                    'meta[name="csrf-token"]'
                                )
                                    .attr(
                                        "content"
                                    )
                            }).then((response) => {
                                // console.log(response);
                                // taxesNamesAndValues
                                $(productMainParent).find('.taxes_in_perc').val(`Quotation taxes are :  ${response.taxesNamesAndValues}`)
                                // show total amount start 
                                let priceQtyFill = 0
                                let totalAmountPerPro = []

                                $('.price_qty_keyup').on('keyup', function () {
                                    const qtyArray = $('.qty')
                                    const unitPriceArray = $('.unit_price')
                                    priceQtyFill = 0;
                                    totalAmountPerPro = []

                                    // alert('click')
                                    const priceQtyCount = $('.unit_price').length + $('.qty').length
                                    let inc = 0

                                    $('.unit_price').each((key, value) => {
                                        if ($(value).val() != "") {
                                            priceQtyFill++

                                        }
                                        const qty = $(qtyArray)[inc]
                                        if ($(qty).val() != "") {
                                            priceQtyFill++
                                        }
                                        inc++

                                    })
                                    // console.log(priceQtyFill);
                                    inc = 0;
                                    // console.log(priceQtyFill);

                                    if (priceQtyFill == priceQtyCount) {
                                        let j = 0
                                        // const qtySingle=  $('.qty')[j]
                                        // alert('both are equal')
                                        $('.unit_price').each((key, value) => {
                                            const singleQty = $('.qty')[j]
                                            totalAmountPerPro.push(parseInt($(value).val()) * parseInt($(singleQty).val()))
                                            // console.log(j);


                                            j++

                                        })

                                        // console.log(totalAmountPerPro);
                                        const totalAmount = totalAmountPerPro.reduce((carrier, item) => {
                                            return carrier + item
                                        })
                                        const tax = response.taxesValueSum / 100
                                        const taxRate = totalAmount * tax
                                        // alert(taxRate)
                                        const subTotalAll = []
                                        $('.sub_total').each((key, value) => {
                                            subTotalAll.push(parseInt($(value).val()));
                                        })
                                        console.log(subTotalAll);
                                        const subTotalAllSum = subTotalAll.reduce((carrier, item) => {
                                            return carrier + item
                                        })
                                        // console.log(subTotalAllSum);
                                        $('#total_amount').val(subTotalAllSum + taxRate)


                                        // console.log(totalAmount);
                                    }
                                    else {
                                        $('#total_amount').val("")
                                    }
                                })
                                // show total amount start 
                            })
                            $('.taxes').on('change', function () {
                                $('#total_amount').val("")
                                afterEmptyFields(productMainParent)
                                const taxesValue = $(this).val();
                                if ($(this).val() != "") {
                                    const productTaxesLength = $('.pro_taxes').length
                                    // alert(productTaxesLength)
                                    $('.pro_taxes').each((key, value) => {
                                        const taxesMainParent = $(value).closest('.parent');
                                        if ($(value).val().length != 0) {


                                            // console.log($(value).val().length);
                                            // $(value).val()
                                            proTaxesInfo(
                                                base_url +
                                                "product_taxes_select_field", {
                                                proTaxesNames:
                                                    taxesValue,
                                                _token: $(
                                                    'meta[name="csrf-token"]'
                                                )
                                                    .attr(
                                                        "content"
                                                    )
                                            }).then((response) => {
                                                // console.log(response);
                                                proTaxesInfo(
                                                    base_url +
                                                    "product_taxes_select_field", {
                                                    proTaxesNames:
                                                        $(value).val(),
                                                    _token: $(
                                                        'meta[name="csrf-token"]'
                                                    )
                                                        .attr(
                                                            "content"
                                                        )
                                                }).then((productResponse) => {
                                                    $('#total_amount').val("")
                                                    $(taxesMainParent).find('.taxes_in_perc').val(`${productResponse.taxesNamesAndValues} \n Quotation taxes are : ${response.taxesNamesAndValues}`)


                                                    // show total amount start 
                                                    let priceQtyFill = 0
                                                    let totalAmountPerPro = []

                                                    $('.price_qty_keyup').on('keyup', function () {
                                                        const qtyArray = $('.qty')
                                                        const unitPriceArray = $('.unit_price')
                                                        priceQtyFill = 0;
                                                        totalAmountPerPro = []

                                                        // alert('click')
                                                        const priceQtyCount = $('.unit_price').length + $('.qty').length
                                                        let inc = 0

                                                        $('.unit_price').each((key, value) => {
                                                            if ($(value).val() != "") {
                                                                priceQtyFill++

                                                            }
                                                            const qty = $(qtyArray)[inc]
                                                            if ($(qty).val() != "") {
                                                                priceQtyFill++
                                                            }
                                                            inc++

                                                        })
                                                        // console.log(priceQtyFill);
                                                        inc = 0;
                                                        // console.log(priceQtyFill);

                                                        if (priceQtyFill == priceQtyCount) {
                                                            let j = 0
                                                            // const qtySingle=  $('.qty')[j]
                                                            // alert('both are equal')
                                                            $('.unit_price').each((key, value) => {
                                                                const singleQty = $('.qty')[j]
                                                                totalAmountPerPro.push(parseInt($(value).val()) * parseInt($(singleQty).val()))
                                                                // console.log(j);


                                                                j++

                                                            })

                                                            // console.log(totalAmountPerPro);
                                                            const totalAmount = totalAmountPerPro.reduce((carrier, item) => {
                                                                return carrier + item
                                                            })
                                                            const tax = response.taxesValueSum / 100
                                                            const taxRate = totalAmount * tax
                                                            // alert(taxRate)
                                                            const subTotalAll = []
                                                            $('.sub_total').each((key, value) => {
                                                                subTotalAll.push(parseInt($(value).val()));
                                                            })
                                                            console.log(subTotalAll);
                                                            const subTotalAllSum = subTotalAll.reduce((carrier, item) => {
                                                                return carrier + item
                                                            })
                                                            // console.log(subTotalAllSum);
                                                            $('#total_amount').val(subTotalAllSum + taxRate)


                                                            // console.log(totalAmount);
                                                        }
                                                        else {
                                                            $('#total_amount').val("")
                                                        }

                                                    })
                                                    // show total amount end
                                                })

                                            })

                                        }
                                        else {

                                            // alert('pro taxes empty')
                                            proTaxesInfo(
                                                base_url +
                                                "product_taxes_select_field", {
                                                proTaxesNames:
                                                    $('.taxes').val(),
                                                _token: $(
                                                    'meta[name="csrf-token"]'
                                                )
                                                    .attr(
                                                        "content"
                                                    )
                                            }).then((response) => {
                                                // console.log(response);
                                                $(taxesMainParent).find('.taxes_in_perc').val(`Quotation taxes are :  ${response.taxesNamesAndValues}`)
                                                // show total amount start 
                                                let priceQtyFill = 0
                                                let totalAmountPerPro = []

                                                $('.price_qty_keyup').on('keyup', function () {
                                                    const qtyArray = $('.qty')
                                                    const unitPriceArray = $('.unit_price')
                                                    priceQtyFill = 0;
                                                    totalAmountPerPro = []

                                                    // alert('click')
                                                    const priceQtyCount = $('.unit_price').length + $('.qty').length
                                                    let inc = 0

                                                    $('.unit_price').each((key, value) => {
                                                        if ($(value).val() != "") {
                                                            priceQtyFill++

                                                        }
                                                        const qty = $(qtyArray)[inc]
                                                        if ($(qty).val() != "") {
                                                            priceQtyFill++
                                                        }
                                                        inc++

                                                    })
                                                    // console.log(priceQtyFill);
                                                    inc = 0;
                                                    // console.log(priceQtyFill);

                                                    if (priceQtyFill == priceQtyCount) {
                                                        let j = 0
                                                        // const qtySingle=  $('.qty')[j]
                                                        // alert('both are equal')
                                                        $('.unit_price').each((key, value) => {
                                                            const singleQty = $('.qty')[j]
                                                            totalAmountPerPro.push(parseInt($(value).val()) * parseInt($(singleQty).val()))
                                                            // console.log(j);


                                                            j++

                                                        })

                                                        // console.log(totalAmountPerPro);
                                                        const totalAmount = totalAmountPerPro.reduce((carrier, item) => {
                                                            return carrier + item
                                                        })
                                                        const tax = response.taxesValueSum / 100
                                                        const taxRate = totalAmount * tax
                                                        // alert(taxRate)
                                                        const subTotalAll = []
                                                        $('.sub_total').each((key, value) => {
                                                            subTotalAll.push(parseInt($(value).val()));
                                                        })
                                                        console.log(subTotalAll);
                                                        const subTotalAllSum = subTotalAll.reduce((carrier, item) => {
                                                            return carrier + item
                                                        })
                                                        // console.log(subTotalAllSum);
                                                        $('#total_amount').val(subTotalAllSum + taxRate)


                                                        // console.log(totalAmount);
                                                    }
                                                    else {
                                                        $('#total_amount').val("")
                                                    }
                                                })
                                                // show total amount start

                                            })
                                        }
                                    })

                                }
                                else {
                                    // current
                                    $('.pro_taxes').each((key, value) => {
                                        const taxesMainParent = $(value).closest('.parent');
                                        if ($(value).val().length != 0) {
                                            // alert('only product taxes are filled and taxes empth ')
                                            proTaxesInfo(
                                                base_url +
                                                "product_taxes_select_field", {
                                                proTaxesNames:
                                                    $(value).val(),
                                                _token: $(
                                                    'meta[name="csrf-token"]'
                                                )
                                                    .attr(
                                                        "content"
                                                    )
                                            }).then((response) => {
                                                // console.log(response);
                                                $(taxesMainParent).find('.taxes_in_perc').val(response.taxesNamesAndValues)
                                                $(taxesMainParent).find('.price_qty_keyup').off('keyup')

                                                $(taxesMainParent).find('.price_qty_keyup').on('keyup', function () {
                                                    const priceQtyMainParent = $(this).closest('.parent')
                                                    // console.log(priceQtyMainParent);
                                                    $(priceQtyMainParent).find('.sub_total').val(
                                                        productSubTotalWithTax($(priceQtyMainParent).find('.unit_price'), $(priceQtyMainParent).find('.qty'), response.taxesValueSum)
                                                    )


                                                })
                                                // show total amount start 
                                                let priceQtyFill = 0
                                                let totalAmountPerPro = []

                                                $('.price_qty_keyup').on('keyup', function () {
                                                    const qtyArray = $('.qty')
                                                    const unitPriceArray = $('.unit_price')
                                                    priceQtyFill = 0;
                                                    totalAmountPerPro = []

                                                    // alert('click')
                                                    const priceQtyCount = $('.unit_price').length + $('.qty').length
                                                    let inc = 0

                                                    $('.unit_price').each((key, value) => {
                                                        if ($(value).val() != "") {
                                                            priceQtyFill++

                                                        }
                                                        const qty = $(qtyArray)[inc]
                                                        if ($(qty).val() != "") {
                                                            priceQtyFill++
                                                        }
                                                        inc++

                                                    })
                                                    // console.log(priceQtyFill);
                                                    inc = 0;
                                                    // console.log(priceQtyFill);

                                                    if (priceQtyFill == priceQtyCount) {
                                                        let j = 0
                                                        // const qtySingle=  $('.qty')[j]
                                                        // alert('both are equal')
                                                        $('.unit_price').each((key, value) => {
                                                            const singleQty = $('.qty')[j]
                                                            totalAmountPerPro.push(parseInt($(value).val()) * parseInt($(singleQty).val()))
                                                            // console.log(j);


                                                            j++

                                                        })

                                                        // console.log(totalAmountPerPro);
                                                        const totalAmount = totalAmountPerPro.reduce((carrier, item) => {
                                                            return carrier + item
                                                        })
                                                        // const tax = response.taxesValueSum / 100
                                                        // const taxRate = totalAmount * tax
                                                        // alert(taxRate)
                                                        const subTotalAll = []
                                                        $('.sub_total').each((key, value) => {
                                                            subTotalAll.push(parseInt($(value).val()));
                                                        })
                                                        console.log(subTotalAll);
                                                        const subTotalAllSum = subTotalAll.reduce((carrier, item) => {
                                                            return carrier + item
                                                        })
                                                        // console.log(subTotalAllSum);
                                                        $('#total_amount').val(subTotalAllSum)


                                                        // console.log(totalAmount);
                                                    }
                                                    else {
                                                        $('#total_amount').val("")
                                                    }

                                                })
                                                // show total amount end







                                            })


                                        }
                                        else {
                                            $(taxesMainParent).find('.price_qty_keyup').off('keyup')
                                            $(taxesMainParent).find('.price_qty_keyup').on("keyup", () => {
                                                $(taxesMainParent).find('.sub_total').val(

                                                    showSubTotalWithOutTaxAfterAddItem(taxesMainParent)
                                                )

                                                // show total amount start 
                                                let priceQtyFill = 0
                                                let totalAmountPerPro = []

                                                $('.price_qty_keyup').on('keyup', function () {
                                                    const qtyArray = $('.qty')
                                                    const unitPriceArray = $('.unit_price')
                                                    priceQtyFill = 0;
                                                    totalAmountPerPro = []

                                                    // alert('click')
                                                    const priceQtyCount = $('.unit_price').length + $('.qty').length
                                                    let inc = 0

                                                    $('.unit_price').each((key, value) => {
                                                        if ($(value).val() != "") {
                                                            priceQtyFill++

                                                        }
                                                        const qty = $(qtyArray)[inc]
                                                        if ($(qty).val() != "") {
                                                            priceQtyFill++
                                                        }
                                                        inc++

                                                    })
                                                    // console.log(priceQtyFill);
                                                    inc = 0;
                                                    // console.log(priceQtyFill);

                                                    if (priceQtyFill == priceQtyCount) {
                                                        let j = 0
                                                        // const qtySingle=  $('.qty')[j]
                                                        // alert('both are equal')
                                                        $('.unit_price').each((key, value) => {
                                                            const singleQty = $('.qty')[j]
                                                            totalAmountPerPro.push(parseInt($(value).val()) * parseInt($(singleQty).val()))
                                                            // console.log(j);


                                                            j++

                                                        })

                                                        // console.log(totalAmountPerPro);
                                                        const totalAmount = totalAmountPerPro.reduce((carrier, item) => {
                                                            return carrier + item
                                                        })
                                                        // const tax = response.taxesValueSum / 100
                                                        // const taxRate = totalAmount * tax
                                                        // alert(taxRate)
                                                        const subTotalAll = []
                                                        $('.sub_total').each((key, value) => {
                                                            subTotalAll.push(parseInt($(value).val()));
                                                        })
                                                        console.log(subTotalAll);
                                                        const subTotalAllSum = subTotalAll.reduce((carrier, item) => {
                                                            return carrier + item
                                                        })
                                                        // console.log(subTotalAllSum);
                                                        $('#total_amount').val(subTotalAllSum)


                                                        // console.log(totalAmount);
                                                    }
                                                    else {
                                                        $('#total_amount').val("")
                                                    }

                                                })
                                                // show total amount end


                                            })




                                        }

                                    })



                                }
                            })

                            $(productMainParent).find('.pro_taxes').on('change', function () {
                                // afterEmptyFields()
                                afterEmptyFields(productMainParent)
                                $('#total_amount').val("")

                                if ($(this).val() != "") {
                                    if ($('.taxes').val() != "") {
                                        // afterEmptyFields()
                                        // this block will show subtotal and total amount start 
                                        proTaxesInfo(
                                            base_url +
                                            "product_taxes_select_field", {
                                            proTaxesNames: $(
                                                '.taxes'
                                            )
                                                .val(),
                                            _token: $(
                                                'meta[name="csrf-token"]'
                                            )
                                                .attr(
                                                    "content"
                                                )
                                        }).then((response) => {
                                            proTaxesInfo(
                                                base_url +
                                                "product_taxes_select_field", {
                                                proTaxesNames: $(productMainParent).find(
                                                    '.pro_taxes'
                                                )
                                                    .val(),
                                                _token: $(
                                                    'meta[name="csrf-token"]'
                                                )
                                                    .attr(
                                                        "content"
                                                    )
                                            }).then((productResponse) => {
                                                console.log(productResponse);
                                                $(productMainParent).find('.taxes_in_perc').val(`${productResponse.taxesNamesAndValues} \n Quotation taxes are : ${response.taxesNamesAndValues}`)
                                                // productSubTotalWithTax  taxesValueSum
                                                $(productMainParent).find('.price_qty_keyup').on('keyup', function () {
                                                    $(productMainParent).find('.sub_total').val(productSubTotalWithTax($(productMainParent).find('.unit_price'), $(productMainParent).find('.qty'), productResponse.taxesValueSum))

                                                })
                                                // show total amount start 
                                                let priceQtyFill = 0
                                                let totalAmountPerPro = []

                                                $('.price_qty_keyup').on('keyup', function () {
                                                    const qtyArray = $('.qty')
                                                    const unitPriceArray = $('.unit_price')
                                                    priceQtyFill = 0;
                                                    totalAmountPerPro = []

                                                    // alert('click')
                                                    const priceQtyCount = $('.unit_price').length + $('.qty').length
                                                    let inc = 0

                                                    $('.unit_price').each((key, value) => {
                                                        if ($(value).val() != "") {
                                                            priceQtyFill++

                                                        }
                                                        const qty = $(qtyArray)[inc]
                                                        if ($(qty).val() != "") {
                                                            priceQtyFill++
                                                        }
                                                        inc++

                                                    })
                                                    // console.log(priceQtyFill);
                                                    inc = 0;
                                                    // console.log(priceQtyFill);

                                                    if (priceQtyFill == priceQtyCount) {
                                                        let j = 0
                                                        // const qtySingle=  $('.qty')[j]
                                                        // alert('both are equal')
                                                        $('.unit_price').each((key, value) => {
                                                            const singleQty = $('.qty')[j]
                                                            totalAmountPerPro.push(parseInt($(value).val()) * parseInt($(singleQty).val()))
                                                            // console.log(j);


                                                            j++

                                                        })

                                                        // console.log(totalAmountPerPro);
                                                        const totalAmount = totalAmountPerPro.reduce((carrier, item) => {
                                                            return carrier + item
                                                        })
                                                        const tax = response.taxesValueSum / 100
                                                        const taxRate = totalAmount * tax
                                                        // alert(taxRate)
                                                        const subTotalAll = []
                                                        $('.sub_total').each((key, value) => {
                                                            subTotalAll.push(parseInt($(value).val()));
                                                        })
                                                        console.log(subTotalAll);
                                                        const subTotalAllSum = subTotalAll.reduce((carrier, item) => {
                                                            return carrier + item
                                                        })
                                                        // console.log(subTotalAllSum);
                                                        $('#total_amount').val(subTotalAllSum + taxRate)


                                                        // console.log(totalAmount);
                                                    }
                                                    else {
                                                        $('#total_amount').val("")
                                                    }



                                                })
                                                // show total amount end 

                                            })

                                            // pro taxes end 
                                            // taxesNamesAndValues
                                        })

                                        // this block will show subtotal and total amount start 

                                    }
                                    else {
                                        afterEmptyFields(productMainParent)
                                        proTaxesInfo(
                                            base_url +
                                            "product_taxes_select_field", {
                                            proTaxesNames: $(productMainParent).find(
                                                '.pro_taxes'
                                            )
                                                .val(),
                                            _token: $(
                                                'meta[name="csrf-token"]'
                                            )
                                                .attr(
                                                    "content"
                                                )
                                        }).then((response) => {
                                            // console.log(response)
                                            $(productMainParent).find('.taxes_in_perc').val(response.taxesNamesAndValues)
                                            $(productMainParent).find('.price_qty_keyup').off('keyup')
                                            $(productMainParent).find('.price_qty_keyup').on('keyup', function () {
                                                $(productMainParent).find('.sub_total').val(productSubTotalWithTax($(productMainParent).find('.unit_price'), $(productMainParent).find('.qty'), response.taxesValueSum))


                                            })
                                            // show total amount start 
                                            let priceQtyFill = 0
                                            let totalAmountPerPro = []

                                            $('.price_qty_keyup').on('keyup', function () {
                                                const qtyArray = $('.qty')
                                                const unitPriceArray = $('.unit_price')
                                                priceQtyFill = 0;
                                                totalAmountPerPro = []

                                                // alert('click')
                                                const priceQtyCount = $('.unit_price').length + $('.qty').length
                                                let inc = 0

                                                $('.unit_price').each((key, value) => {
                                                    if ($(value).val() != "") {
                                                        priceQtyFill++

                                                    }
                                                    const qty = $(qtyArray)[inc]
                                                    if ($(qty).val() != "") {
                                                        priceQtyFill++
                                                    }
                                                    inc++

                                                })
                                                // console.log(priceQtyFill);
                                                inc = 0;
                                                // console.log(priceQtyFill);

                                                if (priceQtyFill == priceQtyCount) {
                                                    let j = 0
                                                    // const qtySingle=  $('.qty')[j]
                                                    // alert('both are equal')
                                                    $('.unit_price').each((key, value) => {
                                                        const singleQty = $('.qty')[j]
                                                        totalAmountPerPro.push(parseInt($(value).val()) * parseInt($(singleQty).val()))
                                                        // console.log(j);


                                                        j++

                                                    })

                                                    // console.log(totalAmountPerPro);
                                                    const totalAmount = totalAmountPerPro.reduce((carrier, item) => {
                                                        return carrier + item
                                                    })
                                                    const tax = response.taxesValueSum / 100
                                                    const taxRate = totalAmount * tax
                                                    // alert(taxRate)
                                                    const subTotalAll = []
                                                    $('.sub_total').each((key, value) => {
                                                        subTotalAll.push(parseInt($(value).val()));
                                                    })
                                                    console.log(subTotalAll);
                                                    const subTotalAllSum = subTotalAll.reduce((carrier, item) => {
                                                        return carrier + item
                                                    })
                                                    // console.log(subTotalAllSum);
                                                    $('#total_amount').val(subTotalAllSum)


                                                    // console.log(totalAmount);
                                                }
                                                else {
                                                    $('#total_amount').val("")
                                                }



                                            })
                                            // show total amount end 
                                        })

                                    }



                                }
                                else {
                                    afterEmptyFields(productMainParent)
                                    if ($('.taxes').val() != "") {
                                        proTaxesInfo(
                                            base_url +
                                            "product_taxes_select_field", {
                                            proTaxesNames: $(
                                                '.taxes'
                                            )
                                                .val(),
                                            _token: $(
                                                'meta[name="csrf-token"]'
                                            )
                                                .attr(
                                                    "content"
                                                )
                                        }).then((response) => {
                                            $(productMainParent).find('.taxes_in_perc').val(`Quotation taxes are :  ${response.taxesNamesAndValues}`)
                                            showSubTotalWithOutTaxAfterAddItem(productMainParent)
                                            // alert('pro  taxes are empty and taxes not empty')
                                            // show total amount start 
                                            let priceQtyFill = 0
                                            let totalAmountPerPro = []

                                            $('.price_qty_keyup').on('keyup', function () {
                                                const qtyArray = $('.qty')
                                                const unitPriceArray = $('.unit_price')
                                                priceQtyFill = 0;
                                                totalAmountPerPro = []

                                                // alert('click')
                                                const priceQtyCount = $('.unit_price').length + $('.qty').length
                                                let inc = 0

                                                $('.unit_price').each((key, value) => {
                                                    if ($(value).val() != "") {
                                                        priceQtyFill++

                                                    }
                                                    const qty = $(qtyArray)[inc]
                                                    if ($(qty).val() != "") {
                                                        priceQtyFill++
                                                    }
                                                    inc++

                                                })
                                                // console.log(priceQtyFill);
                                                inc = 0;
                                                // console.log(priceQtyFill);

                                                if (priceQtyFill == priceQtyCount) {
                                                    let j = 0
                                                    // const qtySingle=  $('.qty')[j]
                                                    // alert('both are equal')
                                                    $('.unit_price').each((key, value) => {
                                                        const singleQty = $('.qty')[j]
                                                        totalAmountPerPro.push(parseInt($(value).val()) * parseInt($(singleQty).val()))
                                                        // console.log(j);


                                                        j++

                                                    })

                                                    // console.log(totalAmountPerPro);
                                                    const totalAmount = totalAmountPerPro.reduce((carrier, item) => {
                                                        return carrier + item
                                                    })
                                                    const tax = response.taxesValueSum / 100
                                                    const taxRate = totalAmount * tax
                                                    // alert(taxRate)
                                                    const subTotalAll = []
                                                    $('.sub_total').each((key, value) => {
                                                        subTotalAll.push(parseInt($(value).val()));
                                                    })
                                                    console.log(subTotalAll);
                                                    const subTotalAllSum = subTotalAll.reduce((carrier, item) => {
                                                        return carrier + item
                                                    })
                                                    // console.log(subTotalAllSum);
                                                    $('#total_amount').val(subTotalAllSum + taxRate)


                                                    // console.log(totalAmount);
                                                }
                                                else {
                                                    $('#total_amount').val("")
                                                }



                                            })
                                            // show total amount end 





                                        })

                                    } else {
                                        showSubTotalWithOutTaxAfterAddItem(productMainParent)
                                        // show total amount start 
                                        let priceQtyFill = 0
                                        let totalAmountPerPro = []

                                        $('.price_qty_keyup').on('keyup', function () {
                                            const qtyArray = $('.qty')
                                            const unitPriceArray = $('.unit_price')
                                            priceQtyFill = 0;
                                            totalAmountPerPro = []

                                            // alert('click')
                                            const priceQtyCount = $('.unit_price').length + $('.qty').length
                                            let inc = 0

                                            $('.unit_price').each((key, value) => {
                                                if ($(value).val() != "") {
                                                    priceQtyFill++

                                                }
                                                const qty = $(qtyArray)[inc]
                                                if ($(qty).val() != "") {
                                                    priceQtyFill++
                                                }
                                                inc++

                                            })
                                            // console.log(priceQtyFill);
                                            inc = 0;
                                            // console.log(priceQtyFill);

                                            if (priceQtyFill == priceQtyCount) {
                                                let j = 0
                                                // const qtySingle=  $('.qty')[j]
                                                // alert('both are equal')
                                                $('.unit_price').each((key, value) => {
                                                    const singleQty = $('.qty')[j]
                                                    totalAmountPerPro.push(parseInt($(value).val()) * parseInt($(singleQty).val()))
                                                    // console.log(j);


                                                    j++

                                                })

                                                // console.log(totalAmountPerPro);
                                                const totalAmount = totalAmountPerPro.reduce((carrier, item) => {
                                                    return carrier + item
                                                })
                                                // const tax = response.taxesValueSum / 100
                                                // const taxRate = totalAmount * tax
                                                // alert(taxRate)
                                                const subTotalAll = []
                                                $('.sub_total').each((key, value) => {
                                                    subTotalAll.push(parseInt($(value).val()));
                                                })
                                                console.log(subTotalAll);
                                                const subTotalAllSum = subTotalAll.reduce((carrier, item) => {
                                                    return carrier + item
                                                })
                                                // console.log(subTotalAllSum);
                                                $('#total_amount').val(subTotalAllSum)


                                                // console.log(totalAmount);
                                            }
                                            else {
                                                $('#total_amount').val("")
                                            }

                                        })
                                        // show total amount end


                                        // $(productMainParent).find(".price_qty_keyup").on("keyup",function(){
                                        //     $(productMainParent).find(".sub_total").val(

                                        //     )
                                        // })




                                    }


                                }
                            })






                            // alert('array is empty ')



                        }
                        else {

                            // alert('server array not empty and taxes also')
                            //  in this block we get 3 arrays which are taxesNames,taxesNameValuw,taxesPercentage    for that product which have taxes start
                            let
                                taxesNames = []; // contain taxes names
                            let
                                taxesNameValue = []; // contain taxes names and values
                            let
                                taxesPercentage = []; // this array contain taxes percentage after response from product_taxes url.
                            let i = 0;
                            response[0].forEach(
                                function (item,
                                    index,
                                    arr) {
                                    taxesNameValue
                                        .push(
                                            item +
                                            '=' +
                                            response[1][i] + "%")
                                    taxesPercentage
                                        .push(response[1][i])
                                    taxesNames.push(item)
                                    i++;
                                })
                            // $(productMainParent).find('.taxes_in_perc').val(taxesNameValue)

                            // console.log($(taxesNames)); 

                            // if product have taxes then select those taxes in pro taxes start 
                            const productTaxesForDisplay = []
                            $(productMainParent).find('.pro_taxes option').each((key, value) => {

                                if (taxesNames.includes($(value).attr('value'))) {
                                    productTaxesForDisplay.push($(value).attr('value'))
                                }
                            })
                            $(productMainParent).find('.pro_taxes').val(productTaxesForDisplay).change();
                            $(productMainParent).find('.pro_taxes').prop('disabled', true)
                            // if product have taxes then select those taxes in pro taxes end

                            const taxesPercentageSum = taxesPercentage.reduce((carrier, item) => {
                                return carrier + item
                            })
                            $(productMainParent).find(".price_qty_keyup").on('keyup', function () {
                                // alert('ok')
                                $(productMainParent).find('.sub_total').val(productSubTotalWithTax($(productMainParent).find(".unit_price"), $(productMainParent).find(".qty"), taxesPercentageSum))




                            })
                            proTaxesInfo(
                                base_url +
                                "product_taxes_select_field", {
                                proTaxesNames: $(
                                    '.taxes'
                                )
                                    .val(),
                                _token: $(
                                    'meta[name="csrf-token"]'
                                )
                                    .attr(
                                        "content"
                                    )
                            }).then((response) => {
                                $(productMainParent).find('.taxes_in_perc').val(`${taxesNameValue} Quotation taxes are :  ${response.taxesNamesAndValues}`)
                                // show total amount start 
                                let priceQtyFill = 0
                                let totalAmountPerPro = []

                                $('.price_qty_keyup').on('keyup', function () {
                                    const qtyArray = $('.qty')
                                    const unitPriceArray = $('.unit_price')
                                    priceQtyFill = 0;
                                    totalAmountPerPro = []

                                    // alert('click')
                                    const priceQtyCount = $('.unit_price').length + $('.qty').length
                                    let inc = 0

                                    $('.unit_price').each((key, value) => {
                                        if ($(value).val() != "") {
                                            priceQtyFill++

                                        }
                                        const qty = $(qtyArray)[inc]
                                        if ($(qty).val() != "") {
                                            priceQtyFill++
                                        }
                                        inc++

                                    })
                                    // console.log(priceQtyFill);
                                    inc = 0;
                                    // console.log(priceQtyFill);

                                    if (priceQtyFill == priceQtyCount) {
                                        let j = 0
                                        // const qtySingle=  $('.qty')[j]
                                        // alert('both are equal')
                                        $('.unit_price').each((key, value) => {
                                            const singleQty = $('.qty')[j]
                                            totalAmountPerPro.push(parseInt($(value).val()) * parseInt($(singleQty).val()))
                                            // console.log(j);


                                            j++

                                        })

                                        // console.log(totalAmountPerPro);
                                        const totalAmount = totalAmountPerPro.reduce((carrier, item) => {
                                            return carrier + item
                                        })
                                        const tax = response.taxesValueSum / 100
                                        const taxRate = totalAmount * tax
                                        // alert(taxRate)
                                        const subTotalAll = []
                                        $('.sub_total').each((key, value) => {
                                            subTotalAll.push(parseInt($(value).val()));
                                        })
                                        console.log(subTotalAll);
                                        const subTotalAllSum = subTotalAll.reduce((carrier, item) => {
                                            return carrier + item
                                        })
                                        // console.log(subTotalAllSum);
                                        $('#total_amount').val(subTotalAllSum + taxRate)


                                        // console.log(totalAmount);
                                    }
                                    else {
                                        $('#total_amount').val("")
                                    }



                                })
                                // show total amount start 
                            })



                            //  in this block we get 3 arrays which are taxesNames,taxesNameValuw,taxesPercentage  for that product which have taxes end



                            $('.taxes').on('change', function () {
                                $('#total_amount').val("")
                                afterEmptyFields(productMainParent)
                                const taxesValue = $(this).val();
                                if ($(this).val() != "") {
                                    const productTaxesLength = $('.pro_taxes').length




                                    // alert(productTaxesLength)
                                    $('.pro_taxes').each((key, value) => {
                                        const taxesMainParent = $(value).closest('.parent');
                                        if ($(value).val().length != 0) {
                                            // current


                                            // console.log($(value).val().length);
                                            // $(value).val()
                                            proTaxesInfo(
                                                base_url +
                                                "product_taxes_select_field", {
                                                proTaxesNames:
                                                    taxesValue,
                                                _token: $(
                                                    'meta[name="csrf-token"]'
                                                )
                                                    .attr(
                                                        "content"
                                                    )
                                            }).then((response) => {
                                                // console.log(response);
                                                proTaxesInfo(
                                                    base_url +
                                                    "product_taxes_select_field", {
                                                    proTaxesNames:
                                                        $(value).val(),
                                                    _token: $(
                                                        'meta[name="csrf-token"]'
                                                    )
                                                        .attr(
                                                            "content"
                                                        )
                                                }).then((productResponse) => {
                                                    $('#total_amount').val("")
                                                    $(taxesMainParent).find('.taxes_in_perc').val(`${productResponse.taxesNamesAndValues} \n Quotation taxes are : ${response.taxesNamesAndValues}`)


                                                    // show total amount start 
                                                    let priceQtyFill = 0
                                                    let totalAmountPerPro = []

                                                    $('.price_qty_keyup').on('keyup', function () {
                                                        const qtyArray = $('.qty')
                                                        const unitPriceArray = $('.unit_price')
                                                        priceQtyFill = 0;
                                                        totalAmountPerPro = []

                                                        // alert('click')
                                                        const priceQtyCount = $('.unit_price').length + $('.qty').length
                                                        let inc = 0

                                                        $('.unit_price').each((key, value) => {
                                                            if ($(value).val() != "") {
                                                                priceQtyFill++

                                                            }
                                                            const qty = $(qtyArray)[inc]
                                                            if ($(qty).val() != "") {
                                                                priceQtyFill++
                                                            }
                                                            inc++

                                                        })
                                                        // console.log(priceQtyFill);
                                                        inc = 0;
                                                        // console.log(priceQtyFill);

                                                        if (priceQtyFill == priceQtyCount) {
                                                            let j = 0
                                                            // const qtySingle=  $('.qty')[j]
                                                            // alert('both are equal')
                                                            $('.unit_price').each((key, value) => {
                                                                const singleQty = $('.qty')[j]
                                                                totalAmountPerPro.push(parseInt($(value).val()) * parseInt($(singleQty).val()))
                                                                // console.log(j);


                                                                j++

                                                            })

                                                            // console.log(totalAmountPerPro);
                                                            const totalAmount = totalAmountPerPro.reduce((carrier, item) => {
                                                                return carrier + item
                                                            })
                                                            const tax = response.taxesValueSum / 100
                                                            const taxRate = totalAmount * tax
                                                            // alert(taxRate)
                                                            const subTotalAll = []
                                                            $('.sub_total').each((key, value) => {
                                                                subTotalAll.push(parseInt($(value).val()));
                                                            })
                                                            console.log(subTotalAll);
                                                            const subTotalAllSum = subTotalAll.reduce((carrier, item) => {
                                                                return carrier + item
                                                            })
                                                            // console.log(subTotalAllSum);
                                                            $('#total_amount').val(subTotalAllSum + taxRate)


                                                            // console.log(totalAmount);
                                                        }
                                                        else {
                                                            $('#total_amount').val("")
                                                        }

                                                    })
                                                    // show total amount end
                                                })

                                            })

                                        }
                                        else {

                                            // alert('pro taxes empty')
                                            proTaxesInfo(
                                                base_url +
                                                "product_taxes_select_field", {
                                                proTaxesNames:
                                                    $('.taxes').val(),
                                                _token: $(
                                                    'meta[name="csrf-token"]'
                                                )
                                                    .attr(
                                                        "content"
                                                    )
                                            }).then((response) => {
                                                // console.log(response);
                                                $(taxesMainParent).find('.taxes_in_perc').val(`Quotation taxes are :  ${response.taxesNamesAndValues}`)
                                                // show total amount start 
                                                let priceQtyFill = 0
                                                let totalAmountPerPro = []

                                                $('.price_qty_keyup').on('keyup', function () {
                                                    const qtyArray = $('.qty')
                                                    const unitPriceArray = $('.unit_price')
                                                    priceQtyFill = 0;
                                                    totalAmountPerPro = []

                                                    // alert('click')
                                                    const priceQtyCount = $('.unit_price').length + $('.qty').length
                                                    let inc = 0

                                                    $('.unit_price').each((key, value) => {
                                                        if ($(value).val() != "") {
                                                            priceQtyFill++

                                                        }
                                                        const qty = $(qtyArray)[inc]
                                                        if ($(qty).val() != "") {
                                                            priceQtyFill++
                                                        }
                                                        inc++

                                                    })
                                                    // console.log(priceQtyFill);
                                                    inc = 0;
                                                    // console.log(priceQtyFill);

                                                    if (priceQtyFill == priceQtyCount) {
                                                        let j = 0
                                                        // const qtySingle=  $('.qty')[j]
                                                        // alert('both are equal')
                                                        $('.unit_price').each((key, value) => {
                                                            const singleQty = $('.qty')[j]
                                                            totalAmountPerPro.push(parseInt($(value).val()) * parseInt($(singleQty).val()))
                                                            // console.log(j);


                                                            j++

                                                        })

                                                        // console.log(totalAmountPerPro);
                                                        const totalAmount = totalAmountPerPro.reduce((carrier, item) => {
                                                            return carrier + item
                                                        })
                                                        const tax = response.taxesValueSum / 100
                                                        const taxRate = totalAmount * tax
                                                        // alert(taxRate)
                                                        const subTotalAll = []
                                                        $('.sub_total').each((key, value) => {
                                                            subTotalAll.push(parseInt($(value).val()));
                                                        })
                                                        console.log(subTotalAll);
                                                        const subTotalAllSum = subTotalAll.reduce((carrier, item) => {
                                                            return carrier + item
                                                        })
                                                        // console.log(subTotalAllSum);
                                                        $('#total_amount').val(subTotalAllSum + taxRate)


                                                        // console.log(totalAmount);
                                                    }
                                                    else {
                                                        $('#total_amount').val("")
                                                    }
                                                })
                                                // show total amount start

                                            })
                                        }
                                    })

                                }
                                else {
                                    $('.pro_taxes').each((key, value) => {
                                        const taxesMainParent = $(value).closest('.parent');
                                        if ($(value).val().length != 0) {
                                            // alert('only product taxes are filled and taxes empth ')
                                            afterEmptyFields(taxesMainParent)
                                            proTaxesInfo(
                                                base_url +
                                                "product_taxes_select_field", {
                                                proTaxesNames:
                                                    $(value).val(),
                                                _token: $(
                                                    'meta[name="csrf-token"]'
                                                )
                                                    .attr(
                                                        "content"
                                                    )
                                            }).then((response) => {
                                                // console.log(response);
                                                $(taxesMainParent).find('.taxes_in_perc').val(response.taxesNamesAndValues)
                                                $(taxesMainParent).find('.price_qty_keyup').off('keyup')

                                                $(taxesMainParent).find('.price_qty_keyup').on('keyup', function () {
                                                    const priceQtyMainParent = $(this).closest('.parent')
                                                    // console.log(priceQtyMainParent);
                                                    $(priceQtyMainParent).find('.sub_total').val(
                                                        productSubTotalWithTax($(priceQtyMainParent).find('.unit_price'), $(priceQtyMainParent).find('.qty'), response.taxesValueSum)
                                                    )


                                                })
                                                // show total amount start 
                                                let priceQtyFill = 0
                                                let totalAmountPerPro = []

                                                $('.price_qty_keyup').on('keyup', function () {
                                                    const qtyArray = $('.qty')
                                                    const unitPriceArray = $('.unit_price')
                                                    priceQtyFill = 0;
                                                    totalAmountPerPro = []

                                                    // alert('click')
                                                    const priceQtyCount = $('.unit_price').length + $('.qty').length
                                                    let inc = 0

                                                    $('.unit_price').each((key, value) => {
                                                        if ($(value).val() != "") {
                                                            priceQtyFill++

                                                        }
                                                        const qty = $(qtyArray)[inc]
                                                        if ($(qty).val() != "") {
                                                            priceQtyFill++
                                                        }
                                                        inc++

                                                    })
                                                    // console.log(priceQtyFill);
                                                    inc = 0;
                                                    // console.log(priceQtyFill);

                                                    if (priceQtyFill == priceQtyCount) {
                                                        let j = 0
                                                        // const qtySingle=  $('.qty')[j]
                                                        // alert('both are equal')
                                                        $('.unit_price').each((key, value) => {
                                                            const singleQty = $('.qty')[j]
                                                            totalAmountPerPro.push(parseInt($(value).val()) * parseInt($(singleQty).val()))
                                                            // console.log(j);


                                                            j++

                                                        })

                                                        // console.log(totalAmountPerPro);
                                                        const totalAmount = totalAmountPerPro.reduce((carrier, item) => {
                                                            return carrier + item
                                                        })
                                                        // const tax = response.taxesValueSum / 100
                                                        // const taxRate = totalAmount * tax
                                                        // alert(taxRate)
                                                        const subTotalAll = []
                                                        $('.sub_total').each((key, value) => {
                                                            subTotalAll.push(parseInt($(value).val()));
                                                        })
                                                        console.log(subTotalAll);
                                                        const subTotalAllSum = subTotalAll.reduce((carrier, item) => {
                                                            return carrier + item
                                                        })
                                                        // console.log(subTotalAllSum);
                                                        $('#total_amount').val(subTotalAllSum)


                                                        // console.log(totalAmount);
                                                    }
                                                    else {
                                                        $('#total_amount').val("")
                                                    }

                                                })
                                                // show total amount end







                                            })


                                        }
                                        else {
                                            $(taxesMainParent).find('.price_qty_keyup').off('keyup')
                                            $(taxesMainParent).find('.price_qty_keyup').on("keyup", () => {
                                                $(taxesMainParent).find('.sub_total').val(

                                                    showSubTotalWithOutTaxAfterAddItem(taxesMainParent)
                                                )

                                                // show total amount start 
                                                let priceQtyFill = 0
                                                let totalAmountPerPro = []

                                                $('.price_qty_keyup').on('keyup', function () {
                                                    const qtyArray = $('.qty')
                                                    const unitPriceArray = $('.unit_price')
                                                    priceQtyFill = 0;
                                                    totalAmountPerPro = []

                                                    // alert('click')
                                                    const priceQtyCount = $('.unit_price').length + $('.qty').length
                                                    let inc = 0

                                                    $('.unit_price').each((key, value) => {
                                                        if ($(value).val() != "") {
                                                            priceQtyFill++

                                                        }
                                                        const qty = $(qtyArray)[inc]
                                                        if ($(qty).val() != "") {
                                                            priceQtyFill++
                                                        }
                                                        inc++

                                                    })
                                                    // console.log(priceQtyFill);
                                                    inc = 0;
                                                    // console.log(priceQtyFill);

                                                    if (priceQtyFill == priceQtyCount) {
                                                        let j = 0
                                                        // const qtySingle=  $('.qty')[j]
                                                        // alert('both are equal')
                                                        $('.unit_price').each((key, value) => {
                                                            const singleQty = $('.qty')[j]
                                                            totalAmountPerPro.push(parseInt($(value).val()) * parseInt($(singleQty).val()))
                                                            // console.log(j);


                                                            j++

                                                        })

                                                        // console.log(totalAmountPerPro);
                                                        const totalAmount = totalAmountPerPro.reduce((carrier, item) => {
                                                            return carrier + item
                                                        })
                                                        // const tax = response.taxesValueSum / 100
                                                        // const taxRate = totalAmount * tax
                                                        // alert(taxRate)
                                                        const subTotalAll = []
                                                        $('.sub_total').each((key, value) => {
                                                            subTotalAll.push(parseInt($(value).val()));
                                                        })
                                                        console.log(subTotalAll);
                                                        const subTotalAllSum = subTotalAll.reduce((carrier, item) => {
                                                            return carrier + item
                                                        })
                                                        // console.log(subTotalAllSum);
                                                        $('#total_amount').val(subTotalAllSum)


                                                        // console.log(totalAmount);
                                                    }
                                                    else {
                                                        $('#total_amount').val("")
                                                    }

                                                })
                                                // show total amount end


                                            })




                                        }

                                    })



                                }
                            })

                            $(productMainParent).find('.pro_taxes').on('change', function () {
                                // afterEmptyFields()
                                afterEmptyFields(productMainParent)
                                $('#total_amount').val("")

                                if ($(this).val() != "") {
                                    if ($('.taxes').val() != "") {
                                        // afterEmptyFields()
                                        // this block will show subtotal and total amount start 
                                        proTaxesInfo(
                                            base_url +
                                            "product_taxes_select_field", {
                                            proTaxesNames: $(
                                                '.taxes'
                                            )
                                                .val(),
                                            _token: $(
                                                'meta[name="csrf-token"]'
                                            )
                                                .attr(
                                                    "content"
                                                )
                                        }).then((response) => {
                                            proTaxesInfo(
                                                base_url +
                                                "product_taxes_select_field", {
                                                proTaxesNames: $(productMainParent).find(
                                                    '.pro_taxes'
                                                )
                                                    .val(),
                                                _token: $(
                                                    'meta[name="csrf-token"]'
                                                )
                                                    .attr(
                                                        "content"
                                                    )
                                            }).then((productResponse) => {
                                                console.log(productResponse);
                                                $(productMainParent).find('.taxes_in_perc').val(`${productResponse.taxesNamesAndValues} \n Quotation taxes are : ${response.taxesNamesAndValues}`)
                                                // productSubTotalWithTax  taxesValueSum
                                                $(productMainParent).find('.price_qty_keyup').on('keyup', function () {
                                                    $(productMainParent).find('.sub_total').val(productSubTotalWithTax($(productMainParent).find('.unit_price'), $(productMainParent).find('.qty'), productResponse.taxesValueSum))

                                                })
                                                // show total amount start 
                                                let priceQtyFill = 0
                                                let totalAmountPerPro = []

                                                $('.price_qty_keyup').on('keyup', function () {
                                                    const qtyArray = $('.qty')
                                                    const unitPriceArray = $('.unit_price')
                                                    priceQtyFill = 0;
                                                    totalAmountPerPro = []

                                                    // alert('click')
                                                    const priceQtyCount = $('.unit_price').length + $('.qty').length
                                                    let inc = 0

                                                    $('.unit_price').each((key, value) => {
                                                        if ($(value).val() != "") {
                                                            priceQtyFill++

                                                        }
                                                        const qty = $(qtyArray)[inc]
                                                        if ($(qty).val() != "") {
                                                            priceQtyFill++
                                                        }
                                                        inc++

                                                    })
                                                    // console.log(priceQtyFill);
                                                    inc = 0;
                                                    // console.log(priceQtyFill);

                                                    if (priceQtyFill == priceQtyCount) {
                                                        let j = 0
                                                        // const qtySingle=  $('.qty')[j]
                                                        // alert('both are equal')
                                                        $('.unit_price').each((key, value) => {
                                                            const singleQty = $('.qty')[j]
                                                            totalAmountPerPro.push(parseInt($(value).val()) * parseInt($(singleQty).val()))
                                                            // console.log(j);


                                                            j++

                                                        })

                                                        // console.log(totalAmountPerPro);
                                                        const totalAmount = totalAmountPerPro.reduce((carrier, item) => {
                                                            return carrier + item
                                                        })
                                                        const tax = response.taxesValueSum / 100
                                                        const taxRate = totalAmount * tax
                                                        // alert(taxRate)
                                                        const subTotalAll = []
                                                        $('.sub_total').each((key, value) => {
                                                            subTotalAll.push(parseInt($(value).val()));
                                                        })
                                                        console.log(subTotalAll);
                                                        const subTotalAllSum = subTotalAll.reduce((carrier, item) => {
                                                            return carrier + item
                                                        })
                                                        // console.log(subTotalAllSum);
                                                        $('#total_amount').val(subTotalAllSum + taxRate)


                                                        // console.log(totalAmount);
                                                    }
                                                    else {
                                                        $('#total_amount').val("")
                                                    }



                                                })
                                                // show total amount end 

                                            })

                                            // pro taxes end 
                                            // taxesNamesAndValues
                                        })

                                        // this block will show subtotal and total amount start 

                                    }
                                    else {
                                        afterEmptyFields(productMainParent)
                                        proTaxesInfo(
                                            base_url +
                                            "product_taxes_select_field", {
                                            proTaxesNames: $(productMainParent).find(
                                                '.pro_taxes'
                                            )
                                                .val(),
                                            _token: $(
                                                'meta[name="csrf-token"]'
                                            )
                                                .attr(
                                                    "content"
                                                )
                                        }).then((response) => {
                                            // console.log(response)
                                            $(productMainParent).find('.taxes_in_perc').val(response.taxesNamesAndValues)
                                            $(productMainParent).find('.price_qty_keyup').off('keyup')
                                            $(productMainParent).find('.price_qty_keyup').on('keyup', function () {
                                                $(productMainParent).find('.sub_total').val(productSubTotalWithTax($(productMainParent).find('.unit_price'), $(productMainParent).find('.qty'), response.taxesValueSum))


                                            })
                                            // show total amount start 
                                            let priceQtyFill = 0
                                            let totalAmountPerPro = []

                                            $('.price_qty_keyup').on('keyup', function () {
                                                const qtyArray = $('.qty')
                                                const unitPriceArray = $('.unit_price')
                                                priceQtyFill = 0;
                                                totalAmountPerPro = []

                                                // alert('click')
                                                const priceQtyCount = $('.unit_price').length + $('.qty').length
                                                let inc = 0

                                                $('.unit_price').each((key, value) => {
                                                    if ($(value).val() != "") {
                                                        priceQtyFill++

                                                    }
                                                    const qty = $(qtyArray)[inc]
                                                    if ($(qty).val() != "") {
                                                        priceQtyFill++
                                                    }
                                                    inc++

                                                })
                                                // console.log(priceQtyFill);
                                                inc = 0;
                                                // console.log(priceQtyFill);

                                                if (priceQtyFill == priceQtyCount) {
                                                    let j = 0
                                                    // const qtySingle=  $('.qty')[j]
                                                    // alert('both are equal')
                                                    $('.unit_price').each((key, value) => {
                                                        const singleQty = $('.qty')[j]
                                                        totalAmountPerPro.push(parseInt($(value).val()) * parseInt($(singleQty).val()))
                                                        // console.log(j);


                                                        j++

                                                    })

                                                    // console.log(totalAmountPerPro);
                                                    const totalAmount = totalAmountPerPro.reduce((carrier, item) => {
                                                        return carrier + item
                                                    })
                                                    const tax = response.taxesValueSum / 100
                                                    const taxRate = totalAmount * tax
                                                    // alert(taxRate)
                                                    const subTotalAll = []
                                                    $('.sub_total').each((key, value) => {
                                                        subTotalAll.push(parseInt($(value).val()));
                                                    })
                                                    console.log(subTotalAll);
                                                    const subTotalAllSum = subTotalAll.reduce((carrier, item) => {
                                                        return carrier + item
                                                    })
                                                    // console.log(subTotalAllSum);
                                                    $('#total_amount').val(subTotalAllSum)


                                                    // console.log(totalAmount);
                                                }
                                                else {
                                                    $('#total_amount').val("")
                                                }



                                            })
                                            // show total amount end 
                                        })

                                    }



                                }
                                else {
                                    afterEmptyFields(productMainParent)
                                    if ($('.taxes').val() != "") {
                                        proTaxesInfo(
                                            base_url +
                                            "product_taxes_select_field", {
                                            proTaxesNames: $(
                                                '.taxes'
                                            )
                                                .val(),
                                            _token: $(
                                                'meta[name="csrf-token"]'
                                            )
                                                .attr(
                                                    "content"
                                                )
                                        }).then((response) => {
                                            $(productMainParent).find('.taxes_in_perc').val(`Quotation taxes are :  ${response.taxesNamesAndValues}`)
                                            showSubTotalWithOutTaxAfterAddItem(productMainParent)
                                            // alert('pro  taxes are empty and taxes not empty')
                                            // show total amount start 
                                            let priceQtyFill = 0
                                            let totalAmountPerPro = []

                                            $('.price_qty_keyup').on('keyup', function () {
                                                const qtyArray = $('.qty')
                                                const unitPriceArray = $('.unit_price')
                                                priceQtyFill = 0;
                                                totalAmountPerPro = []

                                                // alert('click')
                                                const priceQtyCount = $('.unit_price').length + $('.qty').length
                                                let inc = 0

                                                $('.unit_price').each((key, value) => {
                                                    if ($(value).val() != "") {
                                                        priceQtyFill++

                                                    }
                                                    const qty = $(qtyArray)[inc]
                                                    if ($(qty).val() != "") {
                                                        priceQtyFill++
                                                    }
                                                    inc++

                                                })
                                                // console.log(priceQtyFill);
                                                inc = 0;
                                                // console.log(priceQtyFill);

                                                if (priceQtyFill == priceQtyCount) {
                                                    let j = 0
                                                    // const qtySingle=  $('.qty')[j]
                                                    // alert('both are equal')
                                                    $('.unit_price').each((key, value) => {
                                                        const singleQty = $('.qty')[j]
                                                        totalAmountPerPro.push(parseInt($(value).val()) * parseInt($(singleQty).val()))
                                                        // console.log(j);


                                                        j++

                                                    })

                                                    // console.log(totalAmountPerPro);
                                                    const totalAmount = totalAmountPerPro.reduce((carrier, item) => {
                                                        return carrier + item
                                                    })
                                                    const tax = response.taxesValueSum / 100
                                                    const taxRate = totalAmount * tax
                                                    // alert(taxRate)
                                                    const subTotalAll = []
                                                    $('.sub_total').each((key, value) => {
                                                        subTotalAll.push(parseInt($(value).val()));
                                                    })
                                                    console.log(subTotalAll);
                                                    const subTotalAllSum = subTotalAll.reduce((carrier, item) => {
                                                        return carrier + item
                                                    })
                                                    // console.log(subTotalAllSum);
                                                    $('#total_amount').val(subTotalAllSum + taxRate)


                                                    // console.log(totalAmount);
                                                }
                                                else {
                                                    $('#total_amount').val("")
                                                }



                                            })
                                            // show total amount end 





                                        })

                                    } else {
                                        showSubTotalWithOutTaxAfterAddItem(productMainParent)
                                        // show total amount start 
                                        let priceQtyFill = 0
                                        let totalAmountPerPro = []

                                        $('.price_qty_keyup').on('keyup', function () {
                                            const qtyArray = $('.qty')
                                            const unitPriceArray = $('.unit_price')
                                            priceQtyFill = 0;
                                            totalAmountPerPro = []

                                            // alert('click')
                                            const priceQtyCount = $('.unit_price').length + $('.qty').length
                                            let inc = 0

                                            $('.unit_price').each((key, value) => {
                                                if ($(value).val() != "") {
                                                    priceQtyFill++

                                                }
                                                const qty = $(qtyArray)[inc]
                                                if ($(qty).val() != "") {
                                                    priceQtyFill++
                                                }
                                                inc++

                                            })
                                            // console.log(priceQtyFill);
                                            inc = 0;
                                            // console.log(priceQtyFill);

                                            if (priceQtyFill == priceQtyCount) {
                                                let j = 0
                                                // const qtySingle=  $('.qty')[j]
                                                // alert('both are equal')
                                                $('.unit_price').each((key, value) => {
                                                    const singleQty = $('.qty')[j]
                                                    totalAmountPerPro.push(parseInt($(value).val()) * parseInt($(singleQty).val()))
                                                    // console.log(j);


                                                    j++

                                                })

                                                // console.log(totalAmountPerPro);
                                                const totalAmount = totalAmountPerPro.reduce((carrier, item) => {
                                                    return carrier + item
                                                })
                                                // const tax = response.taxesValueSum / 100
                                                // const taxRate = totalAmount * tax
                                                // alert(taxRate)
                                                const subTotalAll = []
                                                $('.sub_total').each((key, value) => {
                                                    subTotalAll.push(parseInt($(value).val()));
                                                })
                                                console.log(subTotalAll);
                                                const subTotalAllSum = subTotalAll.reduce((carrier, item) => {
                                                    return carrier + item
                                                })
                                                // console.log(subTotalAllSum);
                                                $('#total_amount').val(subTotalAllSum)


                                                // console.log(totalAmount);
                                            }
                                            else {
                                                $('#total_amount').val("")
                                            }

                                        })
                                        // show total amount end


                                        // $(productMainParent).find(".price_qty_keyup").on("keyup",function(){
                                        //     $(productMainParent).find(".sub_total").val(

                                        //     )
                                        // })




                                    }


                                }
                            })





                        }

                    })
                }


            })

        })
        //------------------------------- showing total and subtotal after sending ajax request and fetch taxes end 
        // showing total and subtotal start after click add_item button -----------------------------------------------
        // taxes and pro taxes changeddd start 

        $('.taxes').on('change', function () {
            $('.price_qty_keyup').each((key, value) => {
                // console.log(value);
                $(value).off('keydown')
            })



            $('#total_amount').val("")
            $('.product_id').each((key, value) => {
                afterEmptyFields($(value).closest('.parent'))
            })
            // afterEmptyFields(productMainParent)
            const taxesValue = $(this).val();
            if ($(this).val() != "") {
                const productTaxesLength = $('.pro_taxes').length




                // alert(productTaxesLength)
                $('.pro_taxes').each((key, value) => {
                    const taxesMainParent = $(value).closest('.parent');
                    if ($(value).val().length != 0) {


                        // console.log($(value).val().length);
                        // $(value).val()
                        proTaxesInfo(
                            base_url +
                            "product_taxes_select_field", {
                            proTaxesNames:
                                taxesValue,
                            _token: $(
                                'meta[name="csrf-token"]'
                            )
                                .attr(
                                    "content"
                                )
                        }).then((response) => {
                            // console.log(response);
                            proTaxesInfo(
                                base_url +
                                "product_taxes_select_field", {
                                proTaxesNames:
                                    $(value).val(),
                                _token: $(
                                    'meta[name="csrf-token"]'
                                )
                                    .attr(
                                        "content"
                                    )
                            }).then((productResponse) => {
                                $('#total_amount').val("")
                                $(taxesMainParent).find('.taxes_in_perc').val(`${productResponse.taxesNamesAndValues} \n Quotation taxes are : ${response.taxesNamesAndValues}`)
                                // $(taxesMainParent).find('.price_qty_keyup').off('keyup')

                                $(taxesMainParent).find('.price_qty_keyup').on('keyup', function () {
                                    // alert($(this).val())
                                    // console.log( $(taxesMainParent))
                                    // current
                                    $(taxesMainParent).find('.sub_total').val(productSubTotalWithTax($(taxesMainParent).find('.unit_price'), $(taxesMainParent).find('.qty'), productResponse.taxesValueSum))






                                })




                                // show total amount start 
                                let priceQtyFill = 0
                                let totalAmountPerPro = []
                                

                                $('.price_qty_keyup').on('keyup', function () {


                                    const qtyArray = $('.qty')
                                    const unitPriceArray = $('.unit_price')
                                    
                                    priceQtyFill = 0;
                                    totalAmountPerPro = []

                                    // alert('click')
                                    const priceQtyCount = $('.unit_price').length + $('.qty').length
                                    let inc = 0

                                    $('.unit_price').each((key, value) => {
                                        if ($(value).val() != "") {
                                            priceQtyFill++

                                        }
                                        const qty = $(qtyArray)[inc]
                                        if ($(qty).val() != "") {
                                            priceQtyFill++
                                        }
                                        inc++

                                    })
                                    // console.log(priceQtyFill);
                                    inc = 0;
                                    // console.log(priceQtyFill);

                                    if (priceQtyFill == priceQtyCount) {
                                        debugger
                                        let j = 0
                                        // const qtySingle=  $('.qty')[j]
                                        // alert('both are equal')
                                        $('.unit_price').each((key, value) => {
                                            const singleQty = $('.qty')[j]
                                            totalAmountPerPro.push(parseInt($(value).val()) * parseInt($(singleQty).val()))
                                            // console.log(j);


                                            j++

                                        })

                                        // console.log(totalAmountPerPro);
                                        const totalAmount = totalAmountPerPro.reduce((carrier, item) => {
                                            return carrier + item
                                        })
                                        const tax = response.taxesValueSum / 100
                                        const taxRate = totalAmount * tax
                                        // alert(taxRate)
                                        setTimeout(() => {
                                            
                                        

                                        const subTotalAll = []
                                        $('.sub_total').each((key, value) => {
                                            subTotalAll.push($(value).val());
                                        })
                                        const subTotalAllSum = subTotalAll.reduce((carrier, item) => {
                                            return parseInt( carrier ) + parseInt( item)
                                        })
                                        // console.log(`this is : ${subTotalAllSum}`);
                                        $('.total_amount').val(subTotalAllSum + taxRate)
                                    }, 10);




                                        // console.log(totalAmount);
                                    }
                                    else {
                                        $('.total_amount').val("")
                                    }

                                })
                                // show total amount end
                            })

                        })

                    }
                    else {

                        // alert('pro taxes empty')
                        proTaxesInfo(
                            base_url +
                            "product_taxes_select_field", {
                            proTaxesNames:
                                $('.taxes').val(),
                            _token: $(
                                'meta[name="csrf-token"]'
                            )
                                .attr(
                                    "content"
                                )
                        }).then((response) => {
                            console.log(response);
                            $(taxesMainParent).find('.taxes_in_perc').val(`Quotation taxes are :  ${response.taxesNamesAndValues}`)


                            $(taxesMainParent).find('.price_qty_keyup').on("keyup", function () {
                                showSubTotalWithOutTaxAfterAddItem(taxesMainParent)

                            })

                            // show total amount start 
                            let priceQtyFill = 0
                            let totalAmountPerPro = []

                            $('.price_qty_keyup').on('keyup', function () {
                                const qtyArray = $('.qty')
                                const unitPriceArray = $('.unit_price')
                                priceQtyFill = 0;
                                totalAmountPerPro = []

                                // alert('click')
                                const priceQtyCount = $('.unit_price').length + $('.qty').length
                                let inc = 0

                                $('.unit_price').each((key, value) => {
                                    if ($(value).val() != "") {
                                        priceQtyFill++

                                    }
                                    const qty = $(qtyArray)[inc]
                                    if ($(qty).val() != "") {
                                        priceQtyFill++
                                    }
                                    inc++

                                })
                                // console.log(priceQtyFill);
                                inc = 0;
                                // console.log(priceQtyFill);

                                if (priceQtyFill == priceQtyCount) {
                                    let j = 0
                                    // const qtySingle=  $('.qty')[j]
                                    // alert('both are equal')
                                    $('.unit_price').each((key, value) => {
                                        const singleQty = $('.qty')[j]
                                        totalAmountPerPro.push(parseInt($(value).val()) * parseInt($(singleQty).val()))
                                        // console.log(j);


                                        j++

                                    })

                                    // console.log(totalAmountPerPro);
                                    const totalAmount = totalAmountPerPro.reduce((carrier, item) => {
                                        return carrier + item
                                    })
                                    const tax = response.taxesValueSum / 100
                                    const taxRate = totalAmount * tax
                                    // alert(taxRate)
                                    const subTotalAll = []
                                    $('.sub_total').each((key, value) => {
                                        subTotalAll.push(parseInt($(value).val()));
                                    })
                                    console.log(subTotalAll);
                                    const subTotalAllSum = subTotalAll.reduce((carrier, item) => {
                                        return carrier + item
                                    })
                                    // console.log(subTotalAllSum);
                                    $('#total_amount').val(subTotalAllSum + taxRate)


                                    // console.log(totalAmount);
                                }
                                else {
                                    $('#total_amount').val("")
                                }
                            })
                            // show total amount start

                        })
                    }
                })

            }
            else {
                $('.pro_taxes').each((key, value) => {
                    const taxesMainParent = $(value).closest('.parent');
                    if ($(value).val().length != 0) {
                        // alert('only product taxes are filled and taxes empth ')
                        proTaxesInfo(
                            base_url +
                            "product_taxes_select_field", {
                            proTaxesNames:
                                $(value).val(),
                            _token: $(
                                'meta[name="csrf-token"]'
                            )
                                .attr(
                                    "content"
                                )
                        }).then((response) => {
                            // console.log(response);
                            $(taxesMainParent).find('.taxes_in_perc').val(response.taxesNamesAndValues)
                            $(taxesMainParent).find('.price_qty_keyup').off('keyup')

                            $(taxesMainParent).find('.price_qty_keyup').on('keyup', function () {
                                const priceQtyMainParent = $(this).closest('.parent')
                                // console.log(priceQtyMainParent);
                                $(priceQtyMainParent).find('.sub_total').val(
                                    productSubTotalWithTax($(priceQtyMainParent).find('.unit_price'), $(priceQtyMainParent).find('.qty'), response.taxesValueSum)
                                )


                            })
                            // show total amount start 
                            let priceQtyFill = 0
                            let totalAmountPerPro = []

                            $('.price_qty_keyup').on('keyup', function () {
                                const qtyArray = $('.qty')
                                const unitPriceArray = $('.unit_price')
                                priceQtyFill = 0;
                                totalAmountPerPro = []

                                // alert('click')
                                const priceQtyCount = $('.unit_price').length + $('.qty').length
                                let inc = 0

                                $('.unit_price').each((key, value) => {
                                    if ($(value).val() != "") {
                                        priceQtyFill++

                                    }
                                    const qty = $(qtyArray)[inc]
                                    if ($(qty).val() != "") {
                                        priceQtyFill++
                                    }
                                    inc++

                                })
                                // console.log(priceQtyFill);
                                inc = 0;
                                // console.log(priceQtyFill);

                                if (priceQtyFill == priceQtyCount) {
                                    let j = 0
                                    // const qtySingle=  $('.qty')[j]
                                    // alert('both are equal')
                                    $('.unit_price').each((key, value) => {
                                        const singleQty = $('.qty')[j]
                                        totalAmountPerPro.push(parseInt($(value).val()) * parseInt($(singleQty).val()))
                                        // console.log(j);


                                        j++

                                    })

                                    // console.log(totalAmountPerPro);
                                    const totalAmount = totalAmountPerPro.reduce((carrier, item) => {
                                        return carrier + item
                                    })
                                    // const tax = response.taxesValueSum / 100
                                    // const taxRate = totalAmount * tax
                                    // alert(taxRate)
                                    const subTotalAll = []
                                    $('.sub_total').each((key, value) => {
                                        subTotalAll.push(parseInt($(value).val()));
                                    })
                                    console.log(subTotalAll);
                                    const subTotalAllSum = subTotalAll.reduce((carrier, item) => {
                                        return carrier + item
                                    })
                                    // console.log(subTotalAllSum);
                                    $('#total_amount').val(subTotalAllSum)


                                    // console.log(totalAmount);
                                }
                                else {
                                    $('#total_amount').val("")
                                }

                            })
                            // show total amount end







                        })


                    }
                    else {
                        $(taxesMainParent).find('.price_qty_keyup').off('keyup')
                        $(taxesMainParent).find('.price_qty_keyup').on("keyup", () => {
                            $(taxesMainParent).find('.sub_total').val(

                                showSubTotalWithOutTaxAfterAddItem(taxesMainParent)
                            )

                            // show total amount start 
                            let priceQtyFill = 0
                            let totalAmountPerPro = []

                            $('.price_qty_keyup').on('keyup', function () {
                                const qtyArray = $('.qty')
                                const unitPriceArray = $('.unit_price')
                                priceQtyFill = 0;
                                totalAmountPerPro = []

                                // alert('click')
                                const priceQtyCount = $('.unit_price').length + $('.qty').length
                                let inc = 0

                                $('.unit_price').each((key, value) => {
                                    if ($(value).val() != "") {
                                        priceQtyFill++

                                    }
                                    const qty = $(qtyArray)[inc]
                                    if ($(qty).val() != "") {
                                        priceQtyFill++
                                    }
                                    inc++

                                })
                                // console.log(priceQtyFill);
                                inc = 0;
                                // console.log(priceQtyFill);

                                if (priceQtyFill == priceQtyCount) {
                                    let j = 0
                                    // const qtySingle=  $('.qty')[j]
                                    // alert('both are equal')
                                    $('.unit_price').each((key, value) => {
                                        const singleQty = $('.qty')[j]
                                        totalAmountPerPro.push(parseInt($(value).val()) * parseInt($(singleQty).val()))
                                        // console.log(j);


                                        j++

                                    })

                                    // console.log(totalAmountPerPro);
                                    const totalAmount = totalAmountPerPro.reduce((carrier, item) => {
                                        return carrier + item
                                    })
                                    // const tax = response.taxesValueSum / 100
                                    // const taxRate = totalAmount * tax
                                    // alert(taxRate)
                                    const subTotalAll = []
                                    $('.sub_total').each((key, value) => {
                                        subTotalAll.push(parseInt($(value).val()));
                                    })
                                    console.log(subTotalAll);
                                    const subTotalAllSum = subTotalAll.reduce((carrier, item) => {
                                        return carrier + item
                                    })
                                    // console.log(subTotalAllSum);
                                    $('#total_amount').val(subTotalAllSum)


                                    // console.log(totalAmount);
                                }
                                else {
                                    $('#total_amount').val("")
                                }

                            })
                            // show total amount end

                        })
                    }

                })


            }
        })


        $('.pro_taxes').each((key, value) => {


            $(value).on('change', function () {
                $('.price_qty_keyup').each((key, value) => {
                    // console.log(value);
                    $(value).off('keydown')
                })

                const productMainParent = $(this).closest('.parent');

                // afterEmptyFields()
                afterEmptyFields(productMainParent)
                $('#total_amount').val("")

                if ($(this).val() != "") {
                    if ($('.taxes').val() != "") {
                        // afterEmptyFields()
                        // this block will show subtotal and total amount start 
                        proTaxesInfo(
                            base_url +
                            "product_taxes_select_field", {
                            proTaxesNames: $(
                                '.taxes'
                            )
                                .val(),
                            _token: $(
                                'meta[name="csrf-token"]'
                            )
                                .attr(
                                    "content"
                                )
                        }).then((response) => {
                            proTaxesInfo(
                                base_url +
                                "product_taxes_select_field", {
                                proTaxesNames: $(value).val(),
                                _token: $(
                                    'meta[name="csrf-token"]'
                                )
                                    .attr(
                                        "content"
                                    )
                            }).then((productResponse) => {
                                $(productMainParent).find('.taxes_in_perc').val(`${productResponse.taxesNamesAndValues} \n Quotation taxes are : ${response.taxesNamesAndValues}`)
                                // productSubTotalWithTax  taxesValueSum
                                $(productMainParent).find('.price_qty_keyup').off('keyup')
                                $(productMainParent).find('.price_qty_keyup').on('keyup', function () {
                                    $(productMainParent).find('.sub_total').val(productSubTotalWithTax($(productMainParent).find('.unit_price'), $(productMainParent).find('.qty'), productResponse.taxesValueSum))

                                })
                                // show total amount start 
                                let priceQtyFill = 0
                                let totalAmountPerPro = []

                                $('.price_qty_keyup').on('keyup', function () {
                                    const qtyArray = $('.qty')
                                    const unitPriceArray = $('.unit_price')
                                    priceQtyFill = 0;
                                    totalAmountPerPro = []

                                    // alert('click')
                                    const priceQtyCount = $('.unit_price').length + $('.qty').length
                                    let inc = 0

                                    $('.unit_price').each((key, value) => {
                                        if ($(value).val() != "") {
                                            priceQtyFill++

                                        }
                                        const qty = $(qtyArray)[inc]
                                        if ($(qty).val() != "") {
                                            priceQtyFill++
                                        }
                                        inc++

                                    })
                                    // console.log(priceQtyFill);
                                    inc = 0;
                                    // console.log(priceQtyFill);

                                    if (priceQtyFill == priceQtyCount) {
                                        let j = 0
                                        // const qtySingle=  $('.qty')[j]
                                        // alert('both are equal')
                                        $('.unit_price').each((key, value) => {
                                            const singleQty = $('.qty')[j]
                                            totalAmountPerPro.push(parseInt($(value).val()) * parseInt($(singleQty).val()))
                                            // console.log(j);


                                            j++

                                        })

                                        // console.log(totalAmountPerPro);
                                        const totalAmount = totalAmountPerPro.reduce((carrier, item) => {
                                            return carrier + item
                                        })
                                        const tax = response.taxesValueSum / 100
                                        const taxRate = totalAmount * tax
                                        // alert(taxRate)
                                        const subTotalAll = []
                                        $('.sub_total').each((key, value) => {
                                            subTotalAll.push(parseInt($(value).val()));
                                        })
                                        console.log(subTotalAll);
                                        const subTotalAllSum = subTotalAll.reduce((carrier, item) => {
                                            return carrier + item
                                        })
                                        // console.log(subTotalAllSum);
                                        $('#total_amount').val(subTotalAllSum + taxRate)


                                        // console.log(totalAmount);
                                    }
                                    else {
                                        $('#total_amount').val("")
                                    }



                                })
                                // show total amount end 

                            })

                            // pro taxes end 
                            // taxesNamesAndValues
                        })

                        // this block will show subtotal and total amount start 

                    }
                    else {

                        afterEmptyFields(productMainParent)
                        proTaxesInfo(
                            base_url +
                            "product_taxes_select_field", {
                            proTaxesNames: $(value)
                                .val(),
                            _token: $(
                                'meta[name="csrf-token"]'
                            )
                                .attr(
                                    "content"
                                )
                        }).then((response) => {
                            // console.log(response)
                            $(productMainParent).find('.taxes_in_perc').val(response.taxesNamesAndValues)
                            $(productMainParent).find('.price_qty_keyup').off('keyup')
                            $(productMainParent).find('.price_qty_keyup').on('keyup', function () {
                                $(productMainParent).find('.sub_total').val(productSubTotalWithTax($(productMainParent).find('.unit_price'), $(productMainParent).find('.qty'), response.taxesValueSum))


                            })
                            // show total amount start 
                            let priceQtyFill = 0
                            let totalAmountPerPro = []

                            $('.price_qty_keyup').on('keyup', function () {
                                const qtyArray = $('.qty')
                                const unitPriceArray = $('.unit_price')
                                priceQtyFill = 0;
                                totalAmountPerPro = []

                                // alert('click')
                                const priceQtyCount = $('.unit_price').length + $('.qty').length
                                let inc = 0

                                $('.unit_price').each((key, value) => {
                                    if ($(value).val() != "") {
                                        priceQtyFill++

                                    }
                                    const qty = $(qtyArray)[inc]
                                    if ($(qty).val() != "") {
                                        priceQtyFill++
                                    }
                                    inc++

                                })
                                // console.log(priceQtyFill);
                                inc = 0;
                                // console.log(priceQtyFill);

                                if (priceQtyFill == priceQtyCount) {
                                    let j = 0
                                    // const qtySingle=  $('.qty')[j]
                                    // alert('both are equal')
                                    $('.unit_price').each((key, value) => {
                                        const singleQty = $('.qty')[j]
                                        totalAmountPerPro.push(parseInt($(value).val()) * parseInt($(singleQty).val()))
                                        // console.log(j);


                                        j++

                                    })

                                    // console.log(totalAmountPerPro);
                                    const totalAmount = totalAmountPerPro.reduce((carrier, item) => {
                                        return carrier + item
                                    })
                                    const tax = response.taxesValueSum / 100
                                    const taxRate = totalAmount * tax
                                    // alert(taxRate)
                                    const subTotalAll = []
                                    $('.sub_total').each((key, value) => {
                                        subTotalAll.push(parseInt($(value).val()));
                                    })
                                    console.log(subTotalAll);
                                    const subTotalAllSum = subTotalAll.reduce((carrier, item) => {
                                        return carrier + item
                                    })
                                    // console.log(subTotalAllSum);
                                    $('#total_amount').val(subTotalAllSum)


                                    // console.log(totalAmount);
                                }
                                else {
                                    $('#total_amount').val("")
                                }



                            })
                            // show total amount end 
                        })

                    }



                }
                else {
                    afterEmptyFields(productMainParent)
                    if ($('.taxes').val() != "") {
                        proTaxesInfo(
                            base_url +
                            "product_taxes_select_field", {
                            proTaxesNames: $(
                                '.taxes'
                            )
                                .val(),
                            _token: $(
                                'meta[name="csrf-token"]'
                            )
                                .attr(
                                    "content"
                                )
                        }).then((response) => {
                            $(productMainParent).find('.taxes_in_perc').val(`Quotation taxes are :  ${response.taxesNamesAndValues}`)
                            showSubTotalWithOutTaxAfterAddItem(productMainParent)
                            // show total amount start 
                            let priceQtyFill = 0
                            let totalAmountPerPro = []

                            $('.price_qty_keyup').on('keyup', function () {
                                const qtyArray = $('.qty')
                                const unitPriceArray = $('.unit_price')
                                priceQtyFill = 0;
                                totalAmountPerPro = []

                                // alert('click')
                                const priceQtyCount = $('.unit_price').length + $('.qty').length
                                let inc = 0

                                $('.unit_price').each((key, value) => {
                                    if ($(value).val() != "") {
                                        priceQtyFill++

                                    }
                                    const qty = $(qtyArray)[inc]
                                    if ($(qty).val() != "") {
                                        priceQtyFill++
                                    }
                                    inc++

                                })
                                // console.log(priceQtyFill);
                                inc = 0;
                                // console.log(priceQtyFill);

                                if (priceQtyFill == priceQtyCount) {
                                    let j = 0
                                    // const qtySingle=  $('.qty')[j]
                                    // alert('both are equal')
                                    $('.unit_price').each((key, value) => {
                                        const singleQty = $('.qty')[j]
                                        totalAmountPerPro.push(parseInt($(value).val()) * parseInt($(singleQty).val()))
                                        // console.log(j);


                                        j++

                                    })

                                    // console.log(totalAmountPerPro);
                                    const totalAmount = totalAmountPerPro.reduce((carrier, item) => {
                                        return carrier + item
                                    })
                                    const tax = response.taxesValueSum / 100
                                    const taxRate = totalAmount * tax
                                    // alert(taxRate)
                                    const subTotalAll = []
                                    $('.sub_total').each((key, value) => {
                                        subTotalAll.push(parseInt($(value).val()));
                                    })
                                    console.log(subTotalAll);
                                    const subTotalAllSum = subTotalAll.reduce((carrier, item) => {
                                        return carrier + item
                                    })
                                    // console.log(subTotalAllSum);
                                    $('#total_amount').val(subTotalAllSum + taxRate)


                                    // console.log(totalAmount);
                                }
                                else {
                                    $('#total_amount').val("")
                                }



                            })
                            // show total amount end 





                        })

                    } else {

                        showSubTotalWithOutTaxAfterAddItem(productMainParent)
                        // show total amount start 
                        let priceQtyFill = 0
                        let totalAmountPerPro = []

                        $('.price_qty_keyup').on('keyup', function () {
                            const qtyArray = $('.qty')
                            const unitPriceArray = $('.unit_price')
                            priceQtyFill = 0;
                            totalAmountPerPro = []

                            // alert('click')
                            const priceQtyCount = $('.unit_price').length + $('.qty').length
                            let inc = 0

                            $('.unit_price').each((key, value) => {
                                if ($(value).val() != "") {
                                    priceQtyFill++

                                }
                                const qty = $(qtyArray)[inc]
                                if ($(qty).val() != "") {
                                    priceQtyFill++
                                }
                                inc++

                            })
                            // console.log(priceQtyFill);
                            inc = 0;
                            // console.log(priceQtyFill);

                            if (priceQtyFill == priceQtyCount) {
                                let j = 0
                                // const qtySingle=  $('.qty')[j]
                                // alert('both are equal')
                                $('.unit_price').each((key, value) => {
                                    const singleQty = $('.qty')[j]
                                    totalAmountPerPro.push(parseInt($(value).val()) * parseInt($(singleQty).val()))
                                    // console.log(j);
                                    j++
                                })
                                // console.log(totalAmountPerPro);
                                const totalAmount = totalAmountPerPro.reduce((carrier, item) => {
                                    return carrier + item
                                })
                                // const tax = response.taxesValueSum / 100
                                // const taxRate = totalAmount * tax
                                // alert(taxRate)
                                const subTotalAll = []
                                $('.sub_total').each((key, value) => {
                                    subTotalAll.push(parseInt($(value).val()));
                                })
                                console.log(subTotalAll);
                                const subTotalAllSum = subTotalAll.reduce((carrier, item) => {
                                    return carrier + item
                                })
                                // console.log(subTotalAllSum);
                                $('#total_amount').val(subTotalAllSum)


                                // console.log(totalAmount);
                            }
                            else {
                                $('#total_amount').val("")
                            }

                        })
                        // show total amount end


                        // $(productMainParent).find(".price_qty_keyup").on("keyup",function(){
                        //     $(productMainParent).find(".sub_total").val(

                        //     )
                        // })

                    }

                }
            })
        })
        // taxes and pro taxes changeddd end 


            
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
            $("#sal_order_form").validate({
                rules: {
                        ref_num: {
                            required: true,
                            number: true
                        },
                        
                        order_time: {
                            required: true,
                        },
                        supplier_id: {
                            required: true,
                        },
                        
                        order_date:{
                            required:true
                        },
                        status:{
                            required:true
                        },
                        sal_quotation_id:{
                            required:true
                            
                        }
                    },
                    messages: {
                        ref_num: {
                            required: "Refrence Number required",
                            number: "Only Numbers are allowed",
                        },
                        
                        order_time: {
                            required: "Time required",
                        },
                        supplier_id: {
                            required: 'Please select supplier',
                        },
                        
                        order_date:{
                            required:"Delivery Date required"
                        },
                        status:{
                            required:"Status required"
                        },
                        sal_quotation_id:{
                            required:"Product Quotation required"
                            
                        }


                    },
                submitHandler: function(form) {
                    // sub total  start 
                let subTotalArray = [] // contain all the product ids


if ($('.sub_total_array').length == 0) {
    $('#sal_order_form').prepend(
        `<input type="hidden" name="sub_total_array" id="sub_total_array" class="sub_total_array" value=${subTotalArray}>`
    )
}
let sTotalArray = $('.sub_total');
$(sTotalArray).each(function (key, value) {
    // console.log($(value).val());
    subTotalArray.push($(value).val())
})
$('#sub_total_array').val(subTotalArray)
// sub total end
                    // product ids start 
                    let productIdsArray = [] // contain all the product ids


                    if ($('.product_ids_array').length == 0) {
                        $('#sal_order_form').prepend(
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
                        $('#sal_order_form').prepend(
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
                        $('#sal_order_form').prepend(
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
                        $('#sal_order_form').prepend(
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
                        $('#sal_order_form').prepend(
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
                        $('#sal_order_form').prepend(
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
                        $('#sal_order_form').prepend(
                            `<input type="hidden" name="taxes_main" id="taxes_main" class="taxes_main">`
                        )
                    }
                    $('#taxes_main').val($('#taxes').val())
                    // taxes end



                    $.ajax({
                        type: "post",
                        url: base_url + "sal_order_update",
                        data: new FormData(form),
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response == 'true') {
                                // $("#sal_order_form").trigger("reset");
                                $(".sal_order_added_message")
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

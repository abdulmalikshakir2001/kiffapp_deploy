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
                {{-- start --}}

                {{-- end --}}

                <form action="" id="sal_quotation_form">
                    @csrf
                    <div class="container-fluid ">
                        <div class="row gy-4 profile_row">
                            <!--  lable div end  -->
                            <div class="col-md-12">
                                <div class="parent">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h5 class="">Add Sale Quotation </h5>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="alert alert-success  d-none text-white sal_quotation_added_message user_updated_msg"
                                                role="alert" id="sal_quotation_added_message">
                                                Sale Quotation added successfully
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
                                            <label for="supplier_id"> Customer Name </label>
                                            <select name="supplier_id" id="supplier_id" class="form-select supplier_id">
                                                <option></option>
                                                @foreach ($suppliers as $supplier)
                                                <option value="{{ $supplier->user_id }}">
                                                    {{ $supplier->username }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        
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

                                        {{-- delivery date --}}
                                        <div class="col-md-4">
                                            <label for="delivery_date">Delivery Date</label>
                                            <input type="date" name="delivery_date" id="delivery_date"
                                                class="form-control">
                                        </div>
                                        {{-- creation date --}}
                                        <div class="col-md-4">
                                            <label for="creation_date">Creation Date</label>
                                            <input type="date" name="creation_date" id="creation_date"
                                                class="form-control">
                                        </div>
                                        {{-- creation time --}}
                                        <div class="col-md-4">
                                            <label for="creation_time">Creation Time</label>
                                            <input type="time" name="creation_time" id="creation_time"
                                                class="form-control">
                                        </div>
                                        {{-- taxes --}}
                                        <div class="col-md-8">
                                            <label for="taxes"> Taxes </label>
                                            <select name="taxes" id="taxes" class="form-select taxes pro_taxes_select"
                                                multiple="multiple">
                                                <option></option>
                                                @foreach ($taxes as $tax)
                                                <option value="{{ $tax->tax_name }}">
                                                    {{ $tax->tax_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        {{-- quotation status --}}
                                        <div class="col-md-6">
                                            <label for="quotation_status"> Status </label>
                                            <select name="quotation_status" id="quotation_status"
                                                class="form-select quotation_status">
                                                <option></option>
                                                <option value="pending">Pending</option>
                                                <option value="approved">Approved</option>
                                                <option value="rejected">Rejected</option>
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
                                            <div>
                                                <label for="">Total Amount</label>

                                                <input type="text" id="total_amount" name="total_amount"
                                                    class="total_amount" placeholder="Total Amount">

                                                <button type="button" class="btn btn-primary mb-0 add_item" id=""> <i
                                                        class="fa-solid fa-plus pe-2 "></i>Add
                                                    Item
                                                </button>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- lable div end  -->

                            <!-- quotation details start  -->
                            <div class="col-md-12 product_quotation_request_detail_parent mt-0 quotation_details">
                                <div class="parent">

                                    <div class="row gy-3">
                                        {{-- product_id --}}
                                        {{-- <div class="col-md-12 d-flex justify-content-end">
                                            <button type="button" class="text-secondary delete_item  bg-white "
                                                style="border:none;"><i class="fas fa-trash-alt fs-6 text-danger"></i>
                                            </button>
                                        </div> --}}
                                        <div class="col-md-2">
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
                                        <div class="col-md-2">
                                            <label for="unit_price">Unit Price</label>
                                            <input type="text" name="unit_price" id="unit_price"
                                                class="form-control unit_price price_qty_keyup"
                                                placeholder="Unit Price">
                                        </div>
                                        {{-- quantity --}}
                                        <div class="col-md-2">
                                            <label for="quantity_first">Quantity</label>
                                            <input type="text" name="quantity" id="quantity_first"
                                                class="form-control quantity qty price_qty_keyup"
                                                placeholder="Quantity">
                                        </div>

                                        {{-- Discount --}}
                                        <div class="col-md-2">
                                            <label for="discount">Discount</label>
                                            <input type="discount" name="discount" id="discount"
                                                class="form-control discount" placeholder="Discount">
                                        </div>
                                        {{-- taxes in percent (fill by ajax when product change in select ) --}}
                                        <div class="col-md-2">
                                            <label for="taxes_in_perc">Taxes in %</label>
                                            <textarea name="taxes_in_perc" id="taxes_in_perc" cols="" rows="1"
                                                class="form-control taxes_in_perc" placeholder="Taxes %"></textarea>
                                        </div>
                                        {{-- subtotal fill by ajax when product change in select --}}
                                        <div class="col-md-2">
                                            <label for="sub_total">Sub Total</label>
                                            <input type="sub_total" name="sub_total" id="sub_total"
                                                class="form-control sub_total" placeholder="Sub Total">
                                        </div>

                                        {{-- taxes --}}
                                        <div class="col-md-8">
                                            <label for="pro_taxes"> Taxes </label>
                                            <select name="pro_taxes" id="pro_taxes"
                                                class="form-select pro_taxes  pro_taxes_main" multiple="multiple">
                                                <option></option>
                                                @foreach ($taxes as $tax)
                                                <option value="{{ $tax->tax_name }}">
                                                    {{ $tax->tax_name }}
                                                </option>
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

    </div>
</div>
@endSection
@section('page_script_links')
<script>
    $(document).ready(function () {

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
                    _token: $('meta[name="csrf-token"]').attr("content")
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

        @php
        $baseUrl = config('app.url');
                echo "var base_url = '".$baseUrl. "';";
        @endphp


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

                $('.taxes').next('.select2').find(".select2-selection__rendered")
                    .show()
                let taxesValue = $(this).val();
                if (taxesValue == "") {
                    $('#taxes-error').removeClass('d-none') // label
                } else {
                    $('#taxes-error').addClass('d-none') // label
                }
            })


            $('.pro_taxes').on('change', function () {
                let pro_taxesValue = $(this).val();
                if (pro_taxesValue == "") {
                    $('#pro_taxes-error').removeClass('d-none') // label
                } else {
                    $('#pro_taxes-error').addClass('d-none') // label
                }

            })


            // taxes fieled change  start
            $('#taxes').on('change', function (param) {
                // proTaxesAjax
                // if system product doesnot have taxes then fetch taxes for product quotation and show in subtotal with uniprice and quantity start

                $('#sub_total').val("")
                const proTaxesNames = $(this).val()
                if (proTaxesNames == "") {
                    $('.pro_taxes').prop('disabled', false)
                    $('.price_qty_keyup').on('keyup', function () {
                        $('#sub_total').val(multiplyTwoInputValues($(
                            '#unit_price'),
                            $('.qty')))

                    })

                } else {
                    $('pro_taxes').prop('disabled', true)
                    const options = {
                        method: "POST",
                        headers: {
                            "Content-type": "application/json"
                        },
                        body: JSON.stringify({
                            proTaxesNames: proTaxesNames,
                            _token: $('meta[name="csrf-token"]').attr(
                                "content")
                        })
                    }
                    const taxesNamesFromServer = fetch(base_url +
                        "product_taxes_select_field", options)
                    taxesNamesFromServer.then((response) => {
                        return response.json();

                    }).then((response) => {
                        // console.log(json);
                        if (response.length == 0) {
                            $('.price_qty_keyup').on('keyup', function () {
                                $('#sub_total').val(
                                    multiplyTwoInputValues($(
                                        '#unit_price'),
                                        $('.qty')))

                            })
                        } else {
                            // getting taxes name ,taxes name and value to show for sue , taxex percentage 
                            let
                                taxesNames = []; // contain taxes names
                            let
                                taxesNameValue = []; // contain taxes names and values
                            let
                                taxesPercentage = []; // this array contain taxes percentage after response from product_taxes url.
                            let i = 0;
                            response[0].forEach(function (item,
                                index,
                                arr) {
                                // now append  in #taxes_in_perc
                                taxesNameValue.push(item +
                                    '=' +
                                    response[1][i] + "%"
                                )
                                taxesPercentage.push(
                                    response[1]
                                    [i])
                                taxesNames.push(item)
                                i++;
                            })
                            // getting taxes name ,taxes name and value to show for sue , taxex percentage 
                            // console.log(taxesNameValue);
                            // $('#taxes_in_perc').val(taxesNameValue)
                            return taxesPercentage
                        }

                    }).then((taxesPercentage) => {
                        // add taxes percentage 
                        const totalTaxesPerProduct = taxesPercentage.reduce(
                            (carrier,
                                value) => {
                                return carrier + value

                            })
                        return totalTaxesPerProduct;


                    })
                    // .then((totalTaxesPerProduct) => {
                    //     // showing subtotal 
                    //     $('.price_qty_keyup').on('keyup', function() {
                    //         $('#sub_total').val(productSubTotalWithTax($('.unit_price'),
                    //             $('.qty'),totalTaxesPerProduct))
                    //     })

                    // })



                }


                // if system product doesnot have taxes then fetch taxes for product quotation and show in subtotal with uniprice and quantity end 
                let pro_taxesValue = $(this).val();
                if (pro_taxesValue == "") {
                    $('#pro_taxes-error').removeClass('d-none') // label
                } else {
                    $('#pro_taxes-error').addClass('d-none') // label
                }
            })
            // taxes fieled change end




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
                placeholder: "Select Customer",
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


        }





        // append product details form to another start 
        let i = 0; //for naming and ids
        $('.add_item').on("click", function () {


            let quotationDetailsArray = $(".quotation_details")
            let lastQuotationDetail = quotationDetailsArray[quotationDetailsArray
                .length - 1];

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
                                            {{-- unit price  --}}
                                            <div class="col-md-4">
                                                <label for="unit_price_${i}">Unit Price</label>
                                                <input type="text" name="unit_price_${i}" id="unit_price_${i}"
                                                    class="form-control unit_price price_qty_keyup" placeholder="Unit Price">
                                            </div>
                                            {{-- quantity --}}
                                            <div class="col-md-4">
                                                <label for="quantity_${i}">Quantity</label>
                                                <input type="text" name="quantity_${i}" id="quantity_${i}" class="form-control quantity qty price_qty_keyup"
                                                    placeholder="Quantity">
                                            </div>

                                            {{-- Discount --}}
                                            <div class="col-md-4">
                                                <label for="discount_${i}">Discount</label>
                                                <input type="text" name="discount_${i}" id="discount_${i}"
                                                    class="form-control discount" placeholder="Discount">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="taxes_in_perc_${i}">Taxes in %</label>
                                                <textarea name="taxes_in_perc_${i}" id="taxes_in_perc_${i}" cols="" rows="1" class="form-control taxes_in_perc" placeholder="Taxes %"></textarea>
                                            </div>
                                            {{-- subtotal  fill by ajax when product change in select --}}
                                            <div class="col-md-4">
                                                <label for="sub_total">Sub Total</label>
                                                <input type="sub_total" name="sub_total" id="sub_total"
                                                    class="form-control sub_total" placeholder="Sub Total">
                                            </div>

                                            {{-- taxes --}}
                                            <div class="col-md-8">
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



            // taxes change start 
            $('#taxes').on('change', function () {
                const proTaxesNames = $(this).val()
                const option = {
                    method: "POST",
                    headers: {
                        "Content-type": "application/json",
                    }
                }
            })
            // taxes change end

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
                    $(`#pro_taxes_${i}-error`).removeClass(
                        'd-none') // label
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
            // add form end 
            i++;


            // showing total and subtotal after sending ajax request and fetch taxes start ----------------------------
            const productArray = $('.product_id')
            // console.log(productArray);
            productArray.each((key, value) => {
                $(value).on('change', function () {
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
                                    // current
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
                                            $('#total_amount').val(subTotalAllSum )


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
            // current
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
            // current
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
            // current
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
            // current
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
                })

            })
            //------------------------------- showing total and subtotal after sending ajax request and fetch taxes end 
            // showing total and subtotal start after click add_item button -----------------------------------------------

        })
        // click  add_item end 

        // disable select filed fo taxes when select for full quotation product one will be disalbed and viceversa
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


        $("#sal_quotation_form").validate({
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
                
                delivery_date: {
                    required: true
                },
                quotation_status: {
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
                
                delivery_date: {
                    required: "Delivery Date required"
                },
                quotation_status: {
                    required: "Status required"
                }


            },
            submitHandler: function (form) {
                // sub total  start 
                let subTotalArray = [] // contain all the product ids


                if ($('.sub_total_array').length == 0) {
                    $('#sal_quotation_form').prepend(
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
                    $('#sal_quotation_form').prepend(
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
                    $('#sal_quotation_form').prepend(
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
                // Unit  start 
                let productUnitPriceArray = [] // contain all the product ids
                if ($('.product_unit_price_array').length == 0) {
                    $('#sal_quotation_form').prepend(
                        `<input type="hidden" name="product_unit_price_array" id="product_unit_price_array" class="product_unit_price_array" value=${productUnitPriceArray}>`
                    )
                }
                let unitPriceArray = $('.unit_price');
                $(unitPriceArray).each(function (key, value) {
                    // console.log($(value).val());
                    productUnitPriceArray.push($(value).val())
                })
                $('#product_unit_price_array').val(productUnitPriceArray)
                // Unit end
                // discount  start 
                let productDiscountArray = [] // contain all the product ids
                if ($('.product_discount_array').length == 0) {
                    $('#sal_quotation_form').prepend(
                        `<input type="hidden" name="product_discount_array" id="product_discount_array" class="product_discount_array" value=${productDiscountArray}>`
                    )
                }
                let discountArray = $('.discount');
                $(discountArray).each(function (key, value) {
                    // console.log($(value).val());
                    if ($(value).val() == "") {
                        productDiscountArray.push('0')
                    } else {

                        productDiscountArray.push($(value).val())
                    }

                })
                $('#product_discount_array').val(productDiscountArray)
                // discount end
                // pro_taxes  start 
                let productTaxesArray = {} // contain all the product ids
                if ($('.product_taxes_array').length == 0) {
                    $('#sal_quotation_form').prepend(
                        `<input type="hidden" name="product_taxes_array" id="product_taxes_array" class="product_taxes_array" value="${productTaxesArray}">`
                    )
                }
                let taxesArray = $('.pro_taxes');
                let t = 0;
                $(taxesArray).each(function (key, value) {
                    // console.log($(value).val());
                    if ($(value).val() == "") {
                        productTaxesArray['tax_' + t] = 'NULL';




                    } else {
                        productTaxesArray['tax_' + t] = $(value).val()
                            .join(
                                ',');



                    }
                    t++;

                })
                $('#product_taxes_array').val(JSON.stringify(productTaxesArray))
                // console.log(productTaxesArray);
                // pro_taxes end

                // taxes start 
                if ($('.taxes_main').length == 0) {
                    $('#sal_quotation_form').prepend(
                        `<input type="hidden" name="taxes_main" id="taxes_main" class="taxes_main">`
                    )
                }
                $('#taxes_main').val($('#taxes').val())
                // taxes end



                $.ajax({
                    type: "post",
                    url: base_url + "sal_quotation",
                    data: new FormData(form),
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response == 'true') {
                            // current
                            
                            defaultSelect2($('#supplier_id'))
                            defaultSelect2($('#quotation_status'))
                            defaultSelect2($('.taxes'))

                            $('.product_id').each((key,product)=>{
                                defaultSelect2(product)
                                const productMainParent = (product).closest('.parent')
                                $(productMainParent).find('.pro_taxes').prop('disabled',false)
                                $(productMainParent).find('.taxes_in_perc').val("")
                                defaultSelect2($(productMainParent).find('.pro_taxes'))

                            })

                            // select2-selection__rendered  /
                            $("#sal_quotation_form")
                                .trigger("reset");
                            $(".sal_quotation_added_message")
                                .removeClass("d-none");
                            window.scrollTo(0, 0)
                        }
                    },
                });
            },
        });



        // showing taxes and subtotal for product start ---------------------------------------------
        $('#product_id').on('change', function () {
            $('#total_amount').val("")
            $('.taxes').next('.select2').find('.select2-search__field').css({
                'width': '100%'
            })


            $('#unit_price').val("")
            $('#quantity_first').val("")
            $('#sub_total').val("")
            let productId = $(this).val()
            const productSelectFieldLength = $('.product_id').length;
            if (productId != "" && productSelectFieldLength == 1) {
                if ($("#taxes").val() != "") {
                    $('#taxes').on("change", function () {
                        emptyFields()
                        if ($(this).val() != "") {

                            if ($('.pro_taxes').val() != "") {
                                proTaxesInfo(
                                    base_url +
                                    "product_taxes_select_field", {
                                    proTaxesNames: $('.taxes').val(),
                                    _token: $(
                                        'meta[name="csrf-token"]'
                                    )
                                        .attr(
                                            "content"
                                        )
                                }).then((
                                    response
                                ) => {
                                    // console.log(response);
                                    proTaxesInfo
                                        (base_url +
                                            "product_taxes_select_field", {
                                            proTaxesNames: $(
                                                '.pro_taxes'
                                            )
                                                .val(),
                                            _token: $(
                                                'meta[name="csrf-token"]'
                                            )
                                                .attr(
                                                    "content"
                                                )
                                        }
                                        )
                                        .then(
                                            (
                                                proTaxesResponse
                                            ) => {
                                                $('#taxes_in_perc')
                                                    .val(
                                                        `${proTaxesResponse.taxesNamesAndValues} \n Quotation taxes are : ${response.taxesNamesAndValues}`
                                                    )
                                                $('.price_qty_keyup')
                                                    .on('keyup',
                                                        function () {
                                                            let unitPrice =
                                                                parseInt(
                                                                    $(
                                                                        '.unit_price'
                                                                    )
                                                                        .val()
                                                                )
                                                            let qty =
                                                                parseInt(
                                                                    $(
                                                                        '.qty'
                                                                    )
                                                                        .val()
                                                                )
                                                            if ($(
                                                                '.unit_price'
                                                            )
                                                                .val() !=
                                                                "" &&
                                                                $(
                                                                    ".qty"
                                                                )
                                                                    .val() !=
                                                                ""
                                                            ) {
                                                                let tax =
                                                                    response
                                                                        .taxesValueSum /
                                                                    100
                                                                const
                                                                    totalPriceWithOutTax =
                                                                        unitPrice *
                                                                        qty
                                                                const
                                                                    taxRateOfTaxField =
                                                                        totalPriceWithOutTax *
                                                                        tax

                                                                const
                                                                    taxProTaxes =
                                                                        proTaxesResponse
                                                                            .taxesValueSum /
                                                                        100
                                                                const
                                                                    taxRateProTaxes =
                                                                        Math
                                                                            .floor(
                                                                                unitPrice *
                                                                                taxProTaxes
                                                                            )
                                                                const
                                                                    quotationPerProdcutTax =
                                                                        taxRateOfTaxField +
                                                                        taxRateProTaxes
                                                                $('#sub_total')
                                                                    .val(
                                                                        productSubTotalWithTax(
                                                                            $(
                                                                                '.unit_price'
                                                                            ),
                                                                            $(
                                                                                '.qty'
                                                                            ),
                                                                            taxRateProTaxes
                                                                        )
                                                                    )
                                                                $('#total_amount')
                                                                    .val(
                                                                        parseInt(
                                                                            $(
                                                                                '#sub_total'
                                                                            )
                                                                                .val()
                                                                        ) +
                                                                        taxRateOfTaxField
                                                                    )
                                                            } else { }
                                                        }
                                                    )
                                            }
                                        )

                                })
                                // alert('not empty')




                            } else {
                            }

                        }
                        else {
                            emptyFields()
                            if ($('.pro_taxes').val() != "") {

                                proTaxesInfo(base_url +
                                    "product_taxes_select_field", {
                                    proTaxesNames: $(
                                        '.pro_taxes').val(),
                                    _token: $(
                                        'meta[name="csrf-token"]'
                                    ).attr(
                                        "content"
                                    )
                                }).then((response) => {
                                    $('#taxes_in_perc').val(
                                        response
                                            .taxesNamesAndValues
                                    )
                                    $('.price_qty_keyup').on(
                                        "keyup",
                                        function () {

                                            const
                                                unitPriceVal =
                                                    parseInt($(
                                                        '.unit_price'
                                                    ).val())
                                            const tax =
                                                response
                                                    .taxesValueSum /
                                                100
                                            const taxRate =
                                                unitPriceVal *
                                                tax

                                            $('#sub_total')
                                                .val(
                                                    productSubTotalWithTax(
                                                        $(
                                                            '.unit_price'
                                                        ),
                                                        $(
                                                            '.qty'
                                                        ),
                                                        taxRate
                                                    )
                                                )
                                            $('#total_amount')
                                                .val(
                                                    productSubTotalWithTax(
                                                        $(
                                                            '.unit_price'
                                                        ),
                                                        $(
                                                            '.qty'
                                                        ),
                                                        taxRate
                                                    )
                                                )
                                        })
                                })



                            }
                            else {


                            }



                        }
                    })



                    const proTaxesNames = $(".taxes").val()
                    const optionsFortaxesField = {
                        method: "POST",
                        headers: {
                            "Content-type": "application/json"
                        },
                        body: JSON.stringify({
                            proTaxesNames: proTaxesNames,
                            _token: $('meta[name="csrf-token"]').attr(
                                "content")
                        })

                    }
                    const taxesNamesAndValues = fetch(base_url +
                        "product_taxes_select_field",
                        optionsFortaxesField)
                    taxesNamesAndValues.then((response) => {
                        return response.json()

                    }).then((json) => {
                        const taxesNamesForTaxeField = json[0];
                        const taxesValuesForTaxeField = json[1];
                        const taxesValuesSumForTaxeField =
                            taxesValuesForTaxeField.reduce((
                                carrier, item) => {
                                return carrier + item;

                            })
                        // console.log(taxesValuesSumForTaxeField);

                        $.ajax({
                            type: "post",
                            url: base_url + "product_taxes",
                            data: {
                                productId: productId,
                                _token: $('meta[name="csrf-token"]')
                                    .attr("content")

                            },
                            dataType: "json",
                            success: function (response) {

                                if (response.length == 0) {
                                    $('.pro_taxes option').each(
                                        (key, value) => {
                                            $(value).prop(
                                                'selected',
                                                false)
                                        })
                                    $('.pro_taxes').next(
                                        '.select2').find(
                                            '.select2-search__field'
                                        ).attr(
                                            'placeholder',
                                            'Select Tax')
                                    $('.pro_taxes').prop(
                                        'disabled', false)
                                    // newwork
                                    $('.pro_taxes').on('change',
                                        function () {
                                            // emptyFields()
                                            if ($(this)
                                                .val() !=
                                                "") {
                                                if ($(
                                                    '#taxes'
                                                )
                                                    .val() !=
                                                    "") {
                                                    emptyFields()
                                                    proTaxesInfo
                                                        (base_url +
                                                            "product_taxes_select_field", {
                                                            proTaxesNames: $(
                                                                '#taxes'
                                                            )
                                                                .val(),
                                                            _token: $(
                                                                'meta[name="csrf-token"]'
                                                            )
                                                                .attr(
                                                                    "content"
                                                                )
                                                        }
                                                        )
                                                        .then(
                                                            (
                                                                response
                                                            ) => {
                                                                // console.log(response);
                                                                proTaxesInfo
                                                                    (
                                                                        base_url +
                                                                        "product_taxes_select_field", {
                                                                        proTaxesNames: $(
                                                                            '.pro_taxes'
                                                                        )
                                                                            .val(),
                                                                        _token: $(
                                                                            'meta[name="csrf-token"]'
                                                                        )
                                                                            .attr(
                                                                                "content"
                                                                            )
                                                                    }
                                                                    )
                                                                    .then(
                                                                        (
                                                                            proTaxesResponse
                                                                        ) => {
                                                                            // console.log(proTaxesResponse);

                                                                            $('#taxes_in_perc')
                                                                                .val(
                                                                                    `${proTaxesResponse.taxesNamesAndValues} \n Quotation taxes are : ${response.taxesNamesAndValues}`
                                                                                )
                                                                            $('.price_qty_keyup')
                                                                                .on(
                                                                                    'keyup',
                                                                                    function () {
                                                                                        let unitPrice =
                                                                                            parseInt(
                                                                                                $(
                                                                                                    '.unit_price'
                                                                                                )
                                                                                                    .val()
                                                                                            )
                                                                                        let qty =
                                                                                            parseInt(
                                                                                                $(
                                                                                                    '.qty'
                                                                                                )
                                                                                                    .val()
                                                                                            )
                                                                                        if (
                                                                                            $(
                                                                                                '.unit_price'
                                                                                            )
                                                                                                .val() !=
                                                                                            "" &&
                                                                                            $(
                                                                                                ".qty"
                                                                                            )
                                                                                                .val() !=
                                                                                            ""
                                                                                        ) {
                                                                                            // alert(`${unitPrice}${qty}`)
                                                                                            // alert('both are filled')
                                                                                            let tax =
                                                                                                response
                                                                                                    .taxesValueSum /
                                                                                                100
                                                                                            const
                                                                                                totalPriceWithOutTax =
                                                                                                    unitPrice *
                                                                                                    qty
                                                                                            const
                                                                                                taxRateOfTaxField =
                                                                                                    totalPriceWithOutTax *
                                                                                                    tax

                                                                                            const
                                                                                                taxProTaxes =
                                                                                                    proTaxesResponse
                                                                                                        .taxesValueSum /
                                                                                                    100
                                                                                            const
                                                                                                taxRateProTaxes =
                                                                                                    Math
                                                                                                        .floor(
                                                                                                            unitPrice *
                                                                                                            taxProTaxes
                                                                                                        )
                                                                                            // alert(taxRateProTaxes)
                                                                                            const
                                                                                                quotationPerProdcutTax =
                                                                                                    taxRateOfTaxField +
                                                                                                    taxRateProTaxes







                                                                                            $('#sub_total')
                                                                                                .val(
                                                                                                    productSubTotalWithTax(
                                                                                                        $(
                                                                                                            '.unit_price'
                                                                                                        ),
                                                                                                        $(
                                                                                                            '.qty'
                                                                                                        ),
                                                                                                        taxRateProTaxes
                                                                                                    )
                                                                                                )

                                                                                            // alert(parseInt( $('#sub_total').val()) +taxRateOfTaxField)
                                                                                            $('#total_amount')
                                                                                                .val(
                                                                                                    parseInt(
                                                                                                        $(
                                                                                                            '#sub_total'
                                                                                                        )
                                                                                                            .val()
                                                                                                    ) +
                                                                                                    taxRateOfTaxField
                                                                                                )


                                                                                            // alert(taxRateOfTaxField)


                                                                                        } else {

                                                                                        }

                                                                                    }
                                                                                )
                                                                        }
                                                                    )

                                                                // alert($('.pro_taxes').val())

                                                            }
                                                        )
                                                } else {
                                                    emptyFields()
                                                    proTaxesInfo(base_url +
                                                        "product_taxes_select_field", {
                                                        proTaxesNames: $(
                                                            '.pro_taxes').val(),
                                                        _token: $(
                                                            'meta[name="csrf-token"]'
                                                        ).attr(
                                                            "content"
                                                        )
                                                    }).then((response) => {
                                                        $('#taxes_in_perc').val(
                                                            response
                                                                .taxesNamesAndValues
                                                        )

                                                        $('.price_qty_keyup').on(
                                                            "keyup",
                                                            function () {

                                                                const
                                                                    unitPriceVal =
                                                                        parseInt($(
                                                                            '.unit_price'
                                                                        ).val())
                                                                const tax =
                                                                    response
                                                                        .taxesValueSum /
                                                                    100
                                                                const taxRate =
                                                                    unitPriceVal *
                                                                    tax

                                                                $('#sub_total')
                                                                    .val(
                                                                        productSubTotalWithTax(
                                                                            $(
                                                                                '.unit_price'
                                                                            ),
                                                                            $(
                                                                                '.qty'
                                                                            ),
                                                                            taxRate
                                                                        )
                                                                    )
                                                                $('#total_amount')
                                                                    .val(
                                                                        productSubTotalWithTax(
                                                                            $(
                                                                                '.unit_price'
                                                                            ),
                                                                            $(
                                                                                '.qty'
                                                                            ),
                                                                            taxRate
                                                                        )
                                                                    )
                                                            })

                                                    })
                                                }



                                            } else {
                                                if ($('.taxes').val() != "") {

                                                    fetchTaxes('.taxes')





                                                }
                                                else {
                                                    emptyFields()
                                                    showTotalAndSubTotalWithOutTax()

                                                }

                                            }




                                        })


                                    // alert($('.taxes').val())
                                    let taxValueOfTaxField =
                                        $('.taxes')
                                            .val()
                                    if (taxValueOfTaxField ==
                                        "") {
                                        alert(
                                            taxValueOfTaxField
                                        )


                                    } else {
                                        $('.taxes_in_perc')
                                            .val("")
                                        fetchTaxes($(
                                            '.taxes'
                                        ))
                                        $('#taxes').on(
                                            'change',
                                            function () {
                                                fetchTaxes
                                                    ($(
                                                        '.taxes'
                                                    ))
                                            })
                                    }




                                } else {


                                    // alert('both taxes are filled and prodcut self taxes fetxhed ')
                                    hideSelectTaxAndShowPlaceHolder('.pro_taxes')

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

                                    // now push full invoice taxe names  and values to taxesNameValue array start
                                    let taxesNameValueForTaxField = []
                                    let incForTaxField = 0;
                                    json[0].forEach((item,
                                        index, arr
                                    ) => {
                                        // console.log(item);
                                        // console.log(json[1][incForTaxField]); 
                                        taxesNameValueForTaxField
                                            .push(
                                                `${item} = ${json[1][incForTaxField]} %`
                                            );
                                        incForTaxField++

                                    })
                                    // console.log(`values are : ${taxesNameValue} and inc :${incForTaxField}`);
                                    // console.log(taxesNameValueForTaxField);
                                    incForTaxField = 0;


                                    // now push full invoice taxe names  and values to taxesNameValue array  end
                                    let proTaxesOption = $(
                                        '.pro_taxes')
                                        .find(
                                            'option')
                                    $(proTaxesOption).each(
                                        function (key,
                                            value) {
                                            taxName = $(
                                                value
                                            )
                                                .val()
                                            if (taxesNames
                                                .indexOf(
                                                    taxName
                                                ) !==
                                                -
                                                1) {
                                                $(this)
                                                    .prop(
                                                        "selected",
                                                        true
                                                    );
                                            } else {
                                                $(this)
                                                    .prop(
                                                        "selected",
                                                        false
                                                    );
                                            }
                                        })
                                    if ($(
                                        '.taxes_percentage'
                                    )
                                        .length ==
                                        0

                                    ) { // check if input element for storing taxes % present or not
                                        $('#sal_quotation_form')
                                            .prepend(
                                                `<input type="hidden" name="taxes_percentage" id="taxes_percentage" class="taxes_percentage">`
                                            )
                                    }
                                    $('.taxes_percentage')
                                        .val(
                                            taxesPercentage)
                                    $('#taxes_in_perc').val(
                                        `${taxesNameValue} \n Full quotation taxes are ==> ${taxesNameValueForTaxField}`
                                    )


                                    let
                                        proTaxesNamesArr = [];
                                    let proTaxesoption = $(
                                        '.pro_taxes option:selected'
                                    )
                                    $(proTaxesoption).each(
                                        function (key,
                                            value) {
                                            let val = $(
                                                value
                                            )
                                                .val()
                                            proTaxesNamesArr
                                                .push(
                                                    val)
                                        })
                                    // storing percentage of taxes in input end
                                    // addItem



                                    // showing taxes in taxes filed manullay

                                    $('#pro_taxes').next(
                                        '.select2')
                                        .find(
                                            '.select2-search__field'
                                        )
                                        .attr('placeholder',
                                            proTaxesNamesArr
                                                .join(
                                                    ','))
                                    $('#pro_taxes').next(
                                        '.select2')
                                        .find(
                                            '.select2-search__field'
                                        )
                                        .css({
                                            'width': '100%'
                                        })

                                    $('.pro_taxes').prop(
                                        'disabled', true
                                    )
                                    // $('.taxes').prop('disabled', true)
                                    $('.product_id').on(
                                        'change',
                                        function () {
                                            let value =
                                                $(this)
                                                    .val()
                                            if (value ==
                                                "") {
                                                $('.pro_taxes option')
                                                    .each(
                                                        function (
                                                            key,
                                                            value
                                                        ) {

                                                            $(value)
                                                                .prop(
                                                                    'selected',
                                                                    false
                                                                )
                                                        }
                                                    )

                                                $('.pro_taxes')
                                                    .next(
                                                        '.select2'
                                                    )
                                                    .find(
                                                        '.select2-search__field'
                                                    )
                                                    .attr(
                                                        'placeholder',
                                                        'select Taxes'
                                                    )
                                                $('.pro_taxes')
                                                    .next(
                                                        '.select2'
                                                    )
                                                    .find(
                                                        '.select2-search__field'
                                                    )
                                                    .css({
                                                        'width': '100%'
                                                    })
                                                $('#taxes_in_perc')
                                                    .val(
                                                        ""
                                                    )
                                                $('.taxes')
                                                    .prop(
                                                        'disabled',
                                                        false
                                                    )
                                                $('.pro_taxes')
                                                    .prop(
                                                        'disabled',
                                                        false
                                                    )
                                            }
                                        })
                                    // showing taxes in taxes filed manullay
                                    // get unit price , qty,taxes to show sub total start 
                                    $('.price_qty_keyup')
                                        .on('keyup',
                                            function () {
                                                const
                                                    unitPriceValue =
                                                        parseInt(
                                                            $(
                                                                '#unit_price'
                                                            )
                                                                .val()
                                                        )
                                                const
                                                    quantityValue =
                                                        $(
                                                            '#quantity_first'
                                                        )
                                                            .val()


                                                if (unitPriceValue !=
                                                    "" &&
                                                    quantityValue !=
                                                    "") {


                                                    let totalPriceWithOutTax =
                                                        unitPriceValue *
                                                        quantityValue
                                                    let taxForTaxField =
                                                        taxesValuesSumForTaxeField /
                                                        100
                                                    let fullInvoiceTax =
                                                        totalPriceWithOutTax *
                                                        taxForTaxField



                                                    const
                                                        taxesPercentageString =
                                                            $(
                                                                '#taxes_percentage'
                                                            )
                                                                .val();
                                                    const
                                                        taxesPercentageArray =
                                                            taxesPercentageString
                                                                .split(
                                                                    ','
                                                                );
                                                    // console.log(taxesPercentageArray);
                                                    const
                                                        taxesPercentageSum =
                                                            taxesPercentageArray
                                                                .reduce(
                                                                    (total,
                                                                        element
                                                                    ) => {
                                                                        return parseInt(
                                                                            total
                                                                        ) +
                                                                            parseInt(
                                                                                element
                                                                            )

                                                                    }
                                                                )
                                                    // per product tax start
                                                    const
                                                        salesTaxRate =
                                                            taxesPercentageSum /
                                                            100;
                                                    const
                                                        taxRate =
                                                            unitPriceValue *
                                                            salesTaxRate;
                                                    const
                                                        productPriceWithTax =
                                                            unitPriceValue +
                                                            taxRate;
                                                    const
                                                        subTotal =
                                                            productPriceWithTax *
                                                            parseInt(
                                                                quantityValue
                                                            );
                                                    $('#sub_total')
                                                        .val(
                                                            subTotal
                                                        );
                                                    const
                                                        subTotalVal =
                                                            $(
                                                                '#sub_total'
                                                            )
                                                                .val()

                                                    $('#total_amount')
                                                        .val(
                                                            parseInt(
                                                                subTotalVal
                                                            ) +
                                                            parseInt(
                                                                fullInvoiceTax
                                                            )
                                                        )

                                                    // per product tax end
                                                } else {
                                                    $('#sub_total')
                                                        .val(
                                                            ""
                                                        );
                                                    $('#total_amount')
                                                        .val(
                                                            ""
                                                        );
                                                }
                                            })
                                    // get unit price , qty,taxes to show sub total end 
                                }
                            }

                        });



                    })
                }

                else {
                    $.ajax({
                        type: "post",
                        url: base_url + "product_taxes",
                        data: {
                            productId: productId,
                            _token: $('meta[name="csrf-token"]').attr(
                                "content")

                        },
                        dataType: "json",
                        success: function (response) {
                            if (response.length == 0) {

                                $('.pro_taxes').next('.select2')
                                    .find(
                                        '.select2-search__field')
                                    .attr('placeholder',
                                        'select Taxes')
                                $('.pro_taxes').next('.select2')
                                    .find(
                                        '.select2-search__field')
                                    .css({
                                        'width': '100%'
                                    })
                                $('#taxes_in_perc').val("")
                                // $('.taxes').prop('disabled', false)
                                $('.pro_taxes').prop('disabled',
                                    false)
                                $('.pro_taxes option').prop(
                                    "selected", false)
                                $('.select2-search__field').attr(
                                    'placeholder',
                                    'select Taxes')
                                $('.pro_taxes option').each(
                                    function (key,
                                        value) {
                                        $(value).prop(
                                            'selected',
                                            false)

                                    })

                                $('#taxes_percentage').val("")

                                $('#unit_price').val("")
                                $('.qty').val("")
                                $('#sub_total').val("")
                                $('.price_qty_keyup').on('keyup',
                                    function () {
                                        $("#sub_total").val(
                                            multiplyTwoInputValues(
                                                $(
                                                    '.unit_price'
                                                ), $(
                                                    ".qty"))
                                        )
                                        $("#total_amount").val(
                                            multiplyTwoInputValues(
                                                $(
                                                    '.unit_price'
                                                ), $(
                                                    ".qty"))
                                        )
                                    })


                                $('.taxes').on("change",
                                    function () {
                                        emptyFields()
                                        if ($(this).val() !=
                                            "") {
                                            // alert('not empty')
                                            if ($('.pro_taxes')
                                                .val() == "") {
                                                fetchTaxes($(
                                                    '.taxes'
                                                ))


                                            } else {
                                                emptyFields()
                                                // alert('pro taxes field not empty ')
                                                proTaxesInfo(
                                                    base_url +
                                                    "product_taxes_select_field", {
                                                    proTaxesNames: $(
                                                        this
                                                    )
                                                        .val(),
                                                    _token: $(
                                                        'meta[name="csrf-token"]'
                                                    )
                                                        .attr(
                                                            "content"
                                                        )
                                                }).then(
                                                    (
                                                        response
                                                    ) => {
                                                        // console.log(response);
                                                        proTaxesInfo
                                                            (base_url +
                                                                "product_taxes_select_field", {
                                                                proTaxesNames: $(
                                                                    '.pro_taxes'
                                                                )
                                                                    .val(),
                                                                _token: $(
                                                                    'meta[name="csrf-token"]'
                                                                )
                                                                    .attr(
                                                                        "content"
                                                                    )
                                                            }
                                                            )
                                                            .then(
                                                                (
                                                                    proTaxesResponse
                                                                ) => {
                                                                    // console.log(proTaxesResponse);

                                                                    $('#taxes_in_perc')
                                                                        .val(
                                                                            `${proTaxesResponse.taxesNamesAndValues} \n Quotation taxes are : ${response.taxesNamesAndValues}`
                                                                        )
                                                                    $('.price_qty_keyup')
                                                                        .on('keyup',
                                                                            function () {
                                                                                let unitPrice =
                                                                                    parseInt(
                                                                                        $(
                                                                                            '.unit_price'
                                                                                        )
                                                                                            .val()
                                                                                    )
                                                                                let qty =
                                                                                    parseInt(
                                                                                        $(
                                                                                            '.qty'
                                                                                        )
                                                                                            .val()
                                                                                    )
                                                                                if ($(
                                                                                    '.unit_price'
                                                                                )
                                                                                    .val() !=
                                                                                    "" &&
                                                                                    $(
                                                                                        ".qty"
                                                                                    )
                                                                                        .val() !=
                                                                                    ""
                                                                                ) {
                                                                                    // alert(`${unitPrice}${qty}`)
                                                                                    // alert('both are filled')
                                                                                    let tax =
                                                                                        response
                                                                                            .taxesValueSum /
                                                                                        100
                                                                                    const
                                                                                        totalPriceWithOutTax =
                                                                                            unitPrice *
                                                                                            qty
                                                                                    const
                                                                                        taxRateOfTaxField =
                                                                                            totalPriceWithOutTax *
                                                                                            tax

                                                                                    const
                                                                                        taxProTaxes =
                                                                                            proTaxesResponse
                                                                                                .taxesValueSum /
                                                                                            100
                                                                                    const
                                                                                        taxRateProTaxes =
                                                                                            Math
                                                                                                .floor(
                                                                                                    unitPrice *
                                                                                                    taxProTaxes
                                                                                                )
                                                                                    // alert(taxRateProTaxes)
                                                                                    const
                                                                                        quotationPerProdcutTax =
                                                                                            taxRateOfTaxField +
                                                                                            taxRateProTaxes







                                                                                    $('#sub_total')
                                                                                        .val(
                                                                                            productSubTotalWithTax(
                                                                                                $(
                                                                                                    '.unit_price'
                                                                                                ),
                                                                                                $(
                                                                                                    '.qty'
                                                                                                ),
                                                                                                taxRateProTaxes
                                                                                            )
                                                                                        )

                                                                                    // alert(parseInt( $('#sub_total').val()) +taxRateOfTaxField)
                                                                                    $('#total_amount')
                                                                                        .val(
                                                                                            parseInt(
                                                                                                $(
                                                                                                    '#sub_total'
                                                                                                )
                                                                                                    .val()
                                                                                            ) +
                                                                                            taxRateOfTaxField
                                                                                        )


                                                                                    // alert(taxRateOfTaxField)


                                                                                } else {

                                                                                }

                                                                            }
                                                                        )

                                                                }
                                                            )

                                                        // alert($('.pro_taxes').val())




                                                    })

                                            }

                                        } else {
                                            if ($('.pro_taxes')
                                                .val() == "") {
                                                // alert('pro taxes means 0 taxes on product ')
                                                emptyFields()
                                                showTotalAndSubTotalWithOutTax
                                                    ()

                                            } else {



                                            }


                                        }
                                    })


                                $('.pro_taxes').on('change',
                                    function () {
                                        emptyFields()
                                        const proTaxesNames = $(
                                            this).val()
                                        if (proTaxesNames !=
                                            "") {
                                            if ($('.taxes')
                                                .val() == "") {
                                                proTaxesInfo(
                                                    base_url +
                                                    "product_taxes_select_field", {
                                                    proTaxesNames: proTaxesNames,
                                                    _token: $(
                                                        'meta[name="csrf-token"]'
                                                    )
                                                        .attr(
                                                            "content"
                                                        )
                                                }).then(
                                                    (
                                                        response
                                                    ) => {
                                                        // console.log(response.taxesNamesAndValues);
                                                        $('#taxes_in_perc')
                                                            .val(
                                                                response
                                                                    .taxesNamesAndValues
                                                            )



                                                        $('.price_qty_keyup')
                                                            .on(
                                                                "keyup",
                                                                function () {

                                                                    const
                                                                        unitPriceVal =
                                                                            parseInt(
                                                                                $(
                                                                                    '.unit_price'
                                                                                )
                                                                                    .val()
                                                                            )
                                                                    const
                                                                        tax =
                                                                            response
                                                                                .taxesValueSum /
                                                                            100
                                                                    const
                                                                        taxRate =
                                                                            unitPriceVal *
                                                                            tax

                                                                    $('#sub_total')
                                                                        .val(
                                                                            productSubTotalWithTax(
                                                                                $(
                                                                                    '.unit_price'
                                                                                ),
                                                                                $(
                                                                                    '.qty'
                                                                                ),
                                                                                taxRate
                                                                            )
                                                                        )
                                                                    $('#total_amount')
                                                                        .val(
                                                                            productSubTotalWithTax(
                                                                                $(
                                                                                    '.unit_price'
                                                                                ),
                                                                                $(
                                                                                    '.qty'
                                                                                ),
                                                                                taxRate
                                                                            )
                                                                        )
                                                                }
                                                            )

                                                    })

                                            } else {
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
                                                }).then(
                                                    (
                                                        response
                                                    ) => {
                                                        // console.log(response);
                                                        proTaxesInfo
                                                            (base_url +
                                                                "product_taxes_select_field", {
                                                                proTaxesNames: $(
                                                                    '.pro_taxes'
                                                                )
                                                                    .val(),
                                                                _token: $(
                                                                    'meta[name="csrf-token"]'
                                                                )
                                                                    .attr(
                                                                        "content"
                                                                    )
                                                            }
                                                            )
                                                            .then(
                                                                (
                                                                    proTaxesResponse
                                                                ) => {
                                                                    // console.log(proTaxesResponse);

                                                                    $('#taxes_in_perc')
                                                                        .val(
                                                                            `${proTaxesResponse.taxesNamesAndValues} \n Quotation taxes are : ${response.taxesNamesAndValues}`
                                                                        )
                                                                    $('.price_qty_keyup')
                                                                        .on('keyup',
                                                                            function () {
                                                                                let unitPrice =
                                                                                    parseInt(
                                                                                        $(
                                                                                            '.unit_price'
                                                                                        )
                                                                                            .val()
                                                                                    )
                                                                                let qty =
                                                                                    parseInt(
                                                                                        $(
                                                                                            '.qty'
                                                                                        )
                                                                                            .val()
                                                                                    )
                                                                                if ($(
                                                                                    '.unit_price'
                                                                                )
                                                                                    .val() !=
                                                                                    "" &&
                                                                                    $(
                                                                                        ".qty"
                                                                                    )
                                                                                        .val() !=
                                                                                    ""
                                                                                ) {
                                                                                    // alert(`${unitPrice}${qty}`)
                                                                                    // alert('both are filled')
                                                                                    let tax =
                                                                                        response
                                                                                            .taxesValueSum /
                                                                                        100
                                                                                    const
                                                                                        totalPriceWithOutTax =
                                                                                            unitPrice *
                                                                                            qty
                                                                                    const
                                                                                        taxRateOfTaxField =
                                                                                            totalPriceWithOutTax *
                                                                                            tax

                                                                                    const
                                                                                        taxProTaxes =
                                                                                            proTaxesResponse
                                                                                                .taxesValueSum /
                                                                                            100
                                                                                    const
                                                                                        taxRateProTaxes =
                                                                                            Math
                                                                                                .floor(
                                                                                                    unitPrice *
                                                                                                    taxProTaxes
                                                                                                )
                                                                                    // alert(taxRateProTaxes)
                                                                                    const
                                                                                        quotationPerProdcutTax =
                                                                                            taxRateOfTaxField +
                                                                                            taxRateProTaxes







                                                                                    $('#sub_total')
                                                                                        .val(
                                                                                            productSubTotalWithTax(
                                                                                                $(
                                                                                                    '.unit_price'
                                                                                                ),
                                                                                                $(
                                                                                                    '.qty'
                                                                                                ),
                                                                                                taxRateProTaxes
                                                                                            )
                                                                                        )

                                                                                    // alert(parseInt( $('#sub_total').val()) +taxRateOfTaxField)
                                                                                    $('#total_amount')
                                                                                        .val(
                                                                                            parseInt(
                                                                                                $(
                                                                                                    '#sub_total'
                                                                                                )
                                                                                                    .val()
                                                                                            ) +
                                                                                            taxRateOfTaxField
                                                                                        )


                                                                                    // alert(taxRateOfTaxField)


                                                                                } else {

                                                                                }

                                                                            }
                                                                        )

                                                                }
                                                            )

                                                        // alert($('.pro_taxes').val())




                                                    })




                                            }



                                        } else {
                                            // alert('pro_taxes empty')
                                            if ($('.taxes')
                                                .val() == "") {
                                                showTotalAndSubTotalWithOutTax
                                                    ()

                                            } else {
                                                // alert('product empty but taxes not empty')
                                                fetchTaxes($(
                                                    '.taxes'
                                                ))

                                            }


                                        }

                                    })



                            } else {





                                let
                                    taxesNames = []; // contain taxes names
                                let
                                    taxesNameValue = []; // contain taxes names and values
                                let
                                    taxesPercentage = []; // this array contain taxes percentage after response from product_taxes url.
                                let i = 0;
                                response[0].forEach(function (item,
                                    index, arr) {
                                    // now append  in #taxes_in_perc
                                    taxesNameValue.push(
                                        item + '=' +
                                        response[1][i] +
                                        "%")
                                    taxesPercentage.push(
                                        response[1][i])
                                    taxesNames.push(item)
                                    i++;
                                })
                                let proTaxesOption = $('.pro_taxes')
                                    .find('option')
                                $(proTaxesOption).each(function (key,
                                    value) {
                                    taxName = $(value).val()
                                    if (taxesNames.indexOf(
                                        taxName) !== -
                                        1) {
                                        $(this).prop(
                                            "selected",
                                            true);
                                    } else {
                                        $(this).prop(
                                            "selected",
                                            false);
                                    }
                                })
                                if ($('.taxes_percentage').length ==
                                    0

                                ) { // check if input element for storing taxes % present or not
                                    $('#sal_quotation_form')
                                        .prepend(
                                            `<input type="hidden" name="taxes_percentage" id="taxes_percentage" class="taxes_percentage">`
                                        )
                                }
                                $('.taxes_percentage').val(
                                    taxesPercentage)
                                $('#taxes_in_perc').val(
                                    taxesNameValue)


                                let proTaxesNamesArr = [];
                                let proTaxesoption = $(
                                    '.pro_taxes option:selected'
                                )
                                $(proTaxesoption).each(function (key,
                                    value) {
                                    let val = $(value).val()
                                    proTaxesNamesArr.push(
                                        val)
                                })
                                // storing percentage of taxes in input end
                                // addItem



                                // showing taxes in taxes filed manullay

                                $('#pro_taxes').next('.select2')
                                    .find(
                                        '.select2-search__field')
                                    .attr('placeholder',
                                        proTaxesNamesArr.join(','))
                                $('#pro_taxes').next('.select2')
                                    .find(
                                        '.select2-search__field')
                                    .css({
                                        'width': '100%'
                                    })

                                $('.pro_taxes').prop('disabled',
                                    true)
                                // $('.taxes').prop('disabled', true)
                                $('.product_id').on('change',
                                    function () {
                                        let value = $(this)
                                            .val()
                                        if (value == "") {
                                            $('.pro_taxes option')
                                                .each(
                                                    function (
                                                        key,
                                                        value) {

                                                        $(value)
                                                            .prop(
                                                                'selected',
                                                                false
                                                            )
                                                    })

                                            $('.pro_taxes')
                                                .next(
                                                    '.select2')
                                                .find(
                                                    '.select2-search__field'
                                                )
                                                .attr(
                                                    'placeholder',
                                                    'select Taxes'
                                                )
                                            $('.pro_taxes')
                                                .next(
                                                    '.select2')
                                                .find(
                                                    '.select2-search__field'
                                                )
                                                .css({
                                                    'width': '100%'
                                                })
                                            $('#taxes_in_perc')
                                                .val("")
                                            $('.taxes').prop(
                                                'disabled',
                                                false)
                                            $('.pro_taxes')
                                                .prop(
                                                    'disabled',
                                                    false)
                                        }
                                    })
                                // showing taxes in taxes filed manullay
                                // get unit price , qty,taxes to show sub total start 
                                $('.price_qty_keyup').on('keyup',
                                    function () {
                                        // alert('ok')
                                        const unitPriceValue =
                                            parseInt($(
                                                '#unit_price'
                                            )
                                                .val())
                                        const quantityValue = $(
                                            '#quantity_first'
                                        ).val()
                                        if (unitPriceValue !=
                                            "" &&
                                            quantityValue != ""
                                        ) {
                                            const
                                                taxesPercentageString =
                                                    $(
                                                        '#taxes_percentage'
                                                    )
                                                        .val();
                                            const
                                                taxesPercentageArray =
                                                    taxesPercentageString
                                                        .split(',');
                                            // console.log(taxesPercentageArray);
                                            const
                                                taxesPercentageSum =
                                                    taxesPercentageArray
                                                        .reduce((total,
                                                            element
                                                        ) => {
                                                            return parseInt(
                                                                total
                                                            ) +
                                                                parseInt(
                                                                    element
                                                                )

                                                        })
                                            // per product tax start
                                            const salesTaxRate =
                                                taxesPercentageSum /
                                                100;
                                            const taxRate =
                                                unitPriceValue *
                                                salesTaxRate;
                                            const
                                                productPriceWithTax =
                                                    unitPriceValue +
                                                    taxRate;
                                            const subTotal =
                                                productPriceWithTax *
                                                parseInt(
                                                    quantityValue
                                                );
                                            $('#sub_total').val(
                                                subTotal);
                                            $('#total_amount')
                                                .val(subTotal);
                                            // per product tax end
                                        } else {
                                            $('#sub_total').val(
                                                "");
                                            $('#total_amount')
                                                .val("");
                                        }
                                    })
                                // get unit price , qty,taxes to show sub total end 

                                $('.taxes').on('change',
                                    function () {
                                        emptyFields()
                                        let taxesNamesOfTaxField =
                                            $(this).val();

                                        if (taxesNamesOfTaxField !=
                                            "") {

                                            proTaxesInfo(
                                                base_url +
                                                "product_taxes_select_field", {
                                                proTaxesNames: taxesNamesOfTaxField,
                                                _token: $(
                                                    'meta[name="csrf-token"]'
                                                )
                                                    .attr(
                                                        "content"
                                                    )
                                            }).then((
                                                response
                                            ) => {
                                                // console.log(response);
                                                proTaxesInfo
                                                    (base_url +
                                                        "product_taxes_select_field", {
                                                        proTaxesNames: $(
                                                            '.pro_taxes'
                                                        )
                                                            .val(),
                                                        _token: $(
                                                            'meta[name="csrf-token"]'
                                                        )
                                                            .attr(
                                                                "content"
                                                            )
                                                    }
                                                    )
                                                    .then(
                                                        (
                                                            proTaxesResponse
                                                        ) => {
                                                            $('#taxes_in_perc')
                                                                .val(
                                                                    `${proTaxesResponse.taxesNamesAndValues} \n Quotation taxes are : ${response.taxesNamesAndValues}`
                                                                )
                                                            $('.price_qty_keyup')
                                                                .on('keyup',
                                                                    function () {
                                                                        let unitPrice =
                                                                            parseInt(
                                                                                $(
                                                                                    '.unit_price'
                                                                                )
                                                                                    .val()
                                                                            )
                                                                        let qty =
                                                                            parseInt(
                                                                                $(
                                                                                    '.qty'
                                                                                )
                                                                                    .val()
                                                                            )
                                                                        if ($(
                                                                            '.unit_price'
                                                                        )
                                                                            .val() !=
                                                                            "" &&
                                                                            $(
                                                                                ".qty"
                                                                            )
                                                                                .val() !=
                                                                            ""
                                                                        ) {
                                                                            let tax =
                                                                                response
                                                                                    .taxesValueSum /
                                                                                100
                                                                            const
                                                                                totalPriceWithOutTax =
                                                                                    unitPrice *
                                                                                    qty
                                                                            const
                                                                                taxRateOfTaxField =
                                                                                    totalPriceWithOutTax *
                                                                                    tax

                                                                            const
                                                                                taxProTaxes =
                                                                                    proTaxesResponse
                                                                                        .taxesValueSum /
                                                                                    100
                                                                            const
                                                                                taxRateProTaxes =
                                                                                    Math
                                                                                        .floor(
                                                                                            unitPrice *
                                                                                            taxProTaxes
                                                                                        )
                                                                            const
                                                                                quotationPerProdcutTax =
                                                                                    taxRateOfTaxField +
                                                                                    taxRateProTaxes
                                                                            $('#sub_total')
                                                                                .val(
                                                                                    productSubTotalWithTax(
                                                                                        $(
                                                                                            '.unit_price'
                                                                                        ),
                                                                                        $(
                                                                                            '.qty'
                                                                                        ),
                                                                                        taxRateProTaxes
                                                                                    )
                                                                                )
                                                                            $('#total_amount')
                                                                                .val(
                                                                                    parseInt(
                                                                                        $(
                                                                                            '#sub_total'
                                                                                        )
                                                                                            .val()
                                                                                    ) +
                                                                                    taxRateOfTaxField
                                                                                )
                                                                        } else { }
                                                                    }
                                                                )
                                                        }
                                                    )

                                            })

                                        } else {

                                            $('.pro_taxes')
                                                .prop(
                                                    'disabled',
                                                    true)


                                            proTaxesInfo(
                                                base_url +
                                                "product_taxes_select_field", {
                                                proTaxesNames: $(
                                                    '.pro_taxes'
                                                )
                                                    .val(),
                                                _token: $(
                                                    'meta[name="csrf-token"]'
                                                )
                                                    .attr(
                                                        "content"
                                                    )
                                            }).then((
                                                response
                                            ) => {
                                                $('#taxes_in_perc')
                                                    .val(
                                                        response
                                                            .taxesNamesAndValues
                                                    )
                                                $('.price_qty_keyup')
                                                    .on(
                                                        "keyup",
                                                        function () {

                                                            const
                                                                unitPriceVal =
                                                                    parseInt(
                                                                        $(
                                                                            '.unit_price'
                                                                        )
                                                                            .val()
                                                                    )
                                                            const
                                                                tax =
                                                                    response
                                                                        .taxesValueSum /
                                                                    100
                                                            const
                                                                taxRate =
                                                                    unitPriceVal *
                                                                    tax

                                                            $('#sub_total')
                                                                .val(
                                                                    productSubTotalWithTax(
                                                                        $(
                                                                            '.unit_price'
                                                                        ),
                                                                        $(
                                                                            '.qty'
                                                                        ),
                                                                        taxRate
                                                                    )
                                                                )
                                                            $('#total_amount')
                                                                .val(
                                                                    productSubTotalWithTax(
                                                                        $(
                                                                            '.unit_price'
                                                                        ),
                                                                        $(
                                                                            '.qty'
                                                                        ),
                                                                        taxRate
                                                                    )
                                                                )
                                                        }
                                                    )

                                            })

                                        }

                                    })
                            }
                        }
                    });

                }
            } else {

            }
        })
        // showing taxes and subtotal for product end ---------------------------------------------

    });
</script>
@endSection
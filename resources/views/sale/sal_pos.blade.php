@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{ asset('dashboard_assets/sale/css/sal_pos.css') }}">
@endSection
@section('body_content')
<div class="row profile">
    <div class="col-md-12">
        {{-- quotation request form start --}}

        <div class="row">
            <div class="col-md-12">

                <form id="pos_form">
                    @csrf


                    <div class="container-fluid ">
                        <div class="row  profile_row">
                            <!-- confirmation message to generate invoice start  -->
                            <!-- Button trigger modal -->
                            


                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Generate invoice</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Click ok to generate invoice for this transaction
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" id="confirm_pos"
                                                data-bs-dismiss="modal">Ok</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- confirmation message to generate invoice end  -->
                            <!-- lable div end  -->
                            <!-- <div class="col-md-12">
                                <div class="parent">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h5 class="">Open Cash Register </h5>
                                        </div>

                                        
                                    </div>
                                </div>
                            </div> -->
                            <!-- lable div end  -->




                            <!-- user information start  -->
                            <div class="col-md-8">
                                <div class="parent">
                                    <!-- this row for table start  -->
                                    <div class="row gy-3">



                                        <div class="col-md-12">
                                            <div class="alert alert-success d-none text-white pur_purchase_order_added_message  user_updated_msg"
                                                role="alert" id="product_not_select_message">
                                                <span>
                                                    Please Add the proudct in the below cart
                                                </span>
                                                <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-12 cutomer_search_warehouse_parent">
                                            <div class="row gy-3">
                                                <div class="col-md-3">
                                                    <select name="customer_id" id="customer_id"
                                                        class="form-select customer_id">
                                                        <option></option>
                                                        @foreach ($customers as $customer)
                                                        <option value="{{ $customer->user_id }}" {{$customer->username
                                                            =="Walk In Customer" ?"selected":"" }}>{{
                                                            $customer->username}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6 position-relative">
                                                    <i class="fas fa-search"></i>
                                                    <input type="search" name="product_search" id="product_search"
                                                        placeholder="Search By product name OR product sku ">




                                                </div>
                                                <div class="col-md-3">
                                                    <select name="warehouse_id" id="warehouse_id"
                                                        class="form-select warehouse_id">

                                                        @foreach ($warehouses as $warehouse)
                                                        <option value="{{ $warehouse->warehouse_id }}" {{$warehouse->
                                                            warehouse_name=="main warehouse" ?"selected":""}}
                                                            >{{
                                                            $warehouse->warehouse_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <!-- ajax table staart   -->
                                            <div class="table-responsive">
                                                <table class="pos_table" id="pos_table">
                                                    <thead>
                                                        <tr>
                                                            <td>Product Name</td>
                                                            <td>Taxes</td>
                                                            <td>Unit Price</td>
                                                            <td>Qty</td>
                                                            <td>Disc</td>
                                                            <td>Sub Total</td>
                                                            <td></td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>

                                                        </tr>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>

                                                            <td colspan="3">Total Taxes :
                                                                <span class="total_taxes">0 </span> %

                                                            </td>
                                                            <td colspan="3">Total : <span class="total"> 0</span></td>
                                                        </tr>
                                                        <tr class="button_row">
                                                            <td colspan="6" style="padding-top:60px;">
                                                                <div
                                                                    class="d-flex flex-wrap justify-content-around align-items-center">






                                                                    <a href="{{route('pos_detail_cashier')}}"> <button type="button"
                                                                        class=" sidenav_zero_index letter-spacing-1 light_blue_col custom_button"
                                                                        id="">Close
                                                                        Register</button>
                                                                    </a>





                                                                    <button type="submit"
                                                                        class="dark_pink_color custom_button sidenav_zero_index letter-spacing-1"
                                                                        id="cash_button">cash</button>




                                                                    <div class="current_reg_amount">
                                                                        <span
                                                                            class="text-uppercase fw-bold text-danger">
                                                                            Current Register Amount :</span>
                                                                            <span class="current_amount_int">
                                                                         {{session('posOpenRegisterAmount')}}</span>
                                                                    </div>
                                                                </div>






                                                            </td>

                                                        </tr>

                                                    </tfoot>
                                                </table>
                                            </div>


                                            <!-- ajax table  end -->

                                        </div>
                                        <!-- this row for table end  -->

                                    </div>
                                </div>
                            </div>
                            <!-- user information end  -->
                            <div class="col-md-4">
                                <div class="parent">
                                    <!-- discount  will be updated if checked by dail paid start  -->
                                    <div class="row mb-3">
                                        <div class="col-md-4 ">
                                            <label for="discount_checkbox" id="discount_checkbox_label"
                                                class="dial_paid_label">Disc</label>
                                            <input type="radio" name="dial_paid_checkboxes" id="discount_checkbox"
                                                class="dial_paid_checkbox" checked>
                                        </div>
                                        <!-- <div class="col-md-4 ">
                                            <label for="qty_checkbox" id="qty_checkbox_label"
                                                class="dial_paid_label">Qty</label>
                                            <input type="radio" name="dial_paid_checkboxes" id="qty_checkbox"
                                                class="dial_paid_checkbox">

                                        </div> -->

                                    </div>

                                    <!-- discount  will be updated if checked by dail paid end  -->
                                    <!-- dail paid start  -->
                                    <div class="row ">
                                        <div class="col-md-12 ">

                                            <input type="text" id="phone-number" class="" placeholder="Enter value"
                                                readonly>

                                            <div class="dial-pad">
                                                <div class="row dial_paid_row">
                                                    <div class="col-4">
                                                        <button class="number" data-value="1">1</button>
                                                    </div>
                                                    <div class="col-4">
                                                        <button class="number" data-value="2">2</button>
                                                    </div>
                                                    <div class="col-4">
                                                        <button class="number" data-value="3">3</button>
                                                    </div>
                                                </div>
                                                <div class="row dial_paid_row">
                                                    <div class="col-4">
                                                        <button class="number" data-value="4">4</button>
                                                    </div>
                                                    <div class="col-4">
                                                        <button class="number" data-value="5">5</button>
                                                    </div>
                                                    <div class="col-4">
                                                        <button class="number" data-value="6">6</button>
                                                    </div>
                                                </div>
                                                <div class="row dial_paid_row">
                                                    <div class="col-4">
                                                        <button class="number" data-value="7">7</button>
                                                    </div>
                                                    <div class="col-4">
                                                        <button class="number" data-value="8">8</button>
                                                    </div>
                                                    <div class="col-4">
                                                        <button class="number" data-value="9">9</button>
                                                    </div>
                                                </div>
                                                <div class="row dial_paid_row">
                                                    <div class="col-4">
                                                        <button id="dot" class="number" data-value=".">.</button>
                                                    </div>
                                                    <div class="col-4">
                                                        <button class="number" data-value="0">0</button>
                                                    </div>
                                                    <div class="col-4">
                                                        <button id="clear">Clear</button>
                                                    </div>
                                                </div>

                                                <div class="row dial_paid_row">
                                                    <div class="col-12">
                                                        <button id="backspace">Backspace</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>


                                    <!-- dail paid end  -->






                                </div>
                            </div>


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
        // base url start 


        @php
        $baseUrl = config('app.url');
                echo "const base_url = '".$baseUrl. "';";
        @endphp


        // base url end 
        // customer select drop down start 
        $('#customer_id').on('change', function (param) {
            let customer_idValue = $(this).val();
            if (customer_idValue == "") {
                $('#customer_id-error').removeClass('d-none') // label
            } else {
                $('#customer_id-error').addClass('d-none') // label
            }
        })

        $("#customer_id").select2({
            placeholder: "Select Customer",
            allowClear: true,
            width: "100%",
        });



        // customer select drop down end 
        // warehouse select drop down start 
        $('#warehouse_id').on('change', function (param) {
            let warehouse_idValue = $(this).val();
            if (warehouse_idValue == "") {
                $('#warehouse_id-error').removeClass('d-none') // label
            } else {
                $('#warehouse_id-error').addClass('d-none') // label
            }
        })

        $("#warehouse_id").select2({
            placeholder: "Select Warehouse",
            allowClear: true,
            width: "100%",
        });



        // warehouse select drop down end 




        // 

        // fetch product by searching and append in pos_table start
        let productSkuSet = new Set();
        let productIdsArray = new Set();
        let productTaxesNamesArray = {};


        $('#product_search').on('keyup', function () {
            let productNameOrSku = $(this).val();
            let productFetched = fetch(base_url + "fetch_product_for_pos", {
                method: "post",
                headers: {
                    "Content-type": "application/json"
                },
                body: JSON.stringify({
                    productNameOrSku: productNameOrSku,
                    _token: $('meta[name="csrf-token"]')
                        .attr("content")

                })
            })
            productFetched.then((response) => {
                return response.json()

            }).then((json) => {
                // console.log($('.product_row'));

                if (Object.entries(json).length != 0) {
                    productIdsArray.add(json.productInfo.product_id)
                    if (json.taxesNames == "No taxes") {
                        productTaxesNamesArray['productId' + json.productInfo.product_id.toString()] = 'NULL'

                    }
                    else {

                        productTaxesNamesArray['productId' + json.productInfo.product_id.toString()] = json.taxesNames.join(',')
                    }
                    if ($('.select_pro_msg').length == 0) {
                        $('.cutomer_search_warehouse_parent').after(`
                    <div class="col-md-12 select_pro_msg show"> 
                         Click on the below products to select for update Disc
                        </div>
                    `)

                    }




                    $('.increment').off('click')
                    $('.decrement').off('click')

                    $('.remove_product').off('click')
                    // check if product exist in cart then increase qty of the product start 
                    $('.product_sku').each((key, value) => {
                        productSkuSet.add(parseFloat($(value).text()))

                    })
                    // console.log(productSkuSet);
                    let productSku = null
                    if (!productSkuSet.has(json.productInfo.product_sku)) {
                        // create  product row start 
                        $('#pos_table tbody').find('tr:last-child').after(`
        <tr class="product_row">
            <input type="hidden" class="taxes_percentage" name="taxes_percentage" id="taxes_percentage" value="${json.taxesPercentageSum}">
                                                            <td>${json.productInfo.product_name} <br> <span class="product_sku" >${json.productInfo.product_sku}</span>

                                                            </td>
                                                            <td class = "product_taxes">${json.taxesNamesAndPercentage}</td>
                                                            <td class="unit_price px-0">${json.productInfo.product_sale_price}</td>
                                                            <td  >
                                                                <div
                                                                    class="qty_counter_parent d-flex align-items-center">
                                                                    <i class="fas fa-minus decrement"></i>
                                                                    <span class="qty">1</span>
                                                                    <i class="fas fa-plus increment"></i>
                                                                </div>
                                                            </td>
                                                            <td class="product_discount px-0">
                                                                0
                                                                </td>
                                                            <td class="sub_total px-0">${json.productInfo.product_sale_price + json.taxesPercentageSum}</td>
                                                            <td><i
                                                                    class="fas fa-trash-alt text-danger remove_product"></i>
                                                            </td>
                                                        </tr>
        `)

                        $('.product_row').on('click', function (e) {
                            e.stopImmediatePropagation()
                            sessionStorage.setItem('sub_total', parseFloat($(this).find('.sub_total').text()))


                            if (!$(e.target).closest('.qty_counter_parent').length > 0) {
                                // alert( $(this).find('.sub_total').text())
                                // $('.product_row').not(this).removeClass('light_blue')
                                $('.product_row').not(this).each((key, value) => {
                                    $(value).removeClass('light_blue')
                                    $(value).find('.increment').removeClass('text-white')
                                    $(value).find('.decrement').removeClass('text-white')
                                    $(value).find('.remove_product').removeClass('text-white')
                                })
                                if (!$(this).hasClass('light_blue')) {

                                    $(this).addClass('light_blue')
                                    $(this).find('.increment').addClass('text-white')
                                    $(this).find('.decrement').addClass('text-white')
                                    $(this).find('.remove_product').addClass('text-white')

                                }
                                else {
                                    $(this).removeClass('light_blue')
                                    $(this).find('.increment').removeClass('text-white')
                                    $(this).find('.decrement').removeClass('text-white')
                                    $(this).find('.remove_product').removeClass('text-white')
                                }
                            }
                        })




                        // change the background color of product row on clikc means select product to update discount , price,qty end





                    }






                    // getting single sku start 
                    productSkuSet.forEach((value) => {
                        if (value == json.productInfo.product_sku) {
                            productSku = value

                        }

                    })
                    // console.log(productSku);
                    $('.product_sku').each((key, value) => {
                        if (parseFloat($(value).text()) == productSku) {
                            let parent = $(value).closest('.product_row')
                            let qty = parseFloat($(parent).find('.qty').text())
                            qty++;
                            $(parent).find('.qty').text(qty)
                            // updaing sub total 

                            let productDisc = parseFloat($(parent).find('.product_discount').text())

                            let unitPrice = parseFloat($(parent).find('.unit_price').text()) - productDisc;
                            let productsTotalAmount = qty * unitPrice
                            let taxesPercentage = parseFloat($(parent).find('#taxes_percentage').val())
                            // alert(productsTotalAmount)
                            let tax = taxesPercentage / 100
                            let taxRate = productsTotalAmount * tax
                            let subTotal = productsTotalAmount + taxRate
                            $(parent).find('.sub_total').text(subTotal)
                            // updaing sub total 

                        }






                    })
                    // getting single sku end


                    // check if product exist in cart then increase qty of the product end 


                    // showing total taxes start 
                    setTimeout(() => {
                        let taxesPercentageArray = [];
                        $('.taxes_percentage').each((key, value) => {
                            taxesPercentageArray.push(parseFloat($(value).val()))

                        })
                        let taxesPercentageAllSum = taxesPercentageArray.reduce((carrier, item) => {
                            return carrier + item


                        })
                        $('.total_taxes').text(taxesPercentageAllSum)

                    }, 10);
                    // showing total taxes end 
                    // showing total start 
                    setTimeout(() => {
                        let subTotalArray = [];
                        $('.sub_total').each((key, value) => {
                            subTotalArray.push(parseFloat($(value).text()))

                        })
                        let subTotalAllSum = subTotalArray.reduce((carrier, item) => {
                            return carrier + item


                        })
                        $('.total').text(subTotalAllSum)



                    }, 10);
                    // showing total end 
                    $('#product_search').val("")
                    // console.log($('.product_row'));
                    // }
                    // qty counter start




                    $('.increment').on('click', function (e) {
                        // alert('automically event fire')

                        // alert($(this).prev().text())
                        let qtyCount = parseFloat($(this).prev().text());
                        qtyCount++
                        // alert(qtyCount)


                        $(this).prev().text(qtyCount)
                        // updaing sub total on incrementing qty start 
                        let parent = $(this).closest('.product_row')

                        let discPerProduct = parseFloat($(parent).find('.product_discount').text())
                        // alert(discPerProduct)
                        let qty = parseFloat($(parent).find('.qty').text());
                        let unitPrice = parseFloat($(parent).find('.unit_price').text()) - discPerProduct;
                        let productsTotalAmount = qty * unitPrice
                        let taxesPercentage = parseFloat($(parent).find('#taxes_percentage').val())
                        // alert(productsTotalAmount)
                        let tax = taxesPercentage / 100
                        let taxRate = productsTotalAmount * tax
                        let subTotal = productsTotalAmount + taxRate
                        $(parent).find('.sub_total').text(subTotal)
                        // updaing sub total on incrementing qty start 
                        // updating total start 
                        setTimeout(() => {
                            let subTotalArray = [];
                            $('.sub_total').each((key, value) => {
                                subTotalArray.push(parseFloat($(value).text()))

                            })
                            let subTotalAllSum = subTotalArray.reduce((carrier, item) => {
                                return carrier + item


                            })
                            $('.total').text(subTotalAllSum)



                        }, 10);
                        // updating total end 

                    })

                    $('.decrement').on('click', function () {
                        let qtyCount = parseFloat($(this).next().text());
                        if (qtyCount != 1) {
                            qtyCount--
                            $(this).next().text(qtyCount)
                            // updaing sub total on incrementing qty start 
                            let parent = $(this).closest('.product_row')
                            let productDisc = parseFloat($(parent).find('.product_discount').text())
                            let qty = parseFloat($(parent).find('.qty').text());
                            let unitPrice = parseFloat($(parent).find('.unit_price').text()) - productDisc;
                            let productsTotalAmount = qty * unitPrice
                            let taxesPercentage = parseFloat($(parent).find('#taxes_percentage').val())
                            // alert(productsTotalAmount)
                            let tax = taxesPercentage / 100
                            let taxRate = productsTotalAmount * tax
                            let subTotal = productsTotalAmount + taxRate
                            $(parent).find('.sub_total').text(subTotal)
                            // updaing sub total on incrementing qty start 
                            // updating total start 
                            setTimeout(() => {
                                let subTotalArray = [];
                                $('.sub_total').each((key, value) => {
                                    subTotalArray.push(parseFloat($(value).text()))

                                })
                                let subTotalAllSum = subTotalArray.reduce((carrier, item) => {
                                    return carrier + item


                                })
                                $('.total').text(subTotalAllSum)



                            }, 10);
                            // updating total end 

                        }
                    })

                    // qty counter end
                    // remove product start 
                    $('.remove_product').on('click', function () {



                        let productSkuElement = $(this).closest('.product_row').find('.product_sku')
                        let productSku = parseFloat($(productSkuElement).text())
                        productSkuSet.delete(productSku)
                        $(this).closest('tr').remove()
                        // updating total start 
                        setTimeout(() => {
                            let subTotalArray = [];
                            $('.sub_total').each((key, value) => {
                                subTotalArray.push(parseFloat($(value).text()))

                            })
                            let subTotalAllSum = subTotalArray.reduce((carrier, item) => {
                                return carrier + item


                            })
                            $('.total').text(subTotalAllSum)

                        }, 10);
                        // updating total end 
                        // showing total taxes start 
                        setTimeout(() => {
                            let taxesPercentageArray = [];
                            $('.taxes_percentage').each((key, value) => {
                                taxesPercentageArray.push(parseFloat($(value).val()))

                            })
                            let taxesPercentageAllSum = taxesPercentageArray.reduce((carrier, item) => {
                                return carrier + item


                            })
                            $('.total_taxes').text(taxesPercentageAllSum)



                        }, 10);
                        // showing total taxes end 
                        // check if 0 product row exit then empty total taxes and subtotal start 
                        if ($('#pos_table').find('.product_row').length == 0) {
                            $('.total_taxes').text(0)
                            $('.total').text(0)
                        }

                        // check if 0 product row exit then empty total taxes and subtotal end

                        // check if  no product row exist then hide the select product msg starrt 
                        // alert($('.product_row').length)
                        if ($('.product_row').length == 0) {
                            $('.select_pro_msg').hide()

                        }
                        else {
                            $('.select_pro_msg').show()

                        }
                        // check if  no product row exist then hide the select product msg end 

                    })
                    // remove product end
                    // append
                    // product ids start 
                    if ($("#pos_form").find('#product_ids_array').length == 0) {
                        $('#pos_form').append(`
                    <input type="hidden" name="product_ids_array" id="product_ids_array">
                    `)
                    }
                    $('#pos_form').find('#product_ids_array').val(JSON.stringify(productIdsArray))
                    // product ids start 
                    // product taxes names  start 
                    if ($("#pos_form").find('#product_taxes_names_array').length == 0) {
                        $('#pos_form').append(`
                    <input type="hidden" name="product_taxes_names_array" id="product_taxes_names_array">
                    `)
                    }
                    $('#pos_form').find('#product_taxes_names_array').val(JSON.stringify(productTaxesNamesArray))
                    // product taxes names  start 
                    // console.log(productTaxesNamesArray);





                }
            })
        })


        // fetch product by searching and append in pos_table end

        // submit pos form start 
        $('#pos_form').validate({
            rules: {

            },
            message: {

            },
            submitHandler: function (form) {
                if ($('#pos_table').find('tbody').find('.product_row').length != 0) {
                    $('#sidenav-main').css({ 'z-index': '0' })
                    setTimeout(() => {
                        $('#exampleModal').modal('show')

                    }, 100);

                    $('#confirm_pos').on('click', function (e) {
                        e.stopImmediatePropagation()

                        // current
                        $('#product_not_select_message').removeClass('d-none')


                        $('#product_not_select_message').children(':first').text('Please wait ..... invoice generating')



                        // total amount start 
                        if ($("#pos_form").find('#total_amount').length == 0) {
                            $('#pos_form').append(`
                    <input type="hidden" name="total_amount" id="total_amount">
                    `)
                        }
                        $("#pos_form").find('#total_amount').val(parseFloat($('.total').text()))
                        // total amount end 

                        // sub total start 
                        if ($("#pos_form").find('#sub_total_array').length == 0) {
                            $('#pos_form').append(`
                    <input type="hidden" name="sub_total_array" id="sub_total_array">
                    `)
                        }


                        let subTotalArray = []
                        $('.sub_total').each((key, value) => {
                            subTotalArray.push(parseFloat($(value).text()))
                        })
                        $("#pos_form").find('#sub_total_array').val(subTotalArray)

                        // sub total end 
                        // qty start 
                        if ($("#pos_form").find('#qty_array').length == 0) {
                            $('#pos_form').append(`
                    <input type="hidden" name="qty_array" id="qty_array">
                    `)
                        }


                        let qtyArray = []
                        $('.qty').each((key, value) => {
                            qtyArray.push(parseFloat($(value).text()))
                        })
                        $("#pos_form").find('#qty_array').val(qtyArray)

                        // qty end 


                        // unit price start 
                        if ($("#pos_form").find('#unit_price_array').length == 0) {
                            $('#pos_form').append(`
                    <input type="hidden" name="unit_price_array" id="unit_price_array">
                    `)
                        }


                        let unitPriceArray = []
                        $('.unit_price').each((key, value) => {
                            unitPriceArray.push(parseFloat($(value).text()))
                        })
                        $("#pos_form").find('#unit_price_array').val(unitPriceArray)

                        // unit price end 
                        // product_discount start 
                        if ($("#pos_form").find('#product_discount_array').length == 0) {
                            $('#pos_form').append(`
                    <input type="hidden" name="product_discount_array" id="product_discount_array">
                    `)
                        }


                        let productDiscountArray = []
                        $('.product_discount').each((key, value) => {
                            productDiscountArray.push(parseFloat($(value).text()))
                        })
                        $("#pos_form").find('#product_discount_array').val(productDiscountArray)

                        // product_discount end 



                        let posPromise = fetch(base_url + "store_pos", {
                            method: "post",
                            headers: {
                                "X-CSRF-Token": $(
                                    'meta[name="csrf-token"]'
                                )
                                    .attr(
                                        "content"
                                    )
                            },
                            body: new FormData(form)
                        })
                        posPromise.then((response) => {
                            return response.json()
                        }).then((json) => {
                            if(json == 'registerClose'){
                                window.location.href = base_url + "open_cash_register"
                                sessionStorage.setItem('message','This Register has been Closed')

                            }
                            else{
                                console.log(json);
                                let {url,currentRegisterAmount} = json
                                // current


                                // $('.current_reg_amount span').next().text(currentRegisterAmount) 
                                $('.current_amount_int').text(currentRegisterAmount)
                                

                            
                            $('#exampleModal').modal('hide')
                            // current

                            $('.product_row').each((key, value) => {
                                $(value).remove()
                            })
                            $('.total').text(0)
                            $('.total_taxes').text(0)
                            productSkuSet = new Set()

                            productIdsArray = new Set()
                            productTaxesNamesArray = {}

                            // console.log(json);
                            if ($('#emp_details_iframe').length === 0) {
                                let iframe = document.createElement('iframe')
                                iframe.setAttribute('id', "emp_details_iframe")
                                iframe.setAttribute('class', "d-none")
                                iframe.setAttribute('src', url)
                                $('body').append(iframe)
                                iframe.onload = function (param) {
                                    // $('.waitMessage').addClass('d-none')
                                    $('#product_not_select_message').addClass('d-none')


                                    $('#product_not_select_message').children(':first').text('Please Add  the proudct in the below cart')



                                    iframe.contentWindow.print();
                                }
                            } else {
                                let iframe = $('#emp_details_iframe')[0]
                                //   iframe.setAttribute('src', "data:application/pdf;base64," + response)
                                iframe.setAttribute('src', url)
                                iframe.onload = function (param) {
                                    $('#product_not_select_message').addClass('d-none')


                                    $('#product_not_select_message').children(':first').text('Please Add  the proudct in the below cart')
                                    iframe.contentWindow.print();
                                }
                            }

                        }






                        })





                    })
                }

                else {
                    // alert('cart is empty')
                    $('#product_not_select_message').removeClass('d-none')
                }



            }



        })
        // submit pos form end 

        // dial paid part 
        var phoneNumber = '';

        $('.number').on('click', function (e) {
            e.preventDefault()
            var number = $(this).data('value');
            phoneNumber += number;
            $('#phone-number').val(phoneNumber);
            $('#phone-number').attr('value', phoneNumber)
        });

        $('#dot').on('click', function (e) {
            e.preventDefault()
            var number = $(this).data('value');
            if (phoneNumber.indexOf('.') === -1) {
                phoneNumber += number;

            }
        });

        $('#clear').on('click', function (e) {
            e.preventDefault()
            phoneNumber = '';
            $('#phone-number').val(phoneNumber);
            $('#phone-number').attr('value', phoneNumber)
        });

        $('#backspace').on('click', function (e) {
            e.preventDefault()
            phoneNumber = phoneNumber.slice(0, -1);
            $('#phone-number').val(phoneNumber);
            $('#phone-number').attr('value', phoneNumber)

        });

        // dial paid end 
        //  discount  will be updated if checked by dail paid start 
        $('.dial_paid_checkbox').each((key, value) => {
            if ($(value).is(':checked')) {
                $(value).prev().addClass('light_blue')
            }

        })
        $('input[name="dial_paid_checkboxes"]').each((key, value) => {
            $(value).on('click', function () {
                $('input[name="dial_paid_checkboxes"]').each((key, value) => {
                    $(value).prev().removeClass('light_blue')
                })
                if ($(value).is(':checked')) {
                    // alert('checked')
                    $(value).prev().addClass('light_blue')
                }




            })

        })
        //  discount  will be updated if checked by dail paid end 

        // check if the input value of dial paid changed or not start 
        const phoneNumberForMutation = document.getElementById('phone-number')
        // console.log(phoneNumberForMutation);
        const observer = new MutationObserver(mutations => {

            mutations.forEach(record => {
                if (record.type === 'attributes' && record.attributeName === 'value') {

                    $('.product_row').each((key, value) => {
                        if ($(value).hasClass('light_blue')) {
                            if (record.target.defaultValue != "") {
                                // now here three condition for disc,price,qty start 
                                // first condition start (disc)
                                if ($('#discount_checkbox').is(':checked')) {

                                    $(value).find('.product_discount').text(record.target.defaultValue)
                                    // on changing discount update subtotal start 
                                    setTimeout(() => {
                                        let unitPrice = parseFloat($(value).find('.unit_price').text())
                                        let qty = parseFloat($(value).find('.qty').text())
                                        let product_discount = parseFloat($(value).find('.product_discount').text())


                                        let subTotal = sessionStorage.getItem('sub_total')
                                        let total = parseFloat($('.total').text())
                                        let taxPerProduct = ((subTotal - (unitPrice * qty)) / qty)

                                        let unitPriceWithDisc = unitPrice - product_discount

                                        let tax = taxPerProduct / 100
                                        let taxRate = unitPriceWithDisc * tax
                                        let unitPriceWithDiscAndTax = unitPriceWithDisc + taxRate
                                        let productWithTaxAndDisc = unitPriceWithDiscAndTax * qty
                                        $(value).find('.sub_total').text(productWithTaxAndDisc)




                                    }, 10);

                                    setTimeout(() => {

                                        let subTotalArray = []
                                        $('.sub_total').each((key, value) => {
                                            subTotalArray.push(parseFloat($(value).text()))
                                        })
                                        console.log(subTotalArray);
                                        let subTotalSum = subTotalArray.reduce((carrier, item) => {
                                            return carrier + item
                                        })
                                        $('.total').text(subTotalSum)


                                    }, 20);





                                }
                                // first condition end (disc)
                                // now here three condition for disc,price,qty end 

                            }



                        }
                        else {
                            // alert('no class light blue class')
                            if ($('#pos_table .light_blue').length == 0) {
                                if ($('.no_product_select_msg').length == 0) {
                                    // alert('no msg')
                                    $('#phone-number').after(`
                                    <span class = "no_product_select_msg">No product selected from the product grid </span>
                                
                                    `)

                                }
                                $('.no_product_select_msg').show()
                                $('.no_product_select_msg').fadeOut(6000)


                            }


                        }
                    })


                }
            })
        })
        observer.observe(phoneNumberForMutation, {
            attributes: true,
            attributeOldValue: true,
            attributeFilter: ['value']
        })

        // check if the input value of dial paid changed or not  end


        






    });



</script>

@endSection
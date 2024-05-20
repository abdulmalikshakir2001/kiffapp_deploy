<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ public_path('dashboard_assets/inventory/css/ims_stock_request_detail_print.css') }}">

    <title>Document</title>
</head>

<body>
    <header></header>
    <section class="section">
        <div class="wrapper">

            {{-- company and quotation request information  --}}
            <div class="company_info_parent">
                <div class="company_info_left">
                    @if($company->logo!=NULL)

                    
                    <img src="{{ public_path('storage/company_logo'.'/'. $company->logo ) }}" alt="" width="" height="" class="image">
                    @else
                    <img src="{{ public_path('storage/app_logo/' . show_app_logo() ) }}" alt="" width="" height="" class="image">

                    @endif
                    
                    <p>Company Name :  {{$company->company_name}}</p>
                    <p>Registration No :  {{$company->registration_number}}</p>
                    <p>Contact Number : {{$company->contact_number}}</p>
                    <p>Email :   {{$company->email}}</p>
                    <p>Address :  {{$company->address}}</p>
                    <p>City :  {{$company->city}}</p>
                    <p>State : {{$company->state}}</p>
                </div>
                <div class="company_info_right">
                    <p class="heading " >Stock Receipt</p>
                    <p class="qr_code">{!! json_decode($ims_stock_request['qr_code_string']) !!}</p>
                    <p>Ref Number : {{ $ims_stock_request['ref_num'] }}</p>
                    <p>Stock Receipt By : {{ $result->stockRequestBy->username }}</p>
                    <p>Created By : {{ $result->createdBy->username }}</p>
                    <p>Stock Receipt From : {{ $result->stockRequestFrom->warehouse_name }}</p>
                    <p>Stock Receipt To : {{ $result->stockRequestTo->warehouse_name }}</p>
                    <p>Status : {{ $result->status }}</p>

                    
                    
                </div>
            </div>


            

            {{-- detail table --}}
            <div class="detail_table">
                <table>
                    <tr>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>Quantity </th>
                        <!-- <th>Unit Price</th>
                        <th>Discount</th>
                        <th>Taxes</th>
                        <th>Sub Total</th> -->
                    </tr>

                    {{-- loop  --}}
                    @php
                    $i = 0;
                @endphp
                @foreach ($ims_stock_request['products'] as $product)

                    <tr>
                        <td>{{ $product['product_name'] }}</td>
                        <td>Sumsung mobile </td>
                        <td>{{ $product['pivot']['quantity'] }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @php
                            $i++;
                        @endphp
                    @endforeach

                    {{-- loop  --}}

                    <!-- <tr>
                        <td colspan="4"></td>
                        <td>Taxes : </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                        <td>Sub Total : </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                        <td>Discount : </td>
                        <td></td>
                        <td></td>
                    </tr> -->

                </table>



            </div>

        </div>















    </section>
    <footer></footer>

</body>

</html>





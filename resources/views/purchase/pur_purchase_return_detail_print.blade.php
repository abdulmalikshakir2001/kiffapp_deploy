<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet"
        href="{{ public_path('dashboard_assets/purchase/css/pur_purchase_return_detail.print.css') }}">

    <title>Document</title>
</head>

<body>
    <header></header>
    <section class="section">
        <div class="wrapper">

            {{-- company and invoices request information --}}
            <div class="company_info_parent">
                <div class="company_info_left">
                    @if($company->logo!=NULL)


                    <img src="{{ public_path('storage/company_logo'.'/'. $company->logo ) }}" alt="" width="" height=""
                        class="image">
                    @else
                    <img src="{{ public_path('storage/app_logo/' . show_app_logo() ) }}" alt="" width="" height=""
                        class="image">

                    @endif

                    <p>Company Name : {{$company->company_name}}</p>
                    <p>Registration No : {{$company->registration_number}}</p>
                    <p>Contact Number : {{$company->contact_number}}</p>
                    <p>Email : {{$company->email}}</p>
                    <p>Address : {{$company->address}}</p>
                    <p>City : {{$company->city}}</p>
                    <p>State : {{$company->state}}</p>
                </div>
                <div class="company_info_right">
                    <p class="heading ">Purchase Return</p>
                    <p class="qr_code">{!! json_decode($purPurchaseReturn['qr_code_string']) !!}</p>
                    <p>Ref Number : {{ $purPurchaseReturn['ref_num'] }}</p>
                    <p class="">Creation Date : {{$purPurchaseReturn['creation_date']}}</p>
                    <p class="">Creation Time : {{$purPurchaseReturn['delivery_date']}}</p>
                </div>
            </div>


            {{-- vendor information --}}
            <div class="vendor_info_parent">
                <div class="vendor_left">
                    <h2>Bill To</h2>
                    <p>Supplier Name : {{$supplier->username}}</p>
                    <p> Email : {{$supplier->email}}</p>
                    <p>Phone Number : {{$supplier->phone_number}}</p>
                    <p>Address : {{$supplier->address}}</p>
                    <p>Zip code : {{$supplier->zip_code}}</p>
                    <p>City : {{$supplier->city}}</p>
                    <p>State : {{$supplier->state}}</p>
                </div>
                <div class="vendor_right">
                    <h2> Ship To</h2>
                    <p></p>
                    <p></p>
                    <p></p>
                    <p></p>
                </div>


            </div>

            {{-- detail table --}}
            <div class="detail_table">
                

                <table>
                    <tr>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>Quantity </th>
                        
                    </tr>
                    {{-- loop  --}}
                    @php
                    $i = 0;
                @endphp
                @foreach ($purPurchaseReturn['products'] as $product)

                    <tr>
                        <td>{{ $product['product_name'] }}</td>
                        <td>{{$product['product_description']}} </td>
                        <td>{{ $product['pivot']['quantity'] }}</td>
                    </tr>
                    @php
                            $i++;
                        @endphp
                    @endforeach

                    {{-- loop  --}}







                </table>



            </div>

        </div>















    </section>
    <footer></footer>

</body>

</html>
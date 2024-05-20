<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet"
        href="{{ public_path('dashboard_assets/sale/css/sal_cash_register_detail_print.css') }}">

    <title>Document</title>
</head>

<body>
    <header></header>
    <section class="section">
        <div class="wrapper">

            {{-- company and quotation request information --}}
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
                    <p class="heading ">Transactions</p>
                    <p class="">Cashier :{{$cashRegister->user->username}}</p>
                    <p class="">closing amount :{{$cashRegister->closing_amount}}</p>
                    @if($cashRegister->status=='close')
                    <p>status :   <span class="badge bg-danger">close</span></p>
                    @else
                    <p> status :  <span class="badge bg-success">open</span></p>
                    @endif
                    <p class="">closed at : {{ date('j F Y g:i A', strtotime($cashRegister->closed_at)) }}

                        

                    </p>
                </div>
        
            </div>

            <!-- invoice start  -->
            @php 
                    $invoiceInc = 0 ;
                    @endphp

            @foreach($cashRegister->transactions as $transaction)
            <div class="invoice">
                <p class="heading ">invoice : {{$transaction->invoice->ref_num}} </p>
                <div class="company_info_parent">
                    <div class="company_info_left">
                        <div class="primary_blue">Bill To </div>
                                    <div class="fw-bold" >Name :<span class="fw-normal">{{$transaction->invoice->user->username}} </span></div>
                                    <div class="fw-bold" >Email : <span class="fw-normal">{{$transaction->invoice->user->email}}</span></div>
                                    <div class="fw-bold" >Contact : <span class="fw-normal">{{$transaction->invoice->user->contact_number}}</span> </div>
                                    <div class="fw-bold" >Gender : <span class="fw-normal">{{$transaction->invoice->user->gender}}</span> </div>
                                    <div class="fw-bold" >Address :  <span class="fw-normal">{{$transaction->invoice->user->address}}</span></div>
                                    <div class="fw-bold" >State :  <span class="fw-normal">{{$transaction->invoice->user->state}}</span></div>
                      
                      
                    </div>
                    <div class="company_info_right">
                        <div style="height: 115px;">{!! json_decode( $transaction->invoice->qr_code_string) !!} </div>
                                    <div class="fw-bold mt-2" >QR code  :<span class="fw-normal">{{$transaction->invoice->qr_code}} </span></div>

                                    @if($transaction->invoice->invoice_status =='approved')
                                    <div class="fw-bold">Invoice status : <span class="badge bg-success">paid</span> </div>
                                    @else
                                    <div class="fw-bold">Invoice status : <span class="badge bg-danger">un paid</span> </div>

                                    @endif
                                    
                                    
                                    <div class="fw-bold">  creation date : <span class="fw-normal"> {{ date('d-m-Y', strtotime($transaction->invoice->created_at)) }}   </span>  </div>
                      
                    </div>
            
                </div>
                <div class="product_table">
                    <table class="table" >
                        <thead>
                            <tr>
                                <th scope="col">Product Name </th>
                                <th scope="col">Desc</th>
                                <th scope="col">Rate</th>
                                <th scope="col">Qty</th>

                                <th scope="col">Taxes </th>
                                <th scope="col">Taxes Value </th>
                                <th scope="col">Disc</th>
                                <th scope="col">Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php 
                            $i =0;
                            @endphp
                            @foreach($transaction->invoice->details as $detail)
                            <tr>
                                <td>{{$detail->product->product_name}}</td>
                                <td>{{$detail->product->product_description}}</td>
                                <td>{{$detail->unit_price}}</td>
                                <td>{{$detail->quantity}}</td>
                                @if($detail->pro_taxes =="NULL")
                                <td>No taxes</td>
                                @else
                                <td>{{$detail->pro_taxes}}</td>
                                @endif
                                <td> {{implode(',', $taxesAll[$invoiceInc][$i])}}</td>
                                <td>{{$detail->discount}}</td>
                                <td>{{$detail->sub_total}}</td>
                            </tr>
                            @php 
                            $i++;
                            @endphp
                            @endforeach
                            <!-- Add more rows as needed -->
                        </tbody>
                        <tfoot>
                            <tr class="subtotal" >
                                <td colspan="7">Total Taxes</td>
                                    <td>{{$taxesPerInvoiceArray[$invoiceInc] . '%'}}</td> 
                            </tr>
                            <tr class="subtotal">
                                
                                <td colspan="7">Total</td>
                                <td>{{$subTotalPerInvoiceArray[$invoiceInc]}}</td> 
                            </tr>
                            
                        </tfoot>
                    </table>

                </div>



            </div>
            @php 
                    $invoiceInc++;
                    @endphp 
                    
                    @endforeach

            <!-- invoice end  -->
            <!-- footer of transaction -->
            <div class="transaction_footer">
                <p class="transactions_amount">Transactions Amount :  {{$transactionsAmount}}</p>

            </div>


            

        </div>















    </section>
    <footer></footer>

</body>

</html>
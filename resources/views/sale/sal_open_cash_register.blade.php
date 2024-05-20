@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{ asset('dashboard_assets/sale/css/sal_open_cash_register.css') }}">
@endSection
@section('body_content')
<div class="row profile">
    <div class="col-md-12">
        {{-- quotation request form start --}}

        <div class="row">
            <div class="col-md-12">

                <form action="{{route('store_cash_register_amount_in_session')}}" id="pur_purchase_order_form">
                    @csrf
                    <div class="container-fluid ">
                        <div class="row  profile_row">

                            

                            

                            


                            <!--  lable div end  -->
                            <div class="col-md-12">
                                <div class="parent">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h5 class="">Open Cash Register </h5>
                                        </div>

                                        
                                    </div>
                                </div>
                            </div>
                            <!-- lable div end  -->

                            <!-- user information start  -->
                            <div class="col-md-12">
                                <div class="parent">
                                    <div class="row gy-3">


                                        <div class="col-md-8">
                                            <label for="open_register_amount">Cash In Hand</label>
                                            <input type="text" name="open_register_amount" id="open_register_amount" class="form-control"
                                                placeholder="Enter Amount">
                                                @if ($errors->has('open_register_amount'))
                                                <span class="error">{{ $errors->first('open_register_amount') }}</span>
                                            @endif
                                        </div>

                                        <div class="col-md-8">
                                            <div class="row justify-content-end">
                                                <div class="col-md-3">
                                                    <button type="submit" class="btn btn-primary  w-100" id="">Open Register
                                                    </button>

                                                </div>

                                            </div>
                                            

                                        </div>

                                        


                                    </div>
                                </div>
                            </div>
                            <!-- user information end  -->


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
        @php
        $baseUrl = config('app.url');
                echo "const base_url = '".$baseUrl. "';";
        @endphp

        // alert('ok')
        if (sessionStorage.getItem('message') !== null) {
            new Promise((resolve,reject)=>{
              $element=    $('.profile_row').prepend(`
            <div class="col-md-12 message">
                                <div class="alert alert-success  text-white pur_purchase_order_added_message  user_updated_msg"
                                                role="alert" id="product_not_select_message">
                                                <span>
                                                     ${sessionStorage.getItem('message')}
                                                </span>
                                                <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                            </div>
                            </div>
            `)
            // console.log($element);
            if($element.length == 1 ){
                resolve(1)
            }
            }).then((elementAppended)=>{
                if(elementAppended == 1){
                        $('.message').fadeOut(6000)

                }
            })



            
            


} 
sessionStorage.removeItem('message')




        
    });


</script>

@endSection
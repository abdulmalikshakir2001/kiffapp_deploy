@extends('dashboard/nav_footer')
@section('page_header_links')
    <link rel="stylesheet" href="{{ asset('dashboard_assets/crm/css/crmPhoneCall.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard_assets/crm/css/removeArrow.css') }}">
@endSection
@section('body_content')
    <div class="row">
        <div class="col-md-12">

            <form action="" id="crmPhoneCallUpdateForm">
                <input disabled type="hidden" name="phone_call_id" id="phone_call_id" value="{{ $crmPhoneCall->phone_call_id }}">
                @csrf
                <div class="container-fluid profile">
                    <div class="row gy-4 profile_row">
                        <!--  lable div end  -->
                        <div class="col-md-12">
                            <div class="parent position-relative">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h5 class="">Phone Call Details</h5>
                                    </div>

                                    <div class="col-md-8 col-8 d-flex justify-content-end">
                                        <button type="button" class="btn btn-sm bg-primary crmPhoneCallDetailsPrint letter-spacing text-white" data-crm_phone_call_id="{{$crmPhoneCall->phone_call_id}}"><i class="fas fa-print"></i> print</button>
                                    </div>
                                    <div class="col-md-8 col-12 msg">
                                        <div class="alert alert-success   d-none text-white waitMessage" role="alert" id="waitMessage">
                                            Please wait..........request processing
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
                                                        <h5 class="">Phone Call Information</h5>
                                                        <div class="row gy-3">
                        
                                                            <div class="col-md-6">
                                                                <label for="contact_id">Contact Name </label>
                                                                <select disabled name="contact_id" id="contact_id" class="form-select contact_id">
                                                                    <option></option>
                                                                    @foreach ($contacts as $contact)
                                                                        <option value="{{ $contact->user_id }}" {{$crmPhoneCall->contact_id==$contact->user_id?'selected':''}} >{{ $contact->username }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                        
                        
                        
                                                            <div class="col-md-6">
                                                                <label for="lead_id">Lead Name </label>
                                                                <select disabled name="lead_id" id="lead_id" class="form-select lead_id input_diabled">
                                                                    <option></option>
                                                                    @foreach ($leads as $lead)
                                                                        <option value="{{ $lead->lead_id }}"  {{$crmPhoneCall->lead_id==$lead->lead_id?'selected':''}} > {{ $lead->category_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                        
                                                            <div class="col-md-6">
                                                                <label for="date"> Date</label>
                                                                <input disabled type="date" name="date" id="date" class="form-control input_diabled" value="{{$crmPhoneCall->date}}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="duration"> Duration</label>
                                                                <input disabled type="text" name="duration" id="duration" class="form-control input_diabled"
                                                                    placeholder="Duration" value="{{$crmPhoneCall->duration}}">
                                                            </div>
                        
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- user information end  -->
                        
                        
                        
                        
                                                <!--  Descriptions  start  -->
                                                <div class="col-md-12">
                                                    <div class="parent">
                                                        <h5 class="">Descriptions</h5>
                                                        <div class="row gy-3">
                        
                                                            <div class="col-md-6">
                                                                <label for="call_summary">Call Summary</label>
                                                                <textarea disabled disabled name="call_summary" cols="" rows="1" id="call_summary" placeholder="Call Summary"
                                                                    class="form-control input_diabled">{{$crmPhoneCall->call_summary}}</textarea>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="remarks">Remarks</label>
                                                                <textarea disabled name="remarks" cols="" rows="1" id="remarks" placeholder="Remarks" class="form-control input_diabled">{{$crmPhoneCall->remarks}}</textarea>
                                                            </div>
                        
                        
                        
                                                        </div>
                                                    </div>
                                                </div>
                        
                                                <!-- Descriptions end  -->


                        
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

            // employee id
            $("#employee_id").select2({
                placeholder: "Sales Person Name",
                allowClear: true,
                width: "100%",
            });
            // contact id // for creation of lead 
            $("#contact_id").select2({
                placeholder: "Select Contact",
                allowClear: true,
                width: "100%",
            });
            // categroy id // lead interest in which service
            $("#category_id").select2({
                placeholder: "Select Category",
                allowClear: true,
                width: "100%",
            });
            // priority
            $("#priority").select2({
                placeholder: "Select Priority",
                allowClear: true,
                width: "100%",
            });

            // hide select error when the field is selected start 
            $('#employee_id').on('change', function(param) {
                let employeeIdValue = $(this).val();
                if (employeeIdValue == "") {
                    $('#employee_id-error').removeClass('d-none') // label
                } else {
                    $('#employee_id-error').addClass('d-none') // label
                }
            })

            $('#contact_id').on('change', function(param) {
                let contactIdValue = $(this).val();
                if (contactIdValue == "") {

                    $('#contact_id-error').removeClass('d-none') // label
                } else {
                    $('#contact_id-error').addClass('d-none') // label

                }
            })


            $('#category_id').on('change', function(param) {
                let categoryIdValue = $(this).val();
                if (categoryIdValue == "") {

                    $('#category_id-error').removeClass('d-none') // label
                } else {
                    $('#category_id-error').addClass('d-none') // label
                }
            })
            // hide select error when the field is selected end 
            //
    // crm lead details print start
    $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click', '.crmPhoneCallDetailsPrint', function() {
                // alert($(this).data('user_id'))
                let crmPhoneCallId = $(this).data('crm_phone_call_id')
                $.ajax({
                    type: "post",
                    url: base_url + "phoneCallUrl",
                    data: {
                        crmPhoneCallId: crmPhoneCallId
                    },
                    dataType: "json",
                    success: function(response) {
                        // alert(response)
                        // return false

                        $('.waitMessage').removeClass('d-none')
                        if ($('#emp_details_iframe').length === 0) {
                            let iframe = document.createElement('iframe')
                            iframe.setAttribute('id', "emp_details_iframe")
                            iframe.setAttribute('class', "d-none")
                            iframe.setAttribute('src', response)
                            $('body').append(iframe)
                            iframe.onload = function(param) {
                                $('.waitMessage').addClass('d-none')
                                iframe.contentWindow.print();
                            }
                        } else {
                            let iframe = $('#emp_details_iframe')[0]
                            //   iframe.setAttribute('src', "data:application/pdf;base64," + response)
                            iframe.setAttribute('src', response)
                            iframe.onload = function(param) {
                                $('.waitMessage').addClass('d-none')
                                iframe.contentWindow.print();
                            }
                        }
                    }
                });

            })

            // crm lead details print end 







        });
    </script>
@endSection

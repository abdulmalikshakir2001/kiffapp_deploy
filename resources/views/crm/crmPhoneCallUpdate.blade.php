@extends('dashboard/nav_footer')
@section('page_header_links')
    <link rel="stylesheet" href="{{ asset('dashboard_assets/crm/css/crmPhoneCall.css') }}">
@endSection
@section('body_content')
    <div class="row">
        <div class="col-md-12">

            <form action="" id="crmPhoneCallUpdateForm">
                <input type="hidden" name="phone_call_id" id="phone_call_id" value="{{ $crmPhoneCall->phone_call_id }}">
                @csrf
                <div class="container-fluid profile">
                    <div class="row gy-4 profile_row">
                        <!--  lable div end  -->
                        <div class="col-md-12">
                            <div class="parent">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h5 class="">Update Phone Call</h5>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="alert alert-success  d-none text-white crmPhoneCallUpdateMessage user_updated_msg"
                                            role="alert" id="crmPhoneCalladdedMessage">
                                            Phone Call Updated successfully
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
                                                                <select name="contact_id" id="contact_id" class="form-select contact_id">
                                                                    <option></option>
                                                                    @foreach ($contacts as $contact)
                                                                        <option value="{{ $contact->user_id }}" {{$crmPhoneCall->contact_id==$contact->user_id?'selected':''}} >{{ $contact->username }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                        
                        
                        
                                                            <div class="col-md-6">
                                                                <label for="lead_id">Lead Name </label>
                                                                <select name="lead_id" id="lead_id" class="form-select lead_id">
                                                                    <option></option>
                                                                    @foreach ($leads as $lead)
                                                                        <option value="{{ $lead->lead_id }}"  {{$crmPhoneCall->lead_id==$lead->lead_id?'selected':''}} > {{ $lead->category_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                        
                                                            <div class="col-md-6">
                                                                <label for="date"> Date</label>
                                                                <input type="date" name="date" id="date" class="form-control" value="{{$crmPhoneCall->date}}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="duration"> Duration</label>
                                                                <input type="text" name="duration" id="duration" class="form-control"
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
                                                                <textarea name="call_summary" cols="" rows="1" id="call_summary" placeholder="Call Summary"
                                                                    class="form-control">{{$crmPhoneCall->call_summary}}</textarea>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="remarks">Remarks</label>
                                                                <textarea name="remarks" cols="" rows="1" id="remarks" placeholder="Remarks" class="form-control">{{$crmPhoneCall->remarks}}</textarea>
                                                            </div>
                        
                        
                        
                                                        </div>
                                                    </div>
                                                </div>
                        
                                                <!-- Descriptions end  -->
                        








                        <!-- button start  -->
                        <div class="col-md-12">
                            <div class="parent">
                                <div class="row justify-content-end">
                                    <div class="col-md-3">

                                        <button type="submit" class="btn btn-primary  w-100" id="added_user_btn">Update
                                            Phone Call</button>

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
            // crm lead add  start
            $("#crmPhoneCallUpdateForm").validate({
                rules: {
                    contact_id: {
                        required: true,
                    },
                    employee_id: {
                        required: true,
                    },
                    category_id: {
                        required: true,
                    },
                    priority: {
                        required: true,
                    },
                    subject: {
                        required: true
                    },



                },
                messages: {
                    contact_id: {
                        required: 'Contact Name required',
                    },
                    employee_id: {
                        required: 'Sales person  name required',
                    },
                    category_id: {
                        required: 'Select categroy',
                    },
                    priority: {
                        required: 'Select priority',
                    },
                    subject: {
                        required: "Subject Required"
                    },

                },
                submitHandler: function(form) {
                    $.ajax({
                        type: "post",
                        url: base_url + "phoneCallUpdate",
                        data: new FormData(form),
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response == 'true') {
                                $("#crmPhoneCallUpdateForm").trigger("reset");
                                $(".crmPhoneCallUpdateMessage").removeClass("d-none");
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

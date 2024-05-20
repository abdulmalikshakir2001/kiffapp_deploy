@extends('dashboard/nav_footer')
@section('page_header_links')
    <link rel="stylesheet" href="{{ asset('dashboard_assets/crm/css/crmPhoneCall.css') }}">
@endSection
@section('body_content')
    <div class="row">
        <div class="col-md-12">
            <form action="" id="crmPhoneCallAddedForm">
                @csrf

                <div class="container-fluid profile">
                    <div class="row gy-4 profile_row">
                        <!--  lable div end  -->
                        <div class="col-md-12">
                            <div class="parent">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h5 class="">Add Phone Call</h5>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="alert alert-success  d-none text-white crmPhoneCallAddedMessage user_updated_msg"
                                            role="alert" id="crmPhoneCalladdedMessage">
                                            Phone Call added successfully
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
                                                <option value="{{ $contact->user_id }}">{{ $contact->username }}</option>
                                            @endforeach
                                        </select>
                                    </div>



                                    <div class="col-md-6">
                                        <label for="lead_id">Lead Name </label>
                                        <select name="lead_id" id="lead_id" class="form-select lead_id">
                                            <option></option>
                                            @foreach ($leads as $lead)
                                                <option value="{{ $lead->lead_id }}">{{$lead->category_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="date"> Date</label>
                                        <input type="date" name="date" id="date" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="duration"> Duration</label>
                                        <input type="text" name="duration" id="duration" class="form-control"
                                            placeholder="Duration">
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
                                            class="form-control"></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="remarks">Remarks</label>
                                        <textarea name="remarks" cols="" rows="1" id="remarks" placeholder="Remarks" class="form-control"></textarea>
                                    </div>



                                </div>
                            </div>
                        </div>

                        <!-- Descriptions end  -->






                        <!-- button start  -->
                        <div class="col-md-12">
                            <div class="parent">
                                <div class="row justify-content-end">
                                    <div class="col-md-2">

                                        <button type="submit" class="btn btn-primary  w-100" id="added_user_btn">Add
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
            // contact id // for creation of lead 
            $("#contact_id").select2({
                placeholder: "Select Contact",
                allowClear: true,
                width: "100%",
            });

            // });
            // priority
            $("#lead_id").select2({
                placeholder: "Select Lead",
                allowClear: true,
                width: "100%",
            });

            // hide select error when the field is selected start 
            $('#contact_id').on('change', function(param) {
                let contactIdValue = $(this).val();
                if (contactIdValue == "") {

                    $('#contact_id-error').removeClass('d-none') // label
                } else {
                    $('#contact_id-error').addClass('d-none') // label

                }
            })




            $('#lead_id').on('change', function(param) {
                let leadIdValue = $(this).val();
                if (leadIdValue == "") {

                    $('#lead_id-error').removeClass('d-none') // label
                } else {
                    $('#lead_id-error').addClass('d-none') // label

                }
            })
            // hide select error when the field is selected end 

            //
            // crm lead add  start
            $("#crmPhoneCallAddedForm").validate({
                rules: {
                    contact_id: {
                        required: true,
                    },
                    lead_id: {
                        required: true,
                    },
                    duration:{
                        required: true,
                    },
                    date:{
                        required: true,
                    }



                },
                messages: {
                    contact_id: {
                        required: 'Contact Name required',
                    },


                    lead_id: {
                        required: "Lead Name Required",
                    },
                    duration:{
                        required: 'This field is required',
                    },
                    date:{
                        required: 'Date required',
                    }

                },
                submitHandler: function(form) {
                    $.ajax({
                        type: "post",
                        url: base_url + "phoneCall",
                        data: new FormData(form),
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response == 'true') {

                                defaultSelect2($('#contact_id'))
                                defaultSelect2($('#lead_id'))
                                $("#crmPhoneCallAddedForm").trigger("reset");
                                $(".crmPhoneCallAddedMessage").removeClass("d-none");
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

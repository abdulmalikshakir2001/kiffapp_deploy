@extends('dashboard/nav_footer')
@section('page_header_links')
    <link rel="stylesheet" href="{{ asset('dashboard_assets/crm/css/crmSchedulePhoneCall.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard_assets/crm/css/removeArrow.css') }}">
@endSection
@section('body_content')
    <div class="row">
        <div class="col-md-12">

            <form action="" id="crmSchedulePhoneCallUpdateForm">
                <input disabled type="hidden" name="schedule_phone_call_id" id="schedule_phone_call_id"
                    value="{{ $schedulePhoneCalls->schedule_phone_call_id }}">
                @csrf
                <div class="container-fluid profile">
                    <div class="row gy-4 profile_row">
                        <!--  lable div end  -->
                        <div class="col-md-12">
                            <div class="parent">
                                <div class="row position-relative">
                                    <div class="col-md-4">
                                        <h5 class=""> Schedule Phone Call Details</h5>
                                    </div>
                                    <div class="col-md-8 col-8 d-flex justify-content-end">
                                        <button type="button"
                                            class="btn btn-sm bg-primary crmSchedulePhoneCallDetailsPrint letter-spacing text-white"
                                            data-crm_schedule_phone_call_id="{{ $schedulePhoneCalls->schedule_phone_call_id }}"><i
                                                class="fas fa-print"></i> print</button>
                                    </div>
                                    <div class="col-md-8 col-12 msg">
                                        <div class="alert alert-success   d-none text-white waitMessage" role="alert"
                                            id="waitMessage">
                                            Please wait..........request processing
                                            <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                        </div>
                                    </div>

                                    
                                </div>
                            </div>
                        </div>
                        <!-- lable div end  -->



                        <!-- user information start  -->
                        <div class="col-md-8">
                            <div class="parent">
                                <h5 class="">Schedule Phone Call Information</h5>
                                <div class="row gy-3">


                                    {{-- contact id --}}

                                    <div class="col-md-6">
                                        <label for="contact_id">Contact Name </label>
                                        <select disabled name="contact_id" id="contact_id" class="form-select contact_id">
                                            <option></option>
                                            @foreach ($contacts as $contact)
                                                <option value="{{ $contact->user_id }}"
                                                    {{ $contact->user_id == $schedulePhoneCalls->contact_id ? 'selected' : '' }}>
                                                    {{ $contact->username }}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    {{-- category id --}}
                                    <div class="col-md-6">
                                        <label for="category_id">Category </label>
                                        <select disabled name="category_id" id="category_id" class="form-select category_id">
                                            <option></option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->category_id }}"
                                                    {{ $category->category_id == $schedulePhoneCalls->category_id ? 'selected' : '' }}>
                                                    {{ $category->category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- priority --}}

                                    <div class="col-md-6">
                                        <label for="priority">Priority </label>
                                        <select disabled name="priority" id="priority" class="form-select priority">
                                            <option></option>
                                            <option value="lowest" {{$schedulePhoneCalls->priority=="lowest" ?'selected':''}}>Lowest</option>
                                            <option value="low" {{$schedulePhoneCalls->priority=="low" ?'selected':''}}>Low</option>
                                            <option value="normal" {{$schedulePhoneCalls->priority=="normal" ?'selected':''}}>Normal</option>
                                            <option value="high" {{$schedulePhoneCalls->priority=="high" ?'selected':''}}>High</option>
                                            <option value="highest" {{$schedulePhoneCalls->priority=="highest" ?'selected':''}}>Highest</option>
                                        </select>
                                    </div>
                                    {{-- lead id --}}

                                    <div class="col-md-6">
                                        <label for="lead_id">Lead Name </label>
                                        <select disabled name="lead_id" id="lead_id" class="form-select lead_id">
                                            <option></option>
                                            @foreach ($leads as $lead)
                                                <option value="{{ $lead->lead_id }}"
                                                    {{ $lead->lead_id == $schedulePhoneCalls->lead_id ? 'selected' : '' }}>
                                                    {{ $lead->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- lead id --}}

                                    <div class="col-md-6">
                                        <label for="oppertunity_id">Oppertunity </label>
                                        <select disabled name="oppertunity_id" id="oppertunity_id"
                                            class="form-select oppertunity_id">
                                            <option></option>
                                            @foreach ($oppertunities as $oppertunity)
                                                <option value="{{ $oppertunity->oppertunity_id }}" {{$oppertunity->oppertunity_id==$schedulePhoneCalls->oppertunity_id?'selected':''}}>
                                                    
                                                    {{ $oppertunity->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- date --}}

                                    <div class="col-md-6">
                                        <label for="date"> Date</label>
                                        <input disabled type="date" name="date" id="date" class="form-control input_diabled" value="{{$schedulePhoneCalls->date}}">
                                    </div>



                                </div>
                            </div>
                        </div>
                        <!-- user information end  -->

                        <!-- related information end  -->
                        <div class="col-md-4">
                            <div class="parent h-100">
                                <h5 class="">Related Information</h5>
                                <div class="row gy-3">
                                    <div class="col-md-12">
                                        <label for="duration">Duration</label>
                                        <input disabled type="text" class="form-control input_diabled" placeholder="Duration"
                                            aria-label="Schedule Phone Call reffered By" name="duration" id="duration" value="{{$schedulePhoneCalls->duration}}">

                                    </div>

                                    <div class="col-md-12">
                                        <label for="responsible">Responsible</label>
                                        <input disabled type="text" class="form-control input_diabled" placeholder="Responsible"
                                            aria-label="Expected Revenue" name="responsible" id="responsible" value="{{$schedulePhoneCalls->responsible}}">
                                    </div>


                                </div>
                            </div>
                        </div>
                        <!-- related information end  -->


                        <!--  Descriptions  start  -->
                        <div class="col-md-12">
                            <div class="parent">
                                <h5 class="">Descriptions</h5>
                                <div class="row gy-3">

                                    <div class="col-md-6">
                                        <label for="remarks">Remarks</label>
                                        <input disabled type="text" class="form-control input_diabled" placeholder="Remarks"
                                            aria-label="Schedule Phone Call reffered By" name="remarks" id="remarks" value="{{$schedulePhoneCalls->remarks}}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="call_summary">Call Summary</label>
                                        <textarea disabled name="call_summary" id="" cols="" rows="1" id="call_summary"
                                            placeholder="Call Summary" class="form-control input_diabled">{{$schedulePhoneCalls->call_summary}}</textarea>
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
         $("#oppertunity_id").select2({
                placeholder: "Oppertunity",
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
            // priority
            $("#lead_id").select2({
                placeholder: "Select Lead",
                allowClear: true,
                width: "100%",
            });

            // hide select error when the field is selected start 
            $('#oppertunity_id').on('change', function(param) {
                let oppertunityIdValue = $(this).val();
                if (oppertunityIdValue == "") {
                    $('#oppertunity_id-error').removeClass('d-none') // label
                } else {
                    $('#oppertunity_id-error').addClass('d-none') // label
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


            $('#priority').on('change', function(param) {
                let priorityValue = $(this).val();
                if (priorityValue == "") {

                    $('#priority-error').removeClass('d-none') // label
                } else {
                    $('#priority-error').addClass('d-none') // label

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




            // crm lead details print start
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click', '.crmSchedulePhoneCallDetailsPrint', function() {
                // alert($(this).data('user_id'))
                let crmSchedulePhoneCallId = $(this).data('crm_schedule_phone_call_id')
                $.ajax({
                    type: "post",
                    url: base_url + "schedulePhoneCallUrl",
                    data: {
                        crmSchedulePhoneCallId: crmSchedulePhoneCallId
                    },
                    dataType: "json",
                    success: function(response) {
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

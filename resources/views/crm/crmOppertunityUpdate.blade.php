@extends('dashboard/nav_footer')
@section('page_header_links')
    <link rel="stylesheet" href="{{ asset('dashboard_assets/crm/css/crmOppertunity.css') }}">
@endSection
@section('body_content')
    <div class="row">
        <div class="col-md-12">

            <form action="" id="crmOppertunityUpdateForm">
                <input type="hidden" name="oppertunity_id" id="oppertunity_id" value="{{ $crmOppertunity->oppertunity_id }}">
                @csrf
                <div class="container-fluid profile">
                    <div class="row gy-4 profile_row">
                        <!--  lable div end  -->
                        <div class="col-md-12">
                            <div class="parent">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h5 class="">Update Oppertunity</h5>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="alert alert-success  d-none text-white crmOppertunityUpdateMessage user_updated_msg"
                                            role="alert" id="crmOppertunityaddedMessage">
                                            Oppertunity Updated successfully
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
                                <h5 class="">Oppertunity Information</h5>
                                <div class="row gy-3">

                                    <div class="col-md-6">
                                        <label for="subject">Subject</label>
                                        <textarea name="subject" id="subject" cols="" rows="1" placeholder="Subject" class="form-control">{{ $crmOppertunity->subject }}</textarea>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="contact_id">Contact Name </label>
                                        <select name="contact_id" id="contact_id" class="form-select contact_id">
                                            <option></option>
                                            @foreach ($contacts as $contact)
                                                <option value="{{ $contact->user_id }}"
                                                    {{ $contact->user_id == $crmOppertunity->contact_id ? 'selected' : '' }}>
                                                    {{ $contact->username }}</option>
                                            @endforeach
                                        </select>
                                    </div>



                                    <div class="col-md-6">
                                        <label for="category_id">Category </label>
                                        <select name="category_id" id="category_id" class="form-select category_id">
                                            <option></option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->category_id }}"
                                                    {{ $category->category_id == $crmOppertunity->category_id ? 'selected' : '' }}>
                                                    {{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="priority">Priority </label>
                                        <select name="priority" id="priority" class="form-select priority">
                                            <option></option>
                                            <option value="lowest" {{ $crmOppertunity->priority == 'lowest' ? 'selected' : '' }}>
                                                Lowest</option>
                                            <option value="low" {{ $crmOppertunity->priority == 'low' ? 'selected' : '' }}>Low
                                            </option>
                                            <option value="normal" {{ $crmOppertunity->priority == 'normal' ? 'selected' : '' }}>
                                                Normal</option>
                                            <option value="high" {{ $crmOppertunity->priority == 'high' ? 'selected' : '' }}>
                                                High</option>
                                            <option value="highest"
                                                {{ $crmOppertunity->priority == 'highest' ? 'selected' : '' }}>Highest</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="lead_id">Lead Name </label>
                                        <select name="lead_id" id="lead_id" class="form-select lead_id">
                                            <option></option>
                                            @foreach ($leads as $lead)
                                                <option value="{{ $lead->lead_id }}"
                                                    {{ $crmOppertunity->lead_id == $lead->lead_id ? 'selected' : '' }}>
                                                    {{$lead->category_name}}</option>
                                            @endforeach
                                        </select>
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
                                        <label for="employee_id">Sales Person Name </label>
                                        <select name="employee_id" id="employee_id" class="form-select employee_id">
                                            <option></option>
                                            @foreach ($employees as $employee)
                                                <option value="{{ $employee->user_id }}"
                                                    {{ $employee->user_id == $crmOppertunity->employee_id ? 'selected' : '' }}>
                                                    {{ $employee->username }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="col-md-12">
                                        <label for="lead_reffered_by">Oppertunity Reffered By</label>
                                        <input type="text" class="form-control" placeholder="Oppertunity reffered By"
                                            aria-label="Oppertunity reffered By" name="lead_reffered_by"
                                            id="lead_reffered_by" value="{{ $crmOppertunity->lead_reffered_by }}">

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



                                    <div class="col-md-4">
                                        <label for="internal_notes">Internal Notes</label>
                                        <textarea name="internal_notes" id="" cols="" rows="1" id="internal_notes"
                                            placeholder="Internal Notes" class="form-control">{{ $crmOppertunity->internal_notes }}</textarea>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="next_action_remarks">Next Action Remarks</label>
                                        <textarea name="next_action_remarks" id="" cols="" rows="1" id="next_action_remarks"
                                            placeholder="Next Action remarks" class="form-control">{{ $crmOppertunity->next_action_remarks }}</textarea>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="next_action_date">Next Action Date</label>
                                        <input type="date" name="next_action_date" id="next_action_date"
                                            class="form-control" value="{{ $crmOppertunity->next_action_date }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="next_action_closing_date">Next Action closing Date</label>
                                        <input type="date" name="next_action_closing_date"
                                            id="next_action_closing_date" class="form-control"
                                            value="{{ $crmOppertunity->next_action_closing_date }}">
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
                                            Oppertunity</button>

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
            $("#lead_id").select2({
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


            $('#priority').on('change', function(param) {
                let priorityValue = $(this).val();
                if (priorityValue == "") {

                    $('#priority-error').removeClass('d-none') // label
                } else {
                    $('#priority-error').addClass('d-none') // label

                }
            })


            // hide select error when the field is selected end 

            //
            // crm lead add  start
            $("#crmOppertunityUpdateForm").validate({
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
                        url: base_url + "oppertunityUpdate",
                        data: new FormData(form),
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response == 'true') {
                                $("#crmOppertunityUpdateForm").trigger("reset");
                                $(".crmOppertunityUpdateMessage").removeClass("d-none");
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

@extends('dashboard/nav_footer')
@section('page_header_links')
    <link rel="stylesheet" href="{{ asset('dashboard_assets/subscriptions/css/subscriptions.css') }}">
@endSection
@section('body_content')




    <div class="row">
        <div class="col-md-12">

            <form action="" id="subscriptions_form">
                @csrf


                <div class="container-fluid profile">
                    <div class="row gy-4 profile_row">
                        <!--  lable div end  -->
                        <div class="col-md-12">
                            <div class="parent">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h5 class="">Add Subscription</h5>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="alert alert-success  d-none text-white crmLeadAddedMessage user_updated_msg"
                                            role="alert" id="crmLeadaddedMessage">
                                            Subscription added successfully
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
                                <h5 class="">Subscription Information </h5>
                                <div class="row gy-3">

                                    <div class="col-md-6">
                                        <label for="">Start Date</label>
                                        <input type="date" class="form-control" aria-label="" name="start_date"
                                            id="start_date">
                                    </div>


                                    <div class="col-md-6">
                                        <label for="">Start End</label>
                                        <input type="date" class="form-control" aria-label="" name="end_date"
                                            id="end_date">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="">Trial Ends Date</label>
                                        <input type="date" class="form-control" aria-label="" name="trial_ends_date"
                                            id="trial_ends_date">
                                    </div>


                                    <div class="col-md-6">
                                        <label for="">Price</label>
                                        <input type="text" class="form-control" aria-label="" name="price"
                                            id="price" placeholder="Price">

                                    </div>

                                    <div class="col-md-6">
                                        <label for="">Status</label>

                                        <select name="status" id="status" class="form-select status">
                                            <option></option>
                                            <option value="Pending">Pending</option>
                                            <option value="Declined">Declined</option>
                                            <option value="Approved">Approved</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="">Company id</label>
                                        <select name="company_id" id="company_id" class="form-select company_id">
                                            <option></option>
                                            @foreach ($companies as $company)
                                                <option value="{{ $company->company_id }}">{{ $company->company_name }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>

                                    <div class="col-md-12">
                                        <label for="">Package id</label>
                                        <select name="package_id" id="package_id" class="form-select package_id">
                                            <option></option>
                                            @foreach ($subscription_packages as $subscription_package)
                                                <option value="{{ $subscription_package->package_id }}">
                                                    {{ $subscription_package->package_name }}</option>
                                            @endforeach
                                        </select>

                                    </div>

                                    <div class="col-md-6 form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="is_paid_offline"
                                            name="is_paid_offline">
                                        <label class="form-check-label" for="is_paid_offline">is paid offline</label>

                                    </div>


                                    <div class="col-md-6 form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active">
                                        <label class="form-check-label" for="is_paid_offline">is active</label>

                                    </div>





                                </div>
                            </div>
                        </div>
                        <!-- user information end  -->




                        






                        <!-- button start  -->
                        <div class="col-md-12">
                            <div class="parent">
                                <div class="row justify-content-end">
                                    <div class="col-md-2">

                                        <button type="submit" class="btn btn-primary  w-100" id="added_subsciptions_btn">Add
                                            </button>

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
        "use strict";
        $(document).ready(function() {
            @php
                $baseUrl = config('app.url');
                echo "var base_url = '" . $baseUrl . "';";
            @endphp
            // company id
            $("#company_id").select2({
                placeholder: "Select Company",
                allowClear: true,
                width: "100%",
            });
            // package  id
            $("#package_id").select2({
                placeholder: "Select Package",
                allowClear: true,
                width: "100%",
            });
            // package  id
            $("#status").select2({
                placeholder: "Select Status",
                allowClear: true,
                width: "100%",
            });

            $('#package_id').on('change', function(param) {
                let package_idValue = $(this).val();
                if (package_idValue == "") {
                    $('#package_id-error').removeClass('d-none') // label
                } else {
                    $('#package_id-error').addClass('d-none') // label
                }
            })
            $('#company_id').on('change', function(param) {
                let company_idValue = $(this).val();
                if (company_idValue == "") {
                    $('#company_id-error').removeClass('d-none') // label
                } else {
                    $('#company_id-error').addClass('d-none') // label
                }
            })
            $('#status').on('change', function(param) {
                let statusValue = $(this).val();
                if (statusValue == "") {
                    $('#status-error').removeClass('d-none') // label
                } else {
                    $('#status-error').addClass('d-none') // label
                }
            })
            // add department start
            $("#subscriptions_form").validate({
                rules: {
                    package_id: {
                        required: true,
                        number: true,

                    },
                    company_id: {
                        required: true,
                        number: true,
                    },
                    start_date: {
                        required: true
                    },
                    end_date: {
                        required: true
                    },
                    trial_ends_date: {
                        required: true
                    },
                    price: {
                        required: true,
                        number: true

                    },
                    status: {
                        required: true
                    },

                },
                messages: {
                    package_id: {
                        required: "This field is required",
                        number: "only numbers are allowed",

                    },
                    company_id: {
                        required: "This field is required",
                        number: "only numbers are allowed",
                    },
                    start_date: {
                        required: "This field is required"
                    },
                    end_date: {
                        required: "This field is required"
                    },
                    trial_ends_date: {
                        required: "This field is required"
                    },
                    price: {
                        required: "This field is required",
                        number: "only integers are allowed"

                    },
                    status: {
                        required: "Status required"
                    },

                },
                submitHandler: function(form) {
                    $.ajax({
                        type: "post",
                        url: base_url + "subscriptions",
                        data: $(form).serialize(),
                        dataType: "json",
                        success: function(response) {
                            if (response) {
                                $('#subscriptions_form').trigger('reset');
                                $(".user_updated_msg").removeClass("d-none");
                                window.scrollTo(0,0)
                            }
                        },
                    });
                },
            });

            // add department end
            
            // update start
            $(document).on("click", ".subscriptions_edit_btn", function(param) {
                let update_subscriptions_id = $(this).data("update_subscriptions_id");
                location.replace(base_url + "updateSubscriptions/" + update_subscriptions_id);
            });




            
        });
    </script>
@endSection

@extends('dashboard/nav_footer')
@section('page_header_links')
    <link rel="stylesheet" href="{{ asset('dashboard_assets/product/css/proWarrenty.css') }}">
@endSection
@section('body_content')
    <div class="row">
        <div class="col-md-12">
            <form action="" id="proWarrentyAddForm">
                @csrf
                <div class="container-fluid profile">
                    <div class="row gy-4 profile_row">
                        <!--  lable div end  -->
                        <div class="col-md-12">
                            <div class="parent">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h5 class="">Add Warrenty</h5>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="alert alert-success  d-none text-white proWarrentyAddedMessage user_updated_msg"
                                            role="alert" id="proWarrentyaddedMessage">
                                            Warrenty added successfully
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
                                <h5 class="">Warrenty Information</h5>
                                <div class="row gy-3">


                                    <div class="col-md-6">
                                        <label for="warrenty_name"> Name </label>
                                        <select name="warrenty_name" id="warrenty_name" class="form-select warrenty_name">
                                            <option></option>
                                                <option value="limited">Limited</option>
                                                <option value="lifetime">Life Time</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="duration">Duration</label>
                                        <input type="text" name="duration" id="duration" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="duration_time"> Duration Time </label>
                                        <select name="duration_time" id="duration_time" class="form-select duration_time">
                                            <option></option>
                                                <option value="day">Day</option>
                                                <option value="month">Month</option>
                                                <option value="year">Year</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" cols="" rows="1" placeholder="Description" class="form-control"></textarea>
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

                                        <button type="submit" class="btn btn-primary  w-100" id="added_user_btn">Add
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
        $(document).ready(function() {

            @php
                $baseUrl = config('app.url');
                echo "var base_url = '" . $baseUrl . "';";
            @endphp

            // employee id
            $("#warrenty_name").select2({
                placeholder: "Type",
                allowClear: true,
                width: "100%",
            });
            $("#duration_time").select2({
                placeholder: "Select Duration time",
                allowClear: true,
                width: "100%",
            });
         
            // hide select error when the field is selected start 
            $('#warrenty_name').on('change', function(param) {
                let warrenty_nameValue = $(this).val();
                if (warrenty_nameValue == "") {
                    $('#warrenty_name-error').removeClass('d-none') // label
                } else {
                    $('#warrenty_name-error').addClass('d-none') // label
                }
            })

            // hide select error when the field is selected end 

            //
            // crm lead add  start
            $("#proWarrentyAddForm").validate({
                rules: {
                    warrenty_name: {
                        required: true,
                    },
                    duration: {
                        required: true,
                        number:true
                    },
                    


                },
                messages: {
                warrenty_name: {
                        required: 'Warrenty type required',
                    },
                    duration: {
                        required: 'Duration required',
                        number:'Only Numbers are allowed'
                    },
                    start_date: {
                        required: 'Start date required',
                    },
                    end_date: {
                        required: 'End Date',
                    },
                },
                submitHandler: function(form) {
                    $.ajax({
                        type: "post",
                        url: base_url + "proWarrenty",
                        data: new FormData(form),
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response == 'true') {
                                $("#proWarrentyAddForm").trigger("reset");
                                $(".proWarrentyAddedMessage").removeClass("d-none");
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

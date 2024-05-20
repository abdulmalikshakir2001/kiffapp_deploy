@extends('dashboard/nav_footer')
@section('page_header_links')
    <link rel="stylesheet" href="{{ asset('dashboard_assets/product/css/proWarrenty.css') }}">
@endSection
@section('body_content')
    <div class="row">
        <div class="col-md-12">
            <form action="" id="proWarrentyUpdateForm">
                <input type="hidden" name="warrenty_id" id="warrenty_id" value="{{ $warrenty->warrenty_id }}">
                @csrf
                <div class="container-fluid profile">
                    <div class="row gy-4 profile_row">
                        <!--  lable div end  -->
                        <div class="col-md-12">
                            <div class="parent">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h5 class="">Update Warrenty</h5>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="alert alert-success  d-none text-white proWarrentyUpdateMessage user_updated_msg"
                                            role="alert" id="proWarrentyaddedMessage">
                                            Warrenty Updated successfully
                                            <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- lable div end  -->


                        <div class="col-md-12">
                            <div class="parent">
                                <h5 class="">Warrenty Information</h5>
                                <div class="row gy-3">




                                    <div class="col-md-6">
                                        <label for="warrenty_name"> Name </label>
                                        <select name="warrenty_name" id="warrenty_name" class="form-select warrenty_name">
                                            <option></option>
                                            <option value="limited" {{ $warrenty->warrenty_name =='limited'?'selected':''}}>Limited</option>
                                            <option value="lifetime" {{$warrenty->warrenty_name =='lifetime'?'selected':''}}>Life Time</option>
                                        </select>
                                    </div>


                                    <div class="col-md-6">
                                        <label for="duration">Duration</label>
                                        <input type="text" name="duration" id="duration" class="form-control" value="{{$warrenty->duration}}">
                                    </div>


                                    <div class="col-md-6">
                                        <label for="duration_time"> Duration Time </label>
                                        <select name="duration_time" id="duration_time" class="form-select duration_time">
                                            <option></option>
                                                <option value="day" {{$warrenty->duration_time =='day'?'selected':'' }}>Day</option>
                                                <option value="month" {{$warrenty->duration_time =='month'?'selected':'' }}>Month</option>
                                                <option value="year" {{$warrenty->duration_time =='year'?'selected':'' }}>Year</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" cols="" rows="1" placeholder="Description"
                                            class="form-control">{{$warrenty->description}}</textarea>
                                    </div>



                                </div>
                            </div>
                        </div>


                        <!-- button start  -->
                        <div class="col-md-12">
                            <div class="parent">
                                <div class="row justify-content-end">
                                    <div class="col-md-2">

                                        <button type="submit" class="btn btn-primary  w-100" id="added_user_btn">Update
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
                placeholder: "Duration Time",
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
            $('#duration_time').on('change', function(param) {
                let duration_timeValue = $(this).val();
                if (duration_timeValue == "") {
                    $('#duration_time-error').removeClass('d-none') // label
                } else {
                    $('#duration_time-error').addClass('d-none') // label
                }
            })

            // hide select error when the field is selected end   
            //
            // crm lead add  start
            $("#proWarrentyUpdateForm").validate({
                rules: {
                    warrenty_name: {
                        required: true,
                    },
                    duration: {
                        required: true,
                        number: true
                    },

                },
                messages: {
                    warrenty_name: {
                        required: 'Warrenty type required',
                    },
                    duration: {
                        required: 'Duration required',
                        number: 'Only Numbers are allowed'
                    },
                    
                },
                submitHandler: function(form) {
                    $.ajax({
                        type: "post",
                        url: base_url + "proWarrentyUpdate",
                        data: new FormData(form),
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response == 'true') {
                                $("#proWarrentyUpdateForm").trigger("reset");
                                $(".proWarrentyUpdateMessage").removeClass("d-none");
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

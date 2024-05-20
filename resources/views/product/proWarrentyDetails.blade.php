@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/product/css/proWarrenty.css')}}">
<link rel="stylesheet" href="{{asset('dashboard_assets/product/css/removeArrow.css') }}">
@endSection
@section('body_content')
<div class="row">
  <div class="col-md-12">

    <form action="" id="proWarrentyUpdateForm">
        
      @csrf
      <div class="container-fluid profile">
        <div class="row gy-4 profile_row">
          <!--  lable div end  -->
          <div class="col-md-12">
            <div class="parent">
              <div class="row position-relative">
                <div class="col-md-4">
                  <h5 class="">Warrenty Details</h5>
                </div>
                <div class="col-md-8 col-8 d-flex justify-content-end">
                    <button type="button" class="btn btn-sm bg-primary proWarrentyDetailsPrint letter-spacing text-white" data-pro_warrenty_id="{{$warrenty->warrenty_id}}"><i class="fas fa-print"></i> print</button>
                </div>
                <div class="col-md-8 col-12 msg">
                    <div class="alert alert-success d-none  text-white waitMessage" role="alert" id="waitMessage">
                        Please wait..........request processing
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
                        <label for="warrenty_name"> Type </label>
                        <select name="warrenty_name" id="warrenty_name" class="form-select warrenty_name">
                            <option></option>
                            <option value="limited" {{ $warrenty->warrenty_name =='limited'?'selected':''}}>Limited</option>
                            <option value="lifetime" {{$warrenty->warrenty_name =='lifetime'?'selected':'' }}>Life Time</option>
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
    echo "var base_url = '".$baseUrl.
    "';";
    @endphp

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



    // crm lead details print start
        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

        $(document).on('click', '.proWarrentyDetailsPrint', function() {
            // alert($(this).data('user_id'))
            let proWarrentyId = $(this).data('pro_warrenty_id')

            $.ajax({
                type: "post",
                url: base_url + "proWarrentyUrl",
                data: {
                    proWarrentyId: proWarrentyId
                },
                dataType: "json",
                success: function(response) {
                    $('.waitMessage').removeClass('d-none')
                    if ($('#emp_details_iframe').length === 0) {
          let iframe = document.createElement('iframe')
          iframe.setAttribute('id', "emp_details_iframe")
          iframe.setAttribute('class', "d-none")
          iframe.setAttribute('src',response)
          $('body').append(iframe)
          iframe.onload = function(param) {
                    $('.waitMessage').addClass('d-none')
                  iframe.contentWindow.print();
                }
        } else {
          let iframe = $('#emp_details_iframe')[0]
        //   iframe.setAttribute('src', "data:application/pdf;base64," + response)
        iframe.setAttribute('src',response)
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
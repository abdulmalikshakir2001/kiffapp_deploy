@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/crm/css/crmLead.css')}}">
<link rel="stylesheet" href="{{ asset('dashboard_assets/crm/css/removeArrow.css') }}">
@endSection
@section('body_content')
<div class="row">
  <div class="col-md-12">

    <form action="" id="crmLeadUpdateForm">
        <input disabled type="hidden" name="lead_id" id="lead_id" value="{{$lead->lead_id}}">
      @csrf
      <div class="container-fluid profile">
        <div class="row gy-4 profile_row">
          <!--  lable div end  -->
          <div class="col-md-12">
            <div class="parent">
              <div class="row position-relative">
                <div class="col-md-4">
                  <h5 class="">Lead Details</h5>
                </div>
                <div class="col-md-8 col-8 d-flex justify-content-end">
                    <button type="button" class="btn btn-sm bg-primary crmLeadDetailsPrint letter-spacing text-white" data-crm_lead_id="{{$lead->lead_id}}"><i class="fas fa-print"></i> print</button>
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




          <!-- user information start  -->
          <div class="col-md-8">
            <div class="parent">
              <h5 class="">Lead Information</h5>
              <div class="row gy-3">

                <div class="col-md-6">
                    <label for="subject">Subject</label>
                    <textarea disabled name="subject" id="subject" cols="" rows="1" placeholder="Subject" class="form-control input_diabled">{{$lead->subject}}</textarea>
                </div>

                <div class="col-md-6">
                    <label for="contact_id">Contact Name </label>
                    <select disabled  name="contact_id" id="contact_id" class="form-select contact_id input_diabled">
                      <option></option>
                      @foreach($contacts as $contact)
                      <option value="{{$contact->user_id}}" {{$contact->user_id==$lead->contact_id ? 'selected':''}}>{{$contact->username}}</option>
                      @endforeach
                    </select>
                </div>

                

                <div class="col-md-6">
                    <label for="category_id">Category </label>
                    <select disabled name="category_id" id="category_id" class="form-select category_id input_diabled">
                      <option></option>
                      @foreach($categories as $category)
                      <option value="{{$category->category_id}}" {{$category->category_id==$lead->category_id?'selected':''}}>{{$category->category_name}}</option>
                      @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                  <label for="priority">Priority </label>
                    <select disabled name="priority" id="priority" class="form-select priority input_diabled">
                      <option></option>
                      <option value="lowest" {{$lead->priority=='lowest'?'selected':'' }}>Lowest</option>
                      <option value="low" {{$lead->priority=='low'?'selected':'' }}>Low</option>
                      <option value="normal" {{$lead->priority=='normal'?'selected':'' }}>Normal</option>
                      <option value="high" {{$lead->priority=='high'?'selected':'' }}>High</option>
                      <option value="highest" {{$lead->priority=='highest'?'selected':'' }}>Highest</option>
                    </select>
                </div>
                <div class="col-md-6">
                  <label for="">Creation Date</label>
                  <input disabled type="date" name="creation_date" id="creation_date" class="form-control input_diabled" value="{{$lead->creation_date}}">
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
                    <select disabled name="employee_id" id="employee_id" class="form-select employee_id input_diabled">
                      <option></option>
                      @foreach($employees as $employee)
                      <option value="{{$employee->user_id}}" {{$employee->user_id==$lead->employee_id?'selected':''}}>{{$employee->username}}</option>
                      @endforeach
                    </select>

                </div>
                <div class="col-md-12">
                  <label for="lead_reffered_by">Lead Reffered By</label>
                  <input disabled type="text" class="form-control input_diabled" placeholder="Lead reffered By" aria-label="Lead reffered By" name="lead_reffered_by" id="lead_reffered_by" value="{{$lead->lead_reffered_by}}">

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
                  <label for="remarks">Remarks</label>
                  <input disabled type="text" class="form-control input_diabled" placeholder="Remarks" aria-label="Zip code" name="remarks" id="remarks" value="{{$lead->remarks}}">
                </div>

                <div class="col-md-4">
                  <label for="internal_notes">Internal Notes</label>
                  <textarea disabled name="internal_notes" id="" cols="" rows="1" id="internal_notes" placeholder="Internal Notes" class="form-control input_diabled">{{$lead->internal_notes}}</textarea>
                </div>


                <div class="col-md-4">
                  <label for="external_info">External Information</label>
                  <textarea disabled name="external_info" id="" cols="" rows="1" id="external_info" placeholder="External Information" class="form-control input_diabled">{{$lead->external_info}}</textarea>
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
    echo "var base_url = '".$baseUrl.
    "';";
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



    // crm lead details print start
        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

        $(document).on('click', '.crmLeadDetailsPrint', function() {
            // alert($(this).data('user_id'))
            let crmLeadId = $(this).data('crm_lead_id')

            $.ajax({
                type: "post",
                url: base_url + "leadUrl",
                data: {
                    crmLeadId: crmLeadId
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
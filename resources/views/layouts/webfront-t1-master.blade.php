<!doctype html>
<html lang="en">
@include('layouts/webfront_header_links')
<body data-spy="scroll" data-target="#navbar" data-offset="30">
  @php
     echo   Blade::render($page_content->header)
  @endphp

  
  <!-- register job candidate  start  -->
  <div class="modal fade" id="register_job_candidate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header vacancy_modal_header">
          <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Apply For Job</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-0">
          <!-- content start   -->
          <div class="container-fluid create_user_main p-0">
            <div class="row">
              <div class="col-md-12">
                <form role="form" action="" method="post" id="register_job_candidate_form" class="py-4">
                  @csrf
                  <div class="container-fluid">
                    <div class="row">

                      <!-- username -->
                      <div class="mb-4 col-md-6">
                        <label for="">User Name</label>
                        <input type="text" class="form-control" placeholder="User Name" aria-label="User Name" name="username" id="username">
                      </div>
                      <!-- email -->
                      <div class="mb-4 col-md-6">
                        <label for="">Email</label>
                        <input type="email" class="form-control" placeholder="Email" aria-label="Email" name="email" id="email">
                      </div>

                      <!-- Phone Number -->
                      <div class="mb-4 col-md-6">
                        <label for="">Phone Number</label>
                        <input type="text" class="form-control" placeholder="Phone number" aria-label="Phone number" name="phone_number" id="phone_number">
                      </div>
                      <!-- password -->
                      <div class="mb-4 col-md-6">
                        <label for="">Password</label>
                        <input type="password" class="form-control" placeholder="Password" aria-label="Password" name="password" id="password">
                      </div>
                      <!-- password -->
                      <div class="mb-4 col-md-12">
                        <label for="">Confirm Password</label>
                        <input type="password" class="form-control" placeholder=" Confirm password" aria-label="Password" name="password_confirmation" id="password_confirmation">
                      </div>

                      <div class="text-center col-md-6 m-auto">
                        <button type="submit" id="added_job_candidate_btn" class="w-100 my-4 mb-2 py-2 text-white">Apply Now</button>
                      </div>
                    </div>
                  </div>
                </form>

              </div>
            </div>
          </div>
          <!-- content end  -->

        </div>

      </div>
    </div>
  </div>
  <!-- register job candidate  end  -->


  <!-- jobs start  -->
  @if(Request::segment(2)=="jobs" || Request::segment(2)=="job")
  @if($page_content->company_jobs)
  <div class="section">
    <div class="container">
      <div class="section-title">
        <small>TESTIMONIALS</small>
        <h3>AVAILABLE JOBS </h3>
      </div>
      <!-- cards main contanier start  -->

      <div class="container-fluid">

        <div class="row ">
          @if(count($page_content->company_jobs)>0)
          @foreach($page_content->company_jobs as $company_job)
          <!-- card start  -->
          <div class="col-md-6 pt-4">
            <div class="card">
              <div class="card-header text-uppercase">
                {{$company_job->vacancy_name}}
              </div>
              <div class="card-body">
                <h5 class="card-title">{{$company_job->vacancy_name}}</h5>
                <p class="card-text"> {!! html_entity_decode($company_job->description) !!}</p>
                <p>
                  <span> Vacancies : {{$company_job->no_of_vacancy}} </span>
                </p>
                <p>
                  <span>Posted at {{$company_job->publish_date}}</span>
                </p>
                <p>
                  <span>End Date {{$company_job->end_date}} </span>
                </p>
                <a href="javascript:void" class="btn btn-primary" data-bs-target="#register_job_candidate" data-bs-toggle="modal">Register To Apply </a>
              </div>
            </div>
          </div>
          <!-- card end  -->
          @endforeach
          @else
          <div class="col-md-12 d-flex justify-content-center">
            <h5 class="text-danger"> No Job Posted Yet </h5>
          </div>

          @endif



        </div>
        <!-- cards main contanier start  -->
      </div>
    </div>
    @endif
    @endif

    <!-- jobs end -->
    @php
     echo   Blade::render($page_content->main_content);
     echo   Blade::render($page_content->footer);
  @endphp
    @include('layouts/webfront_footer_links')

</body>

</html>
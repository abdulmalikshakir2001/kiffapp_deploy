@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/create_update_user/css/all_jobs.css')}}">
@endSection
@section('body_content')
<div class="row">
    <div class="col-md-12 p-0 col-wrapper">

        <!-- content start  -->
        <div class="container-fluid p-4 create_user_main">
            <div class="row">
                <div class="col-md-12">

                    <div class="container">
                        <div class="col-md-12">
                            <div class="card job_heading ">
                                <span class="job_heading_text">AVAILABLE JOBS</span>

                            </div>
                        </div>



                        @if(count($com_job_vacancies)>0)
                        @foreach($com_job_vacancies as $com_job)

                        <form role="form" action="" method="" id="applied_job_candidate_form" enctype="multipart/form-data">

                            <!-- show message when resume sent start  -->
                            <div class="mb-3 col-md-12">
                                <div class="alert alert-success  d-none text-white resume_sent_msg user_updated_msg" role="alert">
                                    Job resume sent successfully
                                    <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                </div>
                            </div>
                            <!-- show message when resume sent end  -->
                            <!-- show message when apply exist start  -->
                            <div class="mb-3 col-md-12">
                                <div class="alert alert-warning  d-none text-white apply_exist user_updated_msg" role="alert">
                                    You have already apply for this job
                                    <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                </div>
                            </div>
                            <!-- show message when apply exist end  -->

                            <input type="hidden" name="company_id" id="company_id" value="{{$company_id}}">
                            <input type="hidden" name="job_vacancy_id" id="job_vacancy_id" value="{{$com_job-> job_vacancy_id}}">
                            @csrf

                            <div class="card mx-auto job_card">
                                <!-- <div class="row">
                                <div class="logo ml-3 mb-3"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTxDRpxI5gXgaVmnO-VgcVUNOkca91jIpS75Flbzkz5W_5g5_V5&usqp=CAU"></div>
                                <div class="header right"><i class="fas fa-ellipsis-h"></i></div>
                            </div> -->
                                <div class="card-title">
                                    <p class="heading">{{$com_job->vacancy_name}}&nbsp;<i class="far fa-compass"></i></p>
                                    <p class="d-inline-block"><span class="fw-bold">  publish Date : </span> {{$com_job->publish_date}}</p>
                                    <span class="fw-bold ps-4">  End Date : </span>  {{$com_job->end_date}}</span>
                                </div>

                                <p class="text-muted">{!! html_entity_decode( $com_job->description) !!}</p>
                                <div class="row btnrow my-4">
                                    <div class=" col-md-3"><button type="button" class="btn btn-outline-success btn-sm" style="background: #00ff002b;"> vacancies : {{$com_job->no_of_vacancy}}</button></div>
                                    <div class=" col-md-3"><button type="button" class="btn btn-outline-primary btn-sm" style="background: #007bff33;">Posted at : {{$com_job->publish_date}}</button></div>
                                    <div class=" col-md-3"><button type="button" class="btn btn-outline-danger btn-sm" style="background: #dc35452e;">End Date :{{$com_job->end_date}}</button></div>
                                    
                                </div>

                                <!-- <div class="mutual"><i class="fas fa-users"></i>&nbsp;&nbsp;<span>5 Friends work here</span></div> -->
                                <div class="row btnsubmit mt-4 d-flex justify-content-start">
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary btn-lg apply_job_btn"><span>Apply Now</span></button>
                                    </div>
                                    <!-- <div class="col-md-6 col-6">
                                    <button type="button" class="btn btn-dark btn-lg"><span>Message</span></button>
                                </div> -->
                                </div>
                            </div>

                        </form>


                        @endforeach
                        @endif



                    </div>
                </div>






            </div>
        </div>
        <!-- content end  -->





    </div>
</div>

@endSection
@section('page_script_links')
<script>
    $(document).ready(function () {
        @php
            $baseUrl = config('app.url');
            echo "var base_url = '" . $baseUrl . "';";
        @endphp
    $(document).on('click','.apply_job_btn',function (e) {
        e.preventDefault();



        let job_form= $(this).parents('#applied_job_candidate_form')[0]
            $.ajax({
                type: "post",
                url: base_url + "applied_job",
                data: new FormData(job_form),
            processData:false,
            contentType:false,
                success: function (response) {
                    if(response=='application_created'){
                        $(job_form).find('.resume_sent_msg').removeClass('d-none')
                    }
                    else if(response=='apply_exist') {
                        $(job_form).find('.apply_exist').removeClass('d-none')

                     }
                },
            });
})
});
</script>

@endSection
@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/applied_candidate/css/applied_candidate.css')}}">
@endSection
@section('body_content')
<div class="row">
  <div class="col-md-12 ">
    <!-- shortlist pop up start  -->
    <div class="modal fade" id="change_status" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header vacancy_modal_header">
            <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Interview status</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-0">
            <!-- content start   -->
            <div class="container-fluid create_user_main p-0">
              <div class="row">
                <div class="col-md-12">
                  <form role="form" action="" method="post" id="interview_status_form">
                    @csrf
                    <input type="hidden" name="user_id" id="user_id" value="">
                    <input type="hidden" name="job_vacancy_id" id="job_vacancy_id" value="">
                    <input type="hidden" name="company_id" id="company_id" value="">
                    <div class="container-fluid">
                      <div class="row">
            
                        
                        
                        <!-- vacancy_status -->
                        <div class="mb-3 col-md-12">
                          <div class="form-check form-switch">
                            <input class="form-check-input " type="checkbox" id="status" name="status">
                            <label class="form-check-label" for="">Hire</label>
                          </div>
                        </div>
                        <div class="text-center col-md-4 m-auto">
                          <button type="submit" id="interview_status_btn" class="btn bg-primary w-100 my-4 mb-2 text-white" data-bs-dismiss="modal"> Hire As Employee
                          </button>
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
    <!-- shortlist pop up end  -->




    <!-- content start  -->
    <div class="card mb-4 view_user_card">
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0  hover" id="view_interview_status" style="width: 100%;">
                                   <!-- show message when user change to employee    start  -->
                                   <div class="mb-3 col-md-12">
              <div class="alert alert-success  d-none text-white employee_change_msg user_updated_msg" role="alert">
                Candidate Change to Employee
                <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
              </div>
            </div>
            <!-- show message when user change to employee    start  -->
                                   
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">S no</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">User Name</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Vacancy Name</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">status</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">Actions</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- content end  -->
  </div>
</div>
@endSection
@section('page_script_links')
<script>
  "use strict";
$(document).ready(function () {
  @php
            $baseUrl = config('app.url');
            echo "var base_url = '" . $baseUrl . "';";
        @endphp

    // add job vaccanices end
    // dattables
    $(function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $("#view_applied_candidate").DataTable({
            processing: true,
            serverSide: true,
            ajax: base_url + "get_data_applied_candidate",
            columns: [
                { data: "DT_RowIndex", name: "DT_RowIndex" },
                { data: "username", name: "username" },
                { data: "vacancy_name", name: "vacancy_name" },
                { data: "action", name: "action" },
            ],
        });
    });
    // dattables end

    // download candidate cv start
    $(document).on("click", ".shotlist_btn", function () {
        let user_id = $(this).data("user_id");
        let job_vacancy_id = $(this).data("job_vacancy_id");
        $("#user_id").val(user_id);
        $("#job_vacancy_id").val(job_vacancy_id);
    });

    // inter view start
    $("#interview_form").validate({
        rules: {
            interview_date: {
                required: true,
            },
        },
        messages: {
            interview_date: {
                required: "Inter view Date required",
            },
        },
        submitHandler: function (form) {
            $.ajax({
                type: "post",
                url: base_url + "call_interview",
                data: $(form).serialize(),
                dataType: "json",
                success: function (response) {
                    $('#interview_form').trigger('reset');
                    if (response == true) {

                        $(".user_interview_msg").removeClass("d-none");
                    } else if (response == "already_interviewed") {
                        $(".interviewd_user").removeClass("d-none");
                    }
                },
            });
        },
    });

    // inter view end

    // inter view status start

    // dattables
    $(function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $("#view_interview_status").DataTable({
            processing: true,
            serverSide: true,
            ajax: base_url + "get_data_interview",
            columns: [
                { data: "DT_RowIndex", name: "DT_RowIndex" },
                { data: "username", name: "username" },
                { data: "vacancy_name", name: "vacancy_name" },
                { data: "status", name: "status" },
                { data: "action", name: "action" },
            ],
        });
    });
    // dattables end
    $(document).on("click", ".change_status_btn", function () {


        let user_id = $(this).data("user_id");
        let job_vacancy_id = $(this).data("job_vacancy_id");
        $("#user_id").val(user_id);
        $("#job_vacancy_id").val(job_vacancy_id);
    });
    $("#interview_status_form").validate({
        rules: {},
        messages: {},
        submitHandler: function (form) {
            $.ajax({
                type: "post",
                url: base_url + "interview_status_change",
                data: $(form).serialize(),
                dataType: "json",
                success: function (response) {
                    // alert(response);
                    if (response == true) {
                        $("#view_interview_status")
                            .DataTable()
                            .ajax.reload();
                        $(".employee_change_msg").removeClass("d-none");
                        $('#interview_status_form').trigger('reset');
                    }
                    //  else if (response == "already_interviewed") {
                    //     $(".interviewd_user").removeClass("d-none");
                    // }
                },
            });
        },
    });
    // inter view status end
});

</script>

@endSection
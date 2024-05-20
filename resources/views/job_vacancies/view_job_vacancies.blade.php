@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/job_vacancies/css/job_vacancies.css')}}">
@endSection
@section('body_content')
<div class="row">
  <div class="col-md-12 ">

    <!-- Button trigger modal -->
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="delete_confirm_job_vacancies" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <form id="delete_form">
            <input type="hidden" name="delete_job_vacancies_id" id="delete_job_vacancies_id">
        </form>
          <!-- <div class="modal-header border-0">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div> -->
          <div class="modal-body">
            Are You sure to delete this Job Vacancy ?

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            <button type="button" class="btn btn-primary confirm_delete_job_vacancies" data-bs-dismiss="modal">Confirm</button>
          </div>
        </div>
      </div>
    </div>

    <!-- add job vacncies start  -->
    <div class="modal fade" id="add_job_vacancies" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header vacancy_modal_header">
            <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Add Vacancy</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-0">
            <!-- content start   -->
            <div class="container-fluid create_user_main p-0">
              <div class="row">
                <div class="col-md-12">
                  <form role="form" action="" method="post" id="job_vacancies_form">
                    @csrf
                    <div class="container-fluid">
                      <div class="row">

                        <!-- vacancy_name -->
                        <div class="mb-3 col-md-6">
                          <label for="vacancy_name">Vacancy Name</label>
                          <input type="text" class="form-control vacancy_name" placeholder="Vacancy Name" aria-label="Vacancy Name" name="vacancy_name" id="vacancy_name">
                        </div>
                        <!-- no_of_vacancy -->
                        <div class="mb-3 col-md-6">
                          <label for="no_of_vacancy">No Of Vacancy</label>
                          <input type="text" class="form-control" placeholder="No Of Vacancy " aria-label="No Of Vacancy" name="no_of_vacancy" id="no_of_vacancy">
                        </div>

                        <!-- publish_date -->
                        <div class="mb-3 col-md-6">
                          <label for="publish_date">Publish Date</label>
                          <input type="date" name="publish_date" id="publish_date" placeholder="Publish Date" class="form-control">
                        </div>
                        <!-- end_date -->
                        <div class="mb-3 col-md-6">
                          <label for="end_date">Publish Date</label>
                          <input type="date" name="end_date" id="end_date" placeholder="End Date" class="form-control">
                        </div>
                        <!-- description -->
                        <div class="mb-3 col-md-12">
                          <label for="description">Description</label>
                          <textarea name="description" id="description" cols="" rows="1" placeholder="Description" class="form-control"></textarea>
                        </div>
                        <!-- vacancy_status -->
                        <div class="mb-3 col-md-12">
                          <div class="form-check form-switch">
                            <input class="form-check-input " type="checkbox" id="vacancy_status" name="vacancy_status">
                            <label class="form-check-label" for="">Status</label>
                          </div>
                        </div>


                        <div class="text-center col-md-6 m-auto">
                          <button type="submit" id="added_job_vacancies_btn" class="btn bg-primary w-100 my-4 mb-2 text-white">Add Vacancy</button>
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
    <!-- add job vacncies end  -->
    <!-- update job vacncies start  -->
    <div class="modal fade" id="update_job_vacancies" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header vacancy_modal_header">
            <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Update Vacancy</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-0">
            <!-- content start   -->
            <div class="container-fluid create_user_main p-0">
              <div class="row">
                <div class="col-md-12">
                  <form role="form" action="" method="post" id="job_vacancies_updated_form">
                    <input type="hidden" name="job_vacancy_id" id="job_vacancy_id" value="">
                    @csrf
                    <div class="container-fluid">
                      <div class="row">
                        <!-- vacancy_name -->
                        <div class="mb-3 col-md-6">
                          <label for="vacancy_name">Vacancy Name</label>
                          <input type="text" class="form-control vacancy_name" placeholder="Vacancy Name" aria-label="Vacancy Name" name="vacancy_name" id="vacancy_name">
                        </div>
                        <!-- no_of_vacancy -->
                        <div class="mb-3 col-md-6">
                          <label for="no_of_vacancy">No Of Vacancy</label>
                          <input type="text" class="form-control" placeholder="No Of Vacancy " aria-label="No Of Vacancy" name="no_of_vacancy" id="no_of_vacancy">
                        </div>

                        <!-- publish_date -->
                        <div class="mb-3 col-md-6">
                          <label for="publish_date">Publish Date</label>
                          <input type="date" name="publish_date" id="publish_date" placeholder="Publish Date" class="form-control">
                        </div>
                        <!-- end_date -->
                        <div class="mb-3 col-md-6">
                          <label for="end_date">Publish Date</label>
                          <input type="date" name="end_date" id="end_date" placeholder="End Date" class="form-control">
                        </div>
                        <!-- description -->
                        <div class="mb-3 col-md-12">
                          <label for="description">Description</label>
                          <textarea name="description" id="description" cols="" rows="1" placeholder="Description" class="form-control"></textarea>
                        </div>
                        <!-- vacancy_status -->
                        <div class="mb-3 col-md-12">
                          <div class="form-check form-switch">
                            <input class="form-check-input " type="checkbox" id="vacancy_status" name="vacancy_status">
                            <label class="form-check-label" for="">Status</label>
                          </div>
                        </div>


                        <div class="text-center col-md-6 m-auto">
                          <button type="submit" id="updated_job_vacancies_btn" class="btn bg-primary w-100 my-4 mb-2 text-white ">Update Vacancy</button>
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
    <!-- update job vacncies end  -->
    <!-- content start  -->
    <div class="card mb-4 view_user_card">
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0  hover" id="view_job_vacancies" style="width: 100%;">
            <div class="col-md-12">
              <ul class="custom_ul">
                <div class="li-wrapper d-flex justify-content-end align-items-center">
                  <li>
                   <a href="{{route('applied_candidate.index')}}"> <button type="button" class="btn btn-dark btn-sm mb-0 letter-spacing">
                      Applicants <span class="badge bg-light text-dark">{{$applicants}}</span>
                    </button>
                    </a>
                  </li>
                  <li class="ms-4"><a href="{{route('applied_candidate.index')}}"> <button type="button" class="btn btn-primary mb-0 btn-sm letter-spacing ">Candidates</button></a>
                  </li>
                </div>
              </ul>
            </div>
            <!-- show message when job vacancy  added  start  -->
            <div class="mb-3 col-md-12">
              <div class="alert alert-success  d-none text-white vacancy_added_msg user_updated_msg" role="alert">
                Job Vacancy added
                <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
              </div>
            </div>
            <!-- show message when job vacancy  added  start  -->
            <!-- show message when job vacancy   updated  start  -->
            <div class="mb-3 col-md-12">
              <div class="alert alert-success  d-none text-white vacancy_updated_msg user_updated_msg" role="alert">
                Job Vacancy updated
                <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
              </div>
            </div>
            <!-- show message when job vacancy   updated  start  -->
            <!-- show message when job vacancy   deleted start  -->
            <div class="mb-3 col-md-12">
              <div class="alert alert-success  d-none text-white vacancy_deleted_msg user_updated_msg" role="alert">
                Job Vacancy deleted
                <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
              </div>
            </div>
            <!-- show message when job vacancy   deleted  start  -->
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">S no</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Vacancy Name</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">No Of Vacancy</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Description</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Status</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Publish Date</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">End Date</th>
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
    // parse html entities start 
    function html_decode(input){
        let parser=new DOMParser().parseFromString(input,"text/html")
        return parser.documentElement.textContent;
    }
    // parse html entities end 
    
    // tiny mce start 
    tinymce.init({
        selector: "#description",

        height:280,
        plugins:
            "anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss",
        toolbar:
            "undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat",
        tinycomments_mode: "embedded",
        tinycomments_author: "Author name",
        mergetags_list: [
            { value: "First.Name", title: "First Name" },
            { value: "Email", title: "Email" },
        ],
    });
    // tiny mce end 
    
    
    // add job vacancies  start
    $("#job_vacancies_form").validate({
        rules: {
            vacancy_name: {
                required: true,
            },
            no_of_vacancy: {
                required: true,
                number:true
            },
            publish_date: {
                required: true,
            },
            end_date: {
                required: true,
            },

        },
        messages: {
            vacancy_name: {
                required: "Vacancy Title required",
            },
            no_of_vacancy: {
                required: "Please input No of Vacancy",
                number:"Numbers are allowed"
            },
            publish_date: {
                required: "Publish Date Required",
            },
            end_date: {
                required: "End Date Required",
            },
        },
        submitHandler: function (form) {
            $.ajax({
                type: "post",
                url: base_url + "job_vacancies",
                data: $(form).serialize(),
                dataType: "json",
                success: function (response) {
                    if (response) {
                        $('#job_vacancies_form').trigger('reset');
                        $("#view_job_vacancies")
                        .DataTable()
                        .ajax.reload();
                        $("#add_job_vacancies").modal('toggle');
                        $(".vacancy_added_msg").removeClass("d-none");

                    }
                },
            });
        },
    });

    // add job vaccanices end
    // dattables
    $(function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $("#view_job_vacancies").DataTable({
            processing: true,
            serverSide: true,
            ajax: base_url + "get_data_job_vacancies",
            columns: [
                { data: "DT_RowIndex", name: "DT_RowIndex" },
                { data: "vacancy_name", name: "vacancy_name" },
                { data: "no_of_vacancy", name: "no_of_vacancy" },
                { data: "description", name: "description" },
                { data: "vacancy_status", name: "vacancy_status" },
                { data: "publish_date", name: "publish_date" },
                { data: "end_date", name: "end_date" },
                { data: "action", name: "action" },
            ],
        });
    });
    // dattables end

    // delete user start
    $(document).on("click", ".job_vacancies_delete_btn", function (param) {
        $('#delete_job_vacancies_id').val($(this).data("delete_job_vacancies_id"))  ;
        
        $(".confirm_delete_job_vacancies").on("click", function () {
            $.ajax({
                type: "post",
                url: base_url + "delete_job_vacancies",
                data:$('#delete_form').serialize(),
                dataType: "json",
                success: function (response) {
                    if (response) {
                        $('.vacancy_deleted_msg').removeClass('d-none')
                        $("#view_job_vacancies")
                            .DataTable()
                            .ajax.reload();
                    }
                },
            });
        });
    });
    // delete user end
    // update job vacancy start
    $(document).on("click", ".job_vacancies_edit_btn", function (param) {
        
        
        let update_job_vacancies_id = $(this).data("update_job_vacancies_id");
        $.ajax({
            type: "post",
            url: base_url+"fetch_job_vacancy",
            data: {update_job_vacancies_id:update_job_vacancies_id},
            dataType: "json",
            success: function (response) {
                if(response){
                    
                    

                    $('#job_vacancies_updated_form').find('#job_vacancy_id').val(response.job_vacancy_id);
                    $('#job_vacancies_updated_form').find('.vacancy_name').val(response.vacancy_name);
                    $('#job_vacancies_updated_form').find('#no_of_vacancy').val(response.no_of_vacancy);
                    $('#job_vacancies_updated_form').find('#publish_date').val(response.publish_date);
                    $('#job_vacancies_updated_form').find('#end_date').val(response.end_date);

                    $('#job_vacancies_updated_form').find('#description').val(html_decode( response.description));


                        


                   if(response.vacancy_status=="publish"){
                    $('#job_vacancies_updated_form').find('#vacancy_status').prop('checked',true);

                }
                else{
                    $('#job_vacancies_updated_form').find('#vacancy_status').prop('checked',false);
                }
                    


                }

                
            }
        });
    });
    $("#job_vacancies_updated_form").validate({
        rules: {
            vacancy_name: {
                required: true,
            },
            no_of_vacancy: {
                required: true,
            },
            publish_date: {
                required: true,
            },
            end_date: {
                required: true,
            },

        },
        messages: {
            vacancy_name: {
                required: "Vacancy Title required",
            },
            no_of_vacancy: {
                required: "Please input No of Vacancy",
            },
            publish_date: {
                required: "Publish Date Required",
            },
            end_date: {
                required: "End Date Required",
            },
        },
        submitHandler: function (form) {
            $.ajax({
                type: "post",
                url: base_url + "update_job_vacancies",
                data: $(form).serialize(),
                dataType: "json",
                success: function (response) {
                    if (response) {
                        $("#view_job_vacancies")
                        .DataTable()
                        .ajax.reload();
                        $("#update_job_vacancies").modal('toggle');
                        $(".vacancy_updated_msg").removeClass("d-none");
                    }
                },
            });
        },
    });
    // update job vacancy end

    // add  button to data table to add job vacancy start 
        // adding button to the create user datatable to add user start
        setTimeout(() => {
            $(document)
                .find("#view_job_vacancies_filter")
                .append(
                    '<span class="add_user_div" ">\
                         <button type="button" class="btn bg-primary sidenav_zero_index add_job_vacancies_btn btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#add_job_vacancies" style="height:32px"> <i class="fa-solid fa-plus text-white"></i>\
                </button>\
          </span>\
       '
                );
                // check the contstains for company owner to add user start 
        }, 1);
    // add  button to data table to add job vacancy end 
    
    

    

    
});

</script>

@endSection
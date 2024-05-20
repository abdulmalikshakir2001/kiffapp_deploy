@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/job_vacancies/css/job_vacancies.css')}}">
@endSection
@section('body_content')
<div class="row">
    <div class="col-md-12">
    <!-- content start  -->
        <div class="container-fluid p-4 create_user_main">
            <div class="row">
                <div class="col-md-12">
                    <form role="form" action="" method="post" id="job_vacancies_form">
                        @csrf
                        <div class="container-fluid">
                            <div class="row">
                                <!-- show message when companies positions  added  start  -->
                                <div class="mb-3 col-md-12">
                                    <div class="alert alert-success  d-none text-white user_updated_msg" role="alert">
                                        Job Vacancy added
                                        <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                                    </div>
                                </div>
                                <!-- show message when companies positions  added  start  -->
                                <!-- vacancy_name -->
                                <div class="mb-3 col-md-6">
                                    <label for="vacancy_name">Vacancy Name</label>
                                    <input type="text" class="form-control" placeholder="Vacancy Name" aria-label="Vacancy Name" name="vacancy_name" id="vacancy_name">
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
                                    <input type="date" name="end_date" id="end_date"  placeholder="End Date" class="form-control">
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

                                
                                <div class="text-center">
                                    <button type="submit" id="added_job_vacancies_btn" class="btn bg-gradient-dark w-100 my-4 mb-2">Add Vacancy</button>
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
@endSection
@section('page_script_links')
<script>
    "use strict";
$(document).ready(function () {
    // parse html entities start 
    function html_decode(input){
        let parser=new DOMParser().parseFromString(input,"text/html")
        return parser.documentElement.textContent;
    }
    // parse html entities end 
    
    // tiny mce start 
    @php
                $baseUrl = config('app.url');
                echo "var base_url = '" . $baseUrl . "';";
            @endphp
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
        let delete_job_vacancies_id = $(this).data("delete_job_vacancies_id");
        alert(delete_job_vacancies_id);
        $(".confirm_delete_job_vacancies").on("click", function () {
            $.ajax({
                type: "post",
                url: base_url + "delete_job_vacancies",
                data: { delete_job_vacancies_id: delete_job_vacancies_id },
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
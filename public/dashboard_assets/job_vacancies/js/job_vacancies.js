"use strict";
$(document).ready(function () {
    // parse html entities start 
    function html_decode(input){
        let parser=new DOMParser().parseFromString(input,"text/html")
        return parser.documentElement.textContent;
    }
    // parse html entities end 
    
    // tiny mce start 
    const base_url = "http://127.0.0.1:8000/";
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

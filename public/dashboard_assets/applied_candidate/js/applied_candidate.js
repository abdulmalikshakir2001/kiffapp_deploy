"use strict";
$(document).ready(function () {
    const base_url = "http://127.0.0.1:8000/";

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

"use strict";
$(document).ready(function () {
    const base_url = "http://127.0.0.1:8000/";
    // martial status
    
    
    // add department start
    $("#to_do_tasks_form").validate({
        rules: {
            task_name: {
                required: true,
            },
        },
        messages: {
            task_name: {
                required: "Task name required",
            },
        },
        submitHandler: function (form) {
            $.ajax({
                type: "post",
                url: base_url + "to_do_tasks",
                data: $(form).serialize(),
                dataType: "json",
                success: function (response) {
                    if (response) {
                        $('#to_do_tasks_form').trigger('reset')
                        $('#view_to_do_tasks').DataTable().ajax.reload();

                        $(".user_updated_msg").removeClass("d-none");
                    }
                },
            });
        },
    });

    // add department end
    // dattables
    $(function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $("#view_to_do_tasks").DataTable({
            processing: true,
            serverSide: true,
            ajax: base_url + "get_data_to_do_tasks",
            columns: [
                { data: "DT_RowIndex", name: "DT_RowIndex" },
                { data: "task_name", name: "task_name" },
                { data: "task_description", name: "task_description" },
                { data: "status", name: "statu" },
                { data: "action", name: "action" },
            ],
        });
    });
    // dattables end

    // delete user start
    $(document).on("click", ".to_do_tasks_delete_btn", function (param) {
        let delete_to_do_tasks_id = $(this).data("delete_to_do_tasks_id");
        $(".confirm_delete_to_do_tasks").on("click", function () {
            $.ajax({
                type: "post",
                url: base_url + "delete_to_do_tasks",
                data: { delete_to_do_tasks_id: delete_to_do_tasks_id },
                dataType: "json",
                success: function (response) {
                    if (response) {
                        $("#view_to_do_tasks")
                            .DataTable()
                            .ajax.reload();
                    }
                },
            });
        });
    });
    // delete user end
    // update start
    $(document).on("click", ".to_do_tasks_edit_btn", function (param) {
        let update_to_do_tasks_id = $(this).data("update_to_do_tasks_id");
        location.replace(base_url + "updateToDoTasks/" + update_to_do_tasks_id);
    });
    $("#update_to_do_tasks_form").validate({
        rules: {
            task_name: {
                required: true,
            },
        },
        messages: {
            task_name: {
                required: "Task name required",
            },
        },
        submitHandler: function (form) {
            $.ajax({
                type: "post",
                url: base_url + "update_to_do_tasks",
                data: $(form).serialize(),
                dataType: "json",
                success: function (response) {
                    if (response) {
                        $(".user_updated_msg").removeClass("d-none");
                    }
                },
            });
        },
    });
    // update end
    setTimeout(() => {
        $(document).find('#view_to_do_tasks_filter').append('<span class="add_user_div" ">\
        <a href="'+base_url+"to_do_tasks/create"+'"> <button type="button" class="btn bg-primary btn-sm mb-0" style="height:32px"> <span class="material-symbols-outlined text-white" style="line-height:17px !important">\
              add_business\
            </span></button>\
        </a>\
      </span>\
   ')
       }, 1);


});

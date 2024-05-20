"use strict";
$(document).ready(function () {
    const base_url = "http://127.0.0.1:8000/";



    // add department end
    // dattables
    $(function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $("#view_db_backup").DataTable({
            processing: true,
            serverSide: true,
            ajax: base_url + "get_data_db_backup",
            columns: [
                { data: "DT_RowIndex", name: "DT_RowIndex" },
                { data: "db_backup_files", name: "db_backup_files" },
                { data: "created_at", name: "created_at" },
                { data: "action", name: "action" },
            ],
        });
    });
    // dattables end

    // delete user start
    $(document).on("click", ".db_backup_delete_btn", function (param) {
        let delete_db_backup_id = $(this).data("delete_db_backup_id");
        let db_backup_name = $(this).data("db_backup_name");
        $(".confirm_delete_db_backup").on("click", function () {
            $.ajax({
                type: "post",
                url: base_url + "delete_db_backup",
                data: { delete_db_backup_id: delete_db_backup_id ,db_backup_name:db_backup_name},
                dataType: "json",
                success: function (response) {
                    if (response) {
                        $("#view_db_backup")
                            .DataTable()
                            .ajax.reload();
                    }
                },
            });
        });
    });
    // delete user end
    // download start
    
    
    // download end

    setTimeout(() => {
        $(document).find('#view_db_backup_filter').append('<span class="add_user_div" ">\
        <a href="'+base_url+"database_backup"+'"> <button type="button" class="btn bg-primary btn-sm mb-0" style="height:32px"> <span class="text-white" style="letter-spacing:.1rem">\
              Generate Database Backup\
            </span></button>\
        </a>\
      </span>\
   ')
       }, 1);
});

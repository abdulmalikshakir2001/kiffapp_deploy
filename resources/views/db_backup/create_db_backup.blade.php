@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/db_backup/css/db_backup.css')}}">
@endSection
@section('body_content')
<div class="row">
    <div class="col-md-12">

    



    <div class="db_generate_link d-flex flex-column justify-content-center align-items-center">
    @if(Session::has('status'))
              <div class="mb-3 col-md-6">
                <div class="alert alert-success   text-white user_updated_msg" role="alert" >
                  {{Session::get('status')}} 
                  <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                </div>
              </div>
              @endif
        <h3>Click on the below button to generate Full data base backup </h3>
    <a href="{{route('database_backup')}}" class="mt-3"><button type="button" class="btn btn-primary btn-lg">Generate Databse Backup</button></a>
    <a href="{{route('db_backup.index')}}" class="mt-3"><button type="button" class="btn btn-primary btn-lg">Download Database Backup </button></a>
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
  "use strict";
$(document).ready(function () {
  @php
    $baseUrl = config('app.url');
    echo "var base_url = '".$baseUrl.
    "';";
    @endphp



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

</script>
@endSection
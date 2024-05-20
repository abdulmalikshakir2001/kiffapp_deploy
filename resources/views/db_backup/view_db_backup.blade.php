@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/db_backup/css/db_backup.css')}}">
@endSection
@section('body_content')
<div class="row">
  <div class="col-md-12 ">
                      <!-- Button trigger modal -->
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="delete_confirm_db_backup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <!-- <div class="modal-header border-0">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div> -->
      <div class="modal-body">
        Are You sure to delete this db_backup ?
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <button type="button" class="btn btn-primary confirm_delete_db_backup" data-bs-dismiss="modal">Confirm</button>
      </div>
    </div>
  </div>
</div>
    <!-- content start  -->
    <div class="card mb-4 view_user_card">
            <!-- <div class="card-header pb-0">
              <h6>Authors table</h6>
            </div> -->

            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <!-- message when database backup generated start  -->
                @if(Session::has('status'))
              <div class="mb-3 col-md-12">
                <div class="alert alert-success   text-white user_updated_msg" role="alert" >
                  {{Session::get('status')}} 
                  <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                </div>
              </div>
              @endif
                <!-- message when database backup generated -->


                <table class="table align-items-center mb-0  hover" id="view_db_backup" style="width: 100%;">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder">S no</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Database Backups</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Created At</th>
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
@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/crm/css/crmSchedulePhoneCall.css')}}">

@endSection
@section('body_content')
<div class="row">
  <div class="col-md-12 ">

    


    <!-- Modal -->
    <div class="modal fade" id="deleteConfirmModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <form id="delete_form">
            <input type="hidden" name="crmSchedulePhoneCallId" id="crmSchedulePhoneCallId">
        </form>
          <!-- <div class="modal-header border-0">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div> -->
          <div class="modal-body">
            Are You sure to delete this Schedule Phone Call ?

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            <button type="button" class="btn btn-primary crmSchedulePhoneCallConfirmDeleteButton" data-bs-dismiss="modal">Confirm</button>
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
        <!-- modal start  -->
        <!-- Button trigger modal -->


        




        <!-- botton to add user  -->

        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0  hover" id="crmSchedulePhoneCallTable" style="width: 100%;">

              <div class="alert alert-success  d-none text-white crmSchedulePhoneCallDeletedMessage user_updated_msg" role="alert" id="crmSchedulePhoneCallDeletedMessage">
                Schedule Phone Call Deleted successfully
                <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
              </div>

            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">S no</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Contact Name</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Call Summary</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Priority</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Creation Date</th>
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
  $(document).ready(function() {
    @php
            $baseUrl = config('app.url');
            echo "var base_url = '" . $baseUrl . "';";
        @endphp


    //
    
    // datatables start
    $(function() {
      $.ajaxSetup({
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
      });

      $("#crmSchedulePhoneCallTable").DataTable({
        processing: true,
        serverSide: true,
        dom: 'Blfrtip',
        buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        ajax:base_url +"schedulePhoneCallGetData"  ,
        columns: [{
            data: "DT_RowIndex",
            name: "DT_RowIndex"
          },
          {
            data: "username",
            name: "username"
          },
          {
            data: "call_summary",
            name: "call_summary"
          },
          {
            data: "priority",
            name: "priority"
          },
          {
            data: "date",
            name: "date"
          },
          {
            data: "action",
            name: "action"
          },
        ],
      });
    });
    // datatables end
    // crm schedulePhoneCall delete start
    $(document).on("click", ".crmSchedulePhoneCallDeleteBtn", function(param) {
      $('#crmSchedulePhoneCallId').val($(this).data("crm_schedule_phone_call_id"))   ;
      $(".crmSchedulePhoneCallConfirmDeleteButton").on("click", function() {
        $.ajax({
          type: "post",
          url: base_url + "schedulePhoneCallDelete",
          data: $('#delete_form').serialize(),
          dataType: "json",
          success: function(response) {
            if(response=='true'){
              $('.crmSchedulePhoneCallDeletedMessage').removeClass('d-none')

              $("#crmSchedulePhoneCallTable").DataTable().ajax.reload();
            }
          },
        });
      });
    });
    // crm schedulePhoneCall delete end
    

    // update user start
    $(document).on("click", ".crmSchedulePhoneCallEditBtn", function(param) {
      let crmSchedulePhoneCallId = $(this).data("crm_schedule_phone_call_id");
      location.replace(base_url+ "schedulePhoneCallUpdateForm/" + crmSchedulePhoneCallId);
    });
    // update user end

    

    // adding button to the create user datatable to add user start
    setTimeout(() => {
      $(document)
        .find("#crmSchedulePhoneCallTable_filter")
        .append(
          '<span class="add_user_div" ">\
                     <button type="button" class="btn bg-primary crmSchedulePhoneCallCreateButton btn-sm mb-2 mb-sm-0" data-bs-toggle="modal" data-bs-target="" style="height:32px"> <span class="material-symbols-outlined text-white" style="line-height:17px !important">\
              person_add\
            </span></button>\
      </span>\
   '
        );
      // check the contstains for company owner to add user start 
      $('.crmSchedulePhoneCallCreateButton').on('click', function() {
              window.location.replace(base_url + 'schedulePhoneCall/create')
      })
      // check the contstains for company owner to add user end
    }, 1);

  });
</script>
@endSection
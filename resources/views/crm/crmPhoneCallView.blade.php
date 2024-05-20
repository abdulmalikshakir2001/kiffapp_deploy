
@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/crm/css/crmPhoneCall.css')}}">

@endSection
@section('body_content')
<div class="row">
  <div class="col-md-12 ">

    


    <!-- Modal -->
    <div class="modal fade" id="deleteConfirmModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <form id="delete_form">
            <input type="hidden" name="crmPhoneCallId" id="crmPhoneCallId">
        </form>
          <!-- <div class="modal-header border-0">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div> -->
          <div class="modal-body">
            Are You sure to delete this Phone Call ?

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            <button type="button" class="btn btn-primary crmPhoneCallConfirmDeleteButton" data-bs-dismiss="modal">Confirm</button>
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
          <table class="table align-items-center mb-0  hover" id="crmPhoneCallTable" style="width: 100%;">

              <div class="alert alert-success  d-none text-white crmPhoneCallDeletedMessage user_updated_msg" role="alert" id="crmPhoneCallDeletedMessage">
                Phone Call Deleted successfully
                <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
              </div>

            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">S no</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Contact Name</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Call Summary</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Remarks</th>
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

      $("#crmPhoneCallTable").DataTable({
        processing: true,
        serverSide: true,
        dom: 'Blfrtip',
        buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        ajax:base_url +"phoneCallGetData"  ,
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
            data: "remarks",
            name: "remarks"
          },
          {
            data: "action",
            name: "action"
          },
        ],
      });
    });
    // datatables end
    // crm phoneCall delete start
    $(document).on("click", ".crmPhoneCallDeleteBtn", function(param) {
      $('#crmPhoneCallId').val($(this).data("crm_phone_call_id"))   ;
      $(".crmPhoneCallConfirmDeleteButton").on("click", function() {
        $.ajax({
          type: "post",
          url: base_url + "phoneCallDelete",
          data: $('#delete_form').serialize(),
          dataType: "json",
          success: function(response) {
            
            if(response=='true'){
              $('.crmPhoneCallDeletedMessage').removeClass('d-none')

              $("#crmPhoneCallTable").DataTable().ajax.reload();
            }
          },
        });
      });
    });
    // crm phoneCall delete end
    

    // update user start
    $(document).on("click", ".crmPhoneCallEditBtn", function(param) {
      let crmPhoneCallId = $(this).data("crm_phone_call_id");
      
      location.replace(base_url+ "phoneCallUpdateForm/" + crmPhoneCallId);
    });
    // update user end

    

    // adding button to the create user datatable to add user start
    setTimeout(() => {
      $(document)
        .find("#crmPhoneCallTable_filter")
        .append(
          '<span class="add_user_div" ">\
                     <button type="button" class="btn bg-primary crmPhoneCallCreateButton btn-sm mb-2 mb-sm-0" data-bs-toggle="modal" data-bs-target="" style="height:32px"> <span class="material-symbols-outlined text-white" style="line-height:17px !important">\
              person_add\
            </span></button>\
      </span>\
   '
        );
      // check the contstains for company owner to add user start 
      $('.crmPhoneCallCreateButton').on('click', function() {
              window.location.replace(base_url + 'phoneCall/create')
      })
      // check the contstains for company owner to add user end
    }, 1);

  });
</script>
@endSection
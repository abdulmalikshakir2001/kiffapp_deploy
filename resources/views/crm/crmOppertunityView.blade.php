@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/crm/css/crmOppertunity.css')}}">

@endSection
@section('body_content')
<div class="row">
  <div class="col-md-12 ">

    


    <!-- Modal -->
    <div class="modal fade" id="deleteConfirmModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <form id="delete_form">
            <input type="hidden" name="crmOppertunityId" id="crmOppertunityId">
        </form>
          <!-- <div class="modal-header border-0">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div> -->
          <div class="modal-body">
            Are You sure to delete this Oppertunity ?

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            <button type="button" class="btn btn-primary crmOppertunityConfirmDeleteButton" data-bs-dismiss="modal">Confirm</button>
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
          <table class="table align-items-center mb-0  hover" id="crmOppertunityTable" style="width: 100%;">

              <div class="alert alert-success  d-none text-white crmOppertunityDeletedMessage user_updated_msg" role="alert" id="crmOppertunityDeletedMessage">
                Oppertunity Deleted successfully
                <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
              </div>

            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">S no</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Contact Name</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Sales Person</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Category</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Priority</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Oppertunity Refferd By</th>
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

      $("#crmOppertunityTable").DataTable({
        processing: true,
        serverSide: true,
        dom: 'Blfrtip',
        buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        ajax:base_url +"oppertunityGetData"  ,
        columns: [{
            data: "DT_RowIndex",
            name: "DT_RowIndex"
          },
          {
            data: "username",
            name: "username"
          },
          {
            data: "salesPerson",
            name: "salesPerson"
          },
          {
            data: "category_name",
            name: "category_name"
          },
          {
            data: "priority",
            name: "priority"
          },
          {
            data: "lead_reffered_by",
            name: "lead_reffered_by"
          },
          {
            data: "action",
            name: "action"
          },
        ],
      });
    });
    // datatables end
    // crm oppertunity delete start
    $(document).on("click", ".crmOppertunityDeleteBtn", function(param) {
      $('#crmOppertunityId').val($(this).data("crm_oppertunity_id"))   ;
      $(".crmOppertunityConfirmDeleteButton").on("click", function() {
        $.ajax({
          type: "post",
          url: base_url + "oppertunityDelete",
          data: $('#delete_form').serialize(),
          dataType: "json",
          success: function(response) {
            if(response=='true'){
              $('.crmOppertunityDeletedMessage').removeClass('d-none')

              $("#crmOppertunityTable").DataTable().ajax.reload();
            }
          },
        });
      });
    });
    // crm oppertunity delete end
    

    // update user start
    $(document).on("click", ".crmOppertunityEditBtn", function(param) {
      let crmOppertunityId = $(this).data("crm_oppertunity_id");
      location.replace(base_url+ "oppertunityUpdateForm/" + crmOppertunityId);
    });
    // update user end

    

    // adding button to the create user datatable to add user start
    setTimeout(() => {
      $(document)
        .find("#crmOppertunityTable_filter")
        .append(
          '<span class="add_user_div" ">\
                     <button type="button" class="btn bg-primary crmOppertunityCreateButton btn-sm mb-2 mb-sm-0" data-bs-toggle="modal" data-bs-target="" style="height:32px"> <span class="material-symbols-outlined text-white" style="line-height:17px !important">\
              person_add\
            </span></button>\
      </span>\
   '
        );
      // check the contstains for company owner to add user start 
      $('.crmOppertunityCreateButton').on('click', function() {
              window.location.replace(base_url + 'oppertunity/create')
      })
      // check the contstains for company owner to add user end
    }, 1);

  });
</script>
@endSection
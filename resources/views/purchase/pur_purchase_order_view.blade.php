@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/purchase/css/pur_pro_quotation_req.css')}}">

@endSection
@section('body_content')
<div class="row">
  <div class="col-md-12 ">

    


    <!-- Modal -->
    <div class="modal fade" id="delete_confirm_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <form id="delete_form">
            <input type="hidden" name="purPurchaseOrderId" id="purPurchaseOrderId">
        </form>
          <!-- <div class="modal-header border-0">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div> -->
          <div class="modal-body">
            Are You sure to delete this Order  ?

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            <button type="button" class="btn btn-primary pur_purchase_order_confirm_delete_button" data-bs-dismiss="modal">Confirm</button>
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
          <table class="table align-items-center mb-0  hover" id="pur_purchase_order_table" style="width: 100%;">
              <div class="alert alert-success  d-none text-white pur_purchase_order_delete_message user_updated_msg" role="alert" id="pro_quotation_req_delete_message">
                Order  Deleted
                <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
              </div>

            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">S no</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Refrence Number</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Taxes</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Order Date</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Order Time</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Description</th>
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

      $("#pur_purchase_order_table").DataTable({
        processing: true,
        serverSide: true,
        dom: 'Blfrtip',
        buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        ajax:base_url +"pur_purchase_order_get_data"  ,
        columns: [{
            data: "DT_RowIndex",
            name: "DT_RowIndex"
          },
          {
            data: "ref_num",
            name: "ref_num"
          },
          {
            data: "taxes",
            name: "taxes"
          },
          {
            data: "order_date",
            name: "order_date"
          },
          {
            data: "order_time",
            name: "order_time"
          },
          {
            data: "description",
            name: "description"
          },
          
          {
            data: "action",
            name: "action"
          },
        ],
      });
    });
    // datatables end
    //  delete start
    $(document).on("click", ".pur_purchase_order_delete_btn", function(param) {
      $('#purPurchaseOrderId').val($(this).data("pur_purchase_order_id")) ;
      $(".pur_purchase_order_confirm_delete_button").on("click", function() {
        $.ajax({
          type: "post",
          url: base_url + "pur_purchase_order_delete",
          data: $('#delete_form').serialize(),
          dataType: "json",
          success: function(response) {
            if(response=='true'){
              $('.pur_purchase_order_delete_message').removeClass('d-none')

              $("#pur_purchase_order_table").DataTable().ajax.reload();
            }
          },
        });
      });
    });
    //  delete end
    

    // update user start
    $(document).on("click", ".pur_purchase_order_edit_btn", function(param) {
      let purPurchaseOrderId = $(this).data("pur_purchase_order_id");
      location.replace(base_url+ "pur_purchase_order_update_form/" + purPurchaseOrderId);
    });
    // update user end

    

    // adding button to the create user datatable to add user start
    setTimeout(() => {
      $(document)
        .find("#pur_purchase_order_table_filter")
        .append(
          '<span class="add_user_div" ">\
                     <button type="button" class="btn bg-primary pur_purchase_order_create_button btn-sm mb-2 mb-sm-0" data-bs-toggle="modal" data-bs-target="" style="height:32px"> <span class="material-symbols-outlined text-white" style="line-height:17px !important">\
              person_add\
            </span></button>\
      </span>\
   '
        );
      // check the contstains for company owner to add user start 
      $('.pur_purchase_order_create_button').on('click', function() {
              window.location.replace(base_url + 'pur_purchase_order/create')
      })
      // check the contstains for company owner to add user end
    }, 1);

  });
</script>
@endSection
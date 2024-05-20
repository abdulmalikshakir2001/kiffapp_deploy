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
            <input type="hidden" name="purPurchaseQuotationId" id="purPurchaseQuotationId">
        </form>
          <!-- <div class="modal-header border-0">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div> -->
          <div class="modal-body">
            Are You sure to delete this Purchase Quotation  ?

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            <button type="button" class="btn btn-primary pur_purchase_quotation_confirm_delete_button" data-bs-dismiss="modal">Confirm</button>
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
          <table class="table align-items-center mb-0  hover" id="pur_purchase_quotation_table" style="width: 100%;">
              <div class="alert alert-success  d-none text-white pur_purchase_quotation_delete_message user_updated_msg" role="alert" id="pro_quotation_req_delete_message">
                Purchase Quotation  Deleted
                <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
              </div>
              <div class="alert alert-success  d-none text-white quotation_to_order_message user_updated_msg" role="alert" id="">
                Quotation Converted to Order 
                <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
              </div>
              <div class="alert alert-success  d-none text-white order_exist_message user_updated_msg" role="alert" id="">
                Order already exist for this Quotation
                <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
              </div>

            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">S no</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Refrence Number</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Taxes</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Creation Date</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Creation Time</th>
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

      $("#pur_purchase_quotation_table").DataTable({
        processing: true,
        serverSide: true,
        dom: 'Blfrtip',
        buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        ajax:base_url +"pur_purchase_quotation_get_data"  ,
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
            data: "creation_date",
            name: "creation_date"
          },
          {
            data: "creation_time",
            name: "creation_time"
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
    $(document).on("click", ".pur_purchase_quotation_delete_btn", function(param) {
      $('#purPurchaseQuotationId').val($(this).data("pur_purchase_quotation_id"))   ;
      $(".pur_purchase_quotation_confirm_delete_button").on("click", function() {
        $.ajax({
          type: "post",
          url: base_url + "pur_purchase_quotation_delete",
          data: $('#delete_form').serialize(),
          dataType: "json",
          success: function(response) {
            if(response=='true'){
              $('.pur_purchase_quotation_delete_message').removeClass('d-none')

              $("#pur_purchase_quotation_table").DataTable().ajax.reload();
            }
          },
        });
      });
    });
    //  delete end
    

    // update user start
    $(document).on("click", ".pur_purchase_quotation_edit_btn", function(param) {
      let purPurchaseQuotationId = $(this).data("pur_purchase_quotation_id");
      location.replace(base_url+ "pur_purchase_quotation_update_form/" + purPurchaseQuotationId);
    });
    // update user end

    

    // adding button to the create user datatable to add user start
    setTimeout(() => {
      $(document)
        .find("#pur_purchase_quotation_table_filter")
        .append(
          '<span class="add_user_div" ">\
                     <button type="button" class="btn bg-primary pur_purchase_quotation_create_button btn-sm mb-2 mb-sm-0" data-bs-toggle="modal" data-bs-target="" style="height:32px"> <span class="material-symbols-outlined text-white" style="line-height:17px !important">\
              person_add\
            </span></button>\
      </span>\
   '
        );
      // check the contstains for company owner to add user start 
      $('.pur_purchase_quotation_create_button').on('click', function() {
              window.location.replace(base_url + 'pur_purchase_quotation/create')
      })
      // check the contstains for company owner to add user end
    }, 1);

    // convert quotation to order start 
    $(document).on('click','.pur_purchase_quotation_accept_button',function(){
      const purchaseQuotationId=  $(this).data('pur_purchase_quotation_id')
      // alert(purchaseQuotationId)
      const quotationToOrder= fetch(base_url+"quotation_to_order",{
        method:"POST",
        headers:{
          "Content-type":"application/json"
        },
        body:JSON.stringify({
          purchaseQuotationId:purchaseQuotationId,
          _token: $('meta[name="csrf-token"]').attr("content")
          
        })
      })

      quotationToOrder.then((response)=>{
        return response.json()
      }).then((json)=>{
        if(json=='true'){
          // current\
          $('.quotation_to_order_message').removeClass('d-none')
          $("#pur_purchase_quotation_table").DataTable().ajax.reload();



        }
        else if(json == "exist"){
          $('.order_exist_message').removeClass('d-none')
          $("#pur_purchase_quotation_table").DataTable().ajax.reload();


        }
      })
   
    })

    // convert quotation to order end 

  });
</script>
@endSection
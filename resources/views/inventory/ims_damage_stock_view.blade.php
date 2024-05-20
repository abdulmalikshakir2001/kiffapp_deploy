@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/inventory/css/ims_damage_stock.css')}}">

@endSection
@section('body_content')
<div class="row">
  <div class="col-md-12 ">
                        <!-- confirm close register message start  -->
                        <div class="modal fade" id="status_change_modal" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                              <form id="delete_status_form">
                                <input type="hidden" name="status" id="status">
                                <input type="hidden" name="id" id="id">
                            </form>
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Change Status</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Click ok to change status
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal" id="status_change_close">Close</button>
                                    <button type="button" class="btn btn-primary" id="status_change_confirm"
                                        data-bs-dismiss="modal">Ok</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- confirm close register message end  -->

    


    <!-- Modal -->
    <div class="modal fade" id="delete_confirm_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <form id="delete_form">
            <input type="hidden" name="imsDamageStockId" id="imsDamageStockId">
        </form>
          <!-- <div class="modal-header border-0">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div> -->
          <div class="modal-body">
            Are You sure to delete this Damage Stock ?

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            <button type="button" class="btn btn-primary ims_damage_stock_confirm_delete_button" data-bs-dismiss="modal">Confirm</button>
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
          <table class="table align-items-center mb-0  hover" id="ims_damage_stock_table" style="width: 100%;">
              <div class="alert alert-success  d-none text-white ims_damage_stock_delete_message user_updated_msg" role="alert" id="ims_damage_stock_delete_message">
                Damage Stock Deleted
                <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
              </div>

            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">S no</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Refrence Number</th>
                
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Status</th>
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

      $("#ims_damage_stock_table").DataTable({
        processing: true,
        serverSide: true,
        dom: 'Blfrtip',
        buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        ajax:base_url +"ims_damage_stock_get_data"  ,
        columns: [{
            data: "DT_RowIndex",
            name: "DT_RowIndex"
          },
          {
            data: "ref_num",
            name: "ref_num"
          },
          
          
          {
            data: "status",
            name: "status"
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
        "drawCallback":function(settings){
          

          if($('.open_close_switch').length>0){
          $('.open_close_switch').each((key,value)=>{
          $(value)[0].switchButton()
        })

        }
        // change status start 
        $('.open_close_switch').on('change',function(){

             
          $('#sidenav-main').css({'z-index':'0'})
          setTimeout(() => {
            $("#status_change_modal").modal('show');
            
          }, 10);


            $('#status').val('approved')   
            $('#id').val($(this).data('id'))    

            $('#status_change_confirm').on('click',function(){

            let statusChangePromise = fetch(base_url+'update_ims_damage_stock_status',{
              method:'post',
              headers:{
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                // "Content-type":'application/json'
              },
              body: new FormData(document.getElementById('delete_status_form'))
            })
            statusChangePromise.then((response)=>{
              return response.json()

            }).then((json)=>{
              if(json){

                $('#ims_damage_stock_table').DataTable().ajax.reload()
              }
            })


          })


          $('#status_change_close').on('click',function(){
            $('#ims_damage_stock_table').DataTable().ajax.reload()

          })

        })
        // change status end 

        

        }




      });
    });
    // datatables end
    //  delete start
    $(document).on("click", ".ims_damage_stock_delete_btn", function(param) {
      
      $('#imsDamageStockId').val($(this).data("ims_damage_stock_id"))   ;

      $('#sidenav-main').css({'z-index':0})
      setTimeout(() => {
        $('#delete_confirm_modal').modal('show')
      }, 50);

      

      $(".ims_damage_stock_confirm_delete_button").on("click", function() {
        $.ajax({
          type: "post",
          url: base_url + "ims_damage_stock_delete",
          data: $('#delete_form').serialize(),
          dataType: "json",
          success: function(response) {
            if(response=='true'){
              $('.ims_damage_stock_delete_message').removeClass('d-none')

              $("#ims_damage_stock_table").DataTable().ajax.reload();
            }
          },
        });
      });
    
    
    
    });
    //  delete end
    

    // update user start
    $(document).on("click", ".ims_damage_stock_edit_btn", function(param) {
      let imsDamageStockId = $(this).data("ims_damage_stock_id");
      location.replace(base_url+ "ims_damage_stock_update_form/" + imsDamageStockId);
    });
    // update user end

    

    // adding button to the create user datatable to add user start
    setTimeout(() => {
      $(document)
        .find("#ims_damage_stock_table_filter")
        .append(
          '<span class="add_user_div" ">\
                     <button type="button" class="btn bg-primary ims_damage_stock_create_button btn-sm mb-2 mb-sm-0" data-bs-toggle="modal" data-bs-target="" style="height:32px"> <span class="material-symbols-outlined text-white" style="line-height:17px !important">\
              person_add\
            </span></button>\
      </span>\
   '
        );
      // check the contstains for company owner to add user start 
      $('.ims_damage_stock_create_button').on('click', function() {
              window.location.replace(base_url + 'ims_damage_stock/create')
      })
      // check the contstains for company owner to add user end
    }, 1);

  });
</script>
@endSection
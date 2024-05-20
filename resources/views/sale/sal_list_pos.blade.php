@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/sale/css/sal_list_pos.css')}}">

@endSection
@section('body_content')
<div class="row content-wrapper">
  <div class="col-md-12 ">





    <!-- content start  -->
    <div class="card mb-4 view_user_card">
      <!-- <div class="card-header pb-0">
              <h6>Authors </h6>
            </div> -->

      <div class="card-body px-0 pt-0 pb-2">
        <!-- modal start  -->
        <div class="row">
          <div class="col-md-12 ">

            <div class="total_transactions_detail d-flex justify-content-between align-items-center">
              <div>Transactions</div>




            </div>


          </div>
        </div>








        <!-- botton to add user  -->

        <div class="table-responsive p-0 my-4 table_wrapper">
          <table class="table align-items-center mb-0  hover" id="sal_cash_register_table" style="width: 100%;">


            <div class="row date_range g-3">
              <div class="col-md-4">
                <label for="from_date">From Date</label>
                <input type="date" name="from_date" id="from_date" value="" class="form-control">
              </div>
              <div class="col-md-4">
                <label for="to_date">To date</label>
                <input type="date" name="to_date" id="to_date" value="" class="form-control">

              </div>
              <div class="col-md-4 align-self-end ">

                <button type="button" class="btn btn-sm btn-primary filter_button mb-0">Filter</button>

              </div>


              <div class="col-md-4">


                <label for="by_date">Search By Date
                </label>
                <input type="date" name="by_date" id="by_date" class="form-control" value="{{date('Y-m-d')}}">
              </div>

            </div>



            <div class="alert alert-success  d-none text-white sal_cash_register_delete_message user_updated_msg"
              role="alert" id="pro_quotation_req_delete_message">
              Order Deleted
              <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
            </div>

            <thead>
              <tr>
                <th> User Name</th>
                <th> Status</th>
                <th> Closed At</th>
                <th> Closing Amount</th>
                <th> Created At</th>
                <th> Actions</th>

              </tr>

            </thead>
            <tbody>
            </tbody>
          </table>
        </div>


        <div class="row">
          <div class="col-md-12">
            <div class="total_transactions_detail d-flex justify-content-end">
              <div>Sales : <span class="today_sale_amount">{{$todaySalesAmount}}</span> </div>
            </div>
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
  $(document).ready(function () {
    @php
    $baseUrl = config('app.url');
            echo "var base_url = '".$baseUrl. "';";
    @endphp

    $(function () {


      $('#sal_cash_register_table').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {

          url: base_url + "sal_list_pos_get_data",
          type: "GET",
          
          data: function (request) {
            request.by_date = $('#by_date').val()
            request.from_date = $('#from_date').val()
            request.to_date = $('#to_date').val()

          },
          
          "dataFilter": function (data) {
            var json = jQuery.parseJSON(data);

            json.recordsTotal = json.recordsTotal;

            $('.today_sale_amount').text(json.amount)
            json.recordsFiltered = json.recordsTotal;
            json.data = json.data;

            return JSON.stringify(json); // return JSON string


          }
        },
        
        columns: [
          { data: 'user_id' },
          { data: 'status' },
          { data: 'closed_at' },
          { data: 'closing_amount' },
          { data: 'created_at' },
          { data: 'action' }
        ],
        drawCallback: function (settings) {
          // alert('data loaded')
          if ($('#from_date').val() != "") {
            $('#by_date').val("")

          }
          $('#by_date').on('change', function () {
            if ($(this).val() != "") {
              $('#from_date').val("")
              $('#to_date').val("")
              // current
              $('#sal_cash_register_table').DataTable().ajax.reload()

            }
          })

          if ($('.open_close_switch').length > 0) {
            $('.open_close_switch').each((key, value) => {
              $(value)[0].switchButton()
            })

            $('.open_close_switch').on('change', function () {
              let cashRegisterId = $(this).data('id')
              let registerClosePromise = fetch(base_url + "close_register_by_admin", {
                method: 'post',
                headers: {
                  "Content-type": "application/json"
                },
                body: JSON.stringify({
                  cashRegisterId: cashRegisterId,
                  _token: $(
                    'meta[name="csrf-token"]'
                  ).attr(
                    "content")


                })
              })
              registerClosePromise.then((res) => {
                return res.json()
              }).then((json) => {
                if (json == "registerClose") {
                  $('#sal_cash_register_table').DataTable().ajax.reload()

                }
              })

            })


          }








        }



      })

    })
    //



    // filteration by date start 

    $('#by_date').on('change', function () {
      $('#sal_cash_register_table').DataTable().ajax.reload()
    })
    $('.filter_button').on('click', function () {
      $('#sal_cash_register_table').DataTable().ajax.reload()
    })







  });
</script>
@endSection
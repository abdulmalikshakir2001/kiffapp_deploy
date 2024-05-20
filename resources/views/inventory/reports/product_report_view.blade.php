@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/inventory/css/reports/product_report.css')}}">
@endSection
@section('body_content')
<div class="row">
  <div class="col-md-12 ">
                        
                    
    
    
    <div class="card mb-4 view_user_card">
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0  hover" id="product_report_table" style="width: 100%;">
            <!-- filteration start  ------------------------------------------------>
            <div class="container-fluid mb-4">
                <div class="row">
                    <div class="col-md-6 ">
                            
                        
                            <label for="" class="d-block">Search Product Stock By Name or Sku</label>
                            <div class="main search_input_butt d-sm-flex ">
                            <div>
                            <input type="search" name="search_product" id="search_product" class="form-control" placeholder="Search By Name or Sku">
                        </div>
                        <div class="ms-2 search_button_wrapper" >
                            <button type="button" class="dark_pink_color custom_button sidenav_zero_index letter-spacing-1" id="search_button">Search</button>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <!-------------------------------------------------- filteration end  -->
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">S no</th>
                
                
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Product Sku</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Product Name</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Warehouse Name</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Stock Qty</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Purchase Price</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Sale Price</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Description</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Taxes</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Unit</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">Actions</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
          
        </div>
      </div>
<!-- footer start -->
      <div class="row">
        <div class="col-md-12">
            <div class="product_total_stock"> <span class="fw-bold">Stock Qty : </span>  <span class="total_stock_value">0</span> </div>
            
            
        </div>
      </div>
      <!-- footer start -->
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
      $("#product_report_table").DataTable({
        processing: true,
        serverSide: true,
        dom: 'Blfrtip',
        buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        ajax:{
            url:base_url +"product_report",
            beforeSend:function(d){
                $('.total_stock_value').text(0)
                
            },
            data:function(d){
                d.search_product = $('#search_product').val()
            },
            "dataFilter":function(data){
          var json = jQuery.parseJSON( data );
          
            json.recordsTotal = json.recordsTotal;
            
            $('.total_stock_value').text(json.stock)
            
            json.recordsFiltered = json.recordsTotal;
            json.data = json.data;
 
            return JSON.stringify( json ); // return JSON string
          
        }
        }  ,
        columns: [
            {
            data: "DT_RowIndex",
            name: "DT_RowIndex"
          },
            
            {
            data: "product_sku",
            name: "product_sku"
          },
            {
            data: "product_name",
            name: "product_name"
          },
            
            {
            data: "warehouse_name",
            name: "warehouse_name"
          },
            {
            data: "stock_qty",
            name: "stock_qty"
          },
            {
            data: "product_purchase_price",
            name: "product_purchase_price"
          },
            
            {
            data: "product_sale_price",
            name: "product_sale_price"
          },
            {
            data: "product_description",
            name: "product_description"
          },
            {
            data: "product_taxes",
            name: "product_taxes"
          },
            
            {
            data: "product_unit",
            name: "product_unit"
          },
            
          
        ],
        // "drawCallback":function(settings){}
      });
    });
    // datatables end
    // filteration start 
    $('#search_button').on('click',function(){
        // current
        $('#product_report_table').DataTable().ajax.reload()
    })
    
    // filteration end 
    
    
    
    
    
  });
</script>
@endSection
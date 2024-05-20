@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/inventory/css/reports/warehouse_report.css')}}">
@endSection
@section('body_content')
<div class="row">
  <div class="col-md-12 ">
                        
                    
    
    
    <div class="card mb-4 view_user_card">
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0  hover" id="warehouse_report_table" style="width: 100%;">
            <!-- filteration start  ------------------------------------------------>
            <div class="container-fluid mb-4">
                <div class="row">
                    <div class="col-md-6 ">
                            
                        
                            <label for="" class="d-block">Search Warehouse Stock By Name </label>
                            <div class="main search_input_butt d-sm-flex ">
                            <div>
                            <input type="search" name="search_warehouse" id="search_warehouse" class="form-control" placeholder="Warehouse Name ">
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
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Warehouse Name</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Product Sku</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Product Name</th>
              
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Stock Qty</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Purchase Price</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Sale Price</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Description</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Taxes</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Unit</th>
                
                
                  
              </tr>
            </thead>
            <tbody>
                
            </tbody>
          </table>
          
        </div>
      </div>
<!-- footer start -->
      <!-- <div class="row">
        <div class="col-md-12">
            <div class="product_total_stock"> <span class="fw-bold">Stock Qty : </span>  <span class="total_stock_value">0</span> </div>
            
            
        </div>
      </div> -->
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
      const warehouseReportTable =  $("#warehouse_report_table").DataTable({
        processing: true,
        serverSide: true,
        dom: 'Blfrtip',
        buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        ajax:{
            url:base_url +"warehouse_report",
            beforeSend:function(d){
                
                
            },
            data:function(d){
                d.search_warehouse = $('#search_warehouse').val()
            },
            "dataFilter":function(data){
          var json = jQuery.parseJSON( data );
          console.log(json)
          
            json.recordsTotal = json.recordsTotal;
            
            // $('.total_stock_value').text(json.stock)
            
            json.recordsFiltered = json.recordsTotal;
            json.data = json.data;
            if(json.length!=0){
            json.data.push({
'DT_RowIndex':'',
'warehouse_name':'<span class = "fw-bold">Total  </span>',
'product_sku':'',
'product_name':'',
'stock_qty':json.stock,
'product_purchase_price':'',
'product_sale_price':'',
'product_description':'',
'product_taxes':'',
'product_unit':'',

            })
        }
            
            
 
            return JSON.stringify( json ); // return JSON string
          
        }
        }  ,
        columns: [
            {
            data: "DT_RowIndex",
            name: "DT_RowIndex"
          },
          {
            data: "warehouse_name",
            name: "warehouse_name"
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
        "drawCallback":function(settings){
            





        }
      });

//       let newRow = "<tr> <td>1 </td><td>1 </td><td>1 </td><td>1 </td><td>1 </td><td>1 </td><td>1 </td><td>1 </td><td>1 </td><td>1 </td>   </tr>"


// warehouseReportTable.row.add( $(newRow) ).draw();

    });

     


    // datatables end
    // filteration start 
    $('#search_button').on('click',function(){
        // current
        $('#warehouse_report_table').DataTable().ajax.reload()
    })
    
    // filteration end 
    
    
    
    
    
  });
</script>
@endSection
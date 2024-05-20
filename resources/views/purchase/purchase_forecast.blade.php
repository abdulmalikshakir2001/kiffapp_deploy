@extends('dashboard/nav_footer')
@section('page_header_links')

<link rel="stylesheet" href="{{asset('dashboard_assets/dashboard/css/dashboard.css')}}">

@endSection
@section('body_content')




<div class="row mt-4">
  <div class="col-lg-12 mb-lg-0 mb-4">
    <div class="card z-index-2 h-100">
      <div class="card-header pb-0 pt-3 bg-transparent">
        <h6 class="text-capitalize">Purchase overview</h6>
        <p class="text-sm mb-0">
          <i class="fa fa-arrow-up text-success"></i>
          <span class="font-weight-bold"></span> in {{date('Y')}}
        </p>
      </div>
      <div class="card-body p-3">
        <div class="chart">
          <canvas id="purchase_overview" class="chart-canvas" height=""></canvas>
        </div>
      </div>
    </div>
  </div>

</div>


<div class="row mt-4">
  <div class="col-lg-7 mb-lg-0 mb-4">
    <div class="card ">
      <div class="card-header pb-0 p-3">
        <div class="d-flex justify-content-between">
          <h6 class="mb-2">Top 10 purchase products (Last 3 month)</h6>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table align-items-center ">
          <tbody>
            @php
            $i= 0;
            @endphp
            @forEach($products as $product )
            <tr>
              <td class="w-30">
                <div class="d-flex px-2 py-1 align-items-center">
                  @if($product->product_image == NULL)
                  <div>
                    <img src="{{asset('default.png')}}" alt="Country flag" width="100%" height="100%" class="rounded-1">
                  </div>
                  @else
                  <div>
                    <img
                      src="{{ asset('storage/' . 'company_id_' . session()->get('company_id') . '_products' . '/' . $product->product_image) }}"
                      alt="Country flag" width="100%" height="100%" class="rounded-1">
                  </div>
                  @endif

                  <div class="ms-4">
                    <p class="text-xs font-weight-bold mb-0">Product Name:</p>
                    <h6 class="text-sm mb-0">{{$product->product_name}}</h6>
                  </div>
                </div>
              </td>
              <td>
                <div class="text-center">
                  <p class="text-xs font-weight-bold mb-0">Purchase Qty:</p>
                  <h6 class="text-sm mb-0">{{$last3MonthMostPurchaseProduct[$productIdsAsKey[$i]]}}</h6>
                </div>
              </td>
              <!-- <td>
                <div class="text-center">
                  <p class="text-xs font-weight-bold mb-0">Value:</p>
                  <h6 class="text-sm mb-0">$230,900</h6>
                </div>
              </td>
            
              <td class="align-middle text-sm">
                <div class="col text-center">
                  <p class="text-xs font-weight-bold mb-0">Bounce:</p>
                  <h6 class="text-sm mb-0">29.9%</h6>
                </div>
              </td> -->
            </tr>

            @php
            $i++;
            @endphp
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>






@endSection
@section('page_script_links')
<script src="{{asset('dashboard_assets/dashboard/js/dashboard.js')}}"></script>
<script>


  // showing purchase overview chart start 
  const ctx = document.getElementById('purchase_overview');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: @json($productNames),
      datasets: [{
        label: 'Purchase Qty',
        data: @json($productQty),
        borderWidth: 1,
        backgroundColor: [
          '#596CFF',
          '#d63384',
          '#81E6D9',
          '#0dcaf0',
          '#FBD38D',
          '#596CFF',
          '#d63384',
          '#81E6D9',
          '#0dcaf0',
          '#FBD38D',

        ]
      }]
    },
    options: {
      maintainAspectRatio: false,
        aspectRatio: 1, // Cha

      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });


  // showing purchase overview chart end 
</script>

@endSection
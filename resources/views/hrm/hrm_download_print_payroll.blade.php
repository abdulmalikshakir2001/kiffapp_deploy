<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{csrf_token()}}">
  <link rel="stylesheet" href="{{public_path('dashboard_assets/assets/css/bootstrap.css')}}">
  <link href="{{ public_path('dashboard_assets/assets/css/custom.css') }}" rel="stylesheet" media="all"/>
  <link id="pagestyle" href="{{public_path('dashboard_assets/assets/scss/argon-dashboard.css')}}" rel="stylesheet" type="text/css">
  <!-- custom css -->
  <title>Print Payroll</title>
  <style>
    /* html {
      font-size: 75%;
    } */

    .payroll_a4size {
      width: 100%;
      /* height: 841.68px; */
      /* width: 594.44px;
      height: 841.68px; */
    }

    /* Fix wkhtmltopdf compatibility with BS flex features */
    

    .row {
      display: -webkit-box;
      display: flex;
      -webkit-box-pack: center;
      justify-content: center;
      -webkit-box-pack: justify;
    }

    .row>div {
      -webkit-box-flex: 1;
      -webkit-flex: 1;
      flex: 1;
    }

    .row>div:last-child {
      margin-right: 0;
    }
  </style>


</head>


<body>
  <!-- <div class="container-fluid">
      <div class="row d-flex align-items-center  mt-4" style="padding:16px;border-radius:10px;background-color:white;box-shadow:0 0 6px 1px #dcdcdc;">
        <div class="col-7">
          <p style="font-size: 20px;" class="mb-0">Invoice <strong>ID: {{$payroll->payroll_id}}</strong></p>
        </div>
        <div class="col-5  d-flex justify-content-end">
          <a href="{{route('thermal_print_reciept_of_payroll')}}" class="btn btn-primary me-3 mb-0 text-capitalize border-0" data-mdb-ripple-color="dark"><i class="fas fa-print text-primary"></i> Print</a>
          <a href="#" data-payroll_id="{{$payroll->payroll_id}}" class="btn btn-info mb-0 text-capitalize payroll_print_export" data-mdb-ripple-color="dark"><i class="far fa-file-pdf text-danger"></i> Export</a>
        </div>
      </div>
    </div> -->



  <section class="header_main_footer_section">
    <header>
    </header>

    <main>
 
      <!-- payroll sstart  -->
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 d-flex  justify-content-center">
            <div>
              <h4 class="text-center">Comapany Name :{{$company_info->company_name}}</h4>
              <p class="text-center">[{{$company_info->email}}]</p>
              <p class="text-center">Salary Slip</p>
            </div>
          </div>
        </div>


        <div class="row">
          <div class="col-md-12">
            <h6 class="">Employee Name  <span class="ms-2 text-center" style="border-bottom:1px solid black;display:inline-block;width:200px ">{{$payroll->users->first()->username}}</span></h6>
            
             
            <h6 class="">Designation <span class="ms-2 text-center text-white" style="border-bottom:1px solid black;display:inline-block;width:200px ">malik</span></h6>
            <h6 class="">Month and Year <span class="ms-2 text-center text-white" style="border-bottom:1px solid black;display:inline-block;width:200px ">malik</span></h6>
          </div>
        </div>


        <div class="row" style="margin-top: 20px; margin-bottom:20px">
          <div class="col-md-12">
            <table class="table  table-bordered">
              <thead>
                <tr>
                  <th scope="col">Earnings</th>
                  <th scope="col"></th>
                  <th scope="col">Deductions</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">Basic Salary</th>
                  <td>{{$payroll->users->first()->basic_salary}} </td>
                  <td>Late+Early Leave</td>
                  <td>{{$payroll->deductions}}</td>
                </tr>
                <tr>
                  <th scope="row">Food Allownce</th>
                  <td>{{$payroll->users->first()->food_allownce}} </td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <th scope="row">Medical Allownce</th>
                  <td>{{$payroll->users->first()->medical_allownce}}</td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <th scope="row">Transport Allownce</th>
                  <td > {{$payroll->users->first()->transport_allownce}}</td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <th scope="row">Other Allownce</th>
                  <td>{{$payroll->users->first()->other_allownces}}</td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <th scope="row">Over Time Amount</th>
                  <td>{{$payroll->overtime_amount}}</td>
                  <td></td>
                  <td></td>
                <tr>
                  <th scope="row"></th>
                  <td></td>
                  <td>NET PAYABLE</td>
                  <td>{{$payroll->net_payable}}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>


        <div class="row">
    <div class="col-md-12 ">
      <div class="" style="display:flex;display:-webkit-box">
        <p class="">Check No <span class="ms-2 text-center text-white" style="border-bottom:1px solid black;display:inline-block;width:200px ">Check no</span></p>
        <p class=" text-center " style="flex-grow: 1;-webkit-box-flex:1">Date <span class="ms-2 text-center text-white"  style="border-bottom:1px solid black;display:inline-block;width:200px ">12/2/2023</span></p>
      </div>
      <div class="" style="display:flex;display:-webkit-box">
        <p class="">Name of Bank <span class="ms-2 text-center text-white" style="border-bottom:1px solid black;display:inline-block;width:200px ">malik</span></p>
        <p class=" text-center ps-4" style="flex-grow: 1;-webkit-box-flex:1">Signature of Employee <span class="ms-2 text-center text-white" style="border-bottom:1px solid black;display:inline-block;width:200px ">malik</span></p>
      </div>
    </div>
  </div>



      </div>
      <!-- payroll end -->






    </main>


    <footer>

    </footer>

  </section>




</body>

</html>
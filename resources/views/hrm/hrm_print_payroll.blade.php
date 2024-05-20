<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <meta name="csrf-token" content="{{csrf_token()}}">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" /> -->
  <link href="{{public_path('dashboard_assets/assets/css/custom.css')}}" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="{{public_path('dashboard_assets/hrm/css/hrm_print_payroll.css')}}">
  <link id="pagestyle" href="{{public_path('dashboard_assets/assets/scss/argon-dashboard.css')}}" rel="stylesheet" type="text/css">
  <!-- custom css -->
  <title>Print Payroll</title>
  <style>
    html {
      font-size: 75%;
    }

    .payroll_a4size {
      width: 100%;
      /* width: 594.44px;
      height: 841.68px; */
    }
    .row {
      display: -webkit-box;
      display: flex;
      -webkit-box-pack: center; 
      justify-content: center; 
      -webkit-box-pack: justify;
      justify-content: space-between;
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
  <!-- custom -->
  <div class="container-fluid">
    <div class="row">
      <!-- show message when job vacancy  added  start  -->
      <!-- <div class="mb-3 mt-4 col-md-12">
        <div class="alert alert-info   text-center d-none text-white vacancy_added_msg user_updated_msg" role="alert">
          Please wait .......
          <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
        </div>
      </div> -->
      <!-- show message when job vacancy  added  start  -->
      <div class="col-md-12 d-flex justify-content-center">
        <!-- <div class="payroll_a4size"> -->
          <!-- custom -->
          <div class="card w-100">
            <div class="card-body p-0">
              <div class="container">
                <div class="row d-flex align-items-center  mt-4" style="padding:16px;border-radius:10px;background-color:white;box-shadow:0 0 6px 1px #dcdcdc;">
                  <div class="col-7">
                    <p style="font-size: 20px;" class="mb-0">Invoice <strong>ID: {{$payroll->payroll_id}}</strong></p>
                  </div>
                  <!-- <div class="col-5 ">
                    <a href="#" class="btn btn-primary me-3 letter-spacing-1 mb-0 text-capitalize border-0 payroll_print_export" data-mdb-ripple-color="dark" data-payroll_id="{{$payroll->payroll_id}}" style="padding:7px 40px"><i class="fas fa-print text-primary"></i> Print</a>
                    <a href="{{route('download_payroll').'/'.$payroll->payroll_id}}" data-payroll_id="{{$payroll->payroll_id}}" class="btn btn-info mb-0 text-capitalize letter-spacing-1" data-mdb-ripple-color="dark" style="padding:7px 40px;"><i class="far fa-file-pdf text-danger"></i> Export</a>
                  </div> -->
                </div>
                <div class="container">
                  <div class="col-md-12">
                    <div class="text-center">
                      <i class="fab fa-mdb fa-4x ms-0" style="color:#5d9fc5 ;"></i>
                      <p class="pt-3 fs-3"><span><img src="{{public_path('storage/app_logo').'/'.show_app_logo()}}" alt="" width="40px" height="40px" style="border-radius:10px ;" class="me-3"></span> {{show_app_name()}}</p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-8">
                      <div class="company_div">
                        <ul class="list-unstyled company_information">
                          <li class="text-muted">COMPANY INFORMATION</li>
                          <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span class="fw-bold">Comapny Name: </span>{{$company_info->company_name}}</li>
                          <li class="text-muted"><span>{{ $company_info->logo==null?"Logo not exist" :show_app_name()}}</span></li>
                          <li class="mt-4"><span>{!! DNS2D::getBarcodeHTML(route('view_payroll_by_employee',['payroll_id'=>base64_encode($payroll->payroll_id),'company_id'=> base64_encode($payroll->users->first()->company_id)]), 'QRCODE',2,2); !!}</span></li>
                        </ul>
                      </div>
                    </div>
                    <div class="col-4">
                      <ul class="list-unstyled">
                        <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span class="fw-bold">USER INFORMATION</span></li>
                        <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span class="fw-bold">ID:</span>{{$payroll->payroll_id}}</li>
                        <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span class="fw-bold">Creation Date: </span>{{$payroll->users->first()->created_at}}</li>
                        <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span class="me-1 fw-bold">Status:</span><span class="badge bg-success text-black fw-bold">
                            {{$payroll->payment_status}}</span></li>
                        <li class="text-muted mt-3"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span class="fw-bold"> {!! DNS1D::getBarcodeHTML($payroll->payroll_id, 'C39',2,24); !!} </span></li>
                      </ul>
                    </div>
                  </div>

                  <div class="row my-2 mx-1">

                    <table class="table table-striped table-borderless tbl_wrapper">
                      <thead style="background-color:#0ba0f8 ;" class="text-white">
                        <tr>
                          <th scope="col" class="">Info</th>
                          <th scope="col" class=" ">Description</th>

                        </tr>
                      </thead>

                      <tbody>
                        <tr>
                          <td class="col">Employee Name</td>
                          <td class="col">{{$payroll->users->first()->username}}</td>
                        </tr>
                        <tr>
                          <td class="">Salary Month</td>
                          <td class="">{{$payroll->salary_month}}</td>
                        </tr>


                        <tr>
                          <td class="">Attendences</td>
                          <td class="">{{$payroll->attendences}}</td>
                        </tr>
                        <tr>
                          <td class="">Absenties</td>
                          <td class="">{{$payroll->absenties}}</td>
                        </tr>
                        <tr>
                          <td class="">Basic Salary</td>
                          <td class="">{{$payroll->basic_salary}}</td>
                        </tr>
                        <tr>
                          <td class="">Overtime Hours</td>
                          <td class="">{{$payroll->overtime_hours}}</td>
                        </tr>

                        <tr>
                          <td class="">Overtime Amount</td>
                          <td class="">{{$payroll->overtime_amount}}</td>
                        </tr>

                        <tr>
                          <td class="">Allownces</td>
                          <td class="">{{$payroll->allownces}}</td>
                        </tr>

                        <tr>
                          <td class="">Deductions</td>
                          <td class="">{{$payroll->deductions}}</td>
                        </tr>


                        <tr>
                          <td class="">Net Payable</td>
                          <td class="">{{$payroll->net_payable}}</td>
                        </tr>
                        <tr>


                      </tbody>
                    </table>




                  </div>
                  <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-xl-6">

                      <p class="text-black float-start"><span class="text-black me-3"> Total Amount</span><span style="font-size: 25px;">{{$payroll->net_payable}}</span></p>
                    </div>
                  </div>



                </div>
              </div>
            </div>
          </div>


        <!-- </div> -->
      </div>
    </div>
  </div>



  <script src="{{public_path('dashboard_assets/assets/js/core/jquery_3_6.js')}}"></script>
  <script>
    $(document).ready(function() {

      @php
      $baseUrl = config('app.url');
      echo "var base_url = '".$baseUrl.
      "';";
      $payroll_pdf_path = public_path('storage/hrm_prints/payroll.pdf');
      @endphp
      console.log("{{$payroll_pdf_path}}")
      $(document).on('click', ".payroll_print_export", function() { //
        let payroll_id = $(this).data('payroll_id')
        $.ajax({
          type: "post",

          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: base_url + "print_payroll",
          data: {
            payroll_id: payroll_id
          },
          dataType: "json",
          beforeSend: function() {
            $('.vacancy_added_msg').removeClass('d-none')
          },
          complete: function() {
            $('.vacancy_added_msg').addClass('d-none')
          },
          success: function(response) {
            if (response == 'true') {
              if ($('#payroll_invoice').length === 0) {
                let iframe = document.createElement('iframe')
                $(iframe).addClass('d-none')
                iframe.setAttribute('id', "payroll_invoice")
                iframe.setAttribute('src', "{{$payroll_pdf_path}}")
                document.body.appendChild(iframe)
                iframe.contentWindow.print();
              } else {
                let iframe = $('#payroll_invoice')[0]
                iframe.setAttribute('src', "{{$payroll_pdf_path}}")
                iframe.onload = function(param) {
                  iframe.contentWindow.print();
                }
              }
            }

          }
        });
      })










    });
  </script>

</body>

</html>
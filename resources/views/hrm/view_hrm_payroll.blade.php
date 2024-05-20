@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/hrm/css/hrm_payroll.css')}}">
@endSection
@section('body_content')
<div class="row">
  <div class="col-md-12 ">
    <!-- <iframe id="test_browser_eleemnts" src="{{url('return_pdf'.'/'.'30')}}" frameBorder="0" class=""></iframe> -->


    <!-- month /day start  -->
    <div class="monthly_daily_radio_parent">
      <!-- show alert when no user selected start -->
      <div class="mb-3 col-md-12">
        <div class="alert alert-info  d-none text-white emp_not_select_msg user_updated_msg" role="alert">
          Please select an Employee
          <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
        </div>
      </div>
      <!-- show alert when no user selected end -->
      <!-- show message while fetching resouces from server for print   start  -->
      <div class="mb-3 mt-4 col-md-12">
        <div class="alert alert-info   text-center d-none text-white vacancy_added_msg user_updated_msg" role="alert">
          Please wait .......
          <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
        </div>
      </div>
      <!-- show message while fetching resouces from server for print   start  -->
      <!-- show payroll in modal using ifram start  -->
      <!-- Button trigger modal -->

      <!-- Modal -->
      <div class="modal fade" id="view_payroll" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content payroll_modal_content">
            <div class="modal-header border-0">
              <h5 class="modal-title" id="exampleModalLabel"> Payroll</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body view_payroll_modal_body">

            </div>
            <div class="modal-footer border-0">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
          </div>
        </div>
      </div>

      <!-- show payroll in modal using ifram end  -->


      <!-- form -->
      <form role="form" action="" method="post" id="attendence_form">
        <div class="container-fluid">
          <div class="row">
            <!-- show message when attendence   added  start  -->
            <div class="mb-3 col-md-12">
              <div class="alert alert-success  d-none text-white attendence_added_msg user_updated_msg" role="alert">
                Payroll generated successfully <span class="exist_payroll_count ps-3"></span> Payroll Already exist
                <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
              </div>
            </div>
            <!-- show message when attendence   added  start  -->
            <div class="col-md-12 ">


              <!-- <div class="custom-control custom-radio month_radio_parent d-inline">
                <input name="month_day_radio" class="custom-control-input" id="month" type="radio" checked>
                <label class="custom-control-label" for="month">Monthly</label>
              </div> -->
              <!-- here daily radio button -->

              <!-- input start  -->
              <div class="col-md-6 mb-3 month-input-col m-auto">
                <label for="">Select Month </label>
                <input type="month" name="month_input" id="month_input" class="form-control month_input">
              </div>
              <!-- here daily_input   -->


              <!-- form inputs -->

              <!-- here user_id, start_time,end_tme inputs -->


              <div class="text-center col-md-6 m-auto">
                <button type="submit" id="add_attendence_btn" class="btn bg-primary w-100 my-4 mb-2 text-white">Generate Payroll</button>
              </div>
              <!-- form inputs end -->

            </div>
          </div>





          <!-- month /day end  -->
          @csrf

          <input type="hidden" name="dates_arr" id="dates_arr" value="">
          <input type="hidden" name="date" id="date" value="">
          <input type="hidden" name="user_id_checkbox" id="user_id_checkbox" value="">
          <input type="hidden" name="shift_start_time_input" id="shift_start_time_input" value="">
          <input type="hidden" name="shift_end_time_input" id="shift_end_time_input" value="">
          <input type="hidden" name="employee_not_select" id="employee_not_select" value="0">



      </form>
    </div>
    <!-- form -->



    <!-- Button trigger modal -->
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="delete_confirm_attendence" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog  modal-lg">
        <div class="modal-content">
          <form id="delete_form">
            <input type="hidden" name="delete_attendence_id" id="delete_attendence_id">
        </form>
          <!-- <div class="modal-header border-0">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div> -->
          <div class="modal-body">
            Are You sure to delete this Attendence ?

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            <button type="button" class="btn btn-primary confirm_delete_attendence" data-bs-dismiss="modal">Confirm</button>
          </div>
        </div>
      </div>
    </div>

    <!-- add attendence start  -->

    <!-- add job vacncies end  -->
    <!-- update job vacncies start  -->
    <div class="modal fade" id="update_attendence" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header vacancy_modal_header">
            <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Update Attendence</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-0">
            <!-- content start   -->
            <div class="container-fluid create_user_main p-0">
              <div class="row">
                <div class="col-md-12">
                  <form role="form" action="" method="post" id="attendence_update_form">
                    <input type="hidden" name="payroll_id" id="attendence_id">
                    @csrf
                    <div class="container-fluid">
                      <div class="row">
                        <!-- user_id -->

                        <!-- atttendences -->
                        <div class="mb-3 col-md-6">
                          <label for="attendences">Attendences</label>
                          <input type="text" class="form-control" placeholder="Attendences " aria-label="Attendences" name="attendences" id="attendences">
                        </div>
                        <!-- absenties-->
                        <div class="mb-3 col-md-6">
                          <label for="absenties">absenties</label>
                          <input type="text" class="form-control" placeholder="Absenties" aria-label="Absenties" name="absenties" id="absenties">
                        </div>
                        <!-- basic salary-->
                        <div class="mb-3 col-md-6">
                          <label for="basic_salary">basic Salary</label>
                          <input type="text" class="form-control" placeholder="basic Salary" aria-label="basic Salary" name="basic_salary" id="basic_salary">
                        </div>
                        <!--  overtime_hours-->
                        <div class="mb-3 col-md-6">
                          <label for="overtime_hours">OverTime Hours</label>
                          <input type="text" class="form-control" placeholder="OverTime Hours" aria-label="OverTime Hours" name="overtime_hours" id="overtime_hours">
                        </div>
                        <!--  overtime_amount-->
                        <div class="mb-3 col-md-6">
                          <label for="overtime_amount">OverTime Amount</label>
                          <input type="text" class="form-control" placeholder="OverTime Amount" aria-label="OverTime Amount" name="overtime_amount" id="overtime_amount">
                        </div>

                        <!--  allownces-->
                        <div class="mb-3 col-md-6">
                          <label for="allownces">Allownces</label>
                          <input type="text" class="form-control" placeholder="Allownces" aria-label="Allownces" name="allownces" id="allownces">
                        </div>
                        <!--  deductions-->
                        <div class="mb-3 col-md-6">
                          <label for="deductions">Deductions</label>
                          <input type="text" class="form-control" placeholder="Deductions" aria-label="Deductions" name="deductions" id="deductions">
                        </div>
                        <!--  net_payable-->
                        <div class="mb-3 col-md-6">
                          <label for="net_payable">Net Payable</label>
                          <input type="text" class="form-control" placeholder="Net Payable" aria-label="Net Payable" name="net_payable" id="net_payable">
                        </div>
                        <!-- payment_status-->
                        <div class="mb-3 col-md-6">
                          <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="payment_status" name="payment_status">
                            <label class="form-check-label" for="payment_status">Payment Status</label>
                          </div>
                        </div>



                        <div class="text-center col-md-6 m-auto">
                          <button type="submit" id="add_attendence_btn" class="btn bg-primary w-100 my-4 mb-2 text-white">Update payroll</button>
                        </div>
                      </div>
                    </div>
                  </form>

                </div>
              </div>
            </div>
            <!-- content end  -->

          </div>

        </div>
      </div>
    </div>
    <!-- update job vacncies end  -->



    <!-- content start  -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 table-responsive">





          <!-- attendence table start  -->
          <table class="table align-items-center mb-0  hover" id="view_hrm_payroll" style="width:100% !important;">
            <!-- show message when attendence    updated  start  -->
            <div class="mb-3 col-md-12">
              <div class="alert alert-success  d-none text-white attendence_updated_msg user_updated_msg" role="alert">
                Payroll updated
                <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
              </div>
            </div>
            <!-- show message when attendence    updated  start  -->
            <!-- show message when attendence    deleted start  -->
            <div class="mb-3 col-md-12">
              <div class="alert alert-success  d-none text-white attendence_deleted_msg user_updated_msg" role="alert">
                Payroll deleted
                <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
              </div>
            </div>
            <!-- show message when job vacancy   deleted  start  -->
            <!-- show message when attendence    exist start  -->
            <div class="mb-3 col-md-12">
              <div class="alert alert-warning  d-none text-white attendence_exist_msg user_updated_msg" role="alert">
                Attendence already exist
                <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
              </div>
            </div>
            <!-- show message when attendence  exist  start  -->


            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">S no</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Employee Name

                </th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Salary Month</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Basic Salary</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Overtime Amount</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Deductions</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Net payable</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Payment status</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">Actions</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
          <!-- attendence table end  -->
        </div>
        <div class="col-md-12 mt-4 table-responsive">

          <table class="table align-items-center mb-0  hover" id="employee_names_tbl" style="width: 100%;">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Employee Name
                  <button type="button" class="btn btn-primary btn-sm mb-0 ms-2 select-all-butt">Select All</button>
                </th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Employee No
                </th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
          <!-- show employee name table start -->
          <table class="table align-items-center mb-0  hover d-none" id="employee_names_shift_tbl" style="width: 100%;">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Employee Name
                  <button type="button" class="btn btn-primary btn-sm mb-0 ms-2 select-all-butt">Select All</button>
                </th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Employee No
                </th>
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
  "use strict";
  $(document).ready(function() {

    @php
    $baseUrl = config('app.url');
    echo "var base_url = '".$baseUrl.
    "';";
    $payroll_pdf_path = asset('storage/hrm_prints/payroll.pdf');
    @endphp



    // parse html entities start
    // function html_decode(input) {
    //     let parser = new DOMParser().parseFromString(input, "text/html");
    //     return parser.documentElement.textContent;
    // }

    // parse html entities end
    $("#user_id").select2({
      placeholder: "Select Employee",
      allowClear: true,
      width: "100%",
    });
    $("#work_shift_id").select2({
      placeholder: "Select Work Shift",
      allowClear: true,
      width: "100%",
    });



    // add job vacancies  start
    $("#attendence_form").validate({
      rules: {
        month_input: {
          required: true,
        }
      },
      messages: {
        month_input: {
          required: "Please select month"
        }
      },
      submitHandler: function(form) {
        // console.log('payroll added')
        let employee_checkbox = $('.employee_attendence_checkbox');
        // console.log(employee_checkbox)
        let employee_select = 0
        let employee_not_select = 0
        $(employee_checkbox).each(function(key, value) {
          if ($(value).is(':checked')) {
            employee_select++
            console.log($(value))
          } else {
            employee_not_select++
          }
        })
        if (employee_select == 0) {
          $('.emp_not_select_msg').removeClass('d-none')
        } else {
          $('.emp_not_select_msg').addClass('d-none')
          $.ajax({
            type: "post",
            url: base_url + "payroll",
            data: $(form).serialize(),
            dataType: "json",
            success: function(response) {
              if (response) {
                $("#attendence_form").trigger("reset");
                $("#view_hrm_payroll").DataTable().ajax.reload();
                $('.exist_payroll_count').text(response.exist_payroll)
                $(".attendence_added_msg").removeClass("d-none");
                $("#add_attendence").modal("toggle");
              } else if (response == 'attendence_exist') {
                $("#add_attendence").modal("toggle");
                $(".attendence_exist_msg").removeClass("d-none");

              }
            },
          });
        }








      },
    });

    // add job vaccanices end
    // dattables for attendence start
    $(function() {
      $.ajaxSetup({
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
      });

      $("#view_hrm_payroll").DataTable({


        columnDefs: [{
          'targets': [1], // column index (start from 0)
          'orderable': false, // set orderable false for selected columns
        }],
        processing: true,
        serverSide: true,
        dom: 'Blfrtip',
        buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        ajax: base_url + "get_data_payroll",
        columns: [{
            data: "DT_RowIndex",
            name: "DT_RowIndex"
          },
          {
            data: "username",
            name: "username"
          },
          {
            data: "salary_month",
            name: "salary_month"
          },
          {
            data: "basic_salary",
            name: "basic_salary"
          },
          {
            data: "overtime_amount",
            name: "overtime_amount"
          },
          {
            data: "deductions",
            name: "deductions"
          },
          {
            data: "net_payable",
            name: "net_payable"
          },
          {
            data: "payment_status",
            name: "payment_status"
          },
          {
            data: "action",
            name: "action"
          },
        ],
      });
    });
    // dattables attendence end

    // dattables to show employees only 
    // extracting dates from month start 

    const monthInput = document.querySelector('#month_input');
    const dateList = document.querySelector('#date-list');
    monthInput.addEventListener('change', function() {
      const selectedMonth = new Date(this.value);
      // console.log(selectedMonth.getMonth()+1)
      const numDays = new Date(selectedMonth.getFullYear(), selectedMonth.getMonth() + 1, 0).getDate();
      let dateStr = [];
      for (let i = 1; i <= numDays; i++) {
        let all_dates = `${selectedMonth.getFullYear()}-${selectedMonth.getMonth() + 1}-${i}`;
        dateStr.push(all_dates)
      }

      $('#dates_arr').val(dateStr)
    });

    $('#daily-input').on('change', function(param) {
      let date_val = $(this).val()
      $('#date').val(date_val);

    })
    // extracting dates from month end 

    //   user_id start 
    let user_ids = [];


    $(document).on('click', '.employee_attendence_checkbox', function() {
      user_ids = [];
      let user_id_checkbox = $('.employee_attendence_checkbox')
      // console.log(user_id_checkbox)
      $(user_id_checkbox).each(function(key, value) {
        if ($(value).is(':checked')) {
          // console.log(value)
          user_ids.push($(value).data('checkbox_user_id'))
        }

      })
      $('#user_id_checkbox').val(user_ids)
      //   console.log (user_ids)
    })
    //   user_id end 
    //  shiwing motnht of date start 
    $('input[name="month_day_radio"]').on('click', function(param) {
      if ($('#month').is(":checked")) {
        $('.month-input-col').removeClass('d-none')
        $('.day-input-col').addClass('d-none')

      } else {
        $('.day-input-col').removeClass('d-none')
        $('.month-input-col').addClass('d-none')

      }

    })

    //  shiwing motnht of date end 

    $(function() {
      $.ajaxSetup({
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
      });

      $("#employee_names_tbl").DataTable({
        "lengthChange": false,
        "bPaginate": false,
        "info": false,
        "bFilter": true,
        "scrollX": true,

        columnDefs: [{
          'targets': [0], // column index (start from 0)
          'orderable': false, // set orderable false for selected columns
        }],
        processing: true,
        serverSide: true,
        ajax: base_url + "get_employee_names_attendence",
        columns: [{
            data: "username",
            name: "username"
          },
          {
            data: "employee_no",
            name: "employee_no"
          },
        ],
      });
    });
    $('#work_shift_id').on('change', function() {
      let work_shift_id = $(this).val();
      if (work_shift_id != "") {
        $("#employee_names_shift_tbl").DataTable().destroy()
        $('#employee_names_tbl').addClass('d-none')
        $('#employee_names_tbl_filter label').addClass('d-none')
        $(function() {
          $.ajaxSetup({
            headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
          });

          $("#employee_names_shift_tbl").DataTable({
            "lengthChange": false,
            "bPaginate": false,
            "info": false,
            "bFilter": true,
            scrollX: true,
            columnDefs: [{
              'targets': [0], // column index (start from 0)
              'orderable': false, // set orderable false for selected columns
            }],
            processing: true,
            serverSide: true,
            ajax: {

              url: base_url + "get_employee_names_shift_attendence",
              data: {
                work_shift_id: work_shift_id
              }
            },
            columns: [{
                data: "username",
                name: "username"
              },
              {
                data: "employee_no",
                name: "employee_no"
              },
            ],
          });
        });


        $('#employee_names_shift_tbl').removeClass('d-none')

        // alert( $(this).find(':selected').data('start_time'))
        $('.shift_bracket').removeClass('d-none')
        let option_start_time = $(this).find(':selected').data('start_time')
        let option_end_time = $(this).find(':selected').data('end_time')
        $('#shift_start_time_input').val(option_start_time);
        $('#shift_end_time_input').val(option_end_time);
        $('#start_time').val(option_start_time)
        $('#end_time').val(option_end_time)
        $('#attendence_form .shift_start_time').text(convert_24_time_to_12(option_start_time))
        $('#attendence_form .shift_end_time').text(convert_24_time_to_12(option_end_time))
      } else {

        $('.shift_start_time').text("");
        $('.shift_end_time').text("");
        $('#start_time').val("")
        $('#end_time').val("")
        $('.shift_bracket').addClass('d-none')
        $('#shift_start_time_input').val("");
        $('#shift_end_time_input').val("");

        $('#employee_names_tbl').removeClass('d-none')
        $('#employee_names_tbl_filter label').removeClass('d-none')
        $('#employee_names_shift_tbl').addClass('d-none')
        $('#employee_names_shift_tbl').DataTable().destroy();
      }

    })

    // datatables show employees only  end

    // delete user start
    $(document).on("click", ".attendence_delete_btn", function(param) {
      $('#delete_attendence_id').val($(this).data("delete_attendence_id"))   ;
      $(".confirm_delete_attendence").on("click", function() {
        $.ajax({
          type: "post",
          url: base_url + "delete_payroll",
          data: $('#delete_form').serialize(),
          dataType: "json",
          success: function(response) {
            if (response) {
              $("#view_hrm_payroll").DataTable().ajax.reload();
              $(".attendence_deleted_msg").removeClass("d-none");
            }
          },
        });
      });
    });
    // delete user end



    // update employee leave  start
    $(document).on("click", ".attendence_edit_btn", function(param) {
      let update_attendence_id = $(this).data("update_attendence_id");
      $.ajax({
        type: "post",
        url: base_url + "fetch_payroll",
        data: {
          update_attendence_id: update_attendence_id
        },
        dataType: "json",
        success: function(response) {
          if (response) {
            $("#attendence_update_form")
              .find("#attendence_id")
              .val(response.payroll_id);
            $("#attendence_update_form")
              .find("#attendences")
              .val(response.attendences);
            $("#attendence_update_form")
              .find("#absenties")
              .val(response.absenties);
            $("#attendence_update_form")
              .find("#basic_salary")
              .val(response.basic_salary);
            $("#attendence_update_form")
              .find("#overtime_hours")
              .val(response.overtime_hours);
            $("#attendence_update_form")
              .find("#overtime_amount")
              .val(response.overtime_amount);
            $("#attendence_update_form")
              .find("#allownces")
              .val(response.allownces);
            $("#attendence_update_form")
              .find("#deductions")
              .val(response.deductions);
            $("#attendence_update_form")
              .find("#net_payable")
              .val(response.net_payable);

            if (response.payment_status == 'paid') {
              $("#attendence_update_form")
                .find("#payment_status").prop('checked', true)
            } else {
              $("#attendence_update_form")
                .find("#payment_status").prop('checked', false)
            }
            // $("#attendence_update_form")
            //   .find("#date")
            //   .val(response.date);

          }

        },
      });
    });

    $("#attendence_update_form").validate({
      rules: {

        attendences: {
          required: true,
        },
        absenties: {
          required: true,
        },
        basic_salary: {
          required: true,
        },
        overtime_hours: {
          required: true,
        },
        overtime_amount: {
          required: true,
        },
        allownces: {
          required: true,
        },
        deductions: {
          required: true,
        },
        net_payable: {
          required: true,
        },


      },
      messages: {

        attendences: {
          required: "Insert Attendence Count",
        },
        absenties: {
          required: "Insert Absenties Count",
        },
        basic_salary: {
          required: "Basic salary required",
        },
        overtime_hours: {
          required: "Overtime Hours required",
        },
        overtime_amount: {
          required: "Overtime Amount required",
        },
        allownces: {
          required: "Allownces required",
        },
        deductions: {
          required: "Allownces required",
        },
        net_payable: {
          required: "Net Payable required",
        },

      },
      submitHandler: function(form) {
        $.ajax({
          type: "post",
          url: base_url + "update_payroll",
          data: $(form).serialize(),
          dataType: "json",
          success: function(response) {
            if (response) {
              $("#view_hrm_payroll").DataTable().ajax.reload();
              $(".attendence_updated_msg").removeClass("d-none");
              $("#attendence_update_form").trigger("reset");
              $('#update_attendence').modal("toggle")
            }
          },
        });
      },
    });
    // update employee leave  end

    // add  button to data table to add job vacancy start
    // adding button to the create user datatable to add user start
    // setTimeout(() => {
    //   $(document).find("#view_attendence_filter").append(
    //     '<span class="add_user_div" ">\
    //                      <button type="button" class="btn bg-primary sidenav_zero_index add_attendence_btn btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#add_attendence" style="height:32px"> <i class="fa-solid fa-plus text-white"></i>\
    //             </button>\
    //       </span>\
    //    '
    //   );
    //   // check the contstains for company owner to add user start
    // }, 1);
    // add  button to data table to add job vacancy end
    // check checkboxes
    // $('#select_all_checkbox').on('submit',function(e){
    //     e.preventDefault();
    //     e.stopPropagation();
    //     alert('ok')


    // }) 
    $(document).on('click', '.select-all-butt', function(e) {
      user_ids = [];
      setTimeout(function() {
        let user_id_checkbox = $('table:not(".d-none") .employee_attendence_checkbox')
        // console.log(user_id_checkbox)
        $(user_id_checkbox).each(function(key, value) {
          if ($(value).is(':checked')) {
            // console.log(value)
            user_ids.push($(value).data('checkbox_user_id'))
          }
        })

        $('#user_id_checkbox').val(user_ids)

      }, 10)


      if ($(this).text() == 'Select All') {
        $(this).text('Un Select')
        // alert('select')

        let employee_attendence_checkbox = $('.employee_attendence_checkbox')
        $(employee_attendence_checkbox).each(function(key, value) {
          let att_checkbox = $(value)[0]
          $(att_checkbox).prop('checked', true)
        })
      } else {
        $(this).text('Select All')
        // alert('select')

        let employee_attendence_checkbox = $('.employee_attendence_checkbox')
        $(employee_attendence_checkbox).each(function(key, value) {
          let att_checkbox = $(value)[0]
          $(att_checkbox).prop('checked', false)
        })


      }

    })

    //  attendence form start 


    // alert( $('#work_shift_id').val())


    //  attendence form start 

    // Prepend any date. Use your birthday.
    function convert_24_time_to_12(timeString) {
      const timeString12hr = new Date('1970-01-01T' + timeString + 'Z')
        .toLocaleTimeString('en-US', {
          timeZone: 'UTC',
          hour12: true,
          hour: 'numeric',
          minute: 'numeric'
        });
      return timeString12hr
    }
    convert_24_time_to_12()
    // document.getElementById('myTime').innerText = timeString12hr
  });



  // showing parlll pdf in print pop after ajax request start
  @php
  $baseUrl = config('app.url');
  echo "var base_url = '".$baseUrl.
  "';";
  $payroll_pdf_path = asset('storage/hrm_prints/payroll.pdf');
  @endphp
  $(document).ready(function() {
    console.log("{{$payroll_pdf_path}}")
    $(document).on('click', ".payroll_print_export", function() { //
      let payroll_id = $(this).data('payroll_id')
      $.ajax({
        type: "post",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: base_url + "print_payroll_url",
        data: {
          payroll_id: payroll_id
        },
        dataType: "json",
        success: function(response) {
          if (response) {
        $('.vacancy_added_msg').removeClass('d-none')

            if ($('#payroll_invoice').length === 0) {
              let iframe = document.createElement('iframe')
              $(iframe).addClass('d-none')
              iframe.setAttribute('id', "payroll_invoice")
              iframe.setAttribute('src', response)
              document.body.appendChild(iframe)
              iframe.onload = function(param) {
        $('.vacancy_added_msg').addClass('d-none')
                iframe.contentWindow.print();
              }
            } else {
              let iframe = $('#payroll_invoice')[0]
              iframe.setAttribute('src', response)
              iframe.onload = function(param) {
        $('.vacancy_added_msg').addClass('d-none')
                iframe.contentWindow.print();
              }
            }
          }

        }
      });
    })




    $(document).on('click', ".view_payroll", function() {
      let payroll_id = $(this).data('payroll_id')
      $.ajax({
        type: "get",
        url: base_url + "view_payroll" + "/" + payroll_id,
        data: {
          payroll_id: payroll_id
        },
        dataType: "json",
        success: function(response) {
          alert(response)

        }
      });

    })
    // showing payroll end 

  });

  // showing payroll  start

  // print payroll slip start 
  // $(document).on('click', ".payroll_print_export", function() { //
  //   let payroll_id = $(this).data('payroll_id')
  //   $.ajax({
  //     type: "post",

  //     headers: {
  //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //     },
  //     url: base_url + "print_payroll",
  //     data: {
  //       payroll_id: payroll_id
  //     },
  //     dataType: "json",
  //     beforeSend: function() {
  //       $('.vacancy_added_msg').removeClass('d-none')
  //     },
  //     complete: function() {
  //       $('.vacancy_added_msg').addClass('d-none')
  //     },
  //     success: function(response) {
  //       if (response == 'true') {
  //         if ($('#payroll_invoice').length === 0) {
  //           let iframe = document.createElement('iframe')
  //           $(iframe).addClass('d-none')
  //           iframe.setAttribute('id', "payroll_invoice")
  //           iframe.setAttribute('src', "{{$payroll_pdf_path}}")
  //           document.body.appendChild(iframe)
  //           iframe.contentWindow.print();
  //         } else {
  //           let iframe = $('#payroll_invoice')[0]
  //           iframe.setAttribute('src', "{{$payroll_pdf_path}}")
  //           iframe.onload = function(param) {
  //             iframe.contentWindow.print();
  //           }
  //         }
  //       }

  //     }
  //   });
  // })
  // print payroll slip end 
  // show payroll in modal using i frame start 
  console.log(base_url + "payroll_page" + "/" + "30")
  $(document).on('click', ".view_payroll_iframe", function() {
    let payroll_id = $(this).data('payroll_id')
    $.ajax({
      type: "post",
      url: base_url + "payroll_page",
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
        alert(response)
        $('#view_payroll').modal('show')
        if ($('#payroll_iframe').length === 0) {
            let iframe = document.createElement('iframe')
            iframe.setAttribute('id', "payroll_iframe")
            iframe.setAttribute('width', "100%")
            iframe.setAttribute('height', "100%")
            iframe.setAttribute('src',"data:application/pdf;base64," + response)
            // iframe.setAttribute('src',response)
            $('.view_payroll_modal_body').append(iframe)
          } else {
            let iframe = $('#payroll_iframe')[0]
            iframe.setAttribute('src',"data:application/pdf;base64," + response)
            // iframe.setAttribute('src',response)
            
          }




        
      }
    });
  })
  // show payroll in modal using i frame  end
</script>
@endSection
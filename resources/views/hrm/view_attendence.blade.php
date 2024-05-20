
@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/hrm/css/attendence.css')}}">
@endSection
@section('body_content')
<div class="row">
  <div class="col-md-12 ">
    <!-- month /day start  -->



    <div class="monthly_daily_radio_parent">
      <!-- form -->
      <form role="form" action="" method="post" id="attendence_form">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 ">

              <div class="custom-control custom-radio month_radio_parent d-inline">
                <input name="month_day_radio" class="custom-control-input" id="month" type="radio">
                <label class="custom-control-label" for="month">Monthly</label>
              </div>
              <div class="custom-control custom-radio day_radio_parent d-inline ms-3">
                <input name="month_day_radio" class="custom-control-input" id="day" checked="" type="radio">
                <label class="custom-control-label" for="customRadio2">Daily</label>
              </div>
            </div>
            <!-- input start  -->
            <div class="col-md-6 mb-3 month-input-col d-none">
              <label for=""> </label>
              <input type="month" name="month-input" id="month-input" class="form-control ">
            </div>
            <div class="col-md-6 mb-3 day-input-col ">
            <label for=""> </label>

              <input type="date" name="daily-input" id="daily-input" class=" form-control">
            </div>
            <!-- form inputs -->
            <!-- user_id -->
        <div class="mb-3 col-md-6">
          <label for="start_date">Work shift <span class="ms-4 fw-light shift_bracket d-none">[<span class="fw-bold"> Started at </span> : <span class="shift_start_time"></span> , <span class="fw-bold"> End at </span> : <span class="shift_end_time"></span> ]</span> </label>
          <select name="work_shift_id" id="work_shift_id" class="form-select work_shift_id">
            <option></option>
            @foreach($work_shifts as $work_shift)
            <option value="{{$work_shift->work_shift_id}}" data-start_time="{{$work_shift->start_time}}"
            data-end_time="{{$work_shift->end_time}}">{{$work_shift->shift_name}}</option>
            @endforeach
          </select>
        </div>
        <!-- start time -->
        <div class="mb-3 col-md-6">
          <label for="start_time">Start Time  </label>
          <input type="time" class="form-control" placeholder="start Time " aria-label="start Time" name="start_time" id="start_time">
        </div>
        <!-- end_time -->
        <div class="mb-3 col-md-6">
        <label for="end_time">End Time</label>
          <input type="time" name="end_time" id="end_time" placeholder="End Time" class="form-control">
        </div>
        <!-- date -->

        <div class="text-center col-md-6 m-auto">
          <button type="submit" id="add_attendence_btn" class="btn bg-primary w-100 my-4 mb-2 text-white">Add Attendence</button>
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
        

      
    </form>
    </div>
    <!-- form -->



    <!-- Button trigger modal -->
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="delete_confirm_attendence" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
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
                    <input type="hidden" name="attendence_id" id="attendence_id" value="">
                    @csrf
                    <div class="container-fluid">
                      <div class="row">
                        <!-- user_id -->
                        
                        <!-- start time -->
                        <div class="mb-3 col-md-6">
                          <label for="start_time">Start Time</label>
                          <input type="time" class="form-control" placeholder="start Time " aria-label="start Time" name="start_time" id="start_time">
                        </div>
                        <!-- end_time -->
                        <div class="mb-3 col-md-6">
                          <label for="end_time">End Time</label>
                          <input type="time" name="end_time" id="end_time" placeholder="End Time" class="form-control">
                        </div>
                        <!-- date -->
                        <div class="mb-3 col-md-6">
                          <label for="date"> Date</label>
                          <input type="date" name="date" id="date" placeholder="Date" class="form-control">
                        </div>


                        <div class="text-center col-md-6 m-auto">
                          <button type="submit" id="add_attendence_btn" class="btn bg-primary w-100 my-4 mb-2 text-white">Update Attendence</button>
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
    <div class="card mb-4 view_user_card">
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">

          <div class="container-fluid">
            <div class="row">


              <div class="col-md-3">
                <!-- show employee name table start -->
                <table class="table align-items-center mb-0  hover" id="employee_names_tbl" style="width: 100%; margin-top:54px;">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Employee Name
                        <button type="button" class="btn btn-primary btn-sm mb-0 ms-2 select-all-butt">Select All</button>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
                <!-- show employee name table start -->
                <table class="table align-items-center mb-0  hover d-none" id="employee_names_shift_tbl" style="width: 100%;margin-top:54px;">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Employee Name
                        <button type="button" class="btn btn-primary btn-sm mb-0 ms-2 select-all-butt">Select All</button>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
              <div class="col-md-9">




                <!-- attendence table start  -->
                <table class="table align-items-center mb-0  hover" id="view_attendence" style="width: 100%; ">

                  <!-- show message when attendence   added  start  -->
                  <div class="mb-3 col-md-12">
                    <div class="alert alert-success  d-none text-white attendence_added_msg user_updated_msg" role="alert">
                      Attendence added
                      <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                    </div>
                  </div>
                  <!-- show message when attendence   added  start  -->
                  <!-- show message when attendence    updated  start  -->
                  <div class="mb-3 col-md-12">
                    <div class="alert alert-success  d-none text-white attendence_updated_msg user_updated_msg" role="alert">
                      Attendence updated
                      <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
                    </div>
                  </div>
                  <!-- show message when attendence    updated  start  -->
                  <!-- show message when attendence    deleted start  -->
                  <div class="mb-3 col-md-12">
                    <div class="alert alert-success  d-none text-white attendence_deleted_msg user_updated_msg" role="alert">
                      Attendence deleted
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
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Date</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Start Time</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder">End Time</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
                <!-- attendence table end  -->
              </div>
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
  "use strict";
  $(document).ready(function () {
    @php
            $baseUrl = config('app.url');
            echo "var base_url = '" . $baseUrl . "';";
        @endphp
    // parse html entities start
    function html_decode(input) {
        let parser = new DOMParser().parseFromString(input, "text/html");
        return parser.documentElement.textContent;
    }

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
    // tiny mce start
    $("#company_id").select2({
        placeholder: "Select Employee",
        allowClear: true,
        width: "100%",
    });


    // add job vacancies  start
    $("#attendence_form").validate({
        rules: {
            

            start_time: {
                required: true,
            },
            end_time: {
                required: true,
            },
          
        },
        messages: {

            start_time: {
                required: "Start time Required",
            },
            end_time: {
                required: "End time Required",
            },
          
        },
        submitHandler: function (form) {
            $.ajax({
                type: "post",
                url: base_url + "attendence",
                data: $(form).serialize(),
                dataType: "json",
                success: function (response) {
                    if (response=='true') {
                        $("#attendence_form").trigger("reset");
                        $("#view_attendence").DataTable().ajax.reload();
                        $("#add_attendence").modal("toggle");
                        $(".attendence_added_msg").removeClass("d-none");
                    }
                    else if(response=='attendence_exist'){
                        $("#add_attendence").modal("toggle");
                        $(".attendence_exist_msg").removeClass("d-none");


                    }
                },
            });
        },
    });

    // add job vaccanices end
    // dattables for attendence start
    $(function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        let attendence_table= $("#view_attendence").DataTable({
            columnDefs: [ {
                'targets': [1], // column index (start from 0)
                'orderable': false, // set orderable false for selected columns
             }],
            processing: true,
            serverSide: true,
            dom: 'Blfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
            ajax: base_url + "get_data_attendence",
            columns: [
                { data: "DT_RowIndex", name: "DT_RowIndex" },
                { data: "username", name: "username" },
                { data: "date", name: "date" },
                { data: "start_time", name: "start_time" },
                { data: "end_time", name: "end_time" },
                { data: "action", name: "action" },
            ],
        });
    });
    // dattables attendence end

    // dattables to show employees only 
        // extracting dates from month start 
    
        const monthInput = document.querySelector('#month-input');
        const dateList = document.querySelector('#date-list');
        monthInput.addEventListener('change', function() {
          const selectedMonth = new Date(this.value);
          // console.log(selectedMonth.getMonth()+1)
          const numDays = new Date(selectedMonth.getFullYear(), selectedMonth.getMonth() + 1, 0).getDate();
          let dateStr = [];
          for (let i = 1; i <= numDays; i++) {
            let  all_dates = `${selectedMonth.getFullYear()}-${selectedMonth.getMonth() + 1}-${i}`;
            dateStr.push(all_dates)
          }
      
          $('#dates_arr').val(dateStr)
      });
      
      $('#daily-input').on('change',function (param) {
          let date_val= $(this).val()
          $('#date').val(date_val);
      
        })
      // extracting dates from month end 

    //   user_id start 
    let user_ids=[];


    $(document).on('click','.employee_attendence_checkbox',function(){
        user_ids=[];
        let user_id_checkbox= $('.employee_attendence_checkbox')
        // console.log(user_id_checkbox)
        $(user_id_checkbox).each(function (key,value) {
            if( $(value).is(':checked')){
                // console.log(value)
                user_ids.push($(value).data('checkbox_user_id'))
            }

          })
          $('#user_id_checkbox').val(user_ids)
        //   console.log (user_ids)
    })
    //   user_id end 
    //  shiwing motnht of date start 
    $('input[name="month_day_radio"]').on('click',function (param) {
        if($('#month').is(":checked")){
            $('.month-input-col').removeClass('d-none')
            $('.day-input-col').addClass('d-none')

        }
        else{
            $('.day-input-col').removeClass('d-none')
            $('.month-input-col').addClass('d-none')

        }

      })

    //  shiwing motnht of date end 

    $(function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

         $("#employee_names_tbl").DataTable({
            "lengthChange": false,
            "bPaginate": false,
            "info":false,
            "bFilter":false,
            columnDefs: [ {
                'targets': [0], // column index (start from 0)
                'orderable': false, // set orderable false for selected columns
             }],
            processing: true,
            serverSide: true,
            ajax: base_url + "get_employee_names_attendence",
            columns: [
                { data: "username", name: "username" },
            ],
        });
    });
        $('#work_shift_id').on('change',function(){
            let work_shift_id= $(this).val();
            if(work_shift_id!=""){



             $("#employee_names_shift_tbl").DataTable().destroy()
             $('#employee_names_tbl').addClass('d-none')
            $(function () {
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });
        
                 $("#employee_names_shift_tbl").DataTable({
                    "lengthChange": false,
                    "bPaginate": false,
                    "info":false,
                    "bFilter":false,
                    columnDefs: [ {
                        'targets': [0], // column index (start from 0)
                        'orderable': false, // set orderable false for selected columns
                     }],
                    processing: true,
                    serverSide: true,
                    ajax: {

                        url: base_url + "get_employee_names_shift_attendence",
                        data:{work_shift_id:work_shift_id}
                    },
                    columns: [
                        { data: "username", name: "username" },
                    ],
                });
            });

            
            $('#employee_names_shift_tbl').removeClass('d-none')
        
        // alert( $(this).find(':selected').data('start_time'))
        $('.shift_bracket').removeClass('d-none')
        let option_start_time= $(this).find(':selected').data('start_time')
        let option_end_time= $(this).find(':selected').data('end_time')
        $('#shift_start_time_input').val(option_start_time);
        $('#shift_end_time_input').val(option_end_time);
        $('#attendence_form .shift_start_time').text(convert_24_time_to_12(option_start_time) )
        $('#attendence_form .shift_end_time').text( convert_24_time_to_12(option_end_time) )
            }
            else{

                $('.shift_start_time').text("");
                $('.shift_end_time').text("");
                $('.shift_bracket').addClass('d-none')
                $('#shift_start_time_input').val("");
        $('#shift_end_time_input').val("");

                $('#employee_names_tbl').removeClass('d-none')
                $('#employee_names_shift_tbl').addClass('d-none')
            }

    })

    // datatables show employees only  end

    // delete user start
    $(document).on("click", ".attendence_delete_btn", function (param) {
         $('#delete_attendence_id').val($(this).data("delete_attendence_id"))   ;
        $(".confirm_delete_attendence").on("click", function () {
            $.ajax({
                type: "post",
                url: base_url + "delete_attendence",
                data: $('#delete_form').serialize(),
                dataType: "json",
                success: function (response) {
                    if (response) {
                        $("#view_attendence").DataTable().ajax.reload();
                        $(".attendence_deleted_msg").removeClass("d-none");
                    }
                },
            });
        });
    });
    // delete user end



    // update employee leave  start
    $(document).on("click", ".attendence_edit_btn", function (param) {
        let update_attendence_id = $(this).data("update_attendence_id");
        $.ajax({
            type: "post",
            url: base_url + "fetch_attendence",
            data: { update_attendence_id: update_attendence_id },
            dataType: "json",
            success: function (response) {
                if (response) {
                    $("#attendence_update_form")
                        .find("#attendence_id")
                        .val(response.attendence_id);
                    $("#attendence_update_form")
                        .find("#date")
                        .val(response.date);
                    $("#attendence_update_form")
                        .find("#start_time")
                        .val(response.start_time);
                    $("#attendence_update_form")
                        .find("#end_time")
                        .val(response.end_time);
                        $("#attendence_update_form")
                        .find("#user_id")
                        .val(response.user_id);
                }

            },
        });
    });

    $("#attendence_update_form").validate({
        rules: {
            date: {
                required: true,
            },

            start_time: {
                required: true,
            },
            end_time: {
                required: true,
            },
        },
        messages: {
            date: {
                required: "Date required",
            },
            start_time: {
                required: "Start time Required",
            },
            end_time: {
                required: "End time Required",
            },
        },
        submitHandler: function (form) {
            $.ajax({
                type: "post",
                url: base_url + "update_attendence",
                data: $(form).serialize(),
                dataType: "json",
                success: function (response) {
                    if (response) {
                        $("#view_attendence").DataTable().ajax.reload();
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
    setTimeout(() => {
        $(document).find("#view_attendence_filter").append(
            '<span class="add_user_div" ">\
                         <button type="button" class="btn bg-primary sidenav_zero_index add_attendence_btn btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#add_attendence" style="height:32px"> <i class="fa-solid fa-plus text-white"></i>\
                </button>\
          </span>\
       '
        );
        // check the contstains for company owner to add user start
    }, 1);
    // add  button to data table to add job vacancy end
    // check checkboxes
    // $('#select_all_checkbox').on('submit',function(e){
    //     e.preventDefault();
    //     e.stopPropagation();
    //     alert('ok')


    // }) 
    $(document).on('click','.select-all-butt',function (e) { 
        user_ids=[];
        setTimeout(function(){
            let user_id_checkbox= $('table:not(".d-none") .employee_attendence_checkbox')
        // console.log(user_id_checkbox)
        $(user_id_checkbox).each(function (key,value) {
            if( $(value).is(':checked')){
                // console.log(value)
                user_ids.push($(value).data('checkbox_user_id'))
            }
          })

          $('#user_id_checkbox').val(user_ids)

        }, 10)
        
        
        if($(this).text()=='Select All'){
             $(this).text('Un Select')
            // alert('select')
            
            let employee_attendence_checkbox=$('.employee_attendence_checkbox')
            $(employee_attendence_checkbox).each(function (key,value) {
                let att_checkbox= $(value)[0]
                $(att_checkbox).prop('checked',true)
            })
        }
        else{
            $(this).text('Select All')
            // alert('select')
            
            let employee_attendence_checkbox=$('.employee_attendence_checkbox')
            $(employee_attendence_checkbox).each(function (key,value) {
                let att_checkbox= $(value)[0]
                $(att_checkbox).prop('checked',false)
            })
            

        }

     })

    //  attendence form start 


    // alert( $('#work_shift_id').val())


    //  attendence form start 

    // Prepend any date. Use your birthday.
function convert_24_time_to_12(timeString){
const timeString12hr = new Date('1970-01-01T' + timeString + 'Z')
  .toLocaleTimeString('en-US',
    {timeZone:'UTC',hour12:true,hour:'numeric',minute:'numeric'}
    );
    return timeString12hr
}
 convert_24_time_to_12()

// document.getElementById('myTime').innerText = timeString12hr


    
});


</script>
@endSection
"use strict";
$(document).ready(function () {
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
    const base_url = "http://127.0.0.1:8000/";
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
        let delete_attendence_id = $(this).data("delete_attendence_id");
        $(".confirm_delete_attendence").on("click", function () {
            $.ajax({
                type: "post",
                url: base_url + "delete_attendence",
                data: { delete_attendence_id: delete_attendence_id },
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


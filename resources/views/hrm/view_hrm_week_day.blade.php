@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/hrm/css/hrm_week_day.css')}}">
@endSection
@section('body_content')
<div class="row">
  <div class="col-md-12 ">

    <!-- Button trigger modal -->
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="delete_confirm_hrm_week_day" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
            Are You sure to delete this Week Day ?

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            <button type="button" class="btn btn-primary confirm_delete_hrm_week_day" data-bs-dismiss="modal">Confirm</button>
          </div>
        </div>
      </div>
    </div>

    <!-- add hrm_week_day start  -->
    <div class="modal fade" id="add_hrm_week_day" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header vacancy_modal_header">
            <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Add Week Day</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-0">
            <!-- content start   -->
            <div class="container-fluid create_user_main p-0">
              <div class="row">
                <div class="col-md-12">
                  <form role="form" action="" method="post" id="hrm_week_day_form">
                    @csrf
                    <div class="container-fluid">
                      <div class="row">
                        <!-- holiday name -->
                        <div class="mb-3 col-md-6">
                          <label for="start_date">Holiday Name</label>
                          <input type="text" class="form-control" placeholder="Holiday Name " aria-label="Start Date" name="holiday_name" id="holiday_name">
                        </div>
                        
                        <!-- start date -->
                        <div class="mb-3 col-md-6">
                          <label for="start_date">Start Date</label>
                          <input type="date" class="form-control" placeholder="Start Date " aria-label="Start Date" name="start_date" id="start_date">
                        </div>

                       
                        <!-- end_date -->
                        <div class="mb-3 col-md-6">
                          <label for="end_date">End Date</label>
                          <input type="date" name="end_date" id="end_date" placeholder="End Date" class="form-control">
                        </div>
                        
                        
                        <div class="text-center col-md-6 m-auto">
                          <button type="submit" id="add_hrm_week_day_btn" class="btn bg-primary w-100 my-4 mb-2 text-white">Add Week Day</button>
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
    <!-- add job vacncies end  -->
    <!-- update job vacncies start  -->
    <div class="modal fade" id="update_hrm_week_day" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header vacancy_modal_header">
            <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Update Week Day</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-0">
            <!-- content start   -->
            <div class="container-fluid create_user_main p-0">
              <div class="row">
                <div class="col-md-12">
                    <form role="form" action="" method="post" id="hrm_week_day_update_form">
                        <input type="hidden"  name="hrm_week_day_id" id="hrm_week_day_id" value="">
                    @csrf
                    <div class="container-fluid">
                      <div class="row">
                        <!-- holiday name -->
                        <div class="mb-3 col-md-6">
                          <label for="start_date">Holiday Name</label>
                          <input type="text" class="form-control" placeholder="Holiday Name " aria-label="Start Date" name="holiday_name" id="holiday_name">
                        </div>
                        
                        <!-- start date -->
                        <div class="mb-3 col-md-6">
                          <label for="start_date">Start Date</label>
                          <input type="date" class="form-control" placeholder="Start Date " aria-label="Start Date" name="start_date" id="start_date">
                        </div>

                       
                        <!-- end_date -->
                        <div class="mb-3 col-md-6">
                          <label for="end_date">End Date</label>
                          <input type="date" name="end_date" id="end_date" placeholder="End Date" class="form-control">
                        </div>
                        
                        
                        <div class="text-center col-md-6 m-auto">
                          <button type="submit" id="add_hrm_week_day_btn" class="btn bg-primary w-100 my-4 mb-2 text-white">Update Week Day</button>
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
          <table class="table align-items-center mb-0  hover" id="view_hrm_week_day" style="width: 100%;">
            
            <!-- show message when hrm_week_day   added  start  -->
            <div class="mb-3 col-md-12">
              <div class="alert alert-success  d-none text-white hrm_week_day_added_msg user_updated_msg" role="alert">
                Week Day added
                <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
              </div>
            </div>
            <!-- show message when hrm_week_day   added  start  -->
            <!-- show message when hrm_week_day    updated  start  -->
            <div class="mb-3 col-md-12">
              <div class="alert alert-success  d-none text-white hrm_week_day_updated_msg user_updated_msg" role="alert">
              Week Day updated
                <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
              </div>
            </div>
            <!-- show message when hrm_week_day    updated  start  -->
            <!-- show message when hrm_week_day    deleted start  -->
            <div class="mb-3 col-md-12">
              <div class="alert alert-success  d-none text-white hrm_week_day_deleted_msg user_updated_msg" role="alert">
              Week Day deleted
                <i class="fa-solid fa-xmark  fa_xmark_user float-end fs-4"></i>
              </div>
            </div>
            <!-- show message when job vacancy   deleted  start  -->
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">S no</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Monday</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Tuesday</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Wednesday</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Thursday</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Friday</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Saturday</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Sunday</th>
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
$(document).ready(function () {
    // parse html entities start
    function html_decode(input) {
        let parser = new DOMParser().parseFromString(input, "text/html");
        return parser.documentElement.textContent;
    }
    // parse html entities end

    // tiny mce start
        @php
            $baseUrl = config('app.url');
            echo "var base_url = '" . $baseUrl . "';";
        @endphp

    // add job vacancies  start


    // add job vaccanices end
    // dattables
    $(function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $("#view_hrm_week_day").DataTable({
            processing: true,
            serverSide: true,
            ajax: base_url + "get_data_hrm_week_day",
            columns: [
                { data: "DT_RowIndex", name: "DT_RowIndex" },
                { data: "monday", name: "monday" },
                { data: "tuesday", name: "tuesday" },
                { data: "wednesday", name: "wednesday" },
                { data: "thursday", name: "thursday" },
                { data: "friday", name: "friday" },
                { data: "saturday", name: "saturday" },
                { data: "sunday", name: "sunday" },
            ],
        });
    });
    // dattables end


    // on off day start 
    $(document).on('click','.day_input',function(){
       let day_name= $(this).attr('id')

       if( $(this).val()==1 ){
        $(this).val('0')


       }
       else{
        $(this).val('1')
       }
       $.ajax({
        type: "post",
        url: base_url+"on_off_day",
        data: {day_name:day_name,on_off:$(this).val()},
        dataType: "json",
        success: function (response) {
          if(response=='true'){
            $('#view_hrm_week_day').DataTable().ajax.reload()

          }
          
        }
       });

    });
    // on off day end 



    
});

</script>

@endSection
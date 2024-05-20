@extends('dashboard/nav_footer')
@section('page_header_links')
<link rel="stylesheet" href="{{asset('dashboard_assets/crm/css/crm_create_contact.css')}}">

@endSection
@section('body_content')
<div class="row">
  <div class="col-md-12 ">

    


    <!-- Modal -->
    <div class="modal fade" id="delete_confirm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <form id="delete_form">
            <input type="hidden" name="delete_user_id" id="delete_user_id">
        </form>
          <!-- <div class="modal-header border-0">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div> -->
          <div class="modal-body">
            Are You sure to delete this User ?

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            <button type="button" class="btn btn-primary confirm_delete_user" data-bs-dismiss="modal">Confirm</button>
          </div>
        </div>
      </div>
    </div>
    <!-- content start  -->
    <div class="card mb-4 view_user_card">
      <!-- <div class="card-header pb-0">
              <h6>Authors table</h6>
            </div> -->

      <div class="card-body px-0 pt-0 pb-2">
        <!-- modal start  -->
        <!-- Button trigger modal -->


        




        <!-- botton to add user  -->

        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0  hover" id="view_employee" style="width: 100%;">

            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">S no</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">User Name</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder  ps-2">Email</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Phone</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Gender</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">Actions</th>
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
  $(document).ready(function() {

    @php
            $baseUrl = config('app.url');
            echo "var base_url = '" . $baseUrl . "';";
        @endphp

    //  base_url = "http://127.0.0.1:8000/";
    $("#gender").select2({
      // dropdownParent: $('#register_form'),
      // dropdownCssClass:'increasezindex',
      placeholder: "Select gender",
      allowClear: true,
      width: "100%",
    });
    // martial status
    $("#company_id").select2({
      placeholder: "Select company",
      allowClear: true,
      width: "100%",
    });
    // martial company_id
    $("#marital_status").select2({
      placeholder: "Martial status",
      allowClear: true,
      width: "100%",
    });
    // country id
    $("#country_id").select2({
      placeholder: "Select Country",
      allowClear: true,
      width: "100%",
    });
    // ui_lang
    $("#ui_language").select2({
      placeholder: "Select Language",
      allowClear: true,
      width: "100%",
    });
    // ui_lang
    $("#user_type").select2({
      placeholder: "User type",
      allowClear: true,
      width: "100%",
    });
    // positon id
    $("#position_id").select2({
      placeholder: "Position",
      allowClear: true,
      width: "100%",
    });
    //deapartment   id
    $("#department_id").select2({
      placeholder: "Department",
      allowClear: true,
      width: "100%",
    });
    //blood group
    $("#blood_group").select2({
      placeholder: "Bloo group",
      allowClear: true,
      width: "100%",
    });

    //
    // add users start
    $("#user_added_form").validate({
      rules: {
        username: {
          required: true,
          // remote:base_url+'register_user'
          remote: {
            url: base_url +"is_exist_user_name" ,
            type: "post",
            data: {
              username: function() {
                return $("#username").val();
              },
              user_id: function() {
                return $("#user_id").val();
              },
              _token: $('meta[name="csrf-token"]').attr("content"),
            },
          },
        },
        first_name: {
          required: true,
        },
        last_name: {
          required: true,
        },
        phone_number: {
          required: true,
          number: true,
          maxlength: 15,
        },
        email: {
          required: true,
          email: true,
          remote: {
            url: base_url+ "is_exist_email" ,
            type: "post",
            data: {
              email: function() {
                return $("#email").val();
              },
              user_id: function() {
                return $("#user_id").val();
              },
              _token: $('meta[name="csrf-token"]').attr("content"),
            },
          },
        },
        password: {
          required: true,
        },


        user_type: {
          required: true,
        },
      },
      messages: {
        username: {
          required: "Please Enter Your name",
          remote: "an account with this user name already exist",
        },
        first_name: {
          required: "Enter First Name",
        },
        last_name: {
          required: "Enter Last Name",
        },
        phone_number: {
          required: "Contact required",
          number: "Only numbers are allowed",
          maxlength: "Length should be less than 15 charactor",
        },
        email: {
          required: "Email Required",
          email: "Please enter a valid Email",
          remote: "Email already register",
        },
        password: {
          required: "Password Required",
        },



        user_type: {
          required: "User Type Required",
        },
      },
      submitHandler: function(form) {
        $.ajax({
          type: "post",
          url: base_url+"users" ,
          data: $(form).serialize(),
          dataType: "json",
          success: function(response) {
            // alert(response);
            // console.log( response);
            if (response == 1) {
              // alert("user updated successfully")
              // $('.update_msg').removeClass("d-none");
              $("#user_added_form").trigger("reset");
              $(".user_updated_msg").removeClass("d-none");
            }
          },
        });
      },
    });
    // add users end

    // update  user start

    $("#user_update_form").validate({
      rules: {
        username: {
          required: true,
          // remote:base_url+'register_user'
          remote: {
            url: base_url+  "is_exist_user_name_for_update" ,
            type: "post",
            data: {
              username: function() {
                return $("#username").val();
              },
              user_id: function() {
                return $("#user_id").val();
              },
              _token: $('meta[name="csrf-token"]').attr("content"),
            },
          },
        },
        first_name: {
          required: true,
        },
        last_name: {
          required: true,
        },
        phone_number: {
          required: true,
          number: true,
          maxlength: 15,
        },
        email: {
          required: true,
          email: true,
          remote: {
            url:  base_url+ "is_exist_email_for_update" ,
            type: "post",
            data: {
              email: function() {
                return $("#email").val();
              },
              user_id: function() {
                return $("#user_id").val();
              },
              _token: $('meta[name="csrf-token"]').attr("content"),
            },
          },
        },

      
      
        user_type: {
          required: true,
        },
      },
      messages: {
        username: {
          required: "Please Enter Your name",
          remote: "an account with this user name already exist",
        },
        first_name: {
          required: "Enter First Name",
        },
        last_name: {
          required: "Enter Last Name",
        },
        phone_number: {
          required: "Contact required",
          number: "Only numbers are allowed",
          maxlength: "Length should be less than 15 charactor",
        },
        email: {
          required: "Email Required",
          email: "Please enter a valid Email",
          remote: "Email already register",
        },

      
        user_type: {
          required: "User Type Required",
        },
      },
      submitHandler: function(form) {
        $.ajax({
          type: "post",
          url: base_url+ "update_user"  ,
          data: $(form).serialize(),
          dataType: "json",
          success: function(response) {
            // alert(response);
            // console.log( response);
            if (response.status == 1) {
              // $('.update_msg').removeClass("d-none");
              $(".user_updated_msg").removeClass("d-none");
            }
          },
        });
      },
    });

    // update  user end

    // datatables start

    $(function() {
      $.ajaxSetup({
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
      });

      $("#view_user").DataTable({
        processing: true,
        serverSide: true,
        
        ajax:base_url +"get_data"  ,
        columns: [{
            data: "DT_RowIndex",
            name: "DT_RowIndex"
          },
          {
            data: "username",
            name: "username"
          },
          {
            data: "email",
            name: "email"
          },
          {
            data: "phone_number",
            name: "phone_number"
          },
          {
            data: "gender",
            name: "gender"
          },
          {
            data: "company_name",
            name: "company_name"
          },
          {
            data: "action",
            name: "action"
          },
        ],
      });
    });
    // datatables end
    

    // update user start
    $(document).on("click", ".user_edit_btn", function(param) {
      let update_user_id = $(this).data("update_user_id");
      location.replace(base_url+ "update_customer_form/" + update_user_id);
    });
    // update user end

    // delete user start
    $(document).on("click", ".user_delete_btn", function(param) {
      $('#delete_user_id').val($(this).data("delete_user_id"));
      $(".confirm_delete_user").on("click", function() {
        $.ajax({
          type: "post",
          url: base_url + "deleteUser",
          data: $('#delete_form').serialize(),
          dataType: "json",
          success: function(response) {
            // alert(response)
            $("#view_employee").DataTable().ajax.reload();
          },
        });
      });
    });
    // delete user end

    // adding button to the create user datatable to add user start
    setTimeout(() => {
      $(document)
        .find("#view_employee_filter")
        .append(
          '<span class="add_user_div" ">\
                     <button type="button" class="btn bg-primary add_user_by_owner btn-sm mb-2 mb-sm-0" data-bs-toggle="modal" data-bs-target="" style="height:32px"> <span class="material-symbols-outlined text-white" style="line-height:17px !important">\
              person_add\
            </span></button>\
      </span>\
   '
        );
      // check the contstains for company owner to add user start 

      $('.add_user_by_owner').on('click', function() {

              window.location.replace(base_url + 'customer/create')

      })
      // check the contstains for company owner to add user end
    }, 1);

    

    // employee start 
    // datatables start

    $(function() {
      $.ajaxSetup({
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
      });

      $("#view_employee").DataTable({
        processing: true,
        serverSide: true,
        dom: 'Blfrtip',
        buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        ajax: base_url + "get_data_customer",
        columns: [{
            data: "DT_RowIndex",
            name: "DT_RowIndex"
          },
          {
            data: "username",
            name: "username"
          },
          {
            data: "email",
            name: "email"
          },
          {
            data: "phone_number",
            name: "phone_number"
          },
          {
            data: "gender",
            name: "gender"
          },
          {
            data: "action",
            name: "action"
          },
        ],
      });
    });
    // datatables end
    // employee end 

  });
</script>
@endSection